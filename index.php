<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 12/23/18
 * Time: 2:14 PM
 */
session_start();

include 'Settings.php'; //harja khasti DB estefade koni ino bezan faghat
$productXMLNAME = "XMLs/home.xml";
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

$query = "SELECT * FROM colors where name='GrayBoxBack';";
$result = $connection->query($query);
$row=$result->fetch_assoc();
$r1 = $row['red'];
$g1 = $row['green'];
$b1 = $row['blue'];
$str1 = 'rgb('.$r1.','.$g1.','.$b1.')';

$query = "SELECT * FROM colors where name='GrayBoxText';";
$result = $connection->query($query);
$row=$result->fetch_assoc();
$r2 = $row['red'];
$g2 = $row['green'];
$b2 = $row['blue'];
$str2 = 'rgb('.$r2.','.$g2.','.$b2.')';

$query = "SELECT * FROM colors where name='GrayBoxBorder';";
$result = $connection->query($query);
$row=$result->fetch_assoc();
$r3 = $row['red'];
$g3 = $row['green'];
$b3 = $row['blue'];
$str3 = 'rgb('.$r3.','.$g3.','.$b3.')';

$query = "SELECT * FROM colors where name='GrayBoxBackHover';";
$result = $connection->query($query);
$row=$result->fetch_assoc();
$r4 = $row['red'];
$g4 = $row['green'];
$b4 = $row['blue'];
$str4 = 'rgb('.$r4.','.$g4.','.$b4.')';

$query = "SELECT * FROM colors where name='GrayBoxTextHover';";
$result = $connection->query($query);
$row=$result->fetch_assoc();
$r5 = $row['red'];
$g5 = $row['green'];
$b5 = $row['blue'];
$str5 = 'rgb('.$r5.','.$g5.','.$b5.')';

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
    <link rel="icon" type="image/x-icon" href="images/wikiderm-icon--300x300.png" />
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <script src="/js/jQuery.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    <script src="/js/home.js" ></script>
    <link rel="stylesheet" href="/css/global.css"/>
    <link rel="stylesheet" href="/css/home.css"/>
<!--    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
    <meta name="enamad" content="385671"/>
    <style>
        .grayBox{
            background-color: <?php echo $str1;?>;
            color: <?php echo $str2;?>;
        }

        .grayBox:hover{
            background-color: <?php echo $str4;?>;
            border-color: <?php echo $str3;?>;
            color: <?php echo $str5;?>;
        }
        <?php
        $query = "SELECT * FROM marquees where active>0;";
        $result = $connection->query($query);
        while ($row = $result->fetch_assoc()) {
            $cls = 'marQ'.$row['ID'];
            $rr = $row['red'];
            $gg = $row['green'];
            $bb = $row['blue'];
            $col = 'rgb('.$rr.','.$gg.','.$bb.')';
            echo ".".$cls."{color:".$col.";} ";
        }

?>
    </style>
</head>

<body>

<?php
include 'headerMainpage.php';
?>


<div class="container">
    <div class="header coverMain hiddenthisxs">
        <div class="cover ">

            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">

                    <?php
                    $query2 = "SELECT * FROM slider ;" ;
                    $result2 = $connection->query($query2);
                    $num = $result2->num_rows;
                    $x = 0;
                    while ($row=$result2->fetch_assoc()){
                        $act = $row['active'];
                        if($act>0) {
                            ?>
                            <li data-target="#myCarousel" data-slide-to="<?php echo $x; ?>"
                                class="<?php if ($x == 0) echo 'active'; ?>"></li>
                            <?php
                            $x = $x + 1;
                        }
                    }
                    ?>
                </ul>


                <!-- The slideshow -->
                <div class="carousel-inner">
                    <?php
                    $query = "SELECT * FROM slider;";
                    $result = $connection->query($query);
                    $x = 0 ;
                    while ($row=$result->fetch_assoc()) {
                        $name = $row['headerName'];
                        $mokhtasar = $row['Mokhtasar'];
                        $img = $row['image'];
                        $alt = $row['alt'];
                        $act = $row['active'];
                        $link = $row['link'];
                        if($act>0) {
                            ?>

                            <div class="carousel-item <?php if ($x == 0) echo 'active'; ?>">
                                <a href="<?php echo $link?>" title="<?php echo $name;?>">
                                <img src="<?php echo $img; ?>" alt="<?php echo $alt; ?>" width="100%">
                                </a>
                                    <div class="carousel-caption">
                                    <h3><?php echo $name; ?></h3>
                                    <p><?php echo $mokhtasar; ?></p>
                                </div>
                            </div>

                            <?php
                            $x = $x + 1;
                        }
                    }
                    ?>

                </div>


                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>

        </div>

        <div class="cover_menu menu">
            <ul class="dark_text">
                <?php
                $query = "SELECT * FROM menue;";
                $result = $connection->query($query);
                if (isset($_SESSION["typ"]) && $_SESSION["typ"]>0) {
                    ?>
                    <a href="/Admin/admin.php"><li>منوی ادمین</li></a>
                    <?php
                }
                while ($row=$result->fetch_assoc()) {
                    $link = $row['link'];
                    $name = $row['name'];
                    $act = $row['active'];
                    if($act>0) {
                        ?>
                        <a href="<?php echo $link; ?>">
                            <li><?php echo $name; ?></li>
                        </a>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>

        <?php
        $query = "SELECT * FROM marquees where active>0;";
        $result = $connection->query($query);
        if($result->num_rows>0) {
            ?>

            <marquee direction="right" scrollamount="12" bgcolor="#FFD5D5" class="p-2 mt-2 text-indent-<?php echo $result->num_rows;?>" behavior="scroll">
                <b class="marqueeB<?php echo $result->num_rows;?>">
                    <?php
                    $x = 0 ;
                    while ($row = $result->fetch_assoc()) {
                        if($x>0) {
                            ?>
                            <span></span>
                            <?php
                        }
                        $sent = $row['sentence'];
                        $id = $row['ID'];
                        echo "<b class='marQ".$id."'>".$sent."</b>";
                        $x = $x + 1 ;
                    }
                    ?>
                </b>
            </marquee>


<!--            <div id="mmmm">-->
<!--                <b>-->
<!--                    --><?php
//
//        while ($row = $result->fetch_assoc()) {
//            $sent = $row['sentence'];
//            $id = $row['ID'];
//            echo "<b class='marQ".$id."'>".$sent."</b>"; ?>
<!--                        <span></span>-->
<!--                        --><?php
//        }
//        ?>
<!--                </b>-->
<!--            </div>-->
<!--            <div class="marqPar">-->
<!--                <div class="marquee">-->
<!--                    --><?php
//                    while ($row = $result->fetch_assoc()) {
//                        $sent = $row['sentence'];
//                        $id = $row['ID'];
//                        echo "<div class='marQ".$id." marqChild'>".$sent."</div>";
//                    }?>
<!--                </div>-->
<!--            </div>-->


            <?php
        }
        ?>
    </div>

    <div  id="main" class="home_main text-right row ">

        <div class="col-md-12 search">

            <div id="sb-search" class="sb-search">
                <form method="get" action="/search.php" class="float-left">
                    <input class="sb-search-input" placeholder="جستجو" type="search" value="" name="search" id="search">
                    <button class="sb-search-submit sb-icon-search" type="submit" value=""><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="col-md-12 test">
            <div class="rightDiv  col-12">
                <div class="col-md-12 text-center addSub float-left">
                    <h3>
                        ویکی تدبیر
                    </h3>
                </div>
                <br/>
                <br/>

                <?php
                $query = "SELECT * FROM grayBox where active>0 ORDER BY orderby;";
                $result = $connection->query($query);
                while ($row=$result->fetch_assoc()) {
                    $name = $row['name'];
                    $Mokhtasar = $row['Mokhtasar'];
                    $id = $row['ID'];
                    $link = $row['link'];
                    ?>
                    <a href="<?php echo $link?>" title="<?php echo $Mokhtasar;?>">
                        <div class="row">
                            <div class="col-md-11 grayBox col-10 d-table">
                                <div class=" d-table-cell align-middle">
                                    <?php echo $name;?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>

            <div class="mainDiv  col-12">
                <div class="subjects col-md-12 float-left ">
                    <div class="col-md-11 float-left">
                        <h4>
                            ویکی تحریر
                        </h4>
                    </div>
                    <div class="hrline float-left"></div>
                    <div class="col-md-11 float-left">

                        <?php
                        $query = "SELECT * FROM category;";
                        $result = $connection->query($query);
                        $x = 0;
                        while ($row=$result->fetch_assoc()) {
                            $id = $row['ID'];
                            $name = $row['name'];
                            $x = $x+1;
                            $idd = 'cat'.$id;
                            $idd3 = 'name'.$id;
                            $idd2 = 'checkcat'.$id;
                            ?>

                            <div class="offset-1 col-md-5 cat float-right col-12 <?php if($x==1) echo 'cat-on';?>" id="<?php echo $idd;?>">
                                <span class="fa-stack check checkmarkk <?php if($x!=1) echo 'd-none';?>" id="<?php echo $idd2;?>">
                                    <i class="far fa-check-square fa-stack-0x fa-inverse bg-success"></i>
                                </span>
                                <span class="d-none" id="<?php echo $idd3;?>"> <?php echo $name; ?> </span>
                                <?php echo $name; ?>
                                <span class="float-left">
                                    <?php
                                    $query2 = "SELECT * FROM Paper WHERE (dastebandi=".$id." and stat>0);" ;
                                    $result2 = $connection->query($query2);
                                    $num = $result2->num_rows;
                                    echo $num;
                                    ?>
                                </span>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="offset-1 col-md-5 cat float-right col-12 " id="cat0">
                            <span class="fa-stack check checkmarkk d-none" id="checkcat0">
                                <i class="far fa-check-square fa-stack-0x fa-inverse bg-success"></i>
                            </span>
                            <span class="d-none" id="name0">  همه دسته‌ها </span>
                            همه دسته‌ها
                            <span class="float-left">
                                <?php
                                $query2 = "SELECT * FROM Paper WHERE stat>0;" ;
                                $result2 = $connection->query($query2);
                                $num = $result2->num_rows;
                                echo $num;
                                ?>
                            </span>
                        </div>

                    </div>
                </div>

                <div class="sorts col-md-12 float-left">
                    <div class="col-md-11 float-left">
                        <h4>
                            مرتب سازی بر اساس
                        </h4>
                    </div>
                    <div class="col-md-11 float-left">
                        <div class="offset-1 col-md-5 srt float-right text-center col-12 " id="srt1">
                            <span class="fa-stack check checkmarkk  d-none" id="checksrt1">
                                <i class="far fa-check-square fa-stack-0x fa-inverse bg-success"></i>
                            </span>
                            محبوب‌ترین‌ها
                        </div>
                        <div class="offset-1 col-md-5 srt float-right text-center srt-on col-12 " id="srt2">
                            <span class="fa-stack check checkmarkk" id="checksrt2">
                                <i class="far fa-check-square fa-stack-0x fa-inverse bg-success"></i>
                            </span>
                            جدیدترین‌ها
                        </div>
                    </div>

                </div>
<!--                <div class="col-md-12 row">-->
<!--                    <div class="col-md-5 col-12 m-auto btn-success btn " id="filter">-->
<!--                        اعمال فیلتر-->
<!--                    </div>-->
<!--                </div>-->

                <div class="col-md-12 float-left ">
                    <div class="col-md-11 float-left">
                        <h2> <span class="fontDiam"> &#9830; </span>
                            <span id="tit">مقالات</span>
                        </h2>
                    </div>

                    <div class="hrline float-left"></div>

                    <div id="replacepagination">

                        <?php
                        $page = 1;
                        $a = ($page-1)*7;
//                        $query = "SELECT * FROM Paper WHERE (stat>0 and dastebandi=1 ) ORDER by realtime DESC  LIMIT $a , 7;";
                        $query = "SELECT Paper.name as name1,Paper.writerID,Paper.realtime,Paper.post_name,Paper.Mokhtasar,Paper.image,users.name as name2 FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.dastebandi=1) ORDER by Paper.realtime DESC  LIMIT $a , 7;";
                        $result = $connection->query($query);
                        while ($row=$result->fetch_assoc()) {
                            $name = $row['name1'];
                            $writerID = $row['writerID'];
                            $writer = $row['name2'];
                            $time = $row['realtime'];
                            $link = '/Paper/'.$row['post_name'];
                            $mokhtasar = $row['Mokhtasar'];
                            $image = $row['image'];
//                            $image = substr($image,3);
                            ?>

                            <div class="col-md-12 Paperdiv col-12 float-left">
                                <div class="col-md-3 float-right col-12 ">
                                    <a href="<?php echo $link;?>">
                                        <img src="/<?php echo $image; ?>" width="100%" height="100%" alt="paperimg">
                                    </a>
                                </div>

                                <div class="col-md-9 PaperText float-right col-12">
                                    <div class="col-md-12 col-12 ">
                                        <h2 class="papname">
                                            <a href="<?php echo $link;?>">
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
//                        $query = "SELECT * FROM Paper  WHERE (stat>0 and dastebandi=1 );" ;
                        $query = "SELECT Paper.ID FROM Paper INNER JOIN users on Paper.writerID = users.mobile WHERE (Paper.stat>0 AND users.eshterakID!=4 AND Paper.dastebandi=1) ;";
                        $result = $connection->query($query);
                        $pagenum = $result->num_rows;
                        if ($pagenum>7) {
                            ?>

                            <div class="pagination-container float-left">
                                <ul class="pagination ">
                                    <li id="-1" class="PagedList-skipToNext paginationoldPapers" rel="prev"> >></li>
                                    <?php
                                    $x = ($pagenum + 6) / 7;
                                    for ($i = 1; $i <= min($x, 2); $i++) {
                                        ?>
                                        <li id="<?php echo $i ?>"
                                            class="paginationoldPapers <?php if ($i == 1) echo "active" ?> "><?php echo $i ?></li>
                                        <?php

                                    }
                                    $i--;
                                    if ($i < max(1, floor($x) - 1))
                                        echo "<li>...</li>";
                                    if ($i < max(1, floor($x))) {
                                        ?>
                                        <li id="<?php echo floor($x) ?>"
                                            class="paginationoldPapers"><?php echo floor($x) ?></li>
                                        <?php
                                    }

                                    ?>

                                    <li id="-2" class="PagedList-skipToNext paginationoldPapers" rel="next"> <<</li>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="leftDiv col-12">
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
?>
<script src="/js/classie.js"></script>
<script src="/js/uisearch.js"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
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
</body>
</html>