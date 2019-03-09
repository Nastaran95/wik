<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/20/19
 * Time: 2:27 AM
 */
session_start();
include '../Settings.php';
if (($_SESSION['typ']>0)) {
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } else {
        $type = 1;
    }

    if (isset($_GET['request']) && $_GET['request']==1){
        $name = $_POST['name'];
        $time = $_POST['time'];

        $id = $_GET['request'];
        $stmt = $connection->prepare("UPDATE newUsers SET name=? ,days=? WHERE (ID=1)");
        $stmt->bind_param("ss", $name,$time);
        $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
        $stmt->close();

        if ($connection->error) {
            $movafagh = 'عملیات مورد نظر موفق نبود. وارد کردن تمامی موارد الزامی است.';

        } else {
            echo "<script>alert('عملیات مورد نظر موفقیت آمیز بود.');</script>";
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>مدیریت بسته‌های اشتراک</title>


        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
        <script src="js/manageMenue.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/local.css" />
        <link href="css/allproduct.css" rel="stylesheet">
        <link href="css/addblog.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">



    </head>
    <body dir="rtl">
    <div id="wrapper">
        <?php
        $which=23;
        include 'adminmenue.php';
        ?>
        <div id="page-wrapper">
            <div class="m-auto col-12" id="showerror"></div>


            <table class="table user-list " id="menuTable">
                <thead>
                <tr>
                    <th class="text-center"><span>جمله</span></th>
                    <th class="text-center"><span>زمان (روز)</span></th>

                </tr>
                </thead>
                <tbody>



            <?php
                $query = "SELECT * FROM newUsers where ID=1;";
                $result = $connection->query($query);
                if ($row=$result->fetch_assoc()) {
                    $name = $row['name'];
                    $time = $row['days'];
                    $id = 1;
                    ?>
                        <tr class="<?php echo $id;?>">
                            <form action="welcome.php?request=<?php echo $id;?>" method="post"  class="form-row mt-5" id="<?php echo $id;?>">
                                <td  style="width: 70%;">
                                    <div dir="rtl" >
                                        <input type="text" maxlength="100" class="form-control w-100"
                                                name="name" value="<?php echo $name; ?>"  form="<?php echo $id;?>">
                                    </div>
                                </td>
                                <td  style="width: 20%;">
                                    <div dir="rtl" >
                                        <input type="text" maxlength="100" class="form-control w-100"
                                               name="time" value="<?php echo $time; ?>"  form="<?php echo $id;?>">
                                    </div>
                                </td>

                                <td style="width: 10%;">
                                    <div class="m-auto">
                                        <button type="submit" class="btn btn-default " onclick="return confirming2();" form="<?php echo $id;?>" >ذخیره</button>
                                    </div>
                                </td>
                            </form>
                        </tr>

                    <?php
                }
                    ?>
                </tbody>
            </table>


        </div>
        <!-- /#page-wrapper -->

    </div>
    </body>

    </html>
    <?php
}else{
    header('Location:/');
}

?>



