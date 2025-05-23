<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Menu;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;

class ManagePermissionController extends Controller
{

    public function manage_permission(){

        $role = Role::where("show_in_permission", 1)->get();

		$level = 1;
		$group = 1;

		$menu = $this->find_menu(0, $level, $group);
		$permissions = Permission::get();

		/*$menu = json_decode( json_encode($menu), true );

		echo "<pre>";
		print_r($menu);
		exit;*/

        return view('admin.manage-permission.index', compact(['role','menu','permissions']));

    }

	public function find_menu($parent_id = 0, &$level, &$group){

		$final_array = [];

		$result = Menu::select(["id","name","route","parent"])->where("parent",$parent_id)->where("show_in_permission",1)->orderby("sort_order","ASC")->get();

		foreach($result as $menu){

			if($parent_id!=0)
				$level++;

			$array = [];
			$array["id"] = $menu->id;
			$array["name"] = $menu->name;
			$array["route"] = $menu->route;
			$array["parent"] = $menu->parent;
			$array["level"] = $level;
			$array["set"] = $group;

			$has = $this->find_menu($menu->id, $level, $group);

			$array["submenu"] = $has;
			$array["submenu_id"] = array_column($has,"id");

			array_push($final_array, $array);

			if($parent_id!=0)
				$level--;

			if($parent_id==0)
				$group++;
		}

		return $final_array;

	}

	public function find_sub_menu_by_current_id($menu_id){

		$array = [];

		$menu = Menu::where("parent", $menu_id)->get();

		foreach($menu as $mid){

			array_push($array, $mid->id);

			if($mid->parent!=0){
				$result = $this->find_sub_menu_by_current_id($mid->id);

				if(!empty($result)){

					$array = array_merge($array, $result);
				}
			}

		}

		return $array;
	}

	public function find_parent_menu_by_current_id($menu_id){

		$array = [];

		$menu = Menu::where("id", $menu_id)->get();

		foreach($menu as $mid){

			array_push($array, $mid->id);

			if($mid->parent!=0){
				$result = $this->find_parent_menu_by_current_id($mid->parent);

				if(!empty($result)){

					$array = array_merge($array, $result);
				}
			}
		}
		return $array;
	}

    public function manage_permission_update(Request $request){

        if( $request->has("menu_id") && $request->has("role_id") ){

			$role_id = $request->role_id;
			$menu_id = $request->menu_id;

			if($request->is_checked){

				$all_sub_id = $this->find_sub_menu_by_current_id($menu_id);
				$all_parent_id = $this->find_parent_menu_by_current_id($menu_id);

				$all_id = array_merge($all_sub_id, $all_parent_id);

				$permissions = Permission::select("menu_id")->where("role_id", $role_id)->get();

				$permissions = json_decode(json_encode($permissions), true);

				$permissions = array_column($permissions, "menu_id");

				$final_id = array_diff($all_id, $permissions);

				$final_in_array = [];

				foreach($final_id as $id){
					array_push($final_in_array, [
						"menu_id"=>$id,
						"role_id"=>$role_id
					]);
				}

				if(!empty($final_in_array))
					Permission::insert($final_in_array);

			}else{

				$all_parent_id = $this->find_parent_menu_by_current_id($menu_id);

				$menu_has_sub_menu = Menu::where("parent", $menu_id)->count();

				if($menu_has_sub_menu==0){

					$index = array_search($menu_id, $all_parent_id);

					if($index!==false){
						unset($all_parent_id[$index]);
					}

					Permission::where("menu_id",$menu_id)->where("role_id", $role_id)->delete();

				}else{

					$all_sub_id = $this->find_sub_menu_by_current_id($menu_id);

					Permission::where("menu_id",$menu_id)->where("role_id", $role_id)->delete();

					Permission::whereIn("menu_id",$all_sub_id)->where("role_id",$role_id)->delete();

				}


				foreach($all_parent_id as $parent_id){

					$has = $this->has_in_permission($menu_id, $parent_id, $role_id);

					if($has){
						break;
					}

				}

			}
		}
		return $this->response("Permission updated successfully");
    }

	public function has_in_permission($current_menu_id, $menu_id, $role_id){

		$has_sub_menu = Menu::select("id")->where("parent", $menu_id)->where("id","!=",$current_menu_id)->get();

		$has_sub_menu = array_column(json_decode(json_encode($has_sub_menu), true), "id");

		$has = Permission::whereIn("menu_id", $has_sub_menu)->where("role_id", $role_id)->count();

		if($has==0){
			Permission::where("menu_id",$menu_id)->where("role_id", $role_id)->delete();
			return false;
		}

		return true;
	}
}
