<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 1:58 AM
 */


session_start();

include 'Settings.php'; //harja khasti DB estefade koni ino bezan faghat
$productXMLNAME = "XMLs/aboutUs.xml";
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
    <meta property="og:url" content="http://www.wikiderm.ir/">
    <meta property="og:site_name" content="ویکی‌درم">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/x-icon" href="images/wikiderm-icon--300x300.png" />
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <script src="js/jQuery.js" ></script>
    <script src="js/bootstrap.js" ></script>
    <link rel="stylesheet" href="css/global.css"/>
    <link rel="stylesheet" href="css/aboutUs.css"/>
    <link rel="canonical" href="https://www.wikiderm.ir/">
    <link rel="alternate" href="https://www.wikiderm.ir/" hreflang="fa-IR" />
    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="js/modernizr.custom.js"></script>
</head>
<STYLE>A {text-decoration: none;} </STYLE>
<body>

<?php
include 'header.php';
?>


<div class="container">


    <div  id="main" class="home_main">



        <div class="col-md-12 test">

            <div class="mainDiv col-md-9 col-xs-12">
                <div class="col-md-12 aboutUs">
                    <h1>
                        <span class="fontDiam"> &#9830; </span>
                        درباره ما
                    </h1>
                    <div class="col-md-10 offset-1 hrline"></div>
                    <div class="col-md-10 offset-1  text-justify blackCol">
                        <p>
                            دانشنامه پوست ، مو و زیبایی در نظر دارد منبعی را جهت بهره برداری علمی پزشکان، دانشجویان، اساتید و مراکز پوست و زیبایی و نیز به اشتراک گذاری دانش ضمنی آنان با همدیگر در جهت ارتقای دانش این حوزه و افزایش آگاهی عمومی در خصوص مشکلات و درمانهای پوست و زیبایی فراهم سازد. بدینوسیله از همه علاقه  مندان قلم فرسا در این زمینه دعوت به عمل می آید پس از عضویت و اخذ کد کاربری با انتشار مطالب با نام خودشان ما را در تکامل این منبع مشترک یاری نمایند. پیشاپیش از حسن همکاری شما کمال تشکر را داریم.
                        </p>
                    </div>
                </div>

                <div class="col-md-12 overview">
                    <h1>
                        <span class="fontDiam"> &#9830; </span>
                        چشم انداز
                    </h1>
                    <div class="col-md-10 offset-1 hrline"></div>
                    <div class="col-md-10 offset-1  text-justify blackCol">
                        <p>
                            توسعه علم تنها مسیر رشد و تعالی بشر در طول تاریخ بوده و به نظر می رسد یکی از وظایف انسانی ما  توسعه علومی است که به هر شکل در ارتباط با  کار و زندگی ما قرار دارد و به نوعی با آن سروکار داریم تا هرکدام از ما، به مهره ای برای رسیدن به ابدیت روشن بشری بدل شویم. ابدیتی که همه چیز خدایی و انسان متکامل صاحب آن است و به جهانی فراتر از ابدیت می اندیشد.
                        </p>
                    </div>
                </div>
            </div>

            <div class="leftDiv col-md-3 col-xs-12">
                <div class="offset-1 col-md-10 text-center addSub">
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
?>
<script src="js/classie.js"></script>
<script src="js/uisearch.js"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
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