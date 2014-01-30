<script type="text/javascript">
$(document).ready(function() {
    $('#colorpickerHolder').ColorPicker({
		color: '#ffffff',
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
		Adauga imagine
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<form method="POST" action="<?php echo get_url('plugin/banner_rotator/_salveaza'); ?>" class="uniForm" enctype="multipart/form-data" >
    <fieldset class="inlineLabels">
        <p>
            <label for="descriereImagine">Descriere imagine</label>
            <input type="text" name="descriereImagine" class="text-input small-input" />
        </p>
		<p>
            <label for="textBlend">Text blend</label>
       
            <label class="blockLabel" for="da">
            <input id="da" type="radio" checked="checked" value="yes" name="textBlend"/>
            Activat
            </label>
            <label class="blockLabel" for="nu">
            <input id="nu" type="radio" value="no" name="textBlend"/>
            Dezactivat
            </label>
        </p>  
        <p>  
            <label for="incarcaImagine">Incarca imagine</label>
            <input id="incarcaImagine" class="fileUpload text-input small-input" type="file" size="30" name="fileUpload"/>
        </p>
 		<p>
            <label for="descriereImagine">Culoare text</label>
            <input id="colorpickerField1" type="hidden" value="ff0000" size="6" maxlength="6" name="textColor" />
            <p id="colorpickerHolder"></p>
        </p> 
       	<p>
            <input type="submit" value="Salveaza" class="button" name="salveazaImagine" />
       	</p>
        
    </fieldset>
</form>
</div>