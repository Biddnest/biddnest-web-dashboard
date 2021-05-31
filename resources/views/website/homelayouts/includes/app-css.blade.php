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
<!-- fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('static/website/css/master.css')}}" />
<style>
    body{
    font-family: 'Roboto', sans-serif !important;
}

.card-num {
  font-size: 115px;
  position: absolute;
  left: 21px;
  color: #F8F8F8;
}

.card-num-right {
  font-size: 115px;
  position: absolute;
  right: 21px;
  color: #F8F8F8;
}

.navbar-brand>img{
    display: block;
    width: 116px;
    margin-top: 6px;
}

.logged-in-username{
    font-size: 14px;
}

.carousel-control .glyphicon-chevron-right{
    margin-right: 118px;

}


.nav-menu-link.l-cap{
    font-size: 14px !important;

}
    a.menu{
        color: #3d4751 !important;
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

 .quote p{
         font-size: 14px;
     }
     p.f-16{
        font-size: 16px !important;

     }

 @media (max-width:1300px)  { 
     .marg-head{
        margin-top: 5rem;
     }
     .quote p{
         font-size: 16px;
     }
     .dropdown-content{
        left: -28px !important;
        padding: 8px;
     }

     p.f-16{
         font-size: 16px !important;
     }
     #content_accurate{
        padding-top: 0px !important;
     }

     section#get-app{
        padding: 50px 30px;

     }
 }

 

 @media (min-width: 1200px){
.container {
    width: 1120px !important;
}
.col-lg-6.col-xs-12.mt-2{
    padding-left: 60px;

}
.container.get-offers{
    padding-left: 60px;

}
 }

 @media (max-width:480px)  { 
   
    .page-scroll.mb-view.btn.join-now{
        margin-bottom: 20px;
    margin-top: 20px !important;
    width: auto;

    }
  
   
    .page-scroll.btn.join-now{
        width: fit-content;
    }
    .svg-container.ml-2{
        margin-left: 0px !important;
    }

   
    .navbar-default .navbar-nav .bec-vendor{
        background: none !important;
    }
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

    .view-none{
        display: none !important;
    }
    .p-50{
    padding-top: 0 !important;
    }

    .navbar-default{
        background: none !important;
    }
    body.fixed .header-fixed{
        padding: 0px 0px!important;

    }
    .join-now {
        padding: 4px 26px !important;
        background-color: #fdc403;
        color: #fff;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        margin: 0 auto;

    }
    .reverse{
    display: flex;
    flex-direction: column-reverse;
    }
    
    .center-align{
    text-align: center !important;

    }
    center{
        display: flex !important;

    }
    .around{
    display: flex !important;
    justify-content: space-around !important;
    }
    ul.social-buttons{
    margin-right: 0px;

    }

    .text-gray{
    color: #343d45 !important;

    }
    .pl-8{
    padding-left: 8px !important;
    }
    a.menu{
        color: #fff !important;
    }
    .logo-small{
        width: 100px;
        margin-top: 7px;

    }
    .testimonialslideshow{
        margin-left: 0px !important;

    }
    

             
             
             
 }


 .tab .active{
    background-color: #2a2386 !important;
    color: #fff !important;
 }
 

    a.menu{
        color:  #3d4751 ;
    }
    .text-gray{
    color: #343d45 !important;

    }


    /* .testimonialslideshow{
        margin-left: 50px;

    } */




  


</style>
