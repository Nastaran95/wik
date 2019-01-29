jQuery(document).ready(function($) {

    $('#OpenImgUpload').click(function () {
        $('#imgupload').trigger('click');
    });


    $(document).on('click touchstart',".paginationoldPapers1",function (event) {
        // alert(event.target.id);
        page=event.target.id;
        var li = document.getElementById('replacepagination1');
        wr = li.className;
        $.get("/getPage.php", {page:page , typ:5 , writer: wr , TMP:makeid()}, function (res) {
            $("#replacepagination1").html(res);
        });
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

function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
