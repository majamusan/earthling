jQuery(document).ready(function($){

	//the main navigation ajax's
	$('nav a').click(function(){
		$('#error-box').html('');
		$('#loading-box').slideDown();
		$('#loading-info').html('Loading '+$(this).attr('title'));
		$('#content').slideUp();
		$('nav a').removeClass('active');
		$(this).addClass('active');
		var title = $(this).attr('title')+' development for planet earth.';
		var href = $(this).attr('href');
		jQuery.ajax({
			url: '/ajax'+$(this).attr('href'), dataType:'html',
		}).done(function(msg) {
			$(document).prop('title', title);
			//window.location =href;
			var stateObj = { foo: title };
			history.pushState(stateObj, title, href);
			$('#content').html(msg);
			if(href== '/mapping/'){
				$('#loading-detail').html('Loading mapping script');
				$.ajax({
					url:"/js/mapping.js",
					dataType: "script",
					cache: true
				}).done(function(msg) {
					$('#loading-detail').html('done mapping script');
					//$('#loading-box').slideUp();
					$('#content,#contact-link').slideDown();
				}).fail(function(msg,nn) {
					$('#loading-detail').html('failed to load mapping script');
				});

var jqxhr = $.get( { url:"js/mapping.js",dataType:'script'})
.done(function() {
		foobar();
alert( "second success" );
})
.fail(function() {
alert( "error" );
})
.always(function() {
alert( "finished" );
});

}else{
				$('#content').html(msg);
				$('#loading-box').slideUp();
				$('#content,#contact-link').slideDown();
			}
		}).fail(function(){
			$('#content').html('<strong class="erros">Something went wrong, please try again.</strong>');
			$('#loading-box').slideUp();
			$('#content').slideDown();
		});
		return false;
	});

	//the contact button 
	$('.contact').click(function(){
		$('#succes-box, #error-box').html('');
		$('#loading-box').slideDown();
		$('#loading-info').html($(this).data('info'));
		jQuery.ajax({
			url: '/ajax/contact', dataType:'json', data:$('#contact').serialize(),
		}).done(function(msg) {
			if(msg['pass']=='false'){
				$('#error-box').html(msg['msg']);
			}else{
				$('#succes-box').html(msg['msg']);
			}
			$('#loading-box').slideUp();
		}).fail(function(){
			$('#content').html('<strong class="erros">Something went wrong, please try again.</strong>');
			$('#loading-box').slideUp();
			$('#content').slideDown();
		});
		return false;
	});

});
