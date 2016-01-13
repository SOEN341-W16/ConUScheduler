<?php
class Authenticator  {


    private $_credentials;

    private $_error_messages;

    private $_userid;

    /**
     * Authenticator constructor.
     * @param $credentials array containing user credentials
     */
    public function __construct($credentials)
    {
        $this->_credentials = array(
            'username' => '',
            'password' => ''
        );

        if ($credentials) {
            /* union of $credentials + $this->_credentials */
            $this->_credentials = $credentials + $this->_credentials;
        }
    }

    private function checkUser()
    {
        $pdo = Registry::getConnection();
        $query = $pdo->prepare("SELECT * FROM users WHERE binary user_name=:user AND password=:password LIMIT 1");
        $query->bindValue(":user",$this->_credentials['username']);
        $query->bindValue(":password", $this->_credentials["password"]);
        $query->execute();
        // if user was not found
        if ($query->rowCount()!=1)
        {
            $this->_error_messages[] = "Username or password incorrect!";
        }
        $data = $query->fetch();
        $this->_userid = $data["ID"];

    }

    /**
     * @return mixed returns an array of errors that might have occurred during login process
     */
    public function getErrors() {
        return $this->_error_messages;
    }

    public function login() {
        $this->checkUser();
        // if no errors are found
        if(empty($this->_error_messages))
        {
            // start a new session
            session_start();
            @session_regenerate_id (true);

            $_SESSION['username'] 	= $this->_credentials["username"];
            $_SESSION['user_id'] 	= $this->_userid;
            $_SESSION['http'] 		= md5($_SERVER['HTTP_USER_AGENT']);
            $_SESSION['start'] 		= time(); // taking now logged in time
            return true;
        }
        return false;

    }

}

?>