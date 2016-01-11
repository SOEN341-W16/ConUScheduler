<?php
class Registry {

    private static $connection;

    private static $config;

    /**
     * @param $config sets the configuration given by driver type (MySQL, etc)
     */
    public static function setConfig($config) {
        self::$config = $config;
    }

    /**
     * @return PDO returns PDO object based on configuration
     */
    public static function getConnection() {
        if (self::$connection === null) {
            if (self::$config === null) {
                throw new RuntimeException('No config set, cannot create connection');
            }
            $config = self::$config;
            self::$connection = new PDO($config->getDSN(), $config->getUsername(), $config->getPassword(), $config->getDriverOptions());
        }
        return self::$connection;
    }
}
?>