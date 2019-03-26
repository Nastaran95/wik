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
        $tozih = $_POST['tozihat'];
        $link = $_POST['link'];
        $alt = $_POST['alt'];
        $act = $_POST['status'];


        if (isset($_FILES["img"])) {
            $imagenames = $_FILES["img"]["name"];
            $imagetempname = $_FILES["img"]["tmp_name"];
            $uploadOk = 0;
            $URL = "";
            for ($i = 0; $i < sizeof($imagetempname); $i++) {
                $NAMESSS = "";
                $TMPNAMESSS = "";
                if (sizeof($imagetempname) == 1) {
                    $NAMESSS = $imagenames;
                    $TMPNAMESSS = $imagetempname;
                }
                if (strlen($NAMESSS) > 0) {
                    $target_dir = "images/slider/";
                    $BBB = (string)uniqid();
                    $target_file = $target_dir . $BBB . basename($NAMESSS);

                    $uploadOk = 1;
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($TMPNAMESSS);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        if ($_FILES["img"]["type"] == "TIFF/PNG/JPEG/GIF"){
                            $uploadOk = 1;
                        }else{
                            $uploadOk = 0;
                        }
                    }
                    if ($uploadOk == 0) {
                    } else {
                        $file_size = $_FILES['img']['size'];

                        if (($file_size > 2097152)) {
                            $uploadOk = 0;
                        }
                        if ($uploadOk == 1) {
                            $target_fileAdmin = '../'.$target_file;
                            if (move_uploaded_file($TMPNAMESSS, $target_fileAdmin)) {
                            } else {
                                $uploadOk = 0;
                            }
                        }
                    }
                } else {
//                    echo "9";
                    $uploadOk = 0;
                    $imagetempname = "";
                    $imagenames = "";
                    $target_file = "";
                }

            }
        } else {
//            echo "8";
            $imagetempname = "";
            $imagenames = "";
            $target_file = "";
        }

        $mark = true;
        if($_GET['request']>=0) {
            $id = $_GET['request'];
            if (strlen($target_file)>0){
                $stmt = $connection->prepare("UPDATE slider SET headerName=? ,Mokhtasar=? , link=? , alt=?,active=?,image=?  WHERE (ID=?)");
                $stmt->bind_param("sssssss", $name,$tozih,$link,$alt,$act,$target_file, $id);
            }
            else{
                $stmt = $connection->prepare("UPDATE slider SET headerName=? ,Mokhtasar=? , link=? , alt=?,active=?  WHERE (ID=?)");
                $stmt->bind_param("ssssss", $name,$tozih,$link,$alt,$act, $id);
            }


        }
        else if( $_GET['request']==-1){
            if (strlen($target_file)>0){
                $stmt = $connection->prepare("INSERT INTO slider (headerName,Mokhtasar,link,alt,active,image) VALUES (?,?,?,?,?,?)");
                $stmt->bind_param("ssssss", $name, $tozih,$link,$alt,$act,$target_file);
            }
            else{
                $mark = false;
                echo "<script>alert('عملیات مورد نظر بدون وارد کردن عکس امکان پذیر نیست.');</script>";
            }

        }

        if($mark) {
            $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
            $stmt->close();

            if ($connection->error) {
                $movafagh = 'عملیات مورد نظر موفق نبود. وارد کردن تمامی موارد الزامی است.';

            } else {
                echo "<script>alert('عملیات مورد نظر موفقیت آمیز بود.');</script>";
            }
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>اسلایدر صفحه اصلی</title>


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
        $which=10;
        include 'adminmenue.php';
        ?>
        <div id="page-wrapper">
            <div class="m-auto col-12" id="showerror"></div>


            <table class="table user-list " id="menuTable">
                <thead>
                <tr>
                    <th class="text-center"><span>تصویر</span></th>
                    <th class="text-center"><span>عنوان</span></th>
                    <th class="text-center"><span>توضیحات</span></th>
                    <th class="text-center"><span>لینک</span></th>
                    <th class="text-center"><span>alt</span></th>
                    <th class="text-center"><span>نمایش</span></th>

                </tr>
                </thead>
                <tbody>



            <?php
                $query = "SELECT * FROM slider;";
                $result = $connection->query($query);
            echo "<script>x=0; y =0;</script>";
                while ($row=$result->fetch_assoc()) {
                    $name = $row['headerName'];
                    $Mokhtasar = $row['Mokhtasar'];
                    $id = $row['ID'];
                    $img = $row['image'];
                    $link = $row['link'];
                    $alt = $row['alt'];
                    $isActive = $row['active'];
                    echo "<script>count(".$id.");</script>";
                    ?>
                        <tr class="<?php echo $id;?>">
                            <form action="manageSlider.php?request=<?php echo $id;?>" method="post"  class="form-row mt-5" id="<?php echo $id;?>" enctype="multipart/form-data" >
                                <td  style="width: 30%;">
                                    <div dir="rtl" >
                                        <img src="../<?php echo $img; ?>" class="w-100" id="img<?php echo $id;?>">
                                        <input name="img" onchange="readURL(this);"
                                               accept="image/jpeg,image/gif,image/png"
                                               class="filestyle form-control w-100 mt-2" type="file" data-icon="false"  form="<?php echo $id;?>">
                                    </div>
                                </td>
                                <td  >
                                    <div dir="rtl" >
                                        <input type="text" maxlength="100" class="form-control w-100"
                                               name="name" value="<?php echo $name; ?>"  form="<?php echo $id;?>">
                                    </div>
                                </td>
                                <td  >
                                    <div dir="rtl" >
                                        <textarea rows="3" maxlength="300" name="tozihat" class="form-control w-100" form="<?php echo $id;?>"><?php echo $Mokhtasar; ?> </textarea>
                                    </div>
                                </td>

                                <td  >
                                    <div dir="ltr" >
                                        <input type="text" maxlength="100" class="form-control w-100"
                                               name="link" value="<?php echo $link; ?>"  form="<?php echo $id;?>">
                                    </div>
                                </td>

                                <td  >
                                    <div dir="rtl" >
                                        <input type="text" maxlength="100" class="form-control w-100"
                                               name="alt" value="<?php echo $alt; ?>"  form="<?php echo $id;?>">
                                    </div>
                                </td>
                                <td >
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
                                    <div class="d-flex">
                                        <button type="submit" class="btn p-0 m-0 " onclick="return confirming2();" form="<?php echo $id;?>" >
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x text-success"></i>
                                                <i class="far fa-check-square fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </button>
                                        <a onclick="return confirming();" href="deleteblog.php?type=6&product=<?php echo $id?>">
                                        <span class="fa-stack mt-1">
                                            <i class="fa fa-square fa-stack-2x text-danger"></i>
                                            <i class="far fa-trash-alt fa-stack-1x fa-inverse"></i>
                                        </span>
                                        </a>
                                    </div>
                                </td>
                            </form>
                        </tr>

                    <?php
                }
                    ?>
                </tbody>
            </table>
            <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                    <div class="btn btn-default col-md-12 col-12" onclick="myFunction5()">اضافه کردن</div>
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



