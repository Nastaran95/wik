<?php
session_start();
if (($_SESSION['typ']>0)) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین</title>
    
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <script src="/js/jQuery.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


</head>
<body dir="rtl">
    <div id="wrapper">
        <?php
        $which=1;
        include 'adminmenue.php';
        ?>

<!--        <div id="page-wrapper">-->
<!--            <div class="row">-->
<!--                <div class="col-lg-12">-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="row">-->
<!--                <div class="col-md-8">-->
<!--                    <div class="panel panel-primary">-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-4">-->
<!--                    <div class="panel panel-primary">-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <!-- /#wrapper -->
</body>
</html>
<?php
    }else{
    header('Location:../');

}
