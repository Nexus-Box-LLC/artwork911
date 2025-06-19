<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\HomeController;
use Illuminate\Http\Request;
use App\Models\Front\User;
use App\Models\Admin\Admin;
use App\Models\Admin\Delivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Rules\MatchOldPasswordUser;
use App\Models\Front\Order;
use App\Models\Front\OrderHistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Admin\DigitizingPrice;
use App\Models\Admin\Coupons;
use App\Models\Admin\DiscountHistory;

class DigitizingOrderController extends HomeController
{
    public function create_digitizing_order(){

        $dprice = DigitizingPrice::all();
		$allow_exts = ["GIF","JPG","TIF","PDF","BMP","EPS","CDR","PCX","TIFF","JPEG","CND","PPT","FDR","BAR","DST","EMB","MLS","ISI","0OO","DSZ","T09","FMC","DSB","PXF","POF"];
		return view('front.orders.create-digitizing-order',compact('allow_exts','dprice'));
	}

	public function digitizing_order(Request $request){

        $validator = Validator::make($request->all(), [
			'design_name' => 'required|string|max:255',
			'required_file_format' => 'required',
			'ds_width' => 'required',
			'ds_height' => 'required',
			'ds_length' =>'required',
			'artwork_authorized' => 'required',
			'filled_with_stitching'=>'required',
			'file_1' => 'required|mimes:gif,jpg,tif,pdf,bmp,eps,cdr,pcx,tiff,jpeg,cnd,ppt,fdr,bar,dst,emb,mls,isi,0oo,dsz,t09,fmc,dsb,pxf,pof|max:20480'
		], [
			'design_name.required' => 'Please enter design name',
			'design_name.string' => 'Design name must be alphabetical',
			'design_name.max' => 'Design name must be less then 255 character',
			'required_file_format.required' => 'Please select required file format',
			'ds_width.required' => 'Please enter design width',
			'ds_height.required' => 'Please enter design height',
			'ds_length.required' => 'Please select length',
			'artwork_authorized.required' => 'Please select artwork authorized ',
			'filled_with_stitching.required'=>'Please select filled with stitching',
 			'file_1.required' => 'Please select the file',
			'file_1.mimes'=> 'This file extension is not allowed',
			'file_1.max'=> 'File size is more than 20 mb'
		]);

		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

		if($request->fabric_name == "Other"){
			$fabric_name = $request->other_fabric_name;
		}
		else{
			$fabric_name = $request->fabric_name;
		}

		if($request->garment_placement == "Jacket Back" || $request->garment_placement == "Full Front"){
			$jacket_back = 1;
		}
		else{
			$jacket_back = 0;
		}

		$image1 = "";
		
		if($request->has('file_1')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "digitizing-order";

			$image1 = $imageSlug . '-' . $randomNumber . '.' . $request->file_1->extension();

			$request->file_1->move(public_path('Front/digitizing-order'),$image1);
		}

        $image2 = "";
		
		if($request->has('file_2')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "digitizing-order";

			$image2 = $imageSlug . '-' . $randomNumber . '.' . $request->file_2->extension();

			$request->file_2->move(public_path('Front/digitizing-order'),$image2);
		}

        $image3 = "";
		
		if($request->has('file_3')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "digitizing-order";

			$image3 = $imageSlug . '-' . $randomNumber . '.' . $request->file_3->extension();

			$request->file_3->move(public_path('Front/digitizing-order'),$image3);
		}

        $image4 = "";

		if($request->has('file_4')){
			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "digitizing-order";

			$image4 = $imageSlug . '-' . $randomNumber . '.' . $request->file_4->extension();
			$request->file_4->move(public_path('Front/digitizing-order'),$image4);
		}


        $price = 0;
        $discount_amount = 0;
        $final_amount = 0 ;
        $discount = 0 ;

        if( $request->promo_code!=""){

            $has = Coupons::where("code", $request->promo_code)->first();

            if(!$has){
                return $this->response("Coupon code is invalid",true);
            }

            $currentdate = date('Y-m-d');

            $currentdate = date('Y-m-d', strtotime($currentdate));
            $expiry_date = date('Y-m-d', strtotime($has['expiry_date']));

            if ($currentdate > $expiry_date){
                return $this->response("Coupon code is expired",true);
            }

            $auth_user= Auth::guard('user')->user();
            $discount_history = DB::table('discounts_history')->select('*')->where('coupon_id',$has['id'])->where('user_id',$auth_user->id)->count();

            if($discount_history > $has['no_of_usage_per_account']){
                return $this->response("This coupon maximum times use by user",true);
            }

            $discount = $has['percentage'];

            $dprice = DigitizingPrice::where("placement", $request->garment_placement)->first();

            $price = $dprice['price'];

            $discount_amount = ($price * $discount) / 100;

            $final_amount = $price - $discount_amount;
        }

        $order_number = $this->get_ord_id();

		$digitizing_order = Order::Create([
			'order_number' => $order_number,
			'type' => 0,
			'status' => 0,
			'user_id' => $request->user_id,
			'design_name' => $request->design_name,
			'po' => $request->po,
			'required_file_format'=> $request->required_file_format,
			'fabric_name'=> $fabric_name,
			'garment_placement'=> $request->garment_placement,
			'is_jacket_back'=> $jacket_back,
			'ds_width' => $request->ds_width,
			'ds_height' => $request->ds_height,
			'ds_length' => $request->ds_length,
			'is_artwork_authorized' => $request->artwork_authorized,
			'is_filled_with_stitching' => $request->filled_with_stitching,
			'comments' => $request->comments,
			'file_1' => $image1,
			'file_2' => $image2,
			'file_3' => $image3,
			'file_4' => $image4,
			'is_virtual_sample' => $request->virtual_sample,
		    'art_printing_type' => -1,
			'difficulty_level' => -1,
			'require_halftones' => -1,
			'color_type' => -1,
			'color_separation_required' => -1,
			'design_not_sure' => -1,
			'vendor_id' => 0,
            'amount'=> $price,
            'discount_amount'=> $discount_amount,
            'total_amount'=> $final_amount,
            'promo_code'=> $request->promo_code,
            'discount_percent'=> $discount
		]);

        if($has){

            $coupon_history = DiscountHistory::create([
                'coupon_id'=> $has['id'],
                'user_id' => $request->user_id,
                'order_id' => $digitizing_order->id,
                'coupon_code' => $request->promo_code,
                'coupon_percent' => $discount,
            ]);
        }

        $place_order = OrderHistory::Create([
			'order_id'=> $digitizing_order->id,
			'by_user'=> Auth::guard('user')->user()->id,
			'user_type'=> -1,
			'description'=> "Order created on artwork911.com",
			'type'=> 0,
			'status'=> 0,
		]);

		return $this->response("Digitizing Order placed successfully");

	}
}
