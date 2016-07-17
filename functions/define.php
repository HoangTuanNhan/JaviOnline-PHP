<?php
$admin	=5;		//mặc định khi chưa có seesion thì số phân trang của admin =5
$public = 5;	//---------------------------------------------------public = 5
if(isset($_SESSION['phantrang'])){
		$admin 	= $_SESSION['phantrang']['admin'];
		$public = $_SESSION['phantrang']['public'];
	}
	define("ROW_COUNTAd", $admin);
	define("ROW_COUNTPub", $public);
?>
