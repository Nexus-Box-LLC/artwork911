<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Coupons;
use App\Models\Admin\DiscountHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DataTables;	

class ManageDiscountController extends Controller
{
    public function index(){
		 
		 return view('admin.manage-discounts.index');
	}
	
	public function get_coupons(){

		if(request()->ajax()){
			
			$coupons = Coupons::select(["*"])->get();
			
			return datatables()->of($coupons)->editColumn('expiry_date', function($request){
				$expiry_date = date("d-m-Y", strtotime($request->expiry_date));
				return $expiry_date;
			})->make(true);
        }
		return view('admin.manage-discounts.index');
	}
	
	public function add_coupon(Request $request){
		
		$v = Validator::make($request->all(), [
            'title' => 'required',
            'code' => 'required',
            'percentage' => 'required',
            'expiry_date' => 'required',
            'no_of_usage_per_account' => 'required',
		]);
        if ($v->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($v->errors()->first());
        }
		
		$coupon = new Coupons();
		
		$coupon->title = $request->title;
		$coupon->code = $request->code;
		$coupon->percentage = $request->percentage;
		$coupon->expiry_date = date("Y-m-d", strtotime($request->expiry_date)); 
		$coupon->no_of_usage_per_account = $request->no_of_usage_per_account;
		
		$coupon->save();
		
		return back()->with('success','Coupon added successfully!');
	}
	
	public function get_specific_coupon($id){
        if(request()->ajax()){
            $coupons = Coupons::find($id);
			$expiry_date = date("d-m-Y", strtotime($coupons->expiry_date));
            return response()->json(['result'=>$coupons,'expiry_date'=>$expiry_date]);
		}
	}
	
	public function update_coupon(Request $request){
		
		$v = Validator::make($request->all(), [
            'title' => 'required',
            'code' => 'required',
            'percentage' => 'required',
            'expiry_date' => 'required',
            'no_of_usage_per_account' => 'required',
		]);
        if ($v->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($v->errors()->first());
        }
		
		$coupon = Coupons::find($request->id);
		
		$coupon->title = $request->title;
		$coupon->code = $request->code;
		$coupon->percentage = $request->percentage;
		$coupon->expiry_date = date("Y-m-d", strtotime($request->expiry_date)); 
		$coupon->no_of_usage_per_account = $request->no_of_usage_per_account;
		
		$coupon->save();
		
		return back()->with('success','Coupon updated successfully!');
	}
	
	 public function remove_coupon(Request $request){
		Coupons::where("id",$request->id)->delete();
		return back()->with('success','Coupon deleted successfully!');
    }
}
