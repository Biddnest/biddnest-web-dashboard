@extends('website.layouts.frame')
@section('title'){{ucwords($page->title)}} @endsection
@section('header_title') {{ucwords($page->title)}} @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="terms">
        <div class="container">
            <div class="quote p-0 br-5 w-70 ontop bg-white">
                <div class="row">
                    <div class="col-3 p-4 bg-gray-circle border-right">
                        <a href="{{route('page', ["slug"=>"about-us"])}}"><div class="d-flex mt-1 pt-3"><h4 class="icon bg-purple cursor-pointer text-white">1</h4><p>About Us</p></div></a>
                        <a href="{{route('page', ["slug"=>"terms-and-conditions"])}}"><div class="d-flex mt-1 pt-3"><h4 class="icon bg-purple cursor-pointer text-white">2</h4><p>Terms and Conditions</p></div></a>
                        <a href="{{route('page', ["slug"=>"privacy-policies"])}}"><div class="d-flex mt-1 pt-3"><h4 class="icon bg-purple cursor-pointer text-white">3</h4><p>Privacy and Policy</p></div></a>
                        <a href="{{route('faq')}}"><div class="d-flex mt-1 pt-3"><h4 class="icon bg-purple cursor-pointer text-white">4</h4><p>FAQ</p></div></a>
                    </div>
                    <div class="col-9 p-4 pr-2" id="terms-section">
                        <!-- Replacing Sections here yo yo  -->
                        <div class=" mt-2 pt-3">
                            <h4>{{ucwords($page->title)}}</h4>
                            @if($page->updated_at)
                                <p class="text-muted">Updated {{date('M Y', strtotime($page->updated_at))}}</p>
                            @endif
                        </div>
                        <div class="mt-1 pt-3">
{{--                            <h5 class="ml-2">Accepting the Terms</h5>--}}
                            <p class="mt-1" style="white-space: normal !important;">{!! $page->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
