<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (($_SESSION['typ']>0)) {
    include '../Settings.php';
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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center panel panel-primary text-light p-4 ">
                        <?php
                        $query2 = "SELECT * FROM user_request WHERE status=0;" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-warning'>".$num.'</u>';
                        ?>
                        پیام جدید از کاربران --->
                        <a href="https://wikiderm.ir/admin/allUsersRequest.php" class="text-info">مشاهده</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center panel panel-primary text-light p-4 ">
                        <?php
                        $query2 = "SELECT * FROM Paper WHERE stat=0;" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-warning'>".$num.'</u>';
                        ?>
                       مقاله در انتظار تایید --->
                        <a href="https://wikiderm.ir/admin/allPosts.php" class="text-info">مشاهده</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center panel panel-primary text-light p-4 ">
                        <?php
                        $query2 = "SELECT * FROM advertisement WHERE (active>0 and stat=0);" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-warning'>".$num.'</u>';
                        ?>
                        آگهی در انتظار تایید --->
                        <a href="https://wikiderm.ir/admin/allAdvertisement.php" class="text-info">مشاهده</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="text-center panel panel-primary text-light p-4 ">
                        مجموع مبلغ تراکنش‌های موفق اشتراک :
                        <?php
                        $query2 = "SELECT sum(amount) as sum FROM allpardakht WHERE (status=2);" ;
                        $result2 = $connection->query($query2);
                        $row = $result2->fetch_assoc();
                        $num = $row['sum'];
                        echo "<u class='text-success'>".$num.'</u>';
                        ?>
                        تومان

                        <br/>

                        تعداد تراکنش‌های لغو شده اشتراک :
                        <?php
                        $query2 = "SELECT amount  FROM allpardakht WHERE (status=0);" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-danger'>".$num.'</u>';
                        ?>

                        <br/>

                        تعداد تراکنش‌های ناموفق اشتراک :
                        <?php
                        $query2 = "SELECT amount as sum FROM allpardakht WHERE (status=1);" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-warning'>".$num.'</u>';
                        ?>
                        <br/>
                        <a href="https://wikiderm.ir/admin/allPardakht.php" >
                            <div class="btn btn-primary mt-3">مشاهده تراکنش‌های اشتراک کاربران</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="text-center panel panel-primary text-light p-4 ">
                        مجموع مبلغ تراکنش‌های موفق آگهی :
                        <?php
                        $query2 = "SELECT sum(amount) as sum FROM allpardakhtadd WHERE (status=2);" ;
                        $result2 = $connection->query($query2);
                        $row = $result2->fetch_assoc();
                        $num = $row['sum'];
                        echo "<u class='text-success'>".$num.'</u>';
                        ?>
                        تومان

                        <br/>

                        تعداد تراکنش‌های لغو شده آگهی :
                        <?php
                        $query2 = "SELECT amount  FROM allpardakhtadd WHERE (status=0);" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-danger'>".$num.'</u>';
                        ?>

                        <br/>

                        تعداد تراکنش‌های ناموفق آگهی :
                        <?php
                        $query2 = "SELECT amount as sum FROM allpardakhtadd WHERE (status=1);" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-warning'>".$num.'</u>';
                        ?>
                        <br/>
                        <a href="https://wikiderm.ir/admin/allPardakhtAdd.php" >
                            <div class="btn btn-primary mt-3">مشاهده تراکنش‌های تبلیغاتی</div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 m-auto">

                    <div class="text-center panel panel-primary text-light p-4 ">
                        تعداد کاربران :
                        <?php
                        $query2 = "SELECT * FROM users WHERE (typ=0);" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-success'>".$num.'</u>';
                        ?>

                        <br/>

                        تعداد کاربران در انتظار تایید :
                        <?php
                        $query2 = "SELECT * FROM users WHERE (typ=0 and stat=0);" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-danger'>".$num.'</u>';
                        ?>

                        <br/>

                        تعداد کاربران بدون اشتراک (یا اتمام اشتراک) :
                        <?php
                        $query2 = "SELECT * FROM users WHERE (typ=0 and eshterakID=4);" ;
                        $result2 = $connection->query($query2);
                        $num = $result2->num_rows;
                        echo "<u class='text-warning'>".$num.'</u>';
                        ?>
                        <br/>
                        <a href="https://wikiderm.ir/admin/allUsers.php" >
                            <div class="btn btn-primary mt-3">مدیریت کاربران</div>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</body>
</html>
<?php
    }else{
    header('Location:../');

}
