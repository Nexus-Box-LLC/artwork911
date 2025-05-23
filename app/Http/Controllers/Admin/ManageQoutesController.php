<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Front\Qoute;
use DB;
use Response;

class ManageQoutesController extends Controller
{
	public function index(){
        return view('admin.manage-qoutes.index');
    }

    public function pending_qoutes()
    {
		if(request()->ajax()){
			$qoutes = Qoute::select(array(
				"*",
				DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
			))
			->orderBy('id','desc')
			->where('status','0');

			return datatables()->of($qoutes)->editColumn('created_at', function($request){
				return $request->created_at->format( $this->defaultDateFormat );
			})->make(true);
		}
        return view('admin.manage-qoutes.index');
    }

    public function completed_qoutes()
    {
        if(request()->ajax()){
			
			$qoutes = Qoute::select(array(
				"*",
				DB::raw("(SELECT users.username FROM users WHERE users.id=user_id) as username"),
			))
			->orderBy('id','desc')
			->where('status','1');

            return datatables()->of($qoutes)->editColumn('created_at', function($request){
                return $request->created_at->format( $this->defaultDateFormat );
            })->make(true);
        }
		return view('admin.manage-qoutes.index');
	}

    public function download_file($id,Request $request)
	{
		if($request->has('type') && $request->type == 'vo') {
			
			$filepath = public_path('Front/artwork-qoute/'.$id);
			
			if(!file_exists($filepath)){
				return back();
			}
		}
		
		if($request->has('type') && $request->type == 'do'){
			$filepath = public_path('Front/digitizing-qoute/'.$id);
			
			if(!file_exists($filepath)){
				return back();
			}
		}
		
		return Response::download($filepath);
	}

    public function qoute_details($id){
		
		$details = Qoute::find($id);
		
		if(empty($details)){
			return back();
		}
		
		return view('admin.manage-qoutes.qoutes-details', ['details' => $details]);
    }


}
