<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\HomeController;
use Illuminate\Http\Request;
use App\Models\Front\User;
use App\Models\Admin\Admin;
use App\Models\Admin\Delivery;
use App\Models\Admin\Coupons;
use App\Models\Admin\DiscountHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Rules\MatchOldPasswordUser;
use App\Models\Front\Order;
use App\Models\Admin\VectorizingpPrice;
use App\Models\Front\OrderHistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;


class ArtworkOrderController extends HomeController
{
    public function create_artwork_order(){

        $vprice = VectorizingpPrice::all();
		$allow_exts = ["GIF","JPG","TIF","PDF","BMP","EPS","CDR","PCX","TIFF","JPEG","CND","PPT","FDR","BAR","DST","EMB","MLS","ISI","0OO","DSZ","T09","FMC","DSB","PXF","POF"];
		return view('front.orders.create-artwork-order',compact('allow_exts','vprice'));
	}

    public function apply_coupon_artwork_order(Request $request){

        if($request->has('code') ){

            $has = Coupons::where("code", $request->code)->first();

            if($has){

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
                $data = array( "discount" => $discount );

                return $this->response("Coupon code is applied",false, $data);
            }
            else
            {
               return $this->response("Coupon code is invalid",true);
            }
        }
    }


	public function artwork_order(Request $request)
	{

       $validator = Validator::make($request->all(), [
			'design_name' => 'required|string|max:255',
			'required_file_format' => 'required',
			'ds_width' => 'required',
			'ds_height' => 'required',
			'ds_length' =>'required',
			'color_type' => 'required',
			'art_printing_type' => 'required',
			'difficulty_level' => 'required',
			'file_1' => 'required|mimes:gif,jpg,tif,pdf,bmp,eps,cdr,pcx,tiff,jpeg,cnd,ppt,fdr,bar,dst,emb,mls,isi,0oo,dsz,t09,fmc,dsb,pxf,pof|max:20480'
		], [
			'design_name.required' => 'Please enter design name',
			'design_name.string' => 'Design name must be alphabetical',
			'design_name.max' => 'Design name must be less then 255 character',
			'required_file_format.required' => 'Please select required file format',
			'ds_width.required' => 'Please enter design width',
			'ds_height.required' => 'Please enter design height',
			'ds_length.required' => 'Please select length',
			'color_type.required' => 'Please select color type',
		 	'art_printing_type.required' => 'Please select art printing',
			'difficulty_level.required' => 'Please select difficulty level',
			'file_1.required' => 'Please select the file',
			'file_1.mimes'=>'This file extension is not allowed',
			'file_1.max'=>'File size is more than 20 mb'
		]);

		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

		if($request->color_type == "0"){
			$halftone = $request->require_halftones;
		}
		else{
			$halftone = "-1";
		}

        $not_sure = 0;

        if($request->not_sure != ""){
            $not_sure = $request->not_sure;
        }

        if($request->has('file_1') ){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "artwork-order";

			$image1 = $imageSlug . '-' . $randomNumber . '.' . $request->file_1->extension();

			$request->file_1->move(public_path('Front/artwork-order'),$image1);
		}

        $image2 = "";

		if($request->has('file_2')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "artwork-order";

			$image2 = $imageSlug . '-' . $randomNumber . '.' . $request->file_2->extension();

			$request->file_2->move(public_path('Front/artwork-order'),$image2);
		}

        $image3 = "";

        if($request->has('file_3')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "artwork-order";

			$image3 = $imageSlug . '-' . $randomNumber . '.' . $request->file_3->extension();

			$request->file_3->move(public_path('Front/artwork-order'),$image3);
		}

        $image4 = "";

        if($request->has('file_4')){
			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "artwork-order";

			$image4 = $imageSlug . '-' . $randomNumber . '.' . $request->file_4->extension();
			$request->file_4->move(public_path('Front/artwork-order'),$image4);
		}


        $discount = 0;
        $amount = 0;
        $discount_amount = 0;
        $final_amount = 0;

        if( $request->promo_code!="" ){

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

            $vprice = VectorizingpPrice::select('*')->limit(1)->first();

            $color_sepration_price = 0;

            if($request->has("color_separation_required")){
                $color_sepration_price = $vprice['color_seprater'];
            }

            if($request->difficulty_level==0){
                $dificulty_level_price = $vprice['simple'];
            }
            if($request->difficulty_level==1){
                $dificulty_level_price = $vprice['complex'];
            }
            if($request->difficulty_level==2){
                $dificulty_level_price = $vprice['logo_design'];
            }

            $amount = $color_sepration_price + $dificulty_level_price;

            $discount_amount = ($amount * $discount) / 100;

            $final_amount = $amount - $discount_amount;
        }

        $order_number = $this->get_ord_id();

		$artwork_order = Order::Create([
			'order_number' => $order_number,
			'type' => 1,
			'status' => 0,
			'user_id' => $request->user_id,
			'design_name' => $request->design_name,
			'po' => $request->po,
			'required_file_format'=> $request->required_file_format,
			'fabric_name'=> "",
			'garment_placement'=> "",
			'is_jacket_back'=> 0,
			'ds_width' => $request->ds_width,
			'ds_height' => $request->ds_height,
			'ds_length' => $request->ds_length,
			'is_artwork_authorized' => 0,
			'is_filled_with_stitching' => 0,
			'comments' => $request->comments,
			'file_1' => $image1,
			'file_2' => $image2,
			'file_3' => $image3,
			'file_4' => $image4,
			'is_virtual_sample' => $request->virtual_sample,
			'art_printing_type' => $request->art_printing_type,
			'difficulty_level' => $request->difficulty_level,
			'require_halftones' => $halftone,
			'color_type' => $request->color_type,
			'color_separation_required' => $request->color_separation_required,
			'design_not_sure' => $not_sure,
			'vendor_id' => 0,
            'amount'=> $amount,
            'discount_amount'=> $discount_amount,
            'total_amount'=> $final_amount,
            'promo_code'=> $request->promo_code,
            'discount_percent'=> $discount
        ]);

        if($has){
            $coupon_history = DiscountHistory::create([
                'coupon_id'=> $has['id'],
                'user_id' => $request->user_id,
                'order_id' => $artwork_order->id,
                'coupon_code' => $request->promo_code,
                'coupon_percent' => $discount,
            ]);
        }
        $place_order = OrderHistory::create([

			'order_id'=> $artwork_order->id,
			'by_user'=> $request->input('user_id'),
			'user_type'=> -1,
			'description'=> "Order created on artwork911.com",
			'type'=> 0,
			'status'=> 0,
		]);

		return $this->response("Vectorizing Order placed successfully");
    }
}
