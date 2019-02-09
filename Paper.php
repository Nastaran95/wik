<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 8:16 PM
 */
session_start();

include 'Settings.php'; //harja khasti DB estefade koni ino bezan faghat
$productXMLNAME = "XMLs/maghale.xml";
if (file_exists($productXMLNAME)) {
    $XMLFile = simplexml_load_file($productXMLNAME);
    $SEOdescription=$XMLFile->description;
    $SEOKEYWORDS=$XMLFile->kewords;
    $SEOTITLE=$XMLFile->seotitle;
}else{
    $SEOdescription="";
    $SEOKEYWORDS="";
}


if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $query = "SELECT * FROM Paper WHERE (post_name='$ID' and stat>0);";
    $result = $connection->query($query);
//    echo $connection->error;
    if ($row = $result->fetch_assoc()) {
        $id = $row['ID'];
        $subj = $row['name'];
        $writerID = $row['writerID'];
        $mokh = $row['Mokhtasar'];
        $q = "SELECT * FROM users WHERE mobile=".$writerID.";";
        $res = $connection->query($q);
        if($rw=$res->fetch_assoc()) {
            $writer = $rw['name'];
            $eshterak = $rw["eshterakID"];
            $endTime = $rw["endTime"];

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
                $stmt->bind_param("s", $writerID);
                $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
                $stmt->store_result();
                $result = $stmt->get_result();
            }
        }
        else {
            $writer = 'ناشناس';
            $eshterak = 1;
        }
        $time = $row['realtime'];
        $dastebandi = $row['dastebandi'];
        $xmlAdress = $row['XMLNAME'];
//        $xmlAdress = substr($xmlAdress,3);
        if (file_exists($xmlAdress)) {
            $XMLFile = simplexml_load_file($xmlAdress);
            $Description=$XMLFile->data;
        }else{
            $Description="";
        }
        $SEOTITLE=$row['name'];

        $stmt = $connection->prepare("UPDATE Paper set mahbobiat=mahbobiat+1 WHERE (post_name=?)");
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
                <?php
                if($eshterak==4) {
                    ?>
                    <div class="col-md-12 float-right col-12 text-right">
                        <div class="col-md-12 float-left">
                            <h1><span class="fontDiam"> &#9830; </span>
                                <?php echo $subj; ?>
                            </h1>
                        </div>
                        <div class="float-left hrline"></div>
                        <div class="afterHr">
                            <div class="text-dark col-md-12 summ col-12 text-right">
                                <?php echo $mokh; ?> ...
                            </div>
                            <div class="text-dark col-md-12">
                                <?php
                                $xxxx = $Description;
                                $tmp = preg_replace('#<[^>]+>#', ' ', $xxxx);

                                if(strlen($tmp)<=500){
                                    $pr = $tmp;
                                }
                                else {
                                    $x = 500;
                                    while ($tmp[$x++] != ' ' && $x<strlen($tmp)) {
                                    }
                                    $pr = substr($tmp, 0, $x);
                                }
                                echo $pr;
                                ?>...
                            </div>

                            <div class="p-5 text-danger text-center col-md-12"><b>
                                با توجه به نداشتن اشتراک فعال این نویسنده، ادامه محتوای این پست قابل نمایش نیست.
                                </b></div>
                        </div>
                    </div>
                    <?php
                }
                else {
                    ?>
                    <div class="col-md-12 float-right col-12 text-right">
                        <div class="col-md-12 float-left">
                            <h1><span class="fontDiam"> &#9830; </span>
                                <?php echo $subj; ?>

                                <?php
                                if (isset($_SESSION["logged_in"]) && $_SESSION['logged_in'] == true && $_SESSION["mobile"] == $writerID) {
                                    ?>
                                    <a href="/profile.php?requestEdit=<?php echo $id; ?>" class="edit"><i
                                                class="fas fa-edit"></i></a>
                                    <a onClick="return confirming();"  href="/profile.php?requestDelete=<?php echo $id; ?>" class="delete"><i
                                                class="fas fa-trash-alt"></i></a>
                                    <?php
                                }
                                ?>
                            </h1>
                        </div>
                        <div class="float-left hrline"></div>
                        <div class="afterHr">
                            <div class="col-md-12 nametime col-12 row">

                                <div class="col-md-4 col-12 ">
                                    <?php echo $writer; ?>
                                </div>
                                <div class="col-md-8 col-12 ">
                                    <?php echo $time; ?>
                                </div>

                            </div>
                            <div id="text_1" class="fr-element fr-view bar_text ">
                                <?php echo $Description; ?>
                            </div>

                        </div>

                    </div>

                    <?php
//                    $query = "SELECT * FROM Paper WHERE (writerID LIKE '%$writerID%' and stat>0)";
                    $query = "SELECT Paper.ID FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.writerID LIKE '%$writerID%' ) ;";
                    $result = $connection->query($query);
                    $pagenum = $result->num_rows;
                    if ($pagenum > 0) {


                        ?>

                        <div class="col-md-12 float-left text-right">
                            <div class="col-md-12 float-left">
                                <h1><span class="fontDiam"> &#9830; </span>
                                    دیگر مقالات از این نویسنده
                                </h1>
                            </div>
                            <div class="hrline float-left"></div>
                            <div class="afterHr row">
                                <div id="replacepagination1" class="<?php echo $writerID; ?>">

                                    <?php
                                    $page = 1;
                                    $a = ($page - 1) * 2;
                                    $query = "SELECT Paper.name as name1, Paper.writerID, Paper.realtime, Paper.post_name, Paper.Mokhtasar, Paper.image,users.name as name2 FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.writerID LIKE '%$writerID%' ) ORDER by Paper.realtime DESC  LIMIT $a , 2;";
//                                    $query = "SELECT * FROM Paper WHERE (writerID LIKE '%$writerID%' and stat>0) ORDER by ID DESC LIMIT $a , 2;";
                                    $result = $connection->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name1'];
                                        $writerID = $row['writerID'];
                                        $writer = $row['name2'];
//                                        $q = "SELECT * FROM users WHERE mobile=" . $writerID . ";";
//                                        $res = $connection->query($q);
//                                        if ($rw = $res->fetch_assoc())
//                                            $writer = $rw['name'];
//                                        else
//                                            $writer = 'ناشناس';
                                        $time = $row['realtime'];
                                        $link = '/Paper/' . $row['post_name'];
                                        $mokhtasar = $row['Mokhtasar'];
                                        $image = $row['image'];
//                                    $image = substr($image, 3);
                                        ?>

                                        <div class="col-md-12 Paperdiv col-12 float-left ">
                                            <div class="col-md-3 float-right col-12 ">
                                                <a href="<?php echo $link; ?> ">
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
                                                    <div class="col-md-8 col-12 ">
                                                        <?php echo $time; ?>
                                                    </div>

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
                }
                ?>

                <?php
                $query = "SELECT Paper.ID FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.dastebandi='$dastebandi') ;";
//                $query = "SELECT * FROM Paper WHERE (dastebandi='$dastebandi' and stat>0);";
                $result = $connection->query($query) ;
                $pagenum = $result->num_rows;
                if($pagenum>0) {


                    ?>

                    <div class="col-md-12 float-left text-right">
                        <div class="col-md-12 float-left">
                            <h1> <span class="fontDiam"> &#9830; </span>
                                مقالات مرتبط
                            </h1>
                        </div>
                        <div class="hrline float-left"></div>
                        <div class="afterHr row">
                            <div id="replacepagination2" class="<?php echo $dastebandi;?>">

                                <?php
                                $page = 1;
                                $a = ($page - 1) * 2;
                                $query = "SELECT Paper.name as name1,Paper.writerID,Paper.realtime,Paper.post_name,Paper.Mokhtasar,Paper.image,users.name as name2 FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.dastebandi='$dastebandi') ORDER by Paper.realtime DESC  LIMIT $a , 2;";
//                                $query = "SELECT * FROM Paper WHERE (dastebandi='$dastebandi' and stat>0) ORDER by ID DESC LIMIT $a , 2;";
                                $result = $connection->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['name1'];
                                    $writerID = $row['writerID'];
                                    $writer = $row['name2'];
//                                    $q = "SELECT * FROM users WHERE mobile=".$writerID.";";
//                                    $res = $connection->query($q);
//                                    if($rw=$res->fetch_assoc())
//                                        $writer = $rw['name'];
//                                    else
//                                        $writer = 'ناشناس';
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
                                                <div class="col-md-8 col-12 ">
                                                    <?php echo $time; ?>
                                                </div>

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
                                    <ul class="pagination ">
                                        <li id="-1" class="PagedList-skipToNext paginationoldPapers2" rel="prev">
                                            >>
                                        </li>
                                        <?php
                                        $x = ($pagenum + 1) / 2;
                                        for ($i = 1; $i <= min($x, 2); $i++) {
                                            ?>
                                            <li id="<?php echo $i ?>"
                                                class="paginationoldPapers2 <?php if ($i == 1) echo "active" ?> "><?php echo $i ?></li>
                                            <?php

                                        }
                                        $i--;
                                        if ($i < max(1, floor($x) - 1))
                                            echo "<li>...</li>";
                                        if ($i < max(1, floor($x))) {
                                            ?>
                                            <li id="<?php echo floor($x) ?>"
                                                class="paginationoldPapers2"><?php echo floor($x) ?></li>
                                            <?php
                                        }

                                        ?>

                                        <li id="-2" class="PagedList-skipToNext paginationoldPapers2" rel="next">
                                            <<
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                }
                ?>


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