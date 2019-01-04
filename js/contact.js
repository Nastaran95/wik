
function validateForm(){
    flag = false;
    if(document.getElementById('name').value.length==0){
        $("#name").addClass('colorBorder');
        flag=true;
    }else{
        $("#name").removeClass('colorBorder');
    }

    if(document.getElementById('email').value.length==0){
        $("#email").addClass('colorBorder');
        flag=true;
    }else{
        $("#email").removeClass('colorBorder');
    }

    if(document.getElementById('subject').value.length==0){
        $("#subject").addClass('colorBorder');
        flag=true;
    }else{
        $("#subject").removeClass('colorBorder');
    }

    if(document.getElementById('msg').value.length==0){
        $("#msg").addClass('colorBorder');
        flag=true;
    }else{
        $("#msg").removeClass('colorBorder');
    }

    if(flag){
        $(".karfarma_register").removeClass('hide');
        $(".show_res").removeClass('hide');
    }
    return !flag;
}