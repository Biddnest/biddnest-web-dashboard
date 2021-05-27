<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title')</title>

<link rel="icon" type="image/svg+xml" href="{{ asset('static/images/favicon.svg')}}">
<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dripicons/2.0.0/webfont.min.css" integrity="sha512-pi7KSLdGMxSE62WWJ62B1R5/H7WNnIsj2f51MikplRt31K0uCZ1lfPSw/0Jb1flSz6Ed2YLSlox6Uulf7CaFiA==" crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">

<!-- custom css -->
<link rel="stylesheet" href="{{ asset('static/website/css/intlTelInput.css')}}">
<link rel="stylesheet" href="{{ asset('static/website/css/master.css')}}" />

<style>
    select {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        background: transparent !important;
        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>") !important;
        background-repeat: no-repeat !important;
        background-position-x: 100% !important;
        background-position-y: 5px !important;
        border: 1px solid #dfdfdf !important;
        border-radius: 3px !important;
        margin-right: 2rem !important;
        padding-right: 2rem !important;
    }
    select::-ms-expand {
        display: none !important;
    }

     .answer {
         display: none;
     }
   
     .custom-check{
         display: none;
     }

     .spcae{
        margin-bottom: 130px !important;

        height: 650px !important;

    }

    .card-img-top {
        width: 107% !important;
        margin-left: -8px !important;


    }
    .input-group-append{
        margin-left: -35px !important;

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
     background: #2c136c !important;
 }


 .card-input-element01:checked + .card-input {
    color:#2c136c !important; 
 }


 .card-input-element01{
     display: none;

 }



 .drop-list:hover{
    background: #e6e9eb;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;


}



.border-add{
    border: 4px solid #fdc403;
    width: 197px;
    margin-left: 16px;
    margin-top: 16px;
    border-radius: 5px;
}


.add-item-icon{
    bottom: 216px !important;
    right: 104px !important;
}

.dropdown-content{
    top: 31px !important;

}

 .hor-center{
    display: flex !important ;
    justify-content: center  !important;
    flex-direction: column  !important;
    align-items: center  !important;
 }


 .img-location{
    transform: translate(2px, -9px) !important ;

 }


 p.f-16{
     font-size: 16px !important;
 }


 .quote p{
    white-space: nowrap !important;

 }

 .para-head {
    white-space: normal !important;

 }


 .para{
    white-space: normal !important;

 }


 .close .text-white  {
    outline: none !important;
    border: none !important;

 }


 button:focus { outline: none; }



 @media (max-width:480px)  { 
               .col-mobile{
                    flex-direction: column !important;

                }
                .padding-view{
                    padding-left: 0 !important;

                }

                .top-aliments{
                    width: 100%  !important;
    display: flex  !important;
    justify-content: center  !important;
    flex-wrap: wrap  !important;

                }
                .bg-blur {
                    width: fit-content !important;
                }

                .f-30{
                    margin-left: 0  !important;
                }

                .m-20{
                    margin: 0 !important;
                } 
                .details-card{
                    width: auto!important;
                } 
            
                .w-84{
                    width: 84% !important;
                }

                .custom-file{
                    height: calc(3.25rem + 8px);

                }

                .mar-vendor{
                    margin-left: 10px !important; 

                }


            
             }




             img.req-search-image{
                height: fit-content !important;
                max-width:100%

             }

 .card .required-item {
     width: fit-content !important;

 }

 .border-l-radius{
     border-top-left-radius: 5px !important;
 }


 .space{
     height: 300px !important;
     margin-bottom: 100px !important;
 }
</style>
