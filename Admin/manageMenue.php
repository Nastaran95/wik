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

    if (isset($_GET['request'])){
        $name = $_POST['name'];
        $link = $_POST['link'];
        $act = $_POST['status'];
        if($_GET['request']>=0) {
            $id = $_GET['request'];
            $stmt = $connection->prepare("UPDATE menue SET name=? ,  link=? ,active=? WHERE (ID=?)");
            $stmt->bind_param("ssss", $name, $link, $act, $id);

        }
        else if( $_GET['request']==-1){
            $stmt = $connection->prepare("INSERT INTO menue (name,link,active) VALUES (?,?,?)");
            $stmt->bind_param("sss", $name,  $link, $act);

        }
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
        <title>مدیریت منو</title>


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
        $which=6;
        include 'adminmenue.php';
        ?>
        <div id="page-wrapper">
            <div class="m-auto col-12" id="showerror"></div>


            <table class="table user-list " id="menuTable">
                <thead>
                <tr>
                    <th class="text-center"><span>لینک</span></th>
                    <th class="text-center"><span>عنوان</span></th>
                    <th class="text-center"><span>وضعیت</span></th>
                </tr>
                </thead>
                <tbody>



            <?php
                $query = "SELECT * FROM menue;";
                $result = $connection->query($query);
            echo "<script>x=0;</script>";
                while ($row=$result->fetch_assoc()) {
                    $name = $row['name'];
                    $id = $row['ID'];
                    $link = $row['link'];
                    $isActive = $row['active'];
                    echo "<script>count(".$id.");</script>";
                    ?>

                        <form action="manageMenue.php?request=<?php echo $id;?>" method="post"  class="form-row mt-5" id="<?php echo $id;?>">
                            <tr class="<?php echo $id;?>">
                            <td style="width: 40%;">
                                <div dir="ltr" >
                                    <input type="text" maxlength="100" class="form-control w-100"
                                           name="link" value="<?php echo $link; ?>" form="<?php echo $id;?>">
                                </div>
                            </td>
                            <td  style="width: 40%;">
                                <div dir="rtl" >
                                    <input type="text" maxlength="100" class="form-control w-100"
                                            name="name" value="<?php echo $name; ?>"  form="<?php echo $id;?>">
                                </div>
                            </td>
                            <td style="width: 15%;">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" value="0" <?php if($isActive==0) echo "checked";?> form="<?php echo $id;?>">غیر فعال
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" value="1" <?php if($isActive>0) echo "checked";?> form="<?php echo $id;?>">فعال
                                    </label>
                                </div>
                            </td>
                            <td style="width: 5%;">
                                <a onclick="return confirming();" href="deleteblog.php?type=3&product=<?php echo $id?>">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x text-danger"></i>
                                        <i class="far fa-trash-alt fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                                <div class="m-auto">
                                    <button type="submit" class="btn btn-default " onclick="return confirming2();" form="<?php echo $id;?>" >ذخیره</button>
                                </div>
                            </td>
                            </tr>
                        </form>

                    <?php
                }
                    ?>
                </tbody>
            </table>
            <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                    <div class="btn btn-default col-md-12 col-12" onclick="myFunction()">اضافه کردن</div>
                </div>
            </div>




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



