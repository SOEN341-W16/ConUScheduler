<?php
error_reporting(E_ALL ^ E_NOTICE);
function my_autoloader($class){
    $f = $_SERVER['DOCUMENT_ROOT']."/includes/". $class . '.php';
    if(is_file($f))
        include_once ($f);
}
// spl_autoload_register will now include every class from within the "includes" folder to be used accross the application. Without this, classes must be included manually.
spl_autoload_register('my_autoloader');

// Set database configuration using MySql confi driver
Registry::setConfig(new MySqlConfig(DatabaseManager::dbUser, DatabaseManager::dbPass, DatabaseManager::dbName, DatabaseManager::host,  DatabaseManager::dbPort ));

// this file is to be include everywhere where a database connection is needed
?>