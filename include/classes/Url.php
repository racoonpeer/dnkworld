<?php

/**
 * WEBlife CMS
 * Created on 25.04.2012, 12:20:17
 * Developed by http://weblife.ua/
 */
defined('WEBlife') or die('Restricted access'); // no direct access


/**
 * Description of Url class
 * This class provides methods for create and manage SEO Url for simple accesing it.
 * @author WebLife
 * @copyright 2012
 */
class Url {

    protected $url       = '';
    protected $suffix    = '.html';
    protected $incSuffix = false;
    protected $anchor    = '';
    protected $arPath    = array();
    protected $arParams  = array();

    /**
     * Url::__construct()
     *
     * Object Construct function.
     * @return
     */
    public function __construct($link, $incSuffix, $suffix) {
        if($incSuffix) $this->enableSuffix($suffix);
        $this->url = trim($link);
        $arr = self::ParseUrl($this->url, $this->incSuffix, $this->suffix);
        $this->anchor   = $arr['anchor'];
        $this->arPath   = $arr['arPath'];
        $this->arParams = $arr['arParams'];
    }

    /**
     * Url::__destruct()
     *
     * Object Destruct function.
     * @return
     */
    public function __destruct() {
        ;
    }

    /**
     * UrlWL::getUrl()
     *
     * Get Current Class Url function.
     * @return
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * UrlWL::setUrl()
     *
     * Set Class Url function.
     * @return
     */
    public function setUrl($url='') {
        $this->url = $url;
    }

    /**
     * UrlWL::enableSuffix()
     *
     * Enable Url Suffix Like .html
     */
    public function enableSuffix($suffix) {
        $suffix = trim($suffix);
        if(!empty($suffix)){
            $this->suffix    = $suffix;
            $this->incSuffix = true;
        }
    }

    /**
     * UrlWL::disableSuffix()
     *
     * Disable Url Suffix Like .html
     */
    public function disableSuffix() {
        $this->incSuffix = false;
    }

    /**
     * UrlWL::getSuffix()
     *
     * Get Url Suffix Like .html If Enabled
     */
    public function getSuffix() {
        return $this->incSuffix ? $this->suffix : '';
    }

    /**
     * UrlWL::setPath()
     *
     * Set Path Array function.
     * @return
     */
    public function setPath( array $arPath = array() ) {
        $this->arPath = $arPath;
    }

    /**
     * UrlWL::setPath()
     *
     * Set Path Array function.
     * @return
     */
    public function addToPath( $seo_path ) {
        $seo_path = trim($seo_path);
        if($seo_path!='') $this->arPath[] = $seo_path;
    }

    /**
     * Url::buildUrl()
     *
     * Url Build function.
     * @return String
     */
    public function buildUrl($left_slashed=true, $right_slashed=false) {
        if($this->incSuffix && $right_slashed) $right_slashed = false;
        $ishome = empty($this->arPath);
        $params = self::buildParams($this->arParams);
        $url  = ($ishome || $left_slashed) ? '/' : '';
        $url .= implode('/', $this->arPath);
        if($this->incSuffix)           $url .= $this->suffix;
        if(!$ishome && $right_slashed) $url .= '/';
        if($params!='')                $url .= '?'.$params;
        if($this->anchor!='')          $url .= '#'.$this->anchor;
        return $url;
    }

    /**
     * Url::ParseUrl()
     *
     * Url Parse function.
     * @return array
     */
    public static function ParseUrl($url='', $incSuffix=false, $suffix='') {
        $arr = array('arPath'=>array(), 'arParams'=>array(), 'anchor'=>'');
        if($url!=''){
            if(strpos($url, "#")!==false){
                $arr['anchor'] = end(explode('#', $url));
                $url = str_replace("#{$arr['anchor']}", '', $url);
            }
            $sep = strpos($url, "?");
            if ($sep!==false) {
                $path   = trim(substr($url, 0, $sep));
                $params = (strlen($url)>$sep+1) ? trim(substr($url, $sep+1)) : '';
                if($params!='') parse_str($params, $arr['arParams']);
            } else $path = trim($url);
            $ar = explode('/', $path);
            $cn = count($ar);
            for($i=0; $i<$cn; $i++){
                $ar[$i] = trim($ar[$i]);
                if($ar[$i]=='') continue;
                if($incSuffix && $i==$cn-1) $ar[$i] = str_replace($suffix, '', $ar[$i]);
                $arr['arPath'][] = $ar[$i];
            }
        } return $arr;
    }

    /**
     * Url::buildParams()
     *
     * Build Params String Url function.
     * @return String
     */
    public static function buildParams(array $arParams=array()) {
        $url = array();
        foreach($arParams as $k=>$v){
            $url[] = $k.($v!='' ? '='.$v : '');
        } return (string)implode('&', $url);
    }

    /**
     * Url::encodeString()
     *
     * Encode String to Url view function.
     * @return String
     */
    public static function encodeString($str) {
        // Сначала заменяем "односимвольные" фонемы.
        $str = strtr($str, "абвгдеёзийклмнопрстуфхъыэ", "abvgdeeziyklmnoprstufh'ie");
        $str = strtr($str, "АБВГДЕЁЗИЙКЛМНОПРСТУФХЪЫЭ", "ABVGDEEZIYKLMNOPRSTUFH'IE");
        // Затем - "многосимвольные".
        $str = strtr($str,
            array (
                'Г?'=>'A',  'Г‚'=>'A',  'Д‚'=>'A',  'Г„'=>'A', 'Д†'=>'C', 'Г‡'=>'C', 'ДЊ'=>'C',
                'ДЋ'=>'D',  'Д?'=>'D',  'Г‰'=>'E','Д?'=>'E', 'Г‹'=>'E', 'Дљ'=>'E', 'ГЌ'=>'I',
                'ГЋ'=>'I',  'Д№'=>'L', 'Е?'=>'N', 'Е‡'=>'N', 'Г“'=>'O', 'Г”'=>'O', 'Е?'=>'O',
                'Г–'=>'O',  'Е”'=>'R',  'Е?'=>'R', 'Е '=>'S', 'Ељ'=>'O', 'Е¤'=>'T', 'Е®'=>'U',
                'Гљ'=>'U',  'Е°'=>'U', 'Гњ'=>'U', 'Гќ'=>'Y', 'ЕЅ'=>'Z', 'Е№'=>'Z', 'ГЎ'=>'a',
                'Гў'=>'a',  'Д?'=>'a', 'Г¤'=>'a', 'Д‡'=>'c', 'Г§'=>'c', 'ДЌ'=>'c', 'ДЏ'=>'d',
                'Д‘'=>'d',  'Г©'=>'e', 'Д™'=>'e', 'Г«'=>'e', 'Д›'=>'e',  'Г­'=>'i', 'Г®'=>'i',
                'Дє'=>'l',  'Е„'=>'n', 'Е?'=>'n', 'Гі'=>'o', 'Гґ'=>'o', 'Е‘'=>'o',  'Г¶'=>'o',
                'ЕЎ'=>'s',  'Е›'=>'s', 'Е™'=>'r', 'Е•'=>'r', 'ЕҐ'=>'t', 'ЕЇ'=>'u', 'Гє'=>'u',
                'Е±'=>'u',  'Гј'=>'u', 'ГЅ'=>'y', 'Еѕ'=>'z', 'Еє'=>'z', 'Л™'=>'-', 'Гџ'=>'Ss',
                'Д„'=>'A',  'Вµ'=>'u', 'Ґ'=>'G',  'Ё'=>'Yo', 'Є'=>'E',  'Ї'=>'Yi',  'І'=>'I',
                'і' =>'i',  'ґ'=>'g',  'ё'=>'yo', '№'=>'#', 'є'=>'e',  'ї'=>'yi',  'А'=>'A',
                'Б' =>'B',  'В'=>'V',  'Г'=>'G',  'Д'=>'D',  'Е'=>'E',  'Ж'=>'Zh',  'З'=>'Z',
                'И' =>'I',  'Й'=>'Y',  'К'=>'K',  'Л'=>'L',  'М'=>'M',  'Н'=>'N',   'О'=>'O',
                'П' =>'P',  'Р'=>'R',  'С'=>'S',  'Т'=>'T',  'У'=>'U',  'Ф'=>'F',   'Х'=>'H',
                'Ц' =>'Ts', 'Ч'=>'Ch', 'Ш'=>'Sh', 'Щ'=>'Sch','Ъ'=>'',   'Ы'=>'Yi',  'Ь'=>'',
                'Э' =>'E',  'Ю'=>'Yu', 'Я'=>'Ya', 'а'=>'a',  'б'=>'b',  'в'=>'v',   'г'=>'g',
                'д' =>'d',  'е'=>'e',  'ж'=>'zh', 'з'=>'z',  'и'=>'i',  'й'=>'y',   'к'=>'k',
                'л' =>'l',  'м'=>'m',  'н'=>'n',  'о'=>'o',  'п'=>'p',  'р'=>'r',   'с'=>'s',
                'т' =>'t',  'у'=>'u',  'ф'=>'f',  'х'=>'h',  'ц'=>'ts', 'ч'=>'ch',  'ш'=>'sh',
                'щ' =>'sch','ъ'=>'',   'ы'=>'yi', 'ь'=>'',   'э'=>'e',  'ю'=>'yu',  'я'=>'ya' 
            )
        ); return $str;
    }

    /**
     * Url::stringToUrl()
     *
     * Prepare String to Url function.
     * @return String
     */
    public static function stringToUrl($str) {
        // Кодируем строку и преобразовываем к нижнему регистру
        $str = strtolower(self::encodeString($str));
        // удаляем Экранирующие последовательности
        $str = str_replace(array("\r", "\n", "\t", "\0"), ' ', $str); 
        // заменяем тире на дефиз
        $str = str_replace("–", '-', $str); 
        // Удаляем все лишние символы
        $str = str_replace(array( '?','!',':',';','#','@','$','&','\'','"','~','`','%','^','*',
                                  '(',')','«','»','<','>','+','/','\\',',','.','{','}','[',']','|',
                                  "&quot;","&raquo;","&amp;" ), '', $str); 
        do{ // Заменяем все двойные пробелы на одинарные
            $cnt = 0;
            $str = str_replace('  ', ' ', $str, $cnt); 
        } while($cnt);
        // Заменяем все символы из списка на нижнее подчеркивание
        $str = trim(str_replace(array(' ', ' - ', '_-_'), '_', $str), '_'); 
        do{ // Заменяем все двойные нижние подчеркивания на одинарные
            $cnt = 0;
            $str = str_replace('__', '_', $str, $cnt); 
        } while($cnt);
        // Возвращаем результат
        return $str;
    }

}



/**
 * Description of UrlWL class. This class extend Url class
 * This class provides methods for create and manage SEO UrlWL. 
 * @author WebLife
 * @copyright 2012
 */
class UrlWL extends Url {
    
    const LANG_KEY_NAME  = 'lang';
    const USER_SEOPREFIX = 'user_';
    const LANG_PATH_IDX  = 0;
    const ERROR_CATID    = 2;

    private $lang        = '';
    private $defl        = '';
    private $base        = '';
    private $ajax        = null;
    private $page        = null;
    private $catid       = null;
    private $module      = null;
    private $itemid      = null;
    private $showLang    = false;
    private $arLangs     = array();
    private $arCatPath   = array();
    private $arNavPath   = array();


    /**
     * UrlWL::__construct()
     *
     * Object Construct function.
     * @return
     */
    public function __construct(array $arLangs, $showLang=false, $incSuffix=false, $suffix='') {
        parent::__construct($_SERVER['REQUEST_URI'], $incSuffix, $suffix);
        $this->base     = $_SERVER['SERVER_NAME'];
        $this->showLang = (bool)$showLang;
        $this->arLangs  = $arLangs;
        $this->setDefaultLang();
        switch(WLCMS_ZONE){
            case 'BACKEND':
                if(array_key_exists(self::LANG_KEY_NAME, $_GET) && in_array($_GET[self::LANG_KEY_NAME], $this->arLangs)) 
                    $this->lang = $_GET[self::LANG_KEY_NAME];
                break;
            case 'FRONTEND':
                if(count($this->arParams)) $HTTP_GET_VARS = $_GET = $this->arParams;
                if(array_key_exists(self::LANG_PATH_IDX, $this->arPath) && in_array($this->arPath[self::LANG_PATH_IDX], $this->arLangs)) 
                    $this->lang = $this->arPath[self::LANG_PATH_IDX];
                break;
            default: break;
        }
    }

    /**
     * UrlWL::__destruct()
     *
     * Object Destruct function.
     * @return
     */
    public function __destruct() {
        parent::__destruct();
    }

    /**
     * UrlWL::__clone()
     *
     * Object Clone function.
     * @return
     */
    public function __clone() {
        $this->url       = '';
        $this->lang      = '';
        $this->arPath    = array();
        $this->arCatPath = array();
        $this->arNavPath = array();
    }

    /**
     * UrlWL::init()
     *
     * Object Init function.
     * @return
     */
    public function init( DbConnector $DB ) {
        $errorID  = self::ERROR_CATID;
        $isHome   = true;
        $parentid = $module = $itemid = '';
        foreach($this->arPath as $idx=>$itempath){
            if($idx==self::LANG_PATH_IDX && $this->lang==$itempath) continue;
            $isHome = false;
            if(is_numeric($itempath)) {
                $this->page = intval($itempath);
                continue;
            }
            $query = 'SELECT * FROM `'.MAIN_TABLE.'` WHERE ';
            if($itempath=='index.php')
                 $query .= '`id` = 1 ';
            else $query .= '`seo_path`=\''.$DB->ForSql($itempath).'\''.($parentid ? ' AND `pid`='.$parentid : '').' ';
            $query .= 'LIMIT 1 ';
            $DB->Query($query);
            $item = $DB->fetchAssoc();
            if(!empty($item['id'])){
                $module    = $item['module'];
                $parentid  = intval($item['id']);
                $this->arCatPath[] = $item['seo_path'];
                $item['arPath']    = $this->arCatPath;
                $this->arNavPath[] = $item;
                if($errorID) $errorID = 0;
            } elseif($module){
                switch ($module) {
                    case 'users':
                        $tbl = strtoupper($module).'_TABLE';
                        if(defined($tbl) && strpos($itempath, self::USER_SEOPREFIX)!==FALSE){
                            $DB->Query('SELECT * FROM `'.constant($tbl).'` WHERE `id`=\''.intval(str_replace(self::USER_SEOPREFIX, '', $itempath)).'\' LIMIT 1');
                            $item = $DB->fetchAssoc();
                            if(!empty($item['id'])){
                                $itemid  = intval($item['id']);
                                $item['seo_path'] = self::USER_SEOPREFIX.$item['id'];
                                $this->arNavPath[] = $item;
                            }
                        } break;
                    default:
                        $tbl = strtoupper($module).'_TABLE';
                        if(defined($tbl)){
                            $DB->Query('SELECT * FROM `'.constant($tbl).'` WHERE `seo_path`=\''.$DB->ForSql($itempath).'\' LIMIT 1');
                            $item = $DB->fetchAssoc();
                            if(!empty($item['id'])){
                                $itemid  = intval($item['id']);
                                $this->arNavPath[] = $item;
                            }
                        } break;
                }
            }
        }
        if($errorID && !$isHome){
            $DB->Query('SELECT * FROM `'.MAIN_TABLE.'` WHERE `id`=\''.$errorID.'\' LIMIT 1');
            $item = $DB->fetchAssoc();
            if(!empty($item['id'])){
                $module    = $item['module'];
                $parentid  = intval($item['id']);
                $this->arCatPath[] = $item['seo_path'];
                $item['arPath']    = $this->arCatPath;
                $this->arNavPath[] = $item;
            }
        }
        $this->module = $module;
        $this->catid  = intval($parentid);
        $this->itemid = intval($itemid);
        $this->ajax   = array_key_exists('ajax', $this->arParams) ? 1 : 0;
    }

    /**
     * UrlWL::buildItemUrl()
     *
     * Build Menu Item Url function.
     * @return String
     */
    public function buildItemUrl(array $arCategory, $page=1, $arItem=array(), $params='', $anchor='', $forPager=false) {
        if(!empty($arCategory['redirecturl'])) return $arCategory['redirecturl'];
        if(!empty($arCategory['redirectid']))  $arCategory = $this->GetCategoryById($arCategory['redirectid']);
        if($arCategory['id']==1) return '/';
        
        $arPath = $this->buildCategoryPath($arCategory);
        
        if($this->showLang)       array_unshift($arPath, $this->lang);
        if(!empty($arItem['id'])) $arPath[] = $arItem['seo_path'];
        if($page>1)               $arPath[] = $page;
        
        $arParams = array();
        if($params)                     parse_str($params, $arParams);
        if($arCategory['pagetype']==2)  $arParams['ajax']='';

        $url = implode('/', $arPath);
        if(!$forPager && $this->incSuffix) $url .= $this->suffix;
        if(count($arParams)) $url .= '?'.self::buildParams($arParams);
        if($anchor!='')      $url .= '#'.$anchor;
        return '/'.ltrim($url, '/');
    }

    /**
     * UrlWL::buildCategoryPath()
     *
     * Build Category array Path from Root
     * @return Array
     */
    public function & buildCategoryPath(array & $arCategory) {
        $arPath = array();
        if(!empty($arCategory['arPath'])){
            $arPath = $arCategory['arPath'];
        } else {
            $arPath[] = $arCategory['seo_path'];
            if(!empty($arCategory['pid'])){
                $id = $arCategory['pid'];
                while($id > 0){
                    $query = "SELECT `pid`, TRIM(`seo_path`) `seo_path` FROM `".MAIN_TABLE."` WHERE `id` = {$id} LIMIT 1";
                    $result = mysql_query($query);
                    if(!mysql_num_rows($result)) break;
                    $row = mysql_fetch_assoc($result);
                    array_unshift($arPath, $row['seo_path']);
                    $id = $row['pid'];
                }
            }
            $arCategory['arPath'] = $arPath;
        } return $arPath;
    }

    /**
     * UrlWL::buildPagerUrl()
     *
     * Build Menu Item Url function for Pager.
     * @return String
     */
    public function buildPagerUrl(array $arCategory) {
        return $this->buildItemUrl($arCategory, 1, array(), '', '', true);
    }

    /**
     * UrlWL::GetCategoryById()
     *
     * Get Category Array with SEO Path Array From Root function.
     * @return array
     */
    public function GetCategoryById($id, $withText=false) {
        $arCategory = array();
        if($id > 0){
            $query = "SELECT `id`, `pid`, `redirectid`, `title`, `menutype`, `pagetype`, ".($withText ? "`text`, " : '')." 
                             `module`, `image`, TRIM(`redirecturl`) `redirecturl`, TRIM(`seo_path`) `seo_path`
                        FROM `".MAIN_TABLE."`
                        WHERE `id` = '{$id}' LIMIT 1";
            $result = mysql_query($query);
            if($result && mysql_num_rows($result)>0){
                $arCategory = mysql_fetch_assoc($result);
                $arCategory['arPath'] = array($arCategory['seo_path']);
                $id = $arCategory['pid'];
                while($id > 0){
                    $query = "SELECT `pid`, TRIM(`seo_path`) `seo_path` FROM `".MAIN_TABLE."` WHERE `id` = '{$id}' LIMIT 1";
                    $result = mysql_query($query);
                    if(!mysql_num_rows($result)) break;
                    $row = mysql_fetch_assoc($result);
                    array_unshift($arCategory['arPath'], $row['seo_path']);
                    $id  = $row['pid'];
                }
            }
        } return $arCategory;
    }

    /**
     * UrlWL::strToUrl()
     *
     * Prepare String to Url function.
     * @return String
     */
    public function strToUrl($str, $prefix='item') {
        $str = trim(parent::stringToUrl($str));
        // Проверяем, является ли item seo_path числом, если да, то дописываем значение $prefix
        if(is_numeric($str)) $str = strtolower(trim($prefix)).'_'.$str;
        // Возвращаем результат
        return $str;
    }

    /**
     * UrlWL::cleanUrlFromLangs()
     *
     * Clean Url From Langs function.
     * @return String
     */
    public function & cleanUrlFromLangs($url=''){
        $url = empty($url) ? $this->url : trim($url);
        if(empty($url)) return $url;

        $arReplaceLangs = array();
        switch(WLCMS_ZONE){
            case 'BACKEND':
                foreach($this->arLangs as $ln){
                    $arReplaceLangs[] = '?lang='.$ln;
                    $arReplaceLangs[] = '&lang='.$ln;
                }
                break;
            case 'FRONTEND':
                foreach($this->arLangs as $ln)
                    $arReplaceLangs[] = "/$ln/";
                break;
            default: break;
        } 
        $url = str_replace($arReplaceLangs, '', $url);
        return $url;
    }

    /**
     * UrlWL::createLangsUrls()
     *
     * Create Langs Url Array to redirect function.
     * @return String
     */
    public function & createLangsUrls(DbConnector $DB){
        $arLangsUrls = array();
        switch(WLCMS_ZONE){
            case 'BACKEND':
                $url = $this->cleanUrlFromLangs();
                $lpref = ($url=='/admin.php') ? '?' : '&';
                foreach($this->arLangs as $ln)
                    $arLangsUrls[$ln] = $url.$lpref.'lang='.$ln;
                break;
            case 'FRONTEND':
                foreach($this->arLangs as $ln){
                    if($this->lang==$ln) $url = $this->url;
                    elseif($this->catid>1) {
                        $table  = replaceLang($ln, MAIN_TABLE);
                        $cloned = clone $this;
                        $cloned->setLang($ln);
                        $id = $this->catid;
                        while($id > 0){
                            $DB->Query("SELECT * FROM `{$table}` WHERE `id` = '{$id}' LIMIT 1");
                            $item = $DB->fetchAssoc();
                            $cloned->unShiftToCategoryNavPath($item['seo_path']);
                            $item['arPath'] = $cloned->getCategoryNavPath();
                            $cloned->unShiftToBreadCrumbs($item);
                            $id = $item['pid'];
                        }
                        $arPath = $cloned->getCategoryNavPath();
                        array_unshift($arPath, $ln);
                        if($this->itemid){
                            $DB->Query('SELECT * FROM `'.replaceLang($ln, constant(strtoupper($this->module).'_TABLE')).'` WHERE `id`=\''.$this->itemid.'\' LIMIT 1');
                            $item = $DB->fetchAssoc();
                            if(!empty($item['id'])){
                                switch($this->module) {
                                    case 'users': $item['seo_path'] = self::USER_SEOPREFIX.$item['id']; break;
                                    default: break;
                                }
                                $cloned->addToBreadCrumbs($item);
                                $arPath[] = $item['seo_path'];
                            }
                        }
                        $cloned->setPath($arPath);
                        $url = $cloned->buildUrl();
                        $arLangsUrls[$ln] = $cloned->getUrl();
                    } else $url = '/'.$ln.'/';
                    $arLangsUrls[$ln] = $url;
                } break;
            default: break;
        } return $arLangsUrls;
    }


    /**
     * UrlWL::setDefaultLang()
     *
     * Set Default Site Lang from arLangs.
     * @return
     */
    public function setDefaultLang() {
        $this->defl = reset($this->arLangs);
    }


    /**
     * UrlWL::getDefaultLang()
     *
     * Get Default Site Lang.
     * @return String
     */
    public function getDefaultLang() {
        return $this->defl;
    }

    /**
     * UrlWL::setLang()
     *
     * Set Current Site Lang function.
     * @return
     */
    public function setLang( $lang = '' ) {
        if(in_array($lang, $this->arLangs)) $this->lang = $lang;
    }

    /**
     * UrlWL::getLang()
     *
     * Get Current Site Lang function.
     * @return
     */
    public function getLang() {
        return $this->lang;
    }

    /**
     * UrlWL::setLangs()
     *
     * Set Array Site Langs Keys function.
     * @return
     */
    public function setLangs( array $arLangs = array() ) {
        $this->arLangs = $arLangs;
    }

    /**
     * UrlWL::getLangs()
     *
     * Get array Site Langs Keys function.
     * @return
     */
    public function getLangs() {
        return $this->arLangs;
    }

    /**
     * UrlWL::getBaseUrl()
     *
     * Get Current Base site url function.
     * @return
     */
    public function getBaseUrl($protocol='http://', $setSep=false) {
        return $protocol.$this->base.($setSep ? '/' : '');
    }
    /**
     * UrlWL::getBreadCrumbs()
     *
     * Get array Bread Crumbs function. 
     * @return
     */
    public function getBreadCrumbs() {
        return $this->arNavPath;
    }

    /**
     * UrlWL::addToBreadCrumbs()
     *
     * Add item array to Bread Crumbs Array function. 
     * @return
     */
    public function addToBreadCrumbs(array $item) {
        if(!empty($item)) $this->arNavPath[] = $item;
    }

    /**
     * UrlWL::addToBreadCrumbs()
     *
     * Add item array to Bread Crumbs Array function. 
     * @return
     */
    public function unShiftToBreadCrumbs(array $item) {
        if(!empty($item))array_unshift($this->arNavPath, $item);
    }

    /**
     * UrlWL::getCategoryId()
     *
     * Get Current Category ID function.
     * @return int
     */
    public function getCategoryId() {
        return $this->catid==null ? 1 : $this->catid;
    }

    /**
     * UrlWL::getCategoryId()
     *
     * Get Current Category ID function.
     * @return int
     */
    public function setCategoryId($catid) {
        $this->catid = $catid>0 ? (int)$catid : null;
    }

    /**
     * UrlWL::getCategoryNavPath()
     *
     * Get Current Category Navigation Path Array function.
     * @return int
     */
    public function getCategoryNavPath() {
        return $this->arCatPath;
    }

    /**
     * UrlWL::addToCategoryNavPath()
     *
     * Add string to Category Navigation Path Array function.
     * @return int
     */
    public function addToCategoryNavPath($seo_path) {
        $seo_path = trim($seo_path);
        if($seo_path!='') $this->arCatPath[] = $seo_path;
    }

    /**
     * UrlWL::unShiftToCategoryNavPath()
     *
     * Add string to begin Category Navigation Path Array function.
     * @return int
     */
    public function unShiftToCategoryNavPath($seo_path) {
        $seo_path = trim($seo_path);
        if($seo_path!='') array_unshift($this->arCatPath, $seo_path);
    }

    /**
     * UrlWL::getItemId()
     *
     * Get Current Item ID function.
     * @return int
     */
    public function getItemId() {
        return $this->itemid==null ? 0 : $this->itemid;
    }

    /**
     * UrlWL::getPageNumber()
     *
     * Get Current Page Number function.
     * @return int
     */
    public function getPageNumber() {
        return $this->page==null ? 1 : $this->page;
    }

    /**
     * UrlWL::getAjaxMode()
     *
     * Get Current Page Ajax Mode status value function.
     * @return bool
     */
    public function getAjaxMode() {
        return empty($this->ajax) ? 0 : 1;
    }

    /**
     * UrlWL::getModuleName()
     *
     * Get Current Category Module Name function.
     * @return String
     */
    public function getModuleName() {
        return $this->module==null ? false : $this->module;
    }

}
