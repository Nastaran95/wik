<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/28/19
 * Time: 5:09 PM
 */
session_start();

include 'Settings.php'; //harja khasti DB estefade koni ino bezan faghat
$productXMLNAME = "XMLs/users.xml";
if (file_exists($productXMLNAME)) {
    $XMLFile = simplexml_load_file($productXMLNAME);
    $SEOdescription=$XMLFile->description;
    $SEOKEYWORDS=$XMLFile->kewords;
    $SEOTITLE=$XMLFile->seotitle;
    $datashould = $XMLFile->data1;
    $datashould2 = $XMLFile->data2;
}else{
    $SEOdescription="";
    $SEOKEYWORDS="";
    $SEOTITLE="";
    $datashould="";
    $datashoulds="";
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
    <link rel="stylesheet" href="css/users.css"/>
    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="js/modernizr.custom.js"></script>
    <script src="js/users.js" ></script>

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


        <div class="col-md-12 ">

            <div class="mainDiv col-md-9 col-12 text-right">
                <div class="col-md-12 ">

                    <div class="col-md-12">
                        <h1> <span class="fontDiam"> &#9830; </span>
اعضای دانشنامه
                        </h1>
                    </div>



                    <div class="box">

                        <div id="replacepagination">
                            <div class="row">
                            <?php
                            $page = 1;
                            $a = ($page-1)*18;
                            $query = "SELECT * FROM users WHERE stat>0 ORDER by name ASC LIMIT $a , 18;";
                            $result = $connection->query($query);

                            while ($row=$result->fetch_assoc()) {
                                $name = $row['name'];
                                $img = $row['image'];
                                $id = $row['ID'];

                                $link = '/user/'.$id;

                                ?>

                                <div class="col-md-4 float-right col-12 col-xs-6 p-3">
                                    <a href="<?php echo $link;?>">
<!--                                        <img src="/--><?php //echo $img; ?><!--" width="100%" height="150px" alt="paperimg">-->
<!--                                        <div class="col-md-12 text-center">--><?php //echo $name;?><!--</div>-->

                                        <div class="profile-header-container">
                                            <div class="profile-header-img">
                                                <img class="img-circle m-3" src="<?php echo $img; ?>" />
                                                <!-- badge -->
                                                <div class="rank-label-container">
                                                    <div class="label label-default rank-label"><?php echo $name;?></div>
                                                </div>
                                            </div>
                                        </div>

                                    </a>
                                </div>



                                <?php
                            }
                            ?>
                            </div>
                            <?php

                            $query = "SELECT * FROM users WHERE stat>0;" ;
                            $result = $connection->query($query);
                            $pagenum = $result->num_rows;
                            if ($pagenum>18) {
                                ?>

                                <div class="pagination-container float-left">
                                    <ul class="pagination">
                                        <li id="-1" class="PagedList-skipToNext paginationoldPapers" rel="prev"> >></li>
                                        <?php
                                        $x = ($pagenum + 17) / 18;
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

            <div class="leftDiv col-md-3 col-12">
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