$(function() {
	$("#rating ul li").hover(function() {
		var this_id = $(this).parent('ul').attr('id');
		$(this).prevAll().addClass('selected');
		$(this).addClass('selected');
		var selector = 'ul#' + this_id +' li';
	
		var rate_value = $(selector).index(this) + 1;
		$("#rate_value").text(rate_value);
		$(this).children('a').click(function(event) {
			event.preventDefault();
			$.ajax({
			   type: "POST",
			   url: "some.php",
			   data: "name=John&location=Boston",
			   success: function(msg){
			     alert( "Data Saved: " + msg );
			   }
			 });
		});
	}, function() {
		$(this).removeClass('selected');
		$(this).prevAll().removeClass('selected');
	});
});