jQuery.fn.center = function(init) {
		
	var object = this;
		
	if(!init) {
			
		object.css('margin-top', jQuery(window).height() / 2 - this.height() / 2 + 20);
		object.css('margin-left', jQuery(window).width() / 2 - this.width() / 2);
			
		jQuery(window).resize(function() {
			object.center(!init);
		});
		
	} else {
			
		var marginTop = jQuery(window).height() / 2 - this.height() / 2 + 20;
		var marginLeft = jQuery(window).width() / 2 - this.width() / 2;
			
		marginTop = (marginTop < 0) ? 0 : marginTop;
		marginLeft = (marginLeft < 0) ? 0 : marginLeft;

		object.stop();
		object.animate(
			{
				marginTop: marginTop, 
				marginLeft: marginLeft
			}, 
			150, 
			'linear'
		);
		
	}
}
