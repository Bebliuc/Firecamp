<div class="content-box-header">			<h3>Feedback list</h3>		<div class="clear"></div>		</div><script type="text/javascript">$(document).ready(function () {	$('table#feedback tbody tr').quicksearch({		position: 'before',		attached: 'table#feedback',		stripeRowClass: ['odd', 'even'],		labelText: 'Quick search: ',		loaderImg: '<?php echo BASE_URL.'app/layouts/admin/resources/images/ajax-loader.gif'; ?>',		delay: 600	});});</script><div class="content-box-content">	<table id="feedback">		<thead>			<tr>				<th></th>				<th>Name</th>				<th>Status</th>				<th>Ratings</th>				<th>Edit</th>			</tr>		</thead>		<tbody>		<?php foreach($feedbacks as $feedback): ?>            <tr>            	<td></td>				<td id="left"><?php echo $feedback->name; ?></td>				<td id="left"><?php echo ($feedback->status == 1 ? '<span style="color:green;">approved</span>' : '<span style="color:red;">unapproved</span>'); ?></td>            	<td id="left"><u><small>Reservation: <b><?php echo $feedback->reservation; ?></b> Transfer: <b><?php echo $feedback->transfer; ?></b> Driver: <b><?php echo $feedback->driver; ?></b> Vehicle: <b><?php echo $feedback->vehicle; ?></b></u><br /><?php echo main::cutText($feedback->comment, '155'); ?></small></td>				<!-- <td id="left"></td>-->				<td id="left"><div style="position:relative;"> <a href="login" class="signin" id="edit<?php echo $feedback->id; ?>" title="<?php echo $feedback->id; ?>"><span>&nbsp;</span></a>  <div id="edit" class="edit<?php echo $feedback->id; ?>">   <a href="<?php echo get_url('plugin/feedback/'.($feedback->status == 0 ? 'approve/' : 'unapprove/').$feedback->id); ?>"><?php echo ($feedback->status == 0 ? '<span style="color:green;">Approve</span>' : '<span style="color:red;">Unapprove</span>'); ?></a>					<a href="#" class="sterge" title="<?php echo get_url('plugin/feedback/delete/'.$feedback->id); ?>">Delete</a>  </div>  </div></td>			</tr>		<?php endforeach; ?>		</tbody>	</table></div><script type="text/javascript">        $(document).ready(function() {            $(".signin").click(function(e) {      				var selection  = $(this).attr('title');				e.preventDefault();                $(".edit" + selection).toggle();				$("#edit" + selection).toggleClass("menu-open");            });						$("#edit").mouseup(function() {				return false			});				        });</script>