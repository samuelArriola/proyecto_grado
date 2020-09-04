<?php 
if(isset($_GET['token']) && !empty($_GET['token'])){
	$captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeB0W4UAAAAALVpkLnc6Tk2BAYh6Y68QfHK5gTd&response=" . $_GET['token']));

	header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
	header("Content-type: application/json; charset=utf-8");
	if($captcha->success == false)
	{    
		echo "false"; exit;
	}else{
		echo "true"; exit;
	}
}

?>