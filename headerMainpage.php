<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 12/23/18
 * Time: 2:14 PM
 */
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136361261-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-136361261-1');
</script>


<div class="header col-lg-12 col-md-12 hiddenthisxs ">
    <div class="fixed fix fixed1 headerall">
        <div class="row">
            <div class="float-right padding20_0 col-md-10 row">
                <div class="col-md-2 ml-3 mr-3 float-right paddleft0">
                    <a href="/">
                        <img src="/images/wikiderm-logo-180-544--300x99.png" width="90%" height="90%" alt="logo">
                    </a>
                    </div>
                <div class="col-md-9 headerH text-sm-right">
                    <h1 class="small">
                        سایت جامع اطلاعات  پوست،  مو و زیبایی و معرفی مشاغل
                        <span class="specialSpan">
                               درمانی، دارویی، تجاری و آرایشی
                        </span>
                        مرتبط
                    </h1>
                </div>
            </div>

            <div class="col-md-2 log_reg_block row">
                <?php
                if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in']!=true) {
                    ?>
                    <div class="m-auto"><a class="dark_text" href="/loginRegister.php?request=login">ورود</a></div>
                    <div class="m-auto"><a class="dark_text" href="/loginRegister.php?request=register">عضویت</a></div>
                    <?php
                }
                else{
                    ?>
                    <div class="m-auto"><a class="dark_text" href="/profile.php">پروفایل کاربری</a></div>
                    <div class="m-auto"><a class="dark_text" href="/Logout.php">خروج</a></div>
                    <?php
                }
                ?>
            </div>
        </div>


    </div>

    <div class="fixed fix fixed2 d-none headerall">
        <div class="row">
            <div class="float-right padding20_0 col-md-10 row">
                <div class="col-md-2 ml-3 mr-3 float-right paddleft0">
                    <a href="/">
                        <img src="/images/wikiderm-logo-180-544--300x99.png" width="90%" height="90%" alt="logo">
                    </a>
                </div>
                <div class="col-md-9 headerH text-sm-right">
                    <h1 class="small">
                        سایت جامع اطلاعات  پوست،  مو و زیبایی و معرفی مشاغل
                        <span class="specialSpan">
                               درمانی، دارویی، تجاری و آرایشی
                        </span>
                        مرتبط
                    </h1>
                </div>
            </div>

            <div class="col-md-2 log_reg_block row">
                <?php
                if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in']!=true) {
                    ?>
                    <div class="m-auto"><a class="dark_text" href="/loginRegister.php?request=login">ورود</a></div>
                    <div class="m-auto"><a class="dark_text" href="/loginRegister.php?request=register">عضویت</a></div>
                    <?php
                }else{
                    ?>
                    <div class="m-auto"><a class="dark_text" href="/profile.php">پروفایل کاربری</a></div>
                    <div class="m-auto"><a class="dark_text" href="/Logout.php">خروج</a></div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="menu">
            <ul class="dark_text">
                <?php
                $query = "SELECT * FROM menue;";
                $result = $connection->query($query);
                if (isset($_SESSION["typ"]) && $_SESSION["typ"]>0) {
                    ?>
                    <a href="/Admin/admin.php"><li>منوی ادمین</li></a>
                    <?php
                }
                while ($row=$result->fetch_assoc()) {
                    $link = $row['link'];
                    $name = $row['name'];
                    $act = $row['active'];
                    if($act>0) {
                        ?>
                        <a href="<?php echo $link; ?>">
                            <li><?php echo $name; ?></li>
                        </a>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>

    </div>
</div>



<div class="header col-lg-12 col-md-12 headerfix hidden-md hidden-lg hiddenthisoverxs">

    <div id="mySidenav" class="sidenav">
        <div class="row col-12 position-absolute sticky-top">
            <a href="javascript:void(0)" class="closebtn col-3" onclick="closeNav()">&times;</a>
            <a href="/" class="col-9">
                <img src="/images/wikiderm-logo-180-544--300x99.png" width="90%" height="90%" alt="logo">
            </a>
        </div>

        <?php
        $query = "SELECT * FROM menue;";
        $result = $connection->query($query);
        if (isset($_SESSION["typ"]) && $_SESSION["typ"]>0) {
            ?>
            <a href="/Admin/admin.php">منوی ادمین</a>
            <?php
        }
        while ($row=$result->fetch_assoc()) {
            $link = $row['link'];
            $name = $row['name'];
            $act = $row['active'];
            if($act>0) {
                ?>
                <a href="<?php echo $link; ?>">
                    <?php echo $name; ?>
                </a>
                <?php
            }
        }
        ?>
    </div>

    <!-- Use any element to open the sidenav -->
    <div class="col-12 navbar-text cover_menu" >
        <div class="row log_reg_block_mob">
            <i class="fa fa-bars side_menu_icon float-right" onclick="openNav()"></i>
            <img src="/images/wikiderm-logo-180-544--300x99.png" height="30px" alt="logo" class="d-block mx-auto">
            <?php
            if (!isset($_SESSION["logged_in"]) || $_SESSION['logged_in']!=true) {
                ?>
                <div class="d-block offset-1"><a class="dark_text" href="/loginRegister.php?request=login">ورود</a>
                </div>
                <div class="d-block offset-1"><a class="dark_text" href="/loginRegister.php?request=register">عضویت</a>
                </div>
                <?php
            }else{
                ?>

                <div class="d-block offset-1"><a class="dark_text" href="/profile.php"> پروفایل کاربری</a></div>
                <div class="d-block offset-1"><a class="dark_text" href="/Logout.php">خروج</a></div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="cover ">

        <div id="myCarousel2" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">

                <?php
                $query2 = "SELECT * FROM slider ;" ;
                $result2 = $connection->query($query2);
                $num = $result2->num_rows;
                $x = 0;
                while ($row=$result2->fetch_assoc()){
                    $act = $row['active'];
                    if($act>0) {
                        ?>
                        <li data-target="#myCarousel2" data-slide-to="<?php echo $x; ?>"
                            class="<?php if ($x == 0) echo 'active'; ?>"></li>
                        <?php
                        $x = $x + 1;
                    }
                }
                ?>
            </ul>


            <!-- The slideshow -->
            <div class="carousel-inner">
                <?php
                $query = "SELECT * FROM slider;";
                $result = $connection->query($query);
                $x = 0 ;
                while ($row=$result->fetch_assoc()) {
                    $name = $row['headerName'];
                    $mokhtasar = $row['Mokhtasar'];
                    $img = $row['image'];
                    $alt = $row['alt'];
                    $act = $row['active'];
                    $link = $row['link'];
                    if($act>0) {
                        ?>
                        <div class="carousel-item <?php if ($x == 0) echo 'active'; ?>">
                            <a href="<?php echo $link?>" title="<?php echo $name;?>">
                            <img src="<?php echo $img; ?>" alt="<?php echo $alt; ?>" width="100%">
                            </a>
                            <div class="carousel-caption">
                            <h3><?php echo $name; ?></h3>
                            <p><?php echo $mokhtasar; ?></p>
                            </div>
                        </div>
                        <?php
                        $x = $x + 1;
                    }
                }
                ?>

            </div>


            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel2" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel2" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>

    </div>
</div>


