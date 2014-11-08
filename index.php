<?php

    require 'vendor/autoload.php';

    $mode = isset($_ENV['production']) ? 'production' : 'development';
    $app = new \Slim\Slim(array(
        'mode' => $mode
    ));

    $app->add(new \Slim\Middleware\SessionCookie(array(
        'expires'     => '20 minutes',
        'path'        => '/',
        'domain'      => NULL,
        'secure'      => FALSE,
        'httponly'    => FALSE,
        'name'        => 'gpay_wallet_session',
        'secret'      => 'biue+23859-ndk!%&*jdgGHUQ1-908=_',
        'cipher'      => MCRYPT_RIJNDAEL_256,
        'cipher_mode' => MCRYPT_MODE_CBC
    )));

    $app->config(array(
        'debug'              => TRUE,
        'templates.path'     => './Views',
        'cookies.encrypt'    => TRUE,
        'cookies.secret_key' => 'biue+23859-ndk!%&*jdgGHUQ1-908=_',
        'cookies.cipher'     => MCRYPT_RIJNDAEL_256
    ));

    // Only invoked if mode is "production"
    $app->configureMode('production', function () use ($app) {
        $app->config(array(
            'log.enable' => TRUE,
            'debug'      => FALSE
        ));
    });

    // Only invoked if mode is "development"
    $app->configureMode('development', function () use ($app) {
        $app->config(array(
            'log.enable' => FALSE,
            'debug'      => TRUE
        ));
    });

    $authenticateUser = array('MiddleWare', 'authenticateUser');
    $guestUser = array('MiddleWare', 'guestUser');

    $authenticateMerchant = array('MiddleWare', 'authenticateMerchant');
    $guestMerchant = array('MiddleWare', 'guestMerchant');

    $app->get('/', function () use ($app) {
        $app->redirect($app->urlFor('login_page'));
    });

    $app->get('/logout', function () use ($app) {
        $app->redirect($app->urlFor('logout_route'));
    });

    $app->get('/merchant/logout', function () use ($app) {
        $app->redirect($app->urlFor('merchant_logout_route'));
    });

    $app->group('/api/v1', function () use ($app, $authenticateUser, $guestUser,$authenticateMerchant,$guestMerchant) {

        MemberController::initializeMemberRoutes($app,$authenticateUser,$guestUser);

        MerchantController::initializeMerchantRoutes($app,$authenticateMerchant,$guestMerchant);

        ApiController::initializeRoutes($app);
    });

    $app->run();
