jQuery(document).ready(function($){
	$('header a, nav a, footer a').click(function(){
		$('#loading-detail').html('');
		$('#error-box').html('');
		$('#loading-box').slideDown();
		$('#loading-info').html($(this).attr('title'));
		$('#content').slideUp();
		$('nav a').removeClass('active');
		$(this).addClass('active');
		var title = $(this).attr('title')+' development for planet earth.';
		var href = $(this).attr('href');
		jQuery.ajax({
			url: '/ajax'+$(this).attr('href'), dataType:'html',
		}).done(function(msg) {
			$(document).prop('title', title);
			var stateObj = { foo: title };
			history.pushState(stateObj, title, href);
			$('#content').html(msg);
			$('#content').slideDown();
			if(href== '/mapping'){
				$('#loading-detail').html('Loading google maps');
				loadScript();
			}else{
				$('#content').html(msg);
				$('#loading-box').slideUp();
				$('#content').slideDown();
			}
		}).fail(function(){
			$('#content').html('<strong class="erros">Something went wrong, please reload.</strong>');
			$('#loading-box').slideUp();
			$('#content').slideDown();
		});
		return false;
	});
});
