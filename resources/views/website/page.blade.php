@extends('website.layouts.frame')
@section('title'){{ucwords($page->title)}} @endsection
@section('header_title') {{ucwords($page->title)}} @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="terms">
        <div class="container">
            <div class="quote p-0 br-5 w-70 ontop bg-white responsive">
                <div class="row">
                    <div class="col-3 p-4 bg-gray-circle border-right border-l-radius">
                        <a href="{{route('terms.page', ["slug"=>"about-us"])}}"><div class="d-flex mt-1 pt-3 " style="align-items: baseline;"><h4 class="icon bg-purple cursor-pointer text-white">1</h4><p class="theme-text ml-2">About Us</p></div></a>
                        <a href="{{route('terms.page', ["slug"=>"terms-and-conditions"])}}"><div class="d-flex mt-1 pt-3" style="align-items: baseline;"><h4 class="icon bg-purple cursor-pointer text-white">2</h4><p class="theme-text ml-2" > Terms and Conditions</p></div></a>
                        <a href="{{route('terms.page', ["slug"=>"privacy-policies"])}}"><div class="d-flex mt-1 pt-3" style="align-items: baseline;"><h4 class="icon bg-purple cursor-pointer text-white">3</h4><p class="theme-text ml-2">Privacy and Policy</p></div></a>
                        <a href="{{route('faq')}}"><div class="d-flex mt-1 pt-3" style="align-items: baseline;"><h4 class="icon bg-purple cursor-pointer text-white">4</h4><p class="theme-text ml-2" >FAQ</p></div></a>
                    </div>
                    <div class="col-9 p-4 pr-2" id="terms-section">
                        <!-- Replacing Sections here yo yo  -->
                        <div class=" mt-1 pt-3">
                            <h4 class="ml-2 pl-1">{{ucwords($page->title)}}</h4>
                            @if($page->updated_at)
                                <p class="text-muted">Updated {{date('M Y', strtotime($page->updated_at))}}</p>
                            @endif
                        </div>
                        <div class="mt-1 pt-3">
{{--                            <h5 class="ml-2">Accepting the Terms</h5>--}}
                            <p class="mt-1 f-14 pr-4" style="white-space: normal !important;text-align: justify; ">{!! $page->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
