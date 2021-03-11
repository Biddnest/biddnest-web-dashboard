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
    barba.go(url);
};

export function tinyAlert(title, message){}

export function megaAlert(title, message){}

export function inlineAlert(elem, message){
    var alert = '<div class="alert alert-danger" role="alert">' +
        ''+message+'</div>';
    elem.prepend(alert);
    // console.log(message);
}

export function triggerFormAnim(elem){
    elem.closest("form").find(".alert").remove();
    elem.attr("disabled",true);
    elem.addClass("disabled");
    elem.html("...");
}

export function revertFormAnim(elem, text){
    elem.removeClass("disabled");
    elem.removeAttr("disabled");
    elem.html(text);
}
