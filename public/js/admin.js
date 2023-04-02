$("#clearCache, .disable-pjax").click(function() {
  var href = $(this).attr("data-href");
  window.open(href, "_self");
});

$("#homePage").click(function() {
  var href = $(this).attr("data-href");
  window.open(href, "_blank");
});

$(".logo").click(function() {
  window.open("/admin", "_self");
});

$(".external").click(function() {
  var href = $(this).attr("data-href");
  window.open(href, "_blank");
});

$('.zoom').hover(function() {
  $(this).addClass('transition');
}, function() {
  $(this).removeClass('transition');
});

$("#currency_refresh").click(function() {
  var btn = $(this);
  btn.find('i').addClass("fa-spin");
  $.get("/admin/api/refresh_currency/", function( data ) {
    if (data=="OK") {
      btn.find('i').removeClass("fa-spin");
    }
  });
});

$(document).on("pjax:complete", function() {
  myFunction();
});

$(document).on("pjax:success", function(){
  myFunction();
});


$(function () {
  myFunction();
});

function myFunction() {
  $(".selectpicker").selectpicker({
    width: "fit",
  });

  $(".selectpicker-auto").selectpicker({
    width: "100%",
  });

  $('.datetime').parent().datetimepicker({"format":"YYYY-MM-DD HH:mm:ss","locale":"tr","allowInputToggle":true});

  $( ".btn-reply-email" ).click(function() {
    var email = $("#reply-email").html();
    var subject = $("#message-subject").html();
    var body = ">" + $("#message-body").html();
    var uri = "https://mail.yandex.com.tr/compose?mailto=" + email + "?subject=";
    uri += encodeURIComponent(subject);
    uri += "&body=";
    uri += encodeURIComponent(body);
    window.open(uri);
  });
}

var simmde = document.getElementById("simplemde");
if (simmde) {
  var simplemde = new SimpleMDE({
    element: document.getElementById("simplemde"),
    hideIcons: ["guide", "fullscreen", "side-by-side", "preview"],
    parsingConfig: {
      allowAtxHeaderWithoutSpace: true,
      strikethrough: true,
      underscoresBreakWords: true,
    },
    promptURLs: false,
    spellChecker: false,
      tabSize: 4,
  });
}

var simmdeno = document.getElementById("simplemde-notoolbar");
if (simmdeno) {
  var simplemdeNoToolbar = new SimpleMDE({
    element: document.getElementById("simplemde-notoolbar"),
    status: false,
    toolbar: false,
  });
}