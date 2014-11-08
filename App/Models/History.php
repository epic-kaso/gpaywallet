<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/3/2014
 * Time: 4:21 PM
 */

class History extends ActiveRecord\Model {

    static $table_name = "history";
    /*
     * merchant_id,
     * $app_id,
     * $user_id,
     * $transaction_type,
     * $transaction_amount,
     * $transaction_meta,
     * $transaction_status,
     * $created_at,
     * $updated_at
     *
     */
}