<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 8:16 PM
 */
session_start();

include 'Settings.php'; //harja khasti DB estefade koni ino bezan faghat



if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $query = "SELECT * FROM users WHERE (ID='$ID' and stat>0);";
    $result = $connection->query($query);
    if ($row = $result->fetch_assoc()) {

        $add = $row['address'];
        $img = '/'.$row['image'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $showMobile = $row['showMobile'];

        $cat = $row['categoryID'];
        $q = "SELECT * FROM userCategory WHERE ID=".$cat.";";
        $res = $connection->query($q);
        if($rw=$res->fetch_assoc())
            $category = $rw['name'];
        else
            $category = 'سایر';

        $SEOTITLE=$row['name'];
        $nm =$row['name'];

    } else{
        header('Location:/');
    }
    $tab = 1;
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
    <link rel="stylesheet" href="/css/user.css"/>
    <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="/js/modernizr.custom.js"></script>
    <script src="/js/user.js"></script>
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

            <div class="mainDiv col-md-9 col-12 text-right pb-5">

                <div class="profile-header-container pb-5">
                    <div class="profile-header-img col-md-5 m-auto ">
                        <img class="img-circle m-3" src="<?php echo $img; ?>" />
                        <!-- badge -->
                        <div class="rank-label-container">
                            <div class="label label-default rank-label"><?php echo $nm;?></div>
                        </div>
                    </div>
                </div>



                <div class="tab ">
                    <button class="tablinks <?php if($tab==1) echo "active";?>" onclick="openCity(event, 'personal')">مشخصات شخصی</button>
                    <button class="tablinks <?php if($tab==2) echo "active";?>" onclick="openCity(event, 'posts')">پست‌ها</button>
                </div>

                <div id="personal" class="tabcontent pt-4 <?php if($tab==1) echo "d-block"; else echo "d-none";?>">

                    <div  class="row text-secondary" >
                        <div class="form-group col-md-10 m-auto text-right">
                            <div class="NameInfo"><i class="fas fa-layer-group"></i>
                                دسته‌بندی</div>
                            <div class="text-dark p-3" >
                                <?php echo $category; ?>
                            </div>
                        </div>

                        <div class="form-group col-md-10 m-auto text-right">
                            <div class="NameInfo"><i class="fas fa-layer-group"></i>
                                ایمیل</div>
                            <div class="text-dark p-3" >
                                <?php echo $email; ?>
                            </div>
                        </div>

                        <?php
                        if($showMobile>0) {
                            ?>
                            <div class="form-group col-md-10 m-auto text-right">
                                <div class="NameInfo"><i class="fas fa-phone-square"></i>
                                     شماره تماس
                                </div>
                                <div class="text-dark p-3">
                                    <?php echo $mobile; ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="form-group col-md-10 m-auto text-right">
                            <div class="NameInfo"><i class="fas fa-map-marker"></i>
                                آدرس</div>
                            <div class="text-dark p-3" >
                                <?php echo $add; ?>
                            </div>
                        </div>

                    </div>


                </div>



                <div id="posts" class="tabcontent  <?php if($tab==2) echo "d-block"; else echo "d-none";?>">
                    <?php
                    $query = "SELECT * FROM Paper WHERE writerID LIKE '".$mobile."' and stat>0;";
                    $result = $connection->query($query) ;
                    $pagenum = $result->num_rows;
                    if($pagenum>0) {


                        ?>

                        <div class="col-md-12 text-right">

                            <div class=" row">
                                <div id="replacepagination1" class="<?php echo $ID;?>" >

                                    <?php
                                    $page = 1;
                                    $a = ($page - 1) * 2;
                                    $query = "SELECT * FROM Paper WHERE (writerID LIKE '".$mobile."' and stat>0) ORDER by realtime DESC LIMIT $a , 2;";
                                    $result = $connection->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['ID'];
                                        $name = $row['name'];
                                        $writerID = $row['writerID'];
                                        $writer = $name;
                                        $time = $row['realtime'];
                                        $link = '/Paper/' . $row['post_name'];
                                        $mokhtasar = $row['Mokhtasar'];
                                        $image = $row['image'];
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
                                                    <div class="col-md-6 col-12 ">
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
                    else{?>
                        <div class="m-5">
                            در حال حاضر پستی از ایشان وجود ندارد.
                        </div>
                        <?php
                    }
                    ?>
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