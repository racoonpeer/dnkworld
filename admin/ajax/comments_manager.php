<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

# ##############################################################################
// //////////////////////// OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\
// SET from $_GET Global Array Item ID Var = integer
$itemID     = (isset($_GET['itemID']) && intval($_GET['itemID'])) ? intval($_GET['itemID']) : 0;
$pid        = (isset($_GET['pid']) && intval($_GET['pid']))       ? intval($_GET['pid'])    : 0;
$pmodule    = !empty($_GET['pmodule'])                            ? trim($_GET['pmodule'])  : '';
$ptable	    = !empty($pmodule)? $lang.DBTABLE_LANG_SEP.$pmodule: '';
$items      = array(); // Items Array of items Info arrays
// /////////////////////// END OPERATION PAGE VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////// REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\\
$arrPageData['itemID']        = $itemID;
$arrPageData['pid']           = $pid;
$arrPageData['pmodule']       = $pmodule;
$arrPageData['parent_url']    = $pid ? '&pid='.$pid : '';
$arrPageData['admin_url']     = $pmodule ? $arrPageData['admin_url'].'&pmodule='.$pmodule : '';
$arrPageData['current_url']   = $arrPageData['admin_url'].$arrPageData['parent_url'].$arrPageData['page_url'];
$arrPageData['arrParent']     = getItemRow($ptable, '*', 'WHERE id='.$pid);
$arrPageData['headTitle']     = COMMENTS.$arrPageData['seo_separator'].ADMIN_AJAX_MODE;
$arrPageData['items_on_page'] = 5;
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ////////////////////////// POST AND GET OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\
// Delete Item
if($itemID && $task=='deleteItem') {
    $result = deleteRecords(COMMENTS_TABLE, ' WHERE id='.(int)$itemID.' AND `module`="'.$pmodule.'"');
    if(!$result) {
	$arrPageData['errors'][] = 'Данные не удалось удалить. Возможная причина - <p>MySQL Error Delete: '.mysql_errno().'</b> Error:'.mysql_error().'</p>';
    } elseif($result) {
	Redirect($arrPageData['current_url']);
    }
}
// Set Active Status Item
elseif($itemID && $task=='publishItem' && isset($_GET['status'])) {
    $result = updateRecords(COMMENTS_TABLE, "`active`='{$_GET['status']}'", 'WHERE `id`='.(int)$itemID.' AND `module`="'.$pmodule.'"');
    if($result===false) {
	$arrPageData['errors'][]   = 'Новое состояние <font color="red">НЕ было сохранено</font>! Error Update: '. mysql_error();
    } elseif($result) {
	$arrPageData['messages'][] = 'Новое состояние успешно сохранено!';
    }
}
// \\\\\\\\\\\\\\\\\\\\\\\ END POST AND GET OPERATIONS /////////////////////////
# ##############################################################################


# ##############################################################################
// ///////////////////////// LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// Include Need CSS and Scripts For This Page To Array

// Display Items List Data
$where = 'WHERE t.`pid`='.$pid.' AND t.`module`="'.$pmodule.'" ';

// Total pages and Pager
$arrPageData['total_items'] = intval(getValueFromDB(COMMENTS_TABLE." t", 'COUNT(*)', $where, 'count'));
$arrPageData['pager']       = getPager($page, $arrPageData['total_items'], $arrPageData['items_on_page'], $arrPageData['admin_url'].$arrPageData['parent_url'].$arrPageData['filter_url']);
$arrPageData['total_pages'] = $arrPageData['pager']['count'];
$arrPageData['offset']      = ($page-1)*$arrPageData['items_on_page'];
// END Total pages and Pager

$order = 'ORDER BY t.id';
$limit = 'LIMIT '.$arrPageData['offset'].', '.$arrPageData['items_on_page'];

$query = "SELECT * FROM `".COMMENTS_TABLE."` t $where $order $limit";
$result = mysql_query($query);
if(!$result) {
    $arrPageData['errors'][] = "SELECT OPERATIONS: " . mysql_error();
} else {
    $i=0;
    while ($row = mysql_fetch_assoc($result)) {
        $row['idb'] = (++$i%2) ? "body1" : "body2";
        $items[]    = $row;
    }
}

// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('items',        $items);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################

/*
 * 
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `module` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `descr` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
  PRIMARY KEY (`id`),
  KEY `idx_pid` (`pid`),
  KEY `idx_module` (`module`),
  KEY `idx_active` (`active`),
  KEY `idx_created` (`created`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;
 */