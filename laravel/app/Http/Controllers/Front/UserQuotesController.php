<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rules\MatchOldPasswordUser;
use App\Models\Front\Qoute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use Response;

class UserQuotesController extends HomeController
{
    public function user_qoutes(){
		
		$user_id = Auth::guard('user')->user()->id;

		$digitizingorders = Qoute::select("*")
							->Where([
								['status',"=", 0],
								['type','=', 0],
								['user_id','=',$user_id]
							])
							->orderBy('id','desc');
							
		$digitizingorders = $digitizingorders->paginate(3,['*'],'digitizingorders');

        $vectorizingorders = Qoute::select("*")
							->Where([
								['status',"=", 0],
								['type','=', 1],
								['user_id','=',$user_id]
							])
							->orderBy('id','desc');
							
		$vectorizingorders = $vectorizingorders->paginate(3,['*'],'vectorizingorders');
		
		return view('front.user-qoutes.index',compact('digitizingorders','vectorizingorders'));
    }

	public function create_quote(){
        $allow_exts = ["GIF","JPG","TIF","PDF","BMP","EPS","CDR","PCX","TIFF","JPEG","CND","PPT","FDR","BAR","DST","EMB","MLS","ISI","0OO","DSZ","T09","FMC","DSB","PXF","POF"];
		return view('front.user-qoutes.create-quote',['allow_exts' => $allow_exts]);
	}

	public function artwork_qoute(Request $request)
	{
		$user = Auth::guard('user')->user();
		
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

		$halftone = '-1';
		
		if( $request->has('color_type') && $request->color_type == 0 && $request->color_type != '' ){
			$halftone = $request->require_halftones;
		} 
        
		$not_sure = '-1';
		
		if( $request->has('not_sure') && $request->not_sure != '' ) {
			$not_sure = $request->not_sure;
		} 
		
		$imagename1='';

		if($request->hasfile('file_1') ){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "artwork-quote";

			$imagename1 = $imageSlug . '-' . $randomNumber . '.' . $request->file_1->extension();

			$request->file_1->move(public_path('Front/artwork-qoute'),$imagename1);
		}

		$imagename2 = "";
		
		if($request->hasfile('file_2')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "artwork-quote";

			$imagename2 = $imageSlug . '-' . $randomNumber . '.' . $request->file_2->extension();

			$request->file_2->move(public_path('Front/artwork-qoute'),$imagename2);
		}
		 
		 
		$imagename3 = "";

		if($request->hasfile('file_3')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "artwork-quote";

			$imagename3 = $imageSlug . '-' . $randomNumber . '.' . $request->file_3->extension();

			$request->file_3->move(public_path('Front/artwork-qoute'),$imagename3);
		}
		 
		 
		$imagename4 = "";

		if($request->hasfile('file_4')){
			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "artwork-quote";

			$imagename4 = $imageSlug . '-' . $randomNumber . '.' . $request->file_4->extension();
			$request->file_4->move(public_path('Front/artwork-qoute'),$imagename4);
		}
		
		$order_number = $this->get_quote_id();

		$artwork_order = Qoute::Create([
			'order_number' => $order_number,
			'type' => 1,
			'status' => 0,
			'user_id' => $user->id,
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
			'file_1' => $imagename1,
			'file_2' => $imagename2,
			'file_3' => $imagename3,
			'file_4' => $imagename4,
			'is_virtual_sample' => $request->virtual_sample,
			'art_printing_type' => $request->art_printing_type,
			'difficulty_level' => $request->difficulty_level,
			'require_halftones' => $halftone,
			'color_type' => $request->color_type,
			'color_separation_required' => $request->color_separation_required,
			'design_not_sure' => $not_sure,
			'vendor_id' => 0
		]);

        return $this->response("Vectorizing qoute placed successfully");
    }

    public function digitizing_qoute(Request $request){
		
		$user = Auth::guard('user')->user();

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
			'file_1.mimes' => 'This file extension is not allowed',
			'file_1.max' => 'File size is more than 20 mb'
		]);

		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

		if($request->fabric_name == "Other"){
			$fabric_name = $request->other_fabric_name;
		}else{
			$fabric_name = $request->fabric_name;
		}

		if ( $request->has('garment_placement') && ($request->garment_placement == "Jacket Back"  ||  $request->garment_placement == "Full Front" ) ){
			$jacket_back = 1;
		}else{
			$jacket_back = 0;
		}
		
		$imagename1 = "";

		if($request->hasfile('file_1')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "digitizing-qoute";

			$imagename1 = $imageSlug . '-' . $randomNumber . '.' . $request->file_1->extension();

			$request->file_1->move(public_path('Front/digitizing-qoute'),$imagename1);
		}

		$imagename2 = "";
		
		if($request->hasfile('file_2')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "digitizing-qoute";

			$imagename2 = $imageSlug . '-' . $randomNumber . '.' . $request->file_2->extension();

			$request->file_2->move(public_path('Front/digitizing-qoute'),$imagename2);
		}

		$imagename3 = "";
		
		if($request->hasfile('file_3')){

			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "digitizing-qoute";

			$imagename3 = $imageSlug . '-' . $randomNumber . '.' . $request->file_3->extension();

			$request->file_3->move(public_path('Front/digitizing-qoute'),$imagename3);
		}
		
		$imagename4 = "";

		if($request->hasfile('file_4')){
			
			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "digitizing-qoute";

			$imagename4 = $imageSlug . '-' . $randomNumber . '.' . $request->file_4->extension();
			$request->file_4->move(public_path('digitizing-qoute'),$imagename4);
		}

		$order_number = $this->get_quote_id();

		$digitizing_order = Qoute::Create([
			'order_number' => $order_number,
			'type' => 0,
			'status' => 0,
			'user_id' => $user->id,
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
			'file_1' => $imagename1,
			'file_2' => $imagename2,
			'file_3' => $imagename3,
			'file_4' => $imagename4,
			'is_virtual_sample' => $request->virtual_sample,
			'art_printing_type' => -1,
			'difficulty_level' => -1,
			'require_halftones' => -1,
			'color_type' => -1,
			'color_separation_required' => -1,
			'design_not_sure' => -1,
			'vendor_id' => 0
		]);
		return $this->response("Digitizing qoute placed successfully");
    }

    public function qoute_details($id){

        $user_id = Auth::guard('user')->user()->id;

        $user_order = Qoute::Where('user_id','=',$user_id)->first();

        if(!empty($user_order))
        {
            $details = Qoute::find($id);
		    return view('front.user-qoutes.qoute-details', ['details' => $details]);
        }
        else{
            return redirect('user-qoutes');
        }
    }

    public function download_qoute_file($id,Request $request)
	{
        if($request->has('type') && $request->type == 'vo') {
			
			$filepath = public_path('Front/artwork-qoute/'.$id);
			
			if(!file_exists($filepath)){
				return back();
			}
		}
		
		if($request->has('type') && $request->type == 'do'){
			$filepath = public_path('Front/digitizing-qoute/'.$id);
			
			if(!file_exists($filepath)){
				return back();
			}
		}
		
		return Response::download($filepath);
    }

}
