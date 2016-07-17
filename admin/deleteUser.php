<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkAdmin.php';?>
<?php 
$uid 			= $_GET['uid'];
require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkall.php';
$queryDELETE 	= "DELETE FROM users WHERE IdUser = $uid";
$resultDELETE 	= $mysqli->query($queryDELETE);
IF($resultDELETE){
	header("location:users.php?msg=Xóa thành công!&&current=taikhoan");
	exit();
}
else{
	echo "có lỗi trong quá trình xóa!!";
}
?>
