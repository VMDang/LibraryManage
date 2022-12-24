<?php

class BaseHelper
{
    public function __construct(){

    }

    /**
     * checkDatetime function check string valid datetime format
     *
     * @param [string] $strDate
     * @return boolean
     */
    public static function checkDatetime($strDate)
    {
        if (empty($strDate)) {
            return false;
        }
        if (!strtotime($strDate)) {
            return false;
        }
        if (in_array($strDate, array('0000-00-00 00:00:00', '1970-01-01 00:00:00', '0000-00-00', '1970-01-01'))) {
            return false;
        }
        return true;
    }

    /**
     * ajaxResponse function: echo ajax response and die
     *
     * @param string $msg
     * @param boolean $status
     * @param array $data
     * @return void
     */
    public static function ajaxResponse($msg = '', $status = false, $data = array()){
        echo json_encode(array(
            'status' => $status,
            'msg'    => $msg,
            'data'   => $data
        )); die();
    }

    /**
     * getStringBetween function get string between two string
     *
     * @param string $string
     * @param string $start
     * @param string $end
     * @return string $result
     */
    public static function getStringBetween($string = '', $start = '', $end = ''){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
