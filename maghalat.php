<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 5:01 PM
 */
session_start();

include 'Settings.php'; //harja khasti DB estefade koni ino bezan faghat
$productXMLNAME = "XMLs/maghalat.xml";
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
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <script src="/js/jQuery.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    <link rel="stylesheet" href="/css/global.css"/>
    <link rel="stylesheet" href="/css/maghalat.css"/>
    <link rel="canonical" href="https://www.wikiderm.ir/">
    <link rel="alternate" href="https://www.wikiderm.ir/" hreflang="fa-IR" />
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
    <script src="/js/maghalat.js"></script>
</head>

<body>

<?php
include 'header.php';
?>


<div class="container">
    <div  id="main" class="home_main text-right row">

        <div class="col-md-12 search hiddenthisoverxs">
            <div id="sb-search2" class="sb-search">
                <form class="float-left">
                    <input class="sb-search-input" placeholder="جستجو" type="search" value="" name="search" id="search2">
                    <button class="sb-search-submit sb-icon-search" type="submit" value=""><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="rightDiv col-12">
                <div class="col-md-12 subjects float-left">
                    <div class="col-md-12 float-left">
                        <h4>
                            موضوعات
                        </h4>
                    </div>
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
                            ?>

                            <div class="col-md-12 cat float-right col-12 cat-on" id="<?php echo $idd;?>">
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

                        <div class="col-md-12 cat float-right col-12 cat-on" id="cat0">
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

                <div class="col-md-12 sorts float-left">
                    <div class="col-md-12 float-left">
                        <h4>
                            مرتب سازی بر اساس
                        </h4>
                    </div>
                    <div class="col-md-11 float-left">
                        <div class="col-md-12 srt float-right text-center col-12 " id="srt1">
                            محبوب‌ترین
                        </div>
                        <div class="col-md-12 srt float-right text-center srt-on col-12 " id="srt2">
                            جدیدترین
                        </div>
                    </div>
                </div>
            </div>

            <div class="mainDiv col-12">
                <div class="col-md-12 float-left row">
                    <div class="col-md-11 float-left">
                        <h1> <span class="fontDiam"> &#9830; </span>
                            مقالات
                        </h1>
                    </div>

                    <div class="hrline"></div>
                    <div class="col-md-12">

                        <div id="replacepagination">

                            <?php
                            $page = 1;
                            $a = ($page-1)*7;
                            $query = "SELECT * FROM Paper WHERE stat>0 ORDER by realtime DESC  LIMIT $a , 7;";
                            $result = $connection->query($query);
                            while ($row=$result->fetch_assoc()) {
                                $name = $row['name'];
                                $writerID = $row['writerID'];
                                $q = "SELECT * FROM users WHERE mobile=".$writerID.";";
                                $res = $connection->query($q);
                                if($rw=$res->fetch_assoc())
                                    $writer = $rw['name'];
                                else
                                    $writer = 'ناشناس';
                                $time = $row['realtime'];
                                $link = '/Paper/'.$row['post_name'];
                                $mokhtasar = $row['Mokhtasar'];
                                $image = $row['image'];
//                                $image = substr($image,3);
                                ?>

                                <div class="col-md-12 Paperdiv col-12 float-left ">
                                    <div class="col-md-3 float-right col-12 ">
                                        <a href="<?php echo $link;?>">
                                            <img src="/<?php echo $image; ?>" width="100%" height="100%" alt="paperimg">
                                        </a>
                                    </div>

                                    <div class="col-md-9 PaperText float-right col-12 ">
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
                            $query = "SELECT * FROM Paper WHERE stat>0;" ;
                            $result = $connection->query($query);
                            $pagenum = $result->num_rows;
                            if ($pagenum>7) {
                                ?>

                                <div class="pagination-container float-left">
                                    <ul class="pagination">
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
            </div>

            <div class="leftDiv col-12">
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