<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Front\Order;
use App\Models\Front\OrderHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Front\User;
use DB;

class UserOrderController extends HomeController
{

    public function user_pending_orders(){

		$user_id = Auth::guard('user')->user()->id;

		$digitizingorders = Order::select("*")
						->Where([
								['status',"=", 0],
								['type','=', 0],
								['user_id','=',$user_id]
						]);

		$digitizingorders = $digitizingorders->paginate(3,['*'],'digitizingorders');

        $vectorizingorders = Order::select("*")
						->Where([
								['status',"=", 0],
								['type','=', 1],
								['user_id','=',$user_id]
						]);

		$vectorizingorders = $vectorizingorders->paginate(3,['*'],'vectorizingorders');

        return view('front.orders.orders-pending',compact('digitizingorders','vectorizingorders'));
    }

	public function inprogress_orders(){

		$user_id = Auth::guard('user')->user()->id;

		$digitizingorders = Order::select("*")
						->Where([
								['status',"=", 1],
								['type','=', 0],
								['user_id','=',$user_id]
						]);

		$digitizingorders = $digitizingorders->paginate(3,['*'],'digitizingorders');

        $vectorizingorders = Order::select("*")
						->Where([
								['status',"=", 1],
								['type','=', 1],
								['user_id','=',$user_id]
						]);

		$vectorizingorders = $vectorizingorders->paginate(3,['*'],'vectorizingorders');

        return view('front.orders.orders-inprogress',compact('digitizingorders','vectorizingorders'));
    }

	public function awaiting_orders(){

		$user_id = Auth::guard('user')->user()->id;

		$digitizingorders = Order::select("*")
						->Where([
								['status',"=", 2],
								['type','=', 0],
								['user_id','=',$user_id]
						]);

		$digitizingorders = $digitizingorders->paginate(3,['*'],'digitizingorders');

        $vectorizingorders = Order::select("*")
						->Where([
								['status',"=", 2],
								['type','=', 1],
								['user_id','=',$user_id]
						]);
        $vectorizingorders = $vectorizingorders->paginate(3,['*'],'vectorizingorders');

        return view('front.orders.orders-awaiting',compact('digitizingorders','vectorizingorders'));
    }

	public function completed_orders(){

		$user_id = Auth::guard('user')->user()->id;

		$digitizingorders = Order::select("*")
						->Where([
								['status',"=", 3],
								['type','=', 0],
								['user_id','=',$user_id]
						]);

		$digitizingorders = $digitizingorders->paginate(3,['*'],'digitizingorders');

        $vectorizingorders = Order::select("*")
						->Where([
								['status',"=", 3],
								['type','=', 1],
								['user_id','=',$user_id]
						]);
        $vectorizingorders = $vectorizingorders->paginate(3,['*'],'vectorizingorders');

        return view('front.orders.orders-completed',compact('digitizingorders','vectorizingorders'));
    }
    public function user_order_details($id){

        $user_id = Auth::guard('user')->user()->id;

        $user_order = Order::Where('user_id','=',$user_id)->where('id','=',$id)->first();

        if(!empty($user_order))
        {
            $details = Order::find($id);
		    return view('front.orders.user-order-details', ['details' => $details]);
        }
        else{
            return view('front.dashboard.dashboard');
        }
    }

    public function orders_status(Request $request){

        if(isset($_POST["id"]) && isset($_POST["status"])){

            $id = $_POST["id"];

            $status = $_POST["status"];

            if($status == 0)
            {
                $order = Order::find($id);
                $order->status=1;
                $order->update();

                $order_reject = OrderHistory::create([
                    'order_id'=> $order->id,
                    'by_user'=> Auth::guard('user')->user()->id,
                    'user_type'=> -1,
                    'description'=> "Updated rejected by customer and order is in progress",
                    'type'=> 2,
                    'status'=> 1,
                ]);

                return $this->response("Order rejected by user...");
            }
            else if($status == 1){

                $order = Order::find($id);
                $order->status=3;
                $order->update();

                $order_approve = OrderHistory::create([
                    'order_id'=> $order->id,
                    'by_user'=> Auth::guard('user')->user()->id,
                    'user_type'=> -1,
                    'description'=> "Order completed by customer",
                    'type'=> 3,
                    'status'=> 3,
                ]);
                return $this->response("Order approved by user...");
            }
        }
    }
}
