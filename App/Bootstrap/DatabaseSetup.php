<?php
/**
 * Created by PhpStorm.
 * User: kaso
 * Date: 11/3/2014
 * Time: 12:54 PM
 */
    try{

        if(!isset($_ENV['production']) && !isset($_SERVER['production'])){
            $username = DB::username;
            $password = DB::password;
            $db = DB::database;
            $host = "localhost";
        }else{
            $username = DB_REMOTE::username;
            $password = DB_REMOTE::password;
            $db = DB_REMOTE::database;
            $host = DB_REMOTE::host;
        }


        $cfg = ActiveRecord\Config::instance();
        $cfg->set_model_directory(DB::model_directory);
        if(!empty($password)) {
            $cfg->set_connections(
                array(
                    'development' => "mysql://{$username}:{$password}@{$host}/{$db}"
                )
            );
        }else{
            $cfg->set_connections(
                array(
                    'development' => "mysql://{$username}@{$host}/{$db}"
                )
            );
        }
    }catch(Exception $ex){
        print_r($ex);
    }