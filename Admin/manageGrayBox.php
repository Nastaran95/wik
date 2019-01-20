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
        $act = $_POST['status'];


        if($_GET['request']>=0) {
            $id = $_GET['request'];
            $stmt = $connection->prepare("UPDATE grayBox SET name=? ,Mokhtasar=? , link=? ,active=?  WHERE (ID=?)");
            $stmt->bind_param("sssss", $name,$tozih,$link,$act, $id);


        }
        else if( $_GET['request']==-1){
            $stmt = $connection->prepare("INSERT INTO grayBox (name,Mokhtasar,link,active) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $name, $tozih,$link,$act);
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
        $which=11;
        include 'adminmenue.php';
        ?>
        <div id="page-wrapper">
            <div class="m-auto col-12" id="showerror"></div>


            <table class="table user-list " id="menuTable">
                <thead>
                <tr>

                    <th class="text-center"><span>عنوان</span></th>
                    <th class="text-center"><span>توضیحات</span></th>
                    <th class="text-center"><span>لینک</span></th>
                    <th class="text-center"><span>نمایش</span></th>

                </tr>
                </thead>
                <tbody>



            <?php
                $query = "SELECT * FROM grayBox;";
                $result = $connection->query($query);
            echo "<script>x=0; y =0;</script>";
                while ($row=$result->fetch_assoc()) {
                    $name = $row['name'];
                    $Mokhtasar = $row['Mokhtasar'];
                    $id = $row['ID'];
                    $link = $row['link'];
                    $isActive = $row['active'];
                    echo "<script>count(".$id.");</script>";
                    ?>
                        <tr class="<?php echo $id;?>">
                            <form action="manageGrayBox.php?request=<?php echo $id;?>" method="post"  class="form-row mt-5" id="<?php echo $id;?>" enctype="multipart/form-data" >

                                <td  >
                                    <div dir="rtl" >
                                        <input type="text" maxlength="100" class="form-control w-100"
                                               name="name" value="<?php echo $name; ?>"  form="<?php echo $id;?>">
                                    </div>
                                </td>
                                <td  >
                                    <div dir="rtl" >
                                        <textarea rows="8" maxlength="300" name="tozihat" class="form-control w-100" form="<?php echo $id;?>"><?php echo $Mokhtasar; ?> </textarea>
                                    </div>
                                </td>

                                <td  >
                                    <div dir="rtl" >
                                        <input type="text" maxlength="100" class="form-control w-100"
                                               name="link" value="<?php echo $link; ?>"  form="<?php echo $id;?>">
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
                                        <a onclick="return confirming();" href="deleteblog.php?type=7&product=<?php echo $id?>">
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
                    <div class="btn btn-default col-md-12 col-12" onclick="myFunction6()">اضافه کردن</div>
                </div>
            </div>

<!--            <div class="col-md-12 col-12">-->
<!--                <form action="manageGrayBox.php?colorset=1" method="post"  class="form-inline" >-->
<!--                    <div dir="rtl" class=" floatright m-auto">-->
<!--                        <label for="back" class="dark_text"><b>رنگ پس زمینه</b></label>-->
<!--                        <input type="number" min="0" max="255" class="form-control text-danger back"-->
<!--                               name="backR" id="backR" value="233" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-success back"-->
<!--                               name="backG"  id="backG" value="231" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-primary back"-->
<!--                               name="backB" id="backB" value="232"  >-->
<!--                    </div>-->
<!--                    <br/>-->
<!--                    <div dir="rtl" class=" floatright m-auto">-->
<!--                        <label for="text" class="dark_text"><b>رنگ متن</b></label>-->
<!--                        <input type="number" min="0" max="255" class="form-control text-danger text"-->
<!--                               name="textR" id="textR" value="20" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-success text"-->
<!--                               name="textG" id="textG" value="10" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-primary text"-->
<!--                               name="textB" id="textB" value="255"  >-->
<!--                    </div>-->
<!--                    <br/>-->
<!--                    <div dir="rtl" class=" floatright m-auto">-->
<!--                        <label for="border" class="dark_text"><b>رنگ دور</b></label>-->
<!--                        <input type="number" min="0" max="255" class="form-control text-danger border"-->
<!--                               name="borderR" id="borderR" value="0" >-->
<!--                        <input type="number"  min="0" max="255" class="form-control text-success border"-->
<!--                               name="borderG" id="borderG" value="0" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-primary border"-->
<!--                               name="borderB" id="borderB" value="0"  >-->
<!--                    </div>-->
<!--                    <br/>-->
<!--                    <div dir="rtl" class=" floatright m-auto">-->
<!--                        <label for="hover" class="dark_text"><b>رنگ پس زمینه هنگام قرار گرفتن ماوس</b></label>-->
<!--                        <input type="number" min="0" max="255" class="form-control text-danger hover"-->
<!--                               name="hoverR" id="hoverR" value="0" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-success hover"-->
<!--                               name="hoverG" id="hoverG" value="0" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-primary hover"-->
<!--                               name="hoverB" id="hoverB" value="0"  >-->
<!--                    </div>-->
<!--                    <div dir="rtl" class=" floatright m-auto">-->
<!--                        <label for="texthover" class="dark_text"><b>رنگ متن هنگام قرار گرفتن ماوس</b></label>-->
<!--                        <input type="number" min="0" max="255" class="form-control text-danger texthover"-->
<!--                               name="texthoverR" id="texthoverR" value="0" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-success texthover"-->
<!--                               name="texthoverG" id="texthoverG" value="0" >-->
<!--                        <input type="number" min="0" max="255" class="form-control text-primary texthover"-->
<!--                               name="texthoverB" id="texthoverB" value="0"  >-->
<!--                    </div>-->
<!--                    <br/>-->
<!--                    <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">-->
<!--                        <input type="submit" value="ثبت" class="btn btn-success"/>-->
<!--                    </div>-->
<!---->
<!--                </form>-->
<!---->
<!--            </div>-->
<!---->
<!--            <div class="col-md-12 m-5">-->
<!--                <div class="col-md-5 col-12 float-none">-->
<!--                    <a href="--><?php //echo $link?><!--">-->
<!--                        <div class="col-md-11 grayBox col-10">تست</div>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->




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



