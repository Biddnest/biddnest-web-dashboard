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

$.update = function(url, data, callback, type){
    if ( $.isFunction(data) ){
        type = type || callback,
            callback = data,
            data = {}
    }
    return $.ajax({
        url: url,
        type: 'PUT',
        success: callback,
        data: data,
        contentType: type
    });
}

$.add = function(url, data, callback, type){
    if ( $.isFunction(data) ){
        type = type || callback,
            callback = data,
            data = {}
    }
    return $.ajax({
        url: url,
        type: 'POST',
        success: callback,
        data: data,
        contentType: type
    });
}


Logger.useDefaults();

// const helper = import("./helpers.js");
import { getLocationPermission, redirectTo, redirectHard, tinySuccessAlert, inlineAlert, megaAlert, tinyAlert, revertFormAnim, triggerFormAnim } from "./helpers.js";
import { initRangeSlider, initRevenueChart } from "./initFunctions.js";
// require("./helpers");
const env = "development";

/* Initializations */
// const logger = $.Logger();

if (env != "development")
    Logger.setLevel(Logger.OFF);


// getLocationPermission();

/* AJAX Universal */
$("body").on('submit', "form", function() {
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
                            if (form.hasClass("vendor-pass-reset")) {
                                var url = form.data('url');
                                // Logger.info(url);
                                url = url.replace(':phone', response.data.vendor.phone);
                                // Logger.info(url);
                                redirectTo(url);
                                return false;
                            }
                            if (form.hasClass("onboard-vendor-form")) {
                                var url = form.data('url');
                                url = url.replace(':id', response.data.organization.id);
                                redirectTo(url);
                                return false;
                            }
                            if (form.hasClass("user-form")) {
                                var url = form.data('url');
                                url = url.replace(':id', response.data.admin.id);
                                redirectTo(url);
                                return false;
                            }
                            if (form.hasClass("verify-otp-form")) {
                                var url = form.data('url');
                                url = url.replace(':id', response.data.otp.id);
                                redirectTo(url);
                                return false;
                            }
                            if (form.hasClass("order_create")) {
                                var url = form.data('url');
                                url = url.replace(':id', response.data.booking.id);
                                redirectTo(url);
                                return false;
                            }
                            if (form.data('redirect-type') == "hard")
                                redirectHard(form.data("url")); // data-url="google.com"
                            else
                                redirectTo(form.data("url"));
                        } else if (form.data("next") == "refresh") {
                            location.reload();
                        }else if (form.data("next") == "modal") {
                            $(form.data(".modal-id")).modal();
                        }
                    }
                } else if (response.status == "fail") {

                    if (form.data("alert") == "tiny")
                        tinyAlert("Oops", response.message);
                    else if (form.data("alert") == "inline")
                        inlineAlert(form, response.message);
                    else
                        megaAlert("Oops", response.message);

                    revertFormAnim(button, buttonPretext);
                } else {
                    Logger.info(response.message);
                    revertFormAnim(button, buttonPretext);
                }
            },
            error: (error, b, c) => {
                Logger.info(error.responseText);
                megaAlert("Oops", "Something went wrong in server. Please try again later.");
                revertFormAnim(button, buttonPretext);
            },
        });

        return false;

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
    console.log('show');
    $(".hide-on-data").fadeOut(100);
    initRangeSlider();
    var id=$(".category-select").val();
    var type=$("#sub_"+id).data("type");
    if(type == 0)
    {
        $(".fixed").removeClass("hidden");
        $(".range").parent().addClass("hidden");
        $(".fixed").attr("required", "required");
        $(".fixed").attr("name", "inventory_items[][quantity]");
        $(".range").removeAttr("name");
    }
    if(type == 1)
    {
        $(".fixed").addClass("hidden");
        $(".range").parent().removeClass("hidden");
        $(".range").attr("required", "required");
        $(".range").attr("name", "inventory_items[][quantity]");
        $(".fixed").removeAttr("name");
    }
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
    // $($(this).data("modal")).toggleClass("show");
    return false;
});
$("body").on('click', ".fullscreen-modal-body .close", function(event) {
    console.log("close");
    $($(this).closest(".fullscreen-modal")).fadeOut(100).hide();
    return false;
});

$("body").on('click', ".fullscreen-modal-body .cancel", function(event) {
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

$("body").on('change', ".category-select", function(event) {
    console.log("change");
    var id=$(this).val();

    $(this).closest(".d-flex").find(".subservices").html('<option value="">--Select--</option>');

    var materal=$("#sub_"+id).data("subcategory");

    materal.map((value)=>{
        $(this).closest(".d-flex").find(".subservices").append('<option value="'+value['id']+'">'+value['name']+'</option>')
    });

    var type=$("#sub_"+id).data("type");
    if(type == 0)
    {
        $(this).closest(".d-flex").find(".fixed").removeClass("hidden");
        $(this).closest(".d-flex").find(".range").parent().addClass("hidden");
        $(this).closest(".d-flex").find(".fixed").attr("required", "required");
        $(this).closest(".d-flex").find(".fixed").attr("name", "inventory_items[][quantity]");
        $(this).closest(".d-flex").find(".range").removeAttr("required");
        $(this).closest(".d-flex").find(".range").removeAttr("name");
    }
    if(type == 1)
    {
        $(this).closest(".d-flex").find(".fixed").addClass("hidden");
        $(this).closest(".d-flex").find(".range").parent().removeClass("hidden");
        $(this).closest(".d-flex").find(".range").attr("required", "required");
        $(this).closest(".d-flex").find(".range").attr("name", "inventory_items[][quantity]");
        $(this).closest(".d-flex").find(".fixed").removeAttr("required");
        $(this).closest(".d-flex").find(".fixed").removeAttr("name");
    }
    return false;
});

$("body").on('click', ".delete", function(event) {
    if(confirm($(this).data('confirm'))) {
        // $(this).closest($(this).data("parent")).fadeOut(100).remove();
        var target =  $(this).closest($(this).data("parent"));
        $.delete($(this).data("url"), {}, function (response){
            console.log(response);
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

$("body").on('click', ".sidebar-toggle td:not(:last-child)", function(event) {
    var $this = $(this);

    // if($(this).hasClass('no-toggle'))
        // return false;

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).parent().data("sidebar"), {}, function(response){

        $(".side-bar-pop-up").html(response);
    });
    initRevenueChart(
        console.log('graph')
    );
});

$("body").on('click', ".sidebar-toggle_slider td:not(:first-child)", function(event) {
    var $this = $(this);

    // if($(this).hasClass('no-toggle'))
        // return false;

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).parent().data("sidebar"), {}, function(response){

        $(".side-bar-pop-up").html(response);
    });
    initRevenueChart(
        console.log('graph')
    );
});


$("body").on('click', ".invsidebar", function(event) {
    var $this = $(this);

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).data("sidebar"), {}, function(response){

        $(".side-bar-pop-up").html(response);
    });


});

$("body").on('click', ".category-sidebar-toggle td:not(:nth-last-child(-n+2))", function(event) {
    var $this = $(this);

    // if($(this).hasClass('no-toggle'))
        // return false;

    $(".side-bar-pop-up").html('<div class="pop-up-preloader">\n' +
        '                    <svg class="circular" height="50" width="50">\n' +
        '                        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />\n' +
        '                    </svg>\n' +
        '                </div>');

    $('.side-bar-pop-up').addClass('display-pop-up');
    $.get($(this).parent().data("sidebar"), {}, function(response){

        $(".side-bar-pop-up").html(response);
    });

});


$("body").on('change', ".vendor-select", function(event) {
    var id=$(this).val();
    var commision=$("#org_"+id).data("comission");
    if(commision > 0)
    {
        document.getElementById("commission").value = commision;
    }
    return false;
});

$("body").on('keyup', "#amount", function(event) {
    var id=$(this).val();

    var org_id = document.getElementById("orgnizations").value;
    var commision=$("#org_"+org_id).data("comission");
    var discount = (id * commision)/ 100;
    var afterDiscount =id - discount;
    document.getElementById("payout_amount").value = afterDiscount;
    document.getElementById("commission_amount").value = discount;
    return false;
});


$("body").on('change', ".change_status", function(event) {
    var target = $(this).closest($(this).data("parent"));
    if(confirm('Are you sure want to change status?')) {
        $.update($(this).data("url"), {}, function (response) {
            console.log(response);
            if (response.status == "success") {
                tinySuccessAlert("Status changed Successfully", response.message);
                target.hide();
            } else {
                tinyAlert("Failed", response.message);
            }

        });
    }
    return false;
});

$("body").on('change', ".reply_status", function(event) {
    var data = $(this).val();
    if(confirm('Are you sure want to change status?')) {
        $.update($(this).data("url"), {data}, function (response) {
            console.log(response);
            if (response.status == "success") {
                tinySuccessAlert("Status changed Successfully", response.message);
            } else {
                tinyAlert("Failed", response.message);
            }

        });
    }
    return false;
});

$("body").on('keydown', ".table-search", function(event) {
    if(event.keyCode == 13){
        var query = $(this).val();
        if (query.length >= 3) {
            redirectTo(window.location.href + "?search=" + query);
        }
    }
});
$("body").on('keydown', ".table-search1", function(event) {
    if(event.keyCode == 13){
        var query = $(this).val();
        if (query.length >= 15) {
            redirectTo(window.location.href + "?search=" + query);
        }
    }
});

$("body").on('change', ".check-toggle", function(event) {
console.log($(this).val());
    if ($(this).val() == $(this).data("value")) {
        $(this).val("0");
        $($(this).data("target")).removeClass("hidden");
        $($(this).data("target")).find(".form-control").attr("required", "required");
    } else {
        $(this).val("1");
        $($(this).data("target")).addClass("hidden");
        $($(this).data("target")).find(".form-control").removeAttr("required");
    }
});

$("body").on('click', ".bookings", function(event) {
    var target = $(this).closest($(this).data("parent"));
    if(confirm($(this).data('confirm'))) {
        $.update($(this).data("url"), {}, function (response) {
            console.log(response);
            if (response.status == "success") {
                tinySuccessAlert($(this).data('success'), response.message);
                target.hide();
            } else {
                tinyAlert("Failed", response.message);
            }

        });
    }
    return false;
});

$("body").on('click', ".rejected", function(event) {
    Swal.fire({
        title: 'Are you sure you want to Reject this order?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#FDC403',
        confirmButtonText: 'Yes!',

    }).then((result) => {
        if (result.isConfirmed) {
            var target = $(this).closest($(this).data("parent"));
            $.update($(this).data("url"), {}, function (response) {
                console.log(response);
                if (response.status == "success") {
                    tinySuccessAlert($(this).data('success'), response.message);
                    target.hide();
                } else {
                    tinyAlert("Failed", response.message);
                }

            });
        }
    })

    return false;
});

$('.filterdate').datepicker({
    format: 'yyyy-mm-dd'
});

$("body").on('change', ".inventory-item-select", function(event) {
    console.log("change");
    var query = $(this).val();
    redirectTo($(this).data('url')+"?item="+query);
});

$("body").on('click', ".next-btn-1-admin", function(event) {

    let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each( function() {
        Logger.info(isValid);
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    Logger.info(isValid);
    if (isValid) {
        $(this).hide();
        $(this).closest('form').find('.bid-amount-admin').hide();
        $(this).closest('form').find('.bid-amount-2-admin').show();
        $(this).closest('form').find('.submitbtn-admin').show();
    }
});

$("body").on('click', ".next-btn-1", function(event) {

    /*let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each( function() {
        Logger.info(isValid);
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    Logger.info(isValid);
    if (isValid) {*/
        $(this).hide();
        $(this).closest('form').find('.bid-amount').hide();
        $(this).closest('form').find('.bid-amount-2').show();
        $(this).closest('form').find('.next-btn-2').show();
    // }

});

$("body").on('click', ".next-btn-2", function(event) {

    /*let isValid = true;
    $($(this).closest('form').find('input.validate-input')).each( function() {
        Logger.info(isValid);
        if ($(this).parsley().validate() !== true)
            isValid = false;
    });
    Logger.info(isValid);
    if (isValid) {*/
        $(this).hide();
        $(this).closest('form').find('.bid-amount').hide();
        $(this).closest('form').find('.bid-amount-2').hide();
        $(this).closest('form').find('.submitbtn').show();
        $(this).closest('form').find('.enter-pin').show();
    // }
});

$("body").on('keyup', ".calc-total", function(event) {
    let total=0.00;

   $(this).find('.calc-total-input').each(function(){

        total += parseInt($(this).val());
   });

   // $($(this).data("result")).val(total);
   $(this).closest("form").find($(this).data("result")).val(parseFloat(total).toFixed(2));
});


/* Website js code start */

$('.dateselect ').datepicker({
    format: 'mm/dd/yyyy ',
});

$("body").on('click', ".next1", function(event) {
    console.log("step2");
    $('.step-1').css('display', 'none');
    $('.step-2').css('display', 'block');
    $(".completed-step-2").addClass("turntheme");
    $(".completed-step-1").removeClass("turntheme");
    $(".steps-step-2").addClass("color-purple");
    $(".steps-step-1").removeClass("color-purple");
});

$("body").on('click', ".next2", function(event) {
    $('.step-2').css('display', 'none');
    $('.step-3').css('display', 'block');
    $(".completed-step-3").addClass("turntheme");
    $(".completed-step-2").removeClass("turntheme");
    $(".steps-step-3").addClass("color-purple");
    $(".steps-step-2").removeClass("color-purple");
});

$("body").on('click', ".next3", function(event) {
    $('.step-3').css('display', 'none');
    $('.step-4').css('display', 'block');
    $(".completed-step-4").addClass("turntheme");
    $(".completed-step-3").removeClass("turntheme");
    $(".steps-step-4").addClass("color-purple");
    $(".steps-step-3").removeClass("color-purple");
});

$("body").on('click', ".next4", function(event) {
    $('.step-4').css('display', 'none');
    $('.step-5').css('display', 'block');
    $(".completed-step-5").addClass("turntheme");
    $(".completed-step-4").removeClass("turntheme");
    $(".steps-step-5").addClass("color-purple");
    $(".steps-step-4").removeClass("color-purple");
});

$("body").on('click', ".next5", function(event) {
    $('.step-5').css('display', 'none');
    $('.step-6').css('display', 'block');
    $(".completed-step-6").addClass("turntheme");
    $(".completed-step-5").removeClass("turntheme");
    $(".steps-step-6").addClass("color-purple");
    $(".steps-step-5").removeClass("color-purple");
});


$("body").on('change', ".switch", function(event) {
    $(".toggle-input").toggleClass('diplay-none ');
});

$("body").on('click', ".reject", function(event) {
    $('.rejection-message ').toggleClass("diplay-none");
    $('.order-cards ').toggleClass("diplay-none");
    $('.reject-btn ').html('Submit ');
});

$("body").on('click', "#backbtn", function(event) {
    $('.rejection-message ').addClass("diplay-none");
    $('.order-cards ').removeClass("diplay-none");
});

$("body").on('change', ".economy", function(event) {
    if ($(".economy").is(":checked")) {
        $(".eco").addClass("blue-bg");
        $(".pre").removeClass("blue-bg");
        $('.eco-card ').addClass("border-white");
        $('.pre-card ').removeClass("border-white");
    } else {
        $(".eco").removeClass("blue-bg");
        $('.eco-card ').removeClass("border-white");
    }
});

$("body").on('change', ".premium", function(event) {
    if ($(".premium").is(":checked")) {
        $(".pre").addClass("blue-bg");
        $(".eco").removeClass("blue-bg");
        $('.eco-card ').removeClass("border-white");
        $('.pre-card ').addClass("border-white");
    } else {
        $(".pre").removeClass("blue-bg");
        $('.pre-card ').removeClass("border-white");
    }
});

$("body").on('change', ".eco", function(event) {
    $(".economy").prop("checked", true);
    $(".eco").addClass("blue-bg");
    $(".pre").removeClass("blue-bg");
    $('.eco-card ').addClass("border-white");
    $('.pre-card ').removeClass("border-white");
});

$("body").on('change', ".pre", function(event) {
    $(".premium").prop("checked", true);
    $(".pre").addClass("blue-bg");
    $(".eco").removeClass("blue-bg");
    $('.eco-card ').removeClass("border-white");
    $('.pre-card ').addClass("border-white");
});

$("body").on('change', ".card-block", function(event) {
    $(".card-block").removeClass("turnthemeicon");
    $(this).addClass("turnthemeicon");
});

$("body").on('change', ".card-methord02", function(event) {
    $('.card-methord02').removeClass('turntheme');
    $('.card-methord02').removeClass('check-icon02');
    $(this).addClass('turntheme');
    $(this).addClass('check-icon02');
});

$("body").on('click', ".raised", function(event) {
        // $(this).closest($(this).data("parent")).fadeOut(100).remove();
        var data = $(this).data("booking");
        var href = $(this).data("redirect");
        $.add($(this).data("url"), {data}, function (response){
            if(response.status == "success")
            {
                // tinySuccessAlert("Ticket Raised Successfully", response.message);
                window.location.href = href;
            }
            else
            {
                tinyAlert("Failed", response.message);
            }

        });
    return false;
});
