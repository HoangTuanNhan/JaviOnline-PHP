<?php 
if(!isset($_SESSION['user'])){
	header("location:login.php");
}
//else header("location:/bnews/admin/indexNews.php");
?>