<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/3/2014
 * Time: 4:23 PM
 */

class Merchant extends ActiveRecord\Model {

    /*
     *  TABLE COLUMNS
     * ---------------
     *
     * merchant_id
     * account_number
     * bank_name
     * password
     *
     */
    static $table_name = "merchants";

    static $attr_protected = array('merchant_id');

    public function creditWallet($amount){
        if(!is_numeric($amount)){
            throw new InvalidArgumentException;
        }
        $this->wallet = $this->wallet + $amount;

        $this->save();
        return true;
    }

    public function debitWallet($amount){
        if(!is_numeric($amount) || $amount > $this->wallet){
            throw new InvalidArgumentException;
        }

        $this->wallet = $this->wallet - $amount;

        $this->save();
        return true;
    }
}