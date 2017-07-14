/* painter */
jQuery(document).ready(function($){ 
	$(".slider").slider();
	$("#red").on("slide", function(slideEvt) { $("#red-value").text(slideEvt.value); });
	$("#green").on("slide", function(slideEvt) { $("#green-value").text(slideEvt.value); });
	$("#blue").on("slide", function(slideEvt) { $("#blue-value").text(slideEvt.value); });

	$(".checkbox").on("click", function() {  
		$(this).toggleClass('active');
		if( $('#'+$(this).data('box')).prop('checked')){
			$('#'+$(this).data('box')).prop('checked', false);
		}else{
			$('#'+$(this).data('box')).prop('checked', true);
		}
	});
	$('.pictures input:radio').addClass('input_hidden');
	$('.pictures label').click(function(){ $(this).addClass('selected').siblings().removeClass('selected'); });

	$("#paint").on("click", function() {  
		$('#painting-loading').fadeIn();
		var colours  = {'red':$('#red-value').html(),'green':$('#green-value').html(),'blue':$('#blue-value').html() };
		var boxes  = {'grayed':$('#grayed').is(':checked'),'invert':$('#invert').is(':checked'),'flip':$('#flip').is(':checked') };
		var pictrue =  $(".pictures input:checked").attr('id');
		$.ajax({
			cache: true, url: '/paint/make', data:{boxes:boxes,colours:colours,pictrue:pictrue}
		}).done(function(msg) {
			alert(msg);
			$("#painting-img").attr("src",this.url).fadeIn();
			$('#painting-loading').fadeOut();
		}).fail(function(msg){
			$('#painting-loading').fadeOut();
		});
		return false;
	});

});
