<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
$pages_all    = !empty($_GET['pages']) ? trim(addslashes($_GET['pages'])) : false;
$itemID       = $UrlWL->getItemId();
$item          = array(); // Item Info Array
$items         = array(); // Items Array of items Info arrays
$arrCategories = array(); // Items Array of categories  arrays
// /////////////////////// END OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ////////// OPERATION MANIPULATION WITH SESSION VARIABLE \\\\\\\\\\\\\\\\\\\\\
// Manipulation with Page Number
if ($page > 1) {
    $_SESSION[MDATA_KNAME][$module]['page'] = &$page;
} elseif ($itemID && isset($_SESSION[MDATA_KNAME][$module]['page']) ) {
    $page = &$_SESSION[MDATA_KNAME][$module]['page'];
} elseif (isset($_SESSION[MDATA_KNAME][$module]['page'])) {
    unset($_SESSION[MDATA_KNAME][$module]['page']);
}
// Manipulation with Show Pages All Session Var
if ($pages_all) {
    $_SESSION[MDATA_KNAME][$module]['pagesall'] = &$pages_all;
} elseif ($itemID && isset($_SESSION[MDATA_KNAME][$module]['pagesall'])) {
    $pages_all = &$_SESSION[MDATA_KNAME][$module]['pagesall'];
} elseif (isset($_SESSION[MDATA_KNAME][$module]['pagesall'])) {
    unset($_SESSION[MDATA_KNAME][$module]['pagesall']);
}
// ////////// END OPERATION MANIPULATION WITH SESSION VARIABLE \\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////// REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\\
$arrPageData['pagesall']      = &$pages_all;
$arrPageData['backurl']       = $UrlWL->buildItemUrl($arrModules[$module], $page, array(), ($pages_all ? 'pages=all' : ''));
$arrPageData['files_url']     = UPLOAD_URL_DIR.$module.'/';
$arrPageData['files_path']    = prepareDirPath($arrPageData['files_url']);
$arrPageData['items_on_page'] = 12;
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////////////////// LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//// Include Need CSS and Scripts For This Page To Array
//$arrPageData['headCss'][]       = '<link href="/js/highslide/highslide.css" type="text/css" rel="stylesheet" />';
//$arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide-full.packed.js" type="text/javascript"></script>';
//$arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide.config.js" type="text/javascript"></script>';

// Item Detailed View
if($itemID) {
    $item = getSimpleItemRow($itemID, GALLERY_TABLE);
    if(!empty($item)) {
        // Set vars
        $arrPageData['headTitle']       = $item['title'];
        $arCategory['meta_descr']       = $item['meta_descr'];
        $arCategory['meta_key']         = $item['meta_key'];
        $arCategory['meta_robots']      = $item['meta_robots'];
        $arCategory['seo_title']        = $item['seo_title'];
        $arrPageData['arrBreadCrumb'][] = array('id'=>$item['id'], 'title'=>$item['title']);

        $item['descr']       = unScreenData($item['descr']);
        $item['fulldescr']   = unScreenData($item['fulldescr']);
        $item['small_image'] = (!empty($item['image']) && is_file($arrPageData['files_path'].'small_'.$item['image'])) ? $arrPageData['files_url'].'small_'.$item['image'] : $arrPageData['files_url'].'small_noimage.jpg';
        $item['tiny_image']  = (!empty($item['image']) && is_file($arrPageData['files_path'].'tiny_'.$item['image'])) ? $arrPageData['files_url'].'tiny_'.$item['image'] : $arrPageData['files_url'].'tiny_noimage.jpg';
        $item['image']       = (!empty($item['image']) && is_file($arrPageData['files_path'].$item['image'])) ? $arrPageData['files_url'].$item['image'] : '';
//        $item['filename']     = (!empty($item['filename']) && is_file($arrPageData['files_path'].$item['filename'])) ? $arrPageData['files_url'].$item['filename'] : '';
	$item['images']	     = getComplexRowItems(GALLERYFILES_TABLE, '*', 'WHERE pid='.(int)$itemID);
	if(!empty($item['images'])) {
	    for ($i = 0; $i < count($item['images']); $i++) {
		$item['images'][$i]['pre'] = $arrPageData['files_url'].$itemID.'/small_'.$item['images'][$i]['filename'];
		$item['images'][$i]['src'] = $arrPageData['files_url'].$itemID.'/'.$item['images'][$i]['filename'];
	    }
	}
	$item['arGalleries'] = getComplexRowItems(GALLERY_TABLE, '*', 'WHERE `active`=1 AND `id`!='.$itemID, '`order`, `id`');
    }

//// List Items For Root Category Module
//} elseif($arrModules[$module]['id']==$catid) {
//    //Get children categories
//    $query = 'SELECT t.*, COUNT(ljt.id) as images
//                    FROM `'.MAIN_TABLE.'` t
//                    LEFT JOIN `'.GALLERY_TABLE.'` ljt ON ljt.`cid`=t.`id` AND ljt.`active`=1
//                    WHERE t.`pid`='.$catid.'
//                    GROUP BY ljt.cid
//                    ORDER BY t.`order`';
//    $result = mysql_query($query);
//    while ($row = mysql_fetch_assoc($result)) {
//        $row['arPath']   = $arCategory['arPath'];
//        $row['arPath'][] = $row['seo_path'];
//        $row['image'] = (!empty($row['image']) && is_file(MAIN_CATEGORIES_DIR.DS.$row['image'])) ? MAIN_CATEGORIES_URL_DIR.$row['image'] : '';
//	$row['descr'] = (strlen(strip_tags(unScreenData($row['descr']))) > 72)? substr(strip_tags(unScreenData($row['descr'])), 0, 69).'...': strip_tags(unScreenData($row['descr']));
//        $arrCategories[] = $row;
//    }
//
//// List Items
} else {

    // Include Need CSS and Scripts For This Page To Array
    $arrPageData['headCss'][]       = '<link href="/js/highslide/highslide.css" type="text/css" rel="stylesheet" />';
    $arrPageData['headCss'][]       = '<link href="/js/highslide/highslide.gallery.css" type="text/css" rel="stylesheet" />';
    $arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide-full.packed.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/highslide/langs/'.$lang.'.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide.config.gallery.js" type="text/javascript"></script>';

    //$query = 'SELECT * FROM '.GALLERY_TABLE.' g LEFT JOIN '.GALLERY_TOCAT_TABLE.' c ON(c.pid = g.id) ';
    $query = 'SELECT * FROM '.GALLERY_TABLE.' g ';
    //$where = 'WHERE g.active=1 AND c.cid='.$catid.' ';
    $where = 'WHERE g.active=1 ';

    if(!$pages_all){
        // Total pages and Pager
        $arrPageData['total_items'] = intval(getValueFromDB(GALLERY_TABLE, 'COUNT(*)', $where, 'count'));
        $arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $UrlWL->buildPagerUrl($arCategory));
        $arrPageData['total_pages'] = $arrPageData['pager']['count'];
        $arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
        // END Total pages and Pager
    }

    $order  = 'ORDER by g.order DESC ';
    $limit  = $pages_all ? '' : "LIMIT {$arrPageData['offset']}, {$arrPageData['items_on_page']}";
    $result = mysql_query($query.$where.$order.$limit) or die(strtoupper($module).' SELECT: ' . mysql_error());

    if(mysql_num_rows($result) > 0) {
        while ($item = mysql_fetch_assoc($result)) {
            //$item['arCategory']  = ($item['cid']>0 && $item['cid']!=$catid) ? $UrlWL->GetCategoryById($item['cid']) : $arCategory;
            $item['arCategory']  = $arCategory;
	    $item['descr']	 = (strlen(strip_tags(unScreenData($item['descr']))) > 72)? substr(strip_tags(unScreenData($item['descr'])), 0, 69).'...': strip_tags(unScreenData($item['descr']));
            $item['small_image'] = (!empty($item['image']) && is_file($arrPageData['files_path'].'small_'.$item['image'])) ? $arrPageData['files_url'].'small_'.$item['image'] : $arrPageData['files_url'].'small_noimage.jpg';
            $item['image']       = (!empty($item['image']) && is_file($arrPageData['files_path'].$item['image'])) ? $arrPageData['files_url'].$item['image'] : $arrPageData['files_url'].'noimage.jpg';
//            $item['filename']    = (!empty($item['filename']) && is_file($arrPageData['files_path'].$item['filename'])) ? $arrPageData['files_url'].$item['filename'] : '';
            $items[] = $item;
        }
    }
}
// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('item',         $item);
$smarty->assign('items',        $items);
$smarty->assign('arrCategories',$arrCategories);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################

