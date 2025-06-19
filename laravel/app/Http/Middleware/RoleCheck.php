<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Menu;
use App\Models\Admin\Permission;
use DB;

class RoleCheck
{
    public function handle(Request $request, Closure $next)
    {
       $user = Auth::guard('web')->user();

       if($user){

			$role_id = $user->role_id;

			$name = $request->route()->getName();

			$has_menu = Menu::select("id")->where('route',$name)->first();

			if($has_menu){

				$has = Permission::where('role_id',$role_id)->where('menu_id',$has_menu->id)->count();

				if($has == 0){
					return Redirect('admin/dashboard')->with('error', 'Access Denied');
				}
			}
        }
        return $next($request);
    }
}
