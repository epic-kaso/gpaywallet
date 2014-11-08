<?php
    /**
     * Created by PhpStorm.
     * User: kaso
     * Date: 11/9/2014
     * Time: 12:15 AM
     */
    require 'vendor/autoload.php';

    $username = DB_REMOTE::username;
    $password = DB_REMOTE::password;
    $db = DB_REMOTE::database;

    // Name of the file
    $filename = 'gpay_wallet.sql';
    // MySQL host
    $mysql_host = '54.172.215.83';
    // MySQL username
    $mysql_username = $username;
    // MySQL password
    $mysql_password = $password;
    // Database name
    $mysql_database = $db;

    // Connect to MySQL server
    $link = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
    // Select database
    mysqli_select_db($link,$mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
    $templine = '';
// Read in entire file
    $lines = file($filename);
// Loop through each line
    foreach ($lines as $line) {
// Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

// Add this line to the current segment
        $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            mysqli_query($link,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
            // Reset temp variable to empty
            $templine = '';
        }
    }
    echo "Tables imported successfully";