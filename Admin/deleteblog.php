<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 10/28/2017
 * Time: 10:25 AM
 */
session_start();
if (($_SESSION['typ'] == 10) || ($_SESSION['typ'] == 9)) {
    include '../Settings.php';

    if ((isset($_REQUEST['product'])) && (isset($_REQUEST['type']))) {
        $product = $_REQUEST['product'];
        $type = $_REQUEST['type'];
        if ($type == 1)
            $query = "SELECT * FROM Paper WHERE ID = $product";
        else if($type == 2)
            $query = "SELECT * FROM users WHERE ID = $product";
        else if($type == 3)
            $query = "SELECT * FROM menue WHERE ID = $product";
        else if($type == 4)
            $query = "SELECT * FROM userCategory WHERE ID = $product";
        else if($type == 5)
            $query = "SELECT * FROM userEshterak WHERE ID = $product";
        else if($type == 6)
            $query = "SELECT * FROM slider WHERE ID = $product";
        else if($type == 7)
            $query = "SELECT * FROM grayBox WHERE ID = $product";
        else if($type == 8)
            $query = "SELECT * FROM user_request WHERE ID = $product";
        else if($type == 9)
            $query = "SELECT * FROM addCategory WHERE ID = $product";
        else if($type == 10)
            $query = "SELECT * FROM advertisement WHERE ID = $product";
        else if($type == 11)
            $query = "SELECT * FROM Pages WHERE ID = $product";
        else if($type == 12)
            $query = "SELECT * FROM marquees WHERE ID = $product";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $name = $row['XMLNAME'];
        unlink($name);
        if ($type == 1)
            $query = "DELETE FROM Paper WHERE ID = $product";
        else if($type == 2)
            $query = "DELETE FROM users WHERE ID = $product";
        else if($type == 3)
            $query = "DELETE FROM menue WHERE ID = $product";
        else if($type == 4)
            $query = "DELETE FROM userCategory WHERE ID = $product";
        else if($type == 5)
            $query = "DELETE FROM userEshterak WHERE ID = $product";
        else if($type == 6)
            $query = "DELETE FROM slider WHERE ID = $product";
        else if($type == 7)
            $query = "DELETE FROM grayBox WHERE ID = $product";
        else if($type == 8)
            $query = "DELETE FROM user_request WHERE ID = $product";
        else if($type == 9)
            $query = "DELETE FROM addCategory WHERE ID = $product";
        else if($type == 10)
            $query = "DELETE FROM advertisement WHERE ID = $product";
        else if($type == 11)
            $query = "DELETE FROM Pages WHERE ID = $product";
        else if($type == 12)
            $query = "DELETE FROM marquees WHERE ID = $product";
        $result = $connection->query($query);
        if($connection->error){
            echo '<script> alert("بدلایل امنیتی دسترسی به حذف داده نشد'.$connection->error.'."); </script> ';
        }

        if ($type == 1)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/allPosts.php?nocache='.generateRandomString(10).'">';
        else if($type == 2)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/allUsers.php?nocache='.generateRandomString(10).'">';
        else if($type == 3)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/manageMenue.php?nocache='.generateRandomString(10).'">';
        else if($type == 4)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/manageUsersCategory.php?nocache='.generateRandomString(10).'">';
        else if($type == 5)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/manageUsersEshterak.php?nocache='.generateRandomString(10).'">';
        else if($type == 6)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/manageSlider.php?nocache='.generateRandomString(10).'">';
        else if($type == 7)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/manageGrayBox.php?nocache='.generateRandomString(10).'">';
        else if($type == 8)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/allUsersRequest.php?nocache='.generateRandomString(10).'">';
        else if($type == 9)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/manageAdd.php?nocache='.generateRandomString(10).'">';
        else if($type == 10)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/allAdvertisement.php?nocache='.generateRandomString(10).'">';
        else if($type == 11)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/allPages.php?nocache='.generateRandomString(10).'">';
        else if($type == 12)
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/admin/manageMarquees.php?nocache='.generateRandomString(10).'">';


    }
}else {
    header('Location:/');
}
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function generateToken2($length = 20)
{
    return bin2hex(openssl_random_pseudo_bytes($length));
}
?>