@extends('admin.layouts.master')
@section('title', 'Manage Order')

@section('css')
<link href="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb-title')
Manage Orders
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Orders</li>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
            <div class="card m-b-30">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-0">Orders List</h4>
                @include('admin.auth.flash-message')
                @yield('content')
            </div>
            <div class="card-body p0">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_pending" role="tab" aria-selected="true">Pending Orders</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_in_progress" role="tab" aria-selected="false">In Progress Orders</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_waiting_approval" role="tab" aria-selected="false">Waiting Approval Orders</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_completed" role="tab" aria-selected="false">Completed Orders</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane p-3 active" id="tab_pending" role="tabpanel">
                        <table id="id-pending" style="width:100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="15%">Order Number</th>
                                    <th width="20%">Customer Name</th>
                                    <th width="25%">Design Name</th>
                                    <th width="20%">Assign</th>
                                    <th width="10%">Created Date</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane p-3" id="tab_in_progress" role="tabpanel">
                        <table id="id-inprogress" style="width:100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="15%">Order Number</th>
                                    <th width="20%">Vendor Name</th>
                                    <th width="25%">Customer Name</th>
                                    <th width="20%">Design Name</th>
                                    <th width="10%">Created Date</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane p-3" id="tab_waiting_approval" role="tabpanel">
                        <table id="id-waiting_approval" style="width:100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="15%">Order Number</th>
                                    <th width="20%">Vendor Name</th>
                                    <th width="20%">Customer Name</th>
                                    <th width="20%">Design Name</th>
                                    <th width="10%">Created Date</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane p-3" id="tab_completed" role="tabpanel">
                        <table id="id-completed" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="15%">Order Number</th>
                                    <th width="20%">Vendor Name</th>
                                    <th width="20%">Customer Name</th>
                                    <th width="20%">Design Name</th>
                                    <th width="10%">Created Date</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="modal fade show" style="overflow: auto;display: none;background: opacity: 0.5;" id="transferordermodal" data-keyboard="false" data-backdrop="static"  tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background: #;min-height: 200px;border-radius: 15px;">
            <div class="modal-header">
                <h5 class="modal-title">Transfer Order</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
            <br/>
            <form action="{{route('vendor-order-transfer')}}" method="POST">
                @csrf
                <input type="hidden" name="id" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> Current vendor: <b><span class="current_vendor"></b></span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select new vendor</label>
                            <select name="new_assign_vendor" class="select2">
                                <option value="">Select Vendor</option>
                            </select>
                        </div>
                    </div>
					<div class="col-md-12 text-center">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
						<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save</button>
					</div>
				</div>
            </form>
        </div>
    </div>
</div>
</div>


@endsection

@section('script')

    <script src="{{asset('Admi/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Admi/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Admi/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Admi/assets/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('Admi/assets/js/ajax-loading.js')}}" type="text/javascript"></script>
    <script src="{{asset('Admi/assets/plugins/alertify/js/alertify.js')}}"></script>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script>

$(document).ready(function(){

    $(document).on("change", "select[name='vendor']", function(){

            var id = $(this).attr("data-id");
            var val = $(this).val();

            var formData = new FormData();
            formData.append("assign", "");
            formData.append("id", id);
            formData.append("vid", val);

            $.ajax({
                type: "POST",
                url: "{{route('assign-order-vendor')}}",
                data: formData,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function (data){
                    var type = "";

                    alertify.logPosition("top right");

                    if(data.status=="RC200"){
                        alertify.success( data.message );
                        table_pending.ajax.reload();
                    }else{
                        type = "danger";
                        alertify.error( data.message );
                    }
                }
            });
        });

       var table_pending = $('#id-pending').DataTable({
        "processing": true,
                "serverSide": true,
                "pageLength": 10,
                "lengthChange": true,
                "searching": true,
                language: {
                    search: "_INPUT_",
					"sLengthMenu": "Showing _MENU_",
                    searchPlaceholder: "Search order details"
                },
                ajax:{
                    url: "{{ route('get-pending-order') }}",
                },
                initComplete: function () {
                },
                "drawCallback": function( settings ) {
                    $("select[name='vendor']").select2({
                        width: '100%',
                        placeholder:'Search Vendor',
                        minimumResultsForSearch: -1,
                        escapeMarkup: function (markup) { return markup; },
                        minimumInputLength: 3,
                        language: {
                            noResults: function () {
                                return "No result found, <a href='{{route('manage-vendor')}}'>Add New Vendor</a>";
                            }
                        },
                        ajax: {
                            type: 'POST',
                            url: "{{route('search-vendor')}}",
                            dataType:"json",
                            delay: 250,
                            data: function (params) {
                                var query = {
                                    search: params.term,
                                    "_token": "{{ csrf_token() }}"
                                }

                                return query;
                            },
                            processResults: function (data, params) {
                                return {
                                    results: data
                                };
                            }
                        },
                        templateResult: function(data){

                            if (data.loading) {
                                return data.text;
                            }

                            var markup = data.company_name + " | "+ data.username ;

                            return markup;
                        },
                        templateSelection: function(data){

                            if (data.text) {
                                return data.text;
                            }
                            var markup = "<span class='content'>"+data.company_name+ "</span>";
                            return markup || data.text;
                        }
                    });
                },
                Sorting : [[0,"DESC"]],
                columns:[
                {
                    data:null,
                    render:function(data,type,full,meta){
                        var val = "";

                        if(data.type==0)
                            val += '<label class="badge badge-dark">Digitizing Order</label>';
                        else
                            val += '<label class="badge badge-success">Vectorizing Order</label>';
                        return data.order_number + "<br />" + val;
                    },
                    orderable: false
                },
                {
                    data:'username',
                },
                {
                    data:'design_name',
                },
                {
                    data: null,
                    render: function(data, type, full, meta){
                        var html = '';
                            html += '<select data-id="'+ data.id +'" name="vendor" class="select2">';
                                html += '<option value="">Select Vendor</option>';
                                html += '<option value="1">Suresh Shiyani</option>';
                            html += '</select>';
                        return html;
                    },
                    orderable: false
                },
                {
                    data:'created_at',
                },
                {
                    data: null,
                    render: function(data, type, full, meta){
                        var button = "";
                        button = '<button class="btn btn-dark btn-sm"><a style="color:white" href="{{ route('admin')}}/view-order-details/'+data.id+'"><i class="fa fa-eye"></i> View Details<a/></button>';
                        return button;
                    },
                    orderable: false
                }
                ]
            });

            var table_inprogress = $('#id-inprogress').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "lengthChange": true,
				"deferLoading":0,
                "searching": true,
                language: {
                    search: "_INPUT_",
					"sLengthMenu": "Showing _MENU_",
                    searchPlaceholder: "Search order details"
                },
                ajax:{
                    url: "{{ route('get-inprogress-order') }}",
                },
                initComplete: function () {
                },
                Sorting : [[0,"DESC"]],
                columns: [
                    {
                        data:null,
                        render:function(data,type,full,meta){
                            var val = "";

                            if(data.type==0)
                                val += '<label class="badge badge-dark">Digitizing Order</label>';
                            else
                                val += '<label class="badge badge-success">Vectorizing Order</label>';
                            return data.order_number + "<br />" + val;
                        },
                        orderable: false
                    },
                    {data: 'vendorname'},
                    {data: 'username'},
                    {data: 'design_name'},
                    {data: 'created_at'},
                    {
                        data: null,
                        render: function(data, type, full, meta){
                            var button = "";
                            button += '<button class="btn btn-dark btn-sm"><a style="color:white" href="{{ route('admin')}}/view-order-details/'+data.id+'"><i class="fa fa-eye"></i> View Details<a/></button> &nbsp;';
                            button += '<button class="btn btn-primary btn-sm" vendor="'+data.vendorname+'"   data-id="'+ data.id +'" data-toggle="modal" data-target="#transferordermodal"><i class="fa fa-exchange"></i> Transfer order</button>';
                            return button;
                        },
                        orderable: false
                    }
                ]
            });

            var table_waiting = $('#id-waiting_approval').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "lengthChange": true,
				"deferLoading":0,
                "searching": true,
                language: {
                    search: "_INPUT_",
					"sLengthMenu": "Showing _MENU_",
                    searchPlaceholder: "Search order details"
                },
                ajax:{
                    url: "{{ route('get-approval-order') }}",
                },
                initComplete: function () {
                },
                Sorting : [[0,"DESC"]],
                columns: [
                    {
                        data:null,
                        render:function(data,type,full,meta){
                            var val = "";

                            if(data.type==0)
                                val += '<label class="badge badge-dark">Digitizing Order</label>';
                            else
                                val += '<label class="badge badge-success">Vectorizing Order</label>';
                            return data.order_number + "<br />" + val;
                        },
                        orderable: false
                    },
                    {data: 'vendorname'},
                    {data: 'username'},
                    {data: 'design_name'},
                    {data: 'created_at'},
                    {
                        data: null,
                        render: function(data, type, full, meta){
                            var button = "";
                            button = '<button class="btn btn-dark btn-sm"><a style="color:white" href="{{ route('admin')}}/view-order-details/'+data.id+'"><i class="fa fa-eye"></i> View Details<a/></button>';
                            return button;
                        },
                        orderable: false
                    }
                ]
            });


           var table_completed = $('#id-completed').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "lengthChange": true,
				"deferLoading":0,
                "searching": true,
                language: {
                    search: "_INPUT_",
					"sLengthMenu": "Showing _MENU_",
                    searchPlaceholder: "Search order details"
                },
                ajax:{
                    url: "{{ route('get-complete-order') }}",
                },
                initComplete: function () {
                },
                Sorting : [[0,"DESC"]],
                columns: [
                    {
                        data:null,
                        render:function(data,type,full,meta){
                            var val = "";

                            if(data.type==0)
                                val += '<label class="badge badge-dark">Digitizing Order</label>';
                            else
                                val += '<label class="badge badge-success">Vectorizing Order</label>';
                            return data.order_number + "<br />" + val;
                        },
                        orderable: false
                    },
                    {data: 'vendorname'},
                    {data: 'username'},
                    {data: 'design_name'},
                    {data: 'created_at'},
                    {
                        data: null,
                        render: function(data, type, full, meta){
                            var button = "";
                            button = '<button class="btn btn-dark btn-sm"><a style="color:white" href="{{ route('admin')}}/view-order-details/'+data.id+'"><i class="fa fa-eye"></i> View Details<a/></button>';
                            return button;
                        },
                        orderable: false
                    }
                ]
            });

            var isPFirstTime = true;
			var isIPFirstTime = true;
			var isWAFirstTime = true;
			var isCFirstTime = true;

			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				var target = $(e.target).attr("href");

				if(target=="#tab_pending" && isPFirstTime){
                    table_pending.ajax.reload();
				}else if(target=="#tab_in_progress" && isIPFirstTime){
                    table_inprogress.ajax.reload();
				}else if(target=="#tab_waiting_approval" && isWAFirstTime){
                    table_waiting.ajax.reload();
				}else if(target=="#tab_completed" && isCFirstTime){
                    table_completed.ajax.reload();
				}
			});

            $(document).on('shown.bs.modal', '#transferordermodal', function (e) {
                var id = $(e.relatedTarget).attr('data-id');
                var vendor = $(e.relatedTarget).attr('vendor');

                $(".current_vendor").html(vendor);

                $("#transferordermodal input[name='id']").val(id);
		    });

                 $("select[name='new_assign_vendor']").select2({
                        dropdownParent: $("#transferordermodal"),
                        width: '100%',
                        placeholder:'Search Vendor',
                        minimumResultsForSearch: -1,
                        escapeMarkup: function (markup) { return markup; },
                        minimumInputLength: 3,
                        language: {
                            noResults: function () {
                                return "No result found, <a href='{{route('manage-vendor')}}'>Add New Vendor</a>";
                            }
                        },
                        ajax: {
                            type: 'POST',
                            url: "{{route('get-vendors')}}",
                            dataType:"json",
                            delay: 250,
                            data: function (params) {
                                var query = {
                                    search: params.term,
                                    "_token": "{{ csrf_token() }}"
                                }

                                return query;
                            },
                            processResults: function (data, params) {
                                return {
                                    results: data
                                };
                            }
                        },
                        templateResult: function(data){

                            if (data.loading) {
                                return data.text;
                            }

                            var markup = data.company_name + " | "+ data.username ;

                            return markup;
                        },
                        templateSelection: function(data){

                            if (data.text) {
                                return data.text;
                            }
                            var markup = "<span class='content'>"+data.company_name+ "</span>";
                            return markup || data.text;
                        }
                    });



});
</script>

@endsection

