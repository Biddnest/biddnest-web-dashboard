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

import {initCountdown, initMapPicker, initAllSelectBoxes, initSlick, initTextAreaEditor,initDatePicker, initRevenueChart} from './app/initFunctions.js';
barba.init({
    views: [{
        namespace: 'slider',
        afterEnter(data) {
           // initSlick();
        }
      }, {
        namespace: 'dashboard',
        afterEnter(data) {
            // loadRevenueChart();
        }
      },{
        namespace: 'createslider',
        afterEnter(data) {

        }
      },{
        namespace: 'orderdetails_bidding',
        afterEnter(data) {
            initCountdown();
        }
      },
    ]
});


barba.hooks.before((data) => {
    NProgress.inc();
  });

barba.hooks.after((data) => {
    NProgress.done();
            window.scrollTo(0, 0);
            changeMenu();

    initAllSelectBoxes();
    initCountdown();

    initMapPicker();

    initTextAreaEditor();
    initDatePicker();
    initSlick();
    //keep charts at end
    initRevenueChart();
            // return false;
});

changeMenu();
// loadRevenueChart();
$(document).ready(function(){
    initMapPicker();
    initAllSelectBoxes();
    initSlick();
    initTextAreaEditor();
    initCountdown();
    initDatePicker();
    initRevenueChart();

});

