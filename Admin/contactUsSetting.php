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
    $xmlAdress = '../XMLs/contactUs.xml';
    if (isset($_GET['request'])){


        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->setIndent(true);
        $writer->startDocument('1.0" encoding="UTF-8');
        $writer->startElement('main');
        $writer->writeElement('data1', $_POST['editor1']);
        $writer->writeElement('description', 'تماس با ما');
        $writer->writeElement('kewords', 'تماس با ما');
        $writer->writeElement('seotitle','تماس با ما');
        $writer->writeElement('logo','/images/wikiderm-logo-180-544-invers--300x100.png');
        $writer->endElement();
        $writer->endDocument();
        $file = $writer->outputMemory();
        file_put_contents($xmlAdress, $file);

        $datashould = $_POST['editor1'];

        echo "<script>alert('عملیات مورد نظر موفقیت آمیز بود.');</script>";
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=/contactUs.php">';

    }
    else{
        if (file_exists($xmlAdress)) {
            $XMLFile = simplexml_load_file($xmlAdress);
            $datashould = $XMLFile->data1;
        } else {
            $datashould = "";
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>تنظیمات تماس با ما</title>


        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
        <script src="js/manageMenue.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/local.css" />
        <link href="css/allproduct.css" rel="stylesheet">
        <link href="css/addblog.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


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

    </head>
    <body dir="rtl">
    <div id="wrapper">
        <?php
        $which=15;
        include 'adminmenue.php';
        ?>
        <div id="page-wrapper">


            <div class="m-auto col-12" id="showerror"></div>
            <form action="contactUsSetting.php?request=save" method="post"  class="form-row" onsubmit="return validateFormdata(2)">
                <div class="form-group col-md-10 m-auto text-right pt-5" >
                    <label for="editor1" class="dark_text"><b>متن تماس ما</b></label>
                    <div id="editor">
                        <div id='edit' style="margin-top: 30px;"><?php echo $datashould; ?></div>
                    </div>
                    <input name="editor1" id="editor122" class="form-control input-lg ckeditor d-none"
                           type="text"/>
                </div>

                <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                    <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                        <input type="submit" value="ثبت" class="btn btn-success"/>
                    </div>
                </div>


            </form>




        </div>
        <!-- /#page-wrapper -->

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

    </html>
    <?php
}else{
    header('Location:/');
}

?>



