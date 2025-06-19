<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Front\ManageTickets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Front\TicketUpdate;
use Illuminate\Support\Facades\Validator;
use Response;
use DB;


class TicketsController extends Controller
{
    public function index(){
        return view('admin.manage-tickets.index');
    }

    public function open_tickets()
    { 	
        $qoutes = ManageTickets::select(array(
				"*",
				DB::raw("(SELECT users.username FROM users WHERE users.id=created_by) as username"),
			))->where('status','0');

			if(request()->ajax()){
				return datatables()->of($qoutes)->editColumn('created_at', function($request){
					return $request->created_at->format( $this->defaultDateFormat );
				})->make(true);
			}
        return view('admin.manage-tickets.index');
    }

    public function close_tickets()
    {
        $qoutes = ManageTickets::select(array(
            "*",
            DB::raw("(SELECT users.username FROM users WHERE users.id=created_by) as username"),
        ))->where('status','1');

        if(request()->ajax()){
            return datatables()->of($qoutes)->editColumn('created_at', function($request){
                return $request->created_at->format( $this->defaultDateFormat );
            })->make(true);
        }
    return view('admin.manage-tickets.index');

    }

    public function ticket_details($id){

        $details = ManageTickets::find($id);
		
		if(empty($details)){
			return back();
		}
		
		$tickethistory = TicketUpdate::where('ticket_id',$details->id)->get();
		return view('admin.manage-tickets.ticket-details', compact('details','tickethistory'));
    }


    public function download_ticket_file($id)
	{
        $filepath = public_path('Front/manage-tickets/'.$id);
		
		if(file_exists($filepath)){
			return Response::download($filepath);
		}
		
		return back();
	}

    public function ticket_update(Request $request){
		
		$user = Auth::guard('web')->user();
        
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
		
        $tickets_update = new TicketUpdate();
		$tickets_update->updated_by = $user->user_id;
        $tickets_update->user_type = 0;
        $tickets_update->ticket_id = $request->ticket_id;
        $tickets_update->message = $request->message;
        $tickets_update->attachment= implode(",",$files);

        $tickets_update->save();

        return $this->response("Ticket Updated successfully..");
	}
	
    public function ticket_close($id){

        if(!empty($id)){
            ManageTickets::find($id)->update(['status' => 1]);
        }
        return back()->with('success', 'This ticket closed for now .');
    }


}
