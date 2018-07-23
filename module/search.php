<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
$pages_all   = !empty($_GET['pages'])   ? trim(addslashes($_GET['pages']))   : false;
$searchtext  = !empty($_POST['stext'])  ? addslashes(trim($_POST['stext']))  : false;
$searchwhere = !empty($_POST['swhere']) ? addslashes(trim($_POST['swhere'])) : false;
$items       = array(); // Items Array of items Info arrays
// /////////////////////// END OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################



# ##############################################################################
// ////////// OPERATION MANIPULATION WITH SESSION VARIABLE \\\\\\\\\\\\\\\\\\\\\
// Manipulation with Page Number
if ($page>1)                                                            $_SESSION[MDATA_KNAME][$module]['page'] = &$page;
elseif ($page==1 && isset($_SESSION[MDATA_KNAME][$module]['page']))     unset($_SESSION[MDATA_KNAME][$module]['page']);
elseif (isset($_SESSION[MDATA_KNAME][$module]['page']) )                $page = &$_SESSION[MDATA_KNAME][$module]['page'];
// Manipulation with Show Pages All Session Var
if ($pages_all)                                                         $_SESSION[MDATA_KNAME][$module]['pagesall'] = &$pages_all;
elseif ($page>1 && isset($_SESSION[MDATA_KNAME][$module]['pagesall']))  unset($_SESSION[MDATA_KNAME][$module]['pagesall']);
elseif (isset($_SESSION[MDATA_KNAME][$module]['pagesall']))             $pages_all = &$_SESSION[MDATA_KNAME][$module]['pagesall'];
// Manipulation with Search text
if ($searchtext)                                                        $_SESSION[MDATA_KNAME][$module]['stext'] = &$searchtext;
elseif (!empty($_SESSION[MDATA_KNAME][$module]['stext']))               $searchtext = &$_SESSION[MDATA_KNAME][$module]['stext'];
// Manipulation with where Search param
if ($searchwhere)                                                       $_SESSION[MDATA_KNAME][$module]['swhere'] = &$searchwhere;
elseif (!empty($_SESSION[MDATA_KNAME][$module]['swhere']))              $searchwhere = &$_SESSION[MDATA_KNAME][$module]['swhere'];
else                                                                    $searchwhere = 'all';
// ////////// END OPERATION MANIPULATION WITH SESSION VARIABLE \\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////// REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\\
$arrPageData['files_url']     = UPLOAD_URL_DIR.$module.'/';
$arrPageData['files_path']    = prepareDirPath($arrPageData['files_url']);
$arrPageData['items_on_page'] = 15;
$arrPageData['stext']         = $searchtext;
$arrPageData['swhere']        = $searchwhere;
$arCategory['title']          = SITE_SEARCH_RESULTS;
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////////////////// LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

if($searchtext && strlen($searchtext)>=3) {
    if($searchwhere == 'all' || $searchwhere == 'main'){
        $arrFields = array('title', 'text', 'descr', 'meta_descr', 'meta_key', 'seo_title');
        $query = "SELECT `id` FROM " . MAIN_TABLE . " WHERE (".getSqlStrCondition(getSqlListFilter($arrFields, $searchtext, 'LIKE'), 'OR').") AND `active` = 1 ORDER BY `order` ";
        $result = mysql_query($query);
        if($result && mysql_num_rows($result)){
            while ($row = mysql_fetch_assoc($result)) {
                $row = $UrlWL->GetCategoryById($row['id'], true);
                $row['descr'] = unScreenData($row['text']);
                $row['name']  = PAGES;
                $items[]=$row;
            }
        }
    }
/*
    if($searchwhere == 'all' || $searchwhere == 'catalog'){
        $arrFields = array('pcode', 'title', 'descr', 'fulldescr', 'meta_descr', 'meta_key', 'seo_title');
        $query = "SELECT * FROM " . CATALOG_TABLE . " WHERE (".getSqlStrCondition(getSqlListFilter($arrFields, $searchtext, 'LIKE'), 'OR').") AND `active` = 1 ORDER BY `cid`, `order`";
        $result = mysql_query($query);
        if($result && mysql_num_rows($result)){
            while ($row = mysql_fetch_assoc($result)) {
                $row['arCategory'] = ($row['cid']>0 && $row['cid']!=$arrModules['catalog']['id']) ? $UrlWL->GetCategoryById($row['cid']) : $arrModules['catalog'];
                $row['name']       = CATALOG;
                $items[] = $row;
            }
        }
    }
*/
    if($searchwhere == 'all' || $searchwhere == 'news'){
        $arrFields = array('title', 'descr', 'fulldescr', 'meta_descr', 'meta_key', 'seo_title');
        $query = "SELECT * FROM " . NEWS_TABLE . " WHERE (".getSqlStrCondition(getSqlListFilter($arrFields, $searchtext, 'LIKE'), 'OR').") AND `active` = 1 ORDER BY `created` DESC, `cid`, `order`";
        $result = mysql_query($query);
        if($result && mysql_num_rows($result)){
            while ($row = mysql_fetch_assoc($result)) {
                $row['arCategory'] = ($row['cid']>0 && $row['cid']!=$arrModules['news']['id']) ? $UrlWL->GetCategoryById($row['cid']) : $arrModules['news'];
                $row['name']       = NEWS;
                $items[]=$row;
            }
        }
    }

    if($searchwhere == 'all' || $searchwhere == 'gallery'){
        $arrFields = array('title', 'descr', 'fulldescr', 'meta_descr', 'meta_key', 'seo_title');
        $query = "SELECT * FROM " . GALLERY_TABLE . " WHERE (".getSqlStrCondition(getSqlListFilter($arrFields, $searchtext, 'LIKE'), 'OR').") AND `active` = 1 ORDER BY `created` DESC, `cid`, `order`";
        $result = mysql_query($query);
        if($result && mysql_num_rows($result)){
            while ($row = mysql_fetch_assoc($result)) {
                $row['arCategory'] = ($row['cid']>0 && $row['cid']!=$arrModules['gallery']['id']) ? $UrlWL->GetCategoryById($row['cid']) : $arrModules['gallery'];
                $row['name']       = GALLERIES;
                $items[]=$row;
            }
        }
    }

    if($searchwhere == 'all' || $searchwhere == 'video'){
        $arrFields = array('title', 'descr', 'fulldescr', 'meta_descr', 'meta_key', 'seo_title');
        $query = "SELECT * FROM " . VIDEOS_TABLE . " WHERE (".getSqlStrCondition(getSqlListFilter($arrFields, $searchtext, 'LIKE'), 'OR').") AND `active` = 1 ORDER BY `created` DESC, `cid`, `order`";
        $result = mysql_query($query);
        if($result && mysql_num_rows($result)){
            while ($row = mysql_fetch_assoc($result)) {
                $row['arCategory'] = ($row['cid']>0 && $row['cid']!=$arrModules['video']['id']) ? $UrlWL->GetCategoryById($row['cid']) : $arrModules['video'];
                $row['name']       = VIDEOS;
                $items[]=$row;
            }
        }
    }
    // -------------------------------------------------------------------------
    if (!$pages_all){
        // Total pages and Pager
        $arrPageData['total_items'] = sizeof($items);
        $arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $UrlWL->buildPagerUrl($arCategory));
        $arrPageData['total_pages'] = $arrPageData['pager']['count'];
        $arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
        // END Total pages and Pager

        // set page limit
        if($arrPageData['total_items'] > $arrPageData['items_on_page']) {
            $items = array_slice($items, $arrPageData['offset'], $arrPageData['items_on_page']);
        }
    }
} elseif(!empty($_POST)) $arrPageData['errors'][] = FOUND_ERROR;

// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('items',        $items);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################

