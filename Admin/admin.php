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

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
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
