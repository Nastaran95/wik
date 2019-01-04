$(document).ready(function () {

    $(document).on('click touchstart',".paginationoldPapers1",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        var li = document.getElementById('replacepagination1');
        wr = li.className;
        $.get("getPage.php", {page:page , typ:2 , writer: wr}, function (res) {
            $("#replacepagination1").html(res);
        });
    });

    $(document).on('click touchstart',".paginationoldPapers2",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        var li = document.getElementById('replacepagination2');
        ds = li.className;
        $.get("getPage.php", {page:page , typ:3 , daste: ds}, function (res) {
            $("#replacepagination2").html(res);
        });
    });


});
