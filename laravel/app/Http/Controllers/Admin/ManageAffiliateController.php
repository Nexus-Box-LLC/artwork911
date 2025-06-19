<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Affiliate;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Mail\AffiliateMail;
use Mail;


class ManageAffiliateController extends Controller
{

	public function index(){

		return view('admin.manage-affiliate.index');
	}

	public function get_affiliate(){

		if(request()->ajax()){
			return datatables()->of(Affiliate::latest())->editColumn('created_at', function($request){
					return $request->created_at->format( $this->defaultDateFormat );
				})->make(true);
        }
		return view('admin.manage-affiliate.index');
	}

	public function add_affiliate(Request $request){

		$v = Validator::make($request->all(), [
            'company_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'contact_name' => 'required',
		]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors()->first());
        }

		$has = Affiliate::where("company_name", $request->company_name)->first();

		if($has){
			return back()->with('error','Company name already exist..');
		}

		$company_slug = ucwords($request->company_name);
		$final_slug = str_replace(' ', '-',$company_slug);

		$affiliate = new Affiliate();

		$affiliate->company_name = $request->company_name;
		$affiliate->phone = $request->phone;
		$affiliate->email = $request->email;
		$affiliate->main_contact_name = $request->contact_name;
		$affiliate->link = $final_slug;


        $user = "<b>Company name:</b> ".$request->company_name."<br />";
		$user .="<b>Email:</b> ".$request->email."<br />";
		$user .="<b>Phone:</b> ".$request->phone."<br />";
		$user .="<b>Contact person:</b> ".$request->contact_name."<br />";
		$user .="<b>Link:</b> ".$request->$final_slug;

		Mail::to($request->email)->send(new AffiliateMail($user));

        $affiliate->save();

        return back()->with('success','Affiliate added successfully.');
	}

	public function get_specific_affiliate($id){
		 if(request()->ajax()){
            $affiliate = Affiliate::find($id);
            return response()->json(['result'=>$affiliate]);
		}
	}

	public function update_affiliate(Request $request){

		$v = Validator::make($request->all(), [
            'company_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'contact_name' => 'required',
		]);
		
        if ($v->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($v->errors()->first());
        }

		$has = Affiliate::where("company_name", $request->company_name)->first();

		if($has){
			return back()->with('error','Company name already exist..');
		}

		$company_slug = ucfirst($request->company_name);
		$final_slug = str_replace(' ', '-', strtolower($company_slug));

		$affiliate = Affiliate::find($request->id);

		$affiliate->company_name = $request->company_name;
		$affiliate->phone = $request->phone;
		$affiliate->email = $request->email;
		$affiliate->main_contact_name = $request->contact_name;
		$affiliate->link = $final_slug;

		$affiliate->save();

		return back()->with('success','Affiliate added successfully.');
	}
	
	public function remove_affiliate(Request $request){
		Affiliate::where("id",$request->id)->delete();
		return back()->with('success','Affiliate deleted successfully!');
	}

}
