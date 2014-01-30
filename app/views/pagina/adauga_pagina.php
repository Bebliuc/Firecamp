<h1 class="section">Adauga pagina</h1>
 <span href="#" id="button" class="seo ui">Seo</span> 
 <span href="#" id="button" class="pagina ui">Optiuni pagina</span>
 <?php Observer::notify('adauga.pagina.tab') ?>
<br /><br />
<form method="POST" action="<?php echo get_url('pagina/salveaza_pagina'); ?>" name="formular_pagina" class="uniForm">
  <fieldset class="inlineLabels">
    
         <div class="ctrlHolder">
            <label for="titlu">Titlu pagina</label>
            <input type="text" name="pagina[titlu]" size="45" /><br />
        </div>
         <div class="ctrlHolder">
            <label for="continut">Continut pagina</label><br />
            <textarea name="pagina[continut]" id="textarea" rows="300" cols="40"></textarea><br />
        </div>
    <div id="pagina" style="height:75px; display: none;">
        <div class="ctrlHolder">
        	<label for="parent">Parent</label>
            <select name="pagina[parent]" class="selectInput">
            <option value="0">Pagina principala</option>
            <?php Pagina::dropdown(0,0); ?>
            </select><br />
         </div>
         <div class="ctrlHolder">
         	<label for="template">Sablon</label>
         	<select name="pagina[template]" class="selectInput">
         	<?php 
			$sql = "SELECT * FROM templates";
			
			global $__CONN__;
			$stmt = $__CONN__->prepare($sql);
			$stmt->execute();
			
			while($template = $stmt->fetchObject()) { 
			?>
            	<option value="<?php echo $template->id; ?>"><?php echo $template->nume; ?></option>
            <?php } ?>
            </select>
         </div>
   </div>
   <div id="seo" style="height:140px; display: none;">
       <div class="ctrlHolder">
            <label for="titlu">Titlu pagina<span>(seo)</span></label>
            <input type="text" name="pagina[titlu_seo]" size="45" /><br />
        </div>
        <div class="ctrlHolder">
            <label for="url">URL pagina<span>(seo)</span></label>
            <input type="text" name="pagina[url]" size="45" /><br />
        </div>
        <div class="ctrlHolder">
            <label for="meta_descriere">Descriere meta<span>(seo)</span></label>
            <input type="text" name="pagina[meta_descriere]" size="45" /><br />
        </div>
        <div class="ctrlHolder">
            <label for="meta_keywords">Cuvinte cheie<span>(seo)</span></label>
            <input type="text" name="pagina[meta_keywords]" size="45" /><br />
        
		</div>
    </div>
   	<?php Observer::notify('adauga.pagina.fieldset') ?>
         <br />
            <input type="submit" name="pagina[submit]" value="Salveaza pagina" class="ui" id="button" />
    </fieldset>
</form>
<?php
Observer::notify('adauga.pagina');