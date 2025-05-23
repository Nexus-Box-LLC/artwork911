@extends('admin.layouts.master')
@section('title', 'Manage tickets')

@section('css')
<link href="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb-title')
Manage Tickets
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Tickets</li>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12">
            <div class="card m-b-30">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-0">Tickets List</h4>
                @include('admin.auth.flash-message')
                @yield('content')
            </div>
            <div class="card-body p0">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_open" role="tab" aria-selected="true">Pending Tickets</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_close" role="tab" aria-selected="false">Completed Tickets</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane p-3 active" id="tab_open" role="tabpanel">
                        <table id="id-open-tickets" style="width:100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="10%">Created Date</th>
                                    <th width="20%">Title</th>
                                    <th width="10%">Username</th>
                                    <th width="10%">Order Number</th>
                                    <th width="40%">Message</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane p-3" id="tab_close" role="tabpanel">
                        <table id="id-close-tickets" style="width:100%" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="10%">Created Date</th>
                                    <th width="20%">Title</th>
                                    <th width="10%">Username</th>
                                    <th width="10%">Order Number</th>
                                    <th width="40%">Message</th>
                                    <th width="10%">Action</th>
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

$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table_open_tickets = $('#id-open-tickets').DataTable({
        "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "lengthChange": true,
                "searching": true,
                language: {
                    search: "_INPUT_",
					"sLengthMenu": "Showing _MENU_",
                    searchPlaceholder: "Search ticket details"
                },
                ajax:{
                    url: "{{ route('open-tickets') }}",
                },
                initComplete: function () {
                },
                Sorting : [[0,"DESC"]],
                columns:[
                {
                    data:'created_at',
                },
                {
                    data:null,
                        render:function(data,type,full,meta){
                            var val = "";

							if(data.reason==0)
                                val += '<span class="badge bg-primary" style="color: white;" >order related</span>';
                            else
                                val += '<span class="badge bg-warning" style="color: white;" >payment related</span>';
                            return data.title + "<br />" +val;
                        },
                        orderable: false
                },
                {
                    data:'username',
                },
                {
                    data:'order_number',
                },
                {
                    data:'message',
                },
                {
                    data: null,
                    render: function(data, type, full, meta){
                        var button = "";
                        button = '<button class="btn btn-dark btn-sm"><a style="color:white" href="{{ route('admin')}}/ticket-details/'+data.id+'"><i class="fa fa-eye"></i> View Details<a/></button>';
                        return button;
                    },
                    orderable: false
                }
                ]
            });

            var table_close_details = $('#id-close-tickets').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "lengthChange": true,
				"deferLoading":0,
                "searching": true,
                language: {
                    search: "_INPUT_",
					"sLengthMenu": "Showing _MENU_",
                    searchPlaceholder: "Search ticket details"
                },
                ajax:{
                    url: "{{ route('close-tickets') }}",
                },
                initComplete: function () {
                },
                Sorting : [[0,"DESC"]],
                columns: [
                {
                    data:'created_at',
                },
				{
                    data:null,
                        render:function(data,type,full,meta){
                            var val = "";

                            if(data.reason==0)
                                val += '<span class="badge bg-primary" style="color: white;" >order related</span>';
                            else
                                val += '<span class="badge bg-warning" style="color: white;" >payment related</span>';
                            return data.title + "<br />" +val;
                        },
                        orderable: false
                },
                {
                    data:'username',
                },
                {
                    data:'order_number',
                },
                {
                    data:'message',
                },
                {
                    data: null,
                    render: function(data, type, full, meta){
                        var button = "";
                        button = '<button class="btn btn-dark btn-sm"><a style="color:white" href="{{ route('admin')}}/ticket-details/'+data.id+'"><i class="fa fa-eye"></i> View Details<a/></button>&nbsp;&nbsp;';
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

                if(target=="#tab_open" && isPFirstTime){
                    table_open_tickets.ajax.reload();
				}else if(target=="#tab_close" && isCFirstTime){
                    table_close_details.ajax.reload();
				}
			});
        });

</script>

@endsection

