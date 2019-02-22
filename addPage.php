<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 8:16 PM
 */
session_start();

include 'Settings.php'; //harja khasti DB estefade koni ino bezan faghat
//$productXMLNAME = "XMLs/addPage.xml";
//if (file_exists($productXMLNAME)) {
//    $XMLFile = simplexml_load_file($productXMLNAME);
//    $SEOdescription=$XMLFile->description;
//    $SEOKEYWORDS=$XMLFile->kewords;
//    $SEOTITLE=$XMLFile->seotitle;
//}else{
//    $SEOdescription="";
//    $SEOKEYWORDS="";
//}

$SEOdescription="تبلیغ";
$SEOKEYWORDS="تبلیغ";


if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $query = "SELECT * FROM advertisement WHERE (ID='$ID' and active>0 and stat>0);";
    $result = $connection->query($query);
//    echo $connection->error;
    if ($row = $result->fetch_assoc()) {
        $subj = $row['name'];
        $matn = $row['matn'];
        $number = $row['number'];
        $link2 = $row["link"];
        $address = $row["address"];
        $image = $row["image"];

        $SEOTITLE=$row['name'];

        $stmt = $connection->prepare("UPDATE advertisement set mahbobiat=mahbobiat+1 WHERE (ID=?)");
        $stmt->bind_param("s", $ID);
        $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
        $stmt->store_result();
        $result = $stmt->get_result();

    } else{
        header('Location:/');
    }
}else {
    header('Location:/');
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
    <link rel="stylesheet" href="/css/maghale.css"/>
    <link rel="canonical" href="https://www.wikiderm.ir/">
    <link rel="alternate" href="https://www.wikiderm.ir/" hreflang="fa-IR" />
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
    <script src="/js/maghale.js"></script>
    <link rel="stylesheet" href="/froala/css/froala_style.css">

</head>
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

        <div class="col-md-12 test">

            <div class="mainDiv col-md-9 col-12">

                <div class="col-md-12 float-right col-12 text-right">
                    <div class="col-md-12 float-left">
                        <h1><span class="fontDiam"> &#9830; </span>
                            <?php echo $subj; ?>
                        </h1>
                    </div>
                    <div class="float-left hrline"></div>
                    <div class="afterHr">

                        <div class="col-md-12 col-sm-12 col-12">
                            <a href="<?php echo $link2; ?>" >
                                <img class="d-block mx-auto mw-100" src="/<?php echo $image;?>" alt="<?php echo $subj; ?>">
                            </a>
                        </div>
                        <br/>
                        <div class="text-justify m-2 ">
                            <?php echo $matn; ?>
                        </div>

                        <?php
                        if(strlen($address)>0){
                            ?>
                            <div class="col-md-12 col-12 m-2 text-info">آدرس:
                                <?php echo $address; ?>
                            </div>
                            <?php
                        }
                        if(strlen($number)>0){
                            ?>
                            <div class="col-md-12 col-12 m-2 text-info">شماره تماس:
                                <?php echo $number; ?>
                            </div>
                            <?php
                        }
                        if(strlen($link2)>0){
                            ?>
                            <a class="text-center col-md-12 m-auto d-table" href="<?php echo $link2; ?>" >
                                <div class="col-md-6 col-12 btn btn-success">
                                    کلیک کنید
                                </div>
                            </a>

                            <?php
                        }
                        ?>


                    </div>

                </div>


            </div>

            <div class="leftDiv col-md-3 col-12">
                <div class="col-md-12 text-center addSub float-left">
                    <h3>
                        تبلیغات
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
    "url":"http://www.wikiderm.ir/",
    "sameAs":["https://www.instagram.com/wikiderm/"],
    "@id":"#organization",
    "name":"ویکی‌درم",
    "logo":"http://www.wikiderm.ir/<?php echo $XMLFile->logo->url;?>"}
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
</body>
</html>