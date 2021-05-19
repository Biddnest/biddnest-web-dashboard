@extends('website.layouts.frame')
@section('title') Contact Us @endsection
@section('header_title') Frequently Asked Questuons @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="faq">
        <div class="container ">
            <div class="quote responsive br-5 w-70 ontop bg-white">
                <div class="card-body">
                    <h5 class="card-title light center mt-1 pb-10">HOW CAN WE HELP YOU ?</h5>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for a question here or type a query you have...">
                        <div class="input-group-append">
                            <button class="btn btn-seach" type="button">
                                <i class="fa fa-search pr-2 "></i>SEARCH
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quote responsive br-5 w-70 bg-white ontop p-10 " style="margin-top: 240px;">
                <div class="container ">
                    @foreach($faqs as $faq)
                        <div class="accor-item d-flex justify-content-between  row card p-3 br-0">
                            <a>{{$faq->title}}</a>
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="content answer pt-2">
                            <p>
                                {{$faq->desc}}
                            </p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <script>
            var coll = document.getElementsByClassName("accor-item");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.style.backgroundColor = "#141d75"
                    this.style.color = "white"
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;
                    if (content.style.display === "block") {
                        content.style.display = "none";
                        this.style.backgroundColor = "white"
                        this.style.color = "black"
                    } else {
                        content.style.display = "block";
                    }
                });
            }
        </script>
    </div>
@endsection
