$(document).ready(function () {

    $(document).on('click touchstart',".paginationoldPapers",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        $.get("getPage.php", {page:page , typ:1}, function (res) {
            $("#replacepagination").html(res);
            window.scrollTo(0, 1000);
        });
    });

    $('.carousel').carousel({
        interval: 5000
    });
    var top_of_element=0, bottom_of_element=1, bottom_of_screen=1, top_of_screen=0, zoom=1;
    // $("#scroll").click(function() {
    //     // $('html, body').animate({
    //     //     scrollTop: $("div#main").offset().top
    //     // }, 100);
    //     $(".fixed2").removeClass('hide');
    //     $(".fixed1").addClass('hide');
    //     // $(".home_main").css('top', '200px');
    // });

    $(window).scroll(function() {
        if (zoom>1.49)
            return ;
        top_of_element = $(".coverMain").offset().top;
        bottom_of_element = $(".coverMain").offset().top + $(".coverMain").outerHeight()-100;
        bottom_of_screen = $(window).scrollTop() + window.innerHeight;
        top_of_screen = $(window).scrollTop();

        if((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
            // The element is visible, do something
            $(".fixed2").addClass('hide');
            $(".fixed1").removeClass('hide');
            // $(".home_main").css('margin-top', '100');
            // $(".header").removeClass('headerfix');
        }
        else {
            $(".fixed2").removeClass('hide');
            $(".fixed1").addClass('hide');
            // $(".home_main").css('margin-top', '125px');
            // $(".header").addClass('headerfix');
        }
    });

    $(window).resize(function() {
        $(window).trigger('zoom');
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
