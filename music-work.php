<?php

// GET https://accounts.spotify.com/authorize/?client_id=2a17328686bc4c728b584e9f122add4b&response_type=code&redirect_uri=http%3A%2F%2Fgeo-servise.ru%2Fmusic.php&scope=user-read-private%20user-read-email&state=34fFs29kd09

// $client_id = "b80e4b96b48348e995c5e2e4f3b3b5a0";
// $client_secret = "5d921ba152df4512ab1e59db08e2677d";
// $redirect_uri = "http://geo-servise.ru/music.php";

$client_id = "2cd28d48b49c4a49a3cb11026681263a";
$client_secret = "2528e7ed08a34b82bfeb552a69461894";
$redirect_uri = "http://shebalov.ru/s/fernanda/music.php";

$query = "https://accounts.spotify.com/authorize/?client_id=".$client_id."&response_type=code&redirect_uri=".$redirect_uri."&state=34fFs29kd09";

// show_dialog=true

if( empty( $_GET['code'] ) ) header("Location: ".$query);
else $code = $_GET['code'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Meta -->
	<meta charset="utf-8" />
	<title>Профессиональные услуги по созданию сайтов. Алексей Шебалов</title>
</head>
<body>

<?php

if(!empty($code)){

	// get access token

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch, CURLOPT_POST,           1 );
	curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=authorization_code&code='.$code.'&redirect_uri='.$redirect_uri ); 
	curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 


	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
	// curl_setopt($ch, CURLOPT_POST,           1 );
	// curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
	// curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 

	$res = curl_exec($ch);
	$res = json_decode($res);  // обьект

	// echo "<pre>";
	// print_r($res);
	// echo "</pre>";

	// echo "<br><br>";

	// echo $access_token = $res->access_token;
	$access_token = $res->access_token;

	// echo "<br><br>";

	// echo base64_encode($access_token);
	// echo $access_token = "BQCkQxlSKqrGNFATXSnqKq0DKy8pFBIjoq3i5J6W6rUu0TsZ4butToSkrK8aLdTUUyfvBf06jfH9op1MqxZt-v5LhD4BZn3fwWFbxCR6f-nvVaTgRvTu9IiKEar5UoSuh_uq8vKG33JCwBvIC8gzqFDuW22cdyHTLsh7rdZGR9pCDJGT9O7mUnk";

	// get user_info

	$ch2 = curl_init();
	curl_setopt($ch2, CURLOPT_URL,            'https://api.spotify.com/v1/me' );
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch2, CURLOPT_HTTPHEADER,   array("Authorization: Bearer ".$access_token )); 
	$res2 = curl_exec($ch2);
	$res2 = json_decode($res2);  // обьект

	// echo "<pre>";
	// print_r($res2);
	// echo "</pre>";

	// echo $user_id = $res2->id;
	$user_id = $res2->id;

	// curl -X GET "https://api.spotify.com/v1/me" -H "Authorization: Bearer {your access token}"


	// get user playlists

	$ch3 = curl_init();
	curl_setopt($ch3, CURLOPT_URL,            'https://api.spotify.com/v1/users/'.$user_id.'/playlists' );
	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch3, CURLOPT_HTTPHEADER,   array("Authorization: Bearer ".$access_token )); 
	$res3 = curl_exec($ch3);
	$res3 = json_decode($res3);  // обьект

	// echo "<pre>";
	// print_r($res3);
	// echo "</pre>";

	// echo "<hr>";

	// echo $playlist_id = $res3->items[0]->id;
	// echo $link_tracks = $res3->items[0]->tracks->href;
	$playlist_id = $res3->items[0]->id;
	$link_tracks = $res3->items[0]->tracks->href;


	// get all tracks


	$ch4 = curl_init();
	curl_setopt($ch4, CURLOPT_URL,            $link_tracks );
	curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch4, CURLOPT_HTTPHEADER,   array("Authorization: Bearer ".$access_token )); 
	$res4 = curl_exec($ch4);
	$res4 = json_decode($res4);  // обьект

	// echo "<hr>";
	// echo "<pre>";
	// print_r($res4);
	// echo "</pre>";

	// echo "<hr>";

	foreach ($res4->items as $items) {

		// echo "<pre>";
		// print_r($items->track);
		// echo "</pre>";
		 echo "<br>";		
		 $img_track = $items->track->album->images[1]->url; // 1- 300x300 2- 640x640
		 echo "<img src='{$img_track}' alt='' />";
		 echo "<br>";		
		 echo "Album: ".$items->track->album->name;
		 echo "<br>";
		 echo "Artists: ".$items->track->artists[0]->name;
		 echo "<br>";
		 echo "Track: ".$items->track->name;
		 echo "<br>";
		 $demo_track = $items->track->preview_url;
		 // echo ' <video controls="" name="media"><source src="'.$demo_track.'" type="audio/mpeg"></video>';
		 echo ' <audio controls="" name="media"><source src="'.$demo_track.'" type="audio/mpeg"></audio>';
		
	}
}

?>

</body>
</html>