<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Helper;
use Session;

class Route extends Controller
{
    public function login(Request $request)
    {       
        $validation = Validator::make($request->all(),[ 
            'username' => 'required|string',
            'password' => 'required',
        ]);
        if($validation->fails())
            return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::login($request->username, $request->password));
       
    }

    public function forgot_password_send_otp(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'phone' => 'required|max:12|min:10',
        ]);
        if($validation->fails())
            return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::forgotPasswordSendOtp($request->phone));
    }

    public function forgot_password_verify_otp(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'otp' => 'required'
        ]);
        if($validation->fails())
          return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
         return response()->json(AdminController::verifyOtp($request->otp, $request->bearer));
    }

    public function reset_password(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password'
        ]);
        if($validation->fails())
          return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::resetPassword($request->password, $request->bearer));
    }

    // public function dashboard()
    // {
    //     // if(Session::has('username'))
    //     // {
    //         return response()->json(AdminController::dashboard());
    //     // }
    //     // else
    //     // {
    //     //     return response()->json(Helper::response(false,"login first"));
    //     // }
    // }


    public function service_add(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'name' => 'required',
        ]);

        if($validation->fails())
          return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::serviceAdd($request->name));
    }

    public function service()
    {
        // if(Session::has('email'))
        // {
            return response()->json(AdminController::service());
        // }
        // else
        // {
        //     return response()->json(Helper::response(false,"login first"));
        // }
    }

    public function service_fetch($id)
    {
        return response()->json(AdminController::serviceFetch($id));
    }

    public function service_edit(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[ 
            'name' => 'required',
        ]);

        if($validation->fails())
          return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::serviceEdit($request->name, $id));
    }

    public function service_delete($id)
    {
        return response()->json(AdminController::serviceDelete($id));
    }

    public function sub_service()
    {
        return response()->json(AdminController::subService());
    }

    public function sub_service_add(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'service_id' => 'required',
            'name' => 'required'
        ]);

        if($validation->fails())
          return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::subServiceAdd($request->name, $request->service_id));
    }

    public function sub_service_edit(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[ 
            'service_id' => 'required',
            'name' => 'required'
        ]);
        if($validation->fails())
        return response()->json(Helper::response(false,"validation failed", $validation->errors()));
      else
          return response()->json(AdminController::subServiceEdit($request->name, $request->service_id, $id));
    }

    public function sub_service_fetch($id)
    {
        return response()->json(AdminController::subServiceFetch($id));
    }

    public function sub_service_delete($id)
    {
        return response()->json(AdminController::subServiceDelete($id));
    }

    public function inventories()
    {
        return response()->json(AdminController::inventories());
    }

    public function inventories_add(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'subservice_id' => 'required',
            'name' => 'required',
            'material' => 'required' 
        ]);

        $filename=""; 
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('inventory',$filename);
        }

        if($validation->fails())
          return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::inventoriesAdd($request->name, $request->subservice_id, $request->material, $filename));
    }

    public function inventories_edit(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[ 
            'subservice_id' => 'required',
            'name' => 'required',
            'material' => 'required' 
        ]);

        $filename=""; 
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('inventory',$filename);
        }

        if($validation->fails())
            return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::inventoriesEdit($request->name, $request->subservice_id, $request->material, $filename, $id));
    }

    public function inventories_fetch($id)
    {
        return response()->json(AdminController::inventoriesFetch($id));
    }

    public function inventories_delete($id)
    {
        return response()->json(AdminController::inventoriesDelete($id));
    }

    public function vendors()
    {
        return response()->json(AdminController::vendorsList());
    }

    public function vendor_add(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'fname' => 'required', 'email' => 'required',
            'lname' => 'required', 'phone' => 'required',
            'org_name' => 'required', 'gstin' => 'required',
            'add_line1' => 'required', 'add_line2' => 'required',
            'lat' => 'required', 'lng' => 'required',
            'zone' => 'required', 'state' => 'required',
            'city' => 'required', 'pincode' => 'required'
        ]);

        $filename=""; 
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('organization',$filename);
        }

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>$request->phone2, "gender"=>$request->gender, "gstin_no"=>$request->gstin, "org_description"=>$request->description, "address_line_1"=>$request->add_line1,"address_line_2"=>$request->add_line2);

        if($validation->fails())
            return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::vendorAdd($filename, $request->email, $request->phone, $request->org_name, $request->lat, $request->lng, $request->zone, $request->pincode, $request->city, $request->state, $request->service_type, $meta));
    }

    public function vendor_fetch($id)
    {
        return response()->json(AdminController::vendorFetch($id));
    }

    public function vendor_edit(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[ 
            'fname' => 'required', 'email' => 'required',
            'lname' => 'required', 'phone' => 'required',
            'org_name' => 'required', 'gstin' => 'required',
            'add_line1' => 'required', 'add_line2' => 'required',
            'lat' => 'required', 'lng' => 'required',
            'zone' => 'required', 'state' => 'required',
            'city' => 'required', 'pincode' => 'required'
        ]);

        $filename=""; 
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('organization',$filename);
        }

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>$request->phone2, "gender"=>$request->gender, "gstin_no"=>$request->gstin, "org_description"=>$request->description, "address_line_1"=>$request->add_line1,"address_line_2"=>$request->add_line2);

        if($validation->fails())
            return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::vendorEdit($id, $filename, $request->email, $request->phone, $request->org_name, $request->lat, $request->lng, $request->zone, $request->pincode, $request->city, $request->state, $request->service_type, $meta));
    }

    public function vendor_delete($id)
    {
        return response()->json(AdminController::vendorDelete($id));
    }

    public function vendors_kyc()
    {
        return response()->json(AdminController::kycList());
    }

    public function vendor_add_kyc(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'account_no' => 'required',
            'bank' => 'required', 'name' => 'required',
            'ifsc' => 'required', 'branch' => 'required'
        ]);

        $filename_bidnest_agreement=""; 
        if($request->hasfile('bidnest_agreement')){
            $file=$request->file('bidnest_agreement');
            $extension=$file->getClientOriginalExtension();
            $filename_bidnest_agreement=time().'.'.$extension;
            $file->move('bidnest_agreement',$filename_bidnest_agreement);
        }

        $filename_adhaar_card=""; 
        if($request->hasfile('adhaar_card')){
            $file=$request->file('adhaar_card');
            $extension=$file->getClientOriginalExtension();
            $filename_adhaar_card=time().'.'.$extension;
            $file->move('adhaar_card',$filename_adhaar_card);
        }

        $filename_pan_card=""; 
        if($request->hasfile('pan_card')){
            $file=$request->file('pan_card');
            $extension=$file->getClientOriginalExtension();
            $filename_pan_card=time().'.'.$extension;
            $file->move('pan_card',$filename_pan_card);
        }

        $filename_gst_certificate=""; 
        if($request->hasfile('gst_certificate')){
            $file=$request->file('gst_certificate');
            $extension=$file->getClientOriginalExtension();
            $filename_gst_certificate=time().'.'.$extension;
            $file->move('gst_certificate',$filename_gst_certificate);
        }


        $company_reg_certificate=""; 
        if($request->hasfile('company_reg_certificate')){
            $file=$request->file('company_reg_certificate');
            $extension=$file->getClientOriginalExtension();
            $company_reg_certificate=time().'.'.$extension;
            $file->move('company_reg_certificate',$company_reg_certificate);
        }

        $banking_details = array("account_no"=>$request->account_no, "bank"=>$request->bank, "name"=>$request->name, "ifsc"=>$request->ifsc, "branch"=>$request->branch);

        if($validation->fails())
            return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::vendorAddKyc($filename_bidnest_agreement, $filename_adhaar_card, $filename_pan_card, $filename_gst_certificate, $company_reg_certificate, $banking_details));
    }

    public function vendor_edit_kyc(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[ 
            'account_no' => 'required',
            'bank' => 'required', 'name' => 'required',
            'ifsc' => 'required', 'branch' => 'required'
        ]);

        $filename_bidnest_agreement=""; 
        if($request->hasfile('bidnest_agreement')){
            $file=$request->file('bidnest_agreement');
            $extension=$file->getClientOriginalExtension();
            $filename_bidnest_agreement=time().'.'.$extension;
            $file->move('bidnest_agreement',$filename_bidnest_agreement);
        }

        $filename_adhaar_card=""; 
        if($request->hasfile('adhaar_card')){
            $file=$request->file('adhaar_card');
            $extension=$file->getClientOriginalExtension();
            $filename_adhaar_card=time().'.'.$extension;
            $file->move('adhaar_card',$filename_adhaar_card);
        }

        $filename_pan_card=""; 
        if($request->hasfile('pan_card')){
            $file=$request->file('pan_card');
            $extension=$file->getClientOriginalExtension();
            $filename_pan_card=time().'.'.$extension;
            $file->move('pan_card',$filename_pan_card);
        }

        $filename_gst_certificate=""; 
        if($request->hasfile('gst_certificate')){
            $file=$request->file('gst_certificate');
            $extension=$file->getClientOriginalExtension();
            $filename_gst_certificate=time().'.'.$extension;
            $file->move('gst_certificate',$filename_gst_certificate);
        }


        $company_reg_certificate=""; 
        if($request->hasfile('company_reg_certificate')){
            $file=$request->file('company_reg_certificate');
            $extension=$file->getClientOriginalExtension();
            $company_reg_certificate=time().'.'.$extension;
            $file->move('company_reg_certificate',$company_reg_certificate);
        }

        $banking_details = array("account_no"=>$request->account_no, "bank"=>$request->bank, "name"=>$request->name, "ifsc"=>$request->ifsc, "branch"=>$request->branch);

        if($validation->fails())
            return response()->json(Helper::response(false,"validation failed", $validation->errors()));
        else
            return response()->json(AdminController::vendorEditKyc($id, $filename_bidnest_agreement, $filename_adhaar_card, $filename_pan_card, $filename_gst_certificate, $company_reg_certificate, $banking_details));
    }

    public function vendor_fetch_kyc($id)
    {
        return response()->json(AdminController::kycFetch($id));
    }

    public function vendor_delete_kyc($id)
    {
        return response()->json(AdminController::kycDelete($id));
    }

    public function vendors_list()
    {
        return response()->json(AdminController::vendorList());
    }

    public function vendors_org_fetch($id)
    {
        return response()->json(AdminController::vendorsOrgFetch($id));
    }
}
