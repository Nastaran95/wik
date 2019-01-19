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
    if ( isset($_REQUEST['orderID']) && isset($_REQUEST['typ']) && $_REQUEST['typ']==2) {
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

}else {
    header('Location:/');
}