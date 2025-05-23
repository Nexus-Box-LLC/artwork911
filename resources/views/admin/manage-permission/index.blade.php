@extends('admin.layouts.master')
@section('title', 'Manage Permission')

@section('breadcrumb-title')
Manage Permission
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Permission</li>
@endsection

@section('css')

	<style>

		table thead th{
			background: #eff3f6;
		}

		table tbody tr:hover{
			color: #5B6BE8;
		}

		table tbody tr:hover{
			background:#eff3f6;
		}

		.custom-control{
			display: inline-block;
			cursor:pointer;
		}

		.custom-control-label:after,.custom-control-label:before{
			cursor:pointer;
		}

		.sub-menu{
			margin-left:20px;
			position:relative;
		}

		.loading.show{
			display:block;
		}

		.loading{
			position: fixed;
			z-index: 999;
			top: 0px;
			display:none;
			left: 0px;
			height:100%;
			width:100%;
			background: #FFF;
		}

		.loading div{
			position: absolute;
			top: 45%;
			left: 48%;
		}

		tr td .treegrid-expander + b{
			margin-left: 3px;
			display: inline-block;
			position: relative;
			top: -2px;
		}

	   .treegrid-indent {
			width: 0px;
			height: 14px;
			display: inline-block;
			position: relative;
		}

		.treegrid-expander {
			font-size: 14px !important;
		}

		.treegrid-expander {
			width: 0px;
			height: 14px;
			display: inline-block;
			position: relative;
			left:-17px;
			cursor: pointer;
			font-weight: normal;
			top: 2px;
		}
		.level2,.level3{
			display: none;

		}

		.has_child_menu{
			font-weight: 500 !important;
			cursor: pointer !important;
		}

	</style>

@endsection

@section('content')
<div class="row">
    <div class="form-group col-md-12">
        @include('admin.auth.flash-message')
        @yield('content')
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-0 pull-left">Manage Permissions</h4>
			</div>
            <div class="card-body">
                <table id="id-permission" style="width:100%"  class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="30%">Module</th>

							@php
								$total_group = count($role);
								$width = 70/$total_group;

							@endphp

							<?php

								$permissions = json_decode( json_encode($permissions), true );

								function display_menu($role, $permissions, $menu){

									foreach($menu as $val){

										echo '<tr data-id="'. $val["id"] .'" data-parent="'. $val["parent"] .'" data-level="'. $val["level"] .'" >';
											echo '<td data-column="permission">'. $val["name"] .'</td>';

											foreach($role as $rl){

												$rl_id = $rl->id;
												$menu_id = $val["id"];

												$checker = "";

												if(empty($val["submenu"])){

													$has = array_filter($permissions, function ($var) use ($menu_id,$rl_id) {
														return $var["menu_id"]==$menu_id && $var["role_id"]==$rl_id;
													});

													if(count($has)>0){
                                                        $checker = "checked";
                                                    }else{
                                                        $checker = "";
                                                    }

												}else{

													$menu_id_arr = $val["submenu_id"];

													$new = array_filter($permissions, function ($var) use ($menu_id_arr,$rl_id) {
                                                        return in_array($var["menu_id"],$menu_id_arr) && $var["role_id"]==$rl_id;
                                                    });

													if(count($new)==count($val["submenu"])){
                                                        $checker = "checked";
                                                    }else if(count($new)!=0){
                                                        $checker = "data-toggle='indeterminate'";
                                                    }

												}


												$css_id = "menu_{$val["id"]}{$rl->id}";

												echo '<td class="text-center">';
													echo '<div class="custom-control custom-checkbox" style="display:inline-block">';
														echo '<input '. $checker .' data-set="'. $val["set"] .'" type="checkbox" data-parent-id="'. $val["parent"] .'" data-id="'. $val["id"] .'" data-group-id="'. $rl->id .'" value="1" class="custom-control-input" id="'. $css_id .'" data-parsley-multiple="groups" data-parsley-mincheck="2">';
														echo '<label class="custom-control-label" for="'. $css_id .'">&nbsp;</label>';
													echo '</div>';
												echo '</td>';
											}

										echo '</tr>';

										display_menu($role, $permissions, $val["submenu"]);

									}

								}

							?>

							@foreach($role as $val)
								<th width="{{$width}}%">{{$val->name}}</th>
							@endforeach

                        </tr>
                    </thead>
                    <tbody>

						@php
							display_menu($role, $permissions, $menu)
						@endphp

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script src="{{asset('Admi/assets/plugins/alertify/js/alertify.js')}}"></script>

<script>

	$(function () {
		var
			$table = $('#id-permission'),
			rows = $table.find('tr');

		rows.each(function (index, row) {
			var
				$row = $(row),
				level = $row.data('level'),
				id = $row.data('id'),
				$columnName = $row.find('td[data-column="permission"]'),
				children = $table.find('tr[data-parent="' + id + '"]');

			if (children.length) {
				$row.addClass("has_child_menu")
				var expander = $columnName.prepend('' +
					'<i class="treegrid-expander fa fa-chevron-right"></i>' +
					'');

				children.hide();

				expander.on('click', function (e) {
					var $target = $row.find(".treegrid-expander");
					if ($target.hasClass('fa-chevron-right')) {

						$target
							.removeClass('fa-chevron-right')
							.addClass('fa-chevron-down');

						$target.html("");

						children.show();
					} else {

						$target.html("");

						$target
							.removeClass('fa-chevron-down')
							.addClass('fa-chevron-right');

						reverseHide($table, $row);
					}
				});
			}

			$columnName.prepend('' +
				'<span class="treegrid-indent" style="margin-left:' + (level==5 ? 12 : 20) * level + 'px;"></span>' +
				'');


		});

		// Reverse hide all elements
		reverseHide = function (table, element) {
			var
				$element = $(element),
				id = $element.data('id'),
				children = table.find('tr[data-parent="' + id + '"]');

			if (children.length) {
				children.each(function (i, e) {
					reverseHide(table, e);
				});

			   $element.find('.fa-chevron-down').html("");

				$element
					.find('.fa-chevron-down')
					.removeClass('fa-chevron-down')
					.addClass('fa-chevron-right');

				children.hide();
			}
		};
	});

    $(document).ready(function(){

		$("[data-toggle='indeterminate']").each(function(){
			$(this).prop("indeterminate", true );
		});

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });

		function check_uncheck(group_id, parent_id, is_checked){
			$("[data-group-id='"+ group_id +"'][data-id='"+ parent_id +"']").each(function(){

				var pid = $(this).attr("data-parent-id");

				$("[data-id='"+ parent_id +"'][data-group-id='"+ group_id +"']").prop("checked", is_checked);

				var total_count = $("[data-group-id='"+ group_id +"'][data-parent-id='"+ parent_id +"']").length;
				var checked = $("[data-group-id='"+ group_id +"'][data-parent-id='"+ parent_id +"']:checked").length;
				var indeterminate = $("[data-group-id='"+ group_id +"'][data-parent-id='"+ parent_id +"']:indeterminate").length;

				var final_checked = checked+indeterminate;

				if(total_count==final_checked){
					$("[data-id='"+ parent_id +"'][data-group-id='"+ group_id +"']").prop("checked", true);
					$("[data-id='"+ parent_id +"'][data-group-id='"+ group_id +"']").prop("indeterminate", false);
				}else if(final_checked==0){
					$("[data-id='"+ parent_id +"'][data-group-id='"+ group_id +"']").prop("checked", false);
					$("[data-id='"+ parent_id +"'][data-group-id='"+ group_id +"']").prop("indeterminate", false);
				}else {
					$("[data-id='"+ parent_id +"'][data-group-id='"+ group_id +"']").prop("checked", false);
					$("[data-id='"+ parent_id +"'][data-group-id='"+ group_id +"']").prop("indeterminate", true);
				}

				check_uncheck(group_id, pid);

			});
		}

		var ajax_running = false;
        var first_id = 0;

		$(document).on('change','input[type="checkbox"]' , function(e) {

			var id = $(this).attr("data-id");
			var group_id = $(this).attr("data-group-id");
			var parent_id = $(this).attr("data-parent-id");
			var set_id = $(this).attr("data-set");
			var is_checked = $(this).prop("checked");

            if(first_id==0)
                first_id = id;

			check_uncheck(group_id, parent_id, is_checked);

			var has_class = $(this).closest("tr").hasClass("has_child_menu");

            if( $(this).closest("tr").hasClass("has_child_menu") ){
                $("[data-parent-id='"+ id +"'][data-group-id='"+ group_id +"']").prop("checked", is_checked).change();
            }

			if(ajax_running){
				return;
			}

			ajax_running = true;

			var formData = new FormData();
            formData.append("menu_id", first_id);
            formData.append("role_id", group_id);
            formData.append("is_checked", is_checked ? 1 : 0);

            $.ajax({
                type: "POST",
                url: "{{route('manage-permission-status')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data){

                    first_id=0;

					setTimeout(function(){
						ajax_running = false;

						alertify.logPosition("top right");

						if(data.status=="RC200"){
							alertify.success( data.message );

						}else{
							alertify.error( data.message );
						}

					}, 1000);


                }
            });

		});

    });
</script>
@endsection
