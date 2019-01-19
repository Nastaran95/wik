$(document).ready(function() {


    // $(".btn-successeditfooter").click(function () {
    //     if (confirm('آیا از انجام این کار مطمئین هستید؟')) {
    //         $("#editor1").val($('#edit1').froalaEditor('html.get'));
    //         $("#editor4").val($('#edit4').froalaEditor('html.get'));
    //     }
    // });

});

// function getmydataseoblogs() {
//     $("#editor1").val($('#edit').froalaEditor('html.get'));
// }
//
// function getEditFooterdata() {
//     $("#editor1").val($('#edit').froalaEditor('html.get'));
// }
function countChar(val) {
    var len = val.value.length;
    if (len >= 149) {
        val.value = val.value.substring(0, 149);
    } else {
        $('#charNum').text("تعداد کاراکتر باقیمانده"+(149 - len));
    }
};

function validateFormdata(tab){
    var time=0;

    if(tab==1){
        $("#editor122").val($('#edit').froalaEditor('html.get'));
        if(document.getElementById("subject").value.length===0){
            $("#subject").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#subject").removeClass( "BORDERCOLOR" );
        }
        if(document.getElementById("category1").value.length===0){
            $("#category1").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#category1").removeClass( "BORDERCOLOR" );
        }
        if(document.getElementById("sum").value.length===0){
            $("#sum").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#sum").removeClass( "BORDERCOLOR" );
        }
        if(document.getElementById("editor122").value.length===0){
            $("#editor122").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#editor122").removeClass( "BORDERCOLOR" );
        }
    }
    else if(tab==2){
        if(document.getElementById("name").value.length===0){
            $("#name").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#name").removeClass( "BORDERCOLOR" );
        }
        if(document.getElementById("mobile").value.length===0){
            $("#mobile").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#mobile").removeClass( "BORDERCOLOR" );
        }
        if(document.getElementById("email").value.length===0){
            $("#email").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#email").removeClass( "BORDERCOLOR" );
        }
        if(document.getElementById("address").value.length===0){
            $("#address").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#address").removeClass( "BORDERCOLOR" );
        }
        if(document.getElementById("pass").value.length===0){
            $("#pass").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#pass").removeClass( "BORDERCOLOR" );
        }
        if(document.getElementById("repass").value.length===0){
            $("#repass").addClass( "BORDERCOLOR" );
            time=time+1;
        }else{
            $("#repass").removeClass( "BORDERCOLOR" );
        }
        if((document.getElementById("pass").value.length!==0)&&(document.getElementById("repass").value.length!==0)){
            if (document.getElementById("pass").value!==document.getElementById("repass").value){
                $('#showerror').text("پسوردهای وارد شده یکسان نمی باشند.");
                time=time+1;
                return false;
            }else {
                if (document.getElementById("pass").value.length<8){
                    $('#showerror').text("طول پسورد حداقل باید 8 کاراکتر باشد.");
                    time=time+1;
                    return false;
                }else {
                    document.getElementById("showerror").innerHTML ="";
                }
            }
        }else{
            time=time+1;
        }
    }


    // if($('#dastebandi').val()=='هیچی'){
    //     $("#dastebandi").addClass( "BORDERCOLOR" );
    //     time=time+1;
    // }else {
    //     $("#dastebandi").removeClass( "BORDERCOLOR" );
    // }
    if (time>0){
        $('#showerror').text("به موارد الزامی دقت کنید.");
        return false;
    }
    else{
        if (confirm('آیا از انجام این کار مطمئین هستید؟')) {
            return true;
        }else{
            return false;
        }
    }

}
