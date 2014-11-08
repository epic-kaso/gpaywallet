<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/3/2014
 * Time: 12:48 PM
 */

class WalletApp extends ActiveRecord\Model{
    static $table_name = "wallet_apps";

    static $belongs_to = array(
        array('merchant')
    );

    public static function generateToken()
    {
        $token = random_string('alnum',10);
        $app = WalletApp::first(array('hashcode' => $token));
        if(!empty($app)){
            return static::generateToken();
        }
        return $token;
    }

    public static function isValidAppId($hashcode,$domain_url){
        if(empty($hashcode)){
            return false;
        }

        $app = WalletApp::first(array(
            'hashcode' => $hashcode,
            'active' => true
        ));

        if(empty($app)){
            return false;
        }

        if(!strstr(strtolower($domain_url),strtolower($app->app_url))){
            if(!strstr(strtolower($domain_url),'localhost')){
                return false;
            }else{
                return true;
            }
        }
        return true;
    }


    public static function getAppByToken($token,$active = true){
        $app = WalletApp::first(array(
            'hashcode' => $token,
            'active' => $active
        ));

        if(empty($app)){
            return false;
        }

        return $app;
    }

}