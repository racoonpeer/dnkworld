<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

require_once('include/classes/Banners.php');
Banners::deActivatePositions(array(1,3,4));

# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
// SET from $_GET Global Array Item ID Var = integer
$itemID        = !empty($_GET['itemID'])  ? intval($_GET['itemID'])      : 0;
$posid         = !empty($_GET['posid'])   ? intval($_GET['posid'])       : 0;
$modname       = !empty($_GET['modname']) ? addslashes($_GET['modname']) : '';
$item          = array(); // Item Info Array
$items         = array(); // Items Array of items Info arrays
$categoryTree  = getCategoriesTree($lang, 0, 0, false);
// /////////////////////// END OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////// REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\\
$arrPageData['itemID']        = & $itemID;
$arrPageData['posid']         = & $posid;
$arrPageData['posid_url']     = $posid ? '&posid='.$posid : '';
$arrPageData['modname']       = & $modname;
$arrPageData['modname_url']   = $modname ? '&modname='.$modname : '';
$arrPageData['current_url']   = $arrPageData['admin_url'].$arrPageData['posid_url'].$arrPageData['modname_url'].$arrPageData['page_url'];
$arrPageData['headTitle']     = BANNERS_TITLE.$arrPageData['seo_separator'].$arrPageData['headTitle'];
$arrPageData['arTargets']     = Banners::getListTargets();
$arrPageData['arModules']     = Banners::getListModules();
$arrPageData['arPositions']   = Banners::getListPositions();
$arrPageData['files_url']     = Banners::getFolderURL();
$arrPageData['files_path']    = prepareDirPath($arrPageData['files_url'], true);
$arrPageData['items_on_page'] = 20;
$arrPageData['images_params'] = false; // array(array(addname, width, height), array(addname, width, height)[, ..]);
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ////////////////////////// POST AND GET OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\
// SET Reorder
if($task=='reorderItems' && !empty($_POST)) {
    $result = reorderItems($_POST['arOrder'], 'order', 'id', BANNERS_TABLE);
    if($result===true) $arrPageData['messages'][] = 'Новая сортировка елементов успешно сохранена!';
    elseif($result)    $arrPageData['errors'][] = $result;
}
// Delete Item
elseif($itemID && $task=='deleteItem') {
    unlinkImageLangsSynchronize($itemID, BANNERS_TABLE, $arrPageData['files_path'], $arrPageData['images_params']);
    $result = deleteDBLangsSync(BANNERS_TABLE, ' WHERE id='.$itemID);
    if(!$result)    $arrPageData['errors'][] = 'Данные не удалось удалить. Возможная причина - <p>MySQL Error Delete: '.mysql_errno().'</b> Error:'.mysql_error().'</p>';
    elseif($result) { Redirect($arrPageData['current_url']); }
}
// Set Active Status Item
elseif($itemID && $task=='publishItem' && isset($_GET['status'])) {
    $result = updateRecords(BANNERS_TABLE, "`active`='{$_GET['status']}'", 'WHERE `id`='.$itemID);
    if($result===false) $arrPageData['errors'][]   = 'Новое состояние <font color="red">НЕ было сохранено</font>! Error Update: '. mysql_error();
    elseif($result)     $arrPageData['messages'][] = 'Новое состояние успешно сохранено!';
}
// Insert Or Update Item in Database
elseif(!empty($_POST) && ($task=='addItem' || $task=='editItem')) {
    $arUnusedKeys = array();
    $query_type   = $itemID ? 'update'              : 'insert';
    $conditions   = $itemID ? 'WHERE `id`='.$itemID : '';

    $Validator->validateGeneral($_POST['title'], 'Вы не ввели названия блока!!!');
    $Validator->validateGeneral($_POST['order'], 'Вы не ввели порядковый номер страницы!!!');
    
    if(empty($_POST['position']))   $Validator->addError('Вы не выбрали позицию блока!!!');
    if(empty($_POST['module']))     $Validator->addError('Вы не выбрали модуль блока!!!');
    
    if ($Validator->foundErrors()) {
        $arrPageData['errors'][] = "<font color='#990033'>Пожалуйста, введите правильное значение :  </font>".$Validator->getListedErrors();
    } else {        
        $arPostData = $_POST;

        $arPostData['cids']  = empty($arPostData['cids']) ? 'all' : implode(',', $arPostData['cids']);
        $arPostData['image'] = imageManipulation($itemID, BANNERS_TABLE, $arrPageData['files_url'], $arrPageData['images_params']);

        if(isset($arPostData['redirectype'])) $arPostData['redirectid'] = 0;
        else                                  $arPostData['redirecturl'] = '';

        if(!empty($arPostData['reset']))  foreach($arPostData['reset'] as $colname=>$val) $arPostData[$colname]=0;

        if(empty($arPostData['createdDate'])) $arPostData['createdDate'] = date('Y-m-d');
        if(empty($arPostData['createdTime'])) $arPostData['createdTime'] = date('H:i:s');
        $arPostData['created'] = "{$arPostData['createdDate']} {$arPostData['createdTime']}";

        if(!empty($arPostData['customcode']) && $arPostData['module']=='image'){
            $arPostData['customcode'] = 'NULL';
        } else if(isset($arPostData['upimage']) && $arPostData['module']=='text'){
            $arPostData['image'] = 'NULL';
            unlinkUnUsedImage($arPostData['upimage'], $arrPageData['files_url'], $arrPageData['images_params']);
        }
        
        if(empty($arPostData['image'])) $arUnusedKeys[] = 'image';

        $result = $DB->postToDB($arPostData, BANNERS_TABLE, $conditions,  $arUnusedKeys, $query_type, ($itemID ? false : true));
        if($result){
            setSessionMessage('Запись успешно сохранена!');
            if(!$itemID && $result && is_int($result)) $itemID = $result;
            Redirect($arrPageData['current_url'].(isset($_POST['submit_add']) ? '&task=addItem' : ((isset($_POST['submit_apply']) && $itemID) ? '&task=editItem&itemID='.$itemID : '')) );
        } else {
            $arrPageData['errors'][] = 'Запись <font color="red">НЕ была сохранена</font>!';
            unlinkUnUsedImage($arPostData['image'], $arrPageData['files_url'], $arrPageData['images_params']);
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
        $item = array_combine_multi($DB->getTableColumnsNames(BANNERS_TABLE), '');
        $item['order']  = getMaxPosition($posid, 'order', 'position', BANNERS_TABLE);
        $item['active'] = 1;
        $item['createdDate'] = date('Y-m-d');
        $item['createdTime'] = date('H:i:s');
    } elseif($itemID) {
        $query = "SELECT * FROM ".BANNERS_TABLE." WHERE id = $itemID LIMIT 1";
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
    
    $item['cids'] = (empty($item['cids']) || $item['cids']=='all') ? array() : explode(',', $item['cids']);

    if(!empty($_POST)) $item = array_merge($item, $_POST);

    // Include Need CSS and Scripts For This Page To Array
    $arrPageData['headCss'][]       = '<link href="/js/jquery/themes/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />';
    $arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.core.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.widget.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.datepicker.js" type="text/javascript"></script>';
    $arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/1251/jquery.ui.datepicker-ru.js" type="text/javascript"></script>';

    $arrPageData['arrBreadCrumb'][] = array('title'=>($task=='addItem' ? ADMIN_ADD_NEW_PAGE : ADMIN_EDIT_PAGE));

} else {
    // Create Order Links
    $arrPageData['arrOrderLinks'] = getOrdersLinks(
            array('default'=>HEAD_LINK_SORT_DEFAULT, 'title'=>HEAD_LINK_SORT_TITLE, 'created'=>HEAD_LINK_SORTDATEADD),
            $arrOrder['get'], $arrPageData['admin_url'].$arrPageData['posid_url'].$arrPageData['modname_url'], 'pageorder', '_');

    // Display Items List Data
    if($posid)   $where[] = "t.position=$posid";
    if($modname) $where[] = "t.module='$modname'";
    $where = !empty($where) ? 'WHERE '. implode(' AND ', $where) : '';
    
    // Total pages and Pager
    $arrPageData['total_items'] = intval(getValueFromDB(BANNERS_TABLE." t", 'COUNT(*)', $where, 'count'));
    $arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $arrPageData['admin_url'].$arrPageData['posid_url'].$arrPageData['modname_url'].$arrPageData['filter_url']);
    $arrPageData['total_pages'] = $arrPageData['pager']['count'];
    $arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
    // END Total pages and Pager

    $order = "ORDER BY ".(!empty($arrOrder['mysql']) ? 't.'.implode(', t.', $arrOrder['mysql']) : "t.position, t.order");
    $limit = "LIMIT {$arrPageData['offset']}, {$arrPageData['items_on_page']}";

    $query = "SELECT t.* FROM `".BANNERS_TABLE."` t $where $order $limit";
    $result = mysql_query($query);
    if(!$result) $arrPageData['errors'][] = "SELECT OPERATIONS: " . mysql_error();
    else {
        $i=0;
        while ($row = mysql_fetch_assoc($result)) {
            $row['idb']        = (++$i%2) ? "body1" : "body2";
            $row['mtitle']     = $arrPageData['arModules'][$row['module']];
            $row['ptitle']     = $arrPageData['arPositions'][$row['position']];
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
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################

