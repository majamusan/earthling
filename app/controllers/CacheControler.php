<?php 
class CacheControler extends Controller {

	//-----------------------------------------------------------------------------------------------------[diffrent types of files to return]
	private function getAfile($path,$file){
		$this->valid($path); 
		Cache::put($path, $file, 300);
		if(Str::endsWith($file,'js')){
			$type = 'text/javascript';
		}elseif(Str::endsWith($file,'gif')){
			$type = 'image/gif';
		}elseif(Str::endsWith($file,'css')){
			$type = 'text/css';
		}
		return Response::make(File::get($path),200,array('Content-Type' => $type));
	}
	private function getAimage($path){
		if($responce = $this->valid($path)) return $responce;
		if(Input::get('size') == 's'){
			$img = Image::cache(function($image) use ($path) { $image->make($path)->heighten(30)->greyscale()->colorize(0,0,17); },10080);
		}else{
			$img = Image::cache(function($image) use ($path) { $image->make($path); },10080);
		}
		return Response::make($img, 200, array('Content-Type' => 'image/png'));
	}

	private function getAicon($path){
		$this->valid($path); 

		$img = Image::cache(function($image) use ($path) { $image->make($path)->heighten(48)->greyscale()->colorize(0,17,0); },10080);
		return Response::make($img, 200, array('Content-Type' => 'image/png'));
	}

	//-----------------------------------------------------------------------------------------------------[url into file paths]
	public function getImage($id) { return	$this->getAimage('public/img/'.$id); }
	public function getButton($id) { return	$this->getAimage('public/img/buttons/'.$id); }
	public function getGicon($id) { return	$this->getAimage('public/img/g_icons/'.$id); }
	public function getIcon($id) { return	$this->getAicon('public/img/icons/'.$id); }
	public function getPaintingIcon($id) {return	$this->getAicon('public/img/paintings/'.$id); }
	public function getPainting($id) {return	$this->getAimage('public/img/paintings/'.$id); }
	public function getPkg($path,$p2,$file) { return $this->getAfile('public/packages/'.$path.'/'.$p2.'/'.$file,$file); }
	public function getScript($path,$file) { return $this->getAfile('public/'.$path.'/'.$file,$file); }

	//-----------------------------------------------------------------------------------------------------[util functions]
	private function valid($path){ if (!File::exists($path)) return View::make('master')->with(array('view'=>View::make('errors.missing'),'id'=>'',404));; }
}
