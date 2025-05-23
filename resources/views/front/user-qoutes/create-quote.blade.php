<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>ArtWork | Create Quotes </title>
	@include('front.layouts.css')
    <link rel="stylesheet" href="{{asset('Front/assets/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('Front/assets/css/fancybox.css')}}">
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
                                    <div class="col-md-5">
                                        <h3 class="display-6 mb-3 text-white">Create Quotes</h3>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item"><a href="{{route('qoutes')}}">Quotes</a></li>
                                                <li class="breadcrumb-item active">Create</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card" style="overflow:hidden;padding:20px;">
                                    @php
                                        $is_digitizing_tab = true;
                                    @endphp
                                    <div class="hero-slider-wrapper">
                                        <ul class="nav nav-tabs nav-pills">
                                            <li class="nav-item">
                                                <a class="nav-link @if($is_digitizing_tab) active @endif" data-bs-toggle="tab" href="#tab1-1">
                                                    <img src="{{asset('Front/assets/img/icons/clock-2.svg')}}" class="svg-inject icon-svg" alt="" />
                                                    <span> Digitizing Qoute</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link @if(!$is_digitizing_tab) active @endif" data-bs-toggle="tab" href="#tab1-2">
                                                    <img src="{{asset('Front/assets/img/icons/clock-2.svg')}}" class="svg-inject icon-svg" alt="" />
                                                    <span>Vectorizing Qoute</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade @if($is_digitizing_tab) active show @endif" id="tab1-1">
                                                <div class="row">
                                                <form method="POST" data-ajax="digitizing-qoute" data-target-button=".btn-digitizing-qoute" data-allow-success  enctype="multipart/form-data" class="text-start mb-3">
                                                    @csrf
                                                    <div class="row">
                                                         <div class="col-md-6">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <input type="text" class="form-control" placeholder="Enter design name" name="design_name" required data-error="Please enter design name." />
                                                                 <label>Design Name *</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <input type="text" class="form-control" placeholder="Enter PO#" name="po" />
                                                                 <label for="reg_po">PO# (optional)</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="row">
                                                         <div class="col-md-6">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <select class="form-control" required data-error="Please select required file format" name="required_file_format">
                                                                 <option value="">Select File Format</option>
                                                                 @foreach ($allow_exts as $allow_ext)
                                                                         <option value="{{$allow_ext}}">{{$allow_ext}}</option>
                                                                 @endforeach
                                                                 </select>
                                                                 <label>Required File Format *</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-6 fab_selector">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <select class="form-control" required data-error="Please select fabric/garment type" name="fabric_name">
                                                                     <option value="">Select</option>
                                                                     <option value="Pique Knit">Pique Knit</option>
                                                                     <option value="Cap">Cap</option>
                                                                     <option value="Performance Knit">Performance Knit</option>
                                                                     <option value="Nylon Jacket">Nylon Jacket</option>
                                                                     <option value="Fleece (Sweat Shirt)">Fleece (Sweat Shirt)</option>
                                                                     <option value="Polar Fleece">Polar Fleece</option>
                                                                     <option value="Terry Cloth (Towel/Robe)">Terry Cloth (Towel/Robe)</option>
                                                                     <option value="Blanket">Blanket</option>
                                                                     <option value="Nylon Cordura">Nylon Cordura</option>
                                                                     <option value="Vinyl">Vinyl</option>
                                                                     <option value="Leather">Leather</option>
                                                                     <option value="Other">Other</option>
                                                                 </select>
                                                                 <label for="reg_sfgt">Fabric/Garment Type *</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-3 hide">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <input type="text" class="form-control" placeholder="Enter Other Fabric/Garment Name" name="other_fabric_name" />
                                                                 <label for="reg_ofgn">Fabric/Garment Name</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="row">

                                                         <div class="col-md-4">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <select class="form-control" required data-error="Please select garment placement" name="garment_placement">
                                                                     <option value="">Select Garment Placement</option>
                                                                     <option value="Left Chest Logos" >Left Chest Logos</option>
                                                                     <option value="Jacket Back">Jacket Back</option>
                                                                     <option value="Sleeve" >Sleeve</option>
                                                                     <option value="Cap">Cap</option>
                                                                     <option value="Back yoke" >Back yoke</option>
                                                                     <option value="Cuff" >Cuff</option>
                                                                     <option value="Full Front">Full Front</option>
                                                                     <option value="Edit">Edit</option>
                                                                 </select>
                                                                 <label for="reg_gp">Garment Placement *</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>

                                                         <div class="col-md-2 text-right">
                                                             <label style="margin-top: 10px;">Design Size *</label>
                                                         </div>
                                                         <div class="col-md-2">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <input type="text" class="form-control" required data-error="Enter width" placeholder="Enter width" name="ds_width" />
                                                                 <label for="reg_width">Width</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-2">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <input type="text" class="form-control" required data-error="Enter height" placeholder="Enter height" name="ds_height" />
                                                                 <label for="reg_height">Height</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>
                                                         <div class="col-md-2">
                                                             <div class="form-label-group form-group mb-4">
                                                                 <select class="form-control" name="ds_length">
                                                                     <option value="centimeters">Centimeters</option>
                                                                     <option value="millimeters">Millimeters</option>
                                                                     <option selected value="inches">Inches</option>
                                                                 </select>
                                                                 <label for="reg_length">Length</label>
                                                                 <div class="help-block with-errors"></div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <div class="row">
                                                         <div class="col-md-12 text-red hide jacket_back_content">
                                                             <label>Click here &nbsp; </label>
                                                             <div class="form-group" style="display: inline-block">
                                                                 <input class="form-check-input" type="radio" name="jacket_back" value="1" id="jacket_back_yes">
                                                                 <label class="form-check-label" for="jacket_back_yes"> Yes </label> &nbsp; or  &nbsp;
                                                                 <input class="form-check-input" type="radio" checked name="jacket_back" value="0" id="jacket_back_no">
                                                                 <label class="form-check-label" for="jacket_back_no"> No </label>
                                                             </div> &nbsp;
                                                             <label style="display: inline"> to request a sewout of your Jacket Back design. Please note: Jacket Back sewouts are an additional $10.</label>
                                                             <br /><br />
                                                         </div>
                                                         <div class="col-md-12">
                                                             <label for="">Is ArtWork authorized to modify design elements to ensure quality embroidery? This may involve simplifying fonts and adjusting letter sizes. ArtWork will do all possible to maintain design integrity:</label>
                                                             <div class="form-group">
                                                                 <input class="form-check-input" type="radio" name="artwork_authorized" value="1" id="artwork_authorized_yes">
                                                                 <label class="form-check-label" for="artwork_authorized_yes"> Yes </label>
                                                                 <input class="form-check-input" type="radio" checked name="artwork_authorized" value="0" id="artwork_authorized_no">
                                                                 <label class="form-check-label" for="artwork_authorized_no"> No </label>
                                                             </div>

                                                             <small class="text-yellow">*If major changes are required we will contact you prior to altering the design.</small>
                                                         </div>
                                                         <div class="col-md-12">
                                                             <br />
                                                             <label>Are large “White” areas (other than detail) filled with stitching? </label>

                                                             <div class="form-group">
                                                                 <input class="form-check-input" type="radio" name="filled_with_stitching" value="1" id="filled_with_stitching_yes">
                                                                 <label class="form-check-label" for="filled_with_stitching_yes"> Yes </label>
                                                                 <input class="form-check-input" type="radio" checked name="filled_with_stitching" value="0" id="filled_with_stitching_no">
                                                                 <label class="form-check-label" for="filled_with_stitching_no"> No </label>
                                                             </div>

                                                         </div>
                                                         <div class="col-md-12">
                                                             <br />
                                                             <div class="form-label-group form-group">
                                                                 <textarea placeholder="Include General Comments and Additional Instructions if Necessary" name="comments" class="form-control" rows="5"></textarea>
                                                                 <label for="reg_comments">Include General Comments and Additional Instructions if Necessary:</label>
                                                             </div>

                                                             <small>Note: This field is meant to provide instructions. Please do not request quotes or “ask questions” in this filed. To receive a quote or ask questions prior to placing order please use a <a href="#">Quote Form</a>.</small>
                                                         </div>
                                                         <div class="col-md-12">
                                                             <br /><label>Click browse below to upload your file: Acceptable formats are: </label>
                                                             <br /><small class="text-blue">Allowed extensions *.gif, *.jpg, *.tif, *.pdf, *.bmp, *.eps, *.cdr, *.pcx, *.tiff, *.jpeg, *.cnd, *.ppt, *.fdr, *.bar, *.dst, *.emb, *.mls, *.isi, *.0oo, *.dsz, *.t09, *.fmc, *.dsb.,pxf, .pof.</small>
                                                             <br /><small class="text-yellow">The maximum file size is 20 MB (20480 KB). If your files are larger than this, please <a href="{{route('contact-us')}}">contact us</a>.</small>
                                                             <br /><br />

                                                             <div class="row">
                                                                 <div class="col-md-6">
                                                                     <div class="form-group">
                                                                         <input class="form-control" type="file" required data-error="Please select file" name="file_1" >
                                                                         <div class="help-block with-errors"></div>
                                                                     </div>
                                                                 </div>
                                                                 <div class="col-md-6">
                                                                     <div class="form-group">
                                                                         <input class="form-control" type="file" name="file_2" >
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <br />
                                                             <div class="row">
                                                                 <div class="col-md-6">
                                                                     <div class="form-group">
                                                                         <input class="form-control" type="file" name="file_3" >
                                                                     </div>
                                                                 </div>
                                                                 <div class="col-md-6">
                                                                     <div class="form-group">
                                                                         <input class="form-control" type="file" name="file_4" >
                                                                     </div>
                                                                 </div>
                                                             </div>

                                                         </div>
                                                         <div class="col-md-12">
                                                             <br /><h6>Turn Around:</h6>
                                                             <ul class="icon-list bullet-bg bullet-soft-green">
                                                                 <li><span><i class="uil uil-check"></i></span><span>Designs under 6” (left chest/Hat) will be delivered next business day</span></li>
                                                                 <li><span><i class="uil uil-check"></i></span><span>Designs over 6” (Jacket backs/Full Front) will be delivered second business day.</span></li>
                                                                 <li><span><i class="uil uil-check"></i></span><span>Orders placed on Friday will be delivered Monday morning unless Saturday delivery is specifically requested in the General Comments and Additional Instructions field directly above.</span></li>
                                                                 <li><span><i class="uil uil-check"></i></span><span>ArtWork Production Department operates 24 hours Mon-Sat. Customer service hours are 9:00am – 6:00pm Eastern Time. Saturday phone support is available by appointment. We are closed on Sunday.</span></li>
                                                             </ul>
                                                         </div>

                                                         <div class="col-md-12">
                                                             <label class="text-leaf">Would you like a Virtual sample for an additional $4.99? <small><a data-toggle='fancybox-virtual-sample' href="javascript:void(0);">Click Here</a> to see a virtual sample</small></label>

                                                             <div class="form-group">
                                                                 <input class="form-check-input" type="radio" name="virtual_sample" value="1" id="virtual_sample_yes">
                                                                 <label class="form-check-label" for="virtual_sample_yes"> Yes </label>
                                                                 <input class="form-check-input" type="radio" checked name="virtual_sample" value="0" id="virtual_sample_no">
                                                                 <label class="form-check-label" for="virtual_sample_no"> No </label>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <br />
                                                     <div class="messages"></div>
                                                     <div class="row">
                                                         <div class="col-md-3">
                                                             <button class="btn btn-primary rounded-pill btn-digitizing-qoute w-100 mb-2">Place Qoute</button>
                                                         </div>
                                                     </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade @if(!$is_digitizing_tab) active show @endif" id="tab1-2">
                                                <div class="row">
                                                    <form method="POST" data-ajax="artwork-qoute" data-target-button=".btn-artwork-qoute" data-allow-success enctype="multipart/form-data" class="text-start mb-3">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-label-group form-group mb-4">
                                                                    <input type="text" class="form-control"  placeholder="Enter design name" name="design_name" required data-error="Please enter design name." />
                                                                    <label>Design Name *</label>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-label-group form-group mb-4">
                                                                    <input type="text" class="form-control" placeholder="Enter PO#" name="po" />
                                                                    <label>PO# (optional)</label>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-label-group form-group mb-4">
                                                                    <select class="form-control" required data-error="Please select required file format" name="required_file_format">
                                                                    <option value="">Select File Format</option>
                                                                        @foreach ($allow_exts as $allow_ext)
                                                                            <option value="{{$allow_ext}}">{{$allow_ext}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label>Required File Format *</label>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <label style="margin-top: 10px;">Design Size *</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-label-group form-group mb-4">
                                                                    <input type="text" class="form-control" required data-error="Enter width" placeholder="Enter width" name="ds_width" />
                                                                    <label>Width</label>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-label-group form-group mb-4">
                                                                    <input type="text" class="form-control" required data-error="Enter height" placeholder="Enter height" name="ds_height" />
                                                                    <label>Height</label>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-label-group form-group mb-4">
                                                                    <select class="form-control" name="ds_length">
                                                                        <option value="centimeters">Centimeters</option>
                                                                        <option value="millimeters">Millimeters</option>
                                                                        <option selected value="inches">Inches</option>
                                                                    </select>
                                                                    <label>Length</label>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2" style="margin-top: 10px;">
                                                                <input class="form-check-input" type="checkbox" value="1" name="not_sure" id="not-sure">
                                                                <label class="form-check-label" for="not-sure"> Not Sure</label>
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <label>What color type you would require?</label>

                                                                <div class="form-group">
                                                                    <input class="form-check-input" type="radio" name="color_type" required data-error="Select color type" value="0" id="color_type_pantone">
                                                                    <label class="form-check-label" for="color_type_pantone"> Pantone &nbsp; &nbsp;</label>
                                                                    <input class="form-check-input" type="radio" name="color_type" required data-error="Select color type" value="1" id="color_type_cmyk">
                                                                    <label class="form-check-label" for="color_type_cmyk"> CMYK  &nbsp; &nbsp;</label>
                                                                    <input class="form-check-input" type="radio" name="color_type" checked required data-error="Select color type" value="2" id="color_type_rgb">
                                                                    <label class="form-check-label" for="color_type_rgb"> RGB </label>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                                <div class="content_color_type_pantone hide">
                                                                    <br />
                                                                    <label>Do you require halftones?</label>

                                                                    <div class="form-group">
                                                                        <input class="form-check-input" type="radio" required name="require_halftones" data-error="Select require halftone" value="1" id="require_halftones_yes">
                                                                        <label class="form-check-label" for="require_halftones_yes"> Yes</label> &nbsp; &nbsp;
                                                                        <input class="form-check-input" type="radio" checked required name="require_halftones" data-error="Select require halftone" value="0" id="require_halftones_no">
                                                                        <label class="form-check-label" for="require_halftones_no"> No</label>
                                                                        <div class="help-block with-errors"></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label>What type of printing what use this Art for?</label>

                                                                <div class="row form-group">
                                                                    <div class="col-md-6">
                                                                        <input class="form-check-input" type="radio" data-error="Select art printing type" checked required  name="art_printing_type" value="0" id="art_printing_type_screenprinting">
                                                                        <label class="form-check-label" for="art_printing_type_screenprinting"> Screenprinting  &nbsp; &nbsp;</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input class="form-check-input" type="radio" data-error="Select art printing type" required name="art_printing_type" value="1" id="art_printing_type_digital_printing">
                                                                        <label class="form-check-label" for="art_printing_type_digital_printing"> Digital Printing &nbsp; &nbsp;</label><br />
                                                                    </div>
                                                                </div>
                                                                <div class="row form-group">
                                                                    <div class="col-md-6">
                                                                        <input class="form-check-input" type="radio" data-error="Select art printing type" required name="art_printing_type" value="2" id="art_printing_type_vinyl_cutting">
                                                                        <label class="form-check-label" for="art_printing_type_vinyl_cutting"> Vinyl Cutting  &nbsp; &nbsp;</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input class="form-check-input" type="radio" data-error="Select art printing type" required name="art_printing_type" value="3" id="art_printing_type_hard_goods">
                                                                        <label class="form-check-label" for="art_printing_type_hard_goods"> Hard Goods</label>
                                                                    </div>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Color Separation Required?</label>
                                                                <div class="form-group">
                                                                    <input class="form-check-input" type="radio" name="color_separation_required" value="1" id="color_separation_required_yes">
                                                                    <label class="form-check-label" for="color_separation_required_yes"> Yes</label> &nbsp; &nbsp;
                                                                    <input class="form-check-input" type="radio" checked name="color_separation_required" value="0" id="color_separation_required_no">
                                                                    <label class="form-check-label" for="color_separation_required_no"> No</label>
                                                                </div>

                                                                <label class="color_separation_required hide text-yellow">Note: $10.00 additional charge for Color Separations</label>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Difficulty Level</label>

                                                                <div class="row form-group">
                                                                    <div class="col-md-4">
                                                                        <input class="form-check-input" type="radio" required checked name="difficulty_level" data-error="select difficulty level" value="0" id="difficulty_level_smpl">
                                                                        <label class="form-check-label" for="difficulty_level_smpl"> Simple</label> &nbsp; &nbsp;
                                                                        <br /><small><a data-toggle='fancybox-difficulty-Level-simple' href="javascript:void(0);">View Simple</a></small>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input class="form-check-input" type="radio" required name="difficulty_level" data-error="select difficulty level" value="1" id="difficulty_level_cmpl">
                                                                        <label class="form-check-label" for="difficulty_level_cmpl"> Complex</label> &nbsp; &nbsp;
                                                                        <br /><small><a data-toggle='fancybox-difficulty-Level-complex' href="javascript:void(0);">View Complex</a></small>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input class="form-check-input" type="radio" required name="difficulty_level" data-error="select difficulty level" value="2" id="difficulty_level_ld">
                                                                        <label class="form-check-label" for="difficulty_level_ld"> Logo Design</label>
                                                                    </div>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <br />
                                                                <div class="form-label-group form-group">
                                                                    <textarea placeholder="Include General Comments and Additional Instructions if Necessary" name="comments" class="form-control" rows="5"></textarea>
                                                                    <label for="reg_comments">Include General Comments and Additional Instructions if Necessary:</label>
                                                                </div>

                                                                <small>Note: This field is meant to provide instructions. Please do not request quotes or “ask questions” in this filed. To receive a quote or ask questions prior to placing order please use a <a href="create-quote.php">Quote Form</a>.</small>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <br /><label>Click browse below to upload your file: Acceptable formats are: </label>
                                                                <br /><small class="text-blue">Allowed extensions *.gif, *.jpg, *.tif, *.pdf, *.bmp, *.eps, *.cdr, *.pcx, *.tiff, *.jpeg, *.cnd, *.ppt, *.fdr, *.bar, *.dst, *.emb, *.mls, *.isi, *.0oo, *.dsz, *.t09, *.fmc, *.dsb.,pxf, .pof.</small>
                                                                <br /><small class="text-yellow">The maximum file size is 20 MB (20480 KB). If your files are larger than this, please <a href="contact-us.php">contact us</a>.</small>
                                                                <br /><br />

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="file" required data-error="Please select file" name="file_1" >
                                                                            <div class="help-block with-errors"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="file" name="file_2" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br />
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="file" name="file_3" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <input class="form-control" type="file" name="file_4" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <br />
                                                                <label class="text-leaf">Would you like a Virtual sample for an additional $4.99? <small><a data-toggle='fancybox-virtual-sample' href="javascript:void(0);">Click Here</a> to see a virtual sample</small></label>
                                                                <div class="form-group">
                                                                    <input class="form-check-input" type="radio" required name="virtual_sample" value="1" id="virtual_sample_yes">
                                                                    <label class="form-check-label" for="virtual_sample_yes"> Yes </label>
                                                                    <input class="form-check-input" type="radio" required checked name="virtual_sample" value="0" id="virtual_sample_no">
                                                                    <label class="form-check-label" for="virtual_sample_no"> No </label>
                                                                    <div class="help-block with-errors"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="messages"></div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <button class="btn btn-primary rounded-pill btn-artwork-qoute w-100 mb-2">Place Quote</button>
                                                            </div>
                                                        </div>
                                                    </form>
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

    <a class="fancybox" style="display:none" rel="gallery" data-fancybox="gallery" href="Front/images/digitizing-order-sample.png" data-caption="Virtual Sample" ><img src="Front/images/digitizing-order-sample.png" class="img-responsive" alt="Virtual Sample"/></a>

	<a class="fancybox_simple" style="display:none" rel="gallery" data-fancybox="gallery" href="Front/images/vectorizing-simple.png" data-caption="Difficulty Level - Simple" ><img src="Front/images/vectorizing-simple.png" class="img-responsive" alt="Difficulty Level - Simple"/></a>

	<a class="fancybox_complex" style="display:none" rel="gallery" data-fancybox="gallery" href="Front/images/vectorizing-complex.png" data-caption="Difficulty Level - Complex" ><img src="Front/images/vectorizing-complex.png" class="img-responsive" alt="Difficulty Level - Complex"/></a>

    @include('front.layouts.footer')
	@include('front.layouts.scripts')

    <script src="{{asset('Front/assets/js/select2.min.js')}}"></script>
	<script src="{{asset('Front/assets/js/fancybox.js')}}"></script>
    <script src="{{asset('Front/assets/js/form-plugin.js')}}"></script>
    <script src="{{asset('Front/assets/js/validator.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function(){

            /*----------Vectorizing Order------------*/

            $("a[data-toggle='fancybox-virtual-sample']").on("click", function () {
                $(".fancybox").eq(0).trigger("click");
            });

            $("a[data-toggle='fancybox-difficulty-Level-simple']").on("click", function () {
                $(".fancybox_simple").eq(0).trigger("click");
            });

            $("a[data-toggle='fancybox-difficulty-Level-complex']").on("click", function () {
                $(".fancybox_complex").eq(0).trigger("click");
            });


            $("select[name='required_file_format']").select2({
                width: '100%',
                placeholder:'Select File Format'
            });

            $(".fancybox").fancybox({
                buttons: [
                    "slideShow",
                    "thumbs",
                    "zoom",
                    "fullScreen",
                    "share",
                    "close"
                ],
                loop: false,
                protect: true
            });

            $(".fancybox_simple").fancybox({
                buttons: [
                    "slideShow",
                    "thumbs",
                    "zoom",
                    "fullScreen",
                    "share",
                    "close"
                ],
                loop: false,
                protect: true
            });

            $(".fancybox_complex").fancybox({
                buttons: [
                    "slideShow",
                    "thumbs",
                    "zoom",
                    "fullScreen",
                    "share",
                    "close"
                ],
                loop: false,
                protect: true
            });


            $(document).on("change", "input[name='color_type']", function(){

                var value = $(this).val();

                if(value==0){
                    $("input[name='require_halftones']").closest(".content_color_type_pantone").removeClass("hide");
                    $("input[name='require_halftones']").attr("required", true);
                }else{
                    $("input[name='require_halftones']").closest(".content_color_type_pantone").addClass("hide");
                    $("input[name='require_halftones']").attr("required", false);
                }
            });

            $(document).on("change", "input[name='color_separation_required']", function(){

                var value = $(this).val();

                if(value==1){
                    $(".color_separation_required").removeClass("hide");
                }else{
                    $(".color_separation_required").addClass("hide");
                }
            });

            /*-----------End of Vectorizing order-----------*/

            /*----------Digitizing Order------------*/


            $("a[data-toggle='fancybox-virtual-sample']").on("click", function () {
				$(".fancybox").eq(0).trigger("click");
			});

			$(".fancybox").fancybox({
				buttons: [
					"slideShow",
					"thumbs",
					"zoom",
					"fullScreen",
					"share",
					"close"
				  ],
				  loop: false,
				  protect: true
			});

			$("select[name='required_file_format']").select2({
				width: '100%',
				placeholder:'Select File Format'
			});

			$(document).on("change", "select[name='fabric_name']", function(){

				var value = $(this).val();

				if(value=="Other"){

					$(".fab_selector").addClass("col-md-3");
					$(".fab_selector").removeClass("col-md-6");

					$("input[name='other_fabric_name']").parent().parent().removeClass("hide");
					$("input[name='other_fabric_name']").attr("required", true);
				}else{

					$(".fab_selector").removeClass("col-md-3");
					$(".fab_selector").addClass("col-md-6");

					$("input[name='other_fabric_name']").val("");
					$("input[name='other_fabric_name']").attr("required", false);
					$("input[name='other_fabric_name']").parent().parent().addClass("hide");
				}
			});

			$(document).on("change", "select[name='garment_placement']", function(){

				var value = $(this).val();

				if(value=="Jacket Back" || value=="Full Front"){
					$(".jacket_back_content").removeClass("hide");
				}else{
					$(".jacket_back_content").addClass("hide");
				}
			});

            /*----------Digitizing Order------------*/
        });
    </script>

	</body>
</html>
