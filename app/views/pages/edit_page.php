<?php $page = Record::findOneFrom('pages', 'id = '.$id); ?>
<form method="POST" action="<?php echo get_url('pages/update/'.$id); ?>" id="add_page" name="page">	
	<fieldset>
        <legend><?php echo __('Page details'); ?></legend>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="name"><?php echo __('Page title'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" id="name" value="<?php echo $page->name; ?>" title="<?php echo __('Page title. Only letters and numbers, no special characters allowed.'); ?>" name="name" size="45" />
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="content"><?php echo __('Page content'); ?></label>
    		</div>
    		
    		<div class="form-field">
	<div class="paper">
    		  <textarea name="content" style="width:98%; height:300px;"><?php echo $page->content; ?></textarea><br />
	</div>
			<div id="preview"></div>
            </div>
        </div>
	</fieldset>
<div id="dropables">
	<div id="dropable">
        <h2><?php echo __('Page SEO'); ?></h2>
		<div class="content">
        <div class="form-row ">
    		<div class="form-label">
    			<label for="title"><?php echo __('Meta title'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="title" value="<?php echo $page->title; ?>" size="45" />
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="slug"><?php echo __('Page url'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="slug" value="<?php echo $page->slug; ?>" id="slug" size="45" />
            </div>
        </div>
       
        <div class="form-row ">
    		<div class="form-label">
    			<label for="meta_keywords"><?php echo __('Meta keywords'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" value="<?php echo $page->meta_keywords; ?>" name="meta_keywords" size="45" />
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="meta_description"><?php echo __('Meta description'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text"  value="<?php echo $page->meta_description; ?>" name="meta_description" size="45" />
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="tags"><?php echo __('Page tags'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" value="<?php echo $page->tags; ?>" name="tags" size="45" />
            </div>
        </div>
		</div>
	</div>
    <div id="dropable">
        <h2><?php echo __('Page options'); ?></h2>
		<div class="content">
        <div class="form-row ">
    		<div class="form-label">
    			<label for="parent_id"><?php echo __('Page parent'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <select name="parent_id" class="medium-input">
				<option value="0"><?php echo __('Pagina principala'); ?></option>
				<?php Page::pagesToList($page->parent_id); ?>
			</select>
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="publish_time"><?php echo __('Publish date'); ?></label>
    		</div>
    		
    		<div class="form-field">
                <input type="text" size="7" name="publish_time"  value="<?php echo $page->publish_time; ?>" id="datepicker" />  
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="template"><?php echo __('Template'); ?></label>
    		</div>
    		
    		<div class="form-field">
                <select name="template" class="small-input">
				<option value="0"><?php echo __('Inherit'); ?></option>
				<?php Template::templatesToList($page->template); ?>
                </select>
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="behavior"><?php echo __('Behavior'); ?></label>
    		</div>
    		
    		<div class="form-field">
                <select name="behavior" class="small-input">
				<option value="page"><?php echo __('Static page'); ?></option>
					<?php foreach(Behavior::findAll() as $behavior => $title): ?>
						<option value="<?php echo $behavior; ?>" <?php if($page->behavior == $behavior) echo 'selected=""'; ?>><?php echo $title; ?></option>
					<?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="status"><?php echo __('Status'); ?></label>
    		</div>
    		
    		<div class="form-field">
                <select name="status" class="small-input">
                        <option value="0" <?php echo ($page->status == 0 ? "selected=\"\"" : ""); ?>>Draft</option>
						<option value="1" <?php echo ($page->status == 1 ? "selected=\"\"" : ""); ?>><?php echo __('Published'); ?></option>
						<option value="2" <?php echo ($page->status == 2 ? "selected=\"\"" : ""); ?>><?php echo __('Closed'); ?></option>
		      	</select>
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="login_required"><?php echo __('Requires login'); ?></label>
    		</div>
    		
    		<div class="form-field">
                    <input type="radio" name="login_required" value="0" <?php echo ($page->login_required == 0 ? 'checked=""' : ''); ?> /><?php echo __('Inherit'); ?>
					<input type="radio" name="login_required" value="1" <?php echo ($page->login_required == 1 ? 'checked=""' : ''); ?> /><?php echo __('Yes'); ?>
					<input type="radio" name="login_required" value="2" <?php echo ($page->login_required == 2 ? 'checked=""' : ''); ?> /><?php echo __('No'); ?>
            </div>
        </div>
        <div class="form-row ">
    		<div class="form-label">
    			<label for="root"><?php echo __('It\'s root page'); ?></label>
    		</div>
    		
    		<div class="form-field">
<input type="radio" name="root" value="1" <?php echo ($page->root == 1 ? 'checked=""' : ''); ?> /><?php echo __('Yes'); ?>
					<input type="radio" name="root" value="2" <?php echo ($page->root == 2 ? 'checked=""' : ''); ?> /><?php echo __('No'); ?>
            </div>
        </div>
		</div>
	</div>
	<?php Observer::notify('page.edit.dropable', $page); ?>
</div>
    <div class="form-buttons">
        <input type="submit" value="<?php echo __('Save changes'); ?>" name="submit" />
        <span class="button-alt">or <a href="<?php echo get_url('pages/index'); ?>"><?php echo __('Cancel and go to pages'); ?></a></span>
    </div>	
</form>
<script type="text/javascript">
jQuery("#name").keyup(function (e) {
	var name = jQuery("#name").val().replace(/ /g, '_').toLowerCase();
	jQuery("#slug").val(name);
	var title = jQuery("#name").val();
	jQuery("#title").val(title);
});
</script>
<?php Observer::notify('page.edit.end', $page); ?>