<?php

/**
 * WEBlife CMS
 * Created on 10.10.2011, 12:20:17
 * Developed by http://weblife.ua/
 */
defined('WEBlife') or die('Restricted access'); // no direct access


/**
 * Description of PHPHelper class
 * This class provides methods for help you to change php data, or do sumsing dunamicaly
 * You can add new methods for your needs
 * @author WebLife
 * @copyright 2011
 */
class PHPHelper {
    
    /**
     * <p>������� clearModulesData - CLEAR CATEGORY MODULES DATA. <br/>
     * ������ ���������� ������ �������������� ������ �� ������ ������� ��� �������� ��������. <br/>
     *  ! $params ����������� ����� ����� ������ �� ������ ������� $arrPageData['images_params']; <br/>
     *  ! ������ �������� ���� ��������� ����������� � ��������������� case switch� � ������ � ����� admin; <br/>
     *  ! ���� � ������ ������ ������ ���� ����������;<br/>
     * </p>
     * 
     * @param int $id           ������������� ��������� ���������
     * @param String $module    ������ ���������, ������� ����� �������
     * @param String $filepath  ���� ����� � ������� ������� ������
     */
    public static function clearModulesData($id, $module, $filepath){
        // �������� ���� � ������ ������
        $filepath = prepareDirPath($filepath);
        if(!$filepath) return;
            
        if($id && $module){
            
            switch ($module) {

                case 'catalog': // CATALOG_TABLE
                    $params = array(array("small_", 140, 140),array("middle_", 200, 200));
                    $items = getRowItems(CATALOG_TABLE, '`id`', "`cid` = $id ");
                    while($item = each($items)){
                        $itemID = $item['value']['id'];
                        unlinkImage($itemID, CATALOG_TABLE, $filepath, $params, false);
                        deleteFileFromDB($itemID, CATALOG_TABLE, 'filename', ' WHERE `id`='.$itemID, $filepath, false);
                        $result = deleteRecords(CATALOG_TABLE, ' WHERE id='.$itemID.' LIMIT 1');
                        if($result) deleteItemsAndFilesFromDB('filename', CATALOG_FILES_TABLE, "WHERE `productid`='$itemID'", $filepath);
                    } break;

                case 'gallery': // GALLERY_TABLE
                    $params = array(array("small_", 140, 93));
                    $items  = getRowItems(GALLERY_TABLE, '`id`', "`cid` = $id ");
                    while($item = each($items)){
                        $itemID = $item['value']['id'];
                        unlinkImageLangsSynchronize($itemID, GALLERY_TABLE, $filepath, $params);
                        deleteFileFromDB_AllLangs($itemID, GALLERY_TABLE, 'filename', ' WHERE `id`='.$itemID, $filepath);
                        deleteDBLangsSync(GALLERY_TABLE, ' WHERE id='.$itemID);
                    } break;

                case 'news': // NEWS_TABLE
                    $params = false;
                    $items  = getRowItems(NEWS_TABLE, '`id`', "`cid` = $id ");
                    while($item = each($items)){
                        $itemID = $item['value']['id'];
                        unlinkImageLangsSynchronize($itemID, NEWS_TABLE, $filepath, $params);
                        deleteDBLangsSync(NEWS_TABLE, ' WHERE id='.$itemID);
                    } break;

                case 'video': // VIDEOS_TABLE
                    $params = array(array("small_", 424, 200),array("middle_", 452, 213));
                    $items  = getRowItems(VIDEOS_TABLE, '`id`', "`cid` = $id ");
                    while($item = each($items)){
                        $itemID = $item['value']['id'];
                        unlinkImageLangsSynchronize($itemID, VIDEOS_TABLE, $filepath, $params);
                        deleteFileFromDB_AllLangs($itemID, VIDEOS_TABLE, 'filename', ' WHERE `id`='.$itemID, $filepath);
                        deleteDBLangsSync(VIDEOS_TABLE, ' WHERE id='.$itemID);
                    } break;
                    
                default: break;
            }
        }
    }
    
    public static function getSliderItems() {
        static $items = array();
        if(empty($items)){
            $query  = "SELECT * FROM `".HOMESLIDER_TABLE."` 
                    WHERE `active`=1 AND `image`<>'' ORDER BY `order`, `id`";
            $result = mysql_query($query);
            while ($row = mysql_fetch_assoc($result)) {
                $row['path']  = UPLOAD_URL_DIR.'homeslider/';
                $row['title'] = unScreenData($row['title']);
                $row['descr'] = unScreenData($row['descr']);
                $items[] = $row;
            }
        } return $items;
    }

}
