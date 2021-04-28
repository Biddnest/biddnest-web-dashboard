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
        }
      }, {
        namespace: 'dashboard',
        afterEnter(data) {
            loadRevenueChart();
        }
      },{
        namespace: 'createslider',
        afterEnter(data) {
            $(".select-box").select2({
                tags: false,
                multiple: true,
                closeOnSelect: false,
                // debug: true,
                // allowClear: true,
                placeholder: 'Type here',
                minimumResultsForSearch: 1,
                // minimumInputLength: 3,
            });

            $(".select-box2").select2({
                tags: true,
                multiple: true,
                closeOnSelect: false,
                // debug: true,
                // allowClear: true,
                placeholder: 'Search here',
                minimumResultsForSearch: 1,
                // minimumInputLength: 3,
            });

            $(".searchuser").select2({
                multiple: true,
                tags: false,
                minimumResultsForSearch: 1,
                minimumInputLength: 3,
                closeOnSelect: false,
                debug: true,
                placeholder: 'Search for users',
                // allowClear: true,
                ajax: {
                    url: API_SEARCH_USERS,
                    method: "GET",
                    data: function(params) {

                        var query = {
                            q: params.term,
                            page: params.page || 1
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    error: (a, b, c) => {
                        Logger.error(a.responseText, b, c);
                    },

                    processResults: function(data) {

                        // Transforms the top-level key of the response object from 'items' to 'results'
                        var output = [];
                        for (var i = 0; i < data.data.users.length; i++) {
                            output.push({
                                id: data.data.users[i].id,
                                text: data.data.users[i].fname + " " + data.data.users[i].lname + " - " + data.data.users[i].email
                            })
                        }


                        return {
                            results: output
                        };
                    }

                }
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
    var editor = new FroalaEditor('.editor')
            // return false;

});

changeMenu();
// loadRevenueChart();
var editor = new FroalaEditor('.editor')
