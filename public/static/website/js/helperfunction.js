$(document).ready(function() {
    function openContent(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();


    // datepicker
    $('#dateselect').datepicker({
            dateFormat: 'dd-M-yy',
            showOn: "button",
        })
        .on("changeDate", function(ev) {
            var newDate = new Date(ev.date);
            var formattedDate = newDate.toString().split(' ')
            document.getElementById("dp1").value = `${formattedDate[2]} ${formattedDate[1]} ${formattedDate[3]}`
        });


    // navigation color changes on scrolls
    $(document).ready(function() {
        var showHeaderAt = 150;
        var win = $(window),
            body = $("body");
        if (win.width() > 400) {
            win.on("scroll", function(e) {
                if (win.scrollTop() > showHeaderAt) {
                    body.addClass("fixed");
                } else {
                    body.removeClass("fixed");
                }
            });
        }
    });



    // tabs 
    function toggle_visibility(id) {
        var e = document.getElementById(id);
        if (e.style.display == 'block') {
            e.style.display = 'none';
        } else {
            e.style.display = 'block';
        }
    }

    // Card color changes on click 
    $(".card-methord").click(function() {
        $(".card-methord").removeClass("turntheme");
        $(this).addClass("turntheme");
    });

    // DatePicker
    var nowTemp = new Date();
    var now = new Date(
        nowTemp.getFullYear(),
        nowTemp.getMonth(),
        nowTemp.getDate(),
        0,
        0,
        0,
        0
    );
    var checkin = $("#dp1")
        .datepicker({
            beforeShowDay: function(date) {
                return date.valueOf() >= now.valueOf();
            },
            autoclose: true,
        })


})