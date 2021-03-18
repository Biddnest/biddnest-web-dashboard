function changeMenu(){
    var url = $(location).attr("href");//window.location.pathname;
    console.log(url);
    $("li.menu-item a").each(function(i) {
        // console.log($(this).attr("href"));
        if ($(this).attr("href") == url) {
            // console.log("match");
            // $(this).parent().parent().prev("li").addClass("active-menu-item");
            $(this).parent().addClass("active-menu-item");
            // return false;
        }
        else{
            $(this).parent().removeClass("active-menu-item");
        }
    });


    $("li.sub-menu-item a").each(function(i) {
        // console.log($(this).attr("href"));

        if ($(this).attr("href") == url ) {
            // console.log("match");
            $(this).parent().parent().prev("li").addClass("active-menu-item");
            $(this).parent().parent().slideDown(200).show();
            $(this).parent().addClass("active-sub-menu-item");
            return false;
        }/*else{
            $(this).parent().parent().slideUp(200).hide();

        }*/
    });
}
barba.init({
    views: [{
        namespace: 'slider',
        afterEnter(data) {
            $('.slick-container').slick({
                arrows: false
            });
            $('.slick-container-2').slick({
                arrows: false
            });
            $('.slick-container-3').slick({
                arrows: false
            });
            $('.slick-container-4').slick({
                arrows: false
            });
            $('.slick-container-5').slick({
                arrows: false
            });
            $('.slick-container-6').slick({
                arrows: false
            });
        }
      },
        /*{
            namespace: 'createorders',
            afterEnter(data) {
                console.log("you are on create order page");
            }
        }*/
    ]
});


barba.hooks.before((data) => {
    NProgress.inc();
  });

barba.hooks.after((data) => {
    NProgress.done();
            window.scrollTo(0, 0);
            changeMenu();
            // return false;

});

changeMenu();
