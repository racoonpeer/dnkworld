<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access

# ##############################################################################
// ///////////////////// REQUIRED LOCAL PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\
$itemID  = (isset($_GET['itemID']) && intval($_GET['itemID'])) ? intval($_GET['itemID']) : 0;
$item    = array();
$success = null;
// //////////////////// END REQUIRED LOCAL PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ///////////// REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\\
$arrPageData['itemID']        = $itemID;
$arrPageData['headTitle']     = TITLE_SETTINGS.$arrPageData['seo_separator'].$arrPageData['headTitle'];
$arrPageData['current_url']   = $arrPageData['admin_url'];
// ////////// END REQUIRED LOCAL PAGE REINIALIZING VARIABLES \\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
// ////////////////////////// POST AND GET OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\
// Clear Templates
if ($task=='clearTemplates') {
    $result = $smarty->clearAllCompiledFiles();
    if($result) setSessionMessage('Скомпилированные ранее шаблоны удалены!');
    else        setSessionErrors('Ни один файл не был удален с папки компилирования шаблонов!');
    Redirect($arrPageData['current_url']);
}
// Clear Cache
else if ($task=='clearCache') {
    $result = $smarty->clearAllCachedFiles();
    if($result) setSessionMessage('Файлы кеша удалены!');
    else        setSessionErrors('Ни один файл не был удален с папки кеш файлов!');
    Redirect($arrPageData['current_url']);
}
// Repair DataBase Tables
else if ($task=='repairDBTables') {
    $result = 0;
    foreach($DB->listDBTables(true) as $dbTable){
        @mysql_query("LOCK TABLES `{$DB->getDBName()}`.`{$dbTable}` WRITE");
        if(mysql_query("REPAIR TABLE `{$DB->getDBName()}`.`{$dbTable}`")) $result++;
        @mysql_query("UNLOCK TABLES");
        break;
    }
    if($result) setSessionMessage('Таблицы в базе данных успешно восстановлены!');
    else        setSessionErrors('Ни одной таблицы в базе данных не удалось восстановить!');
    Redirect($arrPageData['current_url']);
}
// Optimize DataBase Tables
else if ($task=='optimizeDBTables') {
    $result = 0;
    foreach($DB->listDBTables(true) as $dbTable){
        @mysql_query("LOCK TABLES `{$DB->getDBName()}`.`{$dbTable}` WRITE");
        if(mysql_query("OPTIMIZE TABLE `{$DB->getDBName()}`.`{$dbTable}`")) $result++;
        @mysql_query("UNLOCK TABLES");
    }
    if($result) setSessionMessage('Таблицы в базе данных успешно оптимизированы!');
    else        setSessionErrors('Ни одной таблицы в базе данных не удалось оптимизировать!');
    Redirect($arrPageData['current_url']);
}
// Save SETTINGS data
else if (!empty($_POST)) {
    $Validator->validateGeneral($_POST['websiteName'],      SETTINGS_WEBSITE_NAME);
    $Validator->validateGeneral($_POST['copyright'],        SETTINGS_COPYRIGHT);
    $Validator->validateGeneral($_POST['ownerFirstName'],   SETTINGS_FIRST_NAME);
    $Validator->validateGeneral($_POST['ownerLastName'],    SETTINGS_LAST_NAME);
    $Validator->validateGeneral($_POST['ownerAddress'],     SETTINGS_ADDRESS);
    $Validator->validateEmail(  $_POST['ownerEmail'],       SETTINGS_EMAIL);
    $Validator->validateGeneral($_POST['notifyEmail'],      SETTINGS_NOTIFY_EMAIL);
    $Validator->validateGeneral($_POST['siteEmail'],        SETTINGS_SITE_EMAIL);

    if ($Validator->foundErrors()){
        $success = false;
        $arrPageData['errors'][] = ERROR_PLEASE_INSERT.$Validator->getListedErrors();
    } else {
        $DB->postToDB($_POST, SETTINGS_TABLE, '', array('id'), 'update');
        if( ($success = $DB->getBoolResult()) )
             $arrPageData['messages'][] = DATABASE_SUCCESS;
        else $arrPageData['errors'][]   = ERROR_SAVE_DATA;
    }
}
// \\\\\\\\\\\\\\\\\\\\\\\ END POST AND GET OPERATIONS /////////////////////////
# ##############################################################################


# ##############################################################################
// ///////////////////////// LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
if($success) $objSettingsInfo = getSettings($itemID);

if($success===false) 
     $item = dataApplayFunc($_POST, 'stripslashes');
else $item = getItemRow(SETTINGS_TABLE, '*', $itemID ? 'WHERE id='.$itemID : '');
// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


# ##############################################################################
///////////////////// SMARTY BASE PAGE VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('item', $item);
//\\\\\\\\\\\\\\\\\ END SMARTY BASE PAGE VARIABLES /////////////////////////////
# ##############################################################################

/*
DROP TABLE IF EXISTS `ru_settings`;
CREATE TABLE IF NOT EXISTS `ru_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `websiteName` tinytext,
  `websiteSlogan` tinytext,
  `websiteUrl` tinytext,
  `ownerFirstName` varchar(150) DEFAULT NULL,
  `ownerLastName` varchar(150) DEFAULT NULL,
  `ownerEmail` varchar(150) DEFAULT NULL,
  `ownerAddress` text,
  `notifyEmail` tinytext,
  `siteEmail` tinytext,
  `copyright` text,
  `logo` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;
 */