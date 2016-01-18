<?php
require "../includes/dbc.php";

if (isset($_REQUEST)) {

    $Authenticator = new Authenticator($_POST);

    if ($Authenticator->login()) { ?>

        <script>
            $(function(){
                window.location.replace("<?php echo "home.php"; ?>");
            });
        </script>
    <?php
    }
    else
    { ?>


        <div class="alert alert-danger">
            <?php
            $errors = $Authenticator->getErrors();
            foreach($errors as $error)
                echo $error . "</br>";
            ?>
        </div>
        <?php
    }

}
?>
