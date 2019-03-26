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
        $orderby = $_POST['orderby'];


        if($_GET['request']>=0) {
            $id = $_GET['request'];
            $stmt = $connection->prepare("UPDATE grayBox SET name=? ,Mokhtasar=? , link=? ,active=? ,orderby=? WHERE (ID=?)");
            $stmt->bind_param("ssssss", $name,$tozih,$link,$act,$orderby, $id);


        }
        else if( $_GET['request']==-1){
            $stmt = $connection->prepare("INSERT INTO grayBox (name,Mokhtasar,link,active,orderby) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss", $name, $tozih,$link,$act,$orderby);
        }

        $stmt->execute(); //execute() tries to fetch a result set. Returns true on succes, false on failure.
        $stmt->close();

        if ($connection->error) {
            $movafagh = 'عملیات مورد نظر موفق نبود. وارد کردن تمامی موارد الزامی است.';

        } else {
            echo "<script>alert('عملیات مورد نظر موفقیت آمیز بود.');</script>";
        }
    }

    elseif (isset($_GET['colorset'])){
        if(isset($_POST['backR']) && isset($_POST['backG']) && isset($_POST['backB'])){
            $r1 = $_POST['backR'];
            $g1 = $_POST['backG'];
            $b1 = $_POST['backB'];
            $stmt = $connection->prepare("UPDATE colors SET red=? ,green=? , blue=? WHERE (name='GrayBoxBack')");
            $stmt->bind_param("sss", $r1,$g1,$b1);
            $stmt->execute();
            $stmt->close();
        }
        if(isset($_POST['textR']) && isset($_POST['textG']) && isset($_POST['textB'])){
            $r2 = $_POST['textR'];
            $g2 = $_POST['textG'];
            $b2 = $_POST['textB'];
            $stmt = $connection->prepare("UPDATE colors SET red=? ,green=? , blue=? WHERE (name='GrayBoxText')");
            $stmt->bind_param("sss", $r2,$g2,$b2);
            $stmt->execute();
            $stmt->close();
        }
        if(isset($_POST['borderrR']) && isset($_POST['borderrG']) && isset($_POST['borderrB'])){
            $r3 = $_POST['borderrR'];
            $g3 = $_POST['borderrG'];
            $b3 = $_POST['borderrB'];
            $stmt = $connection->prepare("UPDATE colors SET red=? ,green=? , blue=? WHERE (name='GrayBoxBorder')");
            $stmt->bind_param("sss", $r3,$g3,$b3);
            $stmt->execute();
            $stmt->close();
        }
        if(isset($_POST['hoverR']) && isset($_POST['hoverG']) && isset($_POST['hoverB'])){
            $r4 = $_POST['hoverR'];
            $g4 = $_POST['hoverG'];
            $b4 = $_POST['hoverB'];
            $stmt = $connection->prepare("UPDATE colors SET red=? ,green=? , blue=? WHERE (name='GrayBoxBackHover')");
            $stmt->bind_param("sss", $r4,$g4,$b4);
            $stmt->execute();
            $stmt->close();
        }
        if(isset($_POST['texthoverR']) && isset($_POST['texthoverG']) && isset($_POST['texthoverB'])){
            $r5 = $_POST['texthoverR'];
            $g5 = $_POST['texthoverG'];
            $b5 = $_POST['texthoverB'];
            $stmt = $connection->prepare("UPDATE colors SET red=? ,green=? , blue=? WHERE (name='GrayBoxTextHover')");
            $stmt->bind_param("sss", $r5,$g5,$b5);
            $stmt->execute();
            $stmt->close();
        }
    }

    $query = "SELECT * FROM colors where name='GrayBoxBack';";
    $result = $connection->query($query);
    $row=$result->fetch_assoc();
    $r1 = $row['red'];
    $g1 = $row['green'];
    $b1 = $row['blue'];
    $str1 = 'rgb('.$r1.','.$g1.','.$b1.')';

    $query = "SELECT * FROM colors where name='GrayBoxText';";
    $result = $connection->query($query);
    $row=$result->fetch_assoc();
    $r2 = $row['red'];
    $g2 = $row['green'];
    $b2 = $row['blue'];
    $str2 = 'rgb('.$r2.','.$g2.','.$b2.')';

    $query = "SELECT * FROM colors where name='GrayBoxBorder';";
    $result = $connection->query($query);
    $row=$result->fetch_assoc();
    $r3 = $row['red'];
    $g3 = $row['green'];
    $b3 = $row['blue'];
    $str3 = 'rgb('.$r3.','.$g3.','.$b3.')';

    $query = "SELECT * FROM colors where name='GrayBoxBackHover';";
    $result = $connection->query($query);
    $row=$result->fetch_assoc();
    $r4 = $row['red'];
    $g4 = $row['green'];
    $b4 = $row['blue'];
    $str4 = 'rgb('.$r4.','.$g4.','.$b4.')';

    $query = "SELECT * FROM colors where name='GrayBoxTextHover';";
    $result = $connection->query($query);
    $row=$result->fetch_assoc();
    $r5 = $row['red'];
    $g5 = $row['green'];
    $b5 = $row['blue'];
    $str5 = 'rgb('.$r5.','.$g5.','.$b5.')';

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>مدیریت مربع‌های طوسی</title>


        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
        <script src="js/manageMenue.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/local.css" />
        <link href="css/allproduct.css" rel="stylesheet">
        <link href="css/addblog.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <style>
            .grayBox{
                background-color: <?php echo $str1;?>;
                color: <?php echo $str2;?>;
            }

            .grayBox:hover{
                background-color: <?php echo $str4;?>;
                border-color: <?php echo $str3;?>;
                color: <?php echo $str5;?>;
            }
        </style>

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
                    <th class="text-center"><span>ترتیب نمایش</span></th>
                    <th class="text-center"><span>نمایش</span></th>

                </tr>
                </thead>
                <tbody>



            <?php
                $query = "SELECT * FROM grayBox;";
                $result = $connection->query($query);
                $num = $result->num_rows;
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
                                        <select id="orderby" name="orderby" class="form-control input-lg" form="<?php echo $id;?>" >
                                            <?php
                                            for ($i=1 ; $i<=$num ; $i++){
                                                ?>
                                            <option value="<?php echo $i;?>"
                                                 <?php if ($row['orderby'] == $i) echo "selected" ?> > <?php echo $i;?>
                                                <?php
                                            }
                                            ?>
                                        </select>
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



            <div class="col-md-12 col-12 m-5 floatright">
                <form action="manageGrayBox.php?colorset=1" method="post"  class="form-inline" >
                    <label for="back" class="dark_text col-md-6 float-right m-auto text-danger"><b>بازه رنگ‌ها باید بین صفر تا ۲۵۵ باشد.</b></label>
                    <div dir="rtl" class="col-md-12 m-3">
                        <label for="back" class="dark_text col-md-6 float-right"><b>رنگ پس زمینه</b></label>
                        <div class="col-md-6 float-right">
                            <input type="number" min="0" max="255" class="form-control text-danger back m-auto float-right"
                                   name="backR" id="backR" value="<?php echo $r1;?>" >
                            <input type="number" min="0" max="255" class="form-control text-success back m-auto float-right"
                                   name="backG"  id="backG" value="<?php echo $g1;?>" >
                            <input type="number" min="0" max="255" class="form-control text-primary back m-auto float-right"
                                   name="backB" id="backB" value="<?php echo $b1;?>"  >
                        </div>

                    </div>
                    <br/>
                    <div dir="rtl" class=" m-3 col-md-12">
                        <label for="text" class="dark_text  col-md-6 float-right"><b>رنگ متن</b></label>
                        <div class="col-md-6 float-right">
                            <input type="number" min="0" max="255" class="form-control text-danger text float-right"
                                   name="textR" id="textR" value="<?php echo $r2;?>" >
                            <input type="number" min="0" max="255" class="form-control text-success text float-right"
                                   name="textG" id="textG" value="<?php echo $g2;?>" >
                            <input type="number" min="0" max="255" class="form-control text-primary text float-right"
                                   name="textB" id="textB" value="<?php echo $b2;?>"  >
                        </div>
                    </div>
                    <br/>
                    <div dir="rtl" class="m-3 col-md-12">
                        <label for="borderr" class="dark_text col-md-6 float-right"><b>رنگ دور</b></label>
                        <div class="col-md-6 float-right">
                            <input type="number" min="0" max="255" class="form-control text-danger borderr float-right"
                               name="borderrR" id="borderrR" value="<?php echo $r3;?>" >
                            <input type="number"  min="0" max="255" class="form-control text-success borderr float-right"
                                   name="borderrG" id="borderrG" value="<?php echo $g3;?>" >
                            <input type="number" min="0" max="255" class="form-control text-primary borderr float-right"
                                   name="borderrB" id="borderrB" value="<?php echo $b3;?>"  >
                        </div>
                    </div>
                    <br/>
                    <div dir="rtl" class="m-3 col-md-12">
                        <label for="hover" class="dark_text col-md-6 float-right"><b>رنگ پس زمینه هنگام قرار گرفتن ماوس</b></label>
                        <div class="col-md-6 float-right">
                            <input type="number" min="0" max="255" class="form-control text-danger hover float-right"
                                   name="hoverR" id="hoverR" value="<?php echo $r4;?>" >
                            <input type="number" min="0" max="255" class="form-control text-success hover float-right"
                                   name="hoverG" id="hoverG" value="<?php echo $g4;?>" >
                            <input type="number" min="0" max="255" class="form-control text-primary hover float-right"
                               name="hoverB" id="hoverB" value="<?php echo $b4;?>"  >
                        </div>
                    </div>
                    <div dir="rtl" class="m-3 col-md-12">
                        <label for="texthover" class="dark_text col-md-6 float-right"><b>رنگ متن هنگام قرار گرفتن ماوس</b></label>
                        <div class="col-md-6 float-right">
                            <input type="number" min="0" max="255" class="form-control text-danger texthover float-right"
                               name="texthoverR" id="texthoverR" value="<?php echo $r5;?>" >
                            <input type="number" min="0" max="255" class="form-control text-success texthover float-right"
                                   name="texthoverG" id="texthoverG" value="<?php echo $g5;?>" >
                            <input type="number" min="0" max="255" class="form-control text-primary texthover float-right"
                               name="texthoverB" id="texthoverB" value="<?php echo $b5;?>"  >
                        </div>
                    </div>
                    <br/>
                    <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                        <input type="submit" value="ثبت" class="btn btn-success"/>
                    </div>

                </form>

            </div>

            <div class="col-md-12 m-5">
                <div class="col-md-5 col-12 float-none m-auto">

                        <div class="col-md-11 grayBox col-10">تست</div>

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
