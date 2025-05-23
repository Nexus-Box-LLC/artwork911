$(document).ready(function(){

	$(document).on("click",".JModal",function(){

		var modalWidth=$(this).attr("data-width");
		
		console.log("is: "+ modalWidth);
		if(modalWidth==null){
			modalWidth="";
		}

		var jm_id=$(this).attr("data-id");

		var jm_url=$(this).attr("data-url");
		
		var loading = '<div id="preloader" style="position:initial !important;"><div id="status"><div class="spinner"></div></div></div>';

		var jm_append='<div class="modal fade show" style="overflow: auto;display: block;background: #0000009e;" id="'+ jm_id +'" tabindex="-1" role="dialog"> <div class="modal-dialog modal-lg '+modalWidth+'" role="document"> <div class="modal-content" style="background: #FFF;min-height: 200px;"> <div class="modal-body"> '+ loading +' </div> </div> </div> </div>';
		
		$("body").append(jm_append);

		setTimeout(function(){

			$.ajax({url: jm_url, success: function(result){
				
				$("#"+jm_id).find(".modal-content").html(result);

				$(".jmClose").on("click",function(){

						$("#"+jm_id).remove();

					});

			}, error: function() {

				 $('#'+jm_id).find(".modal-content").html("<div class='text-center'><span class='label label-danger'>Server Error. Please try again... "+jm_close+"</span></div>");

				 $(".jmClose").on("click",function(){

						$("#"+jm_id).remove();

					});

			}});

		

		},500);

		

	});
	

});
