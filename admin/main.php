<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
// SET from $_GET Global Array Item ID Var = integer
$itemID       = (isset($_GET['itemID']) && intval($_GET['itemID'])) ? intval($_GET['itemID']) : 0;
$pid          = (isset($_GET['pid'])    && intval($_GET['pid']))    ? intval($_GET['pid'])    : 0;
$item         = array(); // Item Info Array
$items        = array(); // Items Array of items Info arrays
$arModules    = array(); // Item Modules Array
$arrPageTypes = getRowItemsInKey('pagetype', PAGETYPES_TABLE, "`pagetype`,`name`,`image`,`title_{$lang}` as title", 'WHERE `active`=1', 'ORDER BY `pagetype`');
$arrMenuTypes = getRowItemsInKey('menutype', MENUTYPES_TABLE, "`menutype`,`name`,`image`,`title_{$lang}` as title", 'WHERE `active`=1', 'ORDER BY `menutype`');
$arrRedirects = getCategoriesForRedirect($lang);
$categoryTree = getCategoriesTree($lang, 0, 0, false);
// /////////////////////// END OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////// REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\\
$arrPageData['itemID']        = $itemID;
$arrPageData['pid']           = $pid;
$arrPageData['parent_url']    = $pid ? '&pid='.$pid : '';
$arrPageData['current_url']   = $arrPageData['admin_url'].$arrPageData['parent_url'].$arrPageData['page_url'];
$arrPageData['arrBreadCrumb'] = getBreadCrumb($pid);
$arrPageData['arParent']      = $pid ? getItemRow(MAIN_TABLE, '*', 'WHERE id='.$pid) : array();
$arrPageData['headTitle']     = ADMIN_MAIN_TITLE.$arrPageData['seo_separator'].$arrPageData['headTitle'];
$arrPageData['files_url']     = MAIN_CATEGORIES_URL_DIR;
$arrPageData['files_path']    = prepareDirPath(MAIN_CATEGORIES_DIR, true);
$arrPageData['items_on_page'] = 20;
$arrPageData['def_img_param'] = array('w'=>320, 'h'=>240);
$arrPageData['images_params'] = false; // array(array(addname, width, height), array(addname, width, height)[, ..]);
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ////////////////////////// POST AND GET OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\
// SET Reorder
if($task=='reorderItems' && !empty($_POST)) {
    $result = reorderItems($_POST['arOrder'], 'order', 'id', MAIN_TABLE);
    if($result===true) $arrPageData['messages'][] = 'Новое состояние успешно сохранено!';
    elseif($result)    $arrPageData['errors'][] = $result;
}
// Delete Item
elseif($itemID>10 && $task=='deleteItem') {
    $result = delCategoriesDBLangsSync($itemID, $arrPageData['files_path'], $arrPageData['images_params']);
    if($result===false) $arrPageData['errors'][] = '<p>MySQL Error Delete: '.mysql_errno().'</b> Error:'.mysql_error().'</p>';
    elseif($result)     Redirect($arrPageData['current_url']);
}
// Change Menu Type
elseif($itemID && $task=='changeMenuType' && isset($_GET['status'])) {
    $result = updateRecords(MAIN_TABLE, "`menutype`='{$_GET['status']}'", 'WHERE `id`='.$itemID);
    if($result===false) $arrPageData['errors'][]   = 'Новое состояние <font color="red">НЕ было сохранено</font>! Error Update: '. mysql_error();
    elseif($result)     $arrPageData['messages'][] = 'Новое состояние успешно сохранено!';
}
// Change Page Type
elseif($itemID && $task=='changePageType' && isset($_GET['status']) && $_GET['status']!=8) {
    $result = updateRecords(MAIN_TABLE, "`pagetype`='{$_GET['status']}'", 'WHERE `id`='.$itemID);
    if($result===false) $arrPageData['errors'][]   = 'Новое состояние <font color="red">НЕ было сохранено</font>! Error Update: '. mysql_error();
    elseif($result)     $arrPageData['messages'][] = 'Новое состояние успешно сохранено!';
}
// Set Active Status Item
elseif($itemID && $task=='publishItem' && isset($_GET['status'])) {
    $result = updateRecords(MAIN_TABLE, "`active`='{$_GET['status']}'", 'WHERE `id`='.$itemID);
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
        // добавляем временную метку к сео пути по описанным условиям
        if(empty($_POST['redirecturl']) && !empty($_POST['redirectid']) && (!$itemID || !IsChild($itemID, $_POST['redirectid']))) $_POST['seo_path'] .= '_'.time();
        // Проверяем присуствует ли в базе
        if(getValueFromDB(MAIN_TABLE, 'COUNT(*)', "WHERE `seo_path`='{$_POST['seo_path']}' AND `pid`={$pid}".($itemID ? ' AND `id`<>'.$itemID : ''), 'count')>0){
            $Validator->addError("Такой «SEO Path» уже используется в системе!");
        }
    }
    
    if ($Validator->foundErrors()) {
        $arrPageData['errors'][] = "<font color='#990033'>Пожалуйста, введите правильное значение :  </font>".$Validator->getListedErrors();
    } else {
        $arPostData = $_POST;
        $arPostData['image'] = imageManipulation($itemID, MAIN_TABLE, $arrPageData['files_url'], $arrPageData['images_params']);
        
        if(empty($arPostData['image'])) $arUnusedKeys[] = 'image';

        if(empty($arPostData['redirecturl'])) $arPostData['redirecturl'] = '';
        else $arPostData['redirecturl'] = trim($arPostData['redirecturl']);
        
        if(empty($arPostData['redirectid']) || !empty($arPostData['redirecturl']))  $arPostData['redirectid']  = 0;
        
        $result = $DB->postToDB($arPostData, MAIN_TABLE, $conditions,  $arUnusedKeys, $query_type, ($itemID ? false : true));
        if($result){
            setAccess($itemID, $arPostData['access'], ((isset($arPostData['sub_access']) OR $arPostData['access']==0) ? true : false));
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
if($task=='addItem' || $task=='editItem'){
    if(!$itemID){
        $item = array_combine_multi($DB->getTableColumnsNames(MAIN_TABLE), '');
        $item['pagetype'] = isset($arrPageData['arParent']['pagetype']) ? $arrPageData['arParent']['pagetype'] : '';
        $item['menutype'] = isset($arrPageData['arParent']['menutype']) ? $arrPageData['arParent']['menutype'] : '';
        $item['module']   = isset($arrPageData['arParent']['module'])   ? $arrPageData['arParent']['module']   : '';
        $item['order']    = getMaxPosition($pid, 'order', 'pid', MAIN_TABLE);
        $item['active']   = 1;
        $item['access']   = 1;
        $item['created']  = date('Y-m-d H:i:s');
    } elseif($itemID) {
        $query = "SELECT * FROM ".MAIN_TABLE." WHERE id = $itemID LIMIT 1";
        $result = mysql_query($query);
        if(!$result)
            $arrPageData['errors'][] = "SELECT OPERATIONS: " . mysql_error();
        elseif(!mysql_num_rows($result))
            $arrPageData['errors'][] = "SELECT OPERATIONS: No this Item in DataBase";
        else {
            $item = mysql_fetch_assoc($result);
            $item['submodules']  = $item['module'] ? getValueFromDB(MAIN_TABLE, 'COUNT(*)', " WHERE `module`='{$item['module']}' AND `pid`='{$item['id']}'", 'submodules') : 0;
            $item['arImageData'] = $item['image'] ? getArrImageSize($arrPageData['files_url'], $item['image']) : array();
        }
    }

    if(!empty($_POST)) $item = array_merge($item, $_POST);
    
    $item['arParentModules'] = array();
    if($pid){
        if(!empty($arrPageData['arParent']['module'])) $item['arParentModules'][] = $arrPageData['arParent']['module'];
        if(!empty($arrPageData['arParent']['pid'])){
            $pparentID = $arrPageData['arParent']['pid'];
            while($pparentID){
                $objParent = getItemObj(MAIN_TABLE, '`pid`, `module`', ' WHERE id='.$pparentID);
                $pparentID = $objParent->pid;
                if(!empty($objParent->module)) $item['arParentModules'][] = $objParent->module;
            }
        }
    }
    $item['arMenuType'] = $arrMenuTypes[intval($item['menutype'])];
    $item['arPageType'] = $arrPageTypes[intval($item['pagetype'])];
    $arrPageData['arrBreadCrumb'][] = array('title'=>($task=='addItem' ? ADMIN_ADD_NEW_PAGE : ADMIN_EDIT_PAGE));

    $hndl = opendir(WLCMS_ABS_ROOT.'module/');
    while ($file = readdir($hndl)) {
        if($file!='.' && $file!='..' && getFileExt($file) == 'php')
            $arModules[] = basename($file, '.php');
    } closedir($hndl);

} else {
    // Display Items List Data
    $where = "WHERE t.pid = $pid ";

    // Total pages and Pager
    $arrPageData['total_items'] = intval(getValueFromDB(MAIN_TABLE." t", 'COUNT(*)', $where, 'count'));
    $arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $arrPageData['admin_url'].$arrPageData['parent_url']);
    $arrPageData['total_pages'] = $arrPageData['pager']['count'];
    $arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
    // END Total pages and Pager

    $order = "ORDER BY t.menutype, t.order, t.id";
    $limit = "LIMIT {$arrPageData['offset']}, {$arrPageData['items_on_page']}";

    $query = "SELECT *, (SELECT COUNT(*) FROM `".MAIN_TABLE."` subt WHERE subt.pid = t.id) as childrens 
        FROM `".MAIN_TABLE."` t
        $where $order $limit";
    $result = mysql_query($query);
    if(!$result) $arrPageData['errors'][] = "SELECT OPERATIONS: " . mysql_error();
    else {
        $i=0;
        while ($row = mysql_fetch_assoc($result)) {
            $row['idb']        = (++$i%2) ? "body1" : "body2";
            $row['mn_type']    = intval($row['menutype'])+1;
            $row['pn_type']    = intval($row['pagetype'])+1;
            $row['arMenuType'] = $arrMenuTypes[$row['menutype']];
            $row['arPageType'] = $arrPageTypes[$row['pagetype']];
            $items[]           = $row;
        }
    }
}
// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('item',         $item);
$smarty->assign('items',        $items);
$smarty->assign('arModules',    $arModules);
$smarty->assign('arrPageTypes', $arrPageTypes);
$smarty->assign('arrMenuTypes', $arrMenuTypes);
$smarty->assign('arrRedirects', $arrRedirects);
$smarty->assign('categoryTree', $categoryTree);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################

