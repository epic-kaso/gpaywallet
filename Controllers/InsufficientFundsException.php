<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/6/2014
 * Time: 6:47 AM
 */

class InsufficientFundsException extends Exception {


    function __construct()
    {
        parent::__construct("Insufficent Funds In User Wallet");
    }
}