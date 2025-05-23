(function ($) {
    "use strict";
    $(document).ready(function () {

		$("form[data-ajax]").each(function(){
			
			var allow_captcha = false;
			
			var this_obj = this;
			var this_var = $(this);
			var target_url = $(this).attr("data-ajax");
			var target_btn = $(this).attr("data-target-button");
			var allow_success = $(this).attr("data-allow-success");
			var allow_reset = $(this).attr("data-allow-reset");
			var allow_reset_on_success = $(this).attr("data-not-allow-reset-on-success");
			var captcha = $(this).attr("data-captcha");
			var allow_allow_reset_on_error = $(this).attr("data-allow-reset-on-error");
			var before_btn_text = $(target_btn).html();
			
			if(typeof allow_success !== typeof undefined && allow_success !== false){
				allow_success = true;
			}else{
				allow_success = false;
			}
			if(typeof allow_reset_on_success !== typeof undefined && allow_reset_on_success !== false){
				allow_reset_on_success = true;
			}else{
				allow_reset_on_success = false;
			}
			if(typeof allow_allow_reset_on_error !== typeof undefined && allow_allow_reset_on_error !== false){
				allow_allow_reset_on_error = true;
			}else{
				allow_allow_reset_on_error = false;
			}
			
			if(typeof captcha !== typeof undefined && captcha !== false){
				allow_captcha = true;
				
				if($("#script-gcaptcha").length==0){
					var script = document.createElement('script');
					script.setAttribute('src', 'https://www.google.com/recaptcha/api.js?render='+ captcha);
					script.setAttribute('id', 'script-gcaptcha');
					
					document.head.appendChild(script);
				}
			}
			
			// init variable
			this_var.validator();
			
			this_var.on('submit', function(e){
				if (!e.isDefaultPrevented()) {
					
					this_var.find(target_btn).prop("disabled", true);
					this_var.find(target_btn).html("loading...");
					
					if(allow_captcha){
                        var c_action = target_url.replace(/[^A-Za-z;]/g, "");
						grecaptcha.ready(function() {
							grecaptcha.execute(captcha, { action: c_action }).then(function (token) {
								var input_captcha = $(this_var).find("input[name='recaptcha']");
								
								if(input_captcha.length==0){
									this_var.append(
										$("<input>").attr("type","hidden").attr("name","recaptcha").val(token)
									);
								}else{
									input_captcha.val(token);
								}
								
								ajax_call(this_obj,this_var,target_url,target_btn,before_btn_text,allow_allow_reset_on_error,allow_success,allow_reset_on_success);
							});
						});
					}else{
						ajax_call(this_obj,this_var,target_url,target_btn,before_btn_text,allow_allow_reset_on_error,allow_success,allow_reset_on_success);
					}
					
				}
				
				return false;
			});
		});
		
		function ajax_call(this_obj,this_var,target_url,target_btn,before_btn_text,allow_allow_reset_on_error,allow_success,allow_reset_on_success){
			var formData = new FormData(this_obj);
			$.ajax({
				type: "POST",
				url: "/"+target_url,
				data: formData,
				cache: false,
				contentType: false,
				enctype: 'multipart/form-data',
				processData: false,
				success: function (data){
					var type = "";
					
					if(data.status=="RC200"){
						type = "success";
						
						if(typeof ajax_success == 'function'){
							ajax_success(target_url,data);
						}
						
                        if(!allow_reset_on_success){
                            this_var[0].reset();
                        }
						
					}else{
						type = "danger";
						
						if(typeof ajax_error == 'function'){
							ajax_error(data);
						}
						
						if(allow_allow_reset_on_error){
							this_var[0].reset();
						}
					}
					
					
					this_var.find(target_btn).html(before_btn_text);
					this_var.find(target_btn).prop("disabled", false);
					
					// we recieve the type of the message: success x danger and apply it to the 
					var messageAlert = 'alert-' + type;
					var messageText = data.message;

					// let's compose Bootstrap alert box HTML
					var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable">' + messageText + '</div>';
					
					// If we have messageAlert and messageText
					if (allow_success && messageAlert && messageText) {
						// inject the alert to .messages div in our form
						this_var.find('.messages').html(alertBox);
					}
				}
			});
		}
	});
}(jQuery));
