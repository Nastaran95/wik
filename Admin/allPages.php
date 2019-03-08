<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/11/2018
 * Time: 2:35 AM
 */
session_start();
include '../Settings.php';
if (($_SESSION['typ']>0)) {
    if (isset($_REQUEST['cat1']))
        $cat1 = true;
    else
        $cat1 = false;
    ?>
    <?php
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } else {
        $type = 1;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>همه صفحات ایستا</title>

        <link rel="stylesheet" href="/css/bootstrap.css"/>
        <script src="/js/jQuery.js" ></script>
        <script src="/js/bootstrap.js" ></script>
        <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/local.css" />
        <link href="css/allproduct.css" rel="stylesheet">
        <link href="css/addblog.css" rel="stylesheet">
        <script src="js/allPages.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    </head>
    <body dir="rtl">
    <div id="wrapper">
        <?php
        $which=21;
        include 'adminmenue.php';
        ?>
        <div id="page-wrapper">
            <div class="m-auto col-12" id="showerror"></div>


            <table class="table user-list text-center" id="menuTable">
                <thead>
                <tr class="text-center">

                    <th class="text-center"><span>نام صفحه</span></th>
                    <th class="text-center"><span>لینک قابل استفاده صفحه</span></th>

                </tr>
                </thead>
                <tbody>



                <?php

                $query = "SELECT * FROM Pages;";
                $result = $connection->query($query);
                while ($row=$result->fetch_assoc()) {
                    echo "   
                                    <td >                                                                                                               
                                        <span>".$row['name']."</span>
                                    </td>";


                    echo "<td dir='ltr' >
                                        <span><a href='http://wikiderm.ir/Page/".$row['link']."'>
                                        https://wikiderm.ir/Page/".$row['link']."
                                        </a></span>
                                    </td>";

                    echo "                                                                      
                                    <td style=\"width: 20%;\">
                                        <a  target='_blank' href='addPage.php?type=$type&product=" . $row['ID'] . "' class=\"table-link\">
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x bluecolor\"></i>
                                                <i class=\"fas fa-edit fa-stack-1x fa-inverse \"></i>
                                            </span>
                                        </a>
                                        <a onClick=\"return confirming();\"  href='deleteblog.php?type=11&product=" . $row['ID'] . "' class=\"table-link danger\">
                                            <span class=\"fa-stack\">
                                                <i class=\"fa fa-square fa-stack-2x\"></i>
                                                <i class=\"far fa-trash-alt fa-stack-1x fa-inverse\"></i>
                                            </span>
                                        </a>
                                        
                                     
                                        
                                    </td>";
                    echo '</tr>';

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
