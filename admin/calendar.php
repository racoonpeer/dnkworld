<?php defined('WEBlife') or die( 'Restricted access' ); // no direct access

$itemID        = (isset($_GET['itemID']) && intval($_GET['itemID'])) ? intval($_GET['itemID']) : 0;
$item          = array(); // Item Info Array
$items         = array(); // Items Array of items Info arrays

$arrPageData['itemID']        = $itemID;
$arrPageData['current_url']   = $arrPageData['admin_url'].$arrPageData['page_url'];
$arrPageData['headTitle']     = CALENDAR_TABLE.$arrPageData['seo_separator'].$arrPageData['headTitle'];
$arrPageData['items_on_page'] = 20;

// SET Reorder
if($task=='reorderItems' && !empty($_POST)) {
    $result = reorderItems($_POST['arOrder'], 'order', 'id', CALENDAR_TABLE);
    if ($result===true) {
	$arrPageData['messages'][] = 'Новое состояние успешно сохранено!';
    } elseif($result) {
	$arrPageData['errors'][] = $result;
    }
}
// Delete Item
elseif($itemID && $task=='deleteItem') {
    $result = deleteRecords(CALENDAR_TABLE, 'WHERE `id`='.$itemID);
    if (!$result) {
	$arrPageData['errors'][] = 'Данные не удалось удалить. Возможная причина - <p>MySQL Error Delete: '.mysql_errno().'</b> Error:'.mysql_error().'</p>';
    } elseif ($result) {
        deleteRecords(CALENDAR_DATES_TABLE, 'WHERE `cid`='.$itemID);
	Redirect($arrPageData['current_url']);
    }
}
// Set Active Status Item
elseif($itemID && $task=='publishItem' && isset($_GET['status'])) {
    $result = updateRecords(CALENDAR_TABLE, "`active`='{$_GET['status']}'", 'WHERE `id`='.$itemID);
    if ($result===false) {
	$arrPageData['errors'][]   = 'Новое состояние <font color="red">НЕ было сохранено</font>! Error Update: '. mysql_error();
    } elseif($result) {
	$arrPageData['messages'][] = 'Новое состояние успешно сохранено!';
    }
}
// Insert Or Update Item in Database
elseif (!empty($_POST) && ($task=='addItem' || $task=='editItem')) {
    $arUnusedKeys = array();
    $query_type   = $itemID ? 'update'            : 'insert';
    $conditions   = $itemID ? 'WHERE `id`='.$itemID : '';

    $Validator->validateGeneral($_POST['title'], 'Вы не ввели названия страницы!!!');
    
    if ($Validator->foundErrors()) {
        $arrPageData['errors'][] = "<font color='#990033'>Пожалуйста, введите правильное значение :  </font>".$Validator->getListedErrors();
    } else {
        $arPostData = $_POST;

        if(empty($arPostData['createdDate'])) {
	    $arPostData['createdDate'] = date('Y-m-d');
	}
        if(empty($arPostData['createdTime'])) {
	    $arPostData['createdTime'] = date('H:i:s');
	}
        $arPostData['created'] = "{$arPostData['createdDate']} {$arPostData['createdTime']}";
        
        $result = $DB->postToDB($arPostData, CALENDAR_TABLE, $conditions,  $arUnusedKeys, $query_type, ($itemID ? false : true));
        if($result){
            setSessionMessage('Запись успешно сохранена!');
            if(!$itemID && $result && is_int($result)) {
		$itemID = $result;
	    }
            
            deleteRecords(CALENDAR_DATES_TABLE, 'WHERE `cid`='.$itemID);
            if(isset($_POST['arDates']) && !empty($_POST['arDates'])) {
                foreach ($_POST['arDates'] as $date) {
                    if(!empty($date)) {
                        $arData = array(
                            'cid'   => $itemID,
                            'day'   => $date
                        );
                        deleteRecords(CALENDAR_DATES_TABLE, 'WHERE `day`="'.$date.'"');
                        $DB->postToDB($arData, CALENDAR_DATES_TABLE);
                    }
                }
            }
            
            Redirect($arrPageData['current_url'].(isset($_POST['submit_add']) ? '&task=addItem' : ((isset($_POST['submit_apply']) && $itemID) ? '&task=editItem&itemID='.$itemID : '')) );
        } else {
            $arrPageData['errors'][] = 'Запись <font color="red">НЕ была сохранена</font>!';
        }
    }
}

// Sorts and Filters block
$arrOrder = getOrdersByKeyExplodeFilteredArray($_GET, 'pageorder', '_');
$arrPageData['filter_url'] = !empty($arrOrder['url']) ? '&'.implode('&', $arrOrder['url']) : '';


if($task=='addItem' || $task=='editItem'){
    if(!$itemID){
        $item = array_combine_multi($DB->getTableColumnsNames(CALENDAR_TABLE), '');
        $item['active'] = 1;
        $item['createdDate'] = date('Y-m-d');
        $item['createdTime'] = date('H:i:s');
    } elseif($itemID) {
        
        $item = getItemRow(CALENDAR_TABLE, '*', 'WHERE `id`='.$itemID);
        
        if(!empty($item)) {
            
            $item['createdDate'] = date('Y-m-d', strtotime($item['created']));
            $item['createdTime'] = date('H:i:s', strtotime($item['created']));
            
            $item['arDates'] = array();
            $select = 'SELECT cd.* FROM `'.CALENDAR_DATES_TABLE.'` cd ';
            $where  = 'WHERE cd.`cid`='.$itemID.' ';
            $order  = 'ORDER BY cd.`day`';
            $query  = $select.$where.$order;
            $result = mysql_query($query);
            if (mysql_num_rows($result) > 0) {
                while ($row = mysql_fetch_assoc($result)) {
                    $item['arDates'][] = $row;
                }
            }
            
        } else {
            $arrPageData['errors'][] = "SELECT OPERATIONS: No this Item in DataBase";
        }
    }
    
    if(!empty($_POST)) {
        $item = array_merge($item, $_POST);
    }

} else {
    // Create Order Links
    $arrPageData['arrOrderLinks'] = getOrdersLinks(
            array('default'=>HEAD_LINK_SORT_DEFAULT, 'title'=>HEAD_LINK_SORT_TITLE, 'created'=>HEAD_LINK_SORTDATEADD),
            $arrOrder['get'], $arrPageData['admin_url'], 'pageorder', '_');

    // Display Items List Data
    $where = "";
    
    // Total pages and Pager
    $arrPageData['total_items'] = intval(getValueFromDB(CALENDAR_TABLE." c", 'COUNT(*)', $where, 'cnt'));
    $arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $arrPageData['admin_url'].$arrPageData['filter_url']);
    $arrPageData['total_pages'] = $arrPageData['pager']['count'];
    $arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
    // END Total pages and Pager

    $order = "ORDER BY c.`created` ";
    $limit = "LIMIT {$arrPageData['offset']}, {$arrPageData['items_on_page']}";

    $query  = "SELECT c.* FROM `".CALENDAR_TABLE."` c $where $order $limit";
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

// Include Need CSS and Scripts For This Page To Array
$arrPageData['headCss'][]       = '<link href="/js/jquery/themes/base/jquery.ui.all.css" type="text/css" rel="stylesheet" />';
$arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.core.js" type="text/javascript"></script>';
$arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.widget.js" type="text/javascript"></script>';
$arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/jquery.ui.datepicker.js" type="text/javascript"></script>';
$arrPageData['headScripts'][]   = '<script src="/js/jquery/ui/1251/jquery.ui.datepicker-ru.js" type="text/javascript"></script>';

# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('item',          $item);
$smarty->assign('items',         $items);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################


/*
 * 
 CREATE TABLE `calendar` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) DEFAULT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_active` (`active`),
  KEY `idx_created` (`created`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;
 * 
 * 
CREATE TABLE `calendar_dates` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) unsigned NOT NULL DEFAULT '0',
  `day` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cid` (`cid`),
  KEY `idx_day` (`day`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;
 * 
 */