<script type="text/javascript">
$(document).ready(function() {
    $('#colorpickerHolder').ColorPicker({
		color: '<?php echo $color; ?>',
        flat: true,
        onSubmit: function(hsb, hex, rgb) {
            $('#colorpickerField1').val(hex);
        },
        onBeforeShow: function() {
            $(this).ColorPickerSetColor(this.value);
        }
    }).bind('keyup',
    function() {
        $(this).ColorPickerSetColor(this.value);
    });

});
</script>
<div class="content-box-header">
	<h3>
		Editeaza imagine
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<form method="POST" action="<?php echo get_url('plugin/banner_rotator/__salveaza/'.$id); ?>" enctype="multipart/form-data" >
    <fieldset>
     	<p>
            <label for="descriereImagine">Descriere imagine</label>
            <input type="text" name="descriereImagine" class="text-input small-input" value="<?php echo $descriere; ?>" />
        </p>
		<p>
            <label for="textBlend">Text blend</label>
            
            
            <input id="da" type="radio" checked="checked" value="yes" name="textBlend" <?php if($blend == "yes") echo 'checked=""'; ?> />
            Activat
      
            
            <input id="nu" type="radio" value="no" name="textBlend" <?php if($blend == "no") echo 'checked=""'; ?>/>
            Dezactivat
      
        </p>  
        <p>
            <label for="descriereImagine">Culoare text</label>
            <input id="colorpickerField1" type="hidden" value="<?php echo str_replace("#", "", $color); ?>" size="6" maxlength="6" name="textColor" />
            <p id="colorpickerHolder"></p>
         </p>  
        <p>
            <input type="submit" value="Salveaza" class="button" name="salveazaImagine" />
        </p>
    </fieldset>
</form>
</div>