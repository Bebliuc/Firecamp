<div class="content-box-header">	
		<h3>Produs nou</h3>
		<ul class="content-box-tabs">
			<a href="#" class="right_button" id="adauga_produs" title="Adauga produs" style="margin-right:0px;">Adauga produs</a> 
		</ul>
		<div class="clear"></div>		
</div>
<div class="content-box-content">
	<div id="upload_debug"></div>
	<form method="POST" action="<?php echo get_url('plugin/products/save/new'); ?>" id="add_product_form" name="add_product_form" name="post">
		<div id="product_image">
			<img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/default.jpg" title="Product Image"/>
			<span class="upload_button"><a href="#" title="Upload new image" id="upload_it">Upload</a></span>
		</div>
        <div id="product_promotion_image" class="off">
			<span class="product_promotion_image_button"><a href="#" title="Upload new image" id="upload_prom">Imagine<br />Promotie</a></span>
		</div>
		<div id="product_promotion" class="off">
			<span class="promotion_button"><a href="#" title="Upload new image">Activare<br />Promotie</a></span>
		</div>
		<fieldset>
			<p>
				<label for="title">Titlu produs</label>
				<input type="text" name="title" id="name" class="text-input medium-input" />
			</p>
			<p>
				<select name="category" id="category" size="1" title="ajax" style="float:left">
					<option value="0">Categorie produs</option>
					<?php foreach(Products::findCategories() as $category):?>
						<option value="<?php echo $category->id; ?>">
							<?php echo $category->name; ?>
						</option>
					<?php endforeach; ?>
				</select>
				<select name="subcategory" id="subcategory" title="ajax" size="1">
					<option value="0">Subcategorie produs</option>
				</select>
			</p>
			<p>
                <label for="products_support_file_value">Support file</label>
                <input type="text" id="product_support_file_value" name="file" class="text-input medium-input" />
            </p>
           	<p>
                <label for="products_manual_file_value">Manual file</label>
                <input type="text" id="product_manual_file_value" name="manual" class="text-input medium-input" />
            </p>
			<p>
				<label for="description">Descriere produs</label>
				<textarea name="description" rows="5"></textarea>
			</p>
			<input type="hidden" id="product_image_value" name="image" />
            <input type="hidden" id="product_promotion_image_value" name="promotion_image" />
			<input type="hidden" id="product_promotion_value" name="promotion" value="0" />
		</fieldset>
	</form>
</div>
<script type="text/javascript" charset="utf-8">
	// ADD PRODUCT JAVASCRIPT CODE
   
	$(function() {
	    $("#product_promotion_image").hide();
		$("#category").change(function() {
			var selected = $("option:selected", this).val();
			var url = "<?php echo get_url('plugin/products/get_subcategories/'); ?>" + selected;
			$.ajax({
			   type: "POST",
			   url: url,
			   success: function(msg){
				 $("#subcategory").html(msg);
			   }
			 });
		});
	});
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
    
   	var button = $("#product_promotion_image #upload_prom"), interval;
	new AjaxUpload(button, {
			action: '<?php echo get_url('plugin/products/ajax_upload_promotion'); ?>', 
			name: 'product_promotion_image',
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
				$("#product_promotion_image_value").val(params[0]);
				button.text('Upload');
				if(params[2] == 'success') {
					$("#product_promotion_image").animate({ backgroundColor: '#459300'});
					$("#product_promotion_image #product_promotion_image_button").css('color', '#FFF').css('opacity', 1);
				}
				else {
					$("#product_promotion_image #product_promotion_image_button").animate({ backgroundColor: '#FF5555'});
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
                $("#product_promotion_image").show();
				$(this).text('Dezactivare promotie');
			}
			else {
				parent.attr('class','off');
				$("#product_promotion_value").val('0');
				$(this).text('Activare promotie');
                $("#product_promotion_image").hide();
			}
		});

		$("#adauga_produs").click(function() { $("#add_product_form").submit();  });



	 CKEDITOR.replace('description',{height:150,resize_enabled:false,scayt_autoStartup:true,disableNativeSpellChecker:false,skin:'kama',uiColor:'#CFCFCF'});
	CKEDITOR.replace('specifications',{height:150,resize_enabled:false,scayt_autoStartup:true,disableNativeSpellChecker:false,skin:'kama',uiColor:'#CFCFCF'});
	});
</script>