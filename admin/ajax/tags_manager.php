<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
// SET from $_GET Global Array Item ID Var = integer
$itemID  = (isset($_GET['itemID']) && intval($_GET['itemID'])) ? intval($_GET['itemID']) : 0;
$pmodule = !empty($_GET['pmodule'])                            ? trim($_GET['pmodule'])  : '';
$items   = array(); // Items Array of items Info arrays
// /////////////////////// END OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################

# ##############################################################################
// ///////////// REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\\
$arrPageData['itemID']        = $itemID;
$arrPageData['pmodule']       = $pmodule;
$arrPageData['admin_url']     = $pmodule ? $arrPageData['admin_url'].'&pmodule='.$pmodule : '';
$arrPageData['current_url']   = $arrPageData['admin_url'].$arrPageData['page_url'];
$arrPageData['headTitle']     = TAGS_MANAGER;
$arrPageData['items_on_page'] = 10;
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################

# ##############################################################################
// ////////////////////////// POST AND GET OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\
// Delete Item
if($itemID && $task=='deleteItem') {
    $result = deleteRecords(TAGS_TABLE, ' WHERE `id`='.$itemID);
    if(!$result) {
        $arrPageData['errors'][] = 'Данные не удалось удалить. Возможная причина - <p>MySQL Error Delete: '.mysql_errno().'</b> Error:'.mysql_error().'</p>';
    } elseif ($result) {
	if(deleteRecords(TAGS_TO_ENTRY_TABLE, 'WHERE `tid`='.$itemID)) {
	    setSessionMessage('Запись была успешно удалена!');
	    Redirect($arrPageData['current_url']);
	}
    }
}
// SET Reorder
elseif($task=='updateItems' && !empty($_POST['arItems'])) {
    $updated = 0;
    foreach($_POST['arItems'] as $id=>$arData) {
        if(!empty($arData['title'])) {
            $conditions  = $id ? 'WHERE `id`='.$id : '';
            $query_type  = $id ? 'update'          : 'insert';
            $dbLangsSync = $id ? false             : true;
            $result = $DB->postToDB($arData, TAGS_TABLE, $conditions, array('id'), $query_type, $dbLangsSync);
            if(!$result) {
                $arrPageData['errors'][] = 'Запись ID = '.$id.' <font color="red">НЕ была сохранена</font>!';
            } else { 
                unset($_POST['arItems'][$id]); 
                $updated++; 
            }
        }
    }
    if($updated) {
        $arrPageData['messages'][] = 'Успешно сохранены данные у '.$updated.' записей!';
    }
}
// \\\\\\\\\\\\\\\\\\\\\\\ END POST AND GET OPERATIONS /////////////////////////
# ##############################################################################

// Display Items List Data
$where = "";

// Total pages and Pager
$arrPageData['total_items'] = intval(getValueFromDB(TAGS_TABLE." t", 'COUNT(*)', $where, 'count'));
$arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $arrPageData['admin_url'].$arrPageData['parent_url'].$arrPageData['filter_url']);
$arrPageData['total_pages'] = $arrPageData['pager']['count'];
$arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
// END Total pages and Pager

$order = "ORDER BY t.id";
$limit = "LIMIT {$arrPageData['offset']}, {$arrPageData['items_on_page']}";

$query = "SELECT * FROM `".TAGS_TABLE."` t $where $order $limit";
$result = mysql_query($query);
if(!$result) $arrPageData['errors'][] = "SELECT OPERATIONS: " . mysql_error();
else {
    while ($row = mysql_fetch_assoc($result)) {
        $items[$row['id']] = !empty($_POST['arItems'][$row['id']]) ? $_POST['arItems'][$row['id']] : $row;
    }
}

// Manipulate with empty (row for add new) and POST array
$items[0] = !empty($_POST['arItems'][0]) ? $_POST['arItems'][0] : array_combine_multi($DB->getTableColumnsNames(TAGS_TABLE), '');
// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################

# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('items', $items);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################