<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/3/2014
 * Time: 1:49 PM
 */

class Utils {

    public static function isEmail($text){
        $emailRegex = '/^[a-z0-9\.\-_]+@[a-z0-9\-_]+\.[a-z]{3,5}$/';
        return self::regexEval($emailRegex, $text);
    }

    public static function isValidPassword($text){
        $passwordRegex = '/[a-z0-9\.\-_+]+/';
        return self::regexEval($passwordRegex, $text);
    }

    public static function getValidPrice($string_price){
        return str_replace(',','',str_replace('=N=','',$string_price));
    }

    public static function isValidMerchantId($merchant_id){
        $regex = '/^[0-9]{10}$/';
        return self::regexEval($regex, $merchant_id);
    }

    public static function isValidAppName($app_name){
        $regex = '/^[a-zA-Z_\-]+$/';
        return self::regexEval($regex, $app_name);
    }

    public static function isValidAppUrl($app_url){
        $regex = '/^https?:\/\/([a-zA-Z_\-]+\.)?[a-zA-Z_\-]+(\.[a-zA-Z]{2,5})+$/';
        $response = preg_match($regex,$app_url);
        return $response == 1 ? true : false;
    }

    public static function isValidBankAccount($account_number){
        $regex = '/^[0-9]{10}$/';
        return self::regexEval($regex, $account_number);
    }

    public static function isValidBankName($bank_name){
        $regex = '/^[0-9]{10}$/';
        return self::regexEval($regex, $bank_name);
    }

    /**
     * @param $regex
     * @param $bank_name
     * @return bool
     */
    protected static function regexEval($regex, $name)
    {
        $response = preg_match($regex, $name);

        return $response == 1 ? TRUE : FALSE;
    }
}