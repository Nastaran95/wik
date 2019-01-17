<?php
/**
 * Created by PhpStorm.
 * User: Nastaran
 * Date: 1/3/19
 * Time: 1:58 AM
 */
?>




<div class="container">
    <div  id="main" class="home_main row">

        <div class="col-md-12 search hiddenthisoverxs">

            <div id="sb-search2" class="sb-search">
                <form class="float-left">
                    <input class="sb-search-input" placeholder="جستجو" type="search" value="" name="search" id="search2">
                    <button class="sb-search-submit sb-icon-search" type="submit" value=""><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="col-md-12">

            <?php
            if ($_GET['request']=='register'){
                ?>
                <div class="mainDiv col-md-9 col-12 text-right">


                    <div class="col-md-12 ">

                        <div class="col-md-12">
                            <h1> <span class="fontDiam"> &#9830; </span>
                                عضویت
                            </h1>
                        </div>

                        <div class="text-justify blackCol box">
                        </div>

                        <div class="col-md-12 float-left text-justify reg text-center">
                            <div class="show_res d-none m-auto col-12">به موارد الزامی دقت کنید.</div>
                            <form action="loginRegister.php?request=register" method="post" onsubmit="return regValidateForm()" class="row">
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="name" class="dark_text"><b>نام و نام خانوادگی</b></label>
                                    <input type="text" class="form-control" id="name" placeholder="نام و نام خانوادگی" name="name" >
                                </div>
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="mobile" class="dark_text"><b>شماره همراه</b></label>
                                    <input type="text" class="form-control" id="mobile" placeholder="شماره همراه" name="mobile" >
                                </div>
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="email" class="dark_text"><b>ایمیل</b></label>
                                    <input type="email" class="form-control" id="email" placeholder="ایمیل"  name="email">
                                </div>
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="address" class="dark_text"><b>آدرس</b></label>
                                    <input type="text" class="form-control" id="address" placeholder="آدرس" name="address">
                                </div>
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="pass" class="dark_text"><b>کلمه عبور</b></label>
                                    <input type="password" class="form-control" id="pass" placeholder="کلمه عبور" name="pass" >
                                </div>
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="repass" class="dark_text"><b>تایید کلمه عبور</b></label>
                                    <input type="password" class="form-control" id="repass" placeholder="تایید کلمه عبور" name="repass" >
                                </div>
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="category" class="dark_text"><b>دسته‌بندی</b></label>
                                    <select name="category" class="form-control required" id="category">
                                        <?php
                                        $query = "SELECT * FROM userCategory;";
                                        $result = $connection->query($query);
                                        while ($row=$result->fetch_assoc()) {
                                            $name = $row['name'];
                                            $id = $row['ID'];
                                            ?>
                                            <option value="<?php echo $id;?>"><?php echo $name;?></option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="m-auto">
                                    <div class="g-recaptcha" data-sitekey="6LdBvYkUAAAAAM4dmGD1D36TXX1fwssNLGnoz8j9"></div>
                                </div>
                                <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                                    <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                                        <button type="submit" class="btn btn-default col-md-12 col-12" id="register">ثبت نام</button>
                                    </div>
                                    <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                                        <div class="btn btn-default col-md-12 col-12 lowCol" onclick="loginPage()">ورود</div>
                                    </div>
                                </div>

                            </form>

                        </div>


                    </div>


                </div>



                <?php
            }
            else {
                ?>
                <div class="mainDiv col-md-9 col-12 text-right">


                    <div class="col-md-12 ">

                        <div class="col-md-12">
                            <h1> <span class="fontDiam"> &#9830; </span>
                                ورود
                            </h1>
                        </div>

                        <div class="text-justify blackCol box">
                        </div>

                        <div class="col-md-12 float-left text-justify reg text-center">
                            <div class="show_res d-none  m-auto col-12">به موارد الزامی دقت کنید.</div>
                            <form action="loginRegister.php?request=login" method="post" onsubmit="return loginValidateForm()" class="row">
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="mobileLogin" class="dark_text"><b>شماره همراه</b></label>
                                    <input type="number" class="form-control" id="mobileLogin" placeholder="شماره همراه"  name="mobileLogin">
                                </div>
                                <div class="form-group col-md-10 m-auto text-right">
                                    <label for="passLogin" class="dark_text"><b>کلمه عبور</b></label>
                                    <input type="password" class="form-control" id="passLogin" placeholder="کلمه عبور" name="passLogin" >
                                </div>
                                <div class="m-auto">
                                    <div class="g-recaptcha" data-sitekey="6LdBvYkUAAAAAM4dmGD1D36TXX1fwssNLGnoz8j9"></div>
                                </div>
                                <div class="form-group col-md-10 row mt-4 ml-auto mr-auto">
                                    <div class="col-md-5 col-12 mt-2 ml-auto mr-auto">
                                        <button type="submit" class="btn btn-default col-md-12 col-12" id="register">ورود</button>
                                    </div>
                                    <div class="col-md-5 col-12 mt-2 ml-auto mr-auto" onclick="registerPage()">
                                        <div class="btn btn-default col-md-12 col-12 lowCol"  >ثبت نام</div>
                                    </div>
                                </div>

                            </form>
                            <div class="m-auto"> <a href="/"> رمز عبور خود را فراموش کرده‌اید؟</a> </div>

                        </div>


                    </div>


                </div>
            <?php
            }
            ?>


            <div class="leftDiv col-md-3 col-12">
                <div class="col-md-12 text-center addSub float-left">
                    <h3>
                        تبلیغات
                    </h3>
                </div>
                <div class="col-md-12 add">
                    <img src="images/tabliq.png" width="100%" height="100%" alt="">
                </div>
                <div class="col-md-12 add">
                    <img src="images/tabliq.png" width="100%" height="100%" alt="">
                </div>
            </div>

        </div>
    </div>
</div>




<script src="/js/classie.js"></script>
<script src="/js/uisearch.js"></script>
<script>
    new UISearch( document.getElementById( 'sb-search' ) );
    new UISearch( document.getElementById( 'sb-search2' ) );
</script>
<script type="application/ld+json">
    {
    "@context":"http://schema.org",
    "@type":"Organization",
    "url":"http://www.wikiderm.ir/",
    "sameAs":["https://www.instagram.com/wikiderm/"],
    "@id":"#organization",
    "name":"ویکی‌درم",
    "logo":"http://www.wikiderm.ir/<?php echo $XMLFile->logo->url;?>"}
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
</body>
</html>