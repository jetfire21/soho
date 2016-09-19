<?php
// $access_token="3314516008.af32c42.0941fe21333b4879a8011270fed16994";
// $photo_count=9;
// $client_id = "af32c42c86d04fd49177fc102ad9cbea";
$redirect_uri = "http://shebalov.ru/s/fernanda/instagram.php";

	if($_POST['client_id'])
	{
		$client_id = trim($_POST['client_id']);
			$url =  "https://www.instagram.com/oauth/authorize/?client_id=".$client_id."&redirect_uri=".$redirect_uri."&response_type=token";
			header("location: ".$url); 
		print_r($_POST);
	}
?>

<ol>
<li>Login to Instagram and go to <a href="https://instagram.com/developer/" target="_blank">https://instagram.com/developer/</a></li>
<li>Click <strong>"Register your Appcation"</strong>.</li>
<li>Click “Manage Clients”, then click “Register New Client”. Both located on the upper right corner for the page.</li>
<li>Fill out the form. 
In the “Details” tab, make sure you fill out the “Application name” ,Website URL - <strong>http://shebalov.ru</strong> “Valid redirect URIs” - <strong>http://shebalov.ru/s/fernanda/instagram.php</strong>.</li>
<li>In the “Security” tab, un-check “Disable implicit OAuth”</li><li>Fill out all other required fields and click “Register”</li>
<li> in tab “Manage Clients” choose your application name and copy Client id</li>
<li>

	<form action="" method="post">
		<label for="">enter Client id: </label>
		<input type="text" name="client_id">
		<input type="submit" value="Send">
	</form>

</li>
</ol>
Then sending client_id you get in address bar of the browser <strong>http://shebalov.ru/s/fernanda/instagram.php#access_token=3314516008.af32c42.0941fe21333b4879a8011270fed14446994</strong>
to copy value after <strong>access_token=</strong><br> for expamle <strong>3314516008.af32c42.0941fe21333b4879a8011270fed14446994</strong>
		<form action="" method="post">
			<label for="">enter access_token: </label>
			<input type="text" name="token">
			<input type="submit" value="Send">
		</form>


		<?php
	if($_POST['token']){

		$access_token = trim($_POST['token']);
		$f = fopen("data.txt", "a");

		// Записать строку текста
		fwrite($f, "\r\n access_token = ". $access_token); 

		// Закрыть текстовый файл
		fclose($f);

		$url = "https://api.instagram.com/v1/users/self/media/recent/?";
		// $url.= "access_token={$access_token}&count={$photo_count}";
		$url.= "access_token={$access_token}";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,            $url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		$res = curl_exec($ch);
		$res = json_decode($res);  // обьект

		// echo "<pre>";
		// print_r($res->data);
		// echo "</pre>";
		// echo "<hr>";
		if( !empty($res->data)){

			echo "<hr><h1>All good! It works!<br><br>instagram feed below</h1><br>";
			foreach( $res->data as $item){
				$img_url = $item->images->standard_resolution->url;
				$width = $item->images->standard_resolution->width;
				$height = $item->images->standard_resolution->height;

				echo $item->caption->text;
				echo "<br>";
				echo "<a href=".$item->link."> <img width='".$width."' height='".$height."' src='".$img_url."' /></a>";
				echo "<hr>";

				$f = fopen("data.txt", "a");

				// Записать строку текста
				fwrite($f, "\r\n". $item->link ."\r\n". $item->caption->text."\r\n".$img_url."\r\n".$width."\r\n".$height); 

				// Закрыть текстовый файл
				fclose($f);

			}
		}
	}

?>
