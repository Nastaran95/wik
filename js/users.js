jQuery(document).ready(function($) {


    $(document).on('click touchstart',".paginationoldPapers",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        $.get("/getPage.php", {page:page , typ:6 , TMP:makeid()}, function (res) {
            $("#replacepagination").html(res);
        });
    });



});


function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
