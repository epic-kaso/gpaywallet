<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/3/2014
 * Time: 12:54 PM
 */
    try{

        if(!isset($_ENV['production'])){
            $username = DB::username;
            $password = DB::password;
            $db = DB::database;
        }else{
            $username = DB_REMOTE::username;
            $password = DB_REMOTE::password;
            $db = DB_REMOTE::database;
        }


        $cfg = ActiveRecord\Config::instance();
        $cfg->set_model_directory(DB::model_directory);
        if(!empty($password)) {
            $cfg->set_connections(
                array(
                    'development' => "mysql://{$username}:{$password}@localhost/{$db}"
                )
            );
        }else{
            $cfg->set_connections(
                array(
                    'development' => "mysql://{$username}@localhost/{$db}"
                )
            );
        }
    }catch(Exception $ex){
        print_r($ex);
    }