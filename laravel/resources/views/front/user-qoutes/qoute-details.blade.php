<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>ArtWork</title>
	@include('front.layouts.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css" />
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
                                        <h3 class="display-6 mb-3 text-white">Qoute details</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Qoute details</li>
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
                                                                <h4 class="header-title mt-0 mb-0">Order Number: <span class="text-success">#{{$details->order_number}} </span></h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h4 class="header-title mt-0 mb-0">Order Type: <span class="text-success">{{$details->type == 0 ? "Digitizing" : "Vectorizing"}}</span></h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h4 class="header-title mt-0 mb-0">Created at: <span class="text-success"><br/>{{date('M d, Y', strtotime($details->created_at))}}</span></h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h4 class="header-title mt-0 mb-0">Status:
                                                                    @if($details->status==0)
                                                                        <br/><span class="text-warning">Pending</span>
                                                                    @elseif($details->status==1)
                                                                    <br/><span class="text-green">Completed</span>
                                                                    @else
                                                                    <span class="text-green">-</span>
                                                                    @endif
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table colored table-bordered">

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
                                                                                <a href="{{route('/')}}/download-qoute/{{$val}}?type=vo"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
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
                                                                                <a href="{{route('/')}}/download-qoute/{{$val}}?type=do"><i class="fa fa-download"></i> Download File <?=($index+1)?></a>&nbsp; &nbsp;
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                             </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table class="table colored table-bordered">

                                                                    </table>
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
    </body>
</html>
