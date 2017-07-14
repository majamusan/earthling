<form id="painting-control" >
	<div class="slides">
		<input id="red" type="text" class="slider" 
			data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="18"
			data-slider-selection="none" data-slider-tooltip="hide"
		/>

		<input id="green" type="text" class="slider" 
			data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="38" 
			data-slider-width="100"
			data-slider-selection="none" data-slider-tooltip="hide"
		/>
		<input id="blue" type="text" class="slider" 
			data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="8" 
			data-slider-selection="none" data-slider-tooltip="hide"
		/>
	</div>
	<div style="width:2%">
		<strong id="red-value" >18</strong><br />
		<strong id="green-value" >30</strong><br />
		<strong id="blue-value" >8</strong><br />
	</div>

	<div class="pictures">
		{{Form::radio('pictrue','no',false,array('id'=>'1'))}} <label for="1"><img src="/paintingIcon/1.png" alt="Kiwi van" /></label>
		{{Form::radio('pictrue','no',false,array('id'=>'3'))}}<label for="3"><img src="/paintingIcon/3.png" alt="Shaolin Statue" /></label>
		{{Form::radio('pictrue','yes',false,array('id'=>'5'))}}<label class="selected" for="5"><img src="/paintingIcon/5.png" alt="Chinese Wall" /></label>
		{{Form::radio('pictrue','no',false,array('id'=>'4'))}}<label for="4"><img src="/paintingIcon/4.png" alt="A Boat" /></label>
		{{Form::radio('pictrue','no',false,array('id'=>'2'))}}<label for="2"><img src="/paintingIcon/2.png" alt="Bronze Statue" /></label>
		{{Form::radio('pictrue','no',false,array('id'=>'6'))}}<label for="6"><img src="/paintingIcon/6.png" alt="A Piper" /></label>
		{{Form::radio('pictrue','no',false,array('id'=>'7'))}}<label for="7"><img src="/paintingIcon/7.png" alt="Roof Struts" /></label>
		{{Form::radio('pictrue','no',false,array('id'=>'8'))}}<label for="8"><img src="/paintingIcon/8.png" alt="Door Knocker" /></label>
	</div>

	<div class="boxes">
		<div>
			{{Form::checkbox('grayed','yes',false,array('id'=>'grayed','class'=>'checkbox-custom'))}}
			<label for="grayed" class="checkbox-custom-label">Grayed</label>
		</div>
		<div>
			{{Form::checkbox('invert','yes',false,array('id'=>'invert','class'=>'checkbox-custom','checked'=>'checked'))}}
			<label for="invert" class="checkbox-custom-label">Inverted</label>
		</div>
	</div>

	<div class="buttons">
		<div id="painting-loading" class="hide text-center"><img alt="loading painting" src="/image/loading-s.gif"/><div id="painting-loading-data"> </div> </div>
		<button id="paint">Proccess</button>
	</div>

</form>
<div id="painting-box"> <img id="painting-img" src="/paint/make" alt="A painting" /> </div>

