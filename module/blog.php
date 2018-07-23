<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
$pages_all    = !empty($_GET['pages']) ? trim(addslashes($_GET['pages'])) : false;
$arFilters    = !empty($_GET['filters'])? explode('_', $_GET['filters']): array();
$itemID       = $UrlWL->getItemId();
$item         = array(); // Item Info Array
$items        = array(); // Items Array of items Info arrays
$arrCategories= array();
$showSubItems = true;
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
$arrPageData['pagesall']	= &$pages_all;
$arrPageData['backurl']		= $UrlWL->buildItemUrl($arCategory, $page, array(), ($pages_all ? 'pages=all' : ''));
$arrPageData['filter_url']	= $HTMLHelper->prepareFilterUrl($UrlWL->buildItemUrl($arCategory), $arFilters);
$arrPageData['clear_url']	= $UrlWL->buildItemUrl($arCategory);
$arrPageData['files_url']	= UPLOAD_URL_DIR.$module.'/';
$arrPageData['files_path']	= prepareDirPath($arrPageData['files_url']);
$arrPageData['items_on_page']	= 5;
$arrPageData['filters']		= array();
$arrPageData['filterSelect']	= array();
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////////////////// LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// Include Need CSS and Scripts For This Page To Array
$arrPageData['headCss'][]       = '<link href="/js/highslide/highslide.css" type="text/css" rel="stylesheet" />';
$arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide-full.packed.js" type="text/javascript"></script>';
$arrPageData['headScripts'][]   = '<script src="/js/highslide/langs/'.$lang.'.js" type="text/javascript"></script>';
$arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide.config.js" type="text/javascript"></script>';

// Item Detailed View
if($itemID) {
    $item = getSimpleItemRow($itemID, BLOG_TABLE);
    if(!empty($item)) {
        // Set vars
        $arrPageData['headTitle']       = $item['title'];
        $arCategory['meta_descr']       = $item['meta_descr'];
        $arCategory['meta_key']         = $item['meta_key'];
        $arCategory['meta_robots']      = $item['meta_robots'];
        $arCategory['seo_title']        = $item['seo_title'];
        $arrPageData['arrBreadCrumb'][] = array('id'=>$item['id'], 'title'=>$item['title']);
        $item['descr']			= unScreenData($item['descr']);
        $item['fulldescr']		= unScreenData($item['fulldescr']);
        $item['image']			= (!empty($item['image']) && is_file($arrPageData['files_path'].$item['image'])) ? $arrPageData['files_url'].$item['image'] : $arrPageData['files_url'].'noimage.jpg';
	$item['comments']		= getComplexRowItems(COMMENTS_TABLE, '*', 'WHERE `pid`='.$itemID.' AND `module`="'.$module.'"', '`created` DESC');
	if(!empty($_POST)) {
	    $_POST['message']   = cleanText($_POST['message']);
	    $Validator->validateGeneral($_POST['firstname'], sprintf(FEEDBACK_FILL_REQUIRED_FIELD, FEEDBACK_FIRST_NAME));
	    $Validator->validateGeneral($_POST['message'], sprintf(FEEDBACK_FILL_REQUIRED_FIELD, FEEDBACK_STRING_TEXT));
	    $Validator->validateGeneral($_POST["captcha"]["code"], sprintf(FEEDBACK_FILL_REQUIRED_FIELD, FEEDBACK_CONFIRMATION_CODE));
	    if (!empty($_POST['email'])) {
		$Validator->validateEmail($_POST['email'], sprintf(FEEDBACK_FILL_REQUIRED_FIELD_CORRECT, FEEDBACK_EMAIL));
	    }
	    if (!$Captcha->CheckCode($_POST["captcha"]["code"], $_POST["captcha"]["sid"])) {
		$Validator->addError(sprintf(ENTER_INPUT_ERROR, FEEDBACK_CONFIRMATION_CODE));
	    }
	    if ($Validator->foundErrors()) {
		$arrPageData['errors'][] = "<font color='#990033'>".FEEDBACK_ERROR_INPUT_STRING."</font>".$Validator->getListedErrors();
		$item = array_merge($item, $_POST);
	    } else {
		$arData = screenData($_POST);
		$arData['created']	= date('Y-m-d H:i:s');
		$arData['author']	= $arData['firstname'];
		$arData['descr']	= $arData['message'];
		$arData['pid']		= $itemID;
		$arData['module']	= $module;
		if($DB->postToDB($arData, COMMENTS_TABLE)) {
		    setSessionMessage(FEEDBACK_STRING_SEND_EMAIL);
		    Redirect($UrlWL->buildItemUrl($arCategory, $page, $item, 'result=success'));
		} else {
		    $arrPageData['errors'][] = FEEDBACK_MESSAGE_SEND_ERROR.'. '.TRY_AGAIN_TITLE;
		}
	    }
	} elseif (isset($_GET['result']) && $_GET['result'] == 'success' && empty($arrPageData['messages'])) {
	    Redirect($UrlWL->buildItemUrl($arCategory));
	}
    }
// List Items
} else {
        
    // IF you want to show all subcategories  products  - uncomment below line
    $arChildrensID = $showSubItems ? getChildrensIDs($catid, true) : 0;
    if($catid == $arrModules[$module]['id']) {
	$query = 'SELECT DISTINCT t.* FROM `'.BLOG_TABLE.'` t ';
	$where = 'WHERE t.`active`=1 ';
    } else {
	$query = 'SELECT DISTINCT t.* FROM `'.BLOG_TABLE.'` t  LEFT JOIN '.BLOG_TOCAT_TABLE.' c ON(c.`pid` = t.`id`) ';
	$where = 'WHERE t.`active`=1 AND c.`cid`='.$catid.' ';
    }
    
    if(!empty($arFilters)) {
	$query .= 'LEFT JOIN '.TAGS_TO_ENTRY_TABLE.' te ON(te.`pid` = t.`id`) LEFT JOIN '.TAGS_TABLE.' tt ON(te.`tid` = tt.`id`) ';
	$where .= 'AND tt.`id` IN('.implode(',', $arFilters).') ';
	// selected filters
	foreach ($arFilters as $key=>$value) {
	    $arrPageData['filterSelect'][] = getItemRow(TAGS_TABLE, '*', 'WHERE `id`='.$arFilters[$key]);
	}
    }

    if(!$pages_all){
        // Total pages and Pager
	$sResult = mysql_query($query.$where);
        $arrPageData['total_items'] = mysql_num_rows($sResult);
        $arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $UrlWL->buildPagerUrl($arCategory));
        $arrPageData['total_pages'] = $arrPageData['pager']['count'];
        $arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
        // END Total pages and Pager
    }

    $order  = 'ORDER by t.`created` DESC, t.`order` ';
    $limit  = $pages_all ? '' : "LIMIT {$arrPageData['offset']}, {$arrPageData['items_on_page']}";
    $result = mysql_query($query.$where.$order.$limit) or die(strtoupper($module).' SELECT: ' . mysql_error());
    
    $items  = array();
    if(mysql_num_rows($result) > 0) {
        while ($item = mysql_fetch_assoc($result)) {
            $item['arCategory'] = ($item['cid']>0 && $item['cid']!=$catid) ? $UrlWL->GetCategoryById($item['cid']) : $arCategory;
            $item['descr']       = unScreenData($item['descr']);
            $item['small_image'] = (!empty($item['image']) && is_file($arrPageData['files_path'].'small_'.$item['image'])) ? $arrPageData['files_url'].'small_'.$item['image'] : $arrPageData['files_url'].'small_noimage.jpg';
            $item['image']       = (!empty($item['image']) && is_file($arrPageData['files_path'].$item['image'])) ? $arrPageData['files_url'].$item['image'] : $arrPageData['files_url'].'noimage.jpg';
	    $item['comments']	 = intval(getValueFromDB(COMMENTS_TABLE, 'COUNT(*)', 'WHERE `pid`='.$item['id'].' AND `module`="'.$module.'"', 'cnt'));
            $items[] = $item;
        }
    }
    
    // items ID's to select filters
    $itemsIDX = array();
    $itemsFIDX = array();
    if($catid == $arrModules[$module]['id']) {
	$query = 'SELECT DISTINCT t.* FROM `'.BLOG_TABLE.'` t ';
	$where = 'WHERE t.`active`=1 ';
    } else {
	$query = 'SELECT DISTINCT t.* FROM `'.BLOG_TABLE.'` t  LEFT JOIN '.BLOG_TOCAT_TABLE.' c ON(c.`pid` = t.`id`) ';
	$where = 'WHERE t.`active`=1 AND c.`cid`='.$catid.' ';
    }
    $result = mysql_query($query.$where);
    if(mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
	    $itemsIDX[] = $row['id'];
	}
    }
    
    // items ID's to select filters
    
    if(!empty($arFilters)) {
	$query .= 'LEFT JOIN '.TAGS_TO_ENTRY_TABLE.' te ON(te.`pid` = t.`id`) LEFT JOIN '.TAGS_TABLE.' tt ON(te.`tid` = tt.`id`) ';
	$where .= 'AND tt.`id` IN('.implode(',', $arFilters).') ';
    }
    $result = mysql_query($query.$where);
    if(mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
	    $itemsFIDX[] = $row['id'];
	}
    }
    
    // filters
    $query = 'SELECT DISTINCT t.* FROM '.TAGS_TABLE.' t LEFT JOIN '.TAGS_TO_ENTRY_TABLE.' tt ON(tt.`tid` = t.`id`) ';
    $where = 'WHERE tt.`pid` IN('.implode(',', $itemsIDX).') ';
    if(!empty($arFilters)) {
	$where .= 'AND t.`id` NOT IN('.implode(',', $arFilters).') ';
    }
    $result = mysql_query($query.$where);
    if(mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
	    if(!empty($arFilters)) {
		$q = 'SELECT DISTINCT t.* FROM '.TAGS_TABLE.' t LEFT JOIN '.TAGS_TO_ENTRY_TABLE.' tt ON(tt.`tid` = t.`id`) WHERE t.`id`='.$row['id'].' AND tt.`pid` IN('.implode(',', $itemsIDX).') AND tt.`pid` NOT IN('.implode(',', $itemsFIDX).') AND t.`id` NOT IN('.implode(',', $arFilters).')';
		$r = mysql_query($q);
		$row['count'] = mysql_num_rows($r);
		if($row['count'] > 0) {
		    $arrPageData['filters'][] = $row;
		}
	    } else {
		$row['count'] = 0;
		$arrPageData['filters'][] = $row;
	    }
	}
    }
}

$query = 'SELECT * FROM `'.MAIN_TABLE.'` WHERE pid='.$catid.' ORDER BY `order`';
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
    $row['image'] = (!empty($row['image']) && is_file(MAIN_CATEGORIES_URL_DIR.$row['image'])) ? MAIN_CATEGORIES_URL_DIR.$row['image'] : '';
    $arrCategories[] = $row;
}

// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('item',         $item);
$smarty->assign('items',        $items);
$smarty->assign('arrCategories',$arrCategories);
$smarty->assign('arFilters',	$arFilters);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################

