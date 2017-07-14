<?php //5 handels this sort of thing much better
	require_once('app/controllers/PlacesControler.php');
	$mData = new mapData();
	$types = array_unique(array_merge($mData->types,$mData->selectedTypes));
?>

<link href='/pakage/slider/css/slider.css' rel="stylesheet" type="text/css" property='stylesheet'/>
<script src='/pakage/slider/js/bootstrap-slider.js' defer></script>
<script src='/scripts/js/mapping.js' defer></script>
<div id="map-box">
	<nav id="map-nav">
		<div id="map-options" class="pop"> 
			<div class="slider-container">
				<input id="radius" type="text" class="slider half" value="" 
					data-slider-min="200" data-slider-max="50000" data-slider-step="200" 
					data-slider-value="6800"
					data-slider-selection="none"
					data-slider-tooltip="hide"
				/>
				<label>Radius</label> ~ <span id="radius-value">6800</span>
			</div>
			<div class="slider-container">
				<input id="results" type="text" class="slider half" value="" 
					data-slider-min="2" data-slider-max="60" data-slider-step="1"
					data-slider-value="16"
					data-slider-selection="none"
					data-slider-tooltip="hide"
				/>
				<label>Results</label> ~ <span id="results-value">16</span>
			</div>
		</div>
		<div id="map-types" class="pop" >
			@foreach($types as $d=>$v)
				<div>
					@if(in_array($v,$mData->selectedTypes))
						{{Form::checkbox($v,'yes',true,array('id'=>$v))}}
					@else
						{{Form::checkbox($v,'yes',false,array('id'=>$v))}}
					@endif
					{{Form::label($v,ucwords(str_replace('_',' ',$v)))}}
				</div>
			@endforeach
		</div>
		<button id="pop-opt">Options</button>
		<button id="pop-typ">Types</button>
		<button id="map-rep">Refresh</button>
		<div id="map-loading"> <img alt="loading map" src="/image/loading-s.gif" /> <div id="map-loading-data"> </div> </div>
	</nav>
	<div id="map-canvas"> </div>
</div>
