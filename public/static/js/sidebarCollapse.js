
        $("body").on("click",".menu-item",function (e) {
            if($(this).next("ul").hasClass("open"))
            {
                $(this).next("ul").slideUp(100).hide();
                $(this).next("ul").removeClass("open");
            }
            else{
                $(this).next("ul").slideDown(100).show();
                $(this).next("ul").addClass("open");
            }

        });
