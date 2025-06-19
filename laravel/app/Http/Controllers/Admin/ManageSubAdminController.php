<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Front\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Mail\ResetSubAdminPassword;
use App\Mail\SubAdminMail;
use File;
use Response;
use Session;
use DataTables;
use DB;
use Mail;

class ManageSubAdminController extends Controller
{
	public function sub_admin()
    {
        if(request()->ajax()){
			return datatables()->of(Admin::latest()->where("type",3)->get())->editColumn('created_at', function($request){
					return $request->created_at->format( $this->defaultDateFormat );
				})->make(true);
        }
		return view('admin.manage-sub-admin.index');
	}

    public function add_sub_admin(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'company_name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:250',
			'role' => 'required',
		],[
			'company_name.required' => 'Company name is required field',
			'username.required' => 'Username is required field',
			'email.required' => 'Email is required field',
			'role.required' => 'Role is required field',
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
			'email' => $request->email,
			'password' => Hash::make($password),
			'company_name' => $request->company_name,
			'username' => $request->username,
			'type' => 3,
            'role_id' => $request->role,
            'profile_image'=> "",
		]);
		
		Mail::to($admin->email)->send(new SubAdminMail($admin,$password));
		
		return back()->with('success','Sub Admin added successfully!');
	}

    public function reset_password(Request $request){

        if( $request->has('password_pop') && !empty($request->password_pop) ){
			$password = $request->password_pop;
        }else{  
			$password = random_int(100000, 999999);
        }
		
        $admin = Admin::find($request->id);

        $mail = "<b>Your new password :</b> {$password}";

        Mail::to($admin->email)->send(new ResetSubAdminPassword($mail));

        $admin->password = Hash::make($password);
        $admin->save();

        return back()->with('success','Your new password send to your registered email address!');
     }

    public function update_sub_admin(Request $request){

        $v = Validator::make($request->all(), [
            'company_name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:250',
            'role' => 'required',
           ]);

		if ($v->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($v->errors()->first());
        }

        $admin= Admin::find($request->id);

        $admin->company_name = $request->company_name;
		$admin->username = $request->username;
        $admin->email = $request->email;
        $admin->role_id = $request->role;

        $admin->save();

        return back()->with('success','Sub Admin updated successfully!');
	}


    public function remove_sub_admin(Request $request){

		$data = Admin::find($request->id);
		Admin::where("id",$data->id)->delete();

		return back()->with('success','Sub Admin deleted successfully!');
    }


    public function sub_admin_status(Request $request){

          if($request->has("id")){

            $admin = Admin::find($request->id);

            if($admin["status"] == 0){
                $admin->status = 1;
                $admin->update();
                return $this->response("Sub Admin Enabled successfully...");
            }
            else if($admin["status"] == 1){
                $admin->status = 0;
                $admin->update();
                return $this->response("Sub Admin Dis   abled successfully...");
            }
        }
    }
}
