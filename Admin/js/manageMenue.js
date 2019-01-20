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
    y++;
    if(id>x)
        x=id;
}

function myFunction() {
    x++;
    y++;
    var table = document.getElementById("menuTable");
    var row = table.insertRow(y);
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



function myFunction2() {
    x++;
    y++;
    var table = document.getElementById("menuTable");
    var row = table.insertRow(y);
    row.innerHTML = "<form action=\"manageUsersCategory.php?request=-1\" method=\"post\"  class=\"form-row mt-5\" id=\""+x+"\">\n" +
        "                            <td  style=\"width: 40%;\">\n" +
        "                                <div dir=\"rtl\" >\n" +
        "                                    <input type=\"text\" maxlength=\"100\" class=\"form-control w-100\"\n" +
        "                                            name=\"name\"  form=\""+x+"\">\n" +
        "                                </div>\n" +
        "                            </td>\n" +
        "\n" +
        "                            <td style=\"width: 5%;\">\n" +
        "                                <div class=\"m-auto\">\n" +
        "                                    <button type=\"submit\" class=\"btn btn-default \" onclick=\"return confirming2();\" form=\""+x+"\" >ذخیره</button>\n" +
        "                                </div>\n" +
        "                            </td>\n" +
        "                            </form>";
}

function myFunction3() {
    x++;
    y++;
    var table = document.getElementById("menuTable");
    var row = table.insertRow(y);
    row.innerHTML = "<form action=\"managePapersCategory.php?request=-1\" method=\"post\"  class=\"form-row mt-5\" id=\""+x+"\">\n" +
        "                            <td  style=\"width: 40%;\">\n" +
        "                                <div dir=\"rtl\" >\n" +
        "                                    <input type=\"text\" maxlength=\"100\" class=\"form-control w-100\"\n" +
        "                                            name=\"name\"  form=\""+x+"\">\n" +
        "                                </div>\n" +
        "                            </td>\n" +
        "\n" +
        "                            <td style=\"width: 5%;\">\n" +
        "                                <div class=\"m-auto\">\n" +
        "                                    <button type=\"submit\" class=\"btn btn-default \" onclick=\"return confirming2();\" form=\""+x+"\" >ذخیره</button>\n" +
        "                                </div>\n" +
        "                            </td>\n" +
        "                            </form>";
}

function myFunction4() {
    x++;
    y++;
    var table = document.getElementById("menuTable");
    var row = table.insertRow(y);
    row.innerHTML = "<form action=\"manageUsersEshterak.php?request=-1\" method=\"post\"  class=\"form-row mt-5\" id=\""+x+"\">\n" +
        "                                <td  style=\"width: 40%;\">\n" +
        "                                    <div dir=\"rtl\" >\n" +
        "                                        <input type=\"text\" maxlength=\"100\" class=\"form-control w-100\"\n" +
        "                                                name=\"name\"  form=\""+x+"\">\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "                                <td  style=\"width: 40%;\">\n" +
        "                                    <div dir=\"rtl\" >\n" +
        "                                        <textarea rows=\"10\" maxlength=\"300\" name=\"tozihat\" class=\"form-control w-100\" form=\""+x+"\">  </textarea>\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "\n" +
        "                                <td style=\"width: 5%;\">\n" +
        "                                    <div class=\"m-auto\">\n" +
        "                                        <button type=\"submit\" class=\"btn btn-default \" onclick=\"return confirming4();\" form=\""+x+"\" >ذخیره</button>\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "                            </form>";
}

function myFunction5() {
    x++;
    y++;
    var table = document.getElementById("menuTable");
    var row = table.insertRow(y);
    row.innerHTML = "<form action=\"manageSlider.php?request=-1\" method=\"post\"  class=\"form-row mt-5\" id=\""+x+"\" enctype=\"multipart/form-data\" >\n" +
        "                                <td  style=\"width: 30%;\">\n" +
        "                                    <div dir=\"rtl\" >\n" +
        "                                        <img src=\"\" class=\"w-100\" id=\"img"+x+"\">\n" +
        "                                        <input name=\"img\" onchange=\"readURL(this);\"\n" +
        "                                               accept=\"image/jpeg,image/gif,image/png\"\n" +
        "                                               class=\"filestyle form-control w-100 mt-2\" type=\"file\" data-icon=\"false\"  form=\""+x+"\">\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "                                <td  >\n" +
        "                                    <div dir=\"rtl\" >\n" +
        "                                        <input type=\"text\" maxlength=\"100\" class=\"form-control w-100\"\n" +
        "                                               name=\"name\"   form=\""+x+"\">\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "                                <td  >\n" +
        "                                    <div dir=\"rtl\" >\n" +
        "                                        <textarea rows=\"8\" maxlength=\"300\" name=\"tozihat\" class=\"form-control w-100\" form=\""+x+"\">  </textarea>\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "\n" +
        "                                <td  >\n" +
        "                                    <div dir=\"rtl\" >\n" +
        "                                        <input type=\"text\" maxlength=\"100\" class=\"form-control w-100\"\n" +
        "                                               name=\"link\" form=\""+x+"\">\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "\n" +
        "                                <td  >\n" +
        "                                    <div dir=\"rtl\" >\n" +
        "                                        <input type=\"text\" maxlength=\"100\" class=\"form-control w-100\"\n" +
        "                                               name=\"alt\"  form=\""+x+"\">\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "                                <td >\n" +
        "                                    <div class=\"form-check-inline\">\n" +
        "                                        <label class=\"form-check-label\">\n" +
        "                                            <input type=\"radio\" class=\"form-check-input\" name=\"status\" value=\"0\" checked form=\""+x+"\">غیر فعال\n" +
        "                                        </label>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"form-check-inline\">\n" +
        "                                        <label class=\"form-check-label\">\n" +
        "                                            <input type=\"radio\" class=\"form-check-input\" name=\"status\" value=\"1\"  form=\""+x+"\">فعال\n" +
        "                                        </label>\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "\n" +
        "                                <td style=\"width: 5%;\">\n" +
        "                                    <div class=\"d-flex\">\n" +
        "                                        <button type=\"submit\" class=\"btn p-0 m-0 \" onclick=\"return confirming2();\" form=\""+x+"\" >\n" +
        "                                            <span class=\"fa-stack\">\n" +
        "                                                <i class=\"fa fa-square fa-stack-2x text-success\"></i>\n" +
        "                                                <i class=\"far fa-check-square fa-stack-1x fa-inverse\"></i>\n" +
        "                                            </span>\n" +
        "                                        </button>\n" +
        "                                    </div>\n" +
        "                                </td>\n" +
        "                            </form>";
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


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        str = '#img'+input.getAttribute('form');
        reader.onload = function (e) {
            $(str)
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}