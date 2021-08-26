function changeMenu(){
    var url = $(location).attr("href");//window.location.pathname;
    console.log(url);
    $("li.menu-item a").each(function(i) {
        // console.log($(this).attr("href"));
        if ($(this).attr("href") == url) {
            // console.log("match");
            // $(this).parent().parent().prev("li").addClass("active-menu-item");

            // $('.active-menu-item').removeClass("active-menu-item");
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


import {
    initCountdown,
    initMapPicker,
    initAllSelectBoxes,
    initSlick,
    initTextAreaEditor,
    initTooltip,
    initequalheights,
    initDatePicker,
    initDateBookPicker,
    initPopUp,
    initPopUpAdmin,
    initRangeSlider,
    initRevenueChart,
    InitUserZoneChart,
    initBarChart,
    initToggles,
    initSelect,
    initOrderDistributionChart,
    initOrderDistributionChartVendor,
    initSortable
} from './app/initFunctions.js';

barba.init({
    cacheIgnore: true,
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
      }, {
        namespace: 'createslider',
        afterEnter(data) {

        }
      },
    ]
});

barba.hooks.before((data) => {
    NProgress.inc();
    $(".main-content").css("opacity", 0.5);
  });

barba.hooks.after((data) => {
    NProgress.done();
            window.scrollTo(0, 0);
            changeMenu();

    $(".main-content").css("opacity", 1);

    initAllSelectBoxes();
    initCountdown();

    initMapPicker();
    initDatePicker();
    initDateBookPicker();
    initPopUp();
    initequalheights();
    initPopUpAdmin();
    initTooltip();
    initSlick();
    initToggles();
    initSelect();
    initRangeSlider();
    //keep charts at end
    initRevenueChart();
    initBarChart();
    initOrderDistributionChart();
    initOrderDistributionChartVendor();
    InitUserZoneChart();
    initTextAreaEditor();
    initSortable();
            // return false;
});


changeMenu();
// loadRevenueChart();
$(document).ready(function(){
    initMapPicker();
    initAllSelectBoxes();
    initSlick();
    initCountdown();
    initDatePicker();
    initDateBookPicker();
    initequalheights();
    initPopUp();
    initPopUpAdmin();
    initTooltip();
    initToggles();
    initSelect();
    initRangeSlider();
    initRevenueChart();
    initOrderDistributionChart();
    initOrderDistributionChartVendor();
    InitUserZoneChart();
    initTextAreaEditor();
    initSortable();
    initBarChart();
});

