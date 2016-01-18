<?php
session_start();

// check if the GET variables are set
if(isset($_SESSION['user_id']) && isset($_SESSION['username']))
{
    include "includes/dbc.php";
    $t=time();
    // destroy all session variables and redirect to landing page
    session_unset();
    session_destroy();
    header("location: index.php?logout=$t");
} else {
    header("location: index.php");
}

?>