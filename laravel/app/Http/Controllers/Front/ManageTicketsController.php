<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Front\ManageTickets;
use App\Models\Front\TicketUpdate;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;

class ManageTicketsController extends HomeController
{
    public function manage_tickets()
    {
        $user_id = Auth::guard('user')->user()->id;

		$tickets_open = ManageTickets::select("*")
						->Where([
								['status',"=", 0]
						]);

		$tickets_open = $tickets_open->paginate(3,['*'],'tickets_open');

        $tickets_close = ManageTickets::select("*")
						->Where([
								['status',"=", 1]
						]);

		$tickets_close = $tickets_close->paginate(3,['*'],'tickets_close');
        
		return view('front.managetickets.index',compact('tickets_open','tickets_close'));
    }

    public function open_ticket(){
        $user_id = Auth::guard('user')->user()->id;
        $tickets_open = ManageTickets::select(array(
            "*",
            DB::raw("(SELECT users.username FROM users WHERE users.id=created_by) as username"),
        ))->where('status','0')->where('created_by',$user_id);

        if(request()->ajax()){
            return datatables()->of($tickets_open)->editColumn('created_at', function($request){
                    return $request->created_at->format( $this->defaultDateFormat );
                })->make(true);
        }

        return view('front.managetickets.index');
    }

    public function close_ticket(){

        $user_id = Auth::guard('user')->user()->id;
        $tickets_close = ManageTickets::select(array(
            "*",
            DB::raw("(SELECT users.username FROM users WHERE users.id=created_by) as username"),
        ))->where('status','1')->where('created_by',$user_id);

        if(request()->ajax()){
            return datatables()->of($tickets_close)->editColumn('created_at', function($request){
                    return $request->created_at->format( $this->defaultDateFormat );
                })->make(true);
        }
		return view('front.managetickets.index');
    }


    public function manage_tickets_details($id)
    {
        $user_id = Auth::guard('user')->user()->id;

        $tickets = ManageTickets::Where('created_by','=',$user_id)->where('id','=',$id)->first();

        if(!empty($tickets))
        {
            $tickets_details = ManageTickets::find($id);
            $tickethistory = TicketUpdate::where('ticket_id',$tickets_details->id)->get();

            return view('front.managetickets.manage-tickets-details', compact('tickets_details','tickethistory'));
        }
        else{
            return view('front.managetickets.index');
        }
    }

	public function downloadfile($id)
	{
		$filepath = public_path('Front/manage-tickets/'.$id);
		
		if(file_exists($filepath)){
			return Response::download($filepath);
		}
		return back();
	}

    public function tickets_create(){
        return view ('front.managetickets.create-tickets');
    }

    public function create_ticket(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'order_number' => 'required',
			'reason' => 'required',
			'attachment' => 'required',
			'message' => 'required',
		], [
			'title.required' => 'Please enter title',
			'order_number.required' => 'Please enter order number',
			'reason.required' => 'Please select reason',
			'attachment.required' => 'Please select the file',
			'attachment.max'=>'File size is more than 20 mb',
			'message.required'=>'Please enter the message',
		]);

        if($validator->fails()){
			return $this->response($validator->errors()->first(), true);
		}
		 
		$user = Auth::guard('user')->user()->id;
		$ticket_number = $this->get_ticket_id();

        if($request->has('attachment')){
            $imageSlug =  "user-ticket";
        	$file = $imageSlug . '-' . time() .'.'. $request->attachment->extension();
			$request->attachment->move(public_path('Front/manage-tickets/'),$file);
        }

        ManageTickets::create([
			'created_by' => $user,
			'ticket_number' => $ticket_number,
			'status' => 0,
			'title' => $request->title,
			'reason' => $request->reason,
			'order_number' => $request->order_number,
			'message' => $request->message,
			'attachment' => $file,
		]);
        
        return $this->response("Ticket Created successfully...");
    }

    public function user_ticket_update(Request $request){

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

		$user = Auth::guard('user')->user()->id;
        $files = [];
        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('Front/manage-tickets'), $name);
                $files[] = $name;
            }
        }
		
		TicketUpdate::create([
			'updated_by' => $user,
			'user_type' => -1,
			'ticket_id' => $request->ticket_id,
			'message' => $request->message,
			'attachment' => implode(",",$files),
		]);
		
        return $this->response("Ticket Updated successfully.");
    }

    public function user_ticket_close($id){

        if(!empty($id)){
            ManageTickets::find($id)->update(['status' => 1]);
        }
        return Redirect('manage-tickets')->with('success', 'Ticket status update successfully.');
    }
}
