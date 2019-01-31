<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 1:58 AM
 */
session_start();

include 'Settings.php';
$productXMLNAME = "XMLs/advertisement.xml";
if (file_exists($productXMLNAME)) {
    $XMLFile = simplexml_load_file($productXMLNAME);
    $SEOdescription=$XMLFile->description;
    $SEOKEYWORDS=$XMLFile->kewords;
    $SEOTITLE=$XMLFile->seotitle;
    $datashould = $XMLFile->data1;
}else{
    $SEOdescription="";
    $SEOKEYWORDS="";
    $SEOTITLE="";
    $datashould = "";
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
    <meta property="og:url" content="http://www.wikiderm.ir/">
    <meta property="og:site_name" content="ویکی‌درم">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/x-icon" href="/images/wikiderm-icon--300x300.png" />
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <script src="/js/jQuery.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    <link rel="stylesheet" href="/css/global.css"/>
    <link rel="stylesheet" href="/css/advertisement.css"/>
    <link rel="canonical" href="https://www.wikiderm.ir/">
    <link rel="alternate" href="https://www.wikiderm.ir/" hreflang="fa-IR" />
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
    <script src="/js/advertisement.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=fa'></script>
</head>
<STYLE>A {text-decoration: none;} </STYLE>
<body>

<?php

if (isset($_GET['request']) && $_GET['request']=='message') {
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
        </div>
            <?php
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
        </div>
        <?php
    }
    else {
        if (isset($_POST['name']) && isset($_POST['time']) && strlen($_POST['name']) > 0) {
            $name = $_POST['name'];
            $timeAdd = $_POST['time'];


            if (isset($_POST['msg'])) {
                $msg = $_POST['msg'];
            }
            else
                $msg = "";


            if (isset($_POST['number'])) {
                $number = $_POST['number'];
            }
            else
                $number = "";

            if (isset($_POST['link'])) {
                $link = $_POST['link'];
            }
            else
                $link = "";

            if (isset($_POST['address'])) {
                $address = $_POST['address'];
            }
            else
                $address = "";


            if (isset($_FILES["img"])) {
                $imagenames = $_FILES["img"]["name"];
                $imagetempname = $_FILES["img"]["tmp_name"];
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
                        $target_dir = "images/advertisements/";
                        $BBB = (string)uniqid();
                        $target_file = $target_dir . $BBB . basename($NAMESSS);

                        $uploadOk = 1;
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($TMPNAMESSS);
                        if ($check !== false) {
                            $uploadOk = 1;
                        } else {
                            if ($_FILES["img"]["type"] == "TIFF/PNG/JPEG/GIF"){
                                $uploadOk = 1;
                            }else{
                                $uploadOk = 0;
                            }
                        }
                        if ($uploadOk == 0) {
                        } else {
                            $file_size = $_FILES['img']['size'];

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
//                    echo "9";
                        $uploadOk = 0;
                        $imagetempname = "";
                        $imagenames = "";
                        $target_file = "";
                    }

                }
            } else {
//            echo "8";
                $imagetempname = "";
                $imagenames = "";
                $target_file = "";
            }
            if (strlen($target_file)<1)
                $target_file = 'images/no-product-image-available.png';

            $query = "SELECT * FROM addCategory WHERE ID='".$timeAdd."';";
            $result = $connection->query($query);
            if ($row = $result->fetch_assoc()) {
                $price = $row['qeimat'];
                $t = $row['time'];
                $baste = $row['name'];

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
                $startTime = $modified_time;

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
                $endTime = $modified_time;

                if (isset($_SESSION["logged_in"]) && $_SESSION['logged_in']==true) {
                    echo 'hiiii';
                    $write = $_SESSION["mobile"];
                }else
                    $write = "no acount";

//                    active = 0 yani pardakht nashode , active = 1 yani pardakht shode
                $stmt = $connection->prepare("INSERT INTO advertisement(name, matn, number,link,address, image, startTime, endTime, active, addType, writerID)  VALUES (?,?,?,?,?,?,?,?,1,?,?)");
                $stmt->bind_param("ssssssssss", $name, $msg,$number,$link,$address, $target_file, $startTime, $endTime, $timeAdd, $write);
                $result = $stmt->execute();
                $addID = $connection->insert_id;
                $stmt->store_result();
                $result = $stmt->get_result();

                if ($connection->error) {
                    echo $connection->error;
                    echo "<script>alert('عملیات موفقیت آمیز نبود. لطفا دوباره امتحان کنید.');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=advertisement.php?result=unsuccessful">';
                } else {

                    echo "<script>alert('here');</script>";


                    $MerchantID = '3c5b10c6-6c1f-11e6-9549-005056a205be'; //Required
                    $Amount = $price; //Amount will be based on Toman - Required


                    $stmt = $connection->prepare("INSERT INTO allpardakhtAdd (mobile, addType,amount,status,code,addID)  VALUES (?,?,?,3,'pending',?)");
                    $stmt->bind_param("ssss",$write,$timeAdd,$Amount,$addID);
                    $stmt->execute();
                    $stmt->close();

                    $insertID = $connection->insert_id;

                    if ($connection->error) {
                        echo "<script>alert('خطایی رخ داد. لطفا دوباره تلاش کنید.')</script>>";
                        die();
                    }
                    echo "<script>alert('here2');</script>";

                    $Description = 'پرداخت هزینه آگهی'.$baste.' ویکی‌درم'; // Required
//    $Email = 'UserEmail@Mail.Com'; // Optional
//                        $Mobile = $write; // Optional
                    $CallbackURL = 'http://www.wikidermi.com/advertisement.php?request=backZarrin&zarrin='.$insertID; // Required

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
                        echo "<script>alert('here3');</script>";

                        Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
//برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
//Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
                    } else {
                        echo "<script>alert('here4');</script>";

                        $str = 'خطا: '.$result->Status.'لطفا دوباره تلاش کنید.';
                        echo '<script>alert('.$str.')</script>';
                    }
                }
            }
            else{
                echo "<script>alert('عملیات موفقیت آمیز نبود. لطفا دوباره امتحان کنید.');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=advertisement.php?result=unsuccessful">';
            }
        } else {
            echo "<script>alert('به موارد الزامی دقت کنید.');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=advertisement.php?result=unsuccessful">';
        }

    }
}else if(isset($_GET['request']) && $_GET['request']=='backZarrin') {
    $insertID = $_GET['zarrin'];
    $stmt = $connection->prepare("SELECT * FROM allpardakhtAdd WHERE (ID=? )");
    $stmt->bind_param("s",$insertID );
    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
    $res = $stmt->get_result();
    if( $row = $res->fetch_assoc()){
        $qeimat = $row['amount'];
        $id = $row['addType'];
        $addID = $row['addID'];
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
            echo 'با تشکر از شما . سفارش شما با موفقیت پرداخت شد. شماره پیگیری: '.$result->RefID;
            $stmt = $connection->prepare("update  allpardakhtAdd set status=2 , code=?  where ID=?");
            $stmt->bind_param("ss",$result->RefID , $insertID);
            $stmt->execute();
            $stmt->close();

            $stmt = $connection->prepare("UPDATE advertisement SET pardakht=1 WHERE (ID=?)");
            $stmt->bind_param("s", $addID);
            $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
            $stmt->close();

        } else { //onsuccesful
            $code = get_error($result->Status);
            echo 'پرداخت شما ناموفق بوده است . لطفا مجددا تلاش نمایید یا در صورت بروز اشکال با مدیر سایت تماس بگیرید. وضعیت:'.$result->Status;
            $stmt = $connection->prepare("update  allpardakhtAdd set status=1 ,code=? where ID=?");
            $stmt->bind_param("ss",$code,$insertID);
            $stmt->execute();
            $stmt->close();
        }
    } else { //canceled
        $code = 'canceled';
        echo 'پرداخت توسط شما لغو گردید.';
        $stmt = $connection->prepare("update allpardakhtAdd set status=0 ,code=?  where ID=?");
        $stmt->bind_param("ss",$code,$insertID);
        $stmt->execute();
        $stmt->close();
    }
//    $stmt = $connection->prepare("Delete FROM pardakht WHERE (ID=? )");
//    $stmt->bind_param("s",$insertID );
//    $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failu
//    $result = $stmt->get_result();
    echo '<a href="/index.php">بازگشت به صفحه اصلی </a>';


}
else{
    include 'header.php';
}

$productXMLNAME = "XMLs/contactUs.xml";
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

            <div class="mainDiv col-md-9 col-12 text-right">


                <div class="col-md-12 aboutUs">

                    <div class="col-md-12">
                        <h1> <span class="fontDiam"> &#9830; </span>
                          ثبت آگهی جدید
                        </h1>
                    </div>

                    <div class="text-justify blackCol box">
                        <?php echo $datashould;?>
                    </div>

                    <div class="col-md-12 float-left text-justify contctus text-center">
                        <div class="show_res d-none  m-auto col-12">به موارد الزامی دقت کنید.</div>
                        <div class="errmsg d-none m-auto col-12">لطفا فقط عدد انگلیسی وارد کنید.</div>
                        <form action="advertisement.php?request=message" method="post" onsubmit="return validateForm()" class="" enctype="multipart/form-data">
                            <div class="form-group col-md-10 m-auto pt-4">
                                <label for="name" class="dark_text float-right"><b>عنوان آگهی</b></label>
                                <input type="text" class="form-control" id="name" name="name" >
                            </div>
                            <div class="form-group col-md-10 m-auto pt-4">
                                <label for="msg" class="dark_text float-right"><b>متن آگهی</b></label>
                                <textarea rows="10" maxlength="1000" name="msg" id="msg"></textarea>
                            </div>

                            <div class="form-group col-md-10 m-auto pt-4">
                                <label for="number" class="dark_text float-right"><b>شماره تماس</b></label>
                                <input type="text" maxlength="11" class="form-control" id="number" name="number" >
                            </div>

                            <div class="form-group col-md-10 m-auto pt-4">
                                <label for="link" class="dark_text float-right"><b>لینک</b></label>
                                <input type="text" class="form-control" id="link" name="link" >
                            </div>

                            <div class="form-group col-md-10 m-auto pt-4">
                                <label for="address" class="dark_text float-right"><b>آدرس</b></label>
                                <input type="text" class="form-control" id="address" name="address" >
                            </div>

                            <div class="col-md-4 m-auto p-3">
                                <img src="" alt="Avatar" class="d-none" style="width:100%" id="showImage">
                            </div>

                            <div class="form-group col-md-10 m-auto pt-4">
                                <div  class="imgBtn text-dark btn btn-default col-md-4" id="imgBtn">درج تصویر آگهی</div>
                                <input type="file" name="img" id="img" accept="image/jpeg,image/gif,image/png" class="d-none" onchange="readURL(this);"  />
                            </div>

                            <div class="form-group col-md-10 m-auto pt-4">
                                <label for="time" class="dark_text float-right"><b>دوره نمایش آگهی</b></label>
                                <input type="text" class="d-none" id="time" name="time" value="1">
                                <table class="w-100 text-dark typeTable" id="timeTable">
                                    <?php
                                    $query = "SELECT * FROM addCategory;";
                                    $result = $connection->query($query);
                                    $x = 0 ;
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        $id = $row['ID'];
                                        $price = $row['qeimat'];
                                        $x++;
                                        ?>
                                        <tr class="<?php if($x==1) echo "bg-info text-light";?>"  id="tr<?php echo  $id;?>">
                                            <th>نمایش <?php echo $name; ?></th>
                                            <th><?php echo $price; ?></th>
                                            <th class="chooseType w-100 btn-outline-info" id="<?php echo  $id;?>" > انتخاب </th>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </table>


                            </div>

                            <div class="row m-3">
                                <div class="m-auto">
                                    <div class="g-recaptcha" data-sitekey="6LdBvYkUAAAAAM4dmGD1D36TXX1fwssNLGnoz8j9"></div>
                                </div>
                            </div>



                            <div class="offset-4 col-md-4 col-12 m-auto">
                                <button type="submit" class="btn btn-default col-md-12 col-12">ثبت آگهی</button>
                            </div>
                        </form>

                    </div>


                </div>


            </div>

            <div class="leftDiv col-md-3 col-12">
                <div class="col-md-12 text-center addSub float-left">
                    <h3>
                        تبلیغات
                    </h3>
                </div>
                <div class="col-md-12 add">
                    <img src="images/tabliq.png" width="100%" height="100%" alt="">
                </div>
                <div class="col-md-12 add">
                    <img src="images/tabliq.png" width="100%" height="100%" alt="">
                </div>
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
?>
<script src="js/classie.js"></script>
<script src="js/uisearch.js"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
    new UISearch( document.getElementById( 'sb-search2' ) );
</script>
<script type="application/ld+json">
    {
    "@context":"http://schema.org",
    "@type":"Organization",
    "url":"http://www.wikiderm.ir/",
    "sameAs":["https://www.instagram.com/wikiderm/"],
    "@id":"#organization",
    "name":"ویکی‌درم",
    "logo":"http://www.wikiderm.ir/<?php echo $XMLFile->logo->url;?>"}
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
</body>
</html>