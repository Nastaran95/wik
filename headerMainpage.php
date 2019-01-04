<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 12/23/18
 * Time: 2:14 PM
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 8/2/18
 * Time: 7:54 PM
 */
?>

<div class="header col-lg-12 col-md-12 ">
    <div class="hiddenthisxs">
        <div class="fixed fix fixed1 headerall">
            <div class="col-md-12">
                <div class="pull-right padding20_0 col-md-9">
                    <div class="col-md-4 pull-right paddleft0">
                        <img src="images/wikiderm-logo-180-544--300x99.png" width="90%" height="90%" alt="logo">
                    </div>
                    <div class="col-md-8 headerH">
                        <h1 class="small">
                            سایت جامع اطلاعات پوست، مو و زیبایی و معرفی مشاغل مرتبط با پوست و مو
                        </h1>
                    </div>
                </div>

                <div class="col-md-3 log_reg_block">
                    <div class="col-md-5">ورود</div>
                    <div class="col-md-5">عضویت</div>
                </div>
            </div>


        </div>

        <div class="fixed fix fixed2 hide headerall">
            <div class="col-md-12">
                <div class="pull-right padding20_0 col-md-9">
                    <div class="col-md-4 pull-right paddleft0">
                        <img src="images/wikiderm-logo-180-544--300x99.png" width="90%" height="90%" alt="logo">
                    </div>
                    <div class="col-md-8 headerH">
                        <h1 class="small">
                            سایت جامع اطلاعات پوست، مو و زیبایی و معرفی مشاغل مرتبط با پوست و مو
                        </h1>
                    </div>
                </div>

                <div class="col-md-3 log_reg_block">
                    <div class="col-md-5">ورود</div>
                    <div class="col-md-5">عضویت</div>
                </div>
            </div>
            <div class="menu">
                <ul class="dark_text">
                    <?php
                    $query = "SELECT * FROM menue;";
                    $result = $connection->query($query);
                    while ($row=$result->fetch_assoc()) {
                        $link = $row['link'];
                        $name = $row['name'];
                        ?>
                        <a href="<?php echo $link;?>" ><li><?php echo $name;?></li></a>
                        <?php
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>

<!--    <div class="fixed fix hide">-->
<!--        <div class=" hiddenme">-->
<!--            <a href="/"><div class="karasa dark light_text">-->
<!--                    <h1 class="small title">-->
<!--                        سایت جامع اطلاعات پوست، مو و زیبایی و معرفی مشاغل مرتبط با پوست و مو-->
<!--                    </h1>-->
<!--                </div>-->
<!--            </a>-->
<!--            <div class="menu">-->
<!--                <ul class="dark_text">-->
<!--                    <a href="/" ><li>صفحه اصلی</li></a>-->
<!--                    <a href="/" ><li>مقالات</li></a>-->
<!--                    <a href="/" ><li>سلویک</li></a>-->
<!--                    <a href="/" ><li>تماس با ما</li></a>-->
<!--                    <a href="/" ><li>درباره ما</li></a>-->
<!--                    <a href="/" ><li>آگهی</li></a>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="fixed hiddenthisoverxs">-->
<!--        <div class="showme">-->
<!--            <div class="fixed">-->
<!--                <div class="karasa dark light_text">-->
<!--                    <div class="show_side_menu">-->
<!--                        <i class="fa fa-bars side_menu_icon"></i>-->
<!--                        <h1 class="title">کاراسا</h1>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="side_menu hide">-->
<!--                <div class="collapsed_menu">-->
<!---->
<!--                    <div class="top_menu">-->
<!--                        <div class="title_menu">-->
<!--                            <h1 class="small title">-->
<!--                                سایت جامع اطلاعات پوست، مو و زیبایی و معرفی مشاغل مرتبط با پوست و مو-->
<!--                            </h1>-->
<!--                        </div>-->
<!--                        <a href="/"><img src="/images/logo.png" alt="لوگو"></a>-->
<!--                    </div>-->
<!---->
<!--                    <ul class="dark_text">-->
<!--                        <a href="/" ><li>صفحه اصلی</li></a>-->
<!--                        <a href="/" ><li>مقالات</li></a>-->
<!--                        <a href="/" ><li>سلویک</li></a>-->
<!--                        <a href="/" ><li>تماس با ما</li></a>-->
<!--                        <a href="/" ><li>درباره ما</li></a>-->
<!--                        <a href="/" ><li>آگهی</li></a>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

</div>

