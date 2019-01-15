<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 1:58 AM
 */


session_start();

include 'Settings.php';

if (isset($_GET['request']))
    if($_GET['request']=='message') {
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['msg']) && strlen($_POST['msg'])>0 ){
            $name = $_POST['name'];
            $email = $_POST['email'];
            if(isset($_POST['subject'])){
                $subject = $_POST['subject'];
            }
            $msg = $_POST['msg'];
            $stmt  = $connection->prepare("INSERT INTO user_request (name,email,subject,message)  VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $name, $email, $subject, $msg);
            $result = $stmt->execute();
            $stmt->store_result();
            $result = $stmt->get_result();

            if ($connection->error) {
                echo $connection->error;
                die();
                echo "<script>alert('عملیات موفقیت آمیز نبود. لطفا دوباره امتحان کنید.');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=contactUs.php?result=عرsuccessful">';
            }else{
                echo "<script>alert('درخواست شما با موفقیت ثبت شد.');</script>";
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=contactUs.php?result=successful">';
            }
        }
        else{
            echo "<script>alert('به موارد الزامی دقت کنید.');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=contactUs.php?result=unsuccessful">';
        }
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
</head>
<STYLE>A {text-decoration: none;} </STYLE>
<body>

<?php
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

            <div class="mainDiv col-md-9 col-12 text-right">


                <div class="col-md-12 aboutUs">

                    <div class="col-md-12">
                        <h1> <span class="fontDiam"> &#9830; </span>
                           تماس با ما
                        </h1>
                    </div>

                    <div class="text-justify blackCol box">
                        <p>
                            کاربر گرامی برای ارتباط با ویکی درم لطفا پیام خودتان را برای کارشناسان ما از طریق فرم زیر ارسال نمایید. کارشناسان ما در اسرع وقت با شما تماس میگیرند.
                        </p>
                    </div>

                    <div class="col-md-12 float-left text-justify contctus text-center">
                        <div class="show_res d-none  m-auto col-12">به موارد الزامی دقت کنید.</div>
                        <form action="contactUs.php?request=message" method="post" onsubmit="return validateForm()" class="row">
                            <div class="form-group col-md-10 m-auto">
                                <input type="text" class="form-control" id="name" placeholder="نام شما" name="name" >
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