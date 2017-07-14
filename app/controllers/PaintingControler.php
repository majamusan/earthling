<?php 
class PaintingControler extends Controller {
	
	/**
	* handels the image effects page
	*
	* @input from POST
	* @return Image HTTP Responce object  || 404 view object
	*/
	public function makePainting(){
		$path = 'public/img/paintings/'.(is_null(Input::get('pictrue'))?5:Input::get('pictrue')).'.png';
		if (!File::exists($path)) return View::make('master')->with(array('view'=>View::make('errors.missing'),'id'=>'',404));;
		$img = Image::make($path)->widen(600);
		if('true' == Input::get('boxes.grayed')){ $img->greyscale(); }
		if('true' == Input::get('boxes.flip')){ $img->flip('h'); }
		if('true' == Input::get('boxes.invert')){ $img->invert(); }
		$img->colorize(Input::get('colours.red'),Input::get('colours.green'),Input::get('colours.blue'));
		return Response::make($img->encode('png', 90), 200, array('Content-Type' => 'image/png'));
	}
}
