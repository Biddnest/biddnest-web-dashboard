@extends('layouts.app')
@section('title') Testimonials @endsection
@section('content')

 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="testimonials">
                            <div class="d-flex  flex-row justify-content-between">
                                <h3 class="page-head theme-text text-left p-4 f-20">Testimonials</h3>
                                <div class="mr-20">
                                    <a href="{{route('create-testimonials')}}">
                                        <button class="btn f-12 theme-bg white-text"><i class="fa fa-plus p-1"
                                                aria-hidden="true"></i> Create Testimonials
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left p-2 pt-0 pb-0">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <li class="breadcrumb-item active" aria-current="page">Sliders & Banners
                                      </li>
                                      <li class="breadcrumb-item"><a href="categories-subcategories.html"> Testimonials</a></li>
                                      
                                     
                                    </ol>
                                  </nav>
                                
                                
                                </div>
                          
                            </div>
                            <!-- Dashboard cards -->
                            <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                                <div class="col-lg-12">
                                    <div class="card h-auto p-0 pt-10">
                                        <div class="row p-3 no-gutters d-flex">
                                            <div class="col-lg-6">
                                                <div class="card testimonials-card">
                                                    <div class="card-horizontal">
                                                        <figure class="mt-4 w-80">
                                                            <img class="w-80" src="{{asset('static/images/default-image.svg')}}" alt="">

                                                        </figure>
                                                        <div class="card-body pl-2">
                                                            <div class="d-flex justify-content-between">
                                                                <h4 class="card-title f-18 theme-text">“Awesome Service”</h4>
                                                                <div class="theme-text">
                                                                    <i class="fa fa-pencil p-1 mr-2"
                                                                        aria-hidden="true"></i><i
                                                                        class="fa fa-trash p-1"
                                                                        aria-hidden="true"></i></i>
                                                                </div>
                                                            </div>
                                                            <p class="card-text theme-text f-12">It was really smooth
                                                                trying
                                                                to move all our household items from Bengaluru to Mumbai
                                                                all the way, Thank you BIddnest for making it so smooth.
                                                            </p>
                                                            <small class="theme-text end  f-14">- Mohan Kumar, </small>
                                                            <small class="theme-text"><span class="end f-12">Senior Manager,
                                                                    Amazon</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card testimonials-card">
                                                    <div class="card-horizontal">
                                                        <figure class="mt-4 w-80">
                                                            <img class="w-80" src="{{asset('static/images/default-image.svg')}}" alt="">

                                                        </figure>
                                                        <div class="card-body pl-2">
                                                            <div class="d-flex justify-content-between">
                                                                <h4 class="card-title f-18 theme-text">“Awesome Service”</h4>
                                                                <div class="theme-text">
                                                                    <i class="fa fa-pencil p-1 mr-2"
                                                                        aria-hidden="true"></i><i
                                                                        class="fa fa-trash p-1"
                                                                        aria-hidden="true"></i></i>
                                                                </div>
                                                            </div>
                                                            <p class="card-text theme-text f-12">It was really smooth
                                                                trying
                                                                to move all our household items from Bengaluru to Mumbai
                                                                all the way, Thank you BIddnest for making it so smooth.
                                                            </p>
                                                            <small class="theme-text end f-14 ">- Mohan Kumar, </small>
                                                            <small class="theme-text"><span class="end f-12">Senior Manager,
                                                                    Amazon</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card testimonials-card">
                                                    <div class="card-horizontal">
                                                        <figure class="mt-4 w-80">
                                                            <img class="w-80" src="{{asset('static/images/default-image.svg')}}" alt="">

                                                        </figure>
                                                        <div class="card-body pl-2">
                                                            <div class="d-flex justify-content-between">
                                                                <h4 class="card-title f-18 theme-text">“Awesome Service”</h4>
                                                                <div class="theme-text">
                                                                    <i class="fa fa-pencil p-1 mr-2"
                                                                        aria-hidden="true"></i><i
                                                                        class="fa fa-trash p-1"
                                                                        aria-hidden="true"></i></i>
                                                                </div>
                                                            </div>
                                                            <p class="card-text theme-text f-12">It was really smooth
                                                                trying
                                                                to move all our household items from Bengaluru to Mumbai
                                                                all the way, Thank you BIddnest for making it so smooth.
                                                            </p>
                                                            <small class="theme-text end f-14">- Mohan Kumar, </small>
                                                            <small class="theme-text"><span class="end f-12">Senior Manager,
                                                                    Amazon</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card testimonials-card">
                                                    <div class="card-horizontal">
                                                        <figure class="mt-4 w-80">
                                                            <img class="w-80" src="{{asset('static/images/default-image.svg')}}" alt="">

                                                        </figure>
                                                        <div class="card-body pl-2">
                                                            <div class="d-flex justify-content-between">
                                                                <h4 class="card-title f-18 theme-text">“Awesome Service”</h4>
                                                                <div class="theme-text">
                                                                    <i class="fa fa-pencil p-1 mr-2"
                                                                        aria-hidden="true"></i><i
                                                                        class="fa fa-trash p-1"
                                                                        aria-hidden="true"></i></i>
                                                                </div>
                                                            </div>
                                                            <p class="card-text theme-text f-12">It was really smooth
                                                                trying
                                                                to move all our household items from Bengaluru to Mumbai
                                                                all the way, Thank you BIddnest for making it so smooth.
                                                            </p>
                                                            <small class="theme-text end f-14">- Mohan Kumar, </small>
                                                            <small class="theme-text"><span class="end f-12">Senior Manager,
                                                                    Amazon</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card testimonials-card">
                                                    <div class="card-horizontal">
                                                        <figure class="mt-4 w-80">
                                                            <img class="w-80" src="{{asset('static/images/default-image.svg')}}" alt="">

                                                        </figure>
                                                        <div class="card-body pl-2">
                                                            <div class="d-flex justify-content-between">
                                                                <h4 class="card-title f-18 theme-text">“Awesome Service”</h4>
                                                                <div class="theme-text">
                                                                    <i class="fa fa-pencil p-1 mr-2"
                                                                        aria-hidden="true"></i><i
                                                                        class="fa fa-trash p-1"
                                                                        aria-hidden="true"></i></i>
                                                                </div>
                                                            </div>
                                                            <p class="card-text theme-text f-12">It was really smooth
                                                                trying
                                                                to move all our household items from Bengaluru to Mumbai
                                                                all the way, Thank you BIddnest for making it so smooth.
                                                            </p>
                                                            <small class="theme-text end f-14">- Mohan Kumar, </small>
                                                            <small class="theme-text"><span class="end f-12">Senior Manager,
                                                                    Amazon</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card testimonials-card">
                                                    <div class="card-horizontal">
                                                        <figure class="mt-4 w-80">
                                                            <img class="w-80" src="{{asset('static/images/default-image.svg')}}" alt="">

                                                        </figure>
                                                        <div class="card-body pl-2">
                                                            <div class="d-flex justify-content-between">
                                                                <h4 class="card-title f-18 theme-text">“Awesome Service”</h4>
                                                                <div class="theme-text">
                                                                    <i class="fa fa-pencil p-1 mr-2"
                                                                        aria-hidden="true"></i><i
                                                                        class="fa fa-trash p-1"
                                                                        aria-hidden="true"></i></i>
                                                                </div>
                                                            </div>
                                                            <p class="card-text theme-text f-12">It was really smooth
                                                                trying
                                                                to move all our household items from Bengaluru to Mumbai
                                                                all the way, Thank you BIddnest for making it so smooth.
                                                            </p>
                                                            <small class="theme-text end f-14">- Mohan Kumar, </small>
                                                            <small class="theme-text"><span class="end f-12">Senior Manager,
                                                                    Amazon</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pagination mb-2 mt-0">
                                            <ul>
                                                <li class="p-1">Page</li>
                                                <li class="digit">1</li>
                                                <li class="label">of</li>
                                                <li class="digit">20</li>
                                                <li class="button mt-2"><a href="#"><img src="{{asset('static/images/Backward.svg')}}"></a></li>
                                                <li class="button mt-2"><a href="#"><img src="{{asset('static/images/forward.svg')}}"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
</div>

@endsection