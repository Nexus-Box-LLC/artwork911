@extends('admin.layouts.master')
@section('title', 'Ticket Details')

@section('css')
    <link href="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admi/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admi/assets/css/custom.css" rel="stylesheet')}}" type="text/css" />
@endsection

@section('style')
<style>

        .lbl{
            display:block;
            margin: 0px;
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
        }
        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline > li {
            margin: 20px 0;
            padding-left: 20px;
        }
        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }
    </style>
@endsection

@section('breadcrumb-title')
Ticket Details
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Tickets</li>
<li class="breadcrumb-item active">Ticket Details</li>
@endsection

@section('content')
     <div class="row">
	    @include('admin.auth.flash-message')
        <div class="col-lg-12 col-md-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="header-title mt-0 mb-0">Order Number: <span class="text-success">#{{$details->order_number}} </span></h4>
                        </div>
                        <div class="col-md-3">
                            <h4 class="header-title mt-0 mb-0">Created at: <span class="text-success">{{date('M d, Y', strtotime($details->created_at))}}</span></h4>
                        </div>
                        <div class="col-md-3">
                            <h4 class="header-title mt-0 mb-0">Status:
                                @if($details->status==0)
                                    <span class="text-warning">Pending</span>
                                    @elseif($details->status==1)
                                    <span class="text-green">Completed</span>
                                    @else
                                    <span class="text-green">-</span>
                                @endif
                            </h4>
                        </div>
                        @if($details->status==0)
                        <div class="col-md-3">

                            <form method="post" action="{{url('admin/complete-ticket', $details->id)}}">
                                @csrf
                                <button class="btn btn-success float-right btn-sm" type="submit">Complete ticket</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table colored table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                               Ticket Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Vectorizing Order -->
                                        @if($details->status==0)
                                        <tr>
                                            <td>
                                                <label class="lbl">Title</label>
                                                {{$details->title}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Reason</label>
                                                @if($details->reason==0)
                                                    <span class="text-warning">Order related</span>
                                                    @elseif($details->reason==1)
                                                        <span class="text-info">Payment related</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Message</label>
                                                {{$details->message}}
                                            </td>
                                        </tr>
                                        <td>
                                            <label class="lbl">Customer Uploaded Files</label>
                                            <?php
                                                    $files_array = [];
                                                    array_push($files_array, $details->attachment);


                                                    $files_array = array_values(array_filter($files_array));

                                                    foreach($files_array as $index=>$val){
                                                ?>
                                                <a href="{{route('admin')}}/download-ticket-file/{{$val}}"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                                <?php } ?>

                                        </td>

                                        <!-- close Tickets -->

                                        @elseif($details->status==1)
                                        <tr>
                                            <td>
                                                <label class="lbl">Title</label>
                                                {{$details->title}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Reason</label>
                                                @if($details->reason==0)
                                                    <span class="text-warning">Order related</span>
                                                    @elseif($details->reason==1)
                                                        <span class="text-info">Pyment related</span>

                                                    @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Message</label>
                                                {{$details->message}}
                                            </td>
                                        </tr>
                                        <td>
                                            <label class="lbl">Customer Uploaded Files</label>
                                            <?php
                                                $files_array = [];
                                                array_push($files_array, $details->attachment);

                                                $files_array = array_values(array_filter($files_array));

                                                foreach($files_array as $index=>$val){
                                            ?>
                                            <a href="{{route('admin')}}/download-ticket-file/{{$val}}"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                            <?php } ?>

                                        </td>
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table colored table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                               Ticket Update
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            @if(count($tickethistory) > 0 )
                                                <ul class="timeline">
                                                    @foreach($tickethistory as $history)
                                                        <li>
                                                            <a href="javascript:void(0);">
                                                             @if($history->user_type==-1)
                                                                User
                                                            @elseif($history->user_type==0)
                                                                Admin
                                                            @endif
                                                            </a>
                                                            <a href="javascript:void(0);" class="float-right">{{ $history->created_at->format('M d, Y')}}</a>
                                                            <p> {{$history->message}}</p>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if($details->status==0)
                                <table class="table colored table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Submit Ticket update
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                               <?php $user = Auth::guard('web')->user() ?>
                                                <br/>
                                                <form method="POST" data-ajax="admin/ticket-update" data-target-button=".btn-ticket-update" data-allow-success enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="ticket_id" value="{{$details->id}}" />
                                                    <input type="hidden" name="user_id" value="{{$user->id}}" />

                                                    <label>Your Message</label>
                                                    <textarea name="message" placeholder="Enter message..." rows="5" class="form-control"></textarea>

                                                    <br />
                                                    <label>Files (Multiple Allows) <span class="text-danger">*</span></label>
                                                    <input type="file" name="files[]" multiple class="form-control" />
                                                    <br />
                                                    <div class="messages"></div>
                                                    <button type="submit" class="btn btn-success btn-ticket-update"><i class="fa fa-check"></i> Submit</button>
                                                </form>
                                            </td>
                                        <tr>

                                    </tbody>
                                </table>
                                @endif
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
<script src="{{asset('Front/assets/js/form-plugin.js')}}"></script>
<script src="{{asset('Front/assets/js/validator.min.js')}}"></script>
<script>
	function ajax_success(target, data){
		if(target=="user-login"){
			window.location.href=window.location.href;
		}
	}
</script>

@endsection







