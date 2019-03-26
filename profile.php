<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/14/19
 * Time: 5:55 PM
 */
session_start();

include 'Settings.php';


$productXMLNAME = "XMLs/profile.xml";
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
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title><?php echo $SEOTITLE?></title>
    <meta name="description" content="<?php echo $SEOdescription;?>">
    <meta name="keywords" content="<?php echo $SEOKEYWORDS;?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $SEOTITLE?>">
    <meta property="og:description" content="<?php echo $SEOdescription;?>">
    <meta property="og:url" content="https://wikiderm.ir/">
    <meta property="og:site_name" content="ویکی‌درم">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/x-icon" href="/images/wikiderm-icon--300x300.png" />
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <script src="/js/jQuery.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    <link rel="stylesheet" href="/css/global.css"/>
    <link rel="stylesheet" href="/css/profile.css"/>
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
    <script src="/js/profile.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=fa'></script>

    <link rel="stylesheet" href="/froala/css/froala_editor.css">
    <link rel="stylesheet" href="/froala/css/froala_style.css">
    <link rel="stylesheet" href="/froala/css/plugins/code_view.css">
    <link rel="stylesheet" href="/froala/css/plugins/colors.css">
    <link rel="stylesheet" href="/froala/css/plugins/emoticons.css">
    <link rel="stylesheet" href="/froala/css/plugins/image.css">
    <link rel="stylesheet" href="/froala/css/plugins/line_breaker.css">
    <link rel="stylesheet" href="/froala/css/plugins/table.css">
    <link rel="stylesheet" href="/froala/css/plugins/char_counter.css">
    <link rel="stylesheet" href="/froala/css/plugins/video.css">
    <link rel="stylesheet" href="/froala/css/plugins/fullscreen.css">
    <link rel="stylesheet" href="/froala/css/plugins/file.css">
    <link rel="stylesheet" href="/froala/css/plugins/quick_insert.css">


</head>

<body>
<?php
if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]){
    echo "<meta http-equiv=\"refresh\" content=\"0;url=/\">";
    exit();
}
else if($_GET['request']=='update'){
    $stmt = $connection->prepare("SELECT name, mobile , categoryID , address , email,showMobile FROM Users WHERE (mobile=? )");
    $stmt->bind_param("s", $_SESSION["mobile"]);
    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        $name = $row["name"];
        $email = $row["email"];
        $address = $row["address"];
        $cat = $row["categoryID"];
        $showMobile = $row["showMobile"];

        if ((isset($_POST['name'])) && $_POST['name'] != $name) {
            $stmt = $connection->prepare("UPDATE Users SET name=? , stat=0 WHERE (mobile=? )");
            $stmt->bind_param("ss", $_POST['name'], $_SESSION["mobile"]);
            $stmt->execute();
            $_SESSION["name"] = $_POST['name'];
        }
        if ((isset($_POST['email'])) && $_POST['email'] != $email) {
            $stmt = $connection->prepare("UPDATE Users SET email=? , stat=0 WHERE (mobile=? )");
            $stmt->bind_param("ss", $_POST['email'], $_SESSION["mobile"]);
            $stmt->execute();
        }
        if ((isset($_POST['address'])) && $_POST['address'] != $address) {
            $stmt = $connection->prepare("UPDATE Users SET address=? , stat=0 WHERE (mobile=? )");
            $stmt->bind_param("ss", $_POST['address'], $_SESSION["mobile"]);
            $stmt->execute();
        }
        if ((isset($_POST['category'])) && $_POST['category'] != $cat) {
            $stmt = $connection->prepare("UPDATE Users SET categoryID=?  WHERE (mobile=? )");
            $stmt->bind_param("ss", $_POST['category'], $_SESSION["mobile"]);
            $stmt->execute();
        }

        if ((isset($_POST['showMobile'])) && $_POST['showMobile'] != $showMobile) {
            $stmt = $connection->prepare("UPDATE Users SET showMobile=?  WHERE (mobile=? )");
            $stmt->bind_param("ss", $_POST['showMobile'], $_SESSION["mobile"]);
            $stmt->execute();
        }

        if (isset($_FILES["imgupload"])) {
            $imagenames = $_FILES["imgupload"]["name"];
            $imagetempname = $_FILES["imgupload"]["tmp_name"];
            $uploadOk = 0;
            $URL = "";
            for ($i = 0; $i < sizeof($imagetempname); $i++) {
                $NAMESSS = "";
                $TMPNAMESSS = "";
                if (sizeof($imagetempname) == 1) {
                    $NAMESSS = $imagenames;
                    $TMPNAMESSS = $imagetempname;
                }
                if (strlen($NAMESSS) > 0) {
                    $target_dir = "images/users/";
                    $BBB = (string)uniqid();
                    $target_file = $target_dir . $BBB . basename($NAMESSS);
                    $uploadOk = 1;
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($TMPNAMESSS);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        if ($_FILES["imgupload"]["type"] == "TIFF/PNG/JPEG/GIF"){
                            $uploadOk = 1;
                        }else{
                            $uploadOk = 0;
                        }
                    }
                    if ($uploadOk == 0) {
                    } else {
                        $file_size = $_FILES['imgupload']['size'];

                        if (($file_size > 2097152)) {
                            $uploadOk = 0;
                        }
                        if ($uploadOk == 1) {
                            $stmt = $connection->prepare("UPDATE Users SET image=? , stat=0 WHERE (mobile=? )");
                            $stmt->bind_param("ss", $target_file, $_SESSION["mobile"]);
                            $stmt->execute();
                            if (move_uploaded_file($TMPNAMESSS, $target_file)) {

                            } else {
                                $uploadOk = 0;
                            }
                        }
                    }
                } else {
                    $uploadOk = 0;
                }

            }
        } else {
            $imagetempname = "";
            $imagenames = "";
        }
    }
    $tab=1;
}
else if($_GET['request']=='post') {
    if ((isset($_POST['editor1'])) && (isset($_POST['sum'])) && (isset($_POST['subject'])) && (isset($_POST['category1'])) && (strlen($_POST['editor1']) > 0) && (strlen($_POST['sum']) > 0) && (strlen($_POST['subject']) > 0) && (strlen($_POST['category1']) > 0)) {
        if(isset($_GET['paper'])) {
            $paperid = $_GET['paper'];
            $query = "SELECT * FROM Paper WHERE ID = '$paperid'";
            $result = $connection->query($query);
            $row = $result->fetch_assoc();
            $image = $row['image'];
        }
        else{
            $image = "";
        }

        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->setIndent(true);
        $writer->startDocument('1.0" encoding="UTF-8');
        $writer->startElement('paper');
//        $writer->writeElement('code', $name);
        $writer->writeElement('subject', $_POST['subject']);


        if(isset($_GET['paper'])) {
            $filename = $row['XMLNAME'];
            $englishtopic =  $row['post_name'];
        }
        else{
            echo "5";
            $BBB = (string)uniqid();
            $englishtopic = 'paper'.$BBB;
            $englishtopic=str_replace(" ","-",$englishtopic);
            $filename = 'XMLs/PaperXMLs/' . $englishtopic . '.xml';
        }

        $uploadOk = 0;
        $URL = "";
        $writer->writeElement('data', $_POST['editor1']);
        $writer->writeElement('summary', $_POST['sum']);
        $writer->endElement();
        $writer->endDocument();
        $file = $writer->outputMemory();
        file_put_contents($filename, $file);

        $datashould=$_POST['editor1'];
        $datashould2=$_POST['sum'];
        $titleshould=$_POST['subject'];
        $category = $_POST['category1'];

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
        $modified_time = $jyear . '/' . $jmonth . '/' . $jday.' '.$time;

        echo "6";

        if (isset($_FILES["imgPost"])) {
            echo "7";
            $imagenames = $_FILES["imgPost"]["name"];
            $imagetempname = $_FILES["imgPost"]["tmp_name"];
            $uploadOk = 0;
            $URL = "";
            for ($i = 0; $i < sizeof($imagetempname); $i++) {
                $NAMESSS = "";
                $TMPNAMESSS = "";
                if (sizeof($imagetempname) == 1) {
                    $NAMESSS = $imagenames;
                    $TMPNAMESSS = $imagetempname;
                }
                if (strlen($NAMESSS) > 0) {
                    $target_dir = "images/Papers/";
                    $BBB = (string)uniqid();
                    $target_file = $target_dir . $BBB . basename($NAMESSS);
                    $uploadOk = 1;
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($TMPNAMESSS);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        if ($_FILES["imgPost"]["type"] == "TIFF/PNG/JPEG/GIF"){
                            $uploadOk = 1;
                        }else{
                            $uploadOk = 0;
                        }
                    }
                    if ($uploadOk == 0) {
                    } else {
                        $file_size = $_FILES['imgPost']['size'];

                        if (($file_size > 2097152)) {
                            $uploadOk = 0;
                        }
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($TMPNAMESSS, $target_file)) {

                            } else {
                                $uploadOk = 0;
                            }
                        }
                    }
                } else {
                    echo "9";
                    $uploadOk = 0;
                    $imagetempname = "";
                    $imagenames = "";
                    $target_file = $image;
                }

            }
        } else {
            echo "8";
            $imagetempname = "";
            $imagenames = "";
            $target_file = $image;
        }

        if (strlen($target_file)<1)
            $target_file = 'images/no-product-image-available.png';

        if(isset($_GET['paper'])){
            echo "10";
            $paperid = $_GET['paper'];
            $stmt = $connection->prepare("UPDATE Paper SET name=? ,  stat=0 ,dastebandi=? , Mokhtasar=? , image=?  WHERE (ID=? AND writerID=?)");
            $stmt->bind_param("ssssss", $titleshould,$category,$datashould2,$target_file, $paperid ,$_SESSION["mobile"]);
            echo "here";
        }
        else {
            echo "11";
            $stmt = $connection->prepare("INSERT INTO Paper (XMLNAME,name,post_name,writerID, realtime , dastebandi,Mokhtasar,image)  VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssss", $filename, $titleshould, $englishtopic, $_SESSION["mobile"], $modified_time, $category, $datashould2, $target_file);
        }
//        else {
////            echo "<script>window.alert('update db');</script>";
//            $stmt  = $connection->prepare("UPDATE azmun SET xmlAdress=?,title=?,dateAzmun=?, dateKart=?,dateNatayej=?,dateNatayejNahayi=?,dateMosahebe=?,englishName=?,typ=?,state=?,realtime=?,ostan=? WHERE ID='$product'");
//            $stmt->bind_param("ssssssssssss", $filename,$titleshould,$dateAzmun,$dateKart,$dateNatayej,$dateNatayejNahayi,$dateMosahebe,$englishtopic,$azmuntype,$state,$modified_time,$CITy);
//        }
        $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
        $stmt->store_result();
        $result = $stmt->get_result();
        echo $result;
        echo $connection->error;
//        if ($product === "all") {
//            $product =$connection->insert_id;
//        }
        $movafagh = 'عملیات مورد نظر با موفقیت انجام شد.';
        if ($connection->error) {
            echo "12";
            $movafagh = 'عملیات مورد نظر موفق نبود. وارد کردن تمامی موارد الزامی است.';
            $product="namovafagh";
            if (isset($_POST['subject'])){
                $titleshould=$_POST['subject'];
            }
            if (isset($_POST['editor'])){
                $datashould=$_POST['editor'];
            }
            if (isset($_POST['sum'])){
                $datashould2=$_POST['sum'];
            }
            if (isset($_POST['category1'])){
                $category=$_POST['category1'];
            }

        }else{
            echo "13";
            echo "<script>alert('عملیات مورد نظر موفقیت آمیز بود.');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/Paper/'.$englishtopic.'">';
//            die();
        }
    }
    else {
        $titleshould = $_POST['subject'];
        $datashould = $_POST['editor'];
        $datashould2 = $_POST['sum'];
        $category = $_POST['category1'];
        echo "<script>alert('لطفااطلاعات خواسته شده را کامل کنید.');</script>";
    }
    $tab = 4;

}

else if(isset($_GET['requestEdit'])) {
    $id = $_GET['requestEdit'];
    $mob = $_SESSION["mobile"];
    $query = "SELECT * FROM Paper WHERE (ID = '$id' AND writerID='$mob')";
    $result = $connection->query($query);
    echo "<script>window.alert('$query');</script>";
    if( $row = $result->fetch_assoc() ) {
        $titleshould = $row['name'];
        $datashould2 = $row['Mokhtasar'];
        $category = $row['dastebandi'];
        $xmlAdress = $row['XMLNAME'];
        if (file_exists($xmlAdress)) {
            $XMLFile = simplexml_load_file($xmlAdress);
            $datashould = $XMLFile->data;
        } else {
            $datashould = "";
        }
    }else{
        $titleshould = "";
        $datashould = "";
        $datashould2 = "";
        $category = "";
        echo "<script>window.alert('دسترسی شما به این مقاله غیر مجاز است.');</script>";
    }
    $tab=4;
}
else if(isset($_GET['requestDelete'])) {
    $id = $_GET['requestDelete'];
    $query = "SELECT * FROM Paper WHERE  (ID = '$id' AND writerID='".$_SESSION["mobile"]."')";
    $result = $connection->query($query);
    if( $row = $result->fetch_assoc() ) {
        $name = $row['XMLNAME'];
        unlink($name);
        $query = "DELETE FROM Paper WHERE (ID = '$id' AND writerID='" . $_SESSION["mobile"] . "')";
        $result = $connection->query($query);
    }
    else{
        echo "<script>window.alert('دسترسی شما به حذف این مقاله غیر مجاز است.');</script>";
    }
    $tab = 3;
}

else if(isset($_GET['request']) && $_GET['request']=='deleteEshterak'){
    $stmt = $connection->prepare("SELECT name, mobile , categoryID , address , email FROM Users WHERE (mobile=? )");
    $stmt->bind_param("s", $_SESSION["mobile"]);
    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        $x = '4';
        $y = '';
        $stmt = $connection->prepare("UPDATE Users SET eshterakID=?, startTime=?,endTime=? WHERE (mobile=? )");
        $stmt->bind_param("ssss", $x ,$y,$y, $_SESSION["mobile"]);
        $stmt->execute();
        $_SESSION["eshterak"] = $x;
    }
    $tab=5;
}
else if(isset($_GET['request']) && $_GET['request']=='buyEshterak') {
    $id = $_GET['ID'];
    $stmt = $connection->prepare("SELECT qeimat,name,time FROM userEshterak WHERE (ID=? )");
    $stmt->bind_param("s", $_GET['ID']);
    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
    $res = $stmt->get_result();
    if( $row = $res->fetch_assoc()){
        $qeimat = $row['qeimat'];
        $name = $row['name'];
        $t = $row['time'];
    }
    else{
        echo "<script>alert('بسته نا معتبر است. لطفا دوباره تلاش کنید.')</script>>";
        die();
    }

//    $stmt = $connection->prepare("INSERT INTO pardakht (mobile, userEshterakID)  VALUES (?,?)");
//    $stmt->bind_param("ss",$_SESSION["mobile"],$id );
//    $stmt->execute();
//    $stmt->close();


    if($qeimat>99) {

        $MerchantID = '3c5b10c6-6c1f-11e6-9549-005056a205be'; //Required
        $Amount = $qeimat; //Amount will be based on Toman - Required


        $stmt = $connection->prepare("INSERT INTO allpardakht (mobile, userEshterakID,amount,status,code)  VALUES (?,?,?,3,'pending')");
        $stmt->bind_param("sss", $_SESSION["mobile"], $id, $Amount);
        $stmt->execute();
        $stmt->close();

        $insertID = $connection->insert_id;

        if ($connection->error) {
            echo "<script>alert('خطایی رخ داد. لطفا دوباره تلاش کنید.')</script>>";
            die();
        }

//    $Amount = 100;
        $_SESSION['amount'] = $Amount;
        $Description = 'خرید بسته اشتراک ' . $name . ' ویکی‌درم'; // Required
//    $Email = 'UserEmail@Mail.Com'; // Optional
        $Mobile = $_SESSION["mobile"]; // Optional
        $CallbackURL = 'https://wikiderm.ir/profile.php?request=backZarrin&zarrin=' . $insertID; // Required

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );

//Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
            Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
        } else {
            $str = 'خطا: ' . $result->Status . 'لطفا دوباره تلاش کنید.';
            echo '<script>alert(' . $str . ')</script>';
        }
    }
    else {
        $str = 'خطا: لطفا دوباره تلاش کنید.';
        echo '<script>alert(' . $str . ')</script>';

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
        $start = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;


        date_default_timezone_set("Iran");
        $str = "+".$t." days";
        $DATE2 = date('Y-m-d H:i:s' , strtotime($str));
        list($date, $time) = explode(" ", $DATE2);
        list($year, $month, $day) = explode("-", $date);
        list($jyear, $jmonth, $jday) = gregorian_to_jalali($year, $month, $day);
        if (strlen($jmonth) == 1) {
            $jmonth = "0" . $jmonth;
        }
        if (strlen($jday) == 1) {
            $jday = "0" . $jday;
        }
        $modified_time = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;
        $end = $modified_time;

        $stmt = $connection->prepare("UPDATE users SET eshterakID=? , startTime=? , endTime=? WHERE (mobile=?)");
        $stmt->bind_param("ssss", $id,$start, $end,$_SESSION["mobile"] );
        $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
        $stmt->close();
    }
    $tab=5;

}
else if(isset($_GET['request']) && $_GET['request']=='backZarrin') {
    $insertID = $_GET['zarrin'];
    $stmt = $connection->prepare("SELECT * FROM allpardakht WHERE (ID=? )");
    $stmt->bind_param("s",$insertID );
    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
    $res = $stmt->get_result();
    if( $row = $res->fetch_assoc()){
        $qeimat = $row['amount'];
        $id = $row['userEshterakID'];
        $stmt = $connection->prepare("SELECT time FROM userEshterak WHERE (ID=? )");
        $stmt->bind_param("s", $id);
        $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
        $res = $stmt->get_result();
        if( $row = $res->fetch_assoc()){
            $t = $row['time'];
        }
        else{
            echo "<script>alert('دسترسی غیر مجاز.')</script>>";
            die();
        }
    }else{
        echo "<script>alert('دسترسی غیر مجاز.')</script>>";
        die();
    }


    $MerchantID = '3c5b10c6-6c1f-11e6-9549-005056a205be';
    $Amount = $qeimat; //Amount will be based on Toman
//    $Amount = 100;

    $Authority = $_GET['Authority'];

    if ($_GET['Status'] == 'OK') {

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentVerification(
            [
                'MerchantID' => $MerchantID,
                'Authority' => $Authority,
                'Amount' => $Amount,
            ]
        );

        if ($result->Status == 100) { //successfull
            $code = $result->RefID;
            include 'header.php';
            ?>
            <div class="container">
                <div  id="main" class="home_main row">

                    <div class="col-md-12 search hiddenthisoverxs">

                        <div id="sb-search2" class="sb-search">
                            <form class="float-left">
                                <input class="sb-search-input" placeholder="جستجو" type="search" value="" name="search" id="search2">
                                <button class="sb-search-submit sb-icon-search" type="submit" value=""><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">

                        <div class="mainDiv col-md-9 col-12 text-right h-100">

                            <div class="col-11 text-center m-5">
                                <h4 class="text-success">با تشکر از شما . سفارش شما با موفقیت پرداخت شد. شماره پیگیری:
                                    <?php echo $code; ?>
                                </h4>
                            </div>
                        </div>
                        <div class="leftDiv col-md-3 col-12">
                            <div class="col-md-12 text-center addSub float-left">
                                <h3>
                                    ویکی تبلیغ
                                </h3>
                            </div>
                            <?php
                            include 'showAdd.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include 'footer.php';

            $stmt = $connection->prepare("update  allpardakht set status=2 , code=?  where ID=?");
            $stmt->bind_param("ss",$code , $insertID);
            $stmt->execute();
            $stmt->close();

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
            $start = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;


            date_default_timezone_set("Iran");
            $str = "+".$t." days";
            $DATE2 = date('Y-m-d H:i:s' , strtotime($str));
            list($date, $time) = explode(" ", $DATE2);
            list($year, $month, $day) = explode("-", $date);
            list($jyear, $jmonth, $jday) = gregorian_to_jalali($year, $month, $day);
            if (strlen($jmonth) == 1) {
                $jmonth = "0" . $jmonth;
            }
            if (strlen($jday) == 1) {
                $jday = "0" . $jday;
            }
            $modified_time = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;
            $end = $modified_time;

//            echo $start.'<br>'.$end.'<br>';

            $stmt = $connection->prepare("UPDATE users SET eshterakID=? , startTime=? , endTime=? WHERE (mobile=?)");
            $stmt->bind_param("ssss", $id,$start, $end,$_SESSION["mobile"] );
            $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
            $stmt->close();

        } else { //onsuccesful
            $code = get_error($result->Status);

            include 'header.php';
            ?>
            <div class="container">
                <div  id="main" class="home_main row">

                    <div class="col-md-12 search hiddenthisoverxs">

                        <div id="sb-search2" class="sb-search">
                            <form class="float-left">
                                <input class="sb-search-input" placeholder="جستجو" type="search" value="" name="search" id="search2">
                                <button class="sb-search-submit sb-icon-search" type="submit" value=""><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">

                        <div class="mainDiv col-md-9 col-12 text-right h-100">

                            <div class="col-11 text-center m-5">
                                <h4 class="text-danger">پرداخت شما ناموفق بوده است . لطفا مجددا تلاش نمایید یا در صورت بروز اشکال با مدیریت سایت تماس بگیرید. وضعیت:
                                    <?php echo $code;  ?>
                                </h4>
                                <a href="/profile.php" title="پروفایل"> مجددا تلاش کنید.</a>
                            </div>
                        </div>
                        <div class="leftDiv col-md-3 col-12">
                            <div class="col-md-12 text-center addSub float-left">
                                <h3>
                                    ویکی تبلیغ
                                </h3>
                            </div>
                            <?php
                            include 'showAdd.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include 'footer.php';

            $stmt = $connection->prepare("update  allpardakht set status=1 ,code=? where ID=?");
            $stmt->bind_param("ss",$code,$insertID);
            $stmt->execute();
            $stmt->close();
        }
    } else { //canceled
        $code = 'canceled';

        include 'header.php';
        ?>

        <div class="container">
            <div  id="main" class="home_main row">

                <div class="col-md-12 search hiddenthisoverxs">

                    <div id="sb-search2" class="sb-search">
                        <form class="float-left">
                            <input class="sb-search-input" placeholder="جستجو" type="search" value="" name="search" id="search2">
                            <button class="sb-search-submit sb-icon-search" type="submit" value=""><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">

                    <div class="mainDiv col-md-9 col-12 text-right h-100">

                        <div class="col-11 text-center m-5">
                            <h4 class="text-danger">پرداخت توسط شما لغو گردید.</h4>
                            <a href="/profile.php" title="پروفایل"> مجددا تلاش کنید.</a>
                        </div>
                    </div>
                    <div class="leftDiv col-md-3 col-12">
                        <div class="col-md-12 text-center addSub float-left">
                            <h3>
                                ویکی تبلیغ
                            </h3>
                        </div>
                        <?php
                        include 'showAdd.php';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include 'footer.php';

        $stmt = $connection->prepare("update allpardakht set status=0 ,code=?  where ID=?");
        $stmt->bind_param("ss",$code,$insertID);
        $stmt->execute();
        $stmt->close();
    }
//    $stmt = $connection->prepare("Delete FROM pardakht WHERE (ID=? )");
//    $stmt->bind_param("s",$insertID );
//    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
//    $result = $stmt->get_result();
//    echo '<a href="/profile.php">بازگشت به صفحه پروفایل </a>';

    die();
}
else if(isset($_GET['request']) && $_GET['request']=='changePass'){

    if(isset($_POST['lastPass']) && isset($_POST['newPass']) && isset($_POST['reNewPass'])) {
        $lastPass = $_POST["lastPass"];
        $newPass = $_POST["newPass"];
        $reNewPass = $_POST["reNewPass"];

        $stmt = $connection->prepare("SELECT pass FROM Users WHERE (mobile=? )");
        $stmt->bind_param("s", $_SESSION["mobile"]);
        $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stmt->close();
            $pass = $row["pass"];

            if ($lastPass != $pass) {
                echo "<script>alert('لطفا رمز قبلی خود را درست وارد کنید.')</script>>";
                $tab = 6;
            }
            else if($newPass!=$reNewPass){
                echo "<script>alert('عدم مطابقت رمز جدید و تکرار رمز جدید، لطفا دوباره تلاش کنید.')</script>>";
                $tab = 6;
            }
            else if($lastPass==$newPass){
                echo "<script>alert('رمز عبور وارد شده نباید برابر رمز قبلی شما باشد.')</script>>";
                $tab = 6;
            }
            else if(strlen($newPass)<8){
                echo "<script>alert('طول رمز جدید باید حداقل ۸ کاراکتر باشد. لطفا دوباره تلاش کنید.')</script>>";
                $tab = 6;
            }
            else if($lastPass == $pass && $newPass==$reNewPass && $lastPass!=$newPass && strlen($newPass)>=8){
                $stmt = $connection->prepare("UPDATE Users SET pass=? WHERE (mobile=? )");
                $stmt->bind_param("ss", $newPass , $_SESSION["mobile"]);
                $stmt->execute();
                echo "<script>alert('رمز عبور شما با موفقیت تغییر کرد.')</script>>";
                $tab = 1;
            }
            else{
                echo "<script>alert('خطای نامشخص، لطفا دوباره تلاش کنید.')</script>>";
                $tab = 6;
            }

        }
        else{
            echo "<script>alert('دسترسی غیر مجاز.')</script>>";
            $tab = 1;
        }

    }
    else{
        echo "<script>alert('اطلاعات خواسته شده را با دقت پر کنید.')</script>>";
        $tab = 6;
    }
}
else{
    $titleshould='';
    $datashould = '';
    $datashould2 = '';
    $category = -1;
    $tab = 1;
}
include 'header.php';
?>


<div class="container">
    <div  id="main" class="home_main row">

        <div class="col-md-12 search hiddenthisoverxs">
            <div id="sb-search2" class="sb-search">
                <form class="float-left">
                    <input class="sb-search-input" placeholder="جستجو" type="search" value="" name="search" id="search2">
                    <button class="sb-search-submit sb-icon-search" type="submit" value=""><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="col-md-12">

            <?php
            $stmt = $connection->prepare("SELECT * FROM Users WHERE (mobile=? )");
            $stmt->bind_param("s", $_SESSION["mobile"]);
            $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stmt->close();
                $name = $row["name"];
                $email = $row["email"];
                $address = $row["address"];
                $eshterak = $row["eshterakID"];
                $cat = $row["categoryID"];
                $img = $row["image"];
                $startTime = $row["startTime"];
                $endTime = $row["endTime"];
                $show = $row["showMobile"];
                $useFree = $row["useFreeEshterak"];

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
                $today = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;

                if($endTime<$today) {
                    $eshterak = 4;
                    $stmt = $connection->prepare("UPDATE users set eshterakID=4 WHERE (mobile=?)");
                    $stmt->bind_param("s", $_SESSION["mobile"]);
                    $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
                    $stmt->store_result();
                    $result = $stmt->get_result();
                }
//                echo '<script>alert('.$startTime.')</script>';
//                echo '<script>alert('.$endTime.')</script>';

                ?>

                <div class="mainDiv col-md-9 col-12 text-right">


                    <div class="row">
                        <div class="userDiv col-md-3 col-12">
                            <img src="<?php  echo '/'.$img;?>" alt="Avatar" class="image avatar" style="width:100%" id="userPic">
                            <div class="middle text">
                                بارگذاری عکس
                                <input type="file" id="imgupload" name="imgupload" style="display:none" onchange="readURL(this);" form="userInfo"/>
                                <img src="/images/icons/iconfinder-icon.svg" alt="camera" class="" style="width:100%" id="OpenImgUpload">

                            </div>
                        </div>
                        <div class="col-md-9 col-12 pt-5">
                            <h2><?php  echo $name;?></h2>
                        </div>
                    </div>


                    <div class="tab">
                        <button class="tablinks <?php if($tab==1) echo "active";?>" onclick="openCity(event, 'personal')">شخصی</button>
                        <button class="tablinks <?php if($tab==2) echo "active";?>"  onclick="openCity(event, 'comments')">دیدگاه‌ها</button>
                        <button class="tablinks <?php if($tab==3) echo "active";?>" onclick="openCity(event, 'posts')">پست‌ها</button>
                        <button class="tablinks <?php if($tab==4) echo "active";?>" onclick="openCity(event, 'newPost')">پست جدید</button>
                        <button class="tablinks <?php if($tab==5) echo "active";?>" onclick="openCity(event, 'eshterak')">مدیریت اشتراک</button>
                        <button class="tablinks <?php if($tab==6) echo "active";?>" onclick="openCity(event, 'changePass')">تغییر رمز عبور</button>
                    </div>

                    <div id="personal" class="tabcontent pt-4 <?php if($tab==1) echo "d-block"; else echo "d-none";?>">

                        <form action="profile.php?request=update" method="post" class="row" id="userInfo" enctype="multipart/form-data">
                            <div class="form-group col-md-10 m-auto text-right">
                                <label for="name" class="dark_text"><b>نام و نام خانوادگی</b></label>
                                <input type="text" class="form-control" id="name" value="<?php echo $name; ?>"
                                       name="name">
                            </div>
                            <div class="form-group col-md-10 m-auto text-right">
                                <label for="mobile" class="dark_text"><b>شماره همراه</b></label>
                                <input type="text" class="form-control" id="mobile"
                                       value="<?php echo $_SESSION["mobile"]; ?>" name="mobile" readonly>
                            </div>
                            <div class="form-group col-md-10 m-auto text-right">
                                <label for="showMobile" class="dark_text"><b>نمایش شماره همراه در پروفایل شخصی (قابل رویت برای تمامی کاربران سایت)</b></label>
                                <select name="showMobile" class="form-control required" id="showMobile">
                                    <option value="0" <?php if ($show == 0) echo "selected=\"selected\""; ?> >خیر</option>
                                    <option value="1" <?php if ($show == 1) echo "selected=\"selected\""; ?> >بله</option>
                                </select>
                            </div>
                            <div class="form-group col-md-10 m-auto text-right">
                                <label for="email" class="dark_text"><b>ایمیل</b></label>
                                <input type="email" class="form-control" id="email" value="<?php echo $email; ?>"
                                       name="email">
                            </div>
                            <div class="form-group col-md-10 m-auto text-right">
                                <label for="address" class="dark_text"><b>آدرس</b></label>
                                <input type="text" class="form-control" id="address" value="<?php echo $address; ?>"
                                       name="address">
                            </div>
                            <div class="form-group col-md-10 m-auto text-right">
                                <label for="category" class="dark_text"><b>دسته‌بندی</b></label>
                                <select name="category" class="form-control required" id="category">
                                    <?php
                                    $query = "SELECT * FROM userCategory;";
                                    $result = $connection->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        $id = $row['ID'];
                                        ?>
                                        <option value="<?php echo $id; ?>" <?php if ($cat == $id) echo "selected=\"selected\""; ?> ><?php echo $name; ?></option>

                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                                <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                                    <button type="submit" class="btn btn-default col-md-12 col-12" id="register">به روز
                                        رسانی
                                    </button>
                                </div>
                            </div>

                        </form>


                    </div>


                    <div id="comments" class="tabcontent  <?php if($tab==2) echo "d-block"; else echo "d-none";?>">

                        <p>سرویس کامنت فعلا در دسترس نمی‌باشد.</p>
                    </div>

                    <div id="posts" class="tabcontent  <?php if($tab==3) echo "d-block"; else echo "d-none";?>">
                        <?php
                        $query = "SELECT * FROM Paper WHERE writerID LIKE '".$_SESSION["mobile"]."'";
                        $result = $connection->query($query) ;
                        $pagenum = $result->num_rows;
                        if($pagenum>0) {


                            ?>

                            <div class="col-md-12 text-right">

                                <div class=" row">
                                    <div id="replacepagination1" class="<?php echo $_SESSION["mobile"];?>">

                                        <?php
                                        $page = 1;
                                        $a = ($page - 1) * 2;
                                        $query = "SELECT * FROM Paper WHERE writerID LIKE '".$_SESSION["mobile"]."' ORDER by ID DESC LIMIT $a , 2;";
                                        $result = $connection->query($query);
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['ID'];
                                            $name = $row['name'];
                                            $writerID = $row['writerID'];
                                            $writer = $_SESSION['name'];
//                                            $q = "SELECT * FROM users WHERE mobile=".$writerID.";";
//                                            $res = $connection->query($q);
//                                            if($rw=$res->fetch_assoc())
//                                                $writer = $rw['name'];
//                                            else
//                                                $writer = 'ناشناس';
                                            $time = $row['realtime'];
                                            $link = '/Paper/' . $row['post_name'];
                                            $mokhtasar = $row['Mokhtasar'];
                                            $image = $row['image'];
//                                    $image = substr($image, 3);
                                            ?>

                                            <div class="col-md-12 Paperdiv col-12 float-left ">
                                                <div class="col-md-3 float-right col-12 ">
                                                    <a  href="<?php echo $link; ?> ">
                                                        <img src="/<?php echo $image; ?>" width="100%" height="100%"
                                                             alt="paperimg">
                                                    </a>
                                                </div>

                                                <div class="col-md-9 PaperText float-right col-12 col-12 ">
                                                    <div class="col-md-12 col-12 ">
                                                        <h2 class="papname">
                                                            <a href="<?php echo $link; ?>">
                                                                <?php echo $name; ?>
                                                            </a>
                                                        </h2>
                                                    </div>

                                                    <div class="col-md-12 nametime col-12 row">
                                                        <div class="col-md-4 col-12 ">
                                                            <?php echo $writer; ?>
                                                        </div>
                                                        <div class="col-md-6 col-12 ">
                                                            <?php echo $time; ?>
                                                        </div>
                                                        <div class="col-md-1 col-12" >
                                                            <a href="/profile.php?requestEdit=<?php echo $id;?>" class="edit"><i class="fas fa-edit"></i></a>
                                                        </div>
<!--                                                        <div class="col-md-1 col-12">-->
<!--                                                            <a  href="/profile.php?requestDelete=--><?php //echo $id;?><!--" class="delete"><i class="fas fa-trash-alt"></i></a>-->
<!--                                                        </div>-->
                                                    </div>
                                                    <div class="col-md-12 summ col-12 ">
                                                        <?php echo $mokhtasar; ?>
                                                    </div>
                                                </div>




                                            </div>

                                            <br>

                                            <?php
                                        }

                                        ?>

                                        <div class="pagination-container float-left">
                                            <ul class="pagination">
                                                <li id="-1" class="PagedList-skipToNext paginationoldPapers1" rel="prev">
                                                    >>
                                                </li>
                                                <?php
                                                $x = ($pagenum + 1) / 2;
                                                for ($i = 1; $i <= min($x, 2); $i++) {
                                                    ?>
                                                    <li id="<?php echo $i ?>"
                                                        class="paginationoldPapers1 <?php if ($i == 1) echo "active" ?> "><?php echo $i ?></li>
                                                    <?php

                                                }
                                                $i--;
                                                if ($i < max(1, floor($x) - 1))
                                                    echo "<li>...</li>";
                                                if ($i < max(1, floor($x))) {
                                                    ?>
                                                    <li id="<?php echo floor($x) ?>"
                                                        class="paginationoldPapers1"><?php echo floor($x) ?></li>
                                                    <?php
                                                }

                                                ?>

                                                <li id="-2" class="PagedList-skipToNext paginationoldPapers1" rel="next">
                                                    <<
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php
                        }
                        else{?>
                            <div class="m-5">
                                در حال حاضر پستی از شما وجود ندارد. برای ارسال پست به تب پست جدید در قسمت پروفایل کاربری مراجعه کنید.
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div id="newPost" class="tabcontent  <?php if($tab==4) echo "d-block"; else echo "d-none";?>">
                        <?php
                        if($eshterak==4){
                            ?>
                            <div class="p-2 text-danger text-center col-md-12">
                             برای ارسال پست باید از تب مدیریت اشتراک، بسته مورد نظر خود را فعال کنید.
                            </div>
                            <?php
//                            if($useFree!=1){
//                                ?>
<!--                                <div class="p-2 text-danger text-center col-md-12">-->
<!--                                   شما برای بار اول می‌توانید از بسته دو ماهه رایگان استفاده کنید. برای فعال سازی به تب مدیریت اشتراک مراجعه کنید.-->
<!--                                </div>-->
<!--                                --><?php
//                            }
                        }else {
                            ?>

                            <form action="profile.php?request=post<?php if (isset($_GET['requestEdit'])) echo "&paper=" . $_GET['requestEdit']; ?>"
                                  method="post" class="row pt-5" id="newPost" enctype="multipart/form-data">
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="subject" class="dark_text"><b>عنوان مطلب</b></label>
                                    <input type="text" class="form-control" id="subject"
                                           value="<?php echo $titleshould; ?>" name="subject">
                                </div>

                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="imgPost" class="dark_text"><b>درج تصویر</b></label>
                                    <input name="imgPost"
                                           accept="image/jpeg,image/gif,image/png"
                                           id="imgPost" class="filestyle form-control" type="file" data-icon="false"
                                           value="">
                                </div>

                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="category1" class="dark_text"><b>انتخاب دسته</b></label>
                                    <select name="category1" class="form-control required" id="category1">
                                        <?php
                                        $query = "SELECT * FROM category;";
                                        $result = $connection->query($query);
                                        while ($row = $result->fetch_assoc()) {
                                            $name = $row['name'];
                                            $id = $row['ID'];
                                            ?>
                                            <option value="<?php echo $id; ?>" <?php if ($category == $id) echo "selected=\"selected\""; ?> ><?php echo $name; ?></option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-10 m-auto text-right pt-5">
                                    <label for="sum" class="dark_text"><b>خلاصه مطلب(به اندازه ۲۰۰ کاراکتر)</b></label>
                                    <textarea rows="10" maxlength="200" name="sum" id="sum"
                                              class="form-control"><?php echo $datashould2; ?> </textarea>

                                </div>


                                <div class="form-group col-md-10 m-auto text-right pt-5">
                                    <label for="editor1" class="dark_text"><b>متن مقاله</b></label>
                                    <div id="editor">
                                        <div id='edit' style="margin-top: 30px;"><?php echo $datashould; ?></div>
                                    </div>
                                    <input name="editor1" id="editor122" class="form-control input-lg ckeditor d-none"
                                           type="text"/>
                                </div>


                                <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                                    <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                                        <button type="submit" class="btn btn-default col-md-12 col-12 btn-success"
                                                id="sendpost">ارسال
                                        </button>
                                    </div>
                                </div>


                            </form>
                            <?php
                        }
                        ?>

                    </div>

                    <div id="eshterak" class="tabcontent  <?php if($tab==5) echo "d-block"; else echo "d-none";?>">
                        <div class="row">


                        <?php
//                        echo $eshterak;
                        if($eshterak==4){
                            ?>
                            <div class="p-2 text-info text-center col-md-12">
                                شما در حال حاضر هیچ بسته فعالی ندارید.
                            </div>
                            <?php
                        }else{

                            $query = "SELECT * FROM userEshterak WHERE ID=".$eshterak.";";
                            $result = $connection->query($query);
                            $row = $result->fetch_assoc();
                            $eshtName = $row['name'];
                            ?>
                            <div class="p-2 text-info text-center col-md-12">
                                شما یک بسته اشتراک
                                <?php echo $eshtName;?>
                                در تاریخ
                                <?php echo $startTime;?>
                                فعال کرده‌اید و تا تاریخ
                                <?php echo $endTime;?>
                                می‌توانید استفاده کنید.

                            </div>

                            <a onclick="return confirming();" href="profile.php?request=deleteEshterak"  class="btn col-md-5 col-10  btn-danger mt-3 mb-5 mr-auto ml-auto">لغو بسته</a>

                        <?php
                        }

                        ?>
                        <div class="col-md-12">
                            <div class="p-2 mt-3 mr-auto ml-auto">بسته‌ها</div>
                            <?php
                            $query = "SELECT * FROM userEshterak WHERE ID !=4;";
                            $result = $connection->query($query);
                            while($row = $result->fetch_assoc()){
                                $eshtName = 'بسته اشتراک '.$row['name'];
                                if($row['qeimat']>99)
                                    $qeimat = $row['qeimat'].' تومان';
                                else
                                    $qeimat = ' رایگان';
                                $id = $row['ID'];
//                                if($id!=1 || $useFree!=1 ) {
                                    ?>
                                    <div class="col-md-5 col-10 mb-4 mr-auto ml-auto">
                                        <div class="col-md-12 text-center bg-dark text-light p-2"><?php echo $eshtName; ?></div>
                                        <div class="col-md-12 text-center bg-dark text-light font-weight-bold p-2"><?php echo $qeimat; ?></div>
                                        <a onclick="return confirming2();"
                                           href="profile.php?request=buyEshterak&ID=<?php echo $id; ?>"
                                           class="col-md-12 text-center  btn btn-outline-success  p-2">خرید</a>
                                    </div>
                                    <?php
//                                }
                            }
                            ?>
                        </div>
                        </div>
                    </div>

                    <div id="changePass" class="tabcontent  <?php if($tab==6) echo "d-block"; else echo "d-none";?>">
                        <form action="profile.php?request=changePass" method="post" class="row pt-5" id="userPass" enctype="multipart/form-data">
                            <div class="form-group col-md-8 m-auto text-right">
                                <label for="lastPass" class="dark_text"><b>رمز فعلی</b></label>
                                <input type="password" class="form-control" id="lastPass" name="lastPass">
                            </div>

                            <div class="form-group col-md-8 m-auto text-right">
                                <label for="newPass" class="dark_text"><b>رمز جدید</b></label>
                                <input type="password" class="form-control" id="newPass" name="newPass">
                            </div>

                            <div class="form-group col-md-8 m-auto text-right">
                                <label for="reNewPass" class="dark_text"><b>تکرار رمز جدید</b></label>
                                <input type="password" class="form-control" id="reNewPass" name="reNewPass">
                            </div>


                            <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                                <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                                    <button type="submit" class="btn btn-default col-md-12 col-12 btn-success"
                                            id="okPass">ثبت
                                    </button>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
                <?php
            }
            ?>

            <div class="leftDiv col-md-3 col-12">
                <div class="col-md-12 text-center addSub float-left">
                    <h3>
                        ویکی تبلیغ
                    </h3>
                </div>
                <?php
                include 'showAdd.php';
                ?>
            </div>

        </div>
    </div>
</div>




<?php
include 'footer.php';
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
function get_error($id){
    switch ($id) {
        case '-1':
            return 'اطلاعات ارسال شده ناقص است.';
            break;
        case '-2':
            return 'آی پی یا مرچنت کد پذیرنده صحیح نیست';
            break;
        case '-3':
            return 'با توجه به محدودیت های شاپرک امکان پرداخت با رقم درخواست شده میسر نمی باشد.';
            break;
        case '-4':
            return 'سطح تایید پذیرنده پایین تر از صطح نقره ای است.';
            break;
        case '-11':
            return 'درخواست مورد نظر یافت نشد.';
            break;
        case '-12':
            return 'امکان ویرایش درخواست میسر نمی باشد.';
            break;
        case '-21':
            return 'هیچ نوع عملیات مالی برای این تراکنش یافت نشد.';
            break;
        case '-22':
            return 'تراکنش نا موفق می باشد.';
            break;
        case '-33':
            return 'رقم تراکنش با رقم پرداخت شده مطابقت ندارد.';
            break;
        case '-34':
            return 'سقف تقسیم تراکنش از لحاظ تعداد با رقم عبور نموده است.';
            break;
        case '-40':
            return 'اجازه دسترسی به متد مربوطه وجود ندارد.';
            break;
        case '-41':
            return 'اطلاعات ارسال شده مربوط به AdditionalData غیر معتر می باشد.';
            break;
        case '-42':
            return 'مدت زمان معتبر طول عمر شناسه پرداخت بین 30 دقیقه تا 40 روز می باشد.';
            break;
        case '-54':
            return 'درخواست مورد نظر آرشیو شده است.';
            break;
        case '100':
            return 'عملیات با موفقیت انجام گردیده است.';
            break;
        case '101':
            return 'عملیات پرداخت موفق بوده و قبلا Payment Verification تراکنش انجام شده است';
            break;
        default:
            return $id;
            break;
    }
}
?>
<script src="/js/classie.js"></script>
<script src="/js/uisearch.js"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
    new UISearch( document.getElementById( 'sb-search2' ) );
</script>
<script type="application/ld+json">
    {
    "@context":"http://schema.org",
    "@type":"Organization",
    "url":"https://wikiderm.ir/",
    "sameAs":["https://www.instagram.com/wikiderm/"],
    "@id":"#organization",
    "name":"ویکی‌درم",
    "logo":"https://wikiderm.ir/<?php echo $XMLFile->logo->url;?>"}
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->


<script type="text/javascript" src="../froala/js/froala_editor.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/align.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/char_counter.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/code_view.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/colors.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/draggable.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/emoticons.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/entities.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/file.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/font_size.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/font_family.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/fullscreen.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/image.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/line_breaker.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/inline_style.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/link.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/lists.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/quick_insert.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/quote.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/table.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/save.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/url.min.js"></script>
<script type="text/javascript" src="../froala/js/plugins/video.min.js"></script>


<script>
    $(function () {
        $('#edit').froalaEditor({
            // Define new image styles.
            // Set the image upload parameter.
            imageUploadParam: 'image',

            // Set the image upload URL.
            imageUploadURL: '/images/froala/takefile.php',

            // Additional upload params.
//                imageUploadParams: {id: 'my_editor'},

            // Set request type.
            imageUploadMethod: 'POST',

            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,

            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png'],

            imageStyles: {
                class1: 'Class 1',
                class2: 'Class 2'
            },
            // Set the video upload parameter.
            videoUploadParam: 'image',

            // Set the video upload URL.
            videoUploadURL: '/images/froala/takeVideoFile.php',

            // Additional upload params.
            videoUploadParams: {id: 'my_editor'},

            // Set request type.
            videoUploadMethod: 'POST',

            // Set max video size to 50MB.
            videoMaxSize: 50 * 1024 * 1024,

            // Set the file upload parameter.
            fileUploadParam: 'image',

            // Set the file upload URL.
            fileUploadURL: '/images/froala/takeVideoFile.php',

            // Additional upload params.
            fileUploadParams: {id: 'my_editor'},

            // Set request type.
            fileUploadMethod: 'POST',

            // Set max file size to 20MB.
            fileMaxSize: 20 * 1024 * 1024,

            // Allow to upload any file.
            fileAllowedTypes: ['*']
        })
            .on('froalaEditor.image.beforeUpload', function (e, editor, images) {
//            alert("berfor upload");
            })
            .on('froalaEditor.image.uploaded', function (e, editor, response) {
                // Image was uploaded to the server.
//            alert(response);
            })
            .on('froalaEditor.image.inserted', function (e, editor, $img, response) {
                // Image was inserted in the editor.
//            alert("inserted");
            })
            .on('froalaEditor.image.replaced', function (e, editor, $img, response) {
                // Image was replaced in the editor.
//            alert("replaced");
            })
            .on('froalaEditor.image.error', function (e, editor, error, response) {
                // Bad link.
                alert(error.code);
//            if (error.code == 1) { }
//
//            // No link in upload response.
//            else if (error.code == 2) { }
//
//            // Error during image upload.
//            else if (error.code == 3) {  }
//
//            // Parsing response failed.
//            else if (error.code == 4) {  }
//
//            // Image too text-large.
//            else if (error.code == 5) {  }
//
//            // Invalid image type.
//            else if (error.code == 6) {  }
//
//            // Image can be uploaded only to same domain in IE 8 and IE 9.
//            else if (error.code == 7) {  }

// Response contains the original server response to the request if available.
            }).on('froalaEditor.video.beforeUpload', function (e, editor, videos) {
            // Return false if you want to stop the video upload.
//            alert("berfor upload");
        })
            .on('froalaEditor.video.uploaded', function (e, editor, response) {
                // Video was uploaded to the server.
//            alert(response);
            })
            .on('froalaEditor.video.inserted', function (e, editor, $img, response) {
                // Video was inserted in the editor.
//            alert("inserted");
            })
            .on('froalaEditor.video.replaced', function (e, editor, $img, response) {
                // Video was replaced in the editor.
//            alert("replaced");
            })
            .on('froalaEditor.video.error', function (e, editor, error, response) {
                // Bad link.
//            alert(error.code);
//            if (error.code == 1) { }
//
//            // No link in upload response.
//            else if (error.code == 2) { }
//
//            // Error during video upload.
//            else if (error.code == 3) { }
//
//            // Parsing response failed.
//            else if (error.code == 4) { }
//
//            // Video too text-large.
//            else if (error.code == 5) { }
//
//            // Invalid video type.
//            else if (error.code == 6) { }
//
//            // Video can be uploaded only to same domain in IE 8 and IE 9.
//            else if (error.code == 7) { }

                // Response contains the original server response to the request if available.
            });


    });
</script>

</body>
</html>