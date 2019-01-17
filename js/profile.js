jQuery(document).ready(function($) {

    $('#OpenImgUpload').click(function () {
        $('#imgupload').trigger('click');
    });


    $(".btn-success").click(function () {
        if (confirm('آیا از انجام این کار مطمئین هستید؟')) {
            $("#editor122").val($('#edit').froalaEditor('html.get'));
        }
    });

    $(document).on('click touchstart',".paginationoldPapers1",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        var li = document.getElementById('replacepagination1');
        wr = li.className;
        $.get("/getPage.php", {page:page , typ:4 , writer: wr , TMP:makeid()}, function (res) {
            $("#replacepagination1").html(res);
        });
    });

    $(document).on('click touchstart',".delete",function (event) {
        return (confirm('آیا از انجام این کار مطمئین هستید؟'));
    });

    
});


function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#userPic')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}