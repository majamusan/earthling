<?php 
class PlacesControler extends Controller {
	public function getPlaces() {
		
		//-----------------------------------------------------------------------------------------------------------[setup variables]
		$summaryz = array();
		$summary = '';
		$info = new mapData();
		$types = array();
		parse_str(Input::get('form'), $types);
		$url = $info->radarUrlBase.Input::get('lat').','.Input::get('lng').'&radius='.Input::get('radius').'&types='.implode('|',array_keys($types)).'&sensor=false&key='.$info->key;

		//-----------------------------------------------------------------------------------------------------------[grab base data]
		$data = $info->curlit($url);
		if($data['status'] != 'OK') {
			$s = '<i class="error">'. ($data['status'] == 'ZERO_RESULTS'?'No places found, try incressing the radius.':$data['error_message']).'</i>';
			echo json_encode( array('data'=>$data,'summary'=>$s,'error'=>1));
			exit();
		}

		//-----------------------------------------------------------------------------------------------------------[create plaes array ]
		shuffle($data["results"]);
		for ($i = 0; $i <= Input::get('results'); $i++) {
			if(!isset($data["results"][$i]["geometry"]["location"]['lat']))continue;
			$return[$i]['lat'] =$data["results"][$i]["geometry"]["location"]['lat'] ;
			$return[$i]['lng'] =$data["results"][$i]["geometry"]["location"]['lng'] ;
			$url = $info->detialsUrlBase.$data["results"][$i]["reference"].'&sensor=true&key='.$info->key;

			$detail = $info->curlit($url);
			$return[$i]["name"] = $detail["result"]["name"];
			$return[$i]["icon"] = $detail["result"]["icon"];
			$return[$i]["formatted_address"] = str_replace(', ','<br />',$detail["result"]["formatted_address"]);
			$return[$i]["types"] = (is_array($detail["result"]["types"])?implode(' |',$detail["result"]["types"]):$detail["result"]["types"]);
			$return[$i]["type"] = $detail["result"]["types"][0];
			$return[$i]["url"] = $detail["result"]["url"];

			if(isset($detail["result"]["website"])) $return[$i]["website"] = $detail["result"]["website"];
			if(isset($detail["result"]["international_phone_number"]))
				$return[$i]["international_phone_number"] = $detail["result"]["international_phone_number"];

			if(isset($summaryz[$detail["result"]["types"][0]])){
				$summaryz[$detail["result"]["types"][0]]++;
			}else{
				$summaryz[$detail["result"]["types"][0]]=1;
			}
		}
		foreach($summaryz as $s => $v){
			//debug output
			//$summary .= '<div style="background-image:url(\''.get_template_directory_uri().'-child/img/g_icons/'.$v.'.png\')" class=""><sup>'.$s.'</sup>'.$v.'</div>';
			$summary .= $v.'->'.$s.' ';
		}

		//-----------------------------------------------------------------------------------------------------------[echo back info]
		//echo json_encode( array('data'=>$return,'summary'=>$summary,'error'=>0)); //debug output
		echo json_encode( array('data'=>$return,'error'=>0));
	}
}

/***
	object to fetche data and store config data 
*/
class mapData{

	/***
	* curling function
	*
	* @input url to curl
	* @return json array 
	*/
	public function curlit ($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		$results = curl_exec($ch);
		$headers = curl_getinfo($ch);
		$error_number = curl_errno($ch);
		$error_message = curl_error($ch);
		curl_close($ch);
		return json_decode($results,true);
	}

	//not an ideal way to store but easy
	public $key = 'AIzaSyAUd-Ha8Hq-o2HPhVy52hGlxOaX6g5FLs0';
	public $radarUrlBase = 'https://maps.googleapis.com/maps/api/place/radarsearch/json?location=';
	public $detialsUrlBase = 'https://maps.googleapis.com/maps/api/place/details/json?reference=';

	public $selectedTypes = array('aquarium',
		'art_gallery',
		'bar',
		'bicycle_store',
		'book_store',
		'bowling_alley',
		'bus_station',
		'cafe',
		'campground',
		'city_hall',
		'electronics_store',
		'embassy',
		'fire_station',
		'florist',
		'general_contractor',
		'grocery_or_supermarket',
		'gym',
		'hardware_store',
		'local_government_office',
		'movie_rental',
		'museum',
		'night_club',
		'park',
		'post_office',
		'spa',
		'university');
	public $types = array (
		'accounting',
		'airport',
		'amusement_park',
		'aquarium',
		'art_gallery',
		'atm',
		'bakery',
		'bank',
		'bar',
		'beauty_salon',
		'bicycle_store',
		'book_store',
		'bowling_alley',
		'bus_station',
		'cafe',
		'campground',
		'car_dealer',
		'car_rental',
		'car_repair',
		'car_wash',
		'casino',
		'cemetery',
		'church',
		'city_hall',
		'clothing_store',
		'convenience_store',
		'courthouse',
		'dentist',
		'department_store',
		'doctor',
		'electrician',
		'electronics_store',
		'embassy',
		'finance',
		'fire_station',
		'florist',
		'food',
		'funeral_home',
		'furniture_store',
		'gas_station',
		'general_contractor',
		'grocery_or_supermarket',
		'gym',
		'hair_care',
		'hardware_store',
		'health',
		'hindu_temple',
		'home_goods_store',
		'hospital',
		'insurance_agency',
		'jewelry_store',
		'laundry',
		'lodging',
		'lawyer',
		'library',
		'liquor_store',
		'local_government_office',
		'locksmith',
		'meal_delivery',
		'meal_takeaway',
		'mosque',
		'movie_rental',
		'movie_theater',
		'moving_company',
		'museum',
		'night_club',
		'painter',
		'park',
		'parking',
		'pet_store',
		'pharmacy',
		'physiotherapist',
		'place_of_worship',
		'plumber',
		'police',
		'post_office',
		'real_estate_agency',
		'restaurant',
		'roofing_contractor',
		'rv_park',
		'school',
		'shoe_store',
		'shopping_mall',
		'spa',
		'stadium',
		'storage',
		'store',
		'subway_station',
		'synagogue',
		'taxi_stand',
		'train_station',
		'travel_agency',
		'university',
		'veterinary_care',
		'zoo'
	);
	//'lodging',

}

