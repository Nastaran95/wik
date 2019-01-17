<?php
if (isset($payam)){
include 'header.php';
?>
<div class="container paddingtop">
    <div class="row">
        <div class="m-auto text-right">
            <?php echo $payam;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="loginRegister.php" id="login-form" onsubmit="return validateFormverify()">
                                <div class="form-group">
                                    <input type="text" name="verifymobile" id="verifymobile" tabindex="1"
                                           class="form-control" placeholder="شماره موبایل" value="" data-val-length="الزامی">
                                    <span id="errmsgall10"> </span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="CODE" id="CODE" tabindex="1"
                                           class="form-control" placeholder="کد امنیتی" >
                                    <span id="errmsgall11"> </span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="loginsubmit" id="login-submit" tabindex="4"
                                                   class="form-control btn btn-login" value="ثبت">
                                        </div>
                                    </div>
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
            </div>
        </div>
    </div>
    <?php
}else {
    header('Location:index.php');
}