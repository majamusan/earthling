<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
		@if(empty($id))
			<title>Web developments for earth.</title>
			<meta name='keywords' content='web developments,php, laravel'>
			<meta name='description' content='Web developemnts for earth.'>
		@else
			<title>{{$id}} development for planet earth</title>
			<meta name='keywords' content='web development,php,{{$kw}}'>
			<meta name='description' content='{{$id}} developemnts on earthling developments.'>
		@endif
		<meta name="viewport" content="width=device-width, initial-scale=2.0">
		<link href="/scripts/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/packages/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<script src="/scripts/packages/jquery-2.1.1.min.js" defer></script>
		<script src="/scripts/js/script.js" defer></script>
	</head>
	<body>
		<div id="wrapper">
			<header>
				<a href="/" id="icon"><img alt="earthling developments" src="/image/icon.png"/></a>
				<div id="menu-box">
					<h1 > <a href="/">Earthling Developments</a></h1>
					<strong><a href="/">Programming the modern inter-web of planet earth.</a></strong>
				</div>
				<nav id="menu">
					<a href="/image-proccessing" title="Image Proccessing">Image Proccessing</a>
					<a href="/mapping" title="Google Maps">Google Maps</a>
				</nav>
			</header>
			<div id="content">{{$view}}</div>
			<div id="loading-box">
				<img id="loading-image" src="/image/loading-l.gif" alt="loading" />
				<br />
				<strong id="loading-info"></strong>
				<small id="loading-detail"></small>
			</div>
			<footer>
				<div class="g-plusone" data-size="medium" data-href="http://earthling.za.org/"></div>
				<a id="contact-link" @if($id == 'contact')class="hide-this"@endif href="/contact/">Contact</a>
			</footer>
		</div>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-121256-3', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>
