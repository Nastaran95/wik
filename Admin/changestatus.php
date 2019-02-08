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

        $stmt = $connection->prepare("SELECT time FROM userEshterak WHERE (ID=? )");
        $stmt->bind_param("s", $status);
        $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
        $res = $stmt->get_result();
        if( $row = $res->fetch_assoc()){
            $t = $row['time'];
        }
        else{
            return "0";
        }

        date_default_timezone_set("Iran");
        $DATE = date('Y-m-d H:i:s');
        list($date, $time) = explode(" ", $DATE);
        list($year, $month, $day) = explode("-", $date);
        list($jyear, $jmonth, $jday) = gregorian_to_jalali2($year, $month, $day);
        if (strlen($jmonth) == 1) {
            $jmonth = "0" . $jmonth;
        }
        if (strlen($jday) == 1) {
            $jday = "0" . $jday;
        }
        $start = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;


        date_default_timezone_set("Iran");
        $str = "+".$t." days";
        $DATE2 = date('Y-m-d H:i:s' , strtotime($str));
        list($date, $time) = explode(" ", $DATE2);
        list($year, $month, $day) = explode("-", $date);
        list($jyear, $jmonth, $jday) = gregorian_to_jalali2($year, $month, $day);
        if (strlen($jmonth) == 1) {
            $jmonth = "0" . $jmonth;
        }
        if (strlen($jday) == 1) {
            $jday = "0" . $jday;
        }
        $modified_time = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;
        $end = $modified_time;

        $use = 0;
        if ($status==1){
            $use = 1;
        }


        $query = "update users set eshterakID=".$status." ,startTime = '".$start."' , endTime = '".$end."'  , useFreeEshterak = ".$use." WHERE ID = ".$product;

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


function gregorian_to_jalali2($gy,$gm,$gd,$mod=''){
    list($gy,$gm,$gd)=explode('_',tr_num2($gy.'_'.$gm.'_'.$gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
    $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
    if($gy > 1600){
        $jy=979;
        $gy-=1600;
    }else{
        $jy=0;
        $gy-=621;
    }
    $gy2=($gm > 2)?($gy+1):$gy;
    $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
    $jy+=33*((int)($days/12053));
    $days%=12053;
    $jy+=4*((int)($days/1461));
    $days%=1461;
    $jy+=(int)(($days-1)/365);
    if($days > 365)$days=($days-1)%365;
    if($days < 186){
        $jm=1+(int)($days/31);
        $jd=1+($days%31);
    }else{
        $jm=7+(int)(($days-186)/30);
        $jd=1+(($days-186)%30);
    }
    return($mod==='')?array($jy,$jm,$jd):$jy .$mod .$jm .$mod .$jd;
}

function tr_num2($str,$mod='en',$mf='٫'){
    $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
    $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
    return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
}