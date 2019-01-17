var range, page, category;
$(document).ready(function() {
    range = $("#limit").find(":selected").text();
    type=$("input[name='type']").val();
    $.get("allUsersRequestPagination.php", {page:1, limit:range,type:type,query:"=====+++=====",category:"all"}, function (data, status) {
        $("#results").html(data);
    });
    //executes code below when user click on pagination links
    $("#results").on( "click", ".pagination a", function (e){
        e.preventDefault();
        $(".loading-div").show(); //show loading element
        page = $(this).attr("data-page"); //get page number from link
        $.get("allUsersRequestPagination.php", {page:page, limit:range,type:type,query:"=====+++=====",category:"all"}, function (data, status) {
            $(".loading-div").hide(); //show loading element
            $("#results").html(data);
        });

    });
    $(document).on('change','#limit',function(e){
        e.preventDefault();
        $(".loading-div").show(); //show loading element
        range = $("#limit").find(":selected").text();
        $.get("allUsersRequestPagination.php", {page:1, limit:range,type:type,query:"=====+++=====",category:"all"}, function (data, status) {
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
        $.get("allUsersRequestPagination.php", {page:1, limit:range,type:type,query:searchdata,category:"all"}, function (data, status) {
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
    $(document).on('change','.status',function(e){
        e.preventDefault();
        status = $(this).find(":selected").val();
        statustemp=status;
        orderID = $(this).find(":selected").attr('class');
        if (confirm('از تغییر استیت این کامنت مطمعنید؟')){
            $.get("changestatus.php", {orderID:orderID, status:status}, function (data, status) {
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