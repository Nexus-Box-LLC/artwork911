<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>ArtWork | Ticket Details</title>
	@include('front.layouts.css')

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

    @section('css')
    <link href="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admi/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('Admi/assets/css/custom.css" rel="stylesheet')}}" type="text/css" />
    @endsection



</head>
<body>
	<div class="content-wrapper">
    	@include('front.layouts.header')
        <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="{{asset('Front/assets/img/photos/bg3.jpg')}}">
			<div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
			</div>
		</section>
        <section class="wrapper artwork-containers bg-light angled upper-end">
			<div class="container">
				<div class="row mb-14 mb-md-16">
					<div class="col-xl-12  mx-auto mt-n19">
						<div class="row">
                            <div class="col-md-3">
                                 @include('front.layouts.sidebar')
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="display-6 mb-3 text-white">Tickets details</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Tickets details</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card" style="overflow:hidden;padding:20px;">

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h6 class="header-title mt-0 mb-0">Order Number <span class="text-success">#{{$tickets_details->order_number}} </span></h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6 class="header-title mt-0 mb-0">Created at <br /><span class="text-success">{{date('M d, Y', strtotime($tickets_details->created_at))}}</span></h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h6 class="header-title mt-0 mb-0">Status
                                                                    @if($tickets_details->status==0)
                                                                        <br/><span class="text-warning">Pending</span>
                                                                        @elseif($tickets_details->status==1)
                                                                        <br/><span class="text-green">Completed</span>
                                                                        @else
                                                                        <span class="text-green">-</span>
                                                                    @endif
                                                                </h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <form method="post" action="{{url('complete-ticket-user',$tickets_details->id)}}">
                                                                    @csrf
                                                                    <button class="btn btn-primary float-right btn-sm" type="submit">Complete ticket</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @if(session()->has('success'))
                                                                    <div class="alert alert-success">
                                                                        {{ session()->get('success') }}
                                                                    </div>
                                                                @endif
                                                                <table class="table colored table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>
                                                                                Tickets details
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <!-- open tickets-->
                                                                        @if($tickets_details->status==0)
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="lbl">Title</label>
                                                                                    {{$tickets_details->title}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="lbl">Reason</label>
                                                                                    @if($tickets_details->reason==0)
                                                                                        <span>Order related</span>
                                                                                        @elseif($tickets_details->reason==1)
                                                                                            <span>Payment related</span>
                                                                                        @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="lbl">Message</label>
                                                                                    {{$tickets_details->message}}
                                                                                </td>
                                                                            </tr>
                                                                            <td>
                                                                                <label class="lbl">Customer Uploaded Files</label>
                                                                                <?php
                                                                                    $files_array = [];
                                                                                    array_push($files_array, $tickets_details->attachment);


                                                                                    $files_array = array_values(array_filter($files_array));

                                                                                    foreach($files_array as $index=>$val){
                                                                                ?>
                                                                                <a href="{{route('/')}}/download-file/{{$val}}"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                                                                <?php } ?>
                                                                            </td>

                                                                            <!-- close Tickets -->

                                                                            @elseif($tickets_details->status==1)
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="lbl">Title</label>
                                                                                    {{$tickets_details->title}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="lbl">Reason</label>
                                                                                    @if($tickets_details->reason==0)
                                                                                        <span class="text-warning">Order related</span>
                                                                                        @elseif($tickets_details->reason==1)
                                                                                            <span class="text-info">Payment</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <label class="lbl">Message</label>
                                                                                    {{$tickets_details->message}}
                                                                                </td>
                                                                            </tr>
                                                                            <td>
                                                                                <label class="lbl">Customer Uploaded Files</label>
                                                                                <?php
                                                                                    $files_array = [];
                                                                                    array_push($files_array, $tickets_details->attachment);


                                                                                    $files_array = array_values(array_filter($files_array));

                                                                                    foreach($files_array as $index=>$val){
                                                                                ?>
                                                                                <a href="{{route('/')}}/download-file/{{$val}}"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                                                                <?php } ?>
                                                                            </td>
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                             </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table class="table colored table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>
                                                                                    Tickets Updates
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
                                                                                                <a href="javascript:void(0);" style="float: right;">{{ $history->created_at->format('M d, Y')}}</a>
                                                                                                <p> {{$history->message}}</p>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    @if($tickets_details->status==0)
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
																			  
																				<form method="POST" data-ajax="user-ticket-update" data-target-button=".btn-user-ticket" data-allow-success enctype="multipart/form-data">
																					@csrf
																					<input type="hidden" name="ticket_id" value="{{$tickets_details->id}}" />
																					<div class="form-group">
																						<label>Your Message</label>
																						<textarea name="message" required data-error="Please enter your message"  placeholder="Enter message..." rows="5" class="form-control"></textarea>
																					<div class="help-block with-errors"></div>
																					</div>

																					 <div class="form-group">
																					<label>Files (Multiple Allows) <span class="text-danger">*</span></label>
																					<input type="file" name="files[]" multiple class="form-control" required data-error="Please select file" />
																					<div class="help-block with-errors"></div>
																					</div>
																				 
																					<div class="messages"></div>
																					<button class="btn btn-primary btn-user-ticket"><i class="fa fa-check"></i> Submit</button>
																				</form>
																			</td>
																		</tr>
																		</tbody>
                                                                    </table>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                    </div>

                                            </div>
                                        </div>
								</div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</section>
	</div>
        @include('front.layouts.footer')
        @include('front.layouts.scripts')
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
        @endsection
    </body>
</html>
