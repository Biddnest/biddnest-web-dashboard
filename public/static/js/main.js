


var input = document.querySelector("#phone");
window.intlTelInput(input, {
    initialCountry: "in",
    separateDialCode: true,
    autoPlaceholder: "9739912345",

    // iti.setCountry("");

    // any initialisation options go here
});

var input = document.querySelector("#phone1");
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

//create vendor onboard ===============
var input = document.querySelector("#input-blue");
window.intlTelInput(input, {
            initialCountry: "in",
            separateDialCode: true,
            autoPlaceholder: "9739912345",

            // iti.setCountry("");

            // any initialisation options go here
});

var input = document.querySelector("#Employee");
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


    var i=1;
    $("#addnew-btn").click(function(){

     $('#addr'+i).html(`<th scope='row'>
       <div class="select">
         <select class="form-control" id="table-select">
       <option>sku123456</option>
       <option>sku123456</option>
       <option>sku123456</option>
       <option>sku123456</option>
       </select>
         </div>
        
         

       
       </th><td class='text-center'> <div class="select">
         <select class="form-control">
       <option>2</option>
       <option>4</option>
       <option>8</option>
       <option>24</option>
       </select>
         </div></td> <td class=""> <div class="select">
         <select class="form-control" id="table-select">
       <option>Small</option>
       <option>Large</option>
       <option>Medium</option>
     
       </select>
         </div></td> <td> <button class=" btn btn-1 theme-bg white-text " >
            Add </button> </td>`);

        $('#items').append('<tr id="addr'+(i+1)+'"></tr>');
        i++; 
    });


    $(".eco").click(function(){
   
        $("#economy").prop("checked", true);
        $(".eco").addClass("blue-bg")
          $(".pre").removeClass("blue-bg")
          $('.eco-card').addClass("border-white")
          $('.pre-card').removeClass("border-white")
      
    
      });
      $(".pre").click(function(){
     
       $("#premium").prop("checked", true);
       $(".pre").addClass("blue-bg");
          $(".eco").removeClass("blue-bg")
          $('.eco-card').removeClass("border-white")
          $('.pre-card').addClass("border-white")
     });

     $("[name=tags]").tagify();
     $(".reject").click(function () {
       $(".rejection-message").toggle();
       $(".order-cards").toggle();
       $(".reject-btn").html("Submit");
     });
     

});

$('#tomap').locationpicker();
$('#frommap').locationpicker();

('.dateselect').datepicker({
    format: 'mm/dd/yyyy',
  });


  // create vendor onboard====
  function getBase64(file) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        console.log(reader.result);
    };
    reader.onerror = function (error) {
        console.log('Error: ', error);
    };  
}
const MAX_2_MB = 2000000;
$(function() {
    $("#aadhar-upload").change(function (e){
        var selectedFile = e.target.files[0]
        console.log('hello megha', getBase64(selectedFile))
        var reader = new FileReader();
        reader.readAsDataURL(selectedFile);

        reader.onload = function (e) {
            $('#aadhar-preview').attr('src', e.target.result);
            $('#upload-btn').html('Remove Image')
            $('#upload-btn').css('background-color', 'red' )

        }

        if (selectedFile.size > MAX_2_MB) {
            $("#file-aadhar").html('Invalid file or File size has exceeded');
        } else {
            $("#file-aadhar").html(selectedFile.name.substr(0, 10) + "...");
        }
    });
});


  




