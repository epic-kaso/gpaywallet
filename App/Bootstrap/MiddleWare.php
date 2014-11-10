<?php

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 11/3/2014
     * Time: 12:30 PM
     */
    class MiddleWare
    {

        public static function authenticateUser()
        {
            if (!isset($_SESSION[MemberController::$user_id_session])) {
                $app = \Slim\Slim::getInstance();
                $app->flash('error', 'Login required');
                $app->redirect('/api/v1/user/login');
            }

            $user = $_SESSION[MemberController::$user_id_session];
            if (empty($user)) {
                $app = \Slim\Slim::getInstance();
                $app->flash('error', 'Login required');
                $app->redirect('/api/v1/user/login');
            }
        }

        public static function guestUser()
        {
            if (!isset($_SESSION[MemberController::$user_id_session])) {
                return;
            }

            $user = $_SESSION[MemberController::$user_id_session];
            if (!empty($user)) {
                $app = \Slim\Slim::getInstance();
                $app->flash('error', 'You need to Logout First');
                $app->redirect('/api/v1/user/wallet/balance');
            }
        }

        public static function authenticateMerchant()
        {
            if (!isset($_SESSION[MerchantController::$merchant_id_session])) {
                $app = \Slim\Slim::getInstance();
                $app->flash('error', 'Login required');
                $app->redirect('/api/v1/merchant/login');
            }

            $user = $_SESSION[MerchantController::$merchant_id_session];
            if (empty($user)) {
                $app = \Slim\Slim::getInstance();
                $app->flash('error', 'Login required');
                $app->redirect('/api/v1/merchant/login');
            }
        }

        public static function guestMerchant()
        {
            if (!isset($_SESSION[MerchantController::$merchant_id_session])) {
                return;
            }

            $user = $_SESSION[MerchantController::$merchant_id_session];
            if (!empty($user)) {
                $app = \Slim\Slim::getInstance();
                $app->flash('error', 'You need to Logout First');
                $app->redirect('/api/v1/merchant/');
            }
        }

        public static function isMerchantProfileComplete()
        {
            if (!isset($_SESSION[MerchantController::$merchant_id_session])) {
                $app = \Slim\Slim::getInstance();
                $app->flash('error', 'Login required');
                $app->redirect('/api/v1/merchant/login');
            }

            $user = $_SESSION[MerchantController::$merchant_id_session];
            if (empty($user)) {
                $app = \Slim\Slim::getInstance();
                $app->flash('error', 'Login required');
                $app->redirect('/api/v1/merchant/login');
            } else {
                $m_user = Merchant::find($user);
                if (!$m_user->is_profile_complete) {
                    $app = \Slim\Slim::getInstance();
                    $app->flash('error', 'Please Complete your Profile');
                    $app->redirect('/api/v1/merchant/profile/edit');
                }
            }
        }


        public static function user_id()
        {
            if (!isset($_SESSION[MemberController::$user_id_session])) {
                return null;
            }

            return $_SESSION[MemberController::$user_id_session];
        }


    }

