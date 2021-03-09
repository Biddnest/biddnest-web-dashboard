        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dripicons/2.0.0/webfont.min.css" integrity="sha512-pi7KSLdGMxSE62WWJ62B1R5/H7WNnIsj2f51MikplRt31K0uCZ1lfPSw/0Jb1flSz6Ed2YLSlox6Uulf7CaFiA==" crossorigin="anonymous" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha512-42kB9yDlYiCEfx2xVwq0q7hT4uf26FUgSIZBK8uiaEnTdShXjwr8Ip1V4xGJMg3mHkUt9nNuTDxunHF0/EgxLQ==" crossorigin="anonymous" />

        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">        

        <!-- Toggle btn -->
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
        <!-- sortable -->
        <link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
        <!-- SLick -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>

          <!-- telephone input plugin -->
          <link rel="stylesheet" href="{{ asset('static/css/intlTelInput.css')}}">

          <!-- date-time picker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" />


        <!-- Custom css -->
        <link rel="stylesheet" href="{{ asset('static/css/master.css')}}" />
        <link rel="stylesheet" href="{{ asset('static/css/tagify.css')}}" />
        
        <link rel="stylesheet" href="{{ asset('static/css/components/select2.css')}}">


        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
 

    
       
    <!-- text area editor -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
    <link rel="stylesheet" href="{{ asset('static/css/code_view.min.css')}}">
    <link rel="stylesheet" href="{{ asset('static/css/font_awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('static/css/froala_editor.pkgd.min.css')}}">

   
    


    


        
        <style>
            .nav-collapse .li{
                list-style-type: none !important;
            }
            .modal-body{
                margin-left: 6.5px;
            }
            .btn-1{
                width: 100%;
            }
            #myTab{
                margin-left: -4px;
            }

            main .menu-sidebar {
                margin-top: 70px;
            }
            main .menu-sidebar .Brand-logo {
                height: 70px;
            }
    
            .ml-48{
                margin-left: 48px ;
            }
            .vendor-switch2.toggle-group.toggle-on.btn-xs {
                background-color: #2E0789 !important;
                padding: 12px !important;
            }
            .ml-15{
                margin-left: -15px !important;
            }
            .pl-10{
                padding-left: 10px;
            }
            .default-image{
                width: 85px;
                height: 65px;
            }
            .h-35 {
                height: "35px !important";
            }
            .tagify {
                padding: 0px !important;
                /* height: 38px !important; */
                /* background-color: #f1f9ff !important; */
                border: 2px solid #DFE6EC!important;
                border-radius: 5px !important;
            }
            .form-input textarea.form-control:focus {
                border-color: #bcbcbc;
                box-shadow: none;
            }
            select {
                -webkit-appearance: none;
                -moz-appearance: none;
                -o-appearance: none;
            }
            select + i.fa {
                float: right;
                margin-top: -26px;
                margin-right: 5px;
                pointer-events: none;
                color: #2699fb;

                padding-right: 8px;
            }
            .table td, .table th {
                padding: 1.75rem !important;
                vertical-align: top;
                border-top:none; 
                text-align: center;
            }

            .btn-xs {
                font-size: 8px !important;
            }
            .slick-list {
            width: 85px !important;
            }

            .slick-image {
                width: 85px !important;
            }

            .w-25 {
                width: 25% !important;
            }

            table .w-10 {
                width: 10%;
            }

            table .w-30 {
                width: 30%;
            }
            .f-l {
                font-size: large;
            }           
            .p-8{
                padding: 8px 16px !important;
            }
            .w-38 {
                width: 38%;

            }

            /* error bredcrum */
            .breadcrumb {
                margin-top: -20px !important;
            }

            .toggle-handle {
                position: absolute;
                top: 10%;
                left: 40px  !important;
            }
            .toggle.btn-outline-secondary .toggle-handle {
                left: 73px  !important;
            }
            .toggle-off.btn-xs {
                padding-left: 30px !important;
            }
            .btn-outline-primary:hover {
            color: #fff;
            background-color: #2E0789 !important;
            border-color:#2E0789 !important;
            } 
            .Dashboard-lcards .table tbody tr:hover {
                border: none !important;
            }

            select.form-control:not([size]):not([multiple]) {
                height: calc(2.25rem + 14px);
            }


            .Dashboard-lcards .table td, .Dashboard-lcards .table th {
                padding: 0.75rem;
                border-top: none;
                vertical-align: baseline;
            }
            .Dashboard-lcards .table th {
                padding: 1.75rem !important;
                border-top: none;
            }

            .select-styled {
                border-bottom-left-radius: 0px !important;
                border-bottom-right-radius: 0px !important;
            }

            .order-status {
                width: 85%;
                align-self: center;
                margin: 20px 80px;
            }

            .dash-line {
                position: absolute;
                border: none;
                border-top: 2px dashed #C0E2FD;
                height: 0px;
                margin-left: 6px;
                margin-top: 20px;
                width: 90%;
            }

            .steps-container {
                width: 100%;
                align-self: center;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }

            .step {
                z-index: 1;
                display: flex;
                align-items: center;
                flex-direction: column;
            }

            .step-dot {
                width: 38px;
                height: 38px;
                z-index: 1;
                background-color: #2E0789;
                border-radius: 19px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .step-title {
                margin: 0 auto;
                color: #2E0789;
            }

            .child-dot {
                width: 28px;
                height: 28px;
                border-radius: 14px;
                z-index: 1;
                border: 3px solid white;
            }

            .background-color-lightblue {
                background-color: #EFF7FF;
            }

            .table-width {
                width: 95%;
                margin: 0 auto;

            }


            .toggle-group .toggle-on.btn-xs {
                background-color: #2E0789 !important;
                padding: 15px;
                font-size: 12px !important;
            }
            .toggle-group .toggle-off.btn-xs {
                background-color: #2E0789 !important;
                border-color: #2E0789 !important;
                padding: 15px;
                font-size: 12px !important;
            }

            .header{
                padding-top: 10px !important;
                padding-left: 17px !important;
                padding-right: 17px !important;
                padding-bottom: 10px !important;
            }


            input[type=checkbox], input[type=radio] {
                margin: 4px -20px 0;
            }

            .title {
                margin-top: 5px !important;
                margin-bottom: 10px !important;
                padding-left: 20px !important;
            }


        </style>

