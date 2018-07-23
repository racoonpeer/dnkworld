<?php

/**
 * WEBlife CMS
 * Created on 10.10.2011, 12:20:17
 * Developed by http://weblife.ua/
 */
defined('WEBlife') or die('Restricted access'); // no direct access


/**
 * Description of HTMLHelper class
 * This class provides methods for help you to change HTML output, new html format 
 * You can add new methods to help you make php data display correct
 * @author WebLife
 * @copyright 2011
 */
class HTMLHelper {

    public function prepareHeadTitle(array $arCategory) {
        return $arCategory['seo_title'];
    }

    public function prepareCategoryImage(array $arCategory, array $arrModules, $filekey='image', $defimage='default.png') {
        $image = $arCategory[$filekey];
        if(!$image && $arCategory['module'] && !empty($arrModules[$arCategory['module']][$filekey]))
            $image = $arrModules[$arCategory['module']][$filekey];
        return MAIN_CATEGORIES_URL_DIR.($image ? $image : $defimage);
    }

    public function prepareItemsToDisplay($maxItems, $cid=false, $pid=false, $module='news', $table=NEWS_TABLE, $order='') {
        return getItemsToDisplay($maxItems, $cid, $pid, $module, $table, $order);
    }

    public function getSliderItems() {
        return PHPHelper::getSliderItems();
    }
    
    public static function prepareUrlParams($url, $params = array()) {
	if(!empty($params)) {
	    foreach ($params as $key => $value) {
		if(!is_array($value)) {
		    $url .= '&'.$key.'='.$value;
		} else {
		    $url = HTMLHelper::prepareUrlParams($url, $params[$key]);
		}
	    }
	}
	return $url;
    }
    
    public function prepareFilterUrl($url, $arKeys = array(), $inKey = 0, $outKey = 0, $params = '') {
	if($inKey > 0) {
	    $arKeys[] = $inKey;
	}
	if(!empty($arKeys)) {
	    if($outKey > 0) {
		for ($i = 0; $i < count($arKeys); $i++) {
		    if($arKeys[$i] == $outKey) {
			unset($arKeys[$i]);
		    }
		}
	    }
	    if(!empty($arKeys)) {
		$url .= '?filters='.implode('_', $arKeys);
	    }
	}
	if(!empty($params)) {
	    if(!empty($arKeys)) {
		$url .= '&';
	    } else {
		$url .= '?';
	    }
	    $url .= $params;
	}
	
	return $url;
    }
}
