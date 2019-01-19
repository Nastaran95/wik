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
                <li class="<?php if ($which == 2) echo "selected"; ?>"><a href="addPost.php"><i class="fa fa-tasks"></i>
                        افزودن مقاله </a></li>
                <li class="<?php if ($which == 3) echo "selected"; ?>"><a href="allPosts.php?nocache=<?php echo generateRandomString(10)?>"><i class="fa fa-tasks"></i>
                        همه مقاله‌ها </a></li>
                <li class="<?php if ($which == 4) echo "selected"; ?>"><a href="addUser.php"><i class="fa fa-globe"></i>
                        افزودن کاربر </a></li>
                <li class="<?php if ($which == 5) echo "selected"; ?>"><a href="allUsers.php"><i class="fa fa-globe"></i>
                        مدیریت کاربران </a></li>
                <li class="<?php if ($which == 6) echo "selected"; ?>"><a href="addPost.php"><i
                                class="fa fa-list-ol"></i>مدیریت منو</a></li>
                <li class="<?php if ($which == 7) echo "selected"; ?>"><a href="allPosts.php"><i
                                class="fa fa-list-ol"></i> مدیریت دسته بندی کاربران </a></li>
                <li class="<?php if ($which == 8) echo "selected"; ?>"><a href="addNews.php"><i
                                class="fa fa-list-alt"></i> مدیریت دسته بندی مقالات </a></li>
                <li class="<?php if ($which == 9) echo "selected"; ?>"><a href="allNews.php"><i
                                class="fa fa-list-alt"></i> اسلایدر صفحه اصلی </a></li>
                <li class="<?php if ($which == 12) echo "selected"; ?>"><a href="addCustomer.php"><i
                                class="fa fa-file"></i> مدیریت مربع‌های طوسی </a></li>
                <li class="<?php if ($which == 13) echo "selected"; ?>"><a href="allCustomer.php"><i
                                class="fa fa-file"></i> مدیریت اشتراک عضویت </a></li>
                <li class="<?php if ($which == 10) echo "selected"; ?>"><a href="addmosahebe.php"><i
                                class="fa fa-dedent"></i> مدیریت تعرفه آگهی </a></li>
                <li class="<?php if ($which == 11) echo "selected"; ?>"><a href="allmosahebe.php"><i
                                class="fa fa-dedent"></i> مدیریت آگهی‌ها </a></li>
                <li class="<?php if ($which == 14) echo "selected"; ?>"><a href="allUsersRequest.php?nocache=<?php echo generateRandomString(10)?>"><i
                                class="fa fa-dedent"></i> همه درخواست های کاربران </a></li>
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