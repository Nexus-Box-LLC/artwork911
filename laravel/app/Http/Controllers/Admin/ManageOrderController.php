<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Front\Order;
use Session;
use DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Admin;
use App\Models\Front\OrderHistory;

class ManageOrderController extends Controller
{
	public function index(){

		if(Auth::guard('web')->user()->type==2){
			return view('admin.manage-vendor-orders.vendor-orders');
		}

		return view('admin.manage-orders.index');
	}

	public function pending_orders(){

		$type = Auth::guard('web')->user()->type;

		$order = Order::select(array(
				"*",
				DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
			))
			->orderBy('id','desc')
			->where('status','0');

		if(request()->ajax()){
			return datatables()->of($order)->editColumn('created_at', function($request){
				return $request->created_at->format( $this->defaultDateFormat );
			})->make(true);
		}

	}

	public function in_progress_orders(){

		$order = Order::select(array(
				"*",
				DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
				DB::raw("(SELECT admin.username FROM admin WHERE admin.id=vendor_id) as vendorname")
			))
			->orderBy('id','desc')
			->where('status','1');

		if(request()->ajax()){
			return datatables()->of($order)->editColumn('created_at', function($request){
					return $request->created_at->format( $this->defaultDateFormat );
				})->make(true);
		}

	}

    public function  manage_approval_order(){

        $order = Order::select(array(
            "*",
            DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
            DB::raw("(SELECT admin.username FROM admin WHERE admin.id=vendor_id) as vendorname")
        ))
		->orderBy('id','desc')
		->where('status','2');

        if(request()->ajax()){
            return datatables()->of($order)->editColumn('created_at', function($request){
                    return $request->created_at->format( $this->defaultDateFormat );
                })->make(true);
        }
		return view('admin.manage-orders.index');
    }


    public function manage_complete_order(){

		$order = Order::select(array(
			"*",
			DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
			DB::raw("(SELECT admin.username FROM admin WHERE admin.id=vendor_id) as vendorname")
		))
		->orderBy('id','desc')
		->where('status','3');

		if(request()->ajax()){
			return datatables()->of($order)->editColumn('created_at', function($request){
					return $request->created_at->format( $this->defaultDateFormat );
				})->make(true);
		}

	}

    public function get_orders_details($id){

        $details = Order::find($id);
        $orderhistory = OrderHistory::where('order_id',$details->id)->get();

		return view('admin.manage-orders.order-details', compact('details','orderhistory'));
	}

    public function search_vendors(){

		$json = [];

		if( isset($_POST["search"]) ){
			$json=DB::select( DB::raw("SELECT id, company_name, username FROM admin WHERE type=2 AND ( company_name LIKE '%{$_POST["search"]}%' OR username LIKE '%{$_POST["search"]}%' )"));
		}
		return json_encode($json);
	}


    public function assign_order_vendor(){

		if( isset($_POST["assign"]) && isset($_POST["id"]) && isset($_POST["vid"]) ){

			$id = $_POST["id"];
			$vid = $_POST["vid"];

			$order = Order::find($id);

			$order->status = 1;
			$order->vendor_id = $vid;
			$order->update();

            $assign_order = OrderHistory::create([
                'order_id'=> $order->id,
                'by_user'=> Auth::guard('web')->user()->id,
                'user_type'=> 0,
                'description'=> "Order assign to vendor and in progress",
                'type'=> 1,
                'status'=> 1,
            ]);

            return $this->response("Vendor assigned successfully...");
		}
	}

    public function vendor_order_transfer(Request $request){

        $order = Order::find($request->id);

        if(!empty($order)){
            $order->vendor_id=$request->new_assign_vendor;
            $order->save();
        }
		return back()->with('success','New vendor assinged successfully!');
    }
}
