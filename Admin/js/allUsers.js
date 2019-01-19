var range, page, category;
$(document).ready(function() {
    range = $("#limit").find(":selected").text();
    type=$("input[name='type']").val();
    $.get("allUsersPagination.php", {page:1, limit:range,type:type,query:"=====+++=====",category:"all", TMP:makeid()}, function (data, status) {
        $("#results").html(data);
    });
    //executes code below when user click on pagination links
    $("#results").on( "click", ".pagination a", function (e){
        e.preventDefault();
        $(".loading-div").show(); //show loading element
        page = $(this).attr("data-page"); //get page number from link
        $.get("allUsersPagination.php", {page:page, limit:range,type:type,query:"=====+++=====",category:"all", TMP:makeid()}, function (data, status) {
            $(".loading-div").hide(); //show loading element
            $("#results").html(data);
        });

    });
    $(document).on('change','#limit',function(e){
        e.preventDefault();
        $(".loading-div").show(); //show loading element
        range = $("#limit").find(":selected").text();
        $.get("allUsersPagination.php", {page:1, limit:range,type:type,query:"=====+++=====",category:"all", TMP:makeid()}, function (data, status) {
            $(".loading-div").hide(); //show loading element
            $("#results").html(data);
        });

    });
    $('#sarching').bind("enterKey",function(e){
        searchdata=$('#sarching').val();
        if (searchdata==""){
            searchdata="=====+++=====";
        }
        e.preventDefault();
        $(".loading-div").show(); //show loading element
        range = $("#limit").find(":selected").text();
        $.get("allUsersPagination.php", {page:1, limit:range,type:type,query:searchdata,category:"all", TMP:makeid()}, function (data, status) {
            $(".loading-div").hide(); //show loading element
            $("#results").html(data);
        });
    });
    $('#sarching').keyup(function(e){
        if(e.keyCode == 13)
        {
            $(this).trigger("enterKey");
        }
    });

    $(document).on('click','#changestatusOk',function(e){
        e.preventDefault();
        orderID = $(this).attr("class");
        if (confirm('از تغییر استیت این مقاله مطمعنید؟')){
            $.get("changestatus.php", {orderID:orderID, status:1 , typ:3}, function (data, status) {
                if (data=="0"){
                    alert("عملیات مورد نظر انجام نشد.");
                }
                else{
                    str = '.status' + orderID;
                    $(str, document).html('تایید شده');
                    $(str, document).css({'color':'green'});
                    alert("عملیات مورد نظر با موفقیت انجام شد.");
                }
            });
        }
    });
    $(document).on('click','#changestatusNO',function(e){
        e.preventDefault();
        orderID = $(this).attr("class");
        if (confirm('از تغییر استیت این مقاله مطمعنید؟')){
            $.get("changestatus.php", {orderID:orderID, status:0 , typ:3}, function (data, status) {
                if (data=="0"){
                    alert("عملیات مورد نظر انجام نشد.");
                }
                else{
                    str = '.status' + orderID;
                    $(str, document).html('تایید نشده');
                    $(str, document).css({'color':'red'});
                    alert("عملیات مورد نظر با موفقیت انجام شد.");
                }
            });
        }
    });

    $(document).on('click','#changeverifyOk',function(e){
        e.preventDefault();
        orderID = $(this).attr("class");
        if (confirm('از تغییر استیت این مقاله مطمعنید؟')){
            $.get("changestatus.php", {orderID:orderID, status:1 , typ:4}, function (data, status) {
                if (data=="0"){
                    alert("عملیات مورد نظر انجام نشد.");
                }
                else{
                    str = '.verify' + orderID;
                    $(str, document).html('تایید شده');
                    $(str, document).css({'color':'green'});
                    alert("عملیات مورد نظر با موفقیت انجام شد.");
                }
            });
        }
    });
    $(document).on('click','#changeverifyNO',function(e){
        e.preventDefault();
        orderID = $(this).attr("class");
        if (confirm('از تغییر استیت این مقاله مطمعنید؟')){
            $.get("changestatus.php", {orderID:orderID, status:0 , typ:4}, function (data, status) {
                if (data=="0"){
                    alert("عملیات مورد نظر انجام نشد.");
                }
                else{
                    str = '.verify' + orderID;
                    $(str, document).html('تایید نشده');
                    $(str, document).css({'color':'red'});
                    alert("عملیات مورد نظر با موفقیت انجام شد.");
                }
            });
        }
    });

    $(document).on('change','#category',function(e){
        e.preventDefault();
        status = $(this).find(":selected").val();
        statustemp=status;
        orderID = $(this).find(":selected").attr('class');
        if (confirm('از تغییر استیت این کامنت مطمعنید؟')){
            $.get("changestatus.php", {orderID:orderID, status:status , typ:5}, function (data, status) {
                if (data=="0"){
                    alert("عملیات مورد نظر انجام نشد.");
                }
                else{
                    alert("عملیات مورد نظر با موفقیت انجام شد.");
                }
            });
        }
    });

    $(document).on('change','#eshterak',function(e){
        e.preventDefault();
        status = $(this).find(":selected").val();
        statustemp=status;
        orderID = $(this).find(":selected").attr('class');
        if (confirm('از تغییر استیت این کامنت مطمعنید؟')){
            $.get("changestatus.php", {orderID:orderID, status:status , typ:6}, function (data, status) {
                if (data=="0"){
                    alert("عملیات مورد نظر انجام نشد.");
                }
                else{
                    alert("عملیات مورد نظر با موفقیت انجام شد.");
                }
            });
        }
    });

});

function confirming() {
    return confirm('آیا از حذف این مورد مطمعن هستید؟');
}
function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}