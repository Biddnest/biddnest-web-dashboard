barba.init({
        
});


barba.hooks.before((data) => {
    NProgress.inc();
  });

barba.hooks.after((data) => {
    NProgress.done();
            window.scrollTo(0, 0);
            return false;
});


var input = document.querySelector("#phone");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

var input = document.querySelector("#phonefriend");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

var input = document.querySelector("#phone-pop-up");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

$(document).ready(function(){

    $(function() {
        $( 'ul.menu li' ).on( 'click', function() {
            $( this ).parent().find( 'li.active-menu-item' ).addClass('b-purple' ).removeClass( 'active-menu-item' );
            $( this ).removeClass( ' li.b-purple' );
            $( this ).addClass( 'li.active-menu-item' );
        });
    });

    const loader = document.querySelector('.loader');  
    $('[name=email]').keyup(function(){

        if($('form').valid()){
            $(this).parent().removeClass().addClass('isvalid');
        }else{
            $(this).parent().removeClass().addClass('notvalid');
        }
    
    });

    $("#switch").click(function(){
        if ($("#switch").prop('checked')) {
            $(".phone-num-lable").html("Friend's Phone Number");
            $('.full-name').html("Friend's Full Name");
            $('.email-label').html("Friend's Email")
     
        } else {
            $(".phone-num-lable").html("Phone Number")
            $('.full-name').html("Full Name");
            $('.email-label').html("Email")
        }
    });

    // Toggle divs
    $(".reject").click(function(){
        // alert('wle')
        $('.rejection-message').toggle();
        $('.order-cards').toggle();
        $('.reject-btn').html('Submit')
    });
  
    $(".card-price").click(function(){
        $('.order-cards').toggle();
        $('.reject-btn').toggle();
        $('.Order-sucess').toggleClass('diplay-none')
    });

    $(".step-1").click(function(){
        $('.sub-total').removeClass('diplay-none');
        $('.payment-status').addClass('diplay-none');
        $('.paid-status').addClass('diplay-none')
        $('.payment-suscessful').addClass('diplay-none');
    });

    $(".step-2").click(function(){
        $('.sub-total').addClass('diplay-none');
        $('.payment-status').removeClass('diplay-none');
        $('.payment-suscessful').addClass('diplay-none');
    });

    $(".step-3").click(function(){
        $('.payment-suscessful').removeClass('diplay-none');
        $('.payment-status').addClass('diplay-none');
    });

    $(".q-viewmore").click(function(){
        $('.quotation-main').toggleClass('diplay-none');
        $('.view-more').toggleClass('diplay-none');
    });

    $(".assign-btn").click(function(){
        $('.bidlist-table').toggleClass('diplay-none');
        $('.assign-manul-table').toggleClass('diplay-none');
    });

    $(".back-btn").click(function(){
        $('.assign-manul-table').toggleClass('diplay-none');
        $('.bidlist-table').toggleClass('diplay-none');
    });


    $("#switch").change(function () {
        $(".toggle-input").toggleClass('diplay-none');
       
    });

      // Toggle divs
    $(".reject").click(function () {
       
        $('.rejection-message').toggleClass("diplay-none");
        $('.order-cards').toggleClass("diplay-none");
        $('.reject-btn').html('Submit')

    });
    $("#backbtn").click(function () {
       
       $('.rejection-message').addClass("diplay-none");
       $('.order-cards').removeClass("diplay-none");
      

    });
   
    $("#economy").change(function(){
        if($("#economy").is(":checked")){
            $(".eco").addClass("blue-bg")
            $(".pre").removeClass("blue-bg")
            $('.eco-card').addClass("border-white")
            $('.pre-card').removeClass("border-white")
        }else{
            $(".eco").removeClass("blue-bg")
            $('.eco-card').removeClass("border-white")
        }  
    });
    $("#premium").change(function(){
        if($("#premium").is(":checked")){
        $(".pre").addClass("blue-bg");
        $(".eco").removeClass("blue-bg")
        $('.eco-card').removeClass("border-white")
        $('.pre-card').addClass("border-white")
        }else{
        $(".pre").removeClass("blue-bg")
        $('.pre-card').removeClass("border-white")
        }
    })

});

('.dateselect').datepicker({
    format: 'mm/dd/yyyy',

    
  



  });


  




