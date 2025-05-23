<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Front\Order;
use App\Models\Front\OrderHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use File;
use Response;
use Session;
use DataTables;
use DB;
use Mail;
use App\Mail\ResetVendorPassword;
use App\Mail\VendorMail;

class ManageVendorController extends Controller
{
	public function index(){
        return view('admin.manage-vendor.index');
	}

	public function add_vendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:250',
        ],[
			'company_name.required' => 'Company name is required field',
			'username.required' => 'Username is required field',
			'email.required' => 'Email is required field',
		]);
		
        if ($validator->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($validator->errors()->first());
        }

		$has = Admin::where('email',$request->email)->first();
		
		if($has){
			return back()->with('error','This email address already register, try with another one.');
		}
		
		if( $request->has('password') && !empty($request->password) ){
			$password = $request->password;
        }else{  
			$password = random_int(100000, 999999);
        }

		$admin = Admin::create([
			'email' => $request->input('email'),
			'password' => Hash::make($password),
			'company_name' => $request->input('company_name'),
			'username' => $request->input('username'),
			'type' => 2,
            'role_id'=> 8,
            'profile_image'=>"",
		]);
		
		Mail::to($admin->email)->send(new VendorMail($admin,$password));

		return back()->with('success','Vendor added successfully!');
	}

	public function get_specific_vendor($id){
        if(request()->ajax()){
            $data = Admin::find($id);
            return response()->json(['result'=>$data]);
		}
	}

	 public function reset_vendor_password(Request $request){

        if( $request->has('password_pop') && !empty($request->password_pop) ){
			$password = $request->password_pop;
        }else{  
			$password = random_int(100000, 999999);
        }

        $admin= Admin::find($request->id);

        $mail = "<b>Your new password id:</b> ".$password."<br />";

        Mail::to($admin->email)->send(new ResetVendorPassword($mail));

        $admin->password = Hash::make($password);
        $admin->save();

        return back()->with('success','Your new password send to your registered email address!');
     }

	public function update_vendor(Request $request){

        $v = Validator::make($request->all(), [
            'company_name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:250',
		]);
        if ($v->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($v->errors()->first());
        }

        $admin= Admin::find($request->id);

        $admin->company_name = $request->input('company_name');
		$admin->username = $request->input('username');
        $admin->email = $request->input('email');

        $admin->save();

        return back()->with('success','Vendor updated successfully!');
	}

	public function remove_vandor(Request $request){

		$data = Admin::find($request->id);
		Admin::where("id",$data->id)->delete();

		return back()->with('success','Vendor deleted successfully!');
    }

	public function get_vendors(){

		if(request()->ajax()){
			return datatables()->of(Admin::latest()->where("type",2)->get())->editColumn('created_at', function($request){
					return $request->created_at->format( $this->defaultDateFormat );
				})->make(true);
        }
		return view('admin.manage-vendor.index');
	}

	public function vendor_status(){

        if(isset($_POST["id"])){

            $id = $_POST["id"];

            $admin = Admin::find($id);

            if($admin["status"] == 0){
                $admin->status = 1;
                $admin->update();
                return $this->response("Vendor Enabled successfully...");
            }
            else if($admin["status"] == 1){
                $admin->status = 0;
                $admin->update();
                return $this->response("Vendor Disabled successfully...");
            }
        }
    }



}
