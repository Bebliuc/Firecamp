<form method="post" action="<?php echo get_url('plugin/gallery/create_photo').'/'.$album_id; ?>" name="photo">
	<fieldset>
        <legend>Add new photo to <?php echo gallery::getAlbumName($album_id); ?></legend>
		<div class="form-row">
    		<div class="form-label">
    			<label for="photo[title]">Photo title</label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="photo[title]" size="45" title="<?php echo __('Use only letters, numbers and spaces. No special characters allowed. <u>Mandatory field</u>'); ?>" />
            </div>
        </div>
		<div class="form-row">
    		<div class="form-label">
    			<label for="photo[caption]">Photo caption</label>
    		</div>
    		
    		<div class="form-field">
    		  <textarea name="photo[caption]" style="width:98%; height:300px;" title="<?php echo __('Short photo description. <u>Mandatory field</u>.'); ?>" /></textarea>
            </div>
        </div>
		<input name="photo[filename]" id="filename" type="hidden" />
		<div id="file-uploader-demo1" rel="tooltip" title="<?php echo __('Only .jpeg / .jpg allowed.'); ?>">		
			<noscript>			
				<p>Please enable JavaScript to use file uploader.</p>
				<!-- or put a simple form for upload here -->
			</noscript>         
		</div>
		<script>        
			function createUploader(){            
				var uploader = new qq.FileUploader({
					element: document.getElementById('file-uploader-demo1'),
					action: '<?php echo get_url('plugin/gallery/upload_photo/').gallery::getAlbumName($album_id); ?>',
					onComplete: function(id, fileName, responseJSON){
						
						if(responseJSON['success'] == true)
							jQuery('.qq-upload-file').parent('sup').removeClass('user-type-yellow').addClass('user-type-owner');
						else
							jQuery('.qq-upload-file').parent('sup').removeClass('user-type-yellow').addClass('user-type-admin');
							
						jQuery('#filename').val(fileName);
					}
				});           
			}
			
			// in your app create uploader as soon as the DOM is ready
			// don't wait for the window to load  
			window.onload = createUploader;     
		</script>    
    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="Save photo" name="submit">
	</div>
</form>