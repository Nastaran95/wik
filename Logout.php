<?php
/**
 * Created by PhpStorm.
 * User: HamidReza
 * Date: 9/11/2017
 * Time: 11:33 PM
 */
session_start();
header('Location:loginRegister.php');
if ((isset($_COOKIE['token']))&&(isset($_COOKIE['token2']))) {
    $token1 = $_COOKIE['token1'];
    $token2 = $_COOKIE['token2'];
    $sql = "DELETE FROM token WHERE token2='$token2'";
    if (mysqli_query($connection, $sql)) {

    }
}

setcookie ("token2","");
setcookie ("token1","");
session_destroy();
?>
