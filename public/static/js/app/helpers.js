/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

export function redirectTo(url){
  /*  let link  = new HTMLLinkElement();
    let id =  "mock-link-"+Math.floor(Math.random() * 100);
    link.href = url;
    link.id = id;
    $("main").append(link);
    $("#"+id).click();*/
    Logger.info("redirect-soft");

    barba.go(url);
};

export function redirectHard(url){
    Logger.info("redirect-hard");
    location.assign(url);
};

export function tinyAlert(title, message){
    toastr.error(message, title, {timeOut: 5000});
}

export function tinySuccessAlert(title, message){
    toastr.success(message, title, {timeOut: 5000});
}

export function megaAlert(title, message){
    Swal.fire({
        icon: 'error',
        title: title,
        text: message,
    })
}

export function inlineAlert(elem, message){
    var alert = '<div class="alert alert-danger" role="alert">' +
        ''+message+'</div>';
    elem.prepend(alert);
}

export function triggerFormAnim(elem){
    elem.closest("form").find(".alert").remove();
    elem.attr("disabled",true);
    elem.addClass("disabled");
    var loader = '<svg class="spinner" width="16px" height="16px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="circle" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>';
    elem.html(loader);
}

export function revertFormAnim(elem, text){
    elem.removeClass("disabled");
    elem.removeAttr("disabled");
    elem.html(text);
}

export function getLocationPermission(){
    if ("geolocation" in navigator){ //check geolocation available
        //try to get user current location using getCurrentPosition() method
        navigator.geolocation.getCurrentPosition(function(position){
            $("#result").html("Found your location <br />Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
        });
    }else{
        console.log("Browser doesn't support geolocation!");
    }
}



