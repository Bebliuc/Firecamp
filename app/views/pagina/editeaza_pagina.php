<h1 class="section">Editeaza pagina <i><?php echo $nume_pagina; ?></i></h1>
<span href="#" id="button" class="seo ui">Seo</span> 
<span href="#" id="button" class="pagina ui">Optiuni pagina</span>
 <?php Observer::notify('adauga.pagina.tab', $id) ?>
<br /><br />
<form method="POST" action="<?php echo get_url('pagina/salveaza_pagina/'.$id); ?>" name="formular_pagina" class="uniForm">
    <fieldset class="inlineLabels">
        <div class="ctrlHolder">
            <label for="titlu">Titlu pagina</label>
            <input type="text" name="pagina[titlu]" size="45" class="textInput" value="<?php echo $nume_pagina; ?>" /><br />
        </div>
         <div class="ctrlHolder">
            <label for="continut">Continut pagina</label><br />
            <textarea name="pagina[continut]" id="textarea"><?php echo $continut_pagina; ?></textarea><br />
        </div>
        <div id="seo" style="height:140px; display: none;">
        <div class="ctrlHolder">
            <label for="meta_descriere">Descriere meta<span>(seo)</span></label>
            <input type="text" name="pagina[meta_descriere]" size="45"  value="<?php echo $descriere_meta; ?>" /><br />
        </div>
        <div class="ctrlHolder">
            <label for="meta_keywords">Cuvinte cheie<span>(seo)</span></label>
            <input type="text" name="pagina[meta_keywords]" size="45"  value="<?php echo $keyword_meta; ?>" /><br />
        </div>
        <div class="ctrlHolder">
            <label for="titlu">Titlu pagina<span>(seo)</span></label>
            <input type="text" name="pagina[titlu_seo]" size="45" value="<?php echo $titlu_seo; ?>" /><br />
        </div>
        <div class="ctrlHolder">
            <label for="url">URL pagina<span>(seo)</span></label>
            <input type="text" name="pagina[url]" size="45" value="<?php echo $url_pagina; ?>" /><br />
        </div>
      </div>

     <div id="pagina" style="height:38px; display: none;">
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
                        <option value="<?php echo $template->id; ?>" <?php if($template->id == $template_id) echo 'selected=""'; ?>><?php echo $template->nume; ?></option>
                    <?php } ?>
            </select>
          
         </div>
     </div>
     <?php Observer::notify('adauga.pagina.fieldset', $id, $galerie_id) ?>
        <br />
            <input type="submit" name="pagina[submit]" value="Salveaza pagina" class="ui" id="button" />
            <input type="submit" value="Salveaza pagina si continua" accesskey="e" name="continua" class="ui" id="button" />
    </fieldset>
</form>
<!--
<script type="text/javascript" src="<?php echo BASE_URL; ?>app/layouts/backend/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>app/layouts/backend/jscripts/tiny_mce/tiny_config.js"></script>
-->
<?php
Observer::notify('adauga.pagina', $id);