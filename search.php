<?php
/**
 * Created by PhpStorm.
 * User: HamidReza
 * Date: 9/18/2017
 * Time: 2:31 PM
 */
session_start();
include 'Settings.php';
if ((isset($_GET['search']))&&(strlen($_GET['search'])>1)){
    $datesearch=$_GET['search'];
    $datesearch=str_replace("\"","",$datesearch);
    $datesearch=str_replace("'","",$datesearch);
    $datesearch=str_replace('\'','',$datesearch);

    $datesearch=str_replace('ی','_',$datesearch);
    $datesearch=str_replace('ي','_',$datesearch);
    $datesearch=str_replace('ئ','_',$datesearch);
    $datesearch=str_replace('و','_',$datesearch);
    $datesearch=str_replace('ؤ','_',$datesearch);

    $datesearch=str_replace('ؠ','_',$datesearch);
    $datesearch=str_replace('ؤ','_',$datesearch);
    $datesearch=str_replace('إ','_',$datesearch);
    $datesearch=str_replace('ئ','_',$datesearch);
    $datesearch=str_replace('ؽ','_',$datesearch);
    $datesearch=str_replace('ؾ','_',$datesearch);
    $datesearch=str_replace('ؿ','_',$datesearch);
    $datesearch=str_replace('ك','_',$datesearch);
    $datesearch=str_replace('ي','_',$datesearch);
    $datesearch=str_replace('ٶ','_',$datesearch);
    $datesearch=str_replace('ٷ','_',$datesearch);
    $datesearch=str_replace('ٸ','_',$datesearch);
    $datesearch=str_replace('ډ','_',$datesearch);
    $datesearch=str_replace('ڊ','_',$datesearch);



    $commandPaper="WHERE a.stat>0 and (";
    $commandAdd="WHERE stat>0 and active>0 and (";
    $commandUser="WHERE stat>0 and typ<10 and (";
    $X=mbsplit(" ",$datesearch);

    $commandPaper=$commandPaper." a.name LIKE '%".$datesearch."%'"." or "." b.name LIKE '%".$datesearch."%'"." or "." a.Mokhtasar LIKE '%".$datesearch."%'";

    $commandAdd=$commandAdd." name LIKE '%".$datesearch."%'"." or "." matn LIKE '%".$datesearch."%'"." or "." number LIKE '%".$datesearch."%'"." or "." link LIKE '%".$datesearch."%'"." or "." address LIKE '%".$datesearch."%'";

    $commandUser=$commandUser." name LIKE '%".$datesearch."%'"." or "." address LIKE '%".$datesearch."%'"." or "." email LIKE '%".$datesearch."%'";


    $commandPaper=$commandPaper.") order by a.realtime desc";
    $commandAdd=$commandAdd.") ";
    $commandUser=$commandUser.") ";


    $resultproducts = $connection->query("SELECT a.name,a.Mokhtasar,a.image,a.post_name,a.realtime,b.name as username FROM Paper as a INNER JOIN users as b on a.writerID = b.mobile " . $commandPaper);
    $resultAdds = $connection->query("SELECT name,image,ID FROM advertisement " . $commandAdd);
    $resultUsers = $connection->query("SELECT name,image,ID FROM users " . $commandUser);

//    echo "SELECT a.name,a.Mokhtasar,a.image,a.post_name,b.name as username FROM Paper as a INNER JOIN users as b on a.writerID = b.mobile " . $commandPaper;
//    echo $connection->error;
}else {
    header("Location:/");
}
?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html>

    <head>
        <meta charset="UTF-8">
        <title>نتایج جستجو</title>
        <meta http-equiv="content-language" content="fa">
        <meta charset="UTF-8">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://www.wikiderm.ir/">
        <meta property="og:site_name" content="ویکی‌درم">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="icon" type="image/x-icon" href="images/wikiderm-icon--300x300.png" />
        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
<!--        <script src="/js/home.js" ></script>-->
        <link rel="stylesheet" href="/css/global.css"/>
        <link rel="stylesheet" href="/css/search.css"/>
        <link href="/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <script src="/js/modernizr.custom.js"></script>

    </head>
    <body dir="rtl">
    <?php
    include 'Header.php';
    ?>
    <div id="container">
        <div  class="home_main text-right row ">
            <div class="col-md-12 float-left ">
            <?php

                if($resultproducts->num_rows==0){
                    ?>
                    <div class="col-md-11 float-left text-info">
                        <h2> <span class="fontDiam"> &#9830; </span>
                            مقالات موجود
                        </h2>
                    </div>

                    <div class="hrline float-left"></div>
                    <div class="col-md-12 text-danger text-center float-right mb-5">مقاله‌ای پیدا نشد.</div>
                    <?php
                }
                $x = 0;
                while ($r2 = $resultproducts->fetch_assoc()) { //fetch values
                    if($x==0) {
                        ?>
                        <div class="col-md-11 float-left text-info">
                            <h2><span class="fontDiam"> &#9830; </span>
                                مقالات موجود
                            </h2>
                        </div>

                        <div class="hrline float-left"></div>

                        <?php
                    }
                    $x = $x+1;

                    $productname = $r2['name'];
                    $productMokh = $r2['Mokhtasar'];
                    $img=$r2['image'];
                    $link=$r2['post_name'];
                    $writer=$r2['username'];
                    $time=$r2['realtime'];

                    ?>
                    <div class="float-right text-center col-md-4 col-12">
                        <?php
                        ?>
                        <a href="/Paper/<?php echo $link; ?>/">
                            <img class="" width="200px" height="200px" src="<?php echo $img;?>" alt="<?php echo $productname;?>"/>
                            <div class="caption">
                                <h4 class="papname"><?php echo $productname;?></h4>

                                <div class="col-md-12 nametime col-12 row">
                                    <div class="col-md-6 col-12 ">
                                        <?php echo $writer; ?>
                                    </div>
                                    <div class="col-md-6 col-12 ">
                                        <?php echo $time; ?>
                                    </div>
                                </div>

                                <div class="col-md-12 col-12 summ">
                                    <?php echo $productMokh;?>
                                </div>

                            </div>

                        </a>
                    </div>
                    <?php

                }
                if($resultAdds->num_rows==0){
                ?>
                <div class="col-md-11 float-left text-info">
                    <h2> <span class="fontDiam"> &#9830; </span>
                        تبلیغات موجود
                    </h2>
                </div>

                <div class="hrline float-left"></div>
                <div class="col-md-12 text-danger text-center float-right mb-5">تبلیغاتی پیدا نشد.</div>
                <?php
                }
            $x = 0;
                while ($r3 = $resultAdds->fetch_assoc()) { //fetch values
                    if($x==0) {
                        ?>
                        <div class="col-md-11 float-left text-info">
                            <h2><span class="fontDiam"> &#9830; </span>
                                تبلیغات موجود
                            </h2>
                        </div>

                        <div class="hrline float-left"></div>

                        <?php
                    }
                    $x = $x+1;

                    $productname = $r3['name'];
                    $img=$r3['image'];
                    $id=$r3['ID'];

                    ?>
                    <div class="float-right text-center col-md-4 col-12">
                        <?php
                        ?>
                        <a href="/addPage/<?php echo $id; ?>/">
                            <img class="" width="200px" height="200px" src="<?php echo $img;?>" alt="<?php echo $productname;?>"/>
                            <div class="mb-5">
                                <h4 class="papname"><?php echo $productname;?></h4>
                            </div>
                        </a>
                    </div>
                    <?php

                }
                if($resultUsers->num_rows==0){
                    ?>
                    <div class="col-md-11 float-left text-info">
                        <h2> <span class="fontDiam"> &#9830; </span>
                            اعضای دانشنامه
                        </h2>
                    </div>

                    <div class="hrline float-left"></div>
                    <div class="col-md-12 text-danger text-center float-right mb-5">عضوی پیدا نشد.</div>
                    <?php
                }
            $x = 0;
                while ($r4 = $resultUsers->fetch_assoc()) { //fetch values
                    if($x==0) {
                        ?>
                        <div class="col-md-11 float-left text-info">
                            <h2><span class="fontDiam"> &#9830; </span>
                                اعضای دانشنامه
                            </h2>
                        </div>

                        <div class="hrline float-left"></div>

                        <?php
                    }
                    $x = $x + 1;

                    $productname = $r4['name'];
                    $img=$r4['image'];
                    $id=$r4['ID'];

                    ?>
                    <div class="float-right text-center col-md-4 col-12">
                        <?php
                        ?>
                        <a href="/user/<?php echo $id; ?>/">
                            <img class="" width="200px" height="200px" src="<?php echo $img;?>" alt="<?php echo $productname;?>"/>
                            <div class="mb-5">
                                <h4 class="papname"><?php echo $productname;?></h4>
                            </div>
                        </a>
                    </div>
                    <?php

                }
                ?>

            </div>
        </div>
    </div>





    <?php
    include 'Footer.php';
    ?>
    </body>
    </html>



<?php
