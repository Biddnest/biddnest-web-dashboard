<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title')</title>
<link rel="icon" type="image/svg+xml" href="{{ asset('static/images/favicon.svg')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dripicons/2.0.0/webfont.min.css" integrity="sha512-pi7KSLdGMxSE62WWJ62B1R5/H7WNnIsj2f51MikplRt31K0uCZ1lfPSw/0Jb1flSz6Ed2YLSlox6Uulf7CaFiA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.5/sweetalert2.min.css" integrity="sha512-gX6K9e/4ewXjtn8Q/oePzgIxs2KPrksR4S2NNMYLxenvF7n7eNon9XbqQxb+5jcqYBVCcncIxqF6fXJYgQtoAg==" crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('static/website/css/master.css')}}" />
<style>
    a.menu{
        color: #0f0c75 !important;
        font-size: 14px !important;
    }



label {
    width: 100%;
}

.card-input-element {
    display: none;
}

.card-input {
    margin: 10px;
    padding: 00px;
}

.card-input:hover {
    cursor: pointer;
}

.card-input-element:checked + .card-input {
     box-shadow: 0 0 1px 1px #fdc403;
 }


 ::-webkit-input-placeholder{
     color: red;
 }



 .padding-location{
    padding: 6px 46px !important;
 }



 ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: red ;
  opacity: 1;}

 input[type="name"].input-overwrite::-webkit-input-placeholder {
    color: #696f74 !important;

 }


 .datepicker-dropdown.datepicker-orient-top:after{
     display: none !important;
 }
 .datepicker-dropdown.datepicker-orient-top:before{
     display: none !important;
 }

 .datepicker-dropdown.datepicker-orient-bottom:after{
    display: none !important;

 }

 .datepicker-dropdown.datepicker-orient-bottom:before{
    display: none !important;

 }


 .close .text-white  {
    outline: none !important;

 }


.drop-list:hover{
    background: #e6e9eb;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;


}

.dropdown-content {
    top: 49px !important;

   
    padding: none !important;
   
}

 .padding-larg{
    padding: 6px 139px !important;

 }


 .datepicker table tr td.active.active{
    background: #2E0789 !important;
    width: 46px !important;
    background: #2E0789 !important;
    padding: 11px !important;
    height: 46px !important;
 }

 .dropdown-menu{
    display: block;
    top: 71px;
    left: 182px;
    left: 900px !important;
 }

 @media (max-width:480px)  { 
                .testimonial-content{
                     margin-left: 0px !important; 
            
                }
                .mar-vendor{
                    margin-left: 10px !important; 

                }

                .padding-btn-res{
                    padding: 5px 60px !important;
    width: fit-content;
                }
               
            
            
             }





  


</style>
