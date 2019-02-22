<?php
/**
 * Created by PhpStorm.
 * User: HamidReza
 * Date: 8/9/2018
 * Time: 12:27 AM
 */
if (($_SESSION['typ']>0)) {
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">منو</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin.php">پنل ادمین</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul id="active" class="nav navbar-nav side-nav">

                <li class="<?php if ($which == 1) echo "selected"; ?>"><a href="admin.php"><i
                                class="fa fa-bullseye"></i> داشبورد </a></li>

                <div id="accordion" class="collapse-icon accordion-icon-rotate left">

                    <div class="card-header text-right  border-warning" id="headingCollapseOne">
                        <a class="card-title lead" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <i class="fa fa-tasks"></i>
                            مقاله
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse <?php if ($which == 2 || $which==3 || $which==8) echo "show"; ?> "  aria-labelledby="headingCollapseOne" role="tabpanel">
                        <div class="card-content">
                            <div class="card-body text-right">
                                <li class="p-2 <?php if ($which == 2) echo "selected"; ?>"><a href="addPost.php"><i class="fa fa-tasks"></i>
                                        افزودن مقاله </a></li>
                                <li class="p-2 <?php if ($which == 3) echo "selected"; ?>"><a href="allPosts.php?nocache=<?php echo generateRandomString(10)?>"><i class="fa fa-tasks"></i>
                                        همه مقاله‌ها </a></li>
                                <li class="p-2 <?php if ($which == 8) echo "selected"; ?>"><a href="managePapersCategory.php"><i
                                                class="fa fa-list-alt"></i> مدیریت دسته بندی مقالات </a></li>
                            </div>
                        </div>
                    </div>

                    <div class="card-header text-right  border-warning" id="headingCollapseTwo">
                        <a class="card-title lead collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <i class="fa fa-tasks"></i>
                            کاربران
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse <?php if ($which == 4 || $which==5 || $which==7 || $which==9 || $which==12 || $which==13) echo "show"; ?>"  aria-labelledby="headingCollapseTwo" role="tabpanel">
                        <div class="card-content">
                            <div class="card-body text-right">
                                <li class="p-2 <?php if ($which == 4) echo "selected"; ?>"><a href="addUser.php"><i class="fa fa-globe"></i>
                                        افزودن کاربر </a></li>
                                <li class="p-2 <?php if ($which == 5) echo "selected"; ?>"><a href="allUsers.php"><i class="fa fa-globe"></i>
                                        مدیریت کاربران </a></li>
                                <li class="p-2 <?php if ($which == 7) echo "selected"; ?>"><a href="manageUsersCategory.php"><i
                                                class="fa fa-list-ol"></i> مدیریت دسته بندی کاربران </a></li>
                                <li class="p-2 <?php if ($which == 12) echo "selected"; ?>"><a href="allUsersRequest.php?nocache=<?php echo generateRandomString(10)?>">
                                        <i class="fas fa-question-circle"></i> همه درخواست های کاربران </a></li>
                                <li class="p-2 <?php if ($which == 9) echo "selected"; ?>"><a href="manageUsersEshterak.php"><i
                                                class="fa fa-file"></i> مدیریت اشتراک عضویت </a></li>
                                <li class="p-2 <?php if ($which == 13) echo "selected"; ?>"><a href="allPardakht.php">
                                        <i class="fas fa-hand-holding-usd"></i>تراکنش‌ها </a></li>
                            </div>
                        </div>
                    </div>

                    <div class="card-header text-right  border-warning" id="headingCollapseThree">
                        <a class="card-title lead collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"> <i class="fa fa-tasks"></i>
                            آگهی
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse <?php if ($which == 16 || $which==17 || $which==18 || $which==19) echo "show"; ?>"  aria-labelledby="headingCollapseThree" role="tabpanel">
                        <div class="card-content">
                            <div class="card-body text-right">
                                <li class="p-2 <?php if ($which == 16) echo "selected"; ?>"><a href="manageAdd.php"><i
                                                class="fa fa-file"></i> مدیریت تعرفه‌های آگهی </a></li>

                                <li class="p-2 <?php if ($which == 17) echo "selected"; ?>"><a href="allPardakhtAdd.php">
                                        <i class="fas fa-hand-holding-usd"></i>تراکنش‌های تبلیغاتی </a></li>

                                <li class="p-2 <?php if ($which == 18) echo "selected"; ?>"><a href="addAdvertisement.php"><i class="fa fa-tasks"></i>
                                        افزودن آگهی </a></li>

                                <li class="p-2 <?php if ($which == 19) echo "selected"; ?>"><a href="allAdvertisement.php"><i class="fa fa-tasks"></i>
                                        همه آگهی‌ها </a></li>
                            </div>
                        </div>
                    </div>

                    <div class="card-header text-right  border-warning" id="headingCollapseFour">
                        <a class="card-title lead collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"> <i class="fa fa-tasks"></i>
                            صفحه ایستا
                        </a>
                    </div>
                    <div id="collapseFour" class="collapse <?php if ($which == 20 || $which==21 ) echo "show"; ?>"  aria-labelledby="headingCollapseFour" role="tabpanel">
                        <div class="card-content">
                            <div class="card-body text-right">
                                <li class="p-2 <?php if ($which == 20) echo "selected"; ?>"><a href="addPage.php"><i class="fa fa-tasks"></i>
                                        افزودن صفحه ایستا </a></li>

                                <li class="p-2 <?php if ($which == 21) echo "selected"; ?>"><a href="allPages.php"><i class="fa fa-tasks"></i>
                                        همه صفحه‌های ایستا </a></li>
                            </div>
                        </div>
                    </div>


                </div>






                <li class="p-2 <?php if ($which == 6) echo "selected"; ?>"><a href="manageMenue.php"><i
                                class="fa fa-list-ol"></i>مدیریت منو</a></li>



                <li class="p-2 <?php if ($which == 10) echo "selected"; ?>"><a href="manageSlider.php"><i
                                class="fa fa-list-alt"></i> اسلایدر صفحه اصلی </a></li>
                <li class="p-2 <?php if ($which == 11) echo "selected"; ?>"><a href="manageGrayBox.php"><i
                                class="fa fa-file"></i> مدیریت مربع‌های طوسی </a></li>



                <li class="p-2 <?php if ($which == 14) echo "selected"; ?>"><a href="aboutUsSetting.php">
                        <i class="fas fa-cogs"></i>تنظیمات در باره ما </a></li>

                <li class="p-2 <?php if ($which == 15) echo "selected"; ?>"><a href="contactUsSetting.php">
                        <i class="fas fa-cogs"></i>تنظیمات تماس‌ با ما </a></li>





                <!--                <li class="--><?php //if ($which == 14) echo "selected"; ?><!--"><a href="admin.php"><i-->
<!--                                class="fa fa-dedent"></i> مدیریت تعرفه آگهی </a></li>-->
<!--                <li class="--><?php //if ($which == 15) echo "selected"; ?><!--"><a href="admin.php"><i-->
<!--                                class="fa fa-dedent"></i> مدیریت آگهی‌ها </a></li>-->

<!--                <li class="--><?php //if ($which == 15) echo "selected"; ?><!--"><a href="allKarjooRequest.php"><i-->
<!--                                class="fa fa-dedent"></i> همه نظرات کارجویان </a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">
                <li class="dropdown user-dropdown">
                    <a href="../logout.php"><i class="fa fa-power-off"></i> خروج </a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
}
else{

    header('Location:../');

}
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>