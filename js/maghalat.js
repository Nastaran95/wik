$(document).ready(function () {

    $(document).on('click touchstart',".paginationoldPapers",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        $.get("getPage.php", {page:page , typ:1}, function (res) {
            $("#replacepagination").html(res);
            window.scrollTo(0, 1000);
        });
    });

    $(document).on('click touchstart',".srt",function (event) {
        // alert(event.target.id);
        el=event.target.id;
        if(el=='srt1'){
            $("#srt1").addClass('srt-on');
            $("#srt2").removeClass('srt-on');
        }else{
            $("#srt2").addClass('srt-on');
            $("#srt1").removeClass('srt-on');
        }
    });

    $(document).on('click touchstart',".cat",function (event) {
        // alert(event.target.id);
        el=event.target.classList;
        if(el.contains('cat-on')){
            $(event.target).removeClass('cat-on');
            if(event.target.id=='cat0'){
                $('.cat').removeClass('cat-on');
            }
        }else if(el.contains('cat')){
            $(event.target).addClass('cat-on');
            if(event.target.id=='cat0'){
                $('.cat').addClass('cat-on');
            }
        }

    });


});
