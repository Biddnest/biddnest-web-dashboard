/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */
$.delete = function(url, data, callback, type){
    if ( $.isFunction(data) ){
        type = type || callback,
            callback = data,
            data = {}
    }
    return $.ajax({
        url: url,
        type: 'DELETE',
        success: callback,
        data: data,
        contentType: type
    });
}

Logger.useDefaults();

// const helper = import("./helpers.js");
import { redirectTo, redirectHard, tinySuccessAlert, inlineAlert, megaAlert, tinyAlert, revertFormAnim, triggerFormAnim } from "./helpers.js";
// require("./helpers");
const env = "development";

/* Initializations */
// const logger = $.Logger();

if (env != "development")
    Logger.setLevel(Logger.OFF);


/* AJAX Universal */
$("body").on('submit', "form", function() {
    // Logger.info("form called");
    // console.log();
    // var valid = $(this).parsley().validate();


    if (true) {
        let form = $(this);
        let requestData = form.serializeJSON();
        let button = form.find("button[type=submit]");
        let buttonPretext = button.html();
        Logger.info("Loggin request payload", requestData);

        $.ajax({
            url: form.attr("action"),
            method: form.attr("method"),
            data: JSON.stringify(requestData),
            contentType: "application/json",
            beforeSend: () => {
                triggerFormAnim(button);
            },
            success: (response) => {

                // console.log("Response ",response);
                Logger.info("Response ", response);
                if (response.status == "success") {
                    tinySuccessAlert("Success", response.message);
                    if (form.data("next")) { //   data-next="redirect"
                        if (form.data("next") == "redirect") {
                            if (form.hasClass("add-slider")) {
                                var url = form.data('url');
                                url = url.replace(':id', response.data.slider.id);
                                redirectTo(url);
                                return false;
                            }
                            if (form.hasClass("onboard-vendor-form")) {
                                var url = form.data('url');
                                url = url.replace(':id', response.data.organization.id);
                                redirectTo(url);
                                return false;
                            }
                            if (form.data('redirect-type') == "hard")
                                redirectHard(form.data("url")); // data-url="google.com"
                            else
                                redirectTo(form.data("url"));
                        } else if (form.data("next") == "refresh") {
                            location.reload();
                        }
                    }
                } else if (response.status == "fail") {

                    if (form.data("alert") == "tiny")
                        tinyAlert("Oops", response.message);
                    else if (form.data("alert") == "inline")
                        inlineAlert(form, response.message);
                    else
                        megaAlert("Oops", response.message);

                } else {
                    Logger.info(response.message);
                }
            },
            error: (error, b, c) => {
                Logger.info(error.responseText);
                megaAlert("Oops", "Something went wrong in server. Please try again later.");
            },
        });
        revertFormAnim(button, buttonPretext);
        return false;
    } else {
        //Do something here
    }
});

$("body").on('click', ".file-upload button", function() {
    if ($(this).data('action') == "upload") {
        $(this).parent().find("input[type=file]").click();
    } else {
        $(".upload-preview").attr("src", IMAGE_PLACEHOLDER);
        // $(this).html("UPLOAD IMAGE");
    }
});

$("body").on('input', "input[type=file]", function(event) {
    // var thiss = $(this);
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onloadend = () => {
        $(this).closest('.upload-section').find(".upload-preview").attr("src", reader.result);
        $(this).parent().find(".base-holder").val(reader.result);
        $(this).parent().find(".btn").html("CHANGE");
    };
    reader.readAsDataURL(file);

    var fullPath = $(this).val();
    if (fullPath) {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        $(this).closest(".upload-section").find(".file-name").html(filename);
    }
});

$("body").on('change', ".field-toggle", function(event) {
    if ($(this).val() == $(this).data("value")) {
        $($(this).data("target")).removeClass("hidden");
        $($(this).data("target")).find(".form-control").attr("required", "required");
    } else {
        $($(this).data("target")).addClass("hidden");
        $($(this).data("target")).find(".form-control").removeAttr("required");
    }
});


$("body").on('click', ".repeater", function(event) {
    $($(this).data("container")).slideDown(200).append($($(this).data('content')).html());
    $(".hide-on-data").fadeOut(100);
});

$("body").on('click', ".closer", function(event) {
    if(confirm('Are sure want to remove this? If you proceed, you may need to use the save button to save changes permanently.')) {
        $(this).closest($(this).data("parent")).fadeOut(100).remove();
    }
    return false;
});

$("body").on('click', ".modal-toggle", function(event) {
    console.log("sda");
    $($(this).data("target")).fadeIn(100).show();
    return false;
});
$("body").on('click', ".fullscreen-modal-body .close", function(event) {
    console.log("close");
    $($(this).closest(".fullscreen-modal")).fadeOut(100).hide();
    return false;
});


$("body").on('change', ".inventory-select", function(event) {
    console.log("change");
    var id=$(this).val();

    $(this).closest(".inventory-snip").find(".material").html('<option value="">--Select--</option>');
    $(this).closest(".inventory-snip").find(".size").html('<option value="">--Select--</option>');

    var materal=$("#inventory_"+id).data("material");
    var size=$("#inventory_"+id).data("size");
    materal.map((value)=>{
        $(this).closest(".inventory-snip").find(".material").append('<option value="'+value+'">'+value+'</option>')
    });
    size.map((value)=>{
        $(this).closest(".inventory-snip").find(".size").append('<option value="'+value+'">'+value+'</option>')
    });
    return false;
});

$("body").on('click', ".delete", function(event) {
    if(confirm($(this).data('confirm'))) {
        // $(this).closest($(this).data("parent")).fadeOut(100).remove();
        var target =  $(this).closest($(this).data("parent"));
        $.delete($(this).data("url"), {}, function (response){
            // console.log(response);
            if(response.status == "success")
            {
                tinySuccessAlert("Deleted Successfully", response.message);
                target.hide();
            }
            else
            {
                tinyAlert("Failed", response.message);
            }

        });
    }
    return false;
});


