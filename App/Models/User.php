<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/3/2014
 * Time: 12:48 PM
 */

class User extends ActiveRecord\Model{
    static $table_name = "users";


    public function debitWallet($amount){
        if(!is_numeric($amount)){
            throw new InvalidArgumentException;
        }

        if($amount > $this->wallet){
            throw new InsufficientFundsException;
        }

        $this->wallet = $this->wallet - $amount;

        $this->save();
        return true;
    }

    public function creditWallet($amount){
        if(!is_numeric($amount)){
            throw new InvalidArgumentException;
        }
        $this->wallet = $this->wallet + $amount;

        $this->save();
        return true;
    }
}