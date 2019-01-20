jQuery(document).ready(function($) {

    $('#OpenImgUpload').click(function () {
        $('#imgupload').trigger('click');
    });


    $(".btn-success").click(function () {
        if (confirm('آیا از انجام این کار مطمئین هستید؟')) {
            $("#editor122").val($('#edit').froalaEditor('html.get'));
            return true;
        }
        else
            return false;
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
        // tabcontent[i].style.display = "none";
        tabcontent[i].classList.remove("d-block");
        tabcontent[i].classList.add("d-none");
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    // document.getElementById(cityName).style.display = "block";

    document.getElementById(cityName).classList.add("d-block");
    document.getElementById(cityName).classList.remove("d-none");

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

function confirming() {
    return confirm('آیا از حذف بسته خود مطمعن هستید؟(حذف این مورد غیر قابل بازگشت است)');
}

function confirming2() {
    return confirm('آیا از درست بودن بسته اشتراک انتخابی اطمینان دارد؟ در صورت تایید اگر در حال حاضر بسته فعالی دارید غیر فعال خواهد شد.');
}