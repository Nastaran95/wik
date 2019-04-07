<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 1:58 AM
 */
session_start();
include 'Settings.php';
$productXMLNAME = "XMLs/tarafe.xml";
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
    <meta property="og:url" content="https://wikiderm.ir/">
    <meta property="og:site_name" content="ویکی‌درم">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/x-icon" href="/images/wikiderm-icon--300x300.png" />
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <script src="/js/jQuery.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    <link rel="stylesheet" href="/css/global.css"/>
    <link rel="stylesheet" href="/css/tarafe.css"/>
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
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

        <div class="col-md-12">

            <div class="mainDiv col-md-9 col-12 text-right">


                <div class="col-md-12 ">

                    <div class="col-md-12">
                        <h1> <span class="fontDiam"> &#9830; </span>
                          تعرفه‌ها
                        </h1>
                        <div class="text-justify blackCol box">

                            <div class="col-md-12 ">
                                <h2 class="text-info h4 mb-4">
                                    تعرفه بسته‌های اشتراک
                                </h2>
                                <table class="m-auto typeTable w-100" >
                                    <?php
                                    $query = "SELECT * FROM usereshterak;";
                                    $result = $connection->query($query);
                                    $x = 0 ;
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        $id = $row['ID'];
                                        $price = $row['qeimat'];
                                        $x++;
                                        if($id!=4) {
                                            ?>
                                            <tr>
                                                <th>بسته اشتراک <?php echo $name; ?></th>
                                                <th><?php echo $price; ?> تومان</th>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </table>
                                <div class="mt-4 mb-2 text-center">برای انتخاب اشتراک وارد شوید. اگر عضو نیستید ثبت نام کنید:</div>
                                <div class="col-md-10 row mt-4 ml-auto mr-auto">

                                    <div class="col-md-6 col-12 mb-2">
                                        <a href="/loginRegister.php?request=login">
                                            <div class="btn  login w-100">ورود</div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-12 mb-2">
                                        <a href="/loginRegister.php?request=register">
                                            <div class="btn register w-100">ثبت نام</div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="text-justify blackCol box">

                            <div class="col-md-12 ">
                                <h2 class="text-info h4 mb-4">
                                    تعرفه آگهی
                                </h2>
                                <table class="m-auto typeTable w-100" >
                                    <?php
                                    $query = "SELECT * FROM addCategory;";
                                    $result = $connection->query($query);
                                    $x = 0 ;
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        $id = $row['ID'];
                                        $price = $row['qeimat'];
                                        $x++;
                                        ?>
                                        <tr>
                                            <th>نمایش <?php echo $name; ?></th>
                                            <th><?php echo $price; ?> تومان</th>
                                        </tr>
                                        <?php

                                    }
                                    ?>

                                </table>
                                <div class="col-md-10 row mt-4 ml-auto mr-auto">
                                    <a href="/advertisement.php" class="w-75 m-auto">
                                        <div class="btn  login w-100">ثبت آگهی</div>
                                    </a>
                                </div>

                            </div>

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
    "url":"https://wikiderm.ir/",
    "sameAs":["https://www.instagram.com/wikiderm/"],
    "@id":"#organization",
    "name":"ویکی‌درم",
    "logo":"https://wikiderm.ir/<?php echo $XMLFile->logo->url;?>"}
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
</body>
</html>