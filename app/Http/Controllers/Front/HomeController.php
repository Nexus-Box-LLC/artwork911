<?php

namespace App\Http\Controllers\Front;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Front\User;
use App\Models\Admin\Admin;
use App\Models\VerifyUser;
use App\Models\Admin\Delivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Rules\MatchOldPasswordUser;
use App\Models\Front\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Mail\Test;
use Mail;
use App\Mail\VerifyMail;
use App\Mail\Contact;
use Redirect;
use App\Models\Front\TicketUpdate;

class HomeController
{
    protected $defaultDateFormat = "M d, Y";
	protected $defaultDateTimeFormat = "M d, Y h:i A";

	const RESULT_SUCCESS = "RC200";
	const RESULT_ERROR = "RC100";
	const RESULT_UNAUTH = "RC300";

	public function response($message,$error=false, $datax=array()){
        $data = [];
        $data["status"] = $error ? "RC100" : "RC200";
        $data["message"] = $message;
        $data["data"] = $datax;

        return response()->json($data);
    }

	public function send(Request $request){
		Mail::to("hardik@nexcesstech.com")->send(new Test());
	}

	public function index(){
		return view('front.dashboard.home');
	}

	public function login(){
		return view('front.auth.login');
	}

	public function user_dashboard(){
		return view('front.dashboard.dashboard');
	}

    public function user_register_view(){
        return view('front.auth.user-register');
    }

    public function user_login(Request $request){

        $validator = Validator::make($request->all(), [
			'email' => 'required',
			'password' => 'required'
		], [
			'email.required' => 'Please enter email address',
			'password.required' => 'Please enter password',
		]);

		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

		$credentials = $request->only('email', 'password');

		if (Auth::guard('user')->attempt($credentials)) {

            $user = Auth::guard('user')->attempt($credentials);

            if($user==1){

                $auth_user= Auth::guard('user')->user();

                if($auth_user->verified == 0){
                    return $this->response("Please activate account to access artwork911 portal",true);
                }
            }
            return $this->response("You are logged in successfully");
        }
        return $this->response("Entered username or password wrong",true);
	}

	public function user_logout() {
		Auth::guard('user')->logout();
		return Redirect('/');
	}

	public function update_user_profile(){

		$user = User::find( Auth::guard('user')->user()->id );
		return view('front.auth.update-profile',['user' => $user]);
	}

	public function update_user(Request $request){

        $validator = Validator::make($request->all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'username' => 'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ], [
			'first_name.required' => 'Please enter first name',
			'last_name.required' => 'Please enter last name',
			'username.required' => 'Please enter username',
			'email.required' => 'Please enter email',
			'email.email' => 'Please enter valid email address',
			'phone.required' => 'Please enter email',
			'phone.numeric' => 'Please enter only number in phone number',
    	]);

        if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

		$user = User::find(Auth::guard('user')->user()->id);
			$user->first_name = $request->first_name;
			$user->last_name = $request->last_name;
			$user->username =$request->username;
			$user->phone = $request->phone;
		$user->save();

        return $this->response("User profile update successfully!");
	}

	public function change_get_user_password(){
		return view('front.auth.change-password');
    }

	public function change_user_password(Request $request){

        $validator = Validator::make($request->all(), [
			'currentpassword' => array(
				'required', function($attribute, $value, $fail){
					if (!Hash::check($value, Auth::guard('user')->user()->password)) {
						$fail('Entered current password does not match with old password');
					}
				}
			),
			'newpassword' => 'required',
			'newpasswordagain' => 'required|same:newpassword'
		],[
			'currentpassword.required' => 'Please enter current password',
			'newpassword.required' => 'Please enter new password',
			'newpasswordagain.required' => 'Please enter confirm password',
			'newpasswordagain.same' => 'New & confirm password not match'
		]);

		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

        User::find(Auth::guard('user')->user()->id)->update(['password'=> bcrypt($request->input('newpassword'))]);

        return $this->response("Password changed sucessfully.");

	}

	public function get_ord_id()
	{
		$prefix = "ORD-";
		$date = date("mdY");

        $ord_id = DB::table('orders')->latest('id')->first();

		if(empty($ord_id)){


			return "{$prefix}{$date}-1";
		}else{

			$last_digit_array = explode("-",$ord_id->order_number);
			$last_digit = end($last_digit_array);

			$last_digit = $last_digit+1;

			return "{$prefix}{$date}-{$last_digit}";
		}
	}

    public function get_ticket_id(){
        $prefix = "CASE-";
		$date = date("mdY");

        $ord_id = DB::table('tickets')->latest('id')->first();

		if(empty($ord_id)){


			return "{$prefix}{$date}-1";
		}else{

			$last_digit_array = explode("-",$ord_id->ticket_number);
			$last_digit = end($last_digit_array);

			$last_digit = $last_digit+1;

			return "{$prefix}{$date}-{$last_digit}";
		}
    }

    public function get_quote_id()
	{
		$prefix = "Q-";
		$date = date("mdY");

        $ticket_id = DB::table('quotes')->latest('id')->first();

		if(empty($ticket_id)){
            return "{$prefix}{$date}-1";
		}else{

			$last_digit_array = explode("-",$ticket_id->order_number);
			$last_digit = end($last_digit_array);

			$last_digit = $last_digit+1;

			return "{$prefix}{$date}-{$last_digit}";
		}
	}

    public function contact_us(){
		return view('front.contact-us');
	}

    public function contact(Request $request){

        $validator = Validator::make($request->all(), [
			'full_name' => 'required',
			'email'=>'required|email',
            'phone'=>'required|numeric',
            'subject' => 'required',
            'message' => 'required'
        ], [
			'full_name.required' => 'Please enter full name',
			'email.required' => 'Please enter email',
			'email.email' => 'Please enter valid email address',
			'phone.required' => 'Please enter email',
			'phone.numeric' => 'Please enter only number in phone number',
            'subject.required' => 'Please enter subject',
            'message.required' => 'Please enter message',
        ]);


		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

		$user = "<b>Full name:</b> ".$request->input("full_name")."<br />";
		$user .="<b>Email:</b> ".$request->input("email")."<br />";
		$user .="<b>phone:</b> ".$request->input("phone")."<br />";
		$user .="<b>subject:</b> ".$request->input("subject")."<br />";
		$user .="<b>Message:</b> ".$request->input("message");

		Mail::to('hardik@nexcesstech.com')->send(new Contact($user));

		return $this->response("Thank you for query we will get back to you soon");
    }

	public function user_register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'first_name' => 'required',
			'last_name' => 'required',
			'username' => 'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'password' => 'required|min:6',
            'conf_password' => 'required|same:password'
        ], [
			'first_name.required' => 'Please enter first name',
			'last_name.required' => 'Please enter last name',
			'username.required' => 'Please enter username',
			'email.required' => 'Please enter email',
			'email.email' => 'Please enter valid email address',
			'phone.required' => 'Please enter email',
			'phone.numeric' => 'Please enter only number in phone number',
            'password.required' => 'Please enter password',
            'password.min' => 'Please enter minimum 6 character in password',
            'conf_password.required' => 'Please enter confirm password',
            'conf_password.same' => 'Entered new password and confirm new password not matched',
        ]);

		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

		if($request->filled('promo_code')){
			$promo_code = $request->promo_code;
		}
        else
        {
			$promo_code = "";
		}

        $email = User::where('email', $request->email)->first();

        if($email)
        {
            return $this->response("Already exist user with this email address,Please try with another email address",true);
        }
        else
        {
            $user=User::Create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email'=> $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'username' => $request->input('username'),
                'phone' => $request->input('phone'),
                'promo_code' => $promo_code,
                'is_verified' => 0,
                'token'=>""
            ]);
        }
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);

        Mail::to($request->email)->send(new VerifyMail($user));

        return $this->response("Successfully registered,we sent you an activation email. Check your email and click on the link to verify.");
	}

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();

        if(isset($verifyUser))
        {
            $user = $verifyUser->user;

            if(!$user->verified)
            {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();

                DB::table('verify_users')->where(['token'=> $token])->delete();

                return Redirect('user-login')->with('success', 'Your account is now verified. Please login to access');
            }else{
				return Redirect('user-login')->with('success', 'Your have to first verify e-mail address then try to login.!');
            }
        }
        else
        {
			return Redirect('user-login')->with('message','Verification token is expire now with this email address.!');
        }
    }


    public function showForgetPasswordForm()
    {
        return view('front.auth.forgetPasswordsend');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email|exists:users,email'
        ], [
			'email.required' => 'Please enter email',
			'email.email' => 'Please enter valid email address',
			'email.exists' => 'User is not found with this email address.!',
        ]);

		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token
        ]);

        Mail::send('front.auth.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return $this->response("We have e-mailed your password reset link!");
    }

    public function showResetPasswordForm($token) {

        $token = VerifyUser::where('token', $token)->first();

        if(!$token){
            return Redirect('user-login')->with('message', 'Reset Password token is expired..!');
        }
        else
        {
            return view('front.auth.forgetPasswordLink', ['token' => $token]);
        }
    }

    public function submitResetPasswordForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ], [
	        'password.required' => 'Please enter password',
            'password.min' => 'Please enter minimum 6 character in password',
            'password_confirmation.required' => 'Please enter confirm password',
            'password_confirmation.same' => 'Entered new password and confirm new password not matched',
        ]);

		if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

		$user_exist = DB::table('password_resets')->where(['token' => $request->token])->first();

		if(!$user_exist){

			return $this->response("invalid token!",true);
        }

        $user = User::where('email', $user_exist->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $user_exist->email])->delete();

        return $this->response("password reset successfully!");
    }

}
