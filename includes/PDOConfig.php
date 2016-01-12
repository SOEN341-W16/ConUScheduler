<?php

/**
 * Interface PDOConfig is a typical interface of what is required to make a PDO object
 */
interface PDOConfig {
    public function getDSN();
    public function getUsername();
    public function getPassword();
    public function getDriverOptions();
}

?>