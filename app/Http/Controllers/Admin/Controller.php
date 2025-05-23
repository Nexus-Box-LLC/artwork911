<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Permission;
use App\Models\Admin\Admin;
use App\Models\Admin\Menu;
use App\Models\Admin\Role;
use App\Models\Front\Order;
use Session;
use DataTables;
use DB;
use Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $defaultDateFormat = "M d, Y";
	protected $defaultDateTimeFormat = "M d, Y h:i A";

	const RESULT_SUCCESS = "RC200";
	const RESULT_ERROR = "RC100";
	const RESULT_UNAUTH = "RC300";

	private $current_user;

	public function __construct(){

	}

	public function response($message,$error=false, $datax=array()){
        $data = [];
        $data["status"] = $error ? "RC100" : "RC200";
        $data["message"] = $message;
        $data["data"] = $datax;

        return response()->json($data);
    }

	public function index(){
        return view('admin.manage-vendor.index');
	}

	public function login(){

		return view('admin.auth.login');
	}

	public function admin_login(Request $request){

		$validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
		
        if ($validator->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($validator->errors()->first());
        }

        $credentials = $request->only('email', 'password');

		if (Auth::guard('web')->attempt($credentials)) {
			return redirect()->intended('admin/dashboard')->withSuccess('success','You are logged in successfully');
        }
		return back()->with('error','Username and password wrong!');
    }

	public function get_vendors(){

		if(request()->ajax()){
			return datatables()->of(Admin::latest()->where("type",2)->get())->editColumn('created_at', function($request){
					return $request->created_at->format( $this->defaultDateTimeFormat );
				})->make(true);
        }
		return view('admin.manage-vendor.index');
	}

	public function signout() {
        Auth::guard('web')->logout();
		return Redirect('/admin');
    }

	public function dashboard(){
		return view('admin.dashboard.index');
	}

	public function edit_profile(){
		$data = Admin::find( Auth::guard('web')->user()->id );
		return view('admin.auth.edit-profile',compact('data'));
	}

	public function update_profile(Request $request){

        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);
		
        if ($validator->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($validator->errors()->first());
        }
		
		$data = Admin::find( Auth::guard('web')->user()->id); 
		
		$has = Admin::where('email','=', $request->email)->where('email','!=',$data->email)->first();
		
		if($has){
			return back()->with('error','This email address already exists, try another one');
		}	

        if( $request->hasfile('profile_image') && !empty($request->has('profile_image'))){
			
			$path = 'Admi/admin_profile_image'.$data->profile_image;
			
			if( file_exists($path) && !empty($path) ){
				unlink($path);
			}
			
			$randomNumber = random_int(1000, 9999);
			$imageSlug =  "admin-profile";
        	
			$profile = $imageSlug . '-' . $randomNumber . '.' . $request->profile_image->extension();
			
			$request->profile_image->move(public_path('Admi/admin_profile_image'),$profile);
            
			$data->profile_image = $profile;
		}
		
		$data->company_name = $request->company_name;
		$data->username = $request->username;
		$data->email = $request->email;

		$data->save();

		return back()->with('success','Update Profile successfully.');
	}

	public function get_password(){

		$data = Admin::find( auth::user()->id );

		return view('admin.auth.change-password',['data'=>$data]);
	}

	public function change_password(Request $request){

       $v = Validator::make($request->all(), [
            'currentpassword' => ['required', new MatchOldPassword],
            'newpassword' => 'required',
            'newpasswordagain' => ['same:newpassword'],
        ]);
		
        if ($v->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($v->errors()->first());
        }

        Admin::find(Auth::guard('web')->user()->id)->update(['password'=> bcrypt($request->newpassword)]);

		return back()->with('success','Password change successfully.');
	}

    public function showAdminForgetPasswordForm()
    {
       return view('admin.auth.adminforgetpassword');
    }

    public function submitAdminForgetPasswordForm(Request $request){
		
		$validator = Validator::make($request->all(), [
            'email' => 'required|exists:admin,email',
        ]);
		
        if ($validator->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($validator->errors()->first());
        }
		
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token
        ]);

        Mail::send('emails.admin_forgot_password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success','We have e-mailed your password reset link.');
    }

    public function showAdminResetPasswordForm($token) {

		$token = DB::table('password_resets')->where('token' , $token)->first();

        if(!$token){
            return Redirect('admin')->with('error', 'Reset Password token is expired..!');
        }else{
            return view('admin.auth.adminforgetpasswordlink', ['token' => $token]);
        }
    }

    public function submitAdminResetPasswordForm(Request $request)
    {
      	$validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
		
		if ($validator->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($validator->errors()->first());
        }

        $admin_exist = DB::table('password_resets')->where(['token' => $request->token])->first();

		if(!$admin_exist){
            return Redirect('admin')->with('error', 'Reset Password token is expired');
        }

        $admin = Admin::where('email', $admin_exist->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where('email',$admin_exist->email)->delete();

        return Redirect('admin')->with('success','password reset successfully.');
    }
}
