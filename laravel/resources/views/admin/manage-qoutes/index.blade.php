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
Manage Qoutes
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Qoutes</li>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
            <div class="card m-b-30">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-0">Qoutes List</h4>
                @include('admin.auth.flash-message')
                @yield('content')
            </div>
            <div class="card-body p0">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_pending" role="tab" aria-selected="true">Pending Quotes</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_completed" role="tab" aria-selected="false">Completed Quotes</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane p-3 active" id="tab_pending" role="tabpanel">
                        <table id="id-pending" style="width:100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="15%">Order Number</th>
                                    <th width="20%">Customer Name</th>
                                    <th width="25%">Design Name</th>
                                    <th width="20%">Created Date</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane p-3" id="tab_completed" role="tabpanel">
                        <table id="id-completed" style="width:100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="15%">Order Number</th>
                                    <th width="20%">Customer Name</th>
                                    <th width="25%">Design Name</th>
                                    <th width="20%">Created Date</th>
                                    <th width="20%">Action</th>
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

    var table_pending = $('#id-pending').DataTable({
        "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "lengthChange": true,
                "searching": true,
                language: {
                    search: "_INPUT_",
					"sLengthMenu": "Showing _MENU_",
                    searchPlaceholder: "Search order details"
                },
                ajax:{
                    url: "{{ route('pending-qoutes') }}",
                },
                initComplete: function () {
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
                    data:'created_at',
                },
                {
                    data: null,
                    render: function(data, type, full, meta){
                        var button = "";
                        button += '<button class="btn btn-primary btn-sm"><a style="color:white" href=""><i class="fa fa-check"></i>Convert to order<a/></button>&nbsp;&nbsp;';
                        button += '<button class="btn btn-dark btn-sm"><a style="color:white" href="{{ route('admin')}}/qoute-details/'+data.id+'"><i class="fa fa-eye"></i> View Qoutes Details<a/></button>';
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
                    url: "{{ route('completed-qoutes') }}",
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
                    {data: 'username'},
                    {data: 'design_name'},
                    {data: 'created_at'},
                    {
                        data: null,
                        render: function(data, type, full, meta){
                            var button = "";
                            button = '<button class="btn btn-dark btn-sm"><a style="color:white" href="{{ route('admin')}}/qoute-details/'+data.id+'"><i class="fa fa-eye"></i> View Qoutes Details<a/></button>&nbsp;&nbsp;';
                            return button;
                        },
                        orderable: false
                    }
                ]
            });

            var isPFirstTime = true;
			var isCFirstTime = true;

			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				var target = $(e.target).attr("href");

                if(target=="#tab_pending" && isPFirstTime){
                    table_pending.ajax.reload();
				}else if(target=="#tab_completed" && isCFirstTime){
                    table_completed.ajax.reload();
				}
			});
        });

</script>

@endsection

