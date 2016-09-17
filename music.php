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

if( empty( $_GET['code'] ) )
 { 
 	// header("Location: ".$query);
 }
else $code = $_GET['code'];

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

	// foreach ($res4->items as $items) {

	// 	// echo "<pre>";
	// 	// print_r($items->track);
	// 	// echo "</pre>";

	// 	 echo "<br>";		
	// 	 $img_track = $items->track->album->images[1]->url; // 1- 300x300 2- 640x640
	// 	 echo "<img src='{$img_track}' alt='' />";
	// 	 echo "<br>";		
	// 	 echo "Album: ".$items->track->album->name;
	// 	 echo "<br>";
	// 	 echo "Artists: ".$items->track->artists[0]->name;
	// 	 echo "<br>";
	// 	 echo "Track: ".$items->track->name;
	// 	 echo "<br>";
	// 	 $demo_track = $items->track->preview_url;
	// 	 echo ' <audio controls="" name="media"><source src="'.$demo_track.'" type="audio/mpeg"></audio>';
		
	// }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Meta -->
	<meta charset="utf-8" />
	<title>Профессиональные услуги по созданию сайтов. Алексей Шебалов</title>
	<meta name="description" content="Профессиональные услуги по созданию сайтов" />
    <meta name="keywords" content="создание сайтов, веб-разработчик, разработка сайтов, заказать сайт, landing page" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css" />
	<!-- <link rel="stylesheet" href="libs/magnific-popup/magnific-popup.css" /> -->
	<!-- <link rel="stylesheet" href="libs/animate/animate.min.css" /> -->
	<!-- <link rel="stylesheet" href="libs/owl-carousel/owl.carousel.css"> -->
	<!-- Theme CSS -->
	<!-- <link rel="stylesheet" href="css/main.css" /> -->
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/media.css" />
</head>
<body>

<div class="alex-wrap">

<div class="block-media">
	
	<img class="big-btn-bar hidden-md hidden-xs hidden-sm"  src="img/black-menu-btn.png" alt="">
	
	<nav class="top-menu hidden-xs hidden-sm hidden-md">
		<img class="close-top-menu" src="img/close.jpg" alt="">
		<ul class="list-inline">
			<li> 
				 <span class="vert-line"></span>
				 <a href="index.html">home </a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 					
				<a href="bio.html">bio</a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 
				<a href="media.html">media</a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 
				<a href="gallery.html">gallery</a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 
				<a href="">blog</a>
				 <span class="vert-line"></span>						 
			</li>
			<li>
				 <span class="vert-line"></span>						 
				<a href="">contact</a>
				 <span class="vert-line"></span>						 
			</li>
		</ul>			                         
	</nav>


	<nav class="mob-menu hidden-lg ">
		<img class="close-mob-menu" src="img/close.jpg" alt="">
		<ul class="list-unstyled">
			<li> 
				 <a href="index.html">home </a>
			</li>
			<li>
				<a href="bio.html">bio</a>
			</li>
			<li>
				<a href="media.html">media</a>
			</li>
			<li>
				<a href="gallery.html">gallery</a>
			</li>
			<li>
				<a href="">blog</a>
			</li>
			<li>
				<a href="">contact</a>
			</li>
		</ul>			                         
	</nav>

	<div class="container">
		
		<img class="btn-bar-top hidden-lg" src="img/black-top-btn.png" alt="">
		<h3 class="main-name">Fernanda romero</h3>

		<div class="media-category">
			<div class="col-md-4 col-sm-4 col-xs-12 "><h2><a  href="media.html">Movies</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12 cat-active"><h2><a href="music.php">Music</a></h2><p>xxxxxx</p></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><h2><a href="video.html">Video</a></h2><p>xxxxxx</p></div>
		</div>
		
		<div class="movies-catalog">

 				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	 				 <div id="jpa-img-click" class="wrap-audio-img" >			 	  	
	 				 	  <img class="img-responsive" src="https://i.scdn.co/image/78abdfb2caf600a98277c583671935e30295ec07" alt="">
	 				 	  <div class="play-music-img"></div>
	 				 </div>
 				 	  <h3>Color Fades</h3>
 				 	  <p>buy</p>
 				 </div>
 				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	 				 <div id="jpa-img-click" class="wrap-audio-img">			 	  	
 				 	  <img class="img-responsive" src="https://i.scdn.co/image/78abdfb2caf600a98277c583671935e30295ec07" alt="">
	 				 	  <div class="play-music-img"></div>
	 				 </div>
 				 	  <h3>Out of Control</h3>
 				 	  <p>buy</p>
 				 </div>
 				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	 				 <div class="wrap-audio-img">			 	  	
 				 	  <img class="img-responsive" src="https://i.scdn.co/image/78abdfb2caf600a98277c583671935e30295ec07" alt="">
	 				 	  <div class="play-music-img"></div>
	 				 </div>
 				 	  <h3>sos</h3>
 				 	  <p>buy</p>
 				 </div>
 				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	 				 <div class="wrap-audio-img">			 	  	
 				 	  <img class="img-responsive" src="https://i.scdn.co/image/78abdfb2caf600a98277c583671935e30295ec07" alt="">
	 				 	  <div class="play-music-img"></div>
	 				 </div>
 				 	  <h3>Shine On</h3>
 				 	  <p>buy</p>
 				 </div>
 				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	 				 <div class="wrap-audio-img">			 	  	
 				 	  <img class="img-responsive" src="https://i.scdn.co/image/78abdfb2caf600a98277c583671935e30295ec07" alt="">
	 				 	  <div class="play-music-img"></div>
	 				 </div>
 				 	  <h3>Out of Control - Alt Mix</h3>
 				 	  <p>buy</p>
 				 </div>
 				 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
	 				 <div class="wrap-audio-img">			 	  	
 				 	  <img class="img-responsive" src="https://i.scdn.co/image/96123689da23e3e9b3bc764dd428507cfb22b2c0" alt="">
	 				 	  <div class="play-music-img"></div>
	 				 </div>
 				 	  <h3>air</h3>
 				 	  <p>buy</p>
 				 </div>

 				<?php if($res4->items):?>			
				 <?php foreach ($res4->items as $items):?>
					<?php
						$img_track = $items->track->album->images[1]->url; // 1- 300x300 2- 640x640
						$track = $items->track->name;
						$album = $items->track->album->name; 
						$artist = $items->track->artists[0]->name;
						$demo_track = $items->track->preview_url;
					?>
					 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<img class="img-responsive" src="<?php echo $img_track;?>" alt="">
	 				 	  <h3><a href="movie-single.html"><?php echo $track;?></a></h3>
	 				 	  <p>buy</p>
						<audio controls="" name="media"><source src="<?php echo $demo_track;?>" type="audio/mpeg"></audio>';
					 </div>
					
				 <?php endforeach; ?>
				<?php endif; ?>
		</div>

		<a class="loading-link" href="#">Loading ...</a>

	</div>
</div>
<!-- 
<audio controls>
  <source src="horse.ogg" type="audio/ogg">
  <source src="horse.mp3" type="audio/mpeg">
  <source src="https://play.spotify.com/track/0lYBSQXN6rCTvUZvg9S0lU" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
 -->
<!-- 
 <video controls="" name="media"><source src="https://p.scdn.co/mp3-preview/7fcbe6d694093bee5b84c5bba802312c12b51290" type="audio/mpeg"></video>
 -->
<!--  
 <footer>
	<div class="container">
		<div class="col-md-12">
			
			<div class="soc-network">
			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
			</div>

			<ul class="foot-menu list-inline">
				<li> 
					 <a href="index.html">home </a>
				</li>
				<li>
					<a href="bio.html">bio</a>
				</li>
				<li>
					<a href="media.html">media</a>
				</li>
				<li>
					<a href="gallery.html">gallery</a>
				</li>
				<li>
					<a href="">blog</a>
				</li>
				<li>
					<a href="">contact</a>
				</li>
			</ul>	

		</div>
	</div>
</footer>
 -->
 </div>


<div class="clearfix"></div>
<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
	<div class="jp-type-playlist">
		<div class="jp-gui jp-interface">
			<div class="jp-controls-holder">

				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>

				<div class="jp-controls">
					<button class="jp-previous" role="button" tabindex="0">previous</button>
					<button class="jp-play" role="button" tabindex="0">play</button>
					<button class="jp-stop" role="button" tabindex="0">stop</button>
					<button class="jp-next" role="button" tabindex="0">next</button>
				</div>

				<div class="jp-volume-controls">
					<button class="jp-mute" role="button" tabindex="0">mute</button>
					<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
				</div>

				<div class="jp-playlist">
				<ul>
				<li>&nbsp;</li>
				</ul>
				</div>

				<div class="jpa-time-toogles">

					<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
					<div class="jpa-slash"> &nbsp;/&nbsp;</div>
					<div class="jp-duration" role="timer" aria-label="duration">&nbsp;<p>d</p> /ddd</div>

					<div class="jp-toggles">
						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
						<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
					</div>

				</div>

			</div>

		</div>

		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>


 <!-- <script src="libs/jquery/jquery1.11.0.min.js"></script> -->
<script type='text/javascript' src="libs/jquery/jquery_1.8.3.min.js"></script>
<script src="libs/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="libs/jplayer/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="libs/jplayer/add-on/jplayer.playlist.min.js"></script>
<script src="js/common.js"></script>	

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){


	new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_1",
		cssSelectorAncestor: "#jp_container_1"
	}, [
		{
			title:"Color Fades / Color Fades",
			// mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",
			// oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg"
			mp3:"https://p.scdn.co/mp3-preview/7fcbe6d694093bee5b84c5bba802312c12b51290",
			oga:"https://p.scdn.co/mp3-preview/7fcbe6d694093bee5b84c5bba802312c12b51290"
		},
		{
			title:"Out of Control / Color Fades",
			mp3:"https://p.scdn.co/mp3-preview/68be55db4c5d4222992a69750072a292e6641109",
			oga:"https://p.scdn.co/mp3-preview/68be55db4c5d4222992a69750072a292e6641109"
			// mp3:"http://www.jplayer.org/audio/mp3/TSP-05-Your_face.mp3",
			// oga:"http://www.jplayer.org/audio/ogg/TSP-05-Your_face.ogg"
		},
		{
			title:"Sos / color fades",
			mp3:"https://p.scdn.co/mp3-preview/d2b6d9e668af367137797788ecf861d0441c649a",
			oga:"https://p.scdn.co/mp3-preview/d2b6d9e668af367137797788ecf861d0441c649a"
		},
		{
			title:"Shine on / color fades",
			mp3:"https://p.scdn.co/mp3-preview/1d035b85d2c582682efde9d6cdb5df09ffa12bfd",
			oga:"https://p.scdn.co/mp3-preview/1d035b85d2c582682efde9d6cdb5df09ffa12bfd"
		},
		{
			title:"Out of Control - Alt Mix / color fades",
			mp3:"https://p.scdn.co/mp3-preview/9da8f305b65f3b2ce8f11aa244820be310ac63a6",
			oga:"https://p.scdn.co/mp3-preview/9da8f305b65f3b2ce8f11aa244820be310ac63a6"
		},
		{
			title:"air/ Stranger Lovers",
			mp3:"https://p.scdn.co/mp3-preview/9508abbec63729d236d77d54ccb393ff56e5f820",
			oga:"https://p.scdn.co/mp3-preview/9508abbec63729d236d77d54ccb393ff56e5f820"
		},

	], {
		swfPath: "../../dist/jplayer",
		supplied: "oga, mp3",
		wmode: "window",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true
	});

	$('.jp-volume-bar').css('display','none');

	$("#jpa-img-click").click(function(){
		$("#jquery_jplayer_1").jPlayer("play");
		$(".jp-play").css('background-position',' 0 -61px');

	});

	$(".jp-play").click(function(){
		$(this).css('background-position',' 0 0');
	});

	$(".jp-next, .jp-previous").click(function(){
		$(".jp-play").css('background-position',' 0 -61px');
	});


 $(".jp-volume-max").toggle(function(){
      $('.jp-volume-bar').css('display','block');
   },function(){
       $('.jp-volume-bar').css('display','none');
   });

});
//]]>
</script>

</body>
</html>