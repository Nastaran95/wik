<?php
/**
 * Created by PhpStorm.
 * User: HamidReza
 * Date: 8/27/2017
 * Time: 12:11 AM
 * https://www.google.com/recaptcha/admin#site/339248547?setup
 */
session_start();
$inactive = 3600;
include 'Settings.php';
$productXMLNAME = "XMLs/register.xml";
if (file_exists($productXMLNAME)) {
    $XMLFile = simplexml_load_file($productXMLNAME);
    $SEOdescription=$XMLFile->description;
    $SEOKEYWORDS=$XMLFile->kewords;
    $SEOTITLE=$XMLFile->seotitle;
}else{
    $SEOdescription="";
    $SEOKEYWORDS="";
    $SEOTITLE="";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php echo $SEOTITLE?></title>
    <meta name="description" content="<?php echo $SEOdescription;?>">
    <meta name="keywords" content="<?php echo $SEOKEYWORDS;?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $SEOTITLE?>">
    <meta property="og:description" content="<?php echo $SEOdescription;?>">
    <meta property="og:url" content="http://www.wikiderm.ir/">
    <meta property="og:site_name" content="ویکی‌درم">

    <link rel="icon" type="image/x-icon" href="/images/wikiderm-icon--300x300.png" />
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <script src="/js/jQuery.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    <link rel="stylesheet" href="/css/global.css"/>
    <link rel="stylesheet" href="/css/register.css"/>
    <link rel="canonical" href="https://www.wikiderm.ir/">
    <link rel="alternate" href="https://www.wikiderm.ir/" hreflang="fa-IR" />
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
    <script src="js/LoginRegister.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=fa'></script>
</head>
<body dir="rtl">
    <?php
    if (isset($_SESSION["logged_in"])&& $_SESSION["logged_in"]){
        echo "<meta http-equiv=\"refresh\" content=\"0;url=/\">";
        exit();
    }else {
        if (isset($_POST['mobile'])){
            $data = array(
                'secret' => "6LdBvYkUAAAAAMcIsEmjJCrtVDvOjIEXPYZ2HcW4",
                'response' => $_POST['g-recaptcha-response']
            );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($verify);
            if ($result === FALSE) {
                include 'header.php';
                ?>
                <div class="container paddingtop">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-login">
                                <div class="row">
                                    <div class="col-11 centeral">
                                        <h4 class="centeral"> پیام امنیتی بدرستی وارد نشده است.
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    include 'MyIncludeLogin.php';
            }
            $result = json_decode($result);
            if (!$result->success) {
                    include 'header.php';
                    ?>
                    <div class="container paddingtop">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-login">
                                    <div class="row">
                                        <div class="col-11 centeral">
                                            <h4 class="centeral"> پیام امنیتی بدرستی وارد نشده است.
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        include 'MyIncludeLogin.php';
            }
            else { //TODO check kon moteghayera ok bashan
                if ((isset($_POST['name']))&&(isset($_POST['email']))&&(isset($_POST['mobile']))&&(isset($_POST['address']))&&(isset($_POST['pass']))&&(isset($_POST['repass']))){
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

                    $stmt  = $connection->prepare("SELECT email,name,eshterakID FROM Users WHERE (mobile=?)");
                    $stmt->bind_param("s", $mobile);
                    $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                        include 'header.php';
                        $stmt->close();
                        ?>
                        <div class="container paddingtop">
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
                            include 'MyIncludeLogin.php';
                    }
                    else if (strlen($pass)<8){
                        include 'header.php';
                        ?>
                        <div class="container paddingtop">
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
                            include 'MyIncludeLogin.php';
                    }
                    else {
                        try{
                            $verificationcode=generateRandomString();
                            $MobileNumber=$mobile;
                            $Code=$verificationcode;
                            // your text messages
                            $Code = $verificationcode;
                            $img = 'images/no-photo.png' ;
//                            include 'SMS/SmsIR_VerificationCode.php';
                            $stmt  = $connection->prepare("INSERT INTO users (name,address,mobile,email,categoryID,pass,eshterakID,verified,verificationcode,codetime,attempt,passwordtime,image)  VALUES (?,?,?,?,?,?,4,0,?,CURRENT_TIMESTAMP,1,CURRENT_TIMESTAMP,?)");
                            $stmt->bind_param("ssssssss", $name,$address,$mobile,$mail,$category,$pass,$verificationcode,$img);
                            $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
                            $stmt->close();
                            $payam="<h4>ثبت نام شما با موفقیت انجام شد، برای تکمیل ثبت نام، کد ارسال شده به شماره موبایل خود را در بخش زیر وارد کنید.</h4>";
                            include 'Verifyregister.php';
                        }
                        catch (mysqli_sql_exception $E){
                            include 'header.php';
                            ?>
                            <div class="container paddingtop">
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
                                include 'MyIncludeLogin.php';
                        }
                    }
                }
                else {
                    include 'header.php';
                    ?>
                    <div class="container paddingtop">
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
                        include 'MyIncludeLogin.php';
                }
            }
        }else if (isset($_POST['mobileLogin'])) {
            $data = array(
                'secret' => "6LdBvYkUAAAAAMcIsEmjJCrtVDvOjIEXPYZ2HcW4",
                'response' => $_POST['g-recaptcha-response']
            );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($verify);
            if ($result === FALSE) {
                include 'header.php';
                ?>
                <div class="container paddingtop">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-login">
                                <div class="row">
                                    <div class="col-11 centeral">
                                        <h4 class="centeral"> پیام امنیتی بدرستی وارد نشده است.
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                include 'MyIncludeLogin.php';
            }
            else{
                $result = json_decode($result);
                // !$result->success
                if (!$result->success) {
                    include 'header.php';
                    ?>
                    <div class="container paddingtop">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-login">
                                    <div class="row">
                                        <div class="col-11 centeral">
                                            <h4 class="centeral"> پیام امنیتی بدرستی وارد نشده است.
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    include 'MyIncludeLogin.php';
                }else {
                    $mobile = $_POST["mobileLogin"];
                    $password = $_POST["passLogin"];
                    if (isset($_POST["rememberMe"])) {
                        $rememberME = $_POST["rememberMe"];
                    } else {
                        $rememberME = 'off';
                    }
                    $stmt = $connection->prepare("SELECT name, mobile, eshterakID ,verified,typ FROM users WHERE (mobile=? AND pass=?)");
                    $stmt->bind_param("ss", $mobile, $password);
                    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $stmt->close();
                        $name = $row["name"];
                        $eshterak = $row["eshterakID"];
                        $verified = $row["verified"];
                        $typ = $row["typ"];
                        if ($verified) {
                            $_SESSION["mobile"] = $mobile;
                            $_SESSION["logged_in"] = true;
                            $_SESSION["name"] = $name;
                            $_SESSION["eshterak"] = $eshterak;
                            $_SESSION["remember"] = $rememberME;
                            $_SESSION["typ"] = $typ;
                            if ($rememberME == 'on') {
                                $token = generateToken2();
                                setcookie("token2", $mobile, time() + (10 * 365 * 24 * 60 * 60));
                                setcookie("token1", $token, time() + (10 * 365 * 24 * 60 * 60));
                                $sql = "INSERT INTO token (token,token2)  VALUES ('$token','$mobile')";
                                if (mysqli_query($connection, $sql)) {

                                }
                            } else {
                                $sql = "DELETE FROM token WHERE token2='$mobile'";
                                if (mysqli_query($connection, $sql)) {

                                }
                                setcookie("token2", $mobile, time() + (10 * 365 * 24 * 60 * 60));
                                setcookie("token1", $token, time() + (10 * 365 * 24 * 60 * 60));
                            }
                            echo "<meta http-equiv=\"refresh\" content=\"0;url=/\">";
                            exit();
                        } else {
                            $payam = "<h4>ثبت نام شما تکمیل نشده است، لطفا برای تکمیل ثبت نام کد ارسال شده به شماره موبایل خود را در این بخش وارد کنید.</h4>";
                            include 'Verifyregister.php';
                        }
                    }
                    else {
//                                    $stmt = $connection->prepare("SELECT mobile,name,family,eshterakID,type,verified,Password FROM Users WHERE (mobile=?)");
//                                    $stmt->bind_param("s", $mobile);
//                                    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
//                                    $result = $stmt->get_result();
//                                    if ($result->num_rows > 0) {
//                                    $row = $result->fetch_assoc();
//                                    include 'class-phpass.php';
//                                    $hash = $row['Password'];
//                                    $wp_hasher = new PasswordHash(8, TRUE);
//                                    $check = $wp_hasher->CheckPassword($password, $hash);
//                                    if ($check) {
//                                        $row = $result->fetch_assoc();
//                                        $stmt->close();
//                                        $name = $row["name"];
//                                        $family = $row["family"];
//                                        $eshterak = $row["eshterak"];
//                                        $type = $row["type"];
//                                        $verified = $row["verified"];
//                                        if ($verified) {
//                                            $_SESSION["mobile"] = $mobile;
//                                            $_SESSION["logged_in"] = true;
//                                            $_SESSION["name"] = $name;
//                                            $_SESSION["family"] = $family;
//                                            $_SESSION["eshterak"] = $eshterak;
//                                            $_SESSION["type"] = $type;
//                                            $_SESSION["remember"] = $rememberME;
//                                            if ($rememberME == 'on') {
//                                                $token = generateToken2();
//                                                setcookie("token2", $mobile, time() + (10 * 365 * 24 * 60 * 60));
//                                                setcookie("token1", $token, time() + (10 * 365 * 24 * 60 * 60));
//                                                $sql = "INSERT INTO token (token,token2)  VALUES ('$token','$mobile')";
//                                                if (mysqli_query($connection, $sql)) {
//
//                                                }
//                                            } else {
//                                                $sql = "DELETE FROM token WHERE token2='$mobile'";
//                                                if (mysqli_query($connection, $sql)) {
//
//                                                }
//                                                setcookie("token2", "");
//                                                setcookie("token1", "");
//                                            }
//                                            echo "<meta http-equiv=\"refresh\" content=\"0;url=/\">";
//                                            exit();
//                                        } else {
//                                            $payam = "<h4>ثبت نام شما تکمیل نشده است، لطفا برای تکمیل ثبت نام کد ارسال شده به شماره موبایل خود را در این بخش وارد کنید.</h4>";
//                                            include 'Verifyregister.php';
//                                        }
//                                    } else {
//                                    include 'header.php';
//                                    ?>
<!--                                    <div class="container paddingtop">-->
<!--                                        <div class="row">-->
<!--                                            <div class="col-md-6 col-md-offset-3">-->
<!--                                                <div class="panel panel-login">-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col-11">-->
<!--                                                            <h4> نام کاربری و پسورد وارد شده اشتباه است مجددا تلاش کنید.-->
<!--                                                            </h4>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        --><?php
//                                        include 'MyIncludeLogin.php';
//                                        }
//                                        }else{
                        include 'header.php';
                        ?>
                        <div class="container paddingtop">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="panel panel-login">
                                        <div class="row">
                                            <div class="col-11">
                                                <h4> نام کاربری و پسورد وارد شده اشتباه است مجددا تلاش کنید.
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            include 'MyIncludeLogin.php';
//                                            }
                    }
                }
            }
        }else if (isset($_POST['verifymobile'])){
            $verifymobile=$_POST['verifymobile'];
            $CODE=$_POST['CODE'];
            $stmt  = $connection->prepare("SELECT email,name,eshterakID,attempt,typ FROM users WHERE (mobile=? AND verificationcode=? AND verified=0)");
            $stmt->bind_param("ss", $verifymobile,$CODE);
            $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $typ = $row["typ"];
                $result = $connection->query("UPDATE users SET verified=1 WHERE (mobile='$verifymobile' AND verified=0)");
                $_SESSION["mobile"] = $verifymobile;
                $_SESSION["logged_in"] = true;
                $_SESSION["name"] = $row['name'];
                $_SESSION["remember"] = 'off';
                $_SESSION["typ"] = $typ;

                echo "<meta http-equiv=\"refresh\" content=\"0;url=/\">";
                exit();
            }else {
                $payam="<h4>اطلاعات وارد شده معتبر نمی باشد.</h4>";
                include 'Verifyregister.php';
            }
        }else if (isset($_POST['getcode'])){
            $mobile=$_POST['getcode'];
            $stmt  = $connection->prepare("SELECT email,name,eshterakID,attempt,verificationcode,UNIX_TIMESTAMP(CURRENT_TIMESTAMP)-UNIX_TIMESTAMP(codetime) as codetime FROM users WHERE (mobile=? AND verified=0)");
            $stmt->bind_param("s", $mobile);
            $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $MobileNumbers = array($mobile);
                // your text messages
                $Messages = array("کد فعال سازی شما در سایت ویکی‌درم:".$row['verificationcode']);
                if ($row['attempt']==1){
                    if ($row['codetime']>120) {
                        $verificationcode=$row['verificationcode'];
                        // your mobile numbers
//                            $MobileNumbers = array($mobile);
                        $MobileNumber=$mobile;
                        $Code=$verificationcode;
                        // your text messages
//                        include 'SMS/SmsIR_VerificationCode.php';
                        $result = $connection->query("UPDATE users SET attempt=attempt+1 WHERE (mobile='$mobile' AND verified=0)");
                        $payam="<h4>کد فعال سازی با موفقیت برای شما ارسال شد.</h4>";
                        include 'Verifyregister.php';
                    }else {
                        $wait=120-$row['codetime'];
                        $payam="برای دریافت مجدد کد باید ".$wait." ثانیه صبر کنید و مجددا دوباره تلاش کنید. در صورت عدم دریافت با شماره 09035675570 تماس حاصل فرمائید";
                        include 'notgetcode.php';
                    }
                }else if ($row['attempt']==2){
                    if ($row['codetime']>300){
                        $verificationcode=$row['verificationcode'];
                        // your mobile numbers
//                            $MobileNumbers = array($mobile);
                        $MobileNumber=$mobile;
                        $Code=$verificationcode;
                        // your text messages
//                        include 'SMS/SmsIR_VerificationCode.php';
                        $result = $connection->query("UPDATE users SET attempt=attempt+1 WHERE (mobile='$mobile' AND verified=0)");
                        $payam="<h4>کد فعال سازی با موفقیت برای شما ارسال شد.</h4>";
                        include 'Verifyregister.php';
                    }else {
                        $wait=300-$row['codetime'];
                        $payam="برای دریافت مجدد کد باید ".$wait." ثانیه صبر کنید و مجددا دوباره تلاش کنید. در صورت عدم دریافت با شماره 09035675570 تماس حاصل فرمائید";
                        include 'notgetcode.php';
                    }
                }else if ($row['attempt']==3){
                    if ($row['codetime']>600){
                        $verificationcode=$row['verificationcode'];
                        // your mobile numbers
//                            $MobileNumbers = array($mobile);
                        $MobileNumber=$mobile;
                        $Code=$verificationcode;
                        // your text messages
//                        include 'SMS/SmsIR_VerificationCode.php';
                        $result = $connection->query("UPDATE users SET attempt=attempt+1 WHERE (mobile='$mobile' AND verified=0)");
                        $payam="<h4>کد فعال سازی با موفقیت برای شما ارسال شد.</h4>";
                        include 'Verifyregister.php';
                    }else {
                        $wait=600-$row['codetime'];
                        $payam="برای دریافت مجدد کد باید ".$wait." ثانیه صبر کنید و مجددا دوباره تلاش کنید. در صورت عدم دریافت با شماره 09035675570 تماس حاصل فرمائید";
                        include 'notgetcode.php';
                    }
                }else  if (($row['attempt']>3)&&($row['attempt']<10)){
                    if ($row['codetime']>3600){
                        $verificationcode=$row['verificationcode'];
                        // your mobile numbers
//                            $MobileNumbers = array($mobile);
                        $MobileNumber=$mobile;
                        $Code=$verificationcode;
                        // your text messages
//                        include 'SMS/SmsIR_VerificationCode.php';
                        $result = $connection->query("UPDATE users SET attempt=attempt+1 WHERE (mobile='$mobile' AND verified=0)");
                        $payam="<h4>کد فعال سازی با موفقیت برای شما ارسال شد.</h4>";
                        include 'Verifyregister.php';
                    }else {
                        $wait=3600-$row['codetime'];
                        $payam="برای دریافت مجدد کد باید ".$wait."  ثانیه صبر کنید و مجددا دوباره تلاش کنید.در صورت عدم دریافت با شماره 09035675570 تماس حاصل فرمائید";
                        include 'notgetcode.php';
                    }
                }else {
                    if ($row['codetime']>3600*24){
                        $verificationcode=$row['verificationcode'];
                        // your mobile numbers
//                            $MobileNumbers = array($mobile);
                        $MobileNumber=$mobile;
                        $Code=$verificationcode;
                        // your text messages
//                        include 'SMS/SmsIR_VerificationCode.php';
                        $result = $connection->query("UPDATE users SET attempt=attempt+1 WHERE (mobile='$mobile' AND verified=0)");
                        $payam="<h4>کد فعال سازی با موفقیت برای شما ارسال شد.</h4>";
                        include 'Verifyregister.php';
                    }else {
                        $wait=3600*24-$row['codetime'];
                        $payam="برای دریافت مجدد کد باید ".$wait." ثانیه صبر کنید و مجددا دوباره تلاش کنید.در صورت عدم دریافت با شماره 09035675570 تماس حاصل فرمائید";
                        include 'notgetcode.php';
                    }
                }
            }else {
                $payam="شماره موبایل وارد شده معتبر نمی باشد.";
                include 'notgetcode.php';
            }
        }else if (isset($_GET['getcode'])){
            $payam="";
            include 'notgetcode.php';
        }else if (isset($_POST['sendpassword'])){
            $mobile=$_POST['sendpassword'];
            $stmt  = $connection->prepare("SELECT pass ,attemptgetpassword,UNIX_TIMESTAMP(CURRENT_TIMESTAMP)-UNIX_TIMESTAMP(passwordtime) as time FROM users WHERE (mobile=?)");
            $stmt->bind_param("s", $mobile);
            $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['time']>12){
                    $MobileNumbers = array($mobile);
                    // your text messages
                    $Messages = array("پسورد شما در سایت ویکی‌درم:".$row['Password']);
//                    include 'SMS/SendMessage.php';
                    $result = $connection->query("UPDATE users SET passwordtime=current_timestamp WHERE (mobile='$mobile')");
                    include 'header.php';
                    ?>
                    <div class="container paddingtop">
                    <?php
                    //nothing show loginregister
                    include 'MyIncludeLogin.php';
                }else {
                    $wait=3600*12-$row['time'];
                    $payam2="برای دریافت پسورد باید ".$wait." ثانیه صبر کنید. ";
                    $payam="FORGETPASSWORDSECRET";
                    include 'ForgetPassword.php';
                }
            }else {
                $payam2="شماره موبایل وارد شده معتبر نمی باشد.";
                $payam="FORGETPASSWORDSECRET";
                include 'ForgetPassword.php';
            }
        }else if (isset($_GET['getpassword'])){
            $payam="FORGETPASSWORDSECRET";
            $payam2="برای دریافت پسورد خود، شماره موبایل خود را در بخش زیر وارد کنید.";
            include 'ForgetPassword.php';
        }else {
            include 'header.php';
            ?>
            <div class="container paddingtop">
            <?php
            //nothing show loginregister
            include 'MyIncludeLogin.php';
        }
    }
    ?>
    </div>
    <?php
    include 'Footer.php';
    ?>
    <script type="text/javascript" charset="utf-8">
        var onloadCallback = function() {
            var recaptchas = document.querySelectorAll('div[class=g-recaptcha]');
            for( i = 0; i < recaptchas.length; i++) {
                grecaptcha.render(recaptchas[i], {
                    'sitekey': '6LdBvYkUAAAAAM4dmGD1D36TXX1fwssNLGnoz8j9',
                });
            }
        }
    </script>
    </body>

    </html>

<?php
function generateRandomString($length = 6) {
    $characters = '0123456789';
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

