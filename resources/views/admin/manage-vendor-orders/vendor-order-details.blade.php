@extends('admin.layouts.master')
@section('title', 'Order Details')

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
Order Details
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active"><a href="{{ route('get-vendor-pending-order')}}"> Manage Orders </a></li>
<li class="breadcrumb-item"> Order Details</li>
@endsection

@section('content')
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="header-title mt-0 mb-0">Order Number: <span class="text-success">#{{$details->order_number}} </span></h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="header-title mt-0 mb-0">Order Type: <span class="text-success">{{$details->type == 0 ? "Digitizing" : "Vectorizing"}}</h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="header-title mt-0 mb-0">Created at: <span class="text-success">{{$details->created_at}}</span></h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="header-title mt-0 mb-0">Status:
                                @if($details->status==0)
                                        <span class="text-warning">Pending</span>
                                    @elseif($details->status==1)
                                        <span class="text-info">In Progress</span>
                                    @elseif($details->status==2)
                                        <span class="text-primary">Waiting Approval</span>
                                    @elseif($details->status==3)
                                        <span class="text-green">Completed</span>
                                    @else
                                    <span class="text-green">-</span>
                                @endif
                                </div>
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <table class="table colored table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Order Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <!-- Vectorizing Order -->
                                    @if($details->type==1)
                                    <tr>
                                        <td>
                                            <label class="lbl">Design Name</label>
                                            {{$details->design_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">PO#</label>
                                            {{$details->po}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">Required file format#</label>
                                            {{$details->required_file_format}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">Design Size</label>
                                            <?php echo "$details->ds_width x $details->ds_height $details->ds_length" ?>
                                            @if($details->design_not_sure==1)
                                                <br/> {{"Not Sure"}}
                                            @endif
                                            </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">What color type you would require?</label>

                                            @if($details->color_type==0)
                                                    <span class="text-warning">Pantone</span>
                                                @elseif($details->color_type==1)
                                                    <span class="text-info">CMYK</span>
                                                @elseif($details->color_type==2)
                                                    <span class="text-primary">RGB</span>
                                                @else
                                                <span class="text-green">-</span>
                                            @endif

                                            @if($details->color_type == 0)
                                            <tr>
                                                <td>
                                                    <label class="lbl">Do you require halftones?</label><br/>
                                                    {{ $details->require_halftones==1 ? "Yes" : "No"}}
                                                </td>
                                            </tr>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="lbl">What type of printing what use this Art for?</label>
                                                @if($details->art_printing_type==0)
                                                        <span class="text-warning">screenprinting</span>
                                                    @elseif($details->art_printing_type==1)
                                                        <span class="text-info">digital printing</span>
                                                    @elseif($details->art_printing_type==2)
                                                        <span class="text-primary">vinyl cutting</span>
                                                    @elseif($details->art_printing_type==3)
                                                    <span class="text-green">hard goods</span>
                                                    @else
                                                    <span class="text-green">-</span>
                                                @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">Color Separation Required?</label>
                                            {{ $details->color_separation_required==1 ? "Yes" : "No"}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">Difficulty Level</label>
                                            @if($details->difficulty_level==0)
                                                    <span class="text-warning">Simple</span>
                                                @elseif($details->difficulty_level==1)
                                                    <span class="text-info">Complex</span>
                                                @elseif($details->difficulty_level==2)
                                                    <span class="text-primary">Logo Design</span>
                                                @else
                                                <span class="text-green">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">Virtual sample:</label>
                                            {{$details->is_virtual_sample == 1 ? "Yes" : "No"}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">General Comments/Additional Instructions</label>
                                            {{$details->comments == "" ? "-" : $details->comments }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">Customer Uploaded Files</label>
                                            <?php
                                                $files_array = [];
                                                array_push($files_array, $details->file_1);
                                                array_push($files_array, $details->file_2);
                                                array_push($files_array, $details->file_3);
                                                array_push($files_array, $details->file_4);
                                                $files_array = array_values(array_filter($files_array));
                                                foreach($files_array as $index=>$val){
                                            ?>
                                            <a href="{{route('admin')}}/download-file/{{$val}}?type=vo"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <!-- Digitizing Order -->
                                    @elseif($details->type==0)
                                    <tr>
                                        <td>
                                            <label class="lbl">Design Name</label>
                                            {{$details->design_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">PO#</label>
                                            {{$details->po}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">Required file format#</label>
                                            {{$details->required_file_format}}
                                        </td>
                                    </tr>
                                    @if(strtoupper($details->fabric_name == "OTHER"))
                                        <tr>
                                            <td>
                                                <label class="lbl">Fabric/Garment Name</label><br />
                                                {{$details->other_fabric_name}}
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td>
                                                <label class="lbl">Garment Placement</label>
                                                {{$details->garment_placement}}
                                            </td>
                                        </tr>
                                        @if(strtoupper($details->garment_placement =="JACKET BACK") || strtoupper($details->garment_placement=="FULL FRONT"))
                                        <tr>
                                            <td>
                                                <label class="lbl">Requested a sewout of your Jacket Back design</label>
                                                {{$details->is_jacket_back == 1 ? "Yes" : "No"}}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>
                                            <label class="lbl">Design Size</label>
                                            <?php echo "$details->ds_width x $details->ds_height $details->ds_length" ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="lbl">Is ArtWork authorized to modify design elements to ensure quality embroidery? This may involve simplifying fonts and adjusting letter sizes. ArtWork will do all possible to maintain design integrity:</label>
                                            {{$details->is_artwork_authorized == 1 ? "Yes" : "No"}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="lbl">Are large “White” areas (other than detail) filled with stitching?</label>
                                            {{$details->is_filled_with_stitching == 1 ? "Yes" : "No"}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label class="lbl">Virtual sample:</label>
                                            {{$details->is_virtual_sample == 1 ? "Yes" : "No"}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">General Comments/Additional Instructions</label>
                                            {{$details->comments == "" ? "-" : $details->comments }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="lbl">Customer Uploaded Files</label>
                                            <?php
                                                $files_array = [];
                                                array_push($files_array, $details->file_1);
                                                array_push($files_array, $details->file_2);
                                                array_push($files_array, $details->file_3);
                                                array_push($files_array, $details->file_4);

                                                $files_array = array_values(array_filter($files_array));

                                                foreach($files_array as $index=>$val){
                                            ?>
                                            <a href="{{route('admin')}}/download-file/{{$val}}?type=do"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-md-6">
                                <table class="table colored table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Order Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                        @if(count($orderhistory) > 0 )
                                            <ul class="timeline">
                                                @foreach($orderhistory as $history)
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                        @if($history->type==0)
                                                            Order created
                                                        @elseif($history->type==1)
                                                            Order updated
                                                        @elseif($history->type==2)
                                                            Submit updates
                                                        @elseif($history->type==3)
                                                            Order completed
                                                        @endif</a>
                                                        <a href="javascript:void(0);" class="float-right">{{ $history->created_at->format('M d, Y')}}</a>
                                                        <p> {{$history->description}}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        </td>
                                    </tr>
                                   {{-- @if(count($orderhistory) > 0 )
                                        @foreach($orderhistory as $history)
                                           <tr>
                                            <td>
                                               <label class="lbl">User</label><br />
                                                   @if($history->user_type==0)
                                                       <label class="badge bg-primary" style="color: white;">Super Admin</label>
                                                   @elseif($history->user_type==1)
                                                       <label class="badge bg-warning text-dark" style="color: white;">Vendor</label>
                                                   @elseif($history->user_type==2)
                                                       <span class="text-primary">Sub Admin</span>
                                                   @elseif($history->user_type==-1)
                                                       <label class="badge bg-info" style="color: white;">Normal user</label>
                                                   @endif
                                               </td>
                                              <td>
                                               <label class="lbl">Description</label><br />
                                               {{$history->description}}
                                              </td>

                                              <td>
                                               <label class="lbl">Type</label><br />
                                               @if($history->type==0)
                                                   <label class="badge bg-primary" style="color: white;">order created</label>
                                               @elseif($history->type==1)
                                                   <label class="badge bg-warning text-dark" style="color: white;">order updated</label>
                                                @elseif($history->type==2)
                                                   <span class="badge bg-warning">submit updates</span>
                                               @elseif($history->type==3)
                                                   <label class="badge bg-info" style="color: white;">order completed	</label>
                                               @endif
                                              </td>
                                               <td>
                                                   <label class="lbl">status</label><br />
                                                   @if($history->status==0)
                                                       <label class="badge bg-primary" style="color: white;">pending</label>
                                                   @elseif($history->status==1)
                                                       <label class="badge bg-warning text-dark" style="color: white;">in progress</label>
                                                   @elseif($history->status==2)
                                                       <span class="badge bg-danger" style="color: white;">waiting approval</span>
                                                   @elseif($history->status==3)
                                                       <label class="badge bg-warning" style="color: white;">completed</label>
                                                   @endif
                                               </td>
                                               <td>
                                               <label class="lbl">Date</label><br />
                                               {{ $history->created_at->format('d/m/Y')}}
                                              </td>
                                           </tr>
                                           @endforeach
                                       @endif--}}
                                    </tbody>
                                </table>

                                <table class="table colored table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Submit Work
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php $vendor = Auth::guard('web')->user() ?>
                                                <form method="POST" data-ajax="admin/submit-work" data-target-button=".btn-submit-work" data-allow-success enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{$details->id}}" />
                                                    <input type="hidden" name="vendor_id" value="{{$vendor->id}}" />

                                                    <label>Your Message</label>
                                                    <textarea name="message" placeholder="Enter message..." rows="5" class="form-control"></textarea>

                                                    <br />
                                                    <label>Files (Multiple Allows) <span class="text-danger">*</span></label>
                                                    <input type="file" name="files[]" multiple class="form-control" />
                                                    <br />
                                                    <div class="messages"></div>
                                                    <button class="btn btn-success btn-submit-work"><i class="fa fa-check"></i> Submit</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
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
    @endsection
