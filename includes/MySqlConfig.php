<?php

/**
 * Class MySqlConfig is a typical MySQL configuration driver
 */

class MySqlConfig implements PDOConfig {

    private $_username;
    private $_password;
    private $_db;
    private $_host = 'localhost'; // default: localhost
    private $_port = 3306; // default: 3306
    private $_charset = 'utf8';

    /**
     * MySqlConfig constructor.
     * @param $username database username
     * @param $password database password
     * @param $db database name
     * @param $host host
     * @param $port port number
     */
    public function __construct($username, $password, $db, $host, $port) {
        $this->_username = $username;
        $this->_password = $password;
        $this->_host = $host;
        $this->_port = $port;
        $this->_db = $db;
    }

    /**
     * @return string returns the connection string
     */
    public function getDSN() {
        return sprintf('mysql:host=%s;dbname=%s;charset=%s;port=%s;connect_timeout=15',
            $this->_host, $this->_db, $this->_charset, $this->_port);
    }
    /**
     * @return mixed returns username
     */
    public function getUsername(){ return $this->_username; }

    /**
     * @return mixed returns password
     */
    public function getPassword(){ return $this->_password; }

    /**
     * @return array returns the driver options as per PDO paramaters
     */
    public function getDriverOptions() {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
    }

}

?>