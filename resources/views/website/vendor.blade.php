@extends('website.layouts.frame')
@section('title') Join Vendor @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="joinvendor">
        <header class="join-as-vendor h-300">
            <div class="continer">
                <div class="row">
                    <div class="col-lg-12 center d-flex ">
                        <h2 class="pt-100">Join as a Vendor</h2>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="quote responsive w-70 ontop p-4 bg-white">
                    <div class="card-body">
                        <h5 class="card-title border-bottom theme-text fw-500 pb-10">Your Details</h5>
                        <form>
                            <div class="row">

                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">First Name</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="David" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Last Name</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Jeromi" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Email Id</label>
                                        <input type="email" class="form-control" id="formGroupExampleInput" placeholder="davidjeromi@gmail.com" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="phone-num-lable">Phone Number</label>
                                        <input type="number" id="phone" placeholder="9990009900"
                                               class=" form-control form-control-tel" required>
                                        <span class="error-message">Please enter valid Phone number</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Designation</label>
                                        <select id="" class="form-control">
                                            <option>Vendor</option>
                                            <option>Sale</option>
                                            <option>Purchase</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                            Designation</span>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title border-bottom theme-text fw-500 pt-3  pb-10 mt-20">Organization Details
                            </h5>
                            <div class="row">

                                <div class="col-lg-6 col-xs-12 mt-1 pt-2">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Organization Name</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Organization Type</label>
                                        <select id="" class="form-control">
                                            <option>-Select-</option>
                                            <option>Commercial</option>
                                            <option>Local</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                            Organisation Type</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">GSTIN Nunber</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Address Line 1</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Address Line 2</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">City </label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">State</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Pincode</label>
                                        <input type="number" class="form-control" id="formGroupExampleInput2" required>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="comments">
                                <div class="button-bottom d-flex justify-content-between pt-4">
                                    <div class=""><a class="white-text " href="{{route('home')}}"><button type="button" class="btn btn-theme-w-bg">cancel</button></a>
                                    </div>
                                    <a href="" class="btn btn-theme-bg  white-bg">submit</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
