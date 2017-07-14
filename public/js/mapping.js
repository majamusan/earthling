var markers = [];
var directionsDisplay;
var map;
var curPos;
jQuery(document).ready(function($){ 
		$(".slider").slider();
		$("#radius").on("slide", function(slideEvt) { $("#radius-value").text(slideEvt.value); });
		$("#results").on("slide", function(slideEvt) { $("#results-value").text(slideEvt.value); });
		$('#content').on('click','#pop-opt',function(){$('.pop').hide(); $('#map-options').slideDown(); });
		$('#content').on('click','#pop-typ',function(){$('.pop').hide();$('#map-types').slideDown(); });
		$('#content').on('click','#map-rep',function(){
			$('#map-loading img').fadeIn();
			$('#map-loading-data').html(''); 
			$('.pop').hide();
			getPlaces();
		});
});
function initialize() {
	jQuery('#map-loading').fadeIn();
	jQuery('#loading-detail').html('creating map');
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
			jQuery('#map-loading-data').html('<i class="success">making map near you</i>');
      curPos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			makeMap('Your aproximate location'); 
    }, function() {
			jQuery('#map-loading-data').html('<i class="success">making random map</i>');
      curPos = new google.maps.LatLng(getRandomInt(1,100),getRandomInt(1,100));
			makeMap('A random center point'); 
    });
  } else {
			jQuery('#map-loading-data').html('<i class="success">making random map</i>');
      curPos = new google.maps.LatLng(getRandomInt(1,100),getRandomInt(1,100));
			makeMap('A random center point'); 
  }
	jQuery('#loading-box, #map-loading').fadeOut();
}

function makeMap(contentText){
	jQuery('#loading-detail').html('loading map');
	var map_options = { center: new google.maps.LatLng(curPos), zoom: 13, mapTypeId: google.maps.MapTypeId.SATELLITE }
	map = new google.maps.Map(document.getElementById('map-canvas'), map_options)
	map.setCenter(curPos);
	directionsDisplay = new google.maps.DirectionsRenderer();
	directionsDisplay.setMap(map);
	var infowindow = new google.maps.InfoWindow({ content:contentText});
	var marker = new google.maps.Marker({position:curPos,title:contentText,map:map,icon: "/gicons/you-are-here.png", });
	google.maps.event.addListener(marker, 'click', function() { infowindow.open(map,marker); });
	getPlaces();
}
/*-----------------------------call to get places data ------------------------------*/
function getPlaces(){
	jQuery('#map-loading-data').html('loading places');
	jQuery('#map-loading').fadeIn();
	var request = jQuery.ajax({url:"/ajax/getPlaces/",dataType:"html",type:"GET",
		data:{
			lat:curPos.lat(),lng:curPos.lng(),form:jQuery('#map-types input').serialize(),
			results:jQuery('#results-value').html(),radius:jQuery('#radius-value').html()
		}
	});
	request.done(function(msg){ addMarkers(msg); jQuery('#map-box').fadeIn();});
	request.fail(function()   {jQuery('#loading-detail').html('failed to load first places'); });
}
/*-----------------------------make the map marked------------------------------*/
function addMarkers(msg){
	for (var i = 0; i < markers.length; i++) { markers[i].setMap(null); }
	markers = [];
	var info = jQuery.parseJSON(msg);
	if(info['error']==1){ jQuery('#map-loading img').fadeOut(); jQuery('#map-loading-data').html(info['summary']); return;}
	jQuery('#map-loading-detail').html('loading new data...'); 
	jQuery(info['data']).each(function(index){
		var latlng = new google.maps.LatLng(info['data'][index]['lat'],info['data'][index]['lng']);
		var web = '';
		if (typeof info['data'][index]['website'] != 'undefined')
			web = '<a target="_blank" href="'+info['data'][index]['website']+'">'+info['data'][index]['website']+'</a>';
		var theContent = '<div class="map-popup">'+
											'<p>'+
											'<h3>'+info['data'][index]['name']+'</h3>'+
											'<i>'+info['data'][index]['type'].replace('_','&nbsp;')+' '+web+'</i><br />'+
											info['data'][index]['formatted_address']+' <br />'+
											//'<strong class="map-get hand" onclick="calcRoute(this);" data-gps="'+latlng+'">Show Route</strong>'+
										'</p>'+
										'</div>';
		var infowindow = new google.maps.InfoWindow({ content:theContent });
		var theIcon = '/gicons/'+info['data'][index]['type']+'.png'
		var marker = new google.maps.Marker( {
						position: latlng,
						title: info['data'][index]['name'],
						map: map ,
						icon: theIcon,//data[index]['icon'],
		});
		google.maps.event.addListener(marker, 'click', function() { infowindow.open(map,marker); });
		jQuery('#map-loading-detail').append('.'); 
		markers.push(marker);
	});
	jQuery('#map-loading-detail').html('loading data done'); 
	jQuery('#loading-box, #map-loading').fadeOut();
}
/* calculate the route */
// currently not working
function calcRoute(btn) {
	var directionsService = new google.maps.DirectionsService();
	jQuery('#map-loading').fadeIn();
	jQuery('#map-loading-detail').html('calculating driving route'); 
	var start = curPos;
	var end = jQuery(btn).data('gps');
	var request = { origin:start, destination:end, travelMode: google.maps.TravelMode.DRIVING };
	directionsService.route(request, function(result, status) {
		if (status == google.maps.DirectionsStatus.OK) { directionsDisplay.setDirections(result); }
	});
	jQuery('#map-loading-detail').html('done'); 
	jQuery('#map-loading').fadeOut();
}
/*load goolge maps for ajax */
function loadScript() {
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&callback=initialize&signed_in=true';
	document.body.appendChild(script);
}

function getRandomInt(min, max) { return Math.floor(Math.random() * (max - min + 1)) + min; }

window.onload = loadScript;
