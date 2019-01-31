jQuery(document).ready(function($) {

    $('#imgBtn').click(function () {
        $('#img').trigger('click');
    });


    $(document).on('keypress',"#number",function (e){
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

    $(document).on('click touchstart',".chooseType",function (event) {
        id1 = event.target.id;
        id2 = '#tr'+id1;
        // alert(id1);

        $('tr').removeClass('bg-info');
        $('tr').removeClass('text-light');


        $(id2).addClass('bg-info');
        $(id2).addClass('text-light');

        $("#time").val(id1);

    });

});

function validateForm(){
    flag = false;
    if(document.getElementById('name').value.length==0){
        $("#name").addClass('colorBorder');
        flag=true;
    }else{
        $("#name").removeClass('colorBorder');
    }

    if(document.getElementById('img').value.length==0){
        $("#imgBtn").addClass('colorBorder');
        flag=true;
    }else{
        $("#imgBtn").removeClass('colorBorder');
    }

    if(document.getElementById('time').value.length==0){
        $("#timeTable").addClass('colorBorder');
        flag=true;
    }else{
        $("#timeTable").removeClass('colorBorder');
    }

    if(flag){
        $(".show_res").removeClass('d-none');
    }
    return !flag;

}


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#showImage')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $('#showImage').removeClass('d-none');
        $('#showImage').addClass('d-block');
    }
}