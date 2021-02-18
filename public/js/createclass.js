function htmlEncode(value) {
  return $("<div/>").text(value).html();
}

$(function () {
  $("#content").ready(function () {
    $(".qr-code").attr(
      "src",
      "https://chart.googleapis.com/chart?cht=qr&chl=" +
        htmlEncode($("#content").val()) +
        "&chs=160x160&chld=L|0"
    );
  });
});

function copy() {
  var copyText = document.getElementById("copyClipboard");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");

  $("#copied-success").fadeIn(800);
  $("#copied-success").fadeOut(800);
}
