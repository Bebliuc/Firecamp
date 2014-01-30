// ADD PRODUCT JAVASCRIPT CODE
var button = $("#product_image #upload_it"), interval;
new AjaxUpload(button, {
		action: '<?php echo get_url('plugin/products/ajax_upload'); ?>', 
		name: 'product_image',
		onSubmit : function(file, ext){
			// change button text, when user selects file			
			button.text('Uploading');
			
			// If you want to allow uploading only 1 file at time,
			// you can disable upload button
			this.disable();
			
			// Uploding -> Uploading. -> Uploading...
			interval = window.setInterval(function(){
				var text = button.text();
				if (text.length < 13){
					button.text(text + '.');					
				} else {
					button.text('Uploading');				
				}
			}, 200);
		},
		onComplete: function(file, response){
			var params = response.split('::');
			$("#product_image_value").val(params[0]);
			button.text('Upload');
			if(params[2] == 'success') {
				$("#product_image .upload_button").animate({ backgroundColor: '#459300'});
				$("#product_image #upload_it").css('color', '#FFF').css('opacity', 1);
			}
			else {
				$("#product_image .upload_button").animate({ backgroundColor: '#FF5555'});
			}
			window.clearInterval(interval);
						
			// enable upload button
			this.enable();
			var path_to_image = '<?php echo PUBLIC_URI.'/products/90x90/'; ?>' + params[0];
			// add file to the list
			$('#product_image img').attr('src', path_to_image);						
		}
});

var button_specifications = $("#upload_specifications_it"), interval;
new AjaxUpload(button_specifications , {
		action: '<?php echo get_url('plugin/products/ajax_upload_specifications'); ?>', 
		name: 'product_specifications',
		onSubmit : function(file, ext){
			// change button text, when user selects file			
			button_specifications.text('Uploading Specifications');
			
			// If you want to allow uploading only 1 file at time,
			// you can disable upload button
			this.disable();
			
			// Uploding -> Uploading. -> Uploading...
			interval = window.setInterval(function(){
				var text = button_specifications.text();
				if (text.length < 13){
					button_specifications.text(text + '.');					
				} else {
					button_specifications.text('Uploading');				
				}
			}, 200);
		},
		onComplete: function(file, response){
			var params = response.split('::');
			$("#product_support_file_value").val(params[0]);
			button_specifications.text('Upload fisier specificatii');
			if(params[2] == 'success') {
				$("#product_support").animate({ backgroundColor: '#459300'});
				$("#product_support a").css('color', '#FFF').css('text-shadow', '0 1px 0 rgba(0, 0, 0, 0.8)').css('opacity', 1);
			}
			else {
				$("#product_support").animate({ backgroundColor: '#FF5555'});
			}
			window.clearInterval(interval);
						
			// enable upload button
			this.enable();
		}
});


$(function () {
	$("#product_promotion a").click(function() {
		var parent = $(this).parent().parent();
		if(parent.attr('class') == 'off') {
			parent.attr('class','on');
			$("#product_promotion_value").val('1');
			$(this).text('Dezactivare promotie');
		}
		else {
			parent.attr('class','off');
			$("#product_promotion_value").val('0');
			$(this).text('Activare promotie');
		}
	});
	

	
	$("#adauga_produs").click(function() { $("#add_product_form").submit();  });
	CKEDITOR.replace('description',{height:150,resize_enabled:false,scayt_autoStartup:true,disableNativeSpellChecker:false,skin:'kama',uiColor:'#CFCFCF'});
	CKEDITOR.replace('specifications',{height:150,resize_enabled:false,scayt_autoStartup:true,disableNativeSpellChecker:false,skin:'kama',uiColor:'#CFCFCF'});
});