<div class="iconBar">
	<strong>Technology used</strong><br />
	<img height="48" width="48" src="/icon/ajax.png" title="Development with ajax" alt="ajax"/>
	<img height="48" width="48" src="/icon/imagemagick.png" title="Development with Image Magick" alt="Image Magick"/>
	<img height="48" width="48" src="/icon/php.png" title="Development with PHP" alt="PHP"/>
</div>
<h1> Server side image proccessing. </h1>
<link href='/pakage/slider/css/slider.css' rel="stylesheet" type="text/css" property='stylesheet'/>
<script src='/pakage/slider/js/bootstrap-slider.js' defer></script>
<script src='/scripts/js/painter.js' defer></script>

{{View::make('apps.painting')}}

<h2>Whats going on here ?</h2>
<p>
	Once you pick the options you want and press proccess the info is sent via AJAX to the server where the controler takes this info and feeds it into the image proccessing software on the server that then returns the image to the http serving proccess and sends it back so you can view it.
</p>
