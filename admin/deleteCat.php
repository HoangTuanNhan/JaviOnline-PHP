<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
	$cid = $_GET['cid'];
	if(isset($cid)){
	$queryDELETE 	= "DELETE FROM category WHERE IdCat = $cid";
	$resultDELETE 	= $mysqli->query($queryDELETE);
	if($resultDELETE){
		header("location:indexCat.php?msg=Xóa thành công!");
		exit();
	}
	else{
		echo "<p class = 'eror'>Có lỗi trong quá trình xóa.Vui lòng thử lại.</p>";
	}
}else exit();
?>
