@extends('admin.layouts.master')
@section('title', 'View Qoutes Details')

@section('breadcrumb-title')
View Qoutes Details
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active"> View Qoutes Details</li>
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
                                <h4 class="header-title mt-0 mb-0">Order Type: <span class="text-success">{{$details->type == 0 ? "Digitizing" : "Vectorizing"}}</span></h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="header-title mt-0 mb-0">Created at: <span class="text-success">{{$details->created_at}}</span></h4>
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table colored table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                               Qoutes Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Vectorizing Order -->
                                        @if($details->type==1)
                                        <tr>
                                            <td>
                                                <label class="lbl">Design Name</label><br />
                                                {{$details->design_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">PO#</label><br />
                                                {{$details->po}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Required file format#</label><br />
                                                {{$details->required_file_format}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Design Size</label><br/>
                                                <?php echo "$details->ds_width x $details->ds_height $details->ds_length" ?>
                                                @if($details->design_not_sure==1)
                                                    <br/> {{"Not Sure"}}
                                                @endif

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">What color type you would require?</label><br/>
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
                                                <label class="lbl">What type of printing what use this Art for?</label><br />
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
                                                <label class="lbl">Color Separation Required?</label><br />
                                                {{ $details->color_separation_required==1 ? "Yes" : "No"}}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Difficulty Level</label><br/>
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
                                                <label class="lbl">Virtual sample:</label><br />
                                                {{$details->is_virtual_sample == 1 ? "Yes" : "No"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">General Comments/Additional Instructions</label><br />
                                                {{$details->comments == "" ? "-" : $details->comments }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Customer Uploaded Files</label><br />
                                                <?php
                                                    $files_array = [];
                                                    array_push($files_array, $details->file_1);
                                                    array_push($files_array, $details->file_2);
                                                    array_push($files_array, $details->file_3);
                                                    array_push($files_array, $details->file_4);

                                                    $files_array = array_values(array_filter($files_array));

                                                    foreach($files_array as $index=>$val){
                                                ?>
                                                <a href="{{route('admin')}}/download-qoute/{{$val}}?type=vo"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <!-- Digitizing Order -->
                                        @elseif($details->type==0)
                                        <tr>
                                            <td>
                                                <label class="lbl">Design Name</label><br />
                                                {{$details->design_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">PO#</label><br />
                                                {{$details->po}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Required file format#</label><br />
                                                {{$details->required_file_format}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Fabric/Garment Type</label><br />
                                                {{$details->fabric_name}}
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
                                                <label class="lbl">Garment Placement</label><br />
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
                                                <label class="lbl">Design Size</label><br />
                                                    <?php echo "$details->ds_width x $details->ds_height $details->ds_length" ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label class="lbl">Is ArtWork authorized to modify design elements to ensure quality embroidery? This may involve simplifying fonts and adjusting letter sizes. ArtWork will do all possible to maintain design integrity:</label><br/>
                                                {{$details->is_artwork_authorized == 1 ? "Yes" : "No"}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label class="lbl">Are large “White” areas (other than detail) filled with stitching?</label><br />
                                                {{$details->is_filled_with_stitching == 1 ? "Yes" : "No"}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label class="lbl">Virtual sample:</label><br />
                                                {{$details->is_virtual_sample == 1 ? "Yes" : "No"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">General Comments/Additional Instructions</label><br />
                                                {{$details->comments == "" ? "-" : $details->comments }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="lbl">Customer Uploaded Files</label><br />
                                                <?php
                                                    $files_array = [];
                                                    array_push($files_array, $details->file_1);
                                                    array_push($files_array, $details->file_2);
                                                    array_push($files_array, $details->file_3);
                                                    array_push($files_array, $details->file_4);

                                                    $files_array = array_values(array_filter($files_array));

                                                    foreach($files_array as $index=>$val){
                                                ?>
                                                <a href="{{route('admin')}}/download-qoute/{{$val}}?type=do"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table colored table-bordered">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection


