<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/11/2018
 * Time: 2:35 AM
 */
session_start();
include '../Settings.php';
if (($_SESSION['typ']>0)) {
    if (isset($_REQUEST['cat1']))
        $cat1 = true;
    else
        $cat1 = false;
    ?>
    <?php
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } else {
        $type = 1;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>همه تراکنش‌ها</title>

        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/local.css" />
        <link href="css/allproduct.css" rel="stylesheet">
        <link href="css/addblog.css" rel="stylesheet">
<!--        <script src="js/allPardakht.js"></script>-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    </head>
    <body dir="rtl">
    <div id="wrapper">
        <?php
        $which=13;
        include 'adminmenue.php';
        ?>
        <div id="page-wrapper">
            <div class="m-auto col-12" id="showerror"></div>


            <table class="table user-list " id="menuTable">
                <thead>
                <tr>
                    <th><span>نام کاربر</span></th>
                    <th><span>شماره موبایل کاربر</span></th>
                    <th><span>نوع بسته</span></th>
                    <th><span>مبلغ(تومان)</span></th>
                    <th><span>وضعیت</span></th>
                    <th><span>کد</span></th>
                    <th><span>تاریخ</span></th>

                </tr>
                </thead>
                <tbody>



                <?php

                $qu = "SELECT * FROM userEshterak;";
                $res = $connection->query($qu);
                $eshterak = array();
                while ($r=$res->fetch_assoc()) {
                    $name = $r['name'];
                    $id = $r['ID'];
                    $eshterak = $eshterak + array($id=>$name);
                }

                $query = "SELECT * FROM allpardakht;";
                $result = $connection->query($query);
                echo "<script>x=0; y =0;</script>";
                while ($row=$result->fetch_assoc()) {


                    $writerID = $row['mobile'];
                    $q = "SELECT * FROM users WHERE mobile=".$writerID.";";
                    $res = $connection->query($q);
                    if ($res->num_rows > 0) {
                        $rw = mysqli_fetch_assoc($res);
                        $writer = $rw['name'];
                    }
                    else
                        $writer = 'ناشناس';

                    echo "   
                                        <td style=\"width: 10%;\">                                                                                                               
                                            <span>".$writer."</span>
                                        </td>";
                    echo "   
                                    <td style=\"width: 10%;\">                                                                                                               
                                        <span>".$row['mobile']."</span>
                                    </td>";


                    echo "<td dir='ltr' style=\"width: 10%;\">
                                        <span>".$eshterak[$row['userEshterakID']]."</span>
                                    </td>";

                    echo "   
                                    <td style=\"width: 10%;\">                                                                                                               
                                        <span>".$row['amount']."</span>
                                    </td>";


                    if($row['status'] ==0)
                        echo "   
                                    <td style=\"width: 10%;\" class='text-primary'>                                                                                                               
                                        <span> انصراف کاربر</span>
                                    </td>";
                    else if($row['status'] ==1)
                        echo "   
                                    <td style=\"width: 10%;\" class='text-danger'>                                                                                                               
                                        <span> تراکنش نا موفق</span>
                                    </td>";
                    else if($row['status'] ==2)
                        echo "   
                                    <td style=\"width: 10%;\" class='text-success'>                                                                                                               
                                        <span> تراکنش موفق</span>
                                    </td>";
                    else if($row['status'] ==3)
                        echo "   
                                    <td style=\"width: 10%;\" class='text-info'>                                                                                                               
                                        <span> منتظر پرداخت</span>
                                    </td>";

                    echo "   
                                    <td style=\"width: 10%;\">                                                                                                               
                                        <span>".$row['code']."</span>
                                    </td>";

                    echo "   
                                    <td style=\"width: 10%;\">                                                                                                               
                                        <span>".$row['time']."</span>
                                    </td>";

                    echo '</tr>';

                }
                ?>
                </tbody>
            </table>


        </div>
        <!-- /#page-wrapper -->

    </div>
    </body>

    </html>
    <?php
}else{
    header('Location:/');
}

function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
    list($gy,$gm,$gd)=explode('_',tr_num($gy.'_'.$gm.'_'.$gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
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

function tr_num($str,$mod='en',$mf='٫'){
    $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
    $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
    return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
}