<?php
/**
 * WEBlife CMS
 * Created on 26.11.2010, 13:02:36
 * Developed by http://weblife.ua/
 */
defined('WEBlife') or die('Restricted access'); // no direct access

/**
 * Description of Validator class
 * @author WebLife
 * @copyright 2010
 */
class Validator {

    protected $errors;

    public function __construct($errors = array()) {
        $this->errors = is_array($errors) ? $errors : !empty($errors) ? array($errors) : array();
    }

    public function validateGeneral($theinput, $description = '') {
        if(trim($theinput) != '') return true;
        $this->errors[] = $description;
        return false;
    }

    public function validateTextOnly($theinput, $description = '') {
        if(preg_match("/^[A-Za-z0-9\?\!\,\.\;\)\:\(\) ]+$/", $theinput)) return true;
        $this->errors[] = $description;
        return false;
    }

    public function validateTextOnlyNoSpaces($theinput, $description = '') {
        if(preg_match("/^[a-zA-Z0-9]+$/", $theinput)) return true;
        $this->errors[] = $description;
        return false;
    }

    public function validatePhone($theinput, $description = '', $minln=7, $maxln=17) {
        if(preg_match("/^[0-9 \-]{{$minln},{$maxln}}$/", $theinput)) return true;
        $this->errors[] = $description;
        return false;
    }

    public function validateLogin($theinput, $description = '', $minln=3, $maxln=40) {
        if(preg_match("/^[a-z0-9_]{{$minln},{$maxln}}$/", $theinput)) return true;
        $this->errors[] = $description;
        return false;
    }

    public function validateEmail($themail, $description = '') {
        if(preg_match("/^[^@ ]+@[^@ ]+\.[^@ \.]+$/", $themail)) return true;
        $this->errors[] = $description;
        return false;
    }

    public function validateNumber($theinput, $description = '') {
        if (is_numeric($theinput)) return true;
        $this->errors[] = $description;
        return false;
    }

    public function validateDate($thedate, $description = '') {
        if (trim($thedate) == '' || strtotime($thedate) === -1) {
            $this->errors[] = $description;
            return false;
        } else return true;
    }

    public function foundErrors() {
        return (count($this->errors) > 0);
    }

    public function listErrors($delim = ' ') {
        return implode($delim,$this->errors);
    }
    
    public function getListedErrors($listType='ul') {
        return '<'.$listType.'><li>'.implode('</li><li>',$this->errors).'</li></'.$listType.'>';
    }

    public function addError($description) {
        $this->errors[] = $description;
    }

    public function clearErrors() {
        $this->errors = array();
    }

}
