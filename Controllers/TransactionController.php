<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/5/2014
 * Time: 9:35 PM
 */

class TransactionController {

    const ERROR_INVALID_USER_WALLET_BALANCE = 100;
    const ERROR_INVALID_WALLET_APP = 101;
    const ERROR_INVALID_MERCHANT = 102;

    const SUCCESS = 200;
    const FAILURE = 300;

    private static function logTransaction(
        $merchant_id,
        $app_id,
        $user_id,
        $amount,
        $meta,
        $transaction_type,
        $status
    ){

        History::create([
            'merchant_id' => $merchant_id,
            'app_id' => $app_id,
            'user_id' => $user_id,
            'transaction_type' => $transaction_type,
            'transaction_amount' => $amount,
            'transaction_meta' => ($meta == null ? 'Debug info' : $meta),
            'transaction_status' => $status
        ]);

    }

    public static function executeTransaction(
        $wallet_app_token,
        $user_id,
        $amount,
        $transaction_type
    ){
        $wallet_app = WalletApp::getAppByToken($wallet_app_token);

        if(!$wallet_app){
            return static::ERROR_INVALID_WALLET_APP;
        }

        $merchant= $wallet_app->merchant;
        $user = User::first($user_id);

        try{
            if($transaction_type == 'debit'){
                $user->debitWallet($amount);
                $merchant->creditWallet($amount);
            }else{
                $user->creditWallet($amount);
                $merchant->debitWallet($amount);
            }

        }catch (InvalidArgumentException $ex){

            static::logTransaction(
                $merchant->id,
                $wallet_app->id,
                $user_id,
                $amount,
                $ex->getMessage(),
                $transaction_type,
                'failed'
            );

            return static::FAILURE;
        }catch(InsufficientFundsException $ex){
            static::logTransaction(
                $merchant->id,
                $wallet_app->id,
                $user_id,
                $amount,
                $ex->getMessage(),
                $transaction_type,
                'failed'
            );

            return static::ERROR_INVALID_USER_WALLET_BALANCE;
        }

        static::logTransaction(
            $merchant->id,
            $wallet_app->id,
            $user_id,
            $amount,
            "api transaction success",
            $transaction_type,
            'completed'
        );

        return static::SUCCESS;


        //get owner of wallet_app, ensure app is active
        //get customer account and ensure valid wallet balance
        //debit customer wallet, credit merchant wallet
        //return success or failure
    }
}