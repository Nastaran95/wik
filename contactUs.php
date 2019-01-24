<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 1:58 AM
 */
session_start();

include 'Settings.php';
$productXMLNAME = "XMLs/contactUs.xml";
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
    <link rel="stylesheet" href="/css/contactUs.css"/>
    <link rel="canonical" href="https://www.wikiderm.ir/">
    <link rel="alternate" href="https://www.wikiderm.ir/" hreflang="fa-IR" />
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
    <script src="/js/contact.js"></script>
    <script src='https://www.google.com/recaptcha/api.js?hl=fa'></script>
</head>
<STYLE>A {text-decoration: none;} </STYLE>
<body>

<?php

if (isset($_GET['request'])) {
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
        include 'header.php';
        if ($_GET['request'] == 'message') {
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['msg']) && strlen($_POST['msg']) > 0) {
                $name = $_POST['name'];
                $email = $_POST['email'];

                if (isset($_POST['subject'])) {
                    $subject = $_POST['subject'];
                }
                if (isset($_POST['mobile'])) {
                    $mobile = $_POST['mobile'];
                }
                else
                    $mobile = "";
                $msg = $_POST['msg'];

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

                $stmt = $connection->prepare("INSERT INTO user_request (name,email,subject,message,realtime,mobile)  VALUES (?,?,?,?,?,?)");
                $stmt->bind_param("ssssss", $name, $email, $subject, $msg,$modified_time,$mobile);
                $result = $stmt->execute();
                $stmt->store_result();
                $result = $stmt->get_result();

                if ($connection->error) {
                    echo $connection->error;
                    die();
                    echo "<script>alert('عملیات موفقیت آمیز نبود. لطفا دوباره امتحان کنید.');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=contactUs.php?result=عرsuccessful">';
                } else {
                    echo "<script>alert('درخواست شما با موفقیت ثبت شد.');</script>";
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=contactUs.php?result=successful">';
                }
            } else {
                echo "<script>alert('به موارد الزامی دقت کنید.');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=contactUs.php?result=unsuccessful">';
            }
        }
    }
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
                           تماس با ما
                        </h1>
                    </div>

                    <div class="text-justify blackCol box">
                        <?php echo $datashould;?>
                    </div>

                    <div class="col-md-12 float-left text-justify contctus text-center">
                        <div class="show_res d-none  m-auto col-12">به موارد الزامی دقت کنید.</div>
                        <form action="contactUs.php?request=message" method="post" onsubmit="return validateForm()" class="">
                            <div class="form-group col-md-10 m-auto">
                                <input type="text" class="form-control" id="name" placeholder="نام شما" name="name" >
                            </div>
                            <div class="form-group col-md-10 m-auto">
                                <input type="text" class="form-control" id="mobile" placeholder="شماره تماس"  name="mobile">
                            </div>
                            <div class="form-group col-md-10 m-auto">
                                <input type="email" class="form-control" id="email" placeholder="ایمیل شما"  name="email">
                            </div>
                            <div class="form-group col-md-10 m-auto">
                                <input type="text" class="form-control" id="subject" placeholder="موضوع" name="subject">
                            </div>
                            <div class="form-group col-md-10 m-auto">
                                <textarea rows="10" placeholder="پیام شما" maxlength="1000" name="msg" id="msg"></textarea>
                            </div>
                            <div class="row">
                                <div class="m-auto">
                                    <div class="g-recaptcha" data-sitekey="6LdBvYkUAAAAAM4dmGD1D36TXX1fwssNLGnoz8j9"></div>
                                </div>
                            </div>

                            <div class="offset-4 col-md-4 col-12 m-auto">
                                <button type="submit" class="btn btn-default col-md-12 col-12">ارسال</button>
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