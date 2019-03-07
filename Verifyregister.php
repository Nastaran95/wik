<?php
if (isset($payam)){
include 'header.php';
?>
  <div class="container">
        <div  id="main" class="home_main row">

            <div class="col-md-12">
                <div class="mainDiv col-md-9 col-12 text-right">
                    <div class="col-md-12 ">
                        <div class="col-md-12">
                            <h1> <span class="fontDiam"> &#9830; </span>
                               تایید ثبت نام
                            </h1>
                        </div>
                        <div class="text-justify blackCol box">
                        </div>

                        <div class="col-11 text-info m-auto text-center p-4"><?php echo $payam;?>
                        </div>

                        <div class="col-md-12 float-left text-justify reg text-center">
                            <form method="post" action="loginRegister.php" id="login-form" onsubmit="return validateFormverify()">
                                <div class="form-group col-md-10 m-auto text-right">
                                    <input type="text" name="verifymobile" id="verifymobile" tabindex="1"
                                           class="form-control" placeholder="شماره موبایل" value="" data-val-length="الزامی">
                                    <span id="errmsgall10"> </span>
                                </div>
                                <div class="form-group col-md-10 m-auto text-right">
                                    <input type="text" name="CODE" id="CODE" tabindex="1"
                                           class="form-control" placeholder="کد امنیتی" >
                                    <span id="errmsgall11"> </span>
                                </div>

                                <div class="form-group col-md-6 m-auto text-right">
                                    <input type="submit" name="loginsubmit" id="login-submit" tabindex="4"
                                           class="form-control btn btn-success" value="ثبت">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <a href="loginRegister.php?getcode=1">کدی دریافت نکردید؟ اینجا کلیک کنید.</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>


                </div>


                <div class="leftDiv col-md-3 col-12">
                    <div class="col-md-12 text-center addSub float-left">
                        <h3>
                            ویکی تبلیغ
                        </h3>
                    </div>
                    <?php
                    include 'showAdd.php';
                    ?>
                </div>

            </div>
        </div>
    </div>


    <?php
}else {
    header('Location:index.php');
}