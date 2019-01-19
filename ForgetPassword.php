<?php
if (isset($payam)){
    if ($payam=="FORGETPASSWORDSECRET"){
    include 'Header.php';
    ?>
    <div class="container paddingtop">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="row">
                    <div class="col-11"><?php echo $payam2;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="LoginRegister.php" id="login-form" onsubmit="return validateFormverify()">
                                <div class="form-group">
                                    <input type="text" name="sendpassword" id="sendpassword" tabindex="1"
                                           class="form-control" placeholder="شماره موبایل" value="" data-val-length="الزامی">
                                    <span id="errmsgall10"> </span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="loginsubmit" id="login-submit" tabindex="4"
                                                   class="form-control btn btn-login" value="ارسال پسورد">
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
    }else{
        header('Location:/');
    }
}else {
    header('Location:/');
}