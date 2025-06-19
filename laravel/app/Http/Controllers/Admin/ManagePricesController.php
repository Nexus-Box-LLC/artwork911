<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\DigitizingPrice;
use App\Models\Admin\VectorizingpPrice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Response;
use Session;
use DB;

class ManagePricesController extends Controller
{
	public function index(){

		$vprice = VectorizingpPrice::all();
		$dprice = DigitizingPrice::all();

		return view('admin.manage-prices.index',compact('vprice','dprice'));
	}

	public function vectorizing_price(Request $request){

		$v = Validator::make($request->all(), [
            'simple' => 'required',
            'complex' => 'required',
            'logo_design' => 'required',
			'color_sepration' => 'required',
           ]);

		if ($v->fails()){
			return redirect()->back()->withInput($request->input())->withErrors($v->errors()->first());
		}

		$vp = VectorizingpPrice::find($request->id);

		$vp->simple=$request->simple;
		$vp->complex=$request->complex;
		$vp->logo_design=$request->logo_design;
		$vp->color_seprater=$request->color_sepration;

		$vp->save();

		return back()->with('success','Vectorizing price updated successfully!');
	}

	public function digitizing_price(Request $request){

		if($request->has("id") && $request->has("placement") && $request->has("price") && $request->has("width") && $request->has("height")){

			//$id = implode(",", $request->id);

			//DB::statement("DELETE FROM digitizing_prices WHERE id IN( SELECT id FROM digitizing_prices WHERE id NOT IN({$id}))");

			foreach($request->placement as $index=>$placement){

				$price = $request->price[$index];
				$max_width = $request->width[$index];
				$max_height = $request->height[$index];
				$id = $request->id[$index];

				$in_arr = [];
				$in_arr["placement"] = $placement;
				$in_arr["price"] = $price;
				$in_arr["max_width"] = $max_width;
				$in_arr["max_height"] = $max_height;

				//if($id==-1){
					//DigitizingPrice::insert($in_arr);
				//}
				//else
				//{
					DB::table('digitizing_prices')->where('id', $id)->update($in_arr);
				//}
			}
		}
		//else
		//{
			//DigitizingPrice::truncate();
        //}
		return back()->with('success','Digitizing price updated successfully.');
	}
}
