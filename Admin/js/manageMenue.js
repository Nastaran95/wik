var range, page, category;
$(document).ready(function() {


    // $(document).on('click','#add',function(e){
    //     e.preventDefault();
    //     orderID = $(this).attr("class");
    //     if (orderID==-1)
    //         typ = 8;
    //     else
    //         typ = 9;
    //
    //     if (confirm('از اضافه شدن این مورد به DB مطمعنید؟')){
    //         $.get("changestatus.php", {orderID:orderID, typ:typ}, function (data, status) {
    //             if (data=="0"){
    //                 alert("عملیات مورد نظر انجام نشد.");
    //             }
    //             else{
    //                 alert("عملیات مورد نظر با موفقیت انجام شد.");
    //             }
    //         });
    //     }
    // });


});


function count(id) {
    x++;
}

function myFunction() {
    x++;
    var table = document.getElementById("menuTable");
    var row = table.insertRow(x);
    row.innerHTML = "<form action=\"manageMenue.php?request=-1\" method=\"post\"  class=\"form-row mt-5\" id=\""+x+"\">\n" +
        "                        <td style=\"width: 40%;\">\n" +
        "                            <div dir=\"ltr\"  >\n" +
        "                                <input type=\"text\" maxlength=\"100\" class=\"form-control w-100\"\n" +
        "                                       name=\"link\" form=\""+x+"\">\n" +
        "                            </div>\n" +
        "                        </td>\n" +
        "                        <td  style=\"width: 40%;\">\n" +
        "                            <div dir=\"rtl\" >\n" +
        "                                <input type=\"text\" maxlength=\"100\" class=\"form-control w-100\"\n" +
        "                                        name=\"name\" form=\""+x+"\"  >\n" +
        "                            </div>\n" +
        "                        </td>\n" +
        "                        <td style=\"width: 15%;\">\n" +
        "                            <div class=\"form-check-inline\">\n" +
        "                                <label class=\"form-check-label\">\n" +
        "                                    <input type=\"radio\" class=\"form-check-input\" name=\"status"+x+"\" value=\"0\" checked form = \""+x+"\" >غیر فعال\n" +
        "                                </label>\n" +
        "                            </div>\n" +
        "                            <div class=\"form-check-inline\">\n" +
        "                                <label class=\"form-check-label\">\n" +
        "                                    <input type=\"radio\" class=\"form-check-input\" name=\"status"+x+"\" value=\"1\" form = \""+x+"\"> فعال\n" +
        "                                </label>\n" +
        "                            </div>\n" +
        "                        </td>\n" +
        "                        <td style=\"width: 5%;\">\n" +
        "                            <div class=\"m-auto\">\n" +
        "                                <button type=\"submit\" class=\"btn btn-default \" form = \""+x+"\" >ذخیره</button>\n" +
        "                            </div>\n" +
        "                        </td>\n" +
        "                    </form>";
}

function confirming() {
    return confirm('آیا از حذف این مورد مطمعن هستید؟(حذف این مورد غیر قابل بازگشت است)');
}

function confirming2() {
    return confirm('آیا از درست بودن موارد لینک و نام و وضعیت این سطر اطمینان دارید؟');
}

function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}