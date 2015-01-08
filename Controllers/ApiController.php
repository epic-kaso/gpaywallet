<?php

    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 11/5/2014
     * Time: 6:42 PM
     */
    class ApiController
    {

        public static function initializeRoutes(\Slim\Slim $app)
        {
            /*
             *  wallet_app_id - the Application Id of the wallet app you intend to use

                wallet_transaction_type - The type of transaction you are performing, whether it's a DEBIT or a CREDIT transaction

                wallet_transaction_name (optional) - The name to give hte transaction, for identification purposes

                wallet_transaction_amount - The amount ,in Naira, of the transaction

                wallet_user_token (optional) - This token is used to identify a logged in user, so as to avoid multiple logins

                wallet_user_email (optional) - This email is used to identify a gpay express user, so as to make login easy

                wallet_failure_url

                wallet_success_url
            */

            $app->group('/transaction', function () use ($app) {

                $app->any('/', function () use ($app) {
                    $wallet_app_id = $app->request->params('wallet_app_id', NULL);
                    $domain = $app->request->getHost();
                    $reqUrl = $app->request->getUrl();
                    $wallet_failure_url = $app->request->params('wallet_failure_url', NULL);
                    $wallet_success_url = $app->request->params('wallet_success_url', NULL);
                    $wallet_transaction_type = $app->request->params('wallet_transaction_type', 'debit');
                    $wallet_transaction_name = $app->request->params('wallet_transaction_name', '');
                    $wallet_transaction_amount = $app->request->params('wallet_transaction_amount', NULL);
                    $wallet_user_token = $app->request->params('wallet_user_token', NULL);
                    $wallet_user_email = $app->request->params('wallet_user_token', NULL);

                    // First validate App ID && validate App domain
                    $response = WalletApp::isValidAppId($wallet_app_id, $domain);

                    //When We have An Invalid Wallet ID supplied, Show Error Page
                    if (!$response) {
                        $params = http_build_query([
                            'error' => urlencode('Invalid Request. Bad App Id or UnAuthorized Domain')
                        ]);
                        if (!$wallet_failure_url) {
                            $app->redirect($reqUrl . "?$params", 401);
                        } else {
                            if (!strchr($wallet_failure_url, '?')) {
                                $app->redirect($wallet_failure_url . "?$params", 401);
                            } else {
                                $app->redirect($wallet_failure_url . "&$params", 401);
                            }
                        }
                    }

                    //Do We have a User token Supplied? then Validate and Use
                    // Validate User token
                    $user_wallet = UserWalletApp::isValidToken($wallet_user_token);

                    //If No/Invalid User Token, Show User Login Page
                    if (empty($user_wallet)) {
                        static::showUserLoginPage($app);
                    } else {
                        static::handleTransaction($app,
                            $wallet_app_id,
                            $user_wallet->user->id,
                            $wallet_success_url,
                            $wallet_failure_url,
                            $wallet_transaction_amount,
                            $wallet_transaction_type);
                    }


                    //Make a Transaction Session
                    //Login Consumer User
                    //Perform Transaction
                    //call Redirect URL

                })->name('transaction');


                $app->get('/:id', function ($id) use ($app) {

                })->conditions(array('id' => '[a-zA-Z0-9]{8,16}'));

                $app->delete('/:id', function ($id) use ($app) {

                })->conditions(array('id' => '[a-zA-Z0-9]{8,16}'));

                $app->post('/create', function () use ($app) {

                });

                $app->get('/create', function () use ($app) {

                });

                $app->get('/auth', function () use ($app) {
                    $id = $app->request->params('wallet_app_id');
                    $wallet_app = WalletApp::getAppByToken($id);
                    if (!$wallet_app) {
                        echo 'invalid app';
                    } else {
                        $app->render('Common/Header.php');
                        $app->render('Merchant/Api/auth.php', array('wallet_app' => $wallet_app));
                        $app->render('Common/Footer.php');
                    }

                })->name('user_auth')->conditions(array('id' => '[a-zA-Z0-9]{8,16}'));

                $app->post('/auth', function () use ($app) {

                    $email = trim($app->request->post('email', ''));
                    $password = trim($app->request->post('password', ''));
                    $wallet_app_id = $app->request->params('wallet_app_id', NULL);
                    $domain = $app->request->getHost();
                    $reqUrl = $app->request->getUrl();
                    $wallet_failure_url = $app->request->params('wallet_failure_url', $app->request->getHost());
                    $wallet_success_url = $app->request->params('wallet_success_url', $app->request->getHost());
                    $wallet_transaction_type = $app->request->params('wallet_transaction_type', 'debit');
                    $wallet_transaction_name = $app->request->params('wallet_transaction_name', '');
                    $wallet_transaction_amount = $app->request->params('wallet_transaction_amount', NULL);

                    $data = static::loginUser($email, $password, $wallet_app_id);

                    if (!$data['token']) {
                        $app->redirect($app->request->getUrl());
                    } else {
                        static::handleTransaction($app,
                            $wallet_app_id,
                            $data['user']->id,
                            $wallet_success_url,
                            $wallet_failure_url,
                            $wallet_transaction_amount,
                            $wallet_transaction_type);
                    }
                });

            });


        }

        public static function generateButton(\Slim\Slim $app, $action_url)
        {
            $inputs = $app->request->post();
            $inputs['action'] = $action_url;
            $base_path = $app->config('templates.path');
            $text = static::fetchTemplate($base_path);

            return static::performRegexReplace($text, $inputs);
        }

        private static function fetchTemplate($base_path)
        {
            return file_get_contents("$base_path/Merchant/Api/form-template.php");
        }

        private static function performRegexReplace($text, $inputs = array())
        {
            $patterns = array();
            $values = array();

            foreach ($inputs as $input => $value) {
                $patterns[] = '/\{\{ \$' . $input . ' \}\}/';
                $values[] = $value;
            }

            return preg_replace($patterns, $values, $text);
        }

        private static function showUserLoginPage(\Slim\Slim $app)
        {
            $params = $app->request->params();
            $q = http_build_query($params);
            $app->redirect($app->urlFor('user_auth') . '?' . $q);
        }

        private static function showUserFundWalletPage(\Slim\Slim $app, $user_id)
        {
            $_SESSION[MemberController::$user_id_session] = $user_id;
            $params = $app->request->params();
            $q = http_build_query($params);
            $params['return_url'] = $app->urlFor('transaction') . '?' . $q;
            $app->redirect($app->urlFor('user_fund_wallet') . '?' . $q);
        }

        private static function loginUser($email, $password, $wallet_app_hashcode)
        {
            $user = User::find('first', array('email' => $email, 'password' => md5($password)));
            $wallet_id = WalletApp::first(array('hashcode' => $wallet_app_hashcode));

            if (empty($user)) {
                return FALSE;
            } else {
                $app = UserWalletApp::first(
                    array(
                        'user_id'       => $user->id,
                        'wallet_app_id' => $wallet_id->id,
                    )
                );

                if (empty($app)) {
                    $app = UserWalletApp::create(array(
                        'user_id'       => $user->id,
                        'wallet_app_id' => $wallet_id->id,
                        'token'         => random_string('alnum', 16),
                        'expire_date'   => \Carbon\Carbon::now()->addHour(),
                        'authorized'    => TRUE
                    ));
                } else {
                    $app->token = random_string('alnum', 16);
                    $app->expire_date = \Carbon\Carbon::now()->addHour();
                    $app->save();
                }

                return array('token' => $app->token, 'user' => $user);
            }
        }

        private static function handleTransaction(
            \Slim\Slim $app,
            $wallet_app_id,
            $user_id,
            $wallet_success_url,
            $wallet_failure_url,
            $wallet_transaction_amount,
            $wallet_transaction_type){

            print_r('In handle');
            //Perform The Transaction
            $response =
                TransactionController::executeTransaction(
                    $wallet_app_id,
                    $user_id,
                    $wallet_transaction_amount,
                    $wallet_transaction_type
                );


            //Know the type of response we got
            switch ($response) {
                case TransactionController::SUCCESS:
                    $app->redirect($wallet_success_url);
                    break;
                case TransactionController::FAILURE:
                    $app->redirect($wallet_failure_url);
                    break;
                case TransactionController::ERROR_INVALID_USER_WALLET_BALANCE:
                    static::showUserFundWalletPage($app, $user_id);
                    break;
                default:
                    $app->redirect($wallet_failure_url);
            }
        }

    }