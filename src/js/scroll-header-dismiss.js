$(window).scroll(function(){
	var height = $(window).scrollTop();

	if(height > 0) {
		$(document.body).addClass('body--scrolled')
	}

	else {
		$(document.body).removeClass('body--scrolled')
	}
});