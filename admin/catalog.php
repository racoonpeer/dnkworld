<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

# ##############################################################################
// //////////////////////// MODULE DATA VERIFICATION \\\\\\\\\\\\\\\\\\\\\\\\\\\
if(!$arrPageData['moduleRootID']){
    $arrPageData['errors'][]    = sprintf(ADMIN_MODULE_ID_ERROR, CATALOG, $arrPageData['module']);
    $arrPageData['module']      = 'common/module_messages';
    $arrPageData['moduleTitle'] = CATALOG;
    return;
} else {
    foreach($arAcceptLangs as $ln){
        $dbTable = replaceLang($ln, CATALOG_TABLE);
        if(!$DB->isSetDBTable($dbTable)){
            $arrPageData['errors'][]    = sprintf(ADMIN_MODULE_TABLE_ERROR, CATALOG, $arrPageData['module'], $dbTable);
            $arrPageData['module']      = 'common/module_messages';
            $arrPageData['moduleTitle'] = CATALOG;
            return;
        }
    }
}
// /////////////////////// END MODULE DATA VERIFICATION \\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
// SET from $_GET Global Array Item ID Var = integer
$itemID        = (isset($_GET['itemID']) && intval($_GET['itemID'])) ? intval($_GET['itemID']) : 0;
$cid           = (isset($_GET['cid']) && intval($_GET['cid']))       ? intval($_GET['cid'])    : 0;
$item          = array(); // Item Info Array
$items         = array(); // Items Array of items Info arrays
$categoryTree  = getCategoriesTree($lang, $arrPageData['moduleRootID'], 0, false, $module);
$arCidCntItems = getItemsCountInCategories('cid', 'count', CATALOG_TABLE, '`cid`,COUNT(`cid`) as count', 'WHERE `active`=1 GROUP BY `cid`');
// /////////////////////// END OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////// REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\\
$arrPageData['itemID']        = $itemID;
$arrPageData['cid']           = $cid = ((!$cid && !empty($categoryTree)) ? $categoryTree[0]['id'] : $cid);
$arrPageData['category_url']  = $cid ? '&cid='.$cid : '';
$arrPageData['current_url']   = $arrPageData['admin_url'].$arrPageData['category_url'].$arrPageData['page_url'];
$arrPageData['arrBreadCrumb'] = getBreadCrumb($cid, 1);
$arrPageData['arrParent']     = getItemRow(MAIN_TABLE, '*', 'WHERE id='.$cid);
$arrPageData['headTitle']     = CATALOGS.$arrPageData['seo_separator'].$arrPageData['headTitle'];
$arrPageData['files_url']     = UPLOAD_URL_DIR.$module.'/';
$arrPageData['files_path']    = prepareDirPath($arrPageData['files_url'], true);
$arrPageData['items_on_page'] = 20;
$arrPageData['def_img_param'] = array('w'=>800, 'h'=>600);
$arrPageData['images_params'] = array(array("small_", 140, 140),array("middle_", 200, 200)); // array(array(addname, width, height), array(addname, width, height)[, ..]);
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ////////////////////////// POST AND GET OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\
// SET Reorder
if($task=='reorderItems' && !empty($_POST)) {
    $result = reorderItems($_POST['arOrder'], 'order', 'id', CATALOG_TABLE);
    if($result===true) $arrPageData['messages'][] = 'Новая сортировка елементов успешно сохранена!';
    elseif($result)    $arrPageData['errors'][] = $result;

    if(!empty($_POST['arItems'])){
        $result = updateItems(array('ispopular'=>$_POST['arPopular'], 'isnewest'=>$_POST['arNewest']), $_POST['arItems'], 'id', CATALOG_TABLE);
        if($result===true) $arrPageData['messages'][] = 'Новые состояния популярных и новейших елементов успешно сохранено!';
        elseif($result)    $arrPageData['errors'][] = $result;
    }
}
// Delete Item
elseif($itemID && $task=='deleteItem') {
    unlinkImageLangsSynchronize($itemID, CATALOG_TABLE, $arrPageData['files_path'], $arrPageData['images_params']);
    deleteFileFromDB_AllLangs($itemID, CATALOG_TABLE, 'filename', ' WHERE `id`='.$itemID, $arrPageData['files_path']);
    $result = deleteDBLangsSync(CATALOG_TABLE, ' WHERE id='.$itemID);
    if(!$result)    $arrPageData['errors'][] = 'Данные не удалось удалить. Возможная причина - <p>MySQL Error Delete: '.mysql_errno().'</b> Error:'.mysql_error().'</p>';
    elseif($result) {
        deleteItemsAndFilesFromDB('filename', PRODUCT_FILES_TABLE, "WHERE `productid`='$itemID'", $arrPageData['files_path']);
        Redirect($arrPageData['current_url']);
    }
}
// Set Active Status Item
elseif($itemID && $task=='publishItem' && isset($_GET['status'])) {
    $result = updateRecords(CATALOG_TABLE, "`active`='{$_GET['status']}'", 'WHERE `id`='.$itemID);
    if($result===false) $arrPageData['errors'][]   = 'Новое состояние <font color="red">НЕ было сохранено</font>! Error Update: '. mysql_error();
    elseif($result)     $arrPageData['messages'][] = 'Новое состояние успешно сохранено!';
}
// Insert Or Update Item in Database
elseif(!empty($_POST) && ($task=='addItem' || $task=='editItem')) {
    $arUnusedKeys = array();
    $query_type   = $itemID ? 'update'            : 'insert';
    $conditions   = $itemID ? 'WHERE `id`='.$itemID : '';

    $Validator->validateGeneral($_POST['title'], 'Вы не ввели названия страницы!!!');
    $Validator->validateGeneral($_POST['order'], 'Вы не ввели порядковый номер страницы!!!');
    
    // Манипуляции с SEO путем
    if($Validator->foundErrors()==0){
        $_POST['seo_path'] = $UrlWL->strToUrl((empty($_POST['seo_path']) ? $_POST['title'] : $_POST['seo_path']), $module);
        // Проверяем присуствует ли в базе
        if(getValueFromDB(NEWS_TABLE, 'COUNT(*)', "WHERE `seo_path`='{$_POST['seo_path']}'".($cid ? ' AND `cid`='.$cid : '').($itemID ? ' AND `id`<>'.$itemID : ''), 'count')>0)
            $Validator->addError("Такой «SEO Path» уже используется в системе!");
    }

    if ($Validator->foundErrors()) {
        $arrPageData['errors'][] = "<font color='#990033'>Пожалуйста, введите правильное значение :  </font>".$Validator->getListedErrors();
    } else {
        $arPostData = $_POST;
        $arPostData['image'] = imageManipulation($itemID, CATALOG_TABLE, $arrPageData['files_url'], $arrPageData['images_params']);
        $arPostData['filename'] = fileUpload_addToDB('filename', $itemID, CATALOG_TABLE, 'filename', ($itemID ? ' WHERE id='.$itemID : ''), $arrPageData['files_path'], array('pdf','doc','docx'), (isset($_POST['filename_delete']) ? true : false));

        if(empty($arPostData['image']))    $arUnusedKeys[] = 'image';
        if(empty($arPostData['filename'])) $arUnusedKeys[] = 'filename';

        if(empty($arPostData['createdDate'])) $arPostData['createdDate'] = date('Y-m-d');
        if(empty($arPostData['createdTime'])) $arPostData['createdTime'] = date('H:i:s');
        $arPostData['created'] = "{$arPostData['createdDate']} {$arPostData['createdTime']}";
        
        $result = $DB->postToDB($arPostData, CATALOG_TABLE, $conditions,  $arUnusedKeys, $query_type, ($itemID ? false : true));
        if($result){
            setSessionMessage('Запись успешно сохранена!');
            if(!$itemID && $result && is_int($result)) $itemID = $result;
            Redirect($arrPageData['current_url'].(isset($_POST['submit_add']) ? '&task=addItem' : ((isset($_POST['submit_apply']) && $itemID) ? '&task=editItem&itemID='.$itemID : '')) );
        } else {
            $arrPageData['errors'][] = 'Запись <font color="red">НЕ была сохранена</font>!';
            unlinkUnUsedImage($arPostData['image'], $arrPageData['files_url'], $arrPageData['images_params']);
            unlinkFile($arPostData['filename'], $arrPageData['files_path']);            
        }
    }
}
// \\\\\\\\\\\\\\\\\\\\\\\ END POST AND GET OPERATIONS /////////////////////////
# ##############################################################################


# ##############################################################################
// ///////////////////////// LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// Sorts and Filters block
$arrOrder = getOrdersByKeyExplodeFilteredArray($_GET, 'pageorder', '_');
$arrPageData['filter_url'] = !empty($arrOrder['url']) ? '&'.implode('&', $arrOrder['url']) : '';


if($task=='addItem' || $task=='editItem'){
    if(!$itemID){
        $item = array_combine_multi($DB->getTableColumnsNames(CATALOG_TABLE), '');
        $item['order']  = getMaxPosition($cid, 'order', 'cid', CATALOG_TABLE);
        $item['active'] = 1;
        $item['createdDate'] = date('Y-m-d');
        $item['createdTime'] = date('H:i:s');
    } elseif($itemID) {
        $query = "SELECT * FROM ".CATALOG_TABLE." WHERE id = $itemID LIMIT 1";
        $result = mysql_query($query);
        if(!$result)
            $arrPageData['errors'][] = "SELECT OPERATIONS: " . mysql_error();
        elseif(!mysql_num_rows($result))
            $arrPageData['errors'][] = "SELECT OPERATIONS: No this Item in DataBase";
        else {
            $item = mysql_fetch_assoc($result);
            $item['createdDate'] = date('Y-m-d', strtotime($item['created']));
            $item['createdTime'] = date('H:i:s', strtotime($item['created']));
            $item['arImageData'] = $item['image'] ? getArrImageSize($arrPageData['files_url'], $item['image']) : array();
        }
    }

    if(!empty($_POST)) $item = array_merge($item, $_POST);

    // Include Need CSS and Scripts For This Page To Array
    $arrPageData['headCss'][]       = '<link href="/js/highslide/highslide.css" type="text/css" rel="stylesheet" />';
    $arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide-full.packed.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/highslide/langs/'.$lang.'.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/highslide/highslide.config.admin.js" type="text/javascript"></script>';
    $arrPageData['headCss'][]       = '<link href="/js/jquery/themes/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />';
    $arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.core.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.widget.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.datepicker.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/1251/jquery.ui.datepicker-ru.js" type="text/javascript"></script>';

    $arrPageData['arrBreadCrumb'][] = array('title'=>($task=='addItem' ? ADMIN_ADD_NEW_PAGE : ADMIN_EDIT_PAGE));

} else {
    // Create Order Links
    $arrPageData['arrOrderLinks'] = getOrdersLinks(
            array('default'=>HEAD_LINK_SORT_DEFAULT, 'title'=>HEAD_LINK_SORT_TITLE, 'created'=>HEAD_LINK_SORTDATEADD, 'price'=>HEAD_LINK_SORT_PRICE),
            $arrOrder['get'], $arrPageData['admin_url'].$arrPageData['category_url'], 'pageorder', '_');

    // Display Items List Data
    $where = $cid ? "WHERE t.cid = $cid " : '';
    
    // Total pages and Pager
    $arrPageData['total_items'] = intval(getValueFromDB(CATALOG_TABLE." t", 'COUNT(*)', $where, 'count'));
    $arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $arrPageData['admin_url'].$arrPageData['category_url'].$arrPageData['filter_url']);
    $arrPageData['total_pages'] = $arrPageData['pager']['count'];
    $arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
    // END Total pages and Pager

    $order = "ORDER BY ".(!empty($arrOrder['mysql']) ? 't.'.implode(', t.', $arrOrder['mysql']) : "t.order, t.id");
    $limit = "LIMIT {$arrPageData['offset']}, {$arrPageData['items_on_page']}";

    $query = "SELECT t.* FROM `".CATALOG_TABLE."` t $where $order $limit";
    $result = mysql_query($query);
    if(!$result) $arrPageData['errors'][] = "SELECT OPERATIONS: " . mysql_error();
    else {
        $i=0;
        while ($row = mysql_fetch_assoc($result)) {
            $row['idb']        = (++$i%2) ? "body1" : "body2";
            $items[]           = $row;
        }
    }
}
// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('item',          $item);
$smarty->assign('items',         $items);
$smarty->assign('categoryTree',  $categoryTree);
$smarty->assign('arCidCntItems', $arCidCntItems);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################

/*
DROP TABLE IF EXISTS `ru_catalog`;
CREATE TABLE IF NOT EXISTS `ru_catalog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `pcode` varchar(32) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descr` tinytext,
  `fulldescr` text,
  `price` float(24,2) NOT NULL DEFAULT '0.00',
  `image` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `meta_descr` text NOT NULL,
  `meta_key` text NOT NULL,
  `meta_robots` varchar(63) NOT NULL DEFAULT '',
  `seo_path` varchar(255) NOT NULL DEFAULT '',
  `seo_title` varchar(255) NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT '0',
  `ispopular` tinyint(1) NOT NULL DEFAULT '0',
  `isnewest` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_cid` (`cid`),
  KEY `idx_productcode` (`pcode`),
  KEY `idx_title` (`title`),
  KEY `idx_price` (`price`),
  KEY `idx_order` (`order`),
  KEY `idx_active` (`active`),
  KEY `idx_created` (`created`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;
 */