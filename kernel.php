<?php
/*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
defined('WEBlife') or die( 'Restricted access' ); // no direct access


# ##############################################################################
// /// INCLUDE LIST SOME REQUIRED FILES AND INITIAL GLOBAL VARS BLOCK \\\\\\\\\\
require_once('include/functions/base.php');         // 1. Include base functions
require_once('include/functions/image.php');        // 2. Include image functions
require_once('include/functions/menu.php');         // 3. Include menu functions

require_once('include/classes/Cookie.php');         // 1. Include Cookie class file
$Cookie     = new CCookie();
require_once('include/system/SystemComponent.php'); // 2. Include DB configuration file Must be included before other
require_once('include/system/DefaultLang.php');     // 3. Include Languages File
require_once('include/system/tables.php');          // 4. Include DB tables File
require_once('include/classes/mySmarty.php');       // 5. Include mySmarty class
require_once('include/classes/DbConnector.php');    // 6. Include DB class
require_once('include/classes/Captcha.php');        // 7. Include Captcha class
require_once('include/classes/Validator.php');      // 8. Include Text Validator class
require_once('include/classes/Currencies.php');     // 9. Include Currencies class
require_once('include/classes/Banners.php');        //10. Include Banners class
require_once('include/classes/User_agent.php');        //10. Include Banners class
require_once('include/classes/Calendar.php');        //10. Include Banners class
require_once('include/helpers/PHPHelper.php');      //11. Custom PHP functions
require_once('include/helpers/HTMLHelper.php');     //12. Custom HTML functions

$DB         = new DbConnector(); //Initialize DbConnector class
$Captcha    = new Captcha(getIValidatorPefix(), CAPTCHA_TABLE, false);  //Initialize Captcha class
$Validator  = new Validator(); //Initialize Validator class
$smarty     = new mySmarty(TPL_FRONTEND_NAME, WLCMS_DEBUG, WLCMS_SMARTY_ERROR_REPORTING, TPL_FRONTEND_FORSE_COMPILE, TPL_FRONTEND_CACHING); //Initialize mySmarty class
$Currencies = new Currencies();  //Initialize Currencies class
$Banners    = new Banners($UrlWL, true);  //Initialize Banners class
$PHPHelper  = new PHPHelper();  //Initialize PHPHelper class with Custom PHP functions
$HTMLHelper = new HTMLHelper();  //Initialize HTMLHelper class with Custom HTML functions
$User_agent = new User_agent();
$Calendar   = new Calendar();
// /// END INCLUDE LIST SOME REQUIRED FILES AND INITIAL GLOBAL VARS BLOCK \\\\\\
# ##############################################################################


# ##############################################################################
// ////////////////// OPERATION GLOBAL VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// Инициализируем обработчик URL 
$UrlWL->init($DB);
// Initialize Current Category ID
$catid  = $UrlWL->getCategoryId();
// SET from $_GET Global Array Page Offset Var = integer
$page   = $UrlWL->getPageNumber();
// SET from $_GET Global Array AJAX Mode Var = int
$ajax   = $UrlWL->getAjaxMode();
// SET from $_GET Global Array Module Of Page Var = string
$module = $UrlWL->getModuleName();
// //////////////// END OPERATION GLOBAL VARIABLE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


################################################################################
// /////////////////// IMPORTANT CACHE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$cacheID = getCacheId($catid); //cache ID of Smarty compiled template 
if($smarty->caching && $smarty->isCached(getTemplateFileName($ajax, $catid), $cacheID)){
    $smarty->display(getTemplateFileName($ajax, $catid), $cacheID);
    exit();
} // \\\\\\\\\\\\\\\ END IMPORTANT CACHE OPERATIONS ////////////////////////////
# ##############################################################################


################################################################################
// /////////////////// IMPORTANT GLOBAL VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$objUserInfo     = getUserFromSession(); //user info object
$objSettingsInfo = getSettings(); //settings info object
$arLangsUrls     = $UrlWL->createLangsUrls($DB); //Langs Array to redirect
$arrModules      = getModules(); //Modules Array where array key is module name
$arrPageData     = array( //Page data array
                    'catid'         => &$catid,
                    'page'          => &$page,
                    'ajax'          => &$ajax,
                    'itemID'        => 0,    // Item ID
                    'backurl'       => '',
                    'files_url'     => UPLOAD_URL_DIR,
                    'files_path'    => UPLOAD_DIR,
                    'def_img_param' => array('w'=>100, 'h'=>100),
                    'images_params' => array(),
                    'arrOrderLinks' => array(),
                    'arrBreadCrumb' => array(),
                    'items_on_page' => 10,
                    'total_items'   => 0,
                    'total_pages'   => 1,
                    'seo_separator' => ' - ',
                    'css_dir'       => '/css/'.TPL_FRONTEND_NAME.'/',
                    'images_dir'    => '/images/site/'.TPL_FRONTEND_NAME.'/',
                    'headTitle'     => '',
                    'headCss'       => array(),
                    'headScripts'   => array(),
                    'messages'      => getSessionMessages(),
                    'errors'        => getSessionErrors(),
                    'success'       => false
                  );
$arrPageData['offset']              = ($page-1)*$arrPageData['items_on_page'];
$arrPageData['path_arrow']          = '<img src="'.$arrPageData['images_dir'].'arrow.gif" alt="" />';

//user agent specifics
$arrPageData['userAgent']	       = array();
$arrPageData['userAgent']['version']   = $User_agent->version();
$arrPageData['userAgent']['platform']  = $User_agent->platform();
if($User_agent->is_browser()) {
    $arrPageData['userAgent']['agent'] = $User_agent->browser();
    $arrPageData['userAgent']['type']  = 'browser';
} elseif($User_agent->is_mobile()) {
    $arrPageData['userAgent']['agent'] = $User_agent->mobile();
    $arrPageData['userAgent']['type']  = 'mobile';
} elseif ($User_agent->is_robot()) {
    $arrPageData['userAgent']['agent'] = $User_agent->robot();
    $arrPageData['userAgent']['type']  = 'robot';
} elseif ($User_agent->is_referral()) {
    $arrPageData['userAgent']['agent'] = $User_agent->referrer();
    $arrPageData['userAgent']['type']  = 'referrer';
}
// \\\\\\\\\\\\\\\\\ END IMPORTANT GLOBAL VARIABLES ////////////////////////////
################################################################################


################################################################################
// ///////////// INITIALIZE CATEGORY AND BREADCRUMB ARRAYS  \\\\\\\\\\\\\\\\\\\\
// Initialise the Current category array
$arCategory = getItemRow(MAIN_TABLE, '*', "WHERE id={$catid}");
//Anscreen Data From DB
$arCategory['text'] = unScreenData($arCategory['text']);
// Set to Category array accsess variable taked recursively by parent
$arCategory['access'] = canAccess($catid, true);
// Set arPath to Category
$arCategory['arPath'] = $UrlWL->getCategoryNavPath();
// Set breadCrumb to array
$arrPageData['arrBreadCrumb'] = getBreadCrumb($catid, 0, true);
// Set current category module
$module = $arCategory['module'];
// Init Banners By Current Category ID
$Banners->init($catid);
// Set Root Menu ID
$arrPageData['rootID'] = GetRootId($catid);
// Set Root Menu array
$arrPageData['arRootMenu'] = ($arrPageData['rootID']==$catid) ? $arCategory : getItemRow(MAIN_TABLE, '*', "WHERE id={$arrPageData['rootID']}");
// Set Captcha Default site parameters
$Captcha->SetCodeChars(str_split("abcdefghijknmpqrstuvwxyz0123456789"));
$Captcha->SetCodeLength(5);
// Set last site zone usage to session
setZoneToSession();
// \\\\\\\\\\\ END INITIALIZE CATEGORY AND BREADCRUMB ARRAYS ///////////////////
################################################################################


// INCLUDE USER AUTHENTICATION FILE
if(file_exists("include".DS.getAuthFileName().".php")) include("include".DS.getAuthFileName().".php");
else die("Файл аутентификации невозможно подключить. Проверьте наличие файла, пути и правильность его подключения!");

// Check User can Accsess to this page
if(!$arCategory['access'] && !$arrPageData['auth']){
    $ajax ? 
    RedirectAjax($UrlWL->buildItemUrl($arrModules['authorize']), $_SERVER['REQUEST_URI']) : 
        Redirect($UrlWL->buildItemUrl($arrModules['authorize']), $_SERVER['REQUEST_URI']); 
}

// INCLUDE CATEGORY  MODULE
if ($module && file_exists('module'.DS.$module.'.php'))
    include_once('module'.DS.$module.'.php');



# ##############################################################################
// ///////////////////////// LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
if(!empty($_SESSION[MDATA_KNAME])){ // Clear unUsed Session Modules Data
    foreach($_SESSION[MDATA_KNAME] as $mdkey=>$mdvalue){
        if($mdkey==$module || $mdkey=='search') continue;
        unset($_SESSION[MDATA_KNAME][$mdkey]);
    }
}
// /////////////////////// END LOCAL PAGE OPERATIONS \\\\\\\\\\\\\\\\\\\\\\\\\\\
# ##############################################################################


################################################################################
// //////////////// READY PARAMS TO SMARTY FLASH \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$smarty->assign('sessionID',                session_id());
$smarty->assign('Banners',                  $Banners);
$smarty->assign('Currencies',               $Currencies);
$smarty->assign('Captcha',                  $Captcha);
$smarty->assign('UrlWL',                    $UrlWL);
$smarty->assign('lang',                     $lang);
$smarty->assign('arLangsUrls',              $arLangsUrls);
$smarty->assign('arAcceptLangs',            $arAcceptLangs);
$smarty->assign('arrLangs',                 SystemComponent::getAcceptLangs());
$smarty->assign('arCategory',               $arCategory);
$smarty->assign('arrModules',               $arrModules);
$smarty->assign('arrPageData',              $arrPageData);
$smarty->assign('objUserInfo',              $objUserInfo);
$smarty->assign('objSettingsInfo',          $objSettingsInfo);
$smarty->assign('HTMLHelper',               $HTMLHelper);
$smarty->assign('Calendar',                 $Calendar);
// \\\\\\\\\\\\\\\\ END READY PARAMS TO SMARTY FLASH ///////////////////////////
################################################################################


################################################################################
// ///////////// ADDITIONAL DYNAMIC PARAMS TO SMARTY FLASH \\\\\\\\\\\\\\\\\\\\\
// Menus: Main, Top, User, Bottom, etc.    getMenu($type, $pid, $incLevels)
$smarty->assign('mainMenu',             getMenu(1, 0, (strpos(TPL_FRONTEND_NAME, 'simple')!==false ? 1 : 0))); // $type = 1 :  Главное меню
$smarty->assign('subMenu',              getMenu(1, GetRootId($catid))); // $type = 1 :  Главное меню. Подменю
//$smarty->assign('topMenu',              getMenu(2)); // $type = 2 :  Верхнее меню
$smarty->assign('leftMenu',             getMenu(3)); // $type = 3 :  Меню слевой стороны
$smarty->assign('bottomMenu',           getMenu(1, 0, 1)); // $type = 4 :  Нижнее меню !IMPORTENT in this case this menu used us type 1
//$smarty->assign('rightMenu',            getMenu(5)); // $type = 5 :  Меню справой стороны 
//$smarty->assign('catalogMenu',          getMenu(6, $arrModules['catalog']['id'])); // $type = 6 :  Меню каталога
//$smarty->assign('userMenu',             getMenu(7)); // $type = 7 :  Меню пользователя
//$smarty->assign('systemMenu',           getMenu(8)); // $type = 8 :  Системное меню
//$smarty->assign('otherMenu',            getMenu(9)); // $type = 9 :  Другое меню

// \\\\\\\\\\\ END ADDITIONAL DYNAMIC PARAMS TO SMARTY FLASH ///////////////////
################################################################################
