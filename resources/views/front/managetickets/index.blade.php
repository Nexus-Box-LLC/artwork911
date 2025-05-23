<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>ArtWork | Tickets</title>
	@include('front.layouts.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css" />
</head>
<body>
	<div class="content-wrapper">
    	@include('front.layouts.header')
        <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="Front/assets/img/photos/bg3.jpg">
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
                                        <h3 class="display-6 mb-3 text-white">Tickets</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Tickets</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                @endif
                                <div class="card" style="overflow:hidden;padding:20px;">


                                    <div class="row">
                                        <div class="col-md-9">
                                            <ul class="nav nav-tabs nav-pills">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tab1-1">
                                                        <img src="{{asset('Front/assets/img/icons/telemarketer.svg')}}" class="svg-inject icon-svg" alt="" />
                                                        <span> Open Ticket</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tab1-2">
                                                        <img src="{{asset('Front/assets/img/icons/telemarketer.svg')}}" class="svg-inject icon-svg" alt="" />
                                                        <span>Close Ticket</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <a class="btn btn-primary rounded-pill" href="{{route('create.tickets')}}">
                                                <img src="{{asset('Front/assets/img/icons/clock-2.svg')}}" class="svg-inject icon-svg" alt="" />
                                                <span>Create ticket</span>
                                            </a>
                                        </div>
                                    </div>

										<div class="tab-content">
											<div class="tab-pane fade active show" id="tab1-1">
												<table id="open-ticket" class="table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th width="20%">Date Created</th>
															<th width="20%">Ticket Number</th>
															<th width="20%">Username</th>
															<th width="30%">Message</th>
															<th width="10%">Action</th>
														</tr>
													</thead>
													<tbody></tbody>
												</table>
											</div>
											
											<div class="tab-pane fade" id="tab1-2">
												<table id="close-ticket" class="table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th width="20%">Date Created</th>
															<th width="20%">Ticket Number</th>
															<th width="20%">Username</th>
															<th width="30%">Message</th>
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
				</div>
			</div>
		</section>
	</div>
	@include('front.layouts.footer')
	@include('front.layouts.scripts')

    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js"></script>
    
	<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script>
    $(document).ready(function(){

       var open_ticket =  $('#open-ticket').DataTable({
				"processing": true,
				"serverSide": true,
				"bStateSave": true,
				"oLanguage": {
				  "sLengthMenu": "Showing _MENU_ Tickets",
				  "sInfo": "Showing _START_ to _END_ from _TOTAL_ open ticket",
				  "sSearch": "",
				  "sEmptyTable": "Open ticket not found",
				  "sSearchPlaceholder":"Search ticket",
				  "paginate": {
					  "next": '>>',
					  "previous": '<<'
					}
				},
				"ajax": {
					url:"{{route('open-ticket')}}",
                    type: "get",
					error: function(resp){
						alert("Error");
					}
				},
				"aaSorting" : [[0,"DESC"]],
				pageLength: 25,
				responsive: true,
				bPaginate:true,
				"aoColumns":[
					{"mData": "created_at"},
					{"mData": "ticket_number"},
					{"mData": "username"},
                    {"mData": "message"},
					{
						"mData": null,
						"orderable": false,
						"mRender" : function(data){

							var buttons ='<a class="btn btn-primary btn-sm" href="{{ route("/")}}/manage-tickets-details/'+data.id+'"><img src="{{asset('Front/assets/img/icons/show.svg')}}" class="svg-inject icon-svg" alt="" /> View Details</a>';

							return buttons;
						}
					}
				],"drawCallback": function(settings, json) {

					SVGInject(document.querySelectorAll("img.svg-inject"));

				  }
			});

			var close_ticket = $('#close-ticket').DataTable({
				"processing": true,
				"serverSide": true,
				"deferLoading": 0,
				"bStateSave": true,
				"oLanguage": {
				  "sLengthMenu": "Showing _MENU_ Tickets",
				  "sInfo": "Showing _START_ to _END_ from _TOTAL_ close ticket",
				  "sSearch": "",
				  "sEmptyTable": "Close ticket not found",
				  "sSearchPlaceholder":"Search close ticket",
				  "paginate": {
					  "next": '>>',
					  "previous": '<<'
					}
				},
				"ajax": {
					url:"{{route('close-ticket')}}",
					type: "get",
					error: function(resp){
						alert("Error");
					}
				},
				"aaSorting" : [[0,"DESC"]],
				pageLength: 25,
				responsive: true,
				bPaginate:true,
				"aoColumns":[
					{"mData": "created_at"},
					{"mData": "ticket_number"},
					{"mData": "username"},
                    {"mData": "message"},
					{
						"mData": null,
						"orderable": false,
						"mRender" : function(data){

							var buttons ='<a class="btn btn-primary btn-sm" href="{{ route('/')}}/manage-tickets-details/'+data.id+'"><img src="{{asset('Front/assets/img/icons/show.svg')}}" class="svg-inject icon-svg" alt="" />  View Details</a>';

							return buttons;
						}
					}
				],"drawCallback": function(settings, json) {

					SVGInject(document.querySelectorAll("img.svg-inject"));

				  }
			});

			var firstTime = true;

			$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
			  var target = $(e.target).attr("href") // activated tab
			  if(firstTime && target=="#tab1-2"){
				  firstTime=false;
				  $('#close-ticket').DataTable().columns.adjust().draw();
                  close_ticket.ajax.reload();
			  }
			});
         });
    </script>
</body>
</html>
