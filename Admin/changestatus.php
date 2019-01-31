<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 9/10/18
 * Time: 7:51 PM
 */
session_start();
if ($_SESSION['typ'] >0) {
    include '../Settings.php';
    if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==1) {
        $product = $_REQUEST['orderID'];
        $status= $_REQUEST['status'];
        $query = "update user_request set status=".$status." WHERE ID = ".$product;
        $result = $connection->query($query);
        if($connection->error){
            return "0";
        }
        else{
            return "1";
        }
    }
    else if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==2) {
        $product = $_REQUEST['orderID'];
        $status= $_REQUEST['status'];
        $query = "update Paper set stat=".$status." WHERE ID = ".$product;
        $result = $connection->query($query);
        if($connection->error){
            return "0";
        }
        else{
            return "1";
        }
    }
    else if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==3) {
        $product = $_REQUEST['orderID'];
        $status= $_REQUEST['status'];
        $query = "update users set stat=".$status." WHERE ID = ".$product;
        $result = $connection->query($query);
        if($connection->error){
            return "0";
        }
        else{
            return "1";
        }
    }
    else if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==4) {
        $product = $_REQUEST['orderID'];
        $status= $_REQUEST['status'];
        $query = "update users set verified=".$status." WHERE ID = ".$product;
        $result = $connection->query($query);
        if($connection->error){
            return "0";
        }
        else{
            return "1";
        }
    }

    else if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==5) {
        $product = $_REQUEST['orderID'];
        $status= $_REQUEST['status'];
        $query = "update users set categoryID=".$status." WHERE ID = ".$product;
        $result = $connection->query($query);
        if($connection->error){
            return "0";
        }
        else{
            return "1";
        }
    }

    else if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==6) {
        $product = $_REQUEST['orderID'];
        $status= $_REQUEST['status'];
        $query = "update users set eshterakID=".$status." WHERE ID = ".$product;
        $result = $connection->query($query);
        if($connection->error){
            return "0";
        }
        else{
            return "1";
        }
    }

    else if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==7) {
        $product = $_REQUEST['orderID'];
        $query = "update users set image='images/no-photo.png'  WHERE ID = ".$product;
        $result = $connection->query($query);
        if($connection->error){
            return "0";
        }
        else{
            return "1";
        }
    }

    else if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==8) {
        $product = $_REQUEST['orderID'];
        $status= $_REQUEST['status'];
        $query = "update advertisement set stat=".$status." WHERE ID = ".$product;
        $result = $connection->query($query);
        if($connection->error){
            return "0";
        }
        else{
            return "1";
        }
    }


}else {
    header('Location:/');
}