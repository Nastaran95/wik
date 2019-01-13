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
    $query = "SELECT * FROM Paper WHERE post_name='$ID';";
    $result = $connection->query($query);
//    echo $connection->error;
    if ($row = $result->fetch_assoc()) {
        $subj = $row['name'];
        $writer = $row['writer'];
        $time = $row['realtime'];
        $dastebandi = $row['dastebandi'];
        $xmlAdress = $row['XMLNAME'];
        $xmlAdress = substr($xmlAdress,3);
        if (file_exists($xmlAdress)) {
            $XMLFile = simplexml_load_file($xmlAdress);
            $Description=$XMLFile->data;
        }else{
            $Description="";
        }
        $SEOTITLE=$row['name'];

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

        <div class="col-md-12 test">

            <div class="mainDiv col-md-9 col-12">

                    <div class="col-md-12 float-right col-12 text-right" >
                        <div class="col-md-12 float-left">
                            <h1> <span class="fontDiam"> &#9830; </span>
                                <?php echo $subj; ?>
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
                            <div class="col-md-12 col-12 text-justify">
                                <?php echo $Description; ?>
                            </div>
                        </div>

                    </div>

                <?php
                $query = "SELECT * FROM Paper WHERE writer LIKE '%$writer%'";
                $result = $connection->query($query) ;
                $pagenum = $result->num_rows;
                if($pagenum>0) {


                    ?>

                    <div class="col-md-12 float-left text-right">
                        <div class="col-md-12 float-left">
                            <h1> <span class="fontDiam"> &#9830; </span>
                                دیگر مقالات از این نویسنده
                            </h1>
                        </div>
                        <div class="hrline float-left"></div>
                        <div class="afterHr row">
                            <div id="replacepagination1" class="<?php echo $writer;?>">

                                <?php
                                $page = 1;
                                $a = ($page - 1) * 2;
                                $query = "SELECT * FROM Paper WHERE writer LIKE '%$writer%' LIMIT $a , 2;";
                                $result = $connection->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['name'];
                                    $writer = $row['writer'];
                                    $time = $row['realtime'];
                                    $link = '/Paper/' . $row['post_name'];
                                    $mokhtasar = $row['Mokhtasar'];
                                    $image = $row['image'];
                                    $image = substr($image, 3);
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
                ?>

                <?php
                $query = "SELECT * FROM Paper WHERE dastebandi='$dastebandi';";
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
                                $query = "SELECT * FROM Paper WHERE dastebandi='$dastebandi' LIMIT $a , 2;";
                                $result = $connection->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['name'];
                                    $writer = $row['writer'];
                                    $time = $row['realtime'];
                                    $link = '/Paper/' . $row['post_name'];
                                    $mokhtasar = $row['Mokhtasar'];
                                    $image = $row['image'];
                                    $image = substr($image, 3);
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
                <div class="col-md-12 add">
                    <img src="/images/tabliq.png" width="100%" height="100%" alt="">
                </div>
                <div class="col-md-12 add">
                    <img src="/images/tabliq.png" width="100%" height="100%" alt="">
                </div>
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