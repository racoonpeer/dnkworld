<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access


# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
$arrItems = array();
// /////////////////////// END OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////////////////// LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// Include Need CSS and Scripts For This Page To Array
//$arrPageData['headCss'][]       = '<link href="/js/highslide/highslide.css" type="text/css" rel="stylesheet" />';
//$arrPageData['headCss'][]       = '<link href="/js/highslide/highslide.video.css" type="text/css" rel="stylesheet" />';
//$arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide-full.packed.js" type="text/javascript"></script>';
//$arrPageData['headScripts'][]   = '<script src="/js/highslide/langs/'.$lang.'.js" type="text/javascript"></script>';
//$arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide.config.video.js" type="text/javascript"></script>';

// -----------------------------------------------------------------------------
// FILL ARRAY
$files_url    = UPLOAD_URL_DIR.'news/';
$files_path   = prepareDirPath($files_url);
$query  = 'SELECT * FROM `'.NEWS_TABLE.'` WHERE `active`=1 ORDER by `created` DESC LIMIT 3';
$result = mysql_query($query);
$arrItems['arNews'] = array();
while($row = mysql_fetch_assoc($result)){
    $row['title'] = unScreenData($row['title']);
    $row['descr'] = strip_tags(unScreenData($row['descr']));
    $row['image'] = (!empty($row['image']) && is_file($files_path.$row['image'])) ? $files_url.$row['image'] : $files_url.'noimage.jpg';
    $row['arImageData'] = $row['image'] ? getArrImageSize($files_url, $row['image']) : array();
    $arrItems['arNews'][] = $row;
}

$files_url    = MAIN_CATEGORIES_URL_DIR;
$files_path   = prepareDirPath($files_url);
$query  = 'SELECT * FROM `'.MAIN_TABLE.'` WHERE `active`=1 AND `module` IN("gallery", "blog", "school") AND `pid`=0 ORDER by `order`';
$result = mysql_query($query);
$arrItems['arCategories'] = array();
while($row = mysql_fetch_assoc($result)){
    $row['title'] = unScreenData($row['title']);
    $row['image'] = (!empty($row['image']) && is_file($files_path.$row['image'])) ? $files_url.$row['image'] : $files_url.'noimage.jpg';
    $row['arImageData'] = $row['image'] ? getArrImageSize($files_url, $row['image']) : array();
    $arrItems['arCategories'][] = $row;
}
/*
// -----------------------------------------------------------------------------
// FILL ARRAY
$files_url    = UPLOAD_URL_DIR.'announcements/';
$files_path   = prepareDirPath($files_url);
$query  = 'SELECT * FROM `'.ANNOUNCEMENTS_TABLE.'` WHERE `active`=1 ORDER by `created` DESC LIMIT 3';
$result = mysql_query($query);
$arrItems['arrAnnouncements'] = array();
while($row = mysql_fetch_assoc($result)){
    $row['title'] = unScreenData($row['title']);
    $row['descr'] = unScreenData($row['descr']);
    $row['image'] = (!empty($row['image']) && is_file($files_path.$row['image'])) ? $files_url.$row['image'] : $files_url.'noimage.jpg';
    $row['arImageData'] = $row['image'] ? getArrImageSize($files_url, $row['image']) : array();
    $arrItems['arrAnnouncements'][] = $row;
}

// -----------------------------------------------------------------------------
// FILL ARRAY
$files_url    = UPLOAD_URL_DIR.'articles/';
$files_path   = prepareDirPath($files_url);
$query  = 'SELECT * FROM `'.ARTICLES_TABLE.'` WHERE `active`=1 ORDER by `created` DESC LIMIT 6';
$result = mysql_query($query);
$arrItems['arrArticles'] = array();
while($row = mysql_fetch_assoc($result)){
    $row['title'] = unScreenData($row['title']);
    $row['descr'] = unScreenData($row['descr']);
    $row['image'] = (!empty($row['image']) && is_file($files_path.$row['image'])) ? $files_url.$row['image'] : $files_url.'noimage.jpg';
    $row['arImageData'] = $row['image'] ? getArrImageSize($files_url, $row['image']) : array();
    $arrItems['arrArticles'][] = $row;
}
*/
// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('arrItems',  $arrItems);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################
