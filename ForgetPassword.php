<?php
if (isset($payam)){
    if ($payam=="FORGETPASSWORDSECRET"){
    include 'Header.php';
    ?>
        <div class="container">
            <div  id="main" class="home_main row">

                <div class="col-md-12">
                    <div class="mainDiv col-md-9 col-12 text-right">
                        <div class="col-md-12 ">
                            <div class="col-md-12">
                                <h1> <span class="fontDiam"> &#9830; </span>
                                    فراموشی پسوورد
                                </h1>
                            </div>
                            <div class="text-justify blackCol box">
                            </div>

                            <div class="col-11 text-info m-auto text-center p-4"><?php echo $payam2;?>
                            </div>

                            <div class="col-md-12 float-left text-justify reg text-center">
                                <form method="post" action="LoginRegister.php" id="login-form" onsubmit="return validateFormverify()">
                                    <div class="form-group col-md-10 m-auto text-right">
                                        <input type="text" name="sendpassword" id="sendpassword" tabindex="1"
                                               class="form-control" placeholder="شماره موبایل" value="" data-val-length="الزامی">
                                        <span id="errmsgall10"> </span>
                                    </div>
                                    <div class="form-group col-md-6 m-auto text-right">
                                        <input type="submit" name="loginsubmit" id="login-submit" tabindex="4"
                                               class="form-control btn-warning" value="ارسال پسورد">
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
    }else{
        header('Location:/');
    }
}else {
    header('Location:/');
}