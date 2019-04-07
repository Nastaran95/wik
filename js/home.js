$(document).ready(function () {
    var cat = [1];
    var srt = 0;

    $(document).on('click touchstart',".paginationoldPapers",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        var category = cat.join();
        $.get("/getPage.php", {page:page , typ:1 , cat :category ,sort:srt}, function (res) {
            $("#replacepagination").html(res);
            window.scrollTo(0, 1000);
        });
    });

    // $(document).on('click touchstart',"#filter",function (event) {
    //     // alert(cat);
    //     var category = cat.join();
    //     // alert(category);
    //
    //     $.get("/getPage.php", {page:1 , typ:1 , cat :category }, function (res) {
    //         $("#replacepagination").html(res);
    //         window.scrollTo(0, 1000);
    //     });
    // });

    $('.carousel').carousel({
        interval: 5000
    });
    var top_of_element=0, bottom_of_element=1, bottom_of_screen=1, top_of_screen=0, zoom=1;
    // $("#scroll").click(function() {
    //     // $('html, body').animate({
    //     //     scrollTop: $("div#main").offset().top
    //     // }, 100);
    //     $(".fixed2").removeClass('d-none');
    //     $(".fixed1").addClass('d-none');
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
            $(".fixed2").addClass('d-none');
            $(".fixed1").removeClass('d-none');
            // $(".home_main").css('margin-top', '100');
            // $(".header").removeClass('headerfix');
        }
        else {
            $(".fixed2").removeClass('d-none');
            $(".fixed1").addClass('d-none');
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

            $("#srt1 .checkmarkk").addClass('d-inline-block');
            $("#srt2 .checkmarkk").removeClass('d-inline-block');

            $("#srt2 .checkmarkk").addClass('d-none');
            $("#srt1 .checkmarkk").removeClass('d-none');
            srt = 1;
            var category = cat.join();
            $.get("/getPage.php", {page:1 , typ:1 , cat :category ,sort:srt }, function (res) {
                $("#replacepagination").html(res);
            });
        }else if(el=='srt2'){
            $("#srt2").addClass('srt-on');
            $("#srt1").removeClass('srt-on');

            $("#srt2 .checkmarkk").addClass('d-inline-block');
            $("#srt1 .checkmarkk").removeClass('d-inline-block');

            $("#srt1 .checkmarkk").addClass('d-none');
            $("#srt2 .checkmarkk").removeClass('d-none');
            srt = 0;
            var category = cat.join();
            $.get("/getPage.php", {page:1 , typ:1 , cat :category ,sort:srt }, function (res) {
                $("#replacepagination").html(res);
            });
        }
    });

    $(document).on('click touchstart',".check",function (event) {
        // alert('yes');
        iddd = $(this).attr("id");
        idd= iddd.substr(5);
        sel = '#'+idd;
        $(sel).click();

    });

    $(document).on('click touchstart',".cat",function (event) {
        iddd = event.target.id;
        idd= iddd.substr(3);
        sel = '#cat'+idd+' .checkmarkk';
        sel2 = '#name'+idd;
        el=event.target.classList;
        // if(el.contains('cat-on')){
            // $(event.target).removeClass('cat-on');
            // $(sel).removeClass('d-inline-block');
            // $(sel).addClass('d-none');
            // if(event.target.id=='cat0' ){
            //     $('.cat').removeClass('cat-on');
            //     $('#cat1').addClass('cat-on');
            //
            //     $('.cat .checkmarkk').removeClass('d-inline-block');
            //     $('#cat1 .checkmarkk').addClass('d-inline-block');
            //
            //     $('.cat .checkmarkk').addClass('d-none');
            //     $('#cat1 .checkmarkk').removeClass('d-none');
            //     cat = [1];
            // }
            // else {
            //     for (var i = 0; i < cat.length ; i++) {
            //         if (cat[i] == idd) {
            //             cat.splice(i, 1);
            //         }
            //     }
            // }
            // if(cat.length==0){
            //     $('#cat1').addClass('cat-on');
            //     $('#cat1 .checkmarkk').addClass('d-inline-block');
            //     $('#cat1 .checkmarkk').removeClass('d-none');
            //     cat = [1];
            // }
            // var category = cat.join();
            // $.get("/getPage.php", {page:1 , typ:1 , cat :category ,sort:srt}, function (res) {
            //     $("#replacepagination").html(res);
            //     window.scrollTo(0, 1000);
            // });

        // }else if(el.contains('cat')){
        if(idd.length>0) {
            if (event.target.id == 'cat0') {
                $('.cat').addClass('cat-on');
                $('.cat .checkmarkk').addClass('d-inline-block');
                $('.cat .checkmarkk').removeClass('d-none');
                cat = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
            }
            else {
                $('.cat').removeClass('cat-on');
                $('.cat .checkmarkk').removeClass('d-inline-block');
                $('.cat .checkmarkk').addClass('d-none');
                // cat.push(idd);
                cat = [idd];
            }

            $(event.target).addClass('cat-on');
            $(sel).removeClass('d-none');
            $(sel).addClass('d-inline-block');

            var category = cat.join();
            $.get("/getPage.php", {page: 1, typ: 1, cat: category, sort: srt}, function (res) {
                $("#replacepagination").html(res);
                window.scrollTo(0, 1200);
            });
            $('#tit').html (  "مقالات ("+$(sel2).html()+")" );
        }
        // }

    });
});