<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
if(!isset($_SESSION['del'])){	//trường hợp người dùng đi tắt vào trang delete qua thanh địa chỉ trình duyêt
	echo "<p class ='eror'>Truy cập không liên kết<br />
		<a href ='contact.php'>Nhấn vào đây</a> để thực hiện chức năng này.
		</p>";
	die();
}
foreach($_SESSION['del']as $i=>$IdContact){		//dùng foreach duyệt các phần tử cần xóa
	$queryDELETE 	= "DELETE FROM contact WHERE IdContact = $IdContact";
	$resultDELETE 	= $mysqli->query($queryDELETE);
}
if(isset($_SESSION['del'])){		//xóa session cũ tồn tại do có trường hợp xóa nhiều lần
	unset($_SESSION['del']);
}
if($resultDELETE){
	header("location:contact.php?msg=Xóa thành công!");
	exit();
}
else{
	echo "có lỗi trong quá trình xóa!!";
}
?>
