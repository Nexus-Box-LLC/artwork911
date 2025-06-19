<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Front\Order;
use App\Models\Admin\Delivery;
use Session;
use DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Models\Front\OrderHistory;

class ManageVendorOrderController extends Controller
{

    public function index(){

		if(Auth::guard('web')->user()->type==2){
			return view('admin.manage-vendor-orders.vendor-orders');
		}
		return view('admin.manage-orders.index');
	}

   	public function vendor_pending_order(){

        $vendor_id = Auth::guard('web')->user()->id;

		$order =  Order::select(array(
			"*",
			DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
		))
		->where('status','1')
		->where('vendor_id',$vendor_id)
		->orderBy('id','desc');

		if(request()->ajax()){
			return datatables()->of($order)->editColumn('created_at', function($request){
					return $request->created_at->format( $this->defaultDateFormat );
				})->make(true);
		}
	}

    public function vendor_approval_order(){

        $vendor_id = Auth::guard('web')->user()->id;

			$order = Order::select(array(
				"*",
				DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
				DB::raw("(SELECT admin.username FROM admin WHERE admin.id=vendor_id) as vendorname")
			))
			->where('status','2')
			->where('vendor_id',$vendor_id)
			->orderBy('id','desc');

			if(request()->ajax()){
				return datatables()->of($order)->editColumn('created_at', function($request){
						return $request->created_at->format( $this->defaultDateFormat );
					})->make(true);
			}
    }

    public function vendor_complete_order(){

        $vendor_id = Auth::guard('web')->user()->id;

        $order = Order::select(array(
            "*",
            DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
            DB::raw("(SELECT admin.username FROM admin WHERE admin.id=vendor_id) as vendorname")
        ))->where('status','3')->where('vendor_id',$vendor_id);

        if(request()->ajax()){
            return datatables()->of($order)->editColumn('created_at', function($request){
                    return $request->created_at->format( $this->defaultDateFormat );
                })->make(true);
        }
    }

	public function vendor_order_details($id){

		$details = Order::find($id);
        $orderhistory = OrderHistory::where('order_id',$details->id)->get();

		return view('admin.manage-vendor-orders.vendor-order-details', compact('details','orderhistory'));
	}

	public function downloadfile($id,Request $request)
	{
		if($request->has('type') && $request->type == 'vo') {
			$filepath = public_path('Front/artwork-order/'.$id);
			
			if(!file_exists($filepath)){
				return back();
			}
		}
		if($request->has('type') && $request->type == 'do'){
			$filepath = public_path('Front/digitizing-order/'.$id);
			
			if(!file_exists($filepath)){
				return back();
			}
		}
		return Response::download($filepath);
    }

	public function submit_work(Request $request){

        $validator = Validator::make($request->all(), [
			'message' => 'required|max:255',
			'files' => 'required|max:20480'
		], [
			'message.required' => 'Please enter message',
			'message.max' => 'Messsage must be less then 255 character',
			'files.required' => 'Please select the file',
			'files.max'=>'File size is more than 20 mb'
		]);

        if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}

        $ord_details = Order::where('id', $request->order_id)->first();

        $files = [];
        if($request->hasfile('files'))
         {
            foreach($request->file('files') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('Admi/assets/orders-deliveries'), $name);
                $files[] = $name;
            }
         }
            $delivery = new Delivery();
            $delivery->vendor_id = $request->vendor_id;
            $delivery->user_id = $ord_details['user_id'];
            $delivery->order_id = $request->order_id;
            $delivery->message = $request->message;
            $delivery->files = implode(",",$files);

        $delivery->save();

        $order = DB::table('orders')->where('id', $request->order_id)->update(['status' => "2"]);

        $order_update = OrderHistory::create([
		    'order_id'=> $request->order_id,
			'by_user'=> Auth::guard('web')->user()->id,
			'user_type'=> 1,
			'description'=> "Updates submitted by vendor and in awaiting approval",
			'type'=> 2,
			'status'=> 2,
		]);
		return $this->response("Order delivered successfully...");
    }

}
