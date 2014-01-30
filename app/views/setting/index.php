<form method="post" action="<?php echo get_url('setting/save'); ?>" name="page">
	<fieldset>
        <legend><?php echo __('General settings'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="sitename"><?php echo __('Website title'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" value="<?php echo Setting::get('sitename'); ?>" title="<?php echo __('Website title.'); ?>"  name="sitename" size="45" />
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo __('Default SEO values'); ?></legend>
       	<div class="form-row ">
    		<div class="form-label">
    			<label for="sitenameseo"><?php echo __('Website title'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" value="<?php echo Setting::get('sitenameseo'); ?>" title="<?php echo __('Default SEO website title.'); ?>"  name="sitenameseo" size="45" />
            </div>
         </div>
         
         <div class="form-row ">
        	<div class="form-label">
    			<label for="keywordsseo"><?php echo __('Website keywords'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" value="<?php echo Setting::get('keywordsseo'); ?>" title="<?php echo __('Default SEO website meta keywords.'); ?>"  name="keywordsseo" size="45" />
            </div>
         </div>
                              
         <div class="form-row ">
        	<div class="form-label">
    			<label for="descriptionseo"><?php echo __('Website description'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" value="<?php echo Setting::get('descriptionseo'); ?>" title="<?php echo __('Default SEO website meta description.'); ?>"  name="descriptionseo" size="45" />
            </div>
         </div>
        
    </fieldset>

	<fieldset>
        <legend><?php echo __('Theme settings'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="theme_base_url"><?php echo __('Theme base url'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" value="<?php echo Setting::get('theme_base_url'); ?>" title="<?php echo __('Theme directory name in <em>public</em> folder.'); ?>" name="theme_base_url" size="11" />
            </div>
        </div>
		<?php Observer::notify('setting.page.theme'); ?>
    </fieldset>    

    <!-- Observer event setting.page.index -->
    <?php Observer::notify('setting.page.index'); ?>
    
    <div class="form-buttons">
        <input type="submit" value="<?php echo __('Save changes'); ?>" name="submit" />
        <span class="button-alt"><?php echo __('or'); ?> <a href="<?php echo get_url('admin/index'); ?>"><?php echo __('Cancel and go to dashboard'); ?></a></span>
    </div>
</form>