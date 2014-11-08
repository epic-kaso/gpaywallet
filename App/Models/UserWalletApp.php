<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/5/2014
 * Time: 8:37 PM
 */

class UserWalletApp extends ActiveRecord\Model{
    static $table_name = "user_wallet_app";

    static $belongs_to = array(
        array('user')
    );

    /*
     *  1	id	int(11)
        2	user_id	int(11)
        3	wallet_app_id	int(11)
        4	token	varchar(100)
        5	expire_date	datetime
        6	authorized	tinyint(1)
        7	created_at	datetime
        8	updated_at
     */

    public static function isValidToken($token){
        $today = \Carbon\Carbon::now()->toDateTimeString();
        $app = UserWalletApp::find('first',
            array('conditions' => array("expire_date < ? AND token = ?",$today,$token))
        );

        if(empty($app)){
            return false;
        }
        return $app;
    }
}