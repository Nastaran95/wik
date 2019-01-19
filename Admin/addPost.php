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
        <title>افزودن مقاله</title>


        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
        <link rel="stylesheet" href="css/oldcss.css">
<!--        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/local.css" />

<!--        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>-->
<!--        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>-->

        <link rel="stylesheet" href="../froala/css/froala_editor.css">
        <link rel="stylesheet" href="../froala/css/froala_style.css">
        <link rel="stylesheet" href="../froala/css/plugins/code_view.css">
        <link rel="stylesheet" href="../froala/css/plugins/colors.css">
        <link rel="stylesheet" href="../froala/css/plugins/emoticons.css">
        <link rel="stylesheet" href="../froala/css/plugins/image.css">
        <link rel="stylesheet" href="../froala/css/plugins/line_breaker.css">
        <link rel="stylesheet" href="../froala/css/plugins/table.css">
        <link rel="stylesheet" href="../froala/css/plugins/char_counter.css">
        <link rel="stylesheet" href="../froala/css/plugins/video.css">
        <link rel="stylesheet" href="../froala/css/plugins/fullscreen.css">
        <link rel="stylesheet" href="../froala/css/plugins/file.css">
        <link rel="stylesheet" href="../froala/css/plugins/quick_insert.css">
        <link rel="stylesheet" href="../css/codemirror.min.css">
        <link rel="stylesheet" href="css/kamadatepicker.css">
        <link href="css/addblog.css" rel="stylesheet">
        <script src="js/addblog.js"></script>
        <script src="js/kamadatepicker.js"></script>
        <style>
            table{
                color: #000000;}
        </style>
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

    if ((isset($_POST['editor1'])) && (isset($_POST['sum'])) && (isset($_POST['subject'])) && (isset($_POST['category1'])) && (strlen($_POST['editor1']) > 0) && (strlen($_POST['sum']) > 0) && (strlen($_POST['subject']) > 0) && (strlen($_POST['category1']) > 0)) {
        $writer = new XMLWriter();
        if ($product === "all") {
//            $name = (string)uniqid().uniqid();
            $BBB = (string)uniqid();
            $englishtopic = 'paper'.$BBB;
            $englishtopic=str_replace(" ","-",$englishtopic);
            $filename = 'XMLs/PaperXMLs/' . $englishtopic . '.xml';
            $filenameAdmin = '../'.$filename;
            $image = "";
        } else {
            $query = "SELECT * FROM Paper WHERE ID='$product'";
            $result = $connection->query($query);
            $row = mysqli_fetch_assoc($result);
            $filename = $row['XMLNAME'];
            $filenameAdmin = '../'.$row['XMLNAME'];
            $englishtopic =  $row['post_name'];
            $image = $row['image'];
//            $productXMLNAME = $row['XMLNAME'];
//            if (file_exists($productXMLNAME)) {
//                $produc = simplexml_load_file($productXMLNAME);
//                $name = $produc->code;
//            }
        }
        $writer->openMemory();
        $writer->setIndent(true);
        $writer->startDocument('1.0" encoding="UTF-8');
        $writer->startElement('Paper');
        $writer->writeElement('subject', $_POST['subject']);
        $writer->writeElement('data', $_POST['editor1']);
        $writer->writeElement('summary', $_POST['sum']);
        $writer->endElement();
        $writer->endDocument();
        $file = $writer->outputMemory();
        file_put_contents($filenameAdmin, $file);

        $titleshould=$_POST['subject'];

        $uploadOk = 0;
        $URL = "";
        $datashould=$_POST['editor1'];
        $datashould2=$_POST['sum'];
        $titleshould=$_POST['subject'];
        $category = $_POST['category1'];



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
        $modified_time = $jyear . '/' . $jmonth . '/' . $jday.' '.$time;

        if (isset($_FILES["imgPost"])) {
            $imagenames = $_FILES["imgPost"]["name"];
            $imagetempname = $_FILES["imgPost"]["tmp_name"];
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
                    $target_dir = "images/Papers/";
                    $BBB = (string)uniqid();
                    $target_file = $target_dir . $BBB . basename($NAMESSS);

                    $uploadOk = 1;
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($TMPNAMESSS);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        if ($_FILES["imgPost"]["type"] == "TIFF/PNG/JPEG/GIF"){
                            $uploadOk = 1;
                        }else{
                            $uploadOk = 0;
                        }
                    }
                    if ($uploadOk == 0) {
                    } else {
                        $file_size = $_FILES['imgPost']['size'];

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


        if ($product === "all") {
//            echo "<script>window.alert('insert db');</script>";
            $stmt = $connection->prepare("INSERT INTO Paper (XMLNAME,name,post_name,writerID, realtime , dastebandi,Mokhtasar,image)  VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssss", $filename, $titleshould, $englishtopic, $_SESSION["mobile"], $modified_time, $category, $datashould2, $target_file);
        } else {
            $stmt = $connection->prepare("UPDATE Paper SET name=? ,  stat=0 ,dastebandi=? , Mokhtasar=? , image=?  WHERE (ID=?)");
            $stmt->bind_param("sssss", $titleshould,$category,$datashould2,$target_file, $product );
        }
        $result = $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
        $stmt->store_result();
        $result = $stmt->get_result();
        if ($product === "all") {
            $product =$connection->insert_id;
        }
        $movafagh = 'عملیات مورد نظر با موفقیت انجام شد.';

        if ($connection->error) {
            $movafagh = 'عملیات مورد نظر موفق نبود. وارد کردن تمامی موارد الزامی است.';
            $product="namovafagh";
            if (isset($_POST['subject'])){
                $titleshould=$_POST['subject'];
            }
            if (isset($_POST['editor'])){
                $datashould=$_POST['editor'];
            }
            if (isset($_POST['sum'])){
                $datashould2=$_POST['sum'];
            }
            if (isset($_POST['category1'])){
                $category=$_POST['category1'];
            }
        }else{
            echo "<script>alert('عملیات مورد نظر موفقیت آمیز بود.');</script>";
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/Paper/'.$englishtopic.'">';
        }
    } else {

        $movafagh = '';
//        $titleshould = $_POST['subject'];
//        $datashould = $_POST['editor'];
//        $datashould2 = $_POST['sum'];
//        $category = $_POST['category1'];
//        echo "<script>alert('لطفااطلاعات خواسته شده را کامل کنید.');</script>";
    }
    ?>
    <div id="wrapper">
        <?php
        $which=2;
        include 'adminmenue.php';
        $query = "SELECT * FROM Paper WHERE ID='$product'";
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
        }

        if ($product === "all") {
            $URL = "addPost.php";
        } else {
            $URL = "addPost.php?product=$product";
        }
        $URL2 = "allPosts.php?type=$type";
        $englishtopic="";
        if ($product=="namovafagh"){

//            echo "<script>window.alert('set1');</script>";
        } else if ($product !== "all") {
            $query = "SELECT * FROM Paper WHERE ID='$product'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
            }

            $titleshould = $row['name'];
            $datashould2 = $row['Mokhtasar'];
            $category = $row['dastebandi'];
            $xmlAdress = '../'.$row['XMLNAME'];
            if (file_exists($xmlAdress)) {
                $XMLFile = simplexml_load_file($xmlAdress);
                $datashould = $XMLFile->data;
            } else {
                $datashould = "";
            }
        } else {
            $titleshould = "";
            $datashould = "";
            $datashould2 = "";
            $category = "";
        }

        ?>
        <div class="m-auto col-12" id="showerror"></div>
        <form action="<?php echo $URL ?>" method="post" enctype="multipart/form-data" onsubmit="return validateFormdata(1)" class="form-row">
            <div class="form-group col-md-10 floatright m-auto text-right">
                <label for="subject" class="dark_text"><b>عنوان مطلب</b></label>
                <input type="text" class="form-control" id="subject" value="<?php echo $titleshould;?>" name="subject">
            </div>

            <div class="form-group col-md-10 m-auto text-right" >
                <label for="imgPost" class="dark_text"><b>درج تصویر</b></label>
                <input name="imgPost"
                       accept="image/jpeg,image/gif,image/png"
                       id="imgPost" class="filestyle form-control" type="file" data-icon="false" value="">
            </div>

            <div class="form-group col-md-10 m-auto text-right">
                <label for="category1" class="dark_text"><b>انتخاب دسته</b></label>
                <select name="category1" class="form-control required" id="category1">
                    <?php
                    $query = "SELECT * FROM category;";
                    $result = $connection->query($query);
                    while ($row = $result->fetch_assoc()) {
                        $name = $row['name'];
                        $id = $row['ID'];
                        ?>
                        <option value="<?php echo $id; ?>" <?php if ($category == $id) echo "selected=\"selected\""; ?> ><?php echo $name; ?></option>

                        <?php
                    }
                    ?>
                </select>
            </div>



            <div class="form-group col-md-10 m-auto text-right pt-5" >
                <label for="sum" class="dark_text"><b>خلاصه مطلب(به اندازه ۲۰۰ کاراکتر)</b></label>
                <textarea rows="10"  maxlength="200" name="sum" id="sum" class="form-control"><?php echo $datashould2; ?> </textarea>

            </div>


            <div class="form-group col-md-10 m-auto text-right pt-5" >
                <label for="editor1" class="dark_text"><b>متن مقاله</b></label>
                <div id="editor">
                    <div id='edit' style="margin-top: 30px;"><?php echo $datashould; ?></div>
                </div>
                <input name="editor1" id="editor122" class="form-control input-lg ckeditor d-none"
                       type="text"/>
            </div>


            <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
<!--                    <button type="submit" class="btn btn-default col-md-12 col-12 btn-success" id="sendpost">ارسال</button>-->
                    <input type="submit" value="ثبت" class="btn btn-success"/>
                    <input type="button" name="cancel" value="لغو" class="btn btn-danger"
                           onClick="window.location='<?php echo $URL2; ?>';"/>
                </div>
            </div>


        </form>
    </div>

    <script type="text/javascript" src="../js/codemirror5.3.0.js"></script>
    <script type="text/javascript" src="../js/codemirror_5.3.0_mode_xml_xml.js"></script>
    <script type="text/javascript" src="../froala/js/froala_editor.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/align.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/colors.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/draggable.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/emoticons.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/entities.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/file.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/image.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/inline_style.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/link.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/lists.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/quick_insert.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/quote.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/table.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/save.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/url.min.js"></script>
    <script type="text/javascript" src="../froala/js/plugins/video.min.js"></script>

    <script>
        $(function () {
            $('#edit').froalaEditor({
                // Define new image styles.
                // Set the image upload parameter.
                imageUploadParam: 'image',

                // Set the image upload URL.
                imageUploadURL: '/images/froala/takefile.php',

                // Additional upload params.
//                imageUploadParams: {id: 'my_editor'},

                // Set request type.
                imageUploadMethod: 'POST',

                // Set max image size to 5MB.
                imageMaxSize: 5 * 1024 * 1024,

                // Allow to upload PNG and JPG.
                imageAllowedTypes: ['jpeg', 'jpg', 'png'],

                imageStyles: {
                    class1: 'Class 1',
                    class2: 'Class 2'
                },
                // Set the video upload parameter.
                videoUploadParam: 'image',

                // Set the video upload URL.
                videoUploadURL: '/images/froala/takeVideoFile.php',

                // Additional upload params.
                videoUploadParams: {id: 'my_editor'},

                // Set request type.
                videoUploadMethod: 'POST',

                // Set max video size to 50MB.
                videoMaxSize: 50 * 1024 * 1024,

                // Set the file upload parameter.
                fileUploadParam: 'image',

                // Set the file upload URL.
                fileUploadURL: '/images/froala/takeVideoFile.php',

                // Additional upload params.
                fileUploadParams: {id: 'my_editor'},

                // Set request type.
                fileUploadMethod: 'POST',

                // Set max file size to 20MB.
                fileMaxSize: 20 * 1024 * 1024,

                // Allow to upload any file.
                fileAllowedTypes: ['*']
            })
                .on('froalaEditor.image.beforeUpload', function (e, editor, images) {
//            alert("berfor upload");
                })
                .on('froalaEditor.image.uploaded', function (e, editor, response) {
                    // Image was uploaded to the server.
//            alert(response);
                })
                .on('froalaEditor.image.inserted', function (e, editor, $img, response) {
                    // Image was inserted in the editor.
//            alert("inserted");
                })
                .on('froalaEditor.image.replaced', function (e, editor, $img, response) {
                    // Image was replaced in the editor.
//            alert("replaced");
                })
                .on('froalaEditor.image.error', function (e, editor, error, response) {
                    // Bad link.
                    alert(error.code);
//            if (error.code == 1) { }
//
//            // No link in upload response.
//            else if (error.code == 2) { }
//
//            // Error during image upload.
//            else if (error.code == 3) {  }
//
//            // Parsing response failed.
//            else if (error.code == 4) {  }
//
//            // Image too text-large.
//            else if (error.code == 5) {  }
//
//            // Invalid image type.
//            else if (error.code == 6) {  }
//
//            // Image can be uploaded only to same domain in IE 8 and IE 9.
//            else if (error.code == 7) {  }

// Response contains the original server response to the request if available.
                }).on('froalaEditor.video.beforeUpload', function (e, editor, videos) {
                // Return false if you want to stop the video upload.
//            alert("berfor upload");
            })
                .on('froalaEditor.video.uploaded', function (e, editor, response) {
                    // Video was uploaded to the server.
//            alert(response);
                })
                .on('froalaEditor.video.inserted', function (e, editor, $img, response) {
                    // Video was inserted in the editor.
//            alert("inserted");
                })
                .on('froalaEditor.video.replaced', function (e, editor, $img, response) {
                    // Video was replaced in the editor.
//            alert("replaced");
                })
                .on('froalaEditor.video.error', function (e, editor, error, response) {
                    // Bad link.
//            alert(error.code);
//            if (error.code == 1) { }
//
//            // No link in upload response.
//            else if (error.code == 2) { }
//
//            // Error during video upload.
//            else if (error.code == 3) { }
//
//            // Parsing response failed.
//            else if (error.code == 4) { }
//
//            // Video too text-large.
//            else if (error.code == 5) { }
//
//            // Invalid video type.
//            else if (error.code == 6) { }
//
//            // Video can be uploaded only to same domain in IE 8 and IE 9.
//            else if (error.code == 7) { }

                    // Response contains the original server response to the request if available.
                });


        });
    </script>

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