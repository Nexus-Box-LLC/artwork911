<?php $user = Auth::guard('user')->user()?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>New Digitizing Order | ArtWork</title>

    @include('front.layouts.css')

	<link rel="stylesheet" href="{{asset('Front/assets/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('Front/assets/css/fancybox.css')}}">
</head>
<body>
	<div class="content-wrapper">
        @include('front.layouts.header')
		<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="Front/assets/img/photos/bg3.jpg">
			<div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center"></div>
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
                                        <h3 class="display-6 mb-3 text-white">New Digitizing Order</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Place New Digitizing Order</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card" style="overflow:hidden;padding:20px">
                                    <form method="POST" data-ajax="digitizing-order" data-target-button=".btn-digitizing-order" data-allow-success  enctype="multipart/form-data" class="text-start mb-3">
                                       @csrf
                                       <input type ="hidden" name ="user_id" value ="{{$user->id}}">
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
                                                    <select class="form-control garment" required data-error="Please select garment placement" name="garment_placement">
                                                        <option value="">Select Garment Placement</option>
                                                        @foreach ($dprice as $price)
                                                            <option value="{{$price->placement}}" data-price="{{$price->price}}" data-width="{{$price->max_width}}" data-height="{{$price->max_height}}" >{{$price->placement}}</option>
                                                        @endforeach
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
												<br />
                                            </div>
                                        </div>
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
														<td width="50%" class="text-right"><span class="total-price">$ 0.00</span></td>
													</tr>
													<tr>
														<th>DISCOUNT</th>
														<th class="text-center">:</th>
														<td class="text-right"><span class="discount">$ 0.00</span></td>
													</tr>
													<tr>
														<th>ORDER AMOUNT</th>
														<th class="text-center">:</th>
														<td class="text-right"><span class="final-price">$ 0.00</span></td>
													</tr>
												</table>
											</div>
                                        </div>
                                        <br />
                                        <div class="messages"></div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button class="btn btn-primary rounded-pill btn-digitizing-order w-100 mb-2">Place Order</button>
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
	<!-- /.content-wrapper -->

	<a class="fancybox" style="display:none" rel="gallery" data-fancybox="gallery" href="{{asset('Front/images/digitizing-order-sample.png')}}" data-caption="Virtual Sample" ><img src="Front/images/digitizing-order-sample.png" class="img-responsive" alt="Virtual Sample"/></a>

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

            var discount_percent = 0;

            function calc_amounts(){

                var garment_placement = $("select[name='garment_placement'] option:selected").attr('data-price');
				garment_placement = garment_placement ? garment_placement : 0;
                garment_placement = parseFloat(garment_placement);

                var sub_total = garment_placement;
                var disc_amount = (sub_total*discount_percent)/100;
                var final_total = sub_total - disc_amount;

                $(".discount").html("$"+ disc_amount.toFixed(2));
                $(".total-price").html("$"+ sub_total.toFixed(2));
                $(".final-price").html("$"+ final_total.toFixed(2));

            }

            $(document).on("change","select[name='garment_placement']",function(){
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

                        console.log(data);

                        if(data.status=="RC200"){
                            alertify.success( data.message );

                            discount_percent = parseFloat(data.data.discount);
                            calc_amounts();

                            $(".promo_code_apply").addClass("btn btn-danger").text('Remove');
                        }
                        else
                        {
                            $("input[name='promo_code']").val('');
                            type = "danger";
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
            if(target=="digitizing-order"){
                setTimeout(function(){
                    window.location.href=window.location.href;
                }, 3000);
            }
        }

    </script>

</body>
</html>
