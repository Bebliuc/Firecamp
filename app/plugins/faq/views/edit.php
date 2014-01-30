<div class="content-box-header">	
		<h3>Edit FAQ</h3>
		<ul class="content-box-tabs">
			<a href="#" class="right_button" id="edit_faq" title="Edit FAQ" style="margin-right:0px;">Update FAQ</a> 
		</ul>
		<div class="clear"></div>		
</div>
<div class="content-box-content">
	<form method="POST" action="<?php echo get_url('plugin/faq/update/'.$faq->id); ?>" id="edit_faq_form" name="edit_faq_form" name="post">
		<fieldset>
			<p>
				<label for="question">Question</label>
				<textarea name="question" rows="5"><?php echo $faq->question; ?></textarea>
			</p>
			<p>
				<label for="answer">Answer</label>
				<textarea name="answer" rows="5"><?php echo $faq->answer; ?></textarea>
			</p>
		</fieldset>
	</form>
</div>
<script type="text/javascript">
$("#edit_faq").click(function() { $("#edit_faq_form").submit();  });
</script>
<?php Observer::notify('faq.edit'); ?>
<?php Observer::notify('editors'); ?>