<?php $user = Auth::guard('user')->user()?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>ArtWork | artwork order</title>
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
                                        <h3 class="display-6 mb-3 text-white">New Vectorizing Order</h3>
                                    </div>
                                    <div class="col-md-7 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Place New Vectorizing Order</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card" style="overflow:hidden;padding:20px">
                                    <form method="POST" data-ajax="artwork-order" data-target-button=".btn-artwork-order" data-allow-success enctype="multipart/form-data" class="text-start mb-3">
                                        @csrf
                                        <input type = "hidden" name ="user_id" value = "{{$user->id}}">
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
                                                    <input class="form-check-input" data-price="{{$vprice[0]['color_seprater']}}" type="radio" name="color_separation_required" value="1" id="color_separation_required_yes">
                                                    <label class="form-check-label" for="color_separation_required_yes"> Yes</label> &nbsp; &nbsp;
                                                    <input class="form-check-input"data-price="0" type="radio" checked name="color_separation_required" value="0" id="color_separation_required_no">
                                                    <label class="form-check-label" for="color_separation_required_no"> No</label>
                                                </div>

                                                <label class="color_separation_required hide text-yellow" >Note: ${{number_format($vprice[0]['color_seprater'],2)}} additional charge for Color Separations</label>

                                            </div>
                                            <div class="col-md-6">
                                                <label>Difficulty Level</label>

                                                <div class="row form-group">
													<div class="col-md-4">
														<input class="form-check-input" type="radio" data-price="{{$vprice[0]['simple']}}" required checked name="difficulty_level" data-error="select difficulty level" value="0" id="difficulty_level_smpl">
														<label class="form-check-label" for="difficulty_level_smpl"> Simple</label> &nbsp; &nbsp;
														<br /><small><a data-toggle='fancybox-difficulty-Level-simple' href="javascript:void(0);">View Simple</a></small>
													</div>
													<div class="col-md-4">
														<input class="form-check-input" type="radio" data-price="{{$vprice[0]['complex']}}" required name="difficulty_level" data-error="select difficulty level" value="1" id="difficulty_level_cmpl">
														<label class="form-check-label" for="difficulty_level_cmpl"> Complex</label> &nbsp; &nbsp;
														<br /><small><a data-toggle='fancybox-difficulty-Level-complex' href="javascript:void(0);">View Complex</a></small>
													</div>
													<div class="col-md-4">
														<input class="form-check-input" type="radio" data-price="{{$vprice[0]['logo_design']}}" required name="difficulty_level" data-error="select difficulty level" value="2" id="difficulty_level_ld">
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Enter Promo Code" name="promo_code" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary promo_code_apply" type="button">Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
											</div>
											<div class="col-md-5">
												<table class="table table-striped">
													<tr>
														<th width="45%">Total Amount</th>
														<th width="5%" class="text-center">:</th>
														<td width="50%" class="text-right"><span class="total-price">0.00</span></td>
                                                    </tr>
													<tr>
														<th>DISCOUNT</th>
														<th class="text-center">:</th>
														<td class="text-right"><span class="discount">0.00</span></td>
                                                    </tr>
													<tr>
														<th>ORDER AMOUNT</th>
														<th class="text-center">:</th>
														<td class="text-right"><span class="final-price">0.00</span></td>
                                                    </tr>
												</table>
											</div>
                                        </div>

                                        <div class="messages"></div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button class="btn btn-primary rounded-pill btn-artwork-order w-100 mb-2">Place Order</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
					</div>
					<!-- /column -->
				</div>
			</div>
			<!-- /.container -->
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
    <script src="{{asset('Admi/assets/plugins/alertify/js/alertify.js')}}"></script>


	<script>

		$(document).ready(function(){

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });

            alertify.logPosition("botton right");

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

            var discount_percent = 0;
            calc_amounts();

            function calc_amounts(){

                var difficulty_level = $("input[name='difficulty_level']:checked").attr("data-price");
				difficulty_level = difficulty_level ? difficulty_level : 0;
                difficulty_level = parseFloat(difficulty_level);

                var color_separation_required = $("input[name='color_separation_required']:checked").attr("data-price");
				color_separation_required = color_separation_required ? color_separation_required : 0;
                color_separation_required = parseFloat(color_separation_required);

                var sub_total = difficulty_level + color_separation_required;
                var disc_amount = (sub_total*discount_percent)/100;
                var final_total = sub_total - disc_amount;

                $(".discount").html("$"+ disc_amount.toFixed(2));
                $(".total-price").html("$"+ sub_total.toFixed(2));
                $(".final-price").html("$"+ final_total.toFixed(2));

            }

			$(document).on("change", "input[name='color_separation_required']", function(){
                calc_amounts();
			});

			$("input[name='difficulty_level']").change(function(){
                calc_amounts();
            });

            function ajax_call(){

                var code = $("input[name='promo_code']").val();
                var formData = new FormData();

                formData.append("code", code);

                $.ajax({
                        type: "POST",
                        url: "{{route('apply-coupon-code')}}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data){

                            if(data.status=="RC200"){
                                alertify.success( data.message );

                                discount_percent = parseFloat(data.data.discount);
                                calc_amounts();

                                $(".promo_code_apply").addClass("btn btn-danger").text('Remove');
                            }else{
                                $("input[name='promo_code']").val('');
                                alertify.error( data.message );
                            }
                        }
                    });
            }

            $(document).on('click', '.promo_code_apply', function(){

                var promo_code = $("input[name='promo_code']").val();

                if(promo_code==""){
                    alertify.error("Please Enter Coupon Code...")
                    return;
                }

                var check = $(this).hasClass("btn-danger");

                if(check){

                    $(".promo_code_apply").removeClass("btn-danger").text('Apply');
                    $("input[name='promo_code']").val('');
                    discount_percent = 0;
                    calc_amounts();

                    alertify.success("Coupon code is removed...");
                }else{
                    ajax_call();
                }
            });
        });

        function ajax_success(target,response_json){
            if(target=="artwork-order"){
                setTimeout(function(){
                    window.location.href=window.location.href;
                }, 3000);
            }
        }
	</script>
    </body>
</html>
