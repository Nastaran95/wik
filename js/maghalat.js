$(document).ready(function () {
    var cat = [1,2,3,4,5,6,7,8,9,10,11];
    var srt = 0;

    $(document).on('click touchstart',".paginationoldPapers",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        var category = cat.join();
        $.get("getPage.php", {page:page , typ:1,cat:category ,sort:srt}, function (res) {
            $("#replacepagination").html(res);
        });
    });

    $(document).on('click touchstart',".srt",function (event) {
        // alert(event.target.id);
        el=event.target.id;
        if(el=='srt1'){
            $("#srt1").addClass('srt-on');
            $("#srt2").removeClass('srt-on');

            $("#srt1 .checkmark").addClass('d-inline-block');
            $("#srt2 .checkmark").removeClass('d-inline-block');

            $("#srt2 .checkmark").addClass('d-none');
            $("#srt1 .checkmark").removeClass('d-none');
            srt = 1;
            var category = cat.join();
            $.get("/getPage.php", {page:1 , typ:1 , cat :category ,sort:srt }, function (res) {
                $("#replacepagination").html(res);
            });
        }else if(el=='srt2'){
            $("#srt2").addClass('srt-on');
            $("#srt1").removeClass('srt-on');

            $("#srt2 .checkmark").addClass('d-inline-block');
            $("#srt1 .checkmark").removeClass('d-inline-block');

            $("#srt1 .checkmark").addClass('d-none');
            $("#srt2 .checkmark").removeClass('d-none');


            srt = 0 ;
            var category = cat.join();
            $.get("/getPage.php", {page:1 , typ:1 , cat :category ,sort:srt}, function (res) {
                $("#replacepagination").html(res);
            });
        }
    });

    $(document).on('click touchstart',".cat",function (event) {
        iddd = event.target.id;
        idd= iddd.substr(3);
        sel = '#cat'+idd+' .checkmark';
        // alert(sel);
        el=event.target.classList;
        if(el.contains('cat-on')){
            $(event.target).removeClass('cat-on');
            $(sel).removeClass('d-inline-block');
            $(sel).addClass('d-none');
            if(event.target.id=='cat0' ){
                $('.cat').removeClass('cat-on');
                $('#cat1').addClass('cat-on');

                $('.cat .checkmark').removeClass('d-inline-block');
                $('#cat1 .checkmark').addClass('d-inline-block');

                $('.cat .checkmark').addClass('d-none');
                $('#cat1 .checkmark').removeClass('d-none');
                cat = [1];
            }
            else {
                for (var i = 0; i < cat.length ; i++) {
                    // alert(i);
                    if (cat[i] == idd) {
                        cat.splice(i, 1);
                    }
                }
            }
            if(cat.length==0){
                $('#cat1').addClass('cat-on');
                $('#cat1 .checkmark').addClass('d-inline-block');
                $('#cat1 .checkmark').removeClass('d-none');
                cat = [1];
            }
            var category = cat.join();
            $.get("/getPage.php", {page:1 , typ:1 , cat :category ,sort:srt}, function (res) {
                $("#replacepagination").html(res);
            });

        }else if(el.contains('cat')){
            $(event.target).addClass('cat-on');
            $(sel).removeClass('d-none');
            $(sel).addClass('d-inline-block');
            if(event.target.id=='cat0'){
                $('.cat').addClass('cat-on');
                $('.cat .checkmark').addClass('d-inline-block');
                $('.cat .checkmark').removeClass('d-none');
                cat = [1,2,3,4,5,6,7,8,9,10,11];
            }
            else
                cat.push(idd);
            var category = cat.join();
            $.get("/getPage.php", {page:1 , typ:1 , cat :category ,sort:srt}, function (res) {
                $("#replacepagination").html(res);
            });
        }

    });


});
