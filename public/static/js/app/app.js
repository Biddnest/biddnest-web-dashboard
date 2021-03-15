/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

Logger.useDefaults();

// const helper = import("./helpers.js");
import { redirectTo,redirectHard, inlineAlert, megaAlert, tinyAlert, revertFormAnim, triggerFormAnim } from "./helpers.js";
// require("./helpers");
const env = "development";

/* Initializations */
// const logger = $.Logger();

if(env != "development")
    Logger.setLevel(Logger.OFF);


/* AJAX Universal */
$("body").on('submit',"form",function() {
    // Logger.info("form called");
    // console.log();
    // var valid = $(this).parsley().validate();


    if(true){
        let form = $(this);
        let requestData = form.serializeJSON();
        let button = form.find("button[type=submit]");
        let buttonPretext = button.html();
        Logger.info(requestData);

        $.ajax({
            url:form.attr("action"),
            method: form.attr("method"),
            data: JSON.stringify(requestData),
            contentType: "application/json",
            beforeSend: () => {
                triggerFormAnim(button);
            },
            success: (response) =>{

                Logger.info(response);
                if(response.status == "success"){
                    if(form.data("next")){
                        if(form.data("next") == "redirect"){
                            if(form.data('redirect-type') == "hard")
                                redirectHard(form.data("url"));
                            else
                                redirectTo(form.data("url"));
                        }
                        else if(form.data("next") == "refresh"){
                            redirectTo($(location).attr("href"));
                        }
                    }
                }
                else if(response.status == "fail"){

                    if(form.data("alert") == "tiny")
                       tinyAlert("Oops",response.message);
                    else if(form.data("alert") == "inline")
                        inlineAlert(form, response.message);
                    else
                        megaAlert("Oops",response.message);

                }
                else{
                    Logger.info(response.message);
                }
            },
            error: (error, b, c) =>{
                Logger.info(error.responseText, b, c);
            },
        });
        revertFormAnim(button, buttonPretext);
        return false;
    }
    else{
        //Do something here
    }
});
