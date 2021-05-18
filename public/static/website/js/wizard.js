$document.ready(function() {
    $("#next1").onClick(function() {
        $('#step-5').css('display', 'none');
        $('#step-6').css('display', 'block');
        $(".completed-step-2").addClass("turntheme");
        $(".completed-step-1").removeClass("turntheme");
    });
    $("#next2").onClick(function() {
        $('#step-6').css('display', 'none');
        $('#step-7').css('display', 'block');
        $(".completed-step-3").addClass("turntheme");
        $(".completed-step-2").removeClass("turntheme");
    });
    $("#next3").onClick(function() {
        $('#step-7').css('display', 'none');
        $('#step-8').css('display', 'block');
        $(".completed-step-4").addClass("turntheme");
        $(".completed-step-3").removeClass("turntheme");
    });
    $("#next4").onClick(function() {
        $('#step-8').css('display', 'none');
        $('#step-9').css('display', 'block');
        $(".completed-step-5").addClass("turntheme");
        $(".completed-step-4").removeClass("turntheme");
    });
    $("#next5").onClick(function() {
        $('#step-9').css('display', 'none');
        $('#step-10').css('display', 'block');
        $(".completed-step-6").addClass("turntheme");
        $(".completed-step-5").removeClass("turntheme");
    });

})