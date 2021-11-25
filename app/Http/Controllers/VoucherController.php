<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Enums\VoucherEnums;
use App\Models\Voucher;
use App\Helper;
use App\Models\VoucherCode;

class VoucherController extends Controller
{
    public static function create($image, $name, $title, $desc, $provider, $provider_url, $max_redemptions, $type, $codes){
        $voucher_exists = Voucher::where("name", $name)->first();

        if($voucher_exists)
            return Helper::response(false, "Another voucher with same name exists. Enter a new name.");

        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $image_name = "service".$name."-".uniqid().".png";

        $voucher = new Voucher();
        $voucher->image = Helper::saveFile($imageman->make($image)->resize(256,256)->encode('png', 100),$image_name,"services");

        $voucher->name = $name;
        $voucher->title = $title;
        $voucher->desc = $desc;
        $voucher->meta = null;
        $voucher->provider = $provider;
        $voucher->provider_url = $provider_url != "" ? $provider_url : null;
        $voucher->max_redemptions = $max_redemptions;
        $voucher->type = $type;
        $voucher->status = VoucherEnums::$STATUS['active'];

        if($voucher->save()){
            foreach($codes as $code){
                $vcode = new VoucherCode;
                $vcode->voucher_id = $voucher->id;
                $vcode->user_id = null;
                $vcode->voucher_code = $code['code'];
                $vcode->expires_at = $code['expires_at'];
                $vcode->meta = null;
                $vcode->status = VoucherEnums::$CODE_STATUS['open'];
                $vcode->save();
            }

            return Helper::response(true,"Voucher has been saved.", ["voucher"=>$voucher]);
        }
        else{
            return Helper::response(false,"Could'nt save voucher. Something went wrong.");
        }

    }

    public static function edit($id, $image, $name, $title, $desc, $provider, $provider_url, $max_redemptions, $type, $codes){
        $voucher_exists = Voucher::find($id);

        if(!$voucher_exists)
            return Helper::response(false, "Sorry this voucher code does not exists.");

        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $image_name = "service".$name."-".uniqid().".png";

        $voucher = Voucher::where("id",$id)->update([
            "image" => Helper::saveFile($imageman->make($image)->resize(256,256)->encode('png', 100),$image_name,"services"),
        "name" => $name,
        "title" => $title,
        "desc" => $desc,
        "meta" => null,
        "provider" => $provider,
        "provider_url" => $provider_url != "" ? $provider_url : null,
        "max_redemptions" => $max_redemptions,
        "type" => $type,
        ]);


        if($voucher){
            VoucherCode::where("voucher_id", $id)->delete();

            foreach($codes as $code){
                $vcode = new VoucherCode;
                $vcode->voucher_id = $voucher->id;
                $vcode->user_id = null;
                $vcode->voucher_code = $code['code'];
                $vcode->expires_at = $code['expires_at'];
                $vcode->meta = null;
                $vcode->status = VoucherEnums::$CODE_STATUS['open'];
                $vcode->save();
            }

            return Helper::response(true,"Voucher has been updated.", ["voucher"=>$voucher]);
        }
        else{
            return Helper::response(false,"Could'nt update voucher. Something went wrong.");
        }
    }

    public static function delete($id){
        $voucher_exists = Voucher::find($id);

        if(!$voucher_exists)
            return Helper::response(false, "Sorry this voucher code does not exists.");

        $delete_voucher = Voucher::where("id",$id)->update("deleted",CommonEnums::$YES);
        if($delete_voucher)
            return Helper::response(true,"Voucher has been deleted.");
        else
            return Helper::response(false,"Couldn't delete the voucher. Something went wrong.");

    }

    public static function assignToUser($voucher_id, $user_id, $output_bool=false){
        $voucher_exists = Voucher::where("status",VoucherEnums::$STATUS['active'])->find($voucher_id);

        if(!$voucher_exists)
            return $output_bool ? false : Helper::response(false, "Sorry this voucher code does not exists.");

        $voucher_code = VoucherCode::where("voucher_id",$voucher_id)
            ->where("status",VoucherEnums::$CODE_STATUS['open'])
            ->first();
        if(!$voucher_code)
            return  $output_bool ? false : Helper::response(false,"No voucher code is available to be assigned to this user. Try another voucher or add new voucher codes under this voucher.");

        $assign_voucher = VoucherCode::where("id",$voucher_id)->update([
            "user_id" => $user_id
        ]);

        if($assign_voucher)
            return $output_bool ? true:  Helper::response(true,"Voucher has been deleted.");
        else
            return  $output_bool ? false: Helper::response(false,"Couldn't delete the voucher. Something went wrong.");
    }
}
