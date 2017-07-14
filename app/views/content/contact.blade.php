<h1>Make Contact</h1>
{{Form::model('contact',array('id'=>'contact'))}}
	<div class="form-box"> {{Form::label('Name:')}} {{Form::text('name')}} </div>
	<div class="form-box"> {{Form::label('Email:')}} {{Form::text('email')}} </div>
	<div class="form-box"> {{Form::label('Message:')}} {{Form::textarea('message')}} </div>
	<footer class="text-left">
		<div id="contact-loading-box" class="hide-this">
			<strong id="contact-loading-info"></strong>
			<img id="loading-image" src="/image/loading.gif" alt="loading"/>
		</div>
		<strong id="error-box" class="errors"></strong>
		<h2 id="succes-box" class="succes"></h2>
	</footer>
	<div class="form-box text-right"> {{Form::button('Send',array('class'=>'contact','data-info'=>'Sending message','id'=>'contact'))}} </div>
{{Form::close()}}
<script src="/scripts/js/contact.js" defer></script>
