var form = $("#signup-form").show();
 
form.steps({
    headerTag: "h3",
    bodyTag: "section",
    titleTemplate: '#title#',
    transitionEffect: "slideLeft",
    labels: {
        cancel: "İptal",
        current: "",
        pagination: "Sayfa",
        finish: "<i class=\"fa fa-check\"></i> Kaydı Tamamla",
        next: "Devam <i class=\"fa fa-angle-right\"></i>",
        previous: "<i class=\"fa fa-angle-left\"></i> Geri",
        loading: "Yükleniyor..."
    },
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.is-danger").remove();
            form.find(".body:eq(" + newIndex + ") .is-danger").removeClass("is-danger");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
}).validate({
    errorClass: "is-danger",
    errorElement: "p",
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});

$("#btnKurumsal").click(function () {
    $(this).addClass("is-selected is-primary");
    $("#btnBireysel").removeClass("is-selected is-primary");
    $("#user_type").val("1");
    $("#bireysel").hide();
    $("#kurumsal").show();
    $("#bireysel :input").prop("disabled", true);
    $("#kurumsal :input").prop("disabled", false);
});

$("#btnBireysel").click(function () {
    $(this).addClass("is-selected is-primary");
    $("#btnKurumsal").removeClass("is-selected is-primary");
    $("#user_type").val("2");
    $("#kurumsal").hide();
    $("#bireysel").show();
    $("#bireysel :input").prop("disabled", false);
    $("#kurumsal :input").prop("disabled", true);
});