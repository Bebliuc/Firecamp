<div class="content-box-header">	
		<h3>New FAQ</h3>
		<ul class="content-box-tabs">
			<a href="#" class="right_button" id="create_faq" title="Create FAQ" style="margin-right:0px;">Create FAQ</a> 
		</ul>
		<div class="clear"></div>		
</div>
<div class="content-box-content">
	<form method="POST" action="<?php echo get_url('plugin/faq/save'); ?>" id="add_faq_form" name="add_faq_form" name="post">
		<fieldset>
			<p>
				<label for="question">Question</label>
				<textarea name="question" rows="5"></textarea>
			</p>
			<p>
				<label for="answer">Answer</label>
				<textarea name="answer" rows="5"></textarea>
			</p>
		</fieldset>
	</form>
</div>
<script type="text/javascript">
$("#create_faq").click(function() { $("#add_faq_form").submit();  });
</script>
<?php Observer::notify('faq.create'); ?>
<?php Observer::notify('editors'); ?>