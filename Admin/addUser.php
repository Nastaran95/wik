<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/19/19
 * Time: 6:23 PM
 */
session_start();
include '../Settings.php';
include 'Parsedown.php';
$which=4;
if ($_SESSION['typ']>8) {

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } elseif (isset($_POST['type'])) {
        $type = $_POST['type'];
    } else {
        $type = 1;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>افزودن کاربر</title>


        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
        <link rel="stylesheet" href="css/oldcss.css">
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/local.css" />
        <link rel="stylesheet" href="../css/codemirror.min.css">
        <link rel="stylesheet" href="css/kamadatepicker.css">
        <link href="css/addblog.css" rel="stylesheet">
        <script src="js/addblog.js"></script>
        <script src="js/kamadatepicker.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <style>
            table{
                color: #000000;}
        </style>
    </head>
    <body dir="rtl">
    <?php

    if (isset($_GET['product'])) {
        $product = $_GET['product'];
    } else {
        $product = "all";
    }
    if ($product == "namovafagh"){
        $product = "all";
    }

    if(isset($_GET['request']) && $_GET['request']=="addOrUpdate"){
        if ((isset($_POST['name'])) && (isset($_POST['email'])) && (isset($_POST['mobile'])) && (isset($_POST['address'])) && (isset($_POST['pass'])) && (isset($_POST['repass']))){
            $mail = $_POST["email"];
            $name = $_POST["name"];
            $mobile = $_POST["mobile"];
            $address = $_POST["address"];
            $pass = $_POST["pass"];
            $confpass = $_POST["repass"];
            $eshterak = 0;

            $mobile = str_replace("۰", "0", $mobile);
            $mobile = str_replace("۱", "1", $mobile);
            $mobile = str_replace("۲", "2", $mobile);
            $mobile = str_replace("۳", "3", $mobile);
            $mobile = str_replace("۴", "4", $mobile);
            $mobile = str_replace("۵", "5", $mobile);
            $mobile = str_replace("۶", "6", $mobile);
            $mobile = str_replace("۷", "7", $mobile);
            $mobile = str_replace("۸", "8", $mobile);
            $mobile = str_replace("۹", "9", $mobile);

            if (isset($_POST["category"]))
                $category = $_POST["category"];
            else
                $category = "";

            $stmt = $connection->prepare("SELECT email,name,eshterakID FROM Users WHERE (mobile=?)");
            $stmt->bind_param("s", $mobile);
            $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
            $stmt->store_result();
    ?>
    <div id="wrapper">
        <?php
        include 'adminmenue.php';
            if ($stmt->num_rows > 0 && $product === "all") {
                $stmt->close();
                    ?>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-login">
                                <div class="row">
                                    <div class="col-11">
                                        <h4>شماره موبایل وارد شده قبلا توسط فرد دیگری ثبت شده است.
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
            }
            else if (strlen($pass) < 8){
                    ?>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-login">
                                <div class="row">
                                    <div class="col-11">
                                        <h4>پسورد وارد شده حداقل باید 8 کاراکتر باشد.
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
            }
            else {
                date_default_timezone_set("Iran");
                $DATE = date('Y-m-d H:i:s');
                list($date, $time) = explode(" ", $DATE);
                list($year, $month, $day) = explode("-", $date);
                list($jyear, $jmonth, $jday) = gregorian_to_jalali($year, $month, $day);
                if (strlen($jmonth) == 1) {
                    $jmonth = "0" . $jmonth;
                }
                if (strlen($jday) == 1) {
                    $jday = "0" . $jday;
                }
                $modified_time = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;
                try{
                    $verificationcode = generateRandomString();
                    $MobileNumber = $mobile;
                    $Code = $verificationcode;
                    // your text messages
                    $Code = $verificationcode;
                    $img = 'images/no-photo.png';
                    if ($product === "all") {
                        $stmt = $connection->prepare("INSERT INTO users (name,address,mobile,email,categoryID,pass,eshterakID,verified,verificationcode,codetime,attempt,passwordtime,image,realtime)  VALUES (?,?,?,?,?,?,4,0,?,CURRENT_TIMESTAMP,1,CURRENT_TIMESTAMP,?,?)");
                        $stmt->bind_param("sssssssss", $name, $address, $mobile, $mail, $category, $pass, $verificationcode, $img, $modified_time);
                    } else {
                        $stmt = $connection->prepare("UPDATE users SET name=? ,  stat=0 ,address=? , email=? , categoryID=? , pass=? WHERE (ID=?)");
                        $stmt->bind_param("ssssss", $name, $address, $mail, $category,$pass, $product);
                    }


    //                $img = 'images/no-photo.png' ;
    //                $stmt  = $connection->prepare("INSERT INTO users (name,address,mobile,email,categoryID,pass,eshterakID,verified,verificationcode,codetime,attempt,passwordtime,image)  VALUES (?,?,?,?,?,?,4,0,?,CURRENT_TIMESTAMP,1,CURRENT_TIMESTAMP,?)");
    //                $stmt->bind_param("ssssssss", $name,$address,$mobile,$mail,$category,$pass,$verificationcode,$img);
                    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
                    $stmt->close();

                    if ($product === "all") {
                        $product = $connection->insert_id;
                    }
                    $movafagh = 'عملیات مورد نظر با موفقیت انجام شد.';

                    if ($connection->error) {
                        $movafagh = 'عملیات مورد نظر موفق نبود. وارد کردن تمامی موارد الزامی است.';
                        $product = "namovafagh";
                        $mail = $_POST["email"];
                        $name = $_POST["name"];
                        $mobile = $_POST["mobile"];
                        $address = $_POST["address"];
                        $pass = $_POST["pass"];
                        $confpass = $_POST["repass"];
                        if (isset($_POST["category"]))
                            $category = $_POST["category"];
                        else
                            $category = "";
                    } else {
                        echo "<script>alert('عملیات مورد نظر موفقیت آمیز بود.');</script>";
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=allUsers.php">';
                    }

                }
                catch (mysqli_sql_exception $E){
                    ?>
                    <div id="wrapper">
                        <?php
                        include 'adminmenue.php';
                        ?>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="panel panel-login">
                                    <div class="row">
                                        <div class="col-11">
                                            <h4>اطلاعات وارد شده دارای ایراد است، لطفا مجددا تلاش کنید.
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                }
            }
        }
        else {
            $movafagh = '';
            ?>
            <div id="wrapper">
                <?php
                include 'adminmenue.php';
                ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-login">
                            <div class="row">
                                <div class="col-11">
                                    <h4>اطلاعات به صورت کامل وارد نشده است. مجددا تلاش کنید.
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        }
    }
    else{
        ?>
            <div id="wrapper">
                <?php
                include 'adminmenue.php';
    }
    $query = "SELECT * FROM users WHERE ID='$product'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
    }

    if ($product === "all") {
        $URL = "addUser.php?request=addOrUpdate";
    } else {
        $URL = "addUser.php?product=$product&request=addOrUpdate";
    }
    $URL2 = "addUser.php?type=$type&request=addOrUpdate";

    if ($product=="namovafagh"){
//            echo "<script>window.alert('set1');</script>";
    } else if ($product !== "all") {
        $query = "SELECT * FROM users WHERE ID='$product'";
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
        }

        $mail = $row["email"];
        $name = $row["name"];
        $mobile = $row["mobile"];
        $address = $row["address"];
        $pass = $row["pass"];
        $confpass = $row["repass"];
        $category = $row["categoryID"];


    } else {
        $mail = "";
        $name = "";
        $mobile = "";
        $address = "";
        $pass = "";
        $confpass = "";
        $category = "";
    }
    ?>
        <div class="m-auto col-12" id="showerror"></div>
        <form action="<?php echo $URL ?>" method="post" onsubmit="return validateFormdata(2)" class="form-row mt-5" >
            <div class="form-group col-md-10 m-auto text-right">
                <label for="name" class="dark_text"><b>نام و نام خانوادگی</b></label>
                <input type="text" maxlength="200" class="form-control" id="name" placeholder="نام و نام خانوادگی" name="name" value="<?php echo $name;?>"  >
            </div>
            <div class="form-group col-md-10 m-auto text-right">
                <label for="mobile" class="dark_text"><b>شماره همراه</b></label>
                <input type="text" maxlength="11" pattern="\d*" class="form-control" id="mobile" placeholder="شماره همراه" name="mobile"  value="<?php echo $mobile;?>" <?php if ($product !== "all") echo "readonly";?> >
            </div>
            <div class="form-group col-md-10 m-auto text-right">
                <label for="email" class="dark_text"><b>ایمیل</b></label>
                <input type="email" maxlength="200" class="form-control" id="email" placeholder="ایمیل"  name="email" value="<?php echo $mail;?>" >
            </div>
            <div class="form-group col-md-10 m-auto text-right">
                <label for="address" class="dark_text"><b>آدرس</b></label>
                <input type="text" maxlength="900" class="form-control" id="address" placeholder="آدرس" name="address" value="<?php echo $address;?>" >
            </div>
            <div class="form-group col-md-10 m-auto text-right">
                <label for="pass" class="dark_text"><b>کلمه عبور</b></label>
                <input type="password" maxlength="90" class="form-control" id="pass" placeholder="کلمه عبور" name="pass"  value="<?php echo $pass;?>" >
            </div>
            <div class="form-group col-md-10 m-auto text-right">
                <label for="repass" class="dark_text"><b>تایید کلمه عبور</b></label>
                <input type="password" maxlength="90" class="form-control" id="repass" placeholder="تایید کلمه عبور" name="repass"  value="<?php echo $pass;?>" >
            </div>
            <div class="form-group col-md-10 m-auto text-right">
                <label for="category" class="dark_text"><b>دسته‌بندی</b></label>
                <select name="category" class="form-control required" id="category">
                    <?php
                    $query = "SELECT * FROM userCategory;";
                    $result = $connection->query($query);
                    while ($row=$result->fetch_assoc()) {
                        $name = $row['name'];
                        $id = $row['ID'];
                        ?>
                        <option value="<?php echo $id;?>" <?php if ($category == $id) echo "selected=\"selected\""; ?> ><?php echo $name;?></option>

                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                    <button type="submit" class="btn btn-default col-md-12 col-12" id="register">تایید</button>
                </div>
            </div>

        </form>

    </div>



    </body>
    <!--    <script>-->
    <!--        var customOptions = {-->
    <!--            placeholder: "روز / ماه / سال"-->
    <!--            , twodigit: false-->
    <!--            , closeAfterSelect: true-->
    <!--            , nextButtonIcon: "fa fa-arrow-circle-right"-->
    <!--            , previousButtonIcon: "fa fa-arrow-circle-left"-->
    <!--            , buttonsColor: "black"-->
    <!--            , forceFarsiDigits: true-->
    <!--            , markToday: true-->
    <!--            , markHolidays: true-->
    <!--            , highlightSelectedDay: true-->
    <!--            , sync: true-->
    <!--            , gotoToday: true-->
    <!--        };-->
    <!--        kamaDatepicker('tarikhAzmun', customOptions);-->
    <!--        kamaDatepicker('tarikhKart', customOptions);-->
    <!--        kamaDatepicker('tarikhNatayej', customOptions);-->
    <!--    </script>-->
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

