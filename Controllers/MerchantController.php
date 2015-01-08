<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/3/2014
 * Time: 4:08 PM
 */

class MerchantController {

    public static $merchant_id_session = 'current_merchant_id';

    public static $isMerchantProfileComplete = array('MiddleWare', 'isMerchantProfileComplete');

    public static function initializeMerchantRoutes(
        \Slim\Slim $app, $authenticateMerchant, $guestMerchant)
    {
        $isMerchantProfileComplete = static::$isMerchantProfileComplete;

        $app->group('/merchant',
            function () use ($app, $authenticateMerchant, $guestMerchant, $isMerchantProfileComplete) {

                $app->get('/', $authenticateMerchant, $isMerchantProfileComplete, function () use ($app) {
                    $merchant_id = static::merchant_id();
                    $merchant = Merchant::first($merchant_id);

                    $history = History::find('all', array(
                            'conditions' => array('merchant_id = ?', $merchant_id),
                            'limit'      => '10')
                    );

                $app->render('Common/AuthHeader.php');
                $app->render('Merchant/Account/Index.php',
                    array(
                        'apps'         => WalletApp::find('all',
                            array('merchant_id' => $merchant_id)),
                        'base_app_url' => '/api/v1/merchant/apps/',
                        'history'      => $history,
                        'merchant'     => $merchant
                    )
                );
                $app->render('Common/Footer.php');
            })->name('merchant_home');

                $app->group('/wallet', $authenticateMerchant, $isMerchantProfileComplete, function () use ($app) {

                $app->get('/balance', function () use ($app) {
                    $merchant_id = static::merchant_id();
                    $merchant = Merchant::first($merchant_id);
                    $history = History::find('all', array(
                            'conditions' => array('merchant_id = ?', $merchant_id))
                    );

                    $app->render('Common/AuthHeader.php');
                    $app->render('Merchant/Wallet/Balance.php',
                        array(
                            'merchant' => $merchant,
                            'history'  => $history
                        ));
                    $app->render('Common/Footer.php');

                })->name('merchant_wallet_balance');

                $app->get('/withdraw-funds', function () use ($app) {
                    $merchant_id = static::merchant_id();
                    $merchant = Merchant::first($merchant_id);

                    $app->render('Common/AuthHeader.php');
                    $app->render('Merchant/Wallet/Withdraw.php', array(
                        'image_url'   => '/Public/images/logo.png',
                        'success_url' => $app->urlFor('fund_success_url'),
                        'failure_url' => $app->urlFor('fund_failure_url'),
                        'merchant'    => $merchant
                    ));
                    $app->render('Common/Footer.php');
                });

                $app->get('/history', function () use ($app) {
                    $merchant_id = static::merchant_id();
                    $merchant = Merchant::first($merchant_id);
                    $history = History::find('all', array(
                            'conditions' => array('merchant_id = ?', $merchant_id))
                    );

                    $app->render('Common/AuthHeader.php');
                    $app->render('Merchant/Wallet/History.php',
                        array(
                            'merchant' => $merchant,
                            'history'  => $history
                        ));
                    $app->render('Common/Footer.php');
                });

            });

                $app->get('/apps', $authenticateMerchant, $isMerchantProfileComplete, function () use ($app) {
                $app->render('Common/AuthHeader.php');
                $app->render('Merchant/Apps/Index.php',array(
                    'apps' => WalletApp::find('all',array('merchant_id'=>static::merchant_id())),
                    'base_app_url' => '/api/v1/merchant/apps/'
                ));
                $app->render('Common/Footer.php');
            });

                $app->get('/apps/api-doc', $authenticateMerchant, $isMerchantProfileComplete, function () use ($app) {
                $app->render('Common/AuthHeader.php');

                $app->render('Merchant/Api/doc.php', array(
                    'apps' => WalletApp::find('all',array('merchant_id'=>static::merchant_id())),
                    'base_app_url' => '/api/v1/merchant/apps/'
                ));
                $app->render('Common/Footer.php');
            });

                $app->get('/apps/generate-button', $authenticateMerchant, $isMerchantProfileComplete, function () use ($app) {
                $app->render('Common/AuthHeader.php');

                $app->render('Merchant/Api/index.php', array(
                    'apps' => WalletApp::find('all',array('merchant_id'=>static::merchant_id())),
                    'base_app_url' => '/api/v1/merchant/apps/'
                ));
                $app->render('Common/Footer.php');
            });

                $app->post('/apps/generate-button', $authenticateMerchant, $isMerchantProfileComplete, function () use ($app) {
                $response = ApiController::generateButton($app,'/api/v1/transaction');

                $app->render('Common/AuthHeader.php');
                $app->render('Merchant/Api/View.php',array('response'=>$response));
                $app->render('Common/Footer.php');
            });

                $app->get('/apps/create', $authenticateMerchant, $isMerchantProfileComplete, function () use ($app) {
                $app->render('Common/AuthHeader.php');
                $app->render('Merchant/Apps/Create.php');
                $app->render('Common/Footer.php');
            });

                $app->post('/apps/create', $authenticateMerchant, $isMerchantProfileComplete, function () use ($app) {
                $app_name = $app->request->post('app_name');
                $app_url =  $app->request->post('app_url');
                $app_description =  $app->request->post('app_description');

                $app_id = static::createApp(
                    $app_name,
                    $app_url,
                    $app_description,
                    $app
                );
                if(
                    $app_id
                ){
                    $app->flash('message','Successfully created app');
                    $app->redirect('/api/v1/merchant/apps/'.$app_id);
                }
            });

                $app->get('/apps/:id', $authenticateMerchant, $isMerchantProfileComplete, function ($id) use ($app) {

                $wallet_app = WalletApp::first(array(
                    'hashcode' => $id
                ));

                    $merchant_id = static::merchant_id();
                    $merchant = Merchant::first($merchant_id);

                if(!$wallet_app){
                    echo 'invalid app id';
                }else{
                    $data = array();
                    $data['app'] = $wallet_app;
                    $data['users'] = UserWalletApp::count(array('conditions' => array('wallet_app_id = ?', $wallet_app->id)));
                    $data['transactions'] = History::count(array('conditions' => array('app_id = ?', $wallet_app->id)));

                    $app->render('Common/AuthHeader.php');
                    $app->render('Merchant/Apps/View.php', $data);
                    $app->render('Common/Footer.php');
                }
            })->conditions(array('id' => '[a-zA-Z0-9]{8,16}'));

                $app->post('/apps/:id', $authenticateMerchant, $isMerchantProfileComplete, function ($id) use ($app) {

            })->conditions(array('id' => '[a-zA-Z0-9]{8,16}'));

            $app->get('/logout',$authenticateMerchant, function () use ($app) {
                if (MerchantController::logoutMerchant()) {
                    $app->redirect($app->urlFor('merchant_login_page'));
                }
            })->name('merchant_logout_route');

            $app->get('/login',$guestMerchant, function () use ($app) {
                $app->render('Common/AuthHeader.php');
                $app->render('Merchant/Account/Login.php');
                $app->render('Common/Footer.php');
            })->name('merchant_login_page');



            $app->post('/login',$guestMerchant, function () use ($app) {
                $merchant_id = trim($app->request->post('merchant_id', ''));
                $password = trim($app->request->post('password', ''));
                if (MerchantController::loginMerchant($merchant_id, $password, $app)) {
                    $app->redirect($app->urlFor('merchant_home'));
                }
            });

            $app->get('/register',$guestMerchant, function () use ($app) {
                $app->render('Common/AuthHeader.php');
                $app->render('Merchant/Account/Register.php');
                $app->render('Common/Footer.php');
            })->name('merchant_register_page');

            $app->post('/register',$guestMerchant, function () use ($app) {
                $merchant_id = trim($app->request->post('merchant_id', ''));
                $password = trim($app->request->post('password', ''));
                $password_conf = trim($app->request->post('password_confirmation', ''));
                $bank_name = trim($app->request->post('bank_name', ''));
                $bank_account_number = trim($app->request->post('bank_account_number', ''));

                if (
                MerchantController::registerMerchant(
                    $merchant_id, $password, $password_conf,$bank_name,$bank_account_number,$app)) {
                    $app->redirect($app->urlFor('merchant_home'));
                }
            });

            $app->get('/profile',$authenticateMerchant, function () use ($app) {
                $merchant = Merchant::first(array('id'=>static::merchant_id()));
                $app->render('Common/AuthHeader.php');
                $app->render('Merchant/Account/Profile-View.php',array(
                    'merchant' => $merchant
                ));
                $app->render('Common/Footer.php');
            })->name('merchant_profile_page');

            $app->get('/profile/edit', $authenticateMerchant,function () use ($app) {
                $merchant = Merchant::first(array('id'=>static::merchant_id()));
                $app->render('Common/AuthHeader.php');
                $app->render('Merchant/Account/Profile-Edit.php',array(
                    'merchant' => $merchant
                ));
                $app->render('Common/Footer.php');
            });

            $app->post('/profile/edit',$authenticateMerchant,function () use ($app) {
                $merchant_id = static::merchant_id();
                $password = trim($app->request->post('password', ''));
                $phone = trim($app->request->post('phone', ''));
                $password_conf = trim($app->request->post('password_confirmation', ''));
                $bank_account_name = trim($app->request->post('bank_name', ''));
                $bank_name = trim($app->request->post('bank_account_name', ''));
                $bank_account_number = trim($app->request->post('bank_account_number', ''));

                if (
                MerchantController::updateMerchant(
                    array(
                        'merchant_id' => $merchant_id,
                        'password' => $password,
                        'password_conf' => $password_conf,
                        'bank_name' => $bank_name,
                        'bank_account_name' =>$bank_account_name,
                        'bank_account_number' => $bank_account_number,
                        'phone' => $phone
                    )
                    ,$app)) {
                    $app->redirect($app->urlFor('merchant_profile_page'));
                }
            });
        });
    }

    public static function createApp($app_name,$app_url,$app_description,\Slim\Slim $app){

        if( Utils::isValidAppName($app_name) &&
            Utils::isValidAppUrl($app_url)
        ){
            $hashcode = WalletApp::generateToken();
            $wallet_app = WalletApp::create([
                'active' => true,
                'hashcode' => $hashcode,
                'name' => $app_name,
                'app_url' => $app_url,
                'description' => $app_description,
                'merchant_id' => $_SESSION[static::$merchant_id_session]
            ]);
            return $wallet_app->hashcode;
        }else{
            $app->flash('error','Invalid Details entered');
            $app->redirect('/api/v1/merchant/apps/create',$app->request()->params());
        }
    }

    public static function registerMerchant(
        $merchant_id,
        $password,
        $password_conf,
        $bank_name,
        $bank_account_number,
        \Slim\Slim $app
    )
    {

        if(!Utils::isValidMerchantId($merchant_id)
            || !Utils::isValidPassword($password)){
            $app->flash('error','Invalid Username or Password Format');
            $app->redirect($app->urlFor('merchant_register_page'));
        }

        if(strcmp($password,$password_conf) != 0){
            $app->flash('error','Password Mismatch');
            $app->redirect($app->urlFor('merchant_register_page'));
        }

        $user = Merchant::find('first',array('merchant_id'=>$merchant_id));
        if(!empty($user)){
            $app->flash('error','Merchant Already Exists');
            $app->redirect($app->urlFor('merchant_register_page'));
        }

        $user = Merchant::create([
            'merchant_id' => $merchant_id,
            'password' => md5($password),
            'bank_name' => $bank_name,
            'bank_account_number' => $bank_account_number
        ]);

        return static::loginMerchant($merchant_id,$password,$app);
    }

    public static function loginMerchant($merchant_id,$password,\Slim\Slim $app){

        if(!Utils::isValidMerchantId($merchant_id) || !Utils::isValidPassword($password)){
            $app->flash('error','Invalid Username or Password Format');
            $app->redirect($app->urlFor('merchant_login_page'));
        }

        $user = Merchant::find(
            'first',array('merchant_id'=>$merchant_id,'password'=>md5($password))
        );

        if(empty($user)){
            $app->flash('error','Invalid Username or Password');
            $app->redirect($app->urlFor('merchant_login_page'));
        }


        $_SESSION[static::$merchant_id_session] = $user->id;
        return true;
    }


    public static function logoutMerchant(){
        $_SESSION[static::$merchant_id_session] = null;
        unset($_SESSION[static::$merchant_id_session]);
        unset($_SESSION[static::$merchant_id_session]);
        return true;
    }

    public static function merchant_id() {

        if (!isset($_SESSION[static::$merchant_id_session])) {
            return null;
        }

        return $_SESSION[static::$merchant_id_session];
    }

    private static function updateMerchant(
        $data = array(),
        \Slim\Slim $app) {

        if(!empty($data['password']) ){
            if(
                strcmp($data['password'],$data['password_conf']) != 0
            ){
                $app->flash('error','Password Mismatch');
                $app->redirect($app->urlFor('merchant_register_page'));
            }
        }


        $user = Merchant::find('first',array('id'=>$data['merchant_id']));
        unset($data['merchant_id']);

        if(!empty($user)){
            foreach($data as $key => $arg){
                if(!empty($arg)){
                    $user->{$key} = $arg;
                }
            }

            if (!empty($data['bank_name']) &&
                !empty($data['bank_account_name']) &&
                !empty($data['bank_account_name']) &&
                !empty($data['bank_account_number'])
            ) {
                $user->is_profile_complete = TRUE;
            }

            $user->save();
            return true;
        }

        return false;


    }
}