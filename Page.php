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


if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $query = "SELECT * FROM Pages WHERE link='$ID';";
    $result = $connection->query($query);
//    echo $connection->error;
    if ($row = $result->fetch_assoc()) {
        $id = $row['ID'];
        $subj = $row['name'];

        $xmlAdress = $row['XMLNAME'];
//        $xmlAdress = substr($xmlAdress,3);
        if (file_exists($xmlAdress)) {
            $XMLFile = simplexml_load_file($xmlAdress);
            $Description=$XMLFile->data;
        }else{
            $Description="";
        }

        $SEOTITLE=$row['name'];
        $SEOdescription=$row['name'];
        $SEOKEYWORDS=$row['name'];

        $stmt = $connection->prepare("UPDATE Pages set mahbobiat=mahbobiat+1 WHERE (ID=?)");
        $stmt->bind_param("s", $id);
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
                        <div id="text_1" class="fr-element fr-view bar_text ">
                            <?php echo $Description; ?>
                        </div>

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