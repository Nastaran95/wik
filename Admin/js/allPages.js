var range, page, category;
$(document).ready(function() {

});

function confirming() {
    return confirm('آیا از حذف این مورد مطمعن هستید؟');
}
function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}