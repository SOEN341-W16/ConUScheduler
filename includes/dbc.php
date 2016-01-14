<?php
error_reporting(E_ALL ^ E_NOTICE);
function my_autoloader($class){
    $class = (str_replace('\\', DIRECTORY_SEPARATOR, $class));

    require_once $class . '.php';
}
// spl_autoload_register will now include every class from within the "includes" folder to be used accross the application. Without this, classes must be included manually.
spl_autoload_register('my_autoloader');

// Set database configuration using MySql config driver
$MySqlConfig = new MySqlConfig(DatabaseManager::dbUser, DatabaseManager::dbPass, DatabaseManager::dbName, DatabaseManager::host,  DatabaseManager::dbPort );
Registry::setConfig($MySqlConfig);



// this file is to be include everywhere where a database connection is needed
/*
 * To use:
 * $pdo = Registry::getConnection(); // this object is a singleton and can be accessed across the application
 *
 * $query = $pdo->prepare("SELECT * FROM table");
 *
 * and then use it accordingly
 *
 *
 */
?>


