<?php
/**
 * Created by PhpStorm.
 * post_type page va post
 * User: HamidReza
 */
session_start();
include '../Settings.php';
include 'Parsedown.php';
if ($_SESSION['typ']>8) {

    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } elseif (isset($_POST['type'])) {
        $type = $_POST['type'];
    } else {
        $type = 1;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>افزودن تبلیغات</title>


        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
        <link rel="stylesheet" href="css/oldcss.css">
<!--        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="css/local.css" />


        <link rel="stylesheet" href="css/kamadatepicker.css">
        <link href="../css/advertisement.css" rel="stylesheet">
        <script src="../js/advertisement.js"></script>
        <script src="js/kamadatepicker.js"></script>

    </head>
    <body dir="rtl">
    <?php

    if (isset($_GET['product'])) {
        $product = $_GET['product'];
    } else {
        $product = "all";
    }
    if ($product == "namovafagh"){
        $product = "all";
    }

    if (isset($_POST['name']) && isset($_POST['time']) && strlen($_POST['name']) > 0) {
        $name = $_POST['name'];
        $timeAdd = $_POST['time'];

        if ($product === "all") {
            $image = "";
        } else {
            $query = "SELECT * FROM advertisement WHERE ID='$product'";
            $result = $connection->query($query);
            $row = mysqli_fetch_assoc($result);
            $image = $row['image'];
            $st= $row['startTime'];
            $et = $row['endTime'];
            $addT  = $row['addType'];
        }



        if (isset($_POST['msg'])) {
            $msg = $_POST['msg'];
        }
        else
            $msg = "";


        if (isset($_POST['number'])) {
            $number = $_POST['number'];
        }
        else
            $number = "";

        if (isset($_POST['link'])) {
            $link = $_POST['link'];
        }
        else
            $link = "";

        if (isset($_POST['address'])) {
            $address = $_POST['address'];
        }
        else
            $address = "";


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
                    $target_dir = "images/advertisements/";
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
                    $target_file = $image;
                }

            }
        } else {
//            echo "8";
            $imagetempname = "";
            $imagenames = "";
            $target_file = $image;
        }
        if (strlen($target_file)<1)
            $target_file = 'images/no-product-image-available.png';




        $query = "SELECT * FROM addCategory WHERE ID='".$timeAdd."';";
        $result = $connection->query($query);
        if ($row = $result->fetch_assoc()) {
            $price = $row['qeimat'];
            $t = $row['time'];
            $baste = $row['name'];

            date_default_timezone_set("Iran");
            $DATE = date('Y-m-d H:i:s');
            list($date, $time) = explode(" ", $DATE);
            list($year, $month, $day) = explode("-", $date);
            list($jyear, $jmonth, $jday) = gregorian_to_jalali($year, $month, $day);
            if (strlen($jmonth) == 1) {
                $jmonth = "0" . $jmonth;
            }
            if (strlen($jday) == 1) {
                $jday = "0" . $jday;
            }
            $modified_time = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;
            $startTime = $modified_time;

            date_default_timezone_set("Iran");
            $str = "+".$t." days";
            $DATE2 = date('Y-m-d H:i:s' , strtotime($str));
            list($date, $time) = explode(" ", $DATE2);
            list($year, $month, $day) = explode("-", $date);
            list($jyear, $jmonth, $jday) = gregorian_to_jalali($year, $month, $day);
            if (strlen($jmonth) == 1) {
                $jmonth = "0" . $jmonth;
            }
            if (strlen($jday) == 1) {
                $jday = "0" . $jday;
            }
            $modified_time = $jyear . '/' . $jmonth . '/' . $jday . ' ' . $time;
            $endTime = $modified_time;

            if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in']==true) {
                $write = $_SESSION["mobile"];
            }else
                $write = 'کاربر عادی';

            if ($timeAdd==$addT){
                $startTime=$st;
                $endTime=$et;
            }


            if ($product === "all") {
                $stmt = $connection->prepare("INSERT INTO advertisement(name, matn, number,link,address, image, startTime, endTime, active, addType, writerID,stat,pardakht)  VALUES (?,?,?,?,?,?,?,?,1,?,?,1,1)");
                $stmt->bind_param("ssssssssss", $name, $msg,$number,$link,$address, $target_file, $startTime, $endTime, $timeAdd, $write);
            } else {
                $stmt = $connection->prepare("UPDATE advertisement set name=?, matn=?, number=?,link=?,address=?, image=? , startTime=?,endTime=?,addType=? WHERE (ID=?)");
                $stmt->bind_param("ssssssssss", $name, $msg,$number,$link,$address, $target_file,$startTime,$endTime,$timeAdd, $product);
            }
            $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
            $stmt->store_result();
            $result = $stmt->get_result();
            if ($product === "all") {
                $product =$connection->insert_id;
            }
            $movafagh = 'عملیات مورد نظر با موفقیت انجام شد.';

            if ($connection->error) {
                $movafagh = 'عملیات مورد نظر موفق نبود. به وارد کردن موارد الزامی دقت کنید.';
                $product="namovafagh";
                if (isset($_POST['name'])){
                    $titleshould=$_POST['name'];
                }
            }else{
                echo "<script>alert('عملیات مورد نظر موفقیت آمیز بود.');</script>";
//                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin.php">';
            }

//                    active = 0 yani pardakht nashode , active = 1 yani pardakht shode


        }
         else{
            echo "<script>alert('عملیات موفقیت آمیز نبود. لطفا دوباره امتحان کنید.');</script>";
//             echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin.php">';
        }



    } else {

        $movafagh = '';
    }
    ?>
    <div id="wrapper">
        <?php
        $which=18;
        include 'adminmenue.php';
        $query = "SELECT * FROM advertisement WHERE ID='$product'";
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
        }

        if ($product === "all") {
            $URL = "addAdvertisement.php";
        } else {
            $URL = "addAdvertisement.php?product=$product";
        }
        $URL2 = "addAdvertisement.php?type=$type";

        $englishtopic="";
        if ($product=="namovafagh"){

//            echo "<script>window.alert('set1');</script>";
        } else if ($product !== "all") {
            $query = "SELECT * FROM advertisement WHERE ID='$product'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
            }

            $name = $row['name'];
            $matn = $row['matn'];
            $number = $row['number'];
            $link = $row['link'];
            $address = $row['address'];
            $addType = $row['addType'];
            $image = '../'.$row['image'];




        } else {
            $name = "";
            $matn = "";
            $number = "";
            $link = "";
            $address = "";
            $addType = "1";
            $image = "";
        }

        ?>
        <div class="m-auto col-12" id="showerror"></div>
        <div class="col-md-12 float-left text-justify contctus text-center">
        <div class="show_res d-none  m-auto col-12">به موارد الزامی دقت کنید.</div>
        <div class="errmsg d-none m-auto col-12">لطفا فقط عدد انگلیسی وارد کنید.</div>
        <form action="<?php echo $URL ?>" method="post" class="" enctype="multipart/form-data">
            <div class="form-group col-md-10 m-auto pt-4 float-right">
                <label for="name" class="dark_text float-right"><b>عنوان آگهی</b></label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>">
            </div>
            <div class="form-group col-md-10 m-auto pt-4 float-right">
                <label for="msg" class="dark_text float-right"><b>متن آگهی</b></label>
                <textarea rows="10" maxlength="1000" name="msg" id="msg"><?php echo $matn;?></textarea>
            </div>

            <div class="form-group col-md-10 m-auto pt-4 float-right">
                <label for="number" class="dark_text float-right"><b>شماره تماس</b></label>
                <input type="text" maxlength="11" class="form-control" id="number" name="number" value="<?php echo $number;?>">
            </div>

            <div class="form-group col-md-10 m-auto pt-4 float-right">
                <label for="link" class="dark_text float-right"><b>لینک</b></label>
                <input type="text" class="form-control" id="link" name="link" value="<?php echo $link;?>">
            </div>

            <div class="form-group col-md-10 m-auto pt-4 float-right">
                <label for="address" class="dark_text float-right"><b>آدرس</b></label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address;?>">
            </div>

            <div class="col-md-4 m-auto p-3 float-right">
                <img src="<?php echo $image;?>" alt="Avatar" class="<?php if (strlen($image)<1) echo "d-none";?>" style="width:100%" id="showImage">
            </div>

            <div class="form-group col-md-10 m-auto pt-4 float-right">
                <div  class="imgBtn text-dark btn btn-default col-md-4" id="imgBtn">درج تصویر آگهی</div>
                <input type="file" name="img" id="img" accept="image/jpeg,image/gif,image/png" class="d-none" onchange="readURL(this);"  value="<?php echo $image;?>"/>
            </div>

            <div class="form-group col-md-10 m-auto pt-4 float-right">
                <label for="time" class="dark_text float-right"><b>دوره نمایش آگهی</b></label>
                <input type="text" class="d-none" id="time" name="time" value="<?php echo $addType;?>">
                <table class="w-100 text-dark typeTable" id="timeTable">
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
                        <tr class="<?php if($id==$addType) echo "bg-info text-light";?>"  id="tr<?php echo  $id;?>">
                            <th class="text-center">نمایش <?php echo $name; ?></th>
                            <th class="text-center"><?php echo $price; ?></th>
                            <th class="chooseType w-100 btn-outline-info text-center" id="<?php echo  $id;?>" > انتخاب </th>
                        </tr>
                        <?php
                    }
                    ?>

                </table>


            </div>



            <div class="offset-4 col-md-4 col-12 m-auto float-right p-4">
                <button type="submit" class="btn btn-default col-md-12 col-12">ثبت آگهی</button>
            </div>
        </form>
        </div>

    </div>

    </body>
<!--    <script>-->
<!--        var customOptions = {-->
<!--            placeholder: "روز / ماه / سال"-->
<!--            , twodigit: false-->
<!--            , closeAfterSelect: true-->
<!--            , nextButtonIcon: "fa fa-arrow-circle-right"-->
<!--            , previousButtonIcon: "fa fa-arrow-circle-left"-->
<!--            , buttonsColor: "black"-->
<!--            , forceFarsiDigits: true-->
<!--            , markToday: true-->
<!--            , markHolidays: true-->
<!--            , highlightSelectedDay: true-->
<!--            , sync: true-->
<!--            , gotoToday: true-->
<!--        };-->
<!--        kamaDatepicker('tarikhAzmun', customOptions);-->
<!--        kamaDatepicker('tarikhKart', customOptions);-->
<!--        kamaDatepicker('tarikhNatayej', customOptions);-->
<!--    </script>-->
    </html>
    <?php

}else{
    header('Location:/');
}

function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
    list($gy,$gm,$gd)=explode('_',tr_num($gy.'_'.$gm.'_'.$gd));/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
    $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
    if($gy > 1600){
        $jy=979;
        $gy-=1600;
    }else{
        $jy=0;
        $gy-=621;
    }
    $gy2=($gm > 2)?($gy+1):$gy;
    $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
    $jy+=33*((int)($days/12053));
    $days%=12053;
    $jy+=4*((int)($days/1461));
    $days%=1461;
    $jy+=(int)(($days-1)/365);
    if($days > 365)$days=($days-1)%365;
    if($days < 186){
        $jm=1+(int)($days/31);
        $jd=1+($days%31);
    }else{
        $jm=7+(int)(($days-186)/30);
        $jd=1+(($days-186)%30);
    }
    return($mod==='')?array($jy,$jm,$jd):$jy .$mod .$jm .$mod .$jd;
}

function tr_num($str,$mod='en',$mf='٫'){
    $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
    $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
    return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
}