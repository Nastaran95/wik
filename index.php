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
<!--    <script src="js/index.js" ></script>-->
<!--    <script src="js/helper.js" ></script>-->
    <script src="js/home.js" ></script>
    <link rel="stylesheet" href="css/global.css"/>
    <link rel="stylesheet" href="css/home.css"/>
    <link rel="canonical" href="https://www.wikiderm.ir/">
    <link rel="alternate" href="https://www.wikiderm.ir/" hreflang="fa-IR" />
    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="js/modernizr.custom.js"></script>
</head>
<STYLE>A {text-decoration: none;} </STYLE>
<body>

<?php
include 'headerMainpage.php';
?>


<div class="container">
    <div class="header coverMain">
        <div class="cover ">
            <div id="myCarousel" class="carousel slide col-md-12" data-ride="carousel">



                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
                    $query2 = "SELECT * FROM slider ;" ;
                    $result2 = $connection->query($query2);
                    $num = $result2->num_rows;
                    $x = 0;
                    while ($x<$num){
                        ?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $x;?>" class="<?php if($x==0) echo'active';?>"></li>
                        <?php
                        $x = $x + 1;
                    }
                    ?>
                </ol>



                <!-- Wrapper for slides -->
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
                        ?>
                        <div class="item <?php if($x==0) echo'active';?>">
                            <img src="<?php echo $img; ?>" alt="<?php echo $alt; ?>" width="100%">
                            <div class="carousel-caption">
                                <h3><?php echo $name; ?></h3>
                                <p><?php echo $mokhtasar; ?></p>
                            </div>
                        </div>
                        <?php
                        $x = $x+1;
                    }
                    ?>


                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">قبلی</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">بعدی</span>
                </a>
            </div>
        </div>
        <div class="cover_menu menu">
            <ul class="dark_text">
                <a href="/" ><li>صفحه اصلی</li></a>
                <a href="/" ><li>مقالات</li></a>
                <a href="/" ><li>سلویک</li></a>
                <a href="/" ><li>تماس با ما</li></a>
                <a href="/" ><li>درباره ما</li></a>
                <a href="/" ><li>آگهی</li></a>
            </ul>
        </div>
    </div>

    <div  id="main" class="home_main">

        <div class="col-md-12 search">

            <div id="sb-search" class="sb-search">
                <form class="pull-left">
                    <input class="sb-search-input" placeholder="جستجو" type="search" value="" name="search" id="search">
                    <button class="sb-search-submit sb-icon-search" type="submit" value=""><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="col-md-12 test">
            <div class="rightDiv">
                <div class="col-md-12 grayBox"> سلویک </div>
                <div class="col-md-12 grayBox"> </div>
                <div class="col-md-12 grayBox"> </div>
                <div class="col-md-12 grayBox"> </div>
                <div class="col-md-12 grayBox"> </div>
                <div class="col-md-12 grayBox"> </div>
                <div class="col-md-12 grayBox"> </div>
            </div>

            <div class="mainDiv">
                <div class="col-md-12 subjects">
                    <div class="col-md-12">
                        <h4>
                            موضوعات
                        </h4>
                    </div>
                    <div class="col-md-11">

                        <?php
                        $query = "SELECT * FROM category;";
                        $result = $connection->query($query);
                        $x = 0;
                        while ($row=$result->fetch_assoc()) {
                            $id = $row['ID'];
                            $name = $row['name'];
                            $x = $x+1;
                            $idd = 'cat'.$id;
                            ?>

                            <div class="col-md-offset-1 col-md-5 cat pull-right col-xs-12 <?php if($x==1) echo 'cat-on';?>" id="<?php echo $idd;?>">
                                <?php echo $name; ?>
                                <span class="pull-left">
                                    <?php
                                    $query2 = "SELECT * FROM Paper WHERE dastebandi=".$id.";" ;
                                    $result2 = $connection->query($query2);
                                    $num = $result2->num_rows;
                                    echo $num;
                                    ?>
                                </span>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="col-md-offset-1 col-md-5 cat pull-right col-xs-12 " id="cat0">
                            همه دسته‌ها
                            <span class="pull-left">
                                <?php
                                $query2 = "SELECT * FROM Paper ;" ;
                                $result2 = $connection->query($query2);
                                $num = $result2->num_rows;
                                echo $num;
                                ?>
                            </span>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 sorts">
                    <div class="col-md-12">
                        <h4>
                            مرتب سازی بر اساس
                        </h4>
                    </div>
                    <div class="col-md-11">
                        <div class="col-md-offset-1 col-md-5 srt pull-right text-center col-xs-12 " id="srt1">
                            محبوب‌ترین
                        </div>
                        <div class="col-md-offset-1 col-md-5 srt pull-right text-center srt-on col-xs-12 " id="srt2">
                            جدیدترین
                        </div>
                    </div>
                </div>

                <div class="col-md-12 papers">
                    <div class="col-md-12 papsub">

                        <h1> &#9830;
                            مقالات
                        </h1>
                        <div class="col-md-10 col-md-offset-1 papsubbord"></div>


                        <div class="row">
                            <div class="col-md-12">

                                <div id="replacepagination">

                                    <?php
                                    $page = 1;
                                    $a = ($page-1)*7;
                                    $query = "SELECT * FROM Paper LIMIT $a , 7;";
                                    $result = $connection->query($query);
                                    while ($row=$result->fetch_assoc()) {
                                        $name = $row['name'];
                                        $writer = $row['writer'];
                                        $time = $row['realtime'];
                                        $link = '/Paper/'.$row['post_name'];
                                        $mokhtasar = $row['Mokhtasar'];
                                        $image = $row['image'];
                                        $image = substr($image,3);
                                        ?>

                                        <div class="col-md-12 Paperdiv col-xs-12 col-xs-12 ">
                                            <div class="col-md-3 pull-right col-xs-12 ">
                                                <img src="<?php echo $image; ?>" width="100%" height="100%" alt="paperimg">
                                            </div>

                                            <div class="col-md-9 PaperText pull-right col-xs-12 col-xs-12 ">
                                                <div class="col-md-12 col-xs-12 ">
                                                    <h2 class="papname">
                                                        <?php echo $name; ?>
                                                    </h2>
                                                </div>

                                                <div class="col-md-12 nametime col-xs-12 ">

                                                    <div class="col-md-8 col-xs-12 ">
                                                        <?php echo $time; ?>
                                                    </div>
                                                    <div class="col-md-4 col-xs-12 ">
                                                        <?php echo $writer; ?>
                                                    </div>

                                                </div>
                                                <div class="col-md-12 summ col-xs-12 ">
                                                    <?php echo $mokhtasar; ?>
                                                </div>
                                            </div>

                                        </div>
                                        <br>

                                        <?php
                                    }
                                    $query = "SELECT * FROM Paper;" ;
                                    $result = $connection->query($query);
                                    $pagenum = $result->num_rows;
                                    ?>

                                    <div class="pagination-container pull-left">
                                        <ul class="pagination right">
                                            <li id="-1" class="PagedList-skipToNext paginationoldPapers" rel="prev"> >> </li>
                                            <?php
                                            $x = ($pagenum+6) / 7 ;
                                            for ($i=1 ; $i <= min($x,2) ; $i++){
                                                ?>
                                                <li id="<?php echo $i?>" class="paginationoldPapers <?php if ($i==1) echo "active" ?> "><?php echo $i?></li>
                                                <?php

                                            }
                                            $i--;
                                            if ($i<max(1,floor($x)-1))
                                                echo "<li>...</li>";
                                            if ($i<max(1,floor($x))){
                                                ?>
                                                <li id="<?php echo floor($x)?>" class="paginationoldPapers"><?php echo floor($x)?></li>
                                                <?php
                                            }

                                            ?>

                                            <li id="-2" class="PagedList-skipToNext paginationoldPapers" rel="next"> << </li>
                                        </ul>

                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>

                </div>
            </div>

            <div class="leftDiv">
                <div class="col-md-offset-1 col-md-10 text-center addSub">
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