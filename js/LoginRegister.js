jQuery(document).ready(function($) {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

    $(document).on('keypress',"#mobile",function (e){
        //if the letter is not digit then display error and don't type anything
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $(".errmsg").removeClass('d-none');
            return false;
        }
        else{
            $(".errmsg").addClass('d-none');
            return true;
        }
    });

    $(document).on('keypress',"#mobileLogin",function (e){
        //if the letter is not digit then display error and don't type anything
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $(".errmsg2").removeClass('d-none');
            return false;
        }
        else{
            $(".errmsg2").addClass('d-none');
            return true;
        }
    });

    loadprovince();
    $(".province").change(function(){
        $(".city").addClass( "TEMPSHAHR" );
        loadCity($(this).val());
    });


});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateForm() {
    var time=0;
    if(document.getElementById("names").value.length===0){
        $("#names").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#names").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("family").value.length===0){
        $("#family").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#family").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("emails").value.length===0){
        $("#emails").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#emails").removeClass( "BORDERCOLOR" );
        if (!validateEmail(document.getElementById("emails").value)){
            document.getElementById("errmsgall3").innerHTML ="فرمت ایمیل وارد شده صحیح نمی باشد.";
            time=time+1;
        }
    }
    if(document.getElementById("phoneNo").value.length===0){
        $("#phoneNo").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#phoneNo").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("MobileNo").value.length===0){
        $("#MobileNo").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#MobileNo").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("shahr").value=="استان"){
        $("#shahr").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#shahr").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("city").value=="شهر"){
        $("#city").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#city").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("address").value.length===0){
        $("#address").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#address").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("pelak").value.length===0){
        $("#pelak").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#pelak").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("tabaghe").value.length===0){
        $("#tabaghe").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#tabaghe").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("zipcode").value.length===0){
        $("#zipcode").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#zipcode").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("codmelli").value.length===0){
        $("#codmelli").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#codmelli").removeClass( "BORDERCOLOR" );
    }

    if(document.getElementById("tahol").value==0){
        $("#tahol").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#tahol").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("firstpassword").value.length===0){
        $("#firstpassword").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#firstpassword").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("secondpassword").value.length===0){
        $("#secondpassword").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#secondpassword").removeClass( "BORDERCOLOR" );
    }
    if((document.getElementById("firstpassword").value.length!==0)&&(document.getElementById("secondpassword").value.length!==0)){
        if (document.getElementById("firstpassword").value!==document.getElementById("secondpassword").value){
            document.getElementById("errmsgall8").innerHTML ="پسوردهای وارد شده یکسان نمی باشند.";
            time=time+1;
        }else {
            if (document.getElementById("firstpassword").value.length<8){
                document.getElementById("errmsgall8").innerHTML ="طول پسورد حداقل باید 8 کاراکتر باشد.";
                time=time+1;
            }else {
                document.getElementById("errmsgall8").innerHTML ="";
            }
        }
    }else{
        time=time+1;
    }
    if (time<=0){
        $('#registersubmitpp').click(function(){
            $('#registersubmitpp').prop('disabled', true);
        });
    }
    return time <= 0;
}

function validateFormLogin() {
    var time=0;
    if(document.getElementById("usernamelogin").value.length===0){
        $("#usernamelogin").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#usernamelogin").removeClass( "BORDERCOLOR" );
    }
    if(document.getElementById("passwordLogin").value.length===0){
        $("#passwordLogin").addClass( "BORDERCOLOR" );
        time=time+1;
    }else{
        $("#passwordLogin").removeClass( "BORDERCOLOR" );
    }
    return time <= 0;
}
function validateFormverify() {
    var time=0;
    if(document.getElementById("verifymobile").value.length===0){
        document.getElementById("errmsgall10").innerHTML ="الزامی";
        time=time+1;
    }else{
        document.getElementById("errmsgall10").innerHTML ="";
    }
    if(document.getElementById("CODE").value.length===0){
        document.getElementById("errmsgall11").innerHTML ="الزامی";
        time=time+1;
    }else{
        document.getElementById("errmsgall11").innerHTML ="";
    }
    return time <= 0;
}
function validateFormgetcode() {
    var time=0;
    if(document.getElementById("getcode").value.length===0){
        document.getElementById("errmsgall10").innerHTML ="الزامی";
        time=time+1;
    }else{
        document.getElementById("errmsgall10").innerHTML ="";
    }
    return time <= 0;
}


function loadprovince() {
    selectValues = {"استان":"استان","البرز":"البرز","تهران":"تهران"};

    $.each(selectValues, function (key, value) {
        $('.province')
            .append($("<option></option>")
                .attr("value", key)
                .text(value));
    });
}

//Load city for selete
function loadCity(province){
    $(".TEMPSHAHR").find('option').remove();
    switch (province) {
        case "البرز":
            var selectValues = {"کرج":"کرج"};
            break;
        case "تهران":
            var selectValues = {"تهران":"تهران"};
            break;
        case "استان":
            var selectValues = {"شهر":"شهر"}

    }
    $.each( selectValues , function (key, value) {
        $(".TEMPSHAHR")
            .append($("<option></option>")
                .attr("value", key)
                .text(value));
    });
    $(".TEMPSHAHR").removeClass("TEMPSHAHR");
}



function regValidateForm(){

    flag = false;

    if(document.getElementById('name').value.length==0){
        $("#name").addClass('colorBorder');
        flag=true;
    }else{
        $("#name").removeClass('colorBorder');
    }

    if(document.getElementById('mobile').value.length==0){
        $("#mobile").addClass('colorBorder');
        flag=true;
    }else{
        $("#mobile").removeClass('colorBorder');
    }

    if(document.getElementById('email').value.length==0){
        $("#email").addClass('colorBorder');
        flag=true;
    }else{
        $("#email").removeClass('colorBorder');
    }

    if(document.getElementById('address').value.length==0){
        $("#address").addClass('colorBorder');
        flag=true;
    }else{
        $("#address").removeClass('colorBorder');
    }

    if(document.getElementById('pass').value.length==0){
        $("#pass").addClass('colorBorder');
        flag=true;
    }else{
        $("#pass").removeClass('colorBorder');
    }

    if(document.getElementById('repass').value.length==0){
        $("#repass").addClass('colorBorder');
        flag=true;
    }else{
        $("#repass").removeClass('colorBorder');
    }
    if(document.getElementById('pass').value.length>0 & document.getElementById('repass').value.length>0){
        pas1 = document.getElementById('pass').value;
        pas2 = document.getElementById('repass').value;
        if (pas1!=pas2){
            $("#pass").addClass('colorBorder');
            $("#repass").addClass('colorBorder');
            flag = true;
        }
        else{
            $("#pass").removeClass('colorBorder');
            $("#repass").removeClass('colorBorder');
        }
    }



    if(flag){
        $(".show_res").removeClass('d-none');
    }
    return !flag;
}

function loginPage() {
    window.location.href = "/loginRegister.php?request=login";
}


function loginValidateForm(){
    flag = false;

    if(document.getElementById('mobileLogin').value.length==0){
        $("#mobileLogin").addClass('colorBorder');
        flag=true;
    }else{
        $("#mobileLogin").removeClass('colorBorder');
    }

    if(document.getElementById('passLogin').value.length==0){
        $("#passLogin").addClass('colorBorder');
        flag=true;
    }else{
        $("#passLogin").removeClass('colorBorder');
    }

    if(flag){
        $(".show_res").removeClass('d-none');
    }
    return !flag;
}

function registerPage() {
    window.location.href = "/loginRegister.php?request=register";
}