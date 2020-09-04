<?php 
session_start();
$_SESSION['code1'] = "";
$_SESSION['code2'] = "";
header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header("Content-type: application/json; charset=utf-8");
echo json_encode(true);
 ?>