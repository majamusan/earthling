jQuery('#contact').click(function(){
	jQuery('#succes-box, #error-box').slideUp();
	jQuery('#succes-box, #error-box').html('');
	jQuery('#contact-loading-box').slideDown();
	jQuery('#contact-loading-info').html(jQuery(this).data('info'));
	jQuery.ajax({
		url: '/ajax/contact', dataType:'json', data:jQuery('#contact').serialize(),
	}).done(function(msg) {
		jQuery('#succes-box, #error-box').slideDown();
		if(msg['pass']=='false'){
			jQuery('#error-box').html(msg['msg']);
		}else{
			jQuery('#succes-box').html(msg['msg']);
			jQuery('.form-box').slideUp();
		}
		jQuery('#contact-loading-box').slideUp();
	}).fail(function(){
		jQuery('#content').html('<strong class="erros">Something went wrong, please try again.</strong>');
		jQuery('#contact-loading-box').slideUp();
		jQuery('#content').slideDown();
	});
	return false;
});
