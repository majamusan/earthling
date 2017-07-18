<?php

//-------------------------------------------------------------------------------------------------------------[start Ajax stuffs]
// all page navigator
Route::get('/{id}', function($id) { 
	$kw =array(
		'image-proccessing' => 'laravel,jquery',
		'plugins' => 'wordpress','drupal,magento,joomla',
		'mapping' => 'laravel,jquery',
		'contact' => 'contact',
		'home' => 'web development',
	);
	return (File::isFile('app/views/content/'.$id.'.blade.php') 
		? View::make('master')->with(array('view'=>View::make('content.'.$id),'id'=>str_replace('-',' ',$id),'kw'=>$kw[$id]))
		: Redirect::to('/')
	);
});
// todo with contacting 
Route::get('/ajax/connect/',array('before'=>'csrf', function() {
	$rules = array( 'name' => 'required|min:4', 'email' => 'required|min:8', 'message' => 'required|min:17',);
	$res = Validator::make(Input::all(),$rules);
	if($res->fails()){
		echo json_encode(array('pass'=>'false','msg'=>implode(' ',$res->messages()->all())));
	}else{
		$data = ['data'=>Input::get('message'),'email'=>Input::get('email'),'name'=>Input::get('name')];
		Mail::queue('emails.contact', $data, function($message) {
			$message->from(Input::get('email'), Input::get('name'));
			$message->to('jamie@earthling.za.org')->subject('contact');
		});
		echo json_encode(array('pass'=>'true','msg'=>'Contact successful! Thanks '.Input::get('name').', I will get back to you soon.'));
	}
}));
// todo with mapping page
Route::get('/ajax/getPlaces/', 'PlacesControler@getPlaces');
Route::get('/ajax/{id}', function($id) { if(File::isFile('app/views/content/'.$id.'.blade.php')) return View::make('content/'.$id); });
//todo with painting page
Route::get('/paint/make', 'PaintingControler@makePainting');
//-------------------------------------------------------------------------------------------------------------[end Ajax stuffs]


//-------------------------------------------------------------------------------------------------------------[file chaches]
Route::get('/image/{image}', 'CacheControler@getImage');
Route::get('/buttons/{image}', 'CacheControler@getButton');
Route::get('/icon/{image}', 'CacheControler@getIcon');
Route::get('/paintingIcon/{image}', 'CacheControler@getPaintingIcon');
Route::get('/gicons/{image}', 'CacheControler@getGicon');
Route::get('/scripts/{path}/{file}', 'CacheControler@getScript');
Route::get('/pakage/{path}/{p2}/{file}', 'CacheControler@getPkg');

//-------------------------------------------------------------------------------------------------------------[direct view outputs ]
// just for facebook api t&c
Route::get('/privacy', function() { return View::make('content.privacy'); });
// defaults
Route::get('/', function() { return View::make('master')->with(array('view'=>View::make('content.home'),'id'=>'')); });
App::missing(function($exception){ return View::make('master')->with(array('view'=>View::make('errors.missing'),'id'=>'',404)); });
