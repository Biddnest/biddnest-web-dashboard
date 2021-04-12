@extends('layouts.app')
@section('title') Categories @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createsubcategory">
    <div class="d-flex flex-row justify-content-between">
        <h3 class="heading1 p-4">Create Subcategory</h3>
    </div>

    <!-- Dashboard cards -->
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-5 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Categories
                    </li>
                    <li class="breadcrumb-item"><a href="Push-Notifications.html">Subcategory Management</a></li>
                    <li class="breadcrumb-item"><a href="#">Create Subcategory</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-center Dashboard-lcards">
        <div class="col-sm-10">
            <div class="card h-auto p-0 p-10">
                <div class="card-head right text-left border-bottom-2 p-8">
                    <h3 class="f-18 mb-4 theme-text">
                      Create Subcategory
                    </h3>
                </div>
                <div class="" id="">
                    <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                      <!-- form starts -->
                      <form class="form-new-order pt-4 mt-3 input-text-blue" >
                        <div class="d-flex row">
                          <div class="col-lg-6">
                            <p class="img-label">Photo</p>
                            <div class="upload-section p-20 pt-0">
                              <img class="upload-preview" src="{{asset('static/images/upload-image.svg')}}" alt=""/>
                              <div class="ml-1">
                                <div class="file-upload">
                                  <input type="file" />
                                    <input type="hidden" class="base-holder" name="image" value="" required />
                                  <button class="btn theme-bg white-text my-0">
                                    UPLOAD IMAGE
                                  </button>
                                </div>
                                <p>Max File size: 1MB</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">

                          </div>
                        </div>
                        <div class="d-flex row p-20">
                            <div class="col-lg-6">
                                <div class="form-input">
                                  <label class="full-name">Name</label>
                                  <input type="text" id="banner_name" placeholder="Name" class="form-control br-5"/>
                                  <span class="error-message">Please enter a valid banner name</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                  <label class="phone-num-lable">Zone</label>
                                    <select class="form-control br-5 field-toggle select-box" name="zones[]" multiple>

                                        @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                                            <option value="{{$zone->id}}">{{$zone->name}}</option>
                                        @endforeach
                                    </select>
                                  <span class="error-message">Please enter valid Phone number</span>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-input">
                                  <label class="phone-num-lable">Category Name</label>
                                    <select class="form-control br-5 field-toggle select-box" name="category[]" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                  <span class="error-message">Please enter valid Phone number</span>
                                </div>
                              </div>
                              <div class="col-sm-12   border-top-pop mtop-20">
                                <div class="theme-text f-14 bold pt-10">
                                   List
                                </div>
                              </div>
                            <div class="col-sm-12 mtop-20  p-2 pb-0 " style="padding: 10px 11px !important;" >
                                <div class="heading p-8 border-around m-auto " >
                                    List
                                </div>

                                <table class="table text-center p-10 theme-text tb-border2" id="itms">
                                    <thead class="secondg-bg bx-shadowg p-0 f-14">
                                    <tr class="">
                                        <th scope="col  " class="text-left">Item Name</th>

                                        <th scope="col  " class="text-left">Material</th>

                                        <th scope="col  " class="text-left">Size</th>

                                        <th scope="col ">Quantity</th>

                                        <th scope="col ">Operations</th>
                                    </tr>


                                    </thead>
                                    <tbody class="mtop-20 f-13" id="add-inventory-wrapper">
                                    <tr class="inventory-snip">
                                        <th scope="row" class="text-left">
                                            <select class="form-control br-5 inventory-select" name="inventoryy[][name]" required>
                                                <option value="">--Select--</option>
                                                @foreach($inventories as $inventory)
                                                    <option id="inventory_{{$inventory->id}}" value="{{$inventory->id}}" data-size="{{$inventory->size}}" data-material="{{$inventory->material}}" >{{$inventory->name}}</option>
                                                @endforeach
                                            </select>
                                        </th>

                                        <td class="">
                                            <select class="form-control br-5 material" name="inventory[][material]" required>
                                                <option value="">--Choose Inventory First--</option>
                                            </select>
                                        </td>

                                        <td class="">
                                            <select class="form-control br-5 size" name="inventory[][size]" id="size" required>
                                                <option value="">--Choose Inventory First--</option>
                                            </select>
                                        </td>

                                        <td class="" style="width: 20%;">
                                            <input class="form-control br-5" type="number" name="inventory[][quantity]" required>
                                        </td>

                                        <td>
                                            <span class="closer" data-parent=".inventory-snip"><i class="fa fa-trash p-1 cursor-pointer" aria-hidden="true"></i></span>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12 mtop-20 w-30">
                                <a class="float-right btn theme-bg white-text repeater" data-content="#add-inventory-row" data-container="#add-inventory-wrapper"  id="addnew-btn" >
                                    <i class="fa fa-plus  m-1" aria-hidden="true"></i>
                                    Add Inventory</a>

                            </div>
                        </div>
                        <div>
                          <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                            <div class="w-50">
                              <a class="white-text p-10" href="#">
                                  <button class="btn theme-br theme-text w-30 white-bg br-5">
                                    Cancel
                                  </button>
                              </a>
                            </div>
                            <div class="w-50 text-right">
                              <a class="white-text p-10">
                                  <button class="btn theme-bg white-text w-30 br-5">
                                    Save
                                  </button>
                              </a>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
        </div>
    </div>
</div>

<script type="text/html" id="add-inventory-row">
    <tr class="inventory-snip">
        <th scope="row" class="text-left">
            <select class="form-control br-5 inventory-select" name="inventoryy[][name]" required>
                <option value="">--Select--</option>
                @foreach($inventories as $inventory)
                    <option id="inventory_{{$inventory->id}}" value="{{$inventory->id}}" data-size="{{$inventory->size}}" data-material="{{$inventory->material}}" >{{$inventory->name}}</option>
                @endforeach
            </select>
        </th>

        <td class="">
            <select class="form-control br-5 material" name="inventory[][material]" required>
                <option value="">--Choose Inventory First--</option>
            </select>
        </td>

        <td class="">
            <select class="form-control br-5 size" name="inventory[][size]" id="size" required>
                <option value="">--Choose Inventory First--</option>
            </select>
        </td>

        <td class="" style="width: 20%;">
            <input class="form-control br-5" type="number" name="inventory[][quantity]" required>
        </td>

        <td>
            <span class="closer" data-parent=".inventory-snip"><i class="fa fa-trash p-1 cursor-pointer" aria-hidden="true"></i></span>
        </td>
    </tr>
</script>

@endsection
