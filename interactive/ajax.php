<?php
 /*
    WEBlife CMS
    Developed by http://weblife.ua/
*/
define('WEBlife', 1);  //Set flag that this is a parent file

// link = /interactive/ajax.php?zone=[site|admin]&action=[|]
$site_zone =  (isset($_GET['zone']) && !empty($_GET['zone'])) ? addslashes($_GET['zone']) : false;
$action    =  (isset($_GET['action']) && !empty($_GET['action'])) ? addslashes($_GET['action']) : false;

if($site_zone){

    // Define WLCMS_ZONE from $site_zone var 
    switch($site_zone){
        case 'admin': define('WLCMS_ZONE', 'BACKEND');  break;//Set flag that this is a admin area
        case 'site' : define('WLCMS_ZONE', 'FRONTEND'); break;//Set flag that this is a site area
        default:  exit(); break;
    }

    // change to root dir
    chdir("..".DIRECTORY_SEPARATOR);


# ##############################################################################
// /// INCLUDE LIST SOME REQUIRED FILES AND INITIAL GLOBAL VARS BLOCK \\\\\\\\\\
    require_once('include/functions/base.php');         // 1. Include base functions
    require_once('include/functions/image.php');        // 2. Include image functions
    require_once('include/classes/wideimage/WideImage.php');        // 2. Include image functions
    $WI = new WideImage();
    require_once('include/classes/Cookie.php');         // 1. Include Cookie class file
    $Cookie     = new CCookie();
    require_once('include/system/SystemComponent.php'); // 2. Include DB configuration file Must be included before other
    require_once('include/system/DefaultLang.php');     // 3. Include Languages File
    require_once('include/system/tables.php');          // 4. Include DB tables File
    require_once('include/classes/DbConnector.php');    // 5. Include DB class
    $DB         = new ExternalDbConnector();
    $UrlWL->init($DB);
// /// END INCLUDE LIST SOME REQUIRED FILES AND INITIAL GLOBAL VARS BLOCK \\\\\\
# ##############################################################################


################################################################################
// /////////////////// IMPORTANT GLOBAL VARIABLES \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    $objUserInfo     = getUserFromSession($DB->getTableColumnsNames(USERS_TABLE));
    $objSettingsInfo = getSettings();
// \\\\\\\\\\\\\\\\\ END IMPORTANT GLOBAL VARIABLES ////////////////////////////
################################################################################
//    saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_FILES'=>$_FILES, '$_SESSION'=>$_SESSION, '$real__FILE__'=>realpath(__FILE__)), 'log_ajax.txt');
        
    if($action){
        
        //header('Content-type: text/html; charset=windows-1251');
        
        switch($action){
	    
	    case 'modalExpand':
		$type = !empty($_GET['type'])? trim($_GET['type']): 'image';
		$path = !empty($_GET['path'])? trim(addslashes($_GET['path'])): false;
		if($path) {
		    $json = array();
		    $item = array();
		    $items = array();
		    require_once('include/classes/mySmarty.php');
		    switch ($site_zone) {
			case 'admin':
			    $smarty = new mySmarty(TPL_BACKEND_NAME, WLCMS_DEBUG, WLCMS_SMARTY_ERROR_REPORTING, TPL_BACKEND_FORSE_COMPILE, TPL_BACKEND_CACHING);
			    break;
			case 'site':
			    $smarty = new mySmarty(TPL_FRONTEND_NAME, WLCMS_DEBUG, WLCMS_SMARTY_ERROR_REPORTING, TPL_FRONTEND_FORSE_COMPILE, TPL_FRONTEND_CACHING);
			    break;
		    }
		    switch ($type) {
			case 'image':
			    $item = array();
			    $filepath = $_SERVER['DOCUMENT_ROOT'].$path;
			    if(file_exists($filepath)) {
				$item['src'] = $path;
				$item['title'] = @basename($path);
			    }
			    $smarty->assign('item', $item);
			    echo $smarty->fetch('ajax/modal-image.tpl');
			    break;

			default:
			    break;
		    }
		}
		break;
	    
	    // ACTION WITH ajax LiveSearch ---------------------------------------------
	    case 'liveSearch':
		$json = array();
		$searchtext  = !empty($_POST['stext'])  ? iconv('utf-8', 'windows-1251',$_POST['stext'])  : false;
		$searchwhere = !empty($_POST['swhere']) ? addslashes(trim($_POST['swhere'])) : 'all';
		if($searchtext) {
		    $searchtext =  $searchtext;
		    if($searchwhere == 'all' || $searchwhere == 'main'){
			$arrFields = array('title', 'text', 'descr', 'meta_descr', 'meta_key', 'seo_title');
			$query = "SELECT `id` FROM " . MAIN_TABLE . " WHERE (".getSqlStrCondition(getSqlListFilter($arrFields, $searchtext, 'LIKE'), 'OR').") AND `active` = 1 ORDER BY `order` ";
			$result = mysql_query($query);
			if($result){
			    $items       = array();
			    while ($row = mysql_fetch_assoc($result)) {
				$row = $UrlWL->GetCategoryById($row['id'], true);
				$row['descr'] = unScreenData($row['text']);
				$row['name']  = PAGES;
				$items[]=$row;
			    }
			    require_once('include/classes/mySmarty.php');
			    $smarty = new mySmarty(TPL_FRONTEND_NAME, WLCMS_DEBUG, WLCMS_SMARTY_ERROR_REPORTING, TPL_FRONTEND_FORSE_COMPILE, TPL_FRONTEND_CACHING);
			    $smarty->assign('UrlWL', $UrlWL);
			    $smarty->assign('items', $items);
			    $json['output'] = iconv('windows-1251', 'utf-8', $smarty->fetch('ajax/livesearch.tpl'));
			    echo json_encode($json);
			}
		    }
		}
		break;
		
            // ACTION WITH generateSeoPath ---------------------------------------------
            case 'generateSeoPath':
                $path   = !empty($_GET['path'])   ? addslashes(trim($_GET['path']))   : '';
                $prefix = !empty($_GET['prefix']) ? addslashes(trim($_GET['prefix'])) : '';
                if($path) $path = trim($UrlWL->strToUrl(str_conv($path, "UTF-8", "WINDOWS-1251"), $prefix));
//                saveLogDebugFile(array('$path'=>$path, '$_GET'=>$_GET, '$_POST'=>$_POST, '$_SESSION'=>$_SESSION, '$real__FILE__'=>realpath(__FILE__)), "log_{$action}.txt");
                echo json_encode( array( 'seo_path'=>$path ) );
                break;

            // ACTION WITH generatePassword --------------------------------------------------------------------
            case 'generatePassword': // Password
                $length  = !empty($_GET['length']) ? intval($_GET['length']): 12;
                echo json_encode( array( "code"=>randString($length)) );
//                saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_SESSION'=>$_SESSION, '$real__FILE__'=>realpath(__FILE__)), "log_{$action}.txt");
                break;

            // ACTION WITH incrementBannerClick --------------------------------------------------------------------
            case 'incrementBannerClick': // Currency
                $categoryID = !empty($_GET['categoryID']) ? intval($_GET['categoryID'])               : 0;
                $bannerID   = !empty($_GET['bannerID'])   ? intval($_GET['bannerID'])                 : 0;
                $bannerURL  = !empty($_GET['bannerURL'])  ? urldecode(addslashes($_GET['bannerURL'])) : '/';
                require_once('include/classes/Banners.php');
                Banners::incrementClick($bannerID);
//                saveLogDebugFile(array('$_GET'=>$_GET, '$_SESSION'=>$_SESSION, '$real__FILE__'=>realpath(__FILE__)), "log_{$action}.txt");
                Redirect($bannerURL);
                break;

            // ACTION WITH ajaxChangeCurrency --------------------------------------------------------------------
            case 'ajaxChangeCurrency': // Currency
                $cid = !empty($_GET['cid']) ? intval($_GET['cid']) : 0;
                require_once('include/classes/Currencies.php');        // 10.Include Currencies class
                $Currencies = new Currencies();  //Initialize Currencies class
//                saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_SESSION'=>$_SESSION, '$real__FILE__'=>realpath(__FILE__)), "log_{$action}.txt");
                echo json_encode( array( "result"=>(int)$Currencies->setCurrent($cid) ) );
                break;

            // ACTION WITH ajaxCapchaCheck --------------------------------------------------------------------
            case 'ajaxCapchaCheck': // Captcha
                $captchaSID  = !empty($_GET['sid'])  ? trim(addslashes($_GET['sid']))  : '';
                $captchaCode = !empty($_GET['code']) ? trim(addslashes($_GET['code'])) : '';
                require_once('include/classes/Captcha.php');        // 8. Include Captcha class
                $Captcha = new Captcha(getIValidatorPefix(), CAPTCHA_TABLE, false);  //Initialize Captcha class
//                saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_SESSION'=>$_SESSION, '$real__FILE__'=>realpath(__FILE__)), "log_{$action}.txt");
                echo json_encode( array("result"=>(int)$Captcha->CheckCode($captchaCode, $captchaSID, true, false)) );
                break;

            // ACTION WITH ajaxCapchaUpdate --------------------------------------------------------------------
            case 'ajaxCapchaUpdate': // Captcha
                require_once('include/classes/Captcha.php');        // 8. Include Captcha class
                $Captcha    = new Captcha(getIValidatorPefix(), CAPTCHA_TABLE, false);  //Initialize Captcha class
                $Captcha->SetCode();
//                saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_SESSION'=>$_SESSION, '$real__FILE__'=>realpath(__FILE__)), "log_{$action}.txt");
                echo json_encode(array("sid"=>str_conv($Captcha->GetSID()),"code"=>str_conv($Captcha->GetGeneratedCode()),"length"=>$Captcha->GetCodeLength()));
                break;

            // ACTION WITH ajaxUserSessionTimeUpdate -----------------------------------------------------------
            case 'ajaxUserSessionTimeUpdate':
                if($objUserInfo->logined) $_SESSION[(WLCMS_ZONE=='BACKEND' ? 'a' : 's').'user_timeout'] = time();
                echo '1';// Required to trigger onComplete function on Mac OSX
//                saveLogDebugFile(array('$_GET'=>$_GET, '$_SESSION'=>$_SESSION, '$real__FILE__'=>realpath(__FILE__)), "log_{$action}.txt");
                break;

            // ACTION WITH ajaxFilesUpload ---------------------------------------------
            case 'ajaxUserLogOut':
                $success = 0;
                if($objUserInfo->logined)
                    $success = unsetUserFromSession();
                echo json_encode($success);
                break;

            // ACTION WITH ajaxNewsFilesUpload ---------------------------------
            case 'ajaxNewsFilesUpload':
                $userID        = (isset($_GET['PID']) && intval($_GET['PID'])) ? intval($_GET['PID']) : 0;
                $filePrefix    = !empty($_GET['file_prefix']) ? addslashes($_GET['file_prefix']) : "p{$userID}_";
                $targetFolder  = !empty($_POST['folder']) ? prepareDirPath(UPLOAD_DIR.DS.$_POST['folder'].DS.$userID) : '';
                //saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_FILES'=>$_FILES, '$_COOKIE'=>$_COOKIE, '$real__FILE__'=>realpath(__FILE__)), 'log_ajaxUserFilesUpload.txt');
                
                if(isset($_GET['uploadifyData']) && isset($_POST['Upload']) && !empty($_FILES) && $userID){
                    $files_params  = !empty($_GET['files_params']) ? unserialize(base64_decode(urldecode($_GET['files_params']))) : array();
                    $ext           = getFileExt($_FILES['Filedata']['name']);
                    $targetFName   = $filePrefix.strtolower(setFilePathFormat(str_conv($_FILES['Filedata']['name'], "UTF-8", "WINDOWS-1251")));
                    if($targetFolder && in_array($ext, explode(';', str_replace('*.', '', $_POST['fileext'])))){
                        $moved      = move_uploaded_file($_FILES['Filedata']['tmp_name'], $targetFolder.$targetFName);
			$i = 0;
			while($files_params && (list(, list($partiname, $piw, $pih)) = each($files_params))){
			    $i++;
			    $image = WideImage::load($targetFolder.$targetFName);
			    $resized = $image->resize(floor($piw*2), $pih);
			    $cropped = $resized->crop('center', 'middle', $piw, $pih);
			    if($i==1) {
				$fitted = $cropped->resizeCanvas($piw, $pih, 'center', 'middle', $image->allocateColor(255, 255, 255), 'any', true)->saveToFile($targetFolder.$targetFName);
			    } else {
				$fitted = $cropped->resizeCanvas($piw, $pih, 'center', 'middle', $image->allocateColor(255, 255, 255), 'any', true)->saveToFile($targetFolder.$partiname.$targetFName);
			    }
			}
			$fileExists = file_exists($targetFolder.$targetFName);
			if($moved && $fileExists) {
			    $DB->postToDB(array('pid'=>$userID, 'filename'=>$targetFName), NEWSFILES_TABLE);
			}
                    }  echo '1';// Required to trigger onComplete function on Mac OSX

                } else if(isset($_GET['uploadifyCheck'])){
                    $fileArray = array();
                    if($targetFolder){
                        foreach ($_POST as $key => $value) {
                            if ($key == 'folder') continue;
                            $value = strtolower(setFilePathFormat(str_conv($value, "UTF-8", "WINDOWS-1251")));
                            if (file_exists($targetFolder.$filePrefix.$value)) $fileArray[$key] = $value;
                        }
                    } echo json_encode($fileArray);
                } else echo '0';
                break;
            // ACTION WITH ajaxNewsFilesUpload ---------------------------------
            case 'ajaxBlogFilesUpload':
                $userID        = (isset($_GET['PID']) && intval($_GET['PID'])) ? intval($_GET['PID']) : 0;
                $filePrefix    = !empty($_GET['file_prefix']) ? addslashes($_GET['file_prefix']) : "p{$userID}_";
                $targetFolder  = !empty($_POST['folder']) ? prepareDirPath(UPLOAD_DIR.DS.$_POST['folder'].DS.$userID) : '';
                //saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_FILES'=>$_FILES, '$_COOKIE'=>$_COOKIE, '$real__FILE__'=>realpath(__FILE__)), 'log_ajaxUserFilesUpload.txt');
                
                if(isset($_GET['uploadifyData']) && isset($_POST['Upload']) && !empty($_FILES) && $userID){
                    $files_params  = !empty($_GET['files_params']) ? unserialize(base64_decode(urldecode($_GET['files_params']))) : array();
                    $ext           = getFileExt($_FILES['Filedata']['name']);
                    $targetFName   = $filePrefix.strtolower(setFilePathFormat(str_conv($_FILES['Filedata']['name'], "UTF-8", "WINDOWS-1251")));
                    if($targetFolder && in_array($ext, explode(';', str_replace('*.', '', $_POST['fileext'])))){
                        $moved      = move_uploaded_file($_FILES['Filedata']['tmp_name'], $targetFolder.$targetFName);
			$i = 0;
			while($files_params && (list(, list($partiname, $piw, $pih)) = each($files_params))){
			    $i++;
			    $image = WideImage::load($targetFolder.$targetFName);
			    $resized = $image->resize(floor($piw*2), $pih);
			    $cropped = $resized->crop('center', 'middle', $piw, $pih);
			    if($i==1) {
				$fitted = $cropped->resizeCanvas($piw, $pih, 'center', 'middle', $image->allocateColor(255, 255, 255), 'any', true)->saveToFile($targetFolder.$targetFName);
			    } else {
				$fitted = $cropped->resizeCanvas($piw, $pih, 'center', 'middle', $image->allocateColor(255, 255, 255), 'any', true)->saveToFile($targetFolder.$partiname.$targetFName);
			    }
			}
			$fileExists = file_exists($targetFolder.$targetFName);
			if($moved && $fileExists) {
			    $DB->postToDB(array('pid'=>$userID, 'filename'=>$targetFName), BLOGFILES_TABLE);
			}
                    }  echo '1';// Required to trigger onComplete function on Mac OSX

                } else if(isset($_GET['uploadifyCheck'])){
                    $fileArray = array();
                    if($targetFolder){
                        foreach ($_POST as $key => $value) {
                            if ($key == 'folder') continue;
                            $value = strtolower(setFilePathFormat(str_conv($value, "UTF-8", "WINDOWS-1251")));
                            if (file_exists($targetFolder.$filePrefix.$value)) $fileArray[$key] = $value;
                        }
                    } echo json_encode($fileArray);
                } else echo '0';
                break;

            // ACTION WITH ajaxGalleryFilesUpload ---------------------------------
            case 'ajaxGalleryFilesUpload':
                $userID        = (isset($_GET['PID']) && intval($_GET['PID'])) ? intval($_GET['PID']) : 0;
                $filePrefix    = !empty($_GET['file_prefix']) ? addslashes($_GET['file_prefix']) : "p{$userID}_";
                $targetFolder  = !empty($_POST['folder']) ? prepareDirPath(UPLOAD_DIR.DS.$_POST['folder'].DS.$userID) : '';
                //saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_FILES'=>$_FILES, '$_COOKIE'=>$_COOKIE, '$real__FILE__'=>realpath(__FILE__)), 'log_ajaxUserFilesUpload.txt');
                
                if(isset($_GET['uploadifyData']) && isset($_POST['Upload']) && !empty($_FILES) && $userID){
                    $files_params  = !empty($_GET['files_params']) ? unserialize(base64_decode(urldecode($_GET['files_params']))) : array();
                    $ext           = getFileExt($_FILES['Filedata']['name']);
                    $targetFName   = $filePrefix.strtolower(setFilePathFormat(str_conv($_FILES['Filedata']['name'], "UTF-8", "WINDOWS-1251")));
                    if($targetFolder && in_array($ext, explode(';', str_replace('*.', '', $_POST['fileext'])))){
                        $moved      = move_uploaded_file($_FILES['Filedata']['tmp_name'], $targetFolder.$targetFName);
			$i = 0;
			while($files_params && (list(, list($partiname, $piw, $pih)) = each($files_params))){
			    $i++;
			    $image = WideImage::load($targetFolder.$targetFName);
			    $resized = $image->resize(floor($piw*2), $pih);
			    $cropped = $resized->crop('center', 'middle', $piw, $pih);
			    if($i==1) {
				$fitted = $cropped->merge(WideImage::load(UPLOAD_DIR.DS.'watermark.png'), 'center', 'middle', 100)->resizeCanvas($piw, $pih, 'center', 'middle', $image->allocateColorAlpha(0, 0, 0), 'any', true)->saveToFile($targetFolder.$targetFName);
			    } else {
				$fitted = $cropped->resizeCanvas($piw, $pih, 'center', 'middle', $image->allocateColorAlpha(0, 0, 0), 'any', true)->saveToFile($targetFolder.$partiname.$targetFName);
			    }
			}
			$fileExists = file_exists($targetFolder.$targetFName);
			if($moved && $fileExists) {
			    $DB->postToDB(array('pid'=>$userID, 'filename'=>$targetFName), GALLERYFILES_TABLE);
			}
                    }  echo '1';// Required to trigger onComplete function on Mac OSX

                } else if(isset($_GET['uploadifyCheck'])){
                    $fileArray = array();
                    if($targetFolder){
                        foreach ($_POST as $key => $value) {
                            if ($key == 'folder') continue;
                            $value = strtolower(setFilePathFormat(str_conv($value, "UTF-8", "WINDOWS-1251")));
                            if (file_exists($targetFolder.$filePrefix.$value)) $fileArray[$key] = $value;
                        }
                    } echo json_encode($fileArray);
                } else echo '0';
                break;

            // ACTION WITH ajaxUserFilesUpload ---------------------------------
            case 'ajaxUserFilesUpload':
                $userID        = (isset($_GET['UID']) && intval($_GET['UID'])) ? intval($_GET['UID']) : 0;
                $filePrefix    = !empty($_GET['file_prefix']) ? addslashes($_GET['file_prefix']) : "u{$userID}_";
                $targetFolder  = !empty($_POST['folder']) ? prepareDirPath(UPLOAD_DIR.DS.$_POST['folder']) : '';
                //saveLogDebugFile(array('$_GET'=>$_GET, '$_POST'=>$_POST, '$_FILES'=>$_FILES, '$_COOKIE'=>$_COOKIE, '$real__FILE__'=>realpath(__FILE__)), 'log_ajaxUserFilesUpload.txt');
                
                if(isset($_GET['uploadifyData']) && isset($_POST['Upload']) && !empty($_FILES) && $userID){
                    $files_params  = !empty($_GET['files_params']) ? unserialize(base64_decode(urldecode($_GET['files_params']))) : array();
                    $ext           = getFileExt($_FILES['Filedata']['name']);
                    $targetFName   = $filePrefix.strtolower(setFilePathFormat(str_conv($_FILES['Filedata']['name'], "UTF-8", "WINDOWS-1251")));
                    if($targetFolder && in_array($ext, explode(';', str_replace('*.', '', $_POST['fileext'])))){
                        $fileExists = file_exists($targetFolder.$targetFName);
                        $moved      = move_uploaded_file($_FILES['Filedata']['tmp_name'], $targetFolder.$targetFName);
                        while($files_params && (list(, list($partiname, $piw, $pih)) = each($files_params))){
                            createThumb($targetFolder.$targetFName, $piw, $pih, $targetFolder.$partiname.$targetFName);
                        }
                        if($moved && !$fileExists) $DB->postToDB(array('uid'=>$userID, 'filename'=>$targetFName), USERFILES_TABLE);
                    }  echo '1';// Required to trigger onComplete function on Mac OSX

                } else if(isset($_GET['uploadifyCheck'])){
                    $fileArray = array();
                    if($targetFolder){
                        foreach ($_POST as $key => $value) {
                            if ($key == 'folder') continue;
                            $value = strtolower(setFilePathFormat(str_conv($value, "UTF-8", "WINDOWS-1251")));
                            if (file_exists($targetFolder.$filePrefix.$value)) $fileArray[$key] = $value;
                        }
                    } echo json_encode($fileArray);
                } else echo '0';
                break;

            // ACTION WITH ajaxCatalogImagesUpload -------------------------------------
            case 'ajaxCatalogImagesUpload':                
                if(isset($_POST['Upload']) && isset($_GET['uploadifyData']) && !empty($_FILES)){
                    $productID      = (isset($_GET['productID']) && intval($_GET['productID'])) ? intval($_GET['productID']) : false;
                    $targetFolder   = !empty($_GET['folder']) ? prepareDirPath(UPLOAD_DIR.DS.$_GET['folder']) : false;
                    $arImageParams  = !empty($_GET['images_params']) ? unserialize(base64_decode(urldecode($_GET['images_params']))) : false;
                    if(!empty($_GET['def_img_param'])){
                        $arDefImgParams =  unserialize(base64_decode(urldecode($_GET['def_img_param'])));
                        $_POST['filename_w'] = $arDefImgParams['w'];
                        $_POST['filename_h'] = $arDefImgParams['h'];
                    }
                    if($productID && $targetFolder){
                        $_FILES['filename']['name'] = str_conv($_FILES['filename']['name'], "UTF-8", "WINDOWS-1251");
                        $targetFName = imageManipulation(0, PRODUCT_FILES_TABLE, $targetFolder, $arImageParams, 'filename');
                        if($targetFName && !$DB->postToDB(array('productid'=>$productID, 'filename'=>$targetFName), PRODUCT_FILES_TABLE)){
                            unlinkUnUsedImage($targetFName, $targetFolder, $arImageParams);
                        } elseif(!getValueFromDB(PRODUCT_FILES_TABLE, '`id`', "WHERE `active`='1' AND `isdefault`='1' AND `productid`='$productID'", 'id')){
                            updateRecords(PRODUCT_FILES_TABLE, "`isdefault`='1'", "WHERE `active`='1' AND `isdefault`='0' AND `productid`='$productID' ORDER BY `order`,`id` LIMIT 1");
                        }
                    }  // saveLogDebugFile(array('$arImageParams'=>$arImageParams, '$_GET'=>$_GET, '$_POST'=>$_POST, '$_FILES'=>$_FILES, '$targetFolder'=>$targetFolder, '$real__FILE__'=>realpath(__FILE__)), 'log_upload.txt');
                    echo '1';// Required to trigger onComplete function on Mac OSX
                }
                break;

            // ACTION WITH ajaxFilesUpload ---------------------------------------------
            case 'ajaxCatalogFilesUpload':
                if(isset($_POST['Upload']) && isset($_GET['uploadifyData']) && !empty($_FILES)){
                    $productID = (isset($_GET['productID']) && intval($_GET['productID'])) ? intval($_GET['productID']) : 0;
                    if($productID){
                        $ext          = getFileExt($_FILES['Filedata']['name']);
                        $targetFolder = prepareDirPath(UPLOAD_DIR.DS.$_GET['folder']);
                        $targetFName  = strtolower(setFilePathFormat(str_conv($_FILES['Filedata']['name'], "UTF-8", "WINDOWS-1251")));

                        if($targetFolder && in_array($ext, array('jpg','jpeg','png','gif'))){
                            $fileExists = file_exists($targetFolder.$targetFName);
                            $moved      = move_uploaded_file($_FILES['Filedata']['tmp_name'], $targetFolder.$targetFName);
                            if($moved && !$fileExists) $DB->postToDB(array('productid'=>$productID, 'filename'=>$targetFName), PRODUCT_FILES_TABLE);
                        }
                    }
                    //saveLogDebugFile(array('$_GET'=>$_GET, '$_FILES'=>$_FILES, '$targetFolder'=>$targetFolder, '$targetFName'=>$targetFName, '$real__FILE__'=>realpath(__FILE__)), 'log_upload.txt');
                    echo '1';// Required to trigger onComplete function on Mac OSX
                }
                break;

            // ACTION WITH ajaxCheckFilesUpload ---------------------------------------------
            case 'ajaxCatalogCheckFilesUpload':
                $fileArray = array();
                if(!empty($_POST['folder']) && isset($_GET['uploadifyCheck'])) {
                    $targetFolder = prepareDirPath(UPLOAD_DIR.DS.$_POST['folder']);
                    if($targetFolder){
                        foreach ($_POST as $key => $value) {
                            if ($key == 'folder') continue;
                            $value = strtolower(setFilePathFormat(str_conv($value, "UTF-8", "WINDOWS-1251")));
                            if (file_exists($targetFolder.$value)){
                                $fileArray[$key] = $value;
                            }
                        }
                    }
                }
                //saveLogDebugFile(array('$fileArray'=>$fileArray, '$_GET'=>$_GET, '$_POST'=>$_POST, '$real__FILE__'=>realpath(__FILE__)), 'log_check.txt');
                echo json_encode($fileArray);
                break;

            // ACTION WITH fileDownload FROM private AREA ----------------------
            case 'dbFileBackUpDownload':
                // Cookie dbFileBackUpDownload names
                define('DCOOKIE',      'sxd');

                //variables from GET Array
                $uid = (isset($_GET['uid']) && intval($_GET['uid']) > 0) ? intval($_GET['uid']) : false;
                $file = (isset($_GET['file']) && strlen($_GET['file'])>0) ? trim(urldecode($_GET['file'])) : false;

                if($uid==$objUserInfo->id)
                   $uid=true;
                elseif($Cookie->getCookie(DCOOKIE)!=''){
                    $cUser = explode(":", base64_decode($dCookie->getCookie(DCOOKIE)));
                    $dbUser = $DB->getDBSettings();
                    if ($DB->getDBUser()==$cUser[1] && $DB->getDBPassword()==$cUser[2]) {
                        $uid=true;
                    }
                }

                if( $uid==true && $file && strpos($file, "\0") === FALSE/*Nullbyte hack fix*/){
                    // Make sure program execution doesn't time out
                    // Set maximum script execution time in seconds (0 means no limit)
                    @set_time_limit(0);

                    // Make sure that header not sent by error
                    // Sets which PHP errors are reported
                    @error_reporting(0);

                    // Allow direct file download (hotlinking)?  Empty - allow hotlinking
                    // If set to nonempty value (Example: example.com) will only allow downloads when referrer contains this text
                    $allowed_referrer = $_SERVER['SERVER_NAME'];

                    // Allowed extensions list in format 'extension' => 'mime type'
                    // If myme type is set to empty string then script will try to detect mime type
                    // itself, which would only work if you have Mimetype or Fileinfo extensions
                    // installed on server.
                    $allowed_ext = array(
                        'sql'   => 'text/x-sql', 
                        'bz'    => 'application/x-bzip', 
                        'bz2'   => 'application/x-bzip2', 
                        'boz'   => 'application/x-bzip2', 
                        'gz'    => 'application/x-gzip', 
                        'tgz'   => 'application/x-gzip', 
                        'tar'   => 'application/x-tar', 
                        'tgz'   => 'application/x-tar', 
                        'zip'   => 'application/zip'
                    );
                    
                    // Download base folder, i.e. folder where you keep all user dirs with files for download.
                    $baseFolder = prepareDirPath('backup/');

                    // log file name
                    $log_file = $baseFolder.'downloads.log';

                    // If hotlinking not allowed then make hackers think there are some server problems
                    if ( !empty($allowed_referrer) &&
                         (!isset($_SERVER['HTTP_REFERER']) || strpos(strtoupper($_SERVER['HTTP_REFERER']), strtoupper($allowed_referrer)) === false)
                    ) die("Internal server error. Please contact system administrator.");

                    // Get real file name.
                    // Remove any path info to avoid hacking by adding relative path, etc.
                    $fname = basename($file);

                    // file extension
                    $fext = getFileExt($fname);

                    // check if allowed extension
                    if (!array_key_exists($fext, $allowed_ext)) {
                      die("Not allowed file type.");
                    }


                    $file = $baseFolder.$fname;

                    // if don't exist and isn't file and  can't read them - die
                    if (!file_exists($file) && !is_file($file) && !is_readable($file)) {
                      header ("HTTP/1.0 404 Not Found");
                      exit();
                    }

                    // if Time file last modified mor then SESSION_INACTIVE - die
                    if ((time() - filectime($file)) > SESSION_INACTIVE){
                      $Cookie->del(DCOOKIE);
                      $Cookie->process();
                      header ("HTTP/1.0 404 Not Found");
                      die("Not allowed to download this file more.");
                    }


                    // file size in bytes
                    $fsize = filesize($file);

                    // get mime type
                    if (empty($allowed_ext[$fext])) {
                        $mtype = '';
                        // mime type is not set, get from server settings
                        if (function_exists('mime_content_type')) {
                            $mtype = mime_content_type($file);
                        } else if (function_exists('finfo_file')) {
                            $finfo = finfo_open(FILEINFO_MIME); // return mime type
                            $mtype = finfo_file($finfo, $file);
                            finfo_close($finfo);
                        }
                        if ($mtype == '') {
                            $mtype = "application/force-download";
                        }
                    } else  $mtype = $allowed_ext[$fext]; // get mime type defined by admin

                    // Browser will try to save file with this filename, regardless original filename.
                    // You can override it if needed.

                    // remove some bad chars
                    $asfname = str_replace(array('"',"'",'\\','/'), '', $fname);
                    if ($asfname === '') $asfname = 'NoName'.'.'.$fext;

                    // set headers
                    header("Pragma: public");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-Type: $mtype");
                    header("Content-Disposition: attachment; filename=\"$asfname\"");
                    header("Content-Transfer-Encoding: binary");
                    header("Content-Length: " . $fsize);

                    // download
                    // @readfile($file);
                    $file = @fopen($file, "rb");
                    if($file) {
                        while(!feof($file)) {
                            print(fread($file, 1024 * 8));
                            flush();
                            if( connection_status()!=0 ) {
                                @fclose($file);
                                die();
                            }
                        } @fclose($file);
                    }

                    // log downloads
                    if (!empty($log_file)){
                        $f = @fopen($log_file, 'a+');
                        if ($f) {
                          @fputs($f, date("m.d.Y g:ia")."  ".$_SERVER['REMOTE_ADDR']."  ".$folder."  ".$fname."\n");
                          @fclose($f);
                          @chmod($log_file, 0775);
                        }
                    }

                } else { die(); }
                break;

            default:
                exit();
                break;
        }
    }
}
