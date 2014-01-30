<?php
class RatingController extends Controller {
	
	function javascript() 
	{
		$url = BASE_URL.'plugin/rating/save_rate/';
		
		header('Content-type: application/javascript');
		echo <<<JAVASCRIPT
			$(function() {
				$("#rating.active ul li").hover(function() {
					var this_id = $(this).parent('ul').attr('id');
					var placeholder = $(this).parent('ul').parent('div').parent('div');
					$(this).prevAll().addClass('selected');
					$(this).addClass('selected');
					var selector = 'ul#' + this_id +' li';

					var rate_value = $(selector).index(this) + 1;
					$("#rate_value").text(rate_value);
					$(this).children('a').click(function(event) {
						event.preventDefault();
						$.ajax({
						   type: "POST",
						   url: "$url" + this_id + "/" + rate_value,
						   success: function(msg){
							placeholder.html(msg);
						   }
						 });
					});
				}, function() {
					$(this).removeClass('selected');
					$(this).prevAll().removeClass('selected');
				});
			});
JAVASCRIPT;
	}
	
	function save_rate( $id, $value ) 
	{
		#verify if ip already in use
		if(!record::countFrom(rating::TABLE_NAME, 'identifier = ? AND ip = ?', array($id, rating::getip()))) {
			if(record::insert(rating::TABLE_NAME, array('id' => NULL, 'value' => $value, 'identifier' => $id, 'ip' => rating::getip()))) {
				rating::rateMe( $id ); die;
			}
			rating::rateMe( $id ); die;
		}
		rating::rateMe( $id ); die;
		#if yes, disable rating
		
		#if no, register vote and return it's value, disabled
	}

}