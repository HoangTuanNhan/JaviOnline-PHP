<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
if(!isset($_SESSION['del'])){
	echo "<p class ='eror'>Truy cập không liên kết<br />
		<a href ='indexNews.php'>Nhấn vào đây</a> để thực hiện chức năng này.
		</p>";
	die();
}
foreach($_SESSION['del']as $i=>$IdPub){
	//lấy đường dẫn ảnh cần xóa
	$queryPicture 	= "SELECT Photo FROM puplic WHERE IdPub = $IdPub LIMIT 1";
	$result 		= $mysqli->query($queryPicture);
	$arPicture 		= mysqli_fetch_assoc($result);
	$tenanh 		= $arPicture['Photo'];
	$urlAnhCu 		= $_SERVER['DOCUMENT_ROOT'].'/files/'.$tenanh;
	//thực hiện xóa ảnh trong thư mục files
	unlink($urlAnhCu);
	$queryDELETE 	= "DELETE FROM puplic WHERE IdPub = $IdPub";
	$resultDELETE 	= $mysqli->query($queryDELETE);
}
if(isset($_SESSION['del'])){		//xóa session cũ tồn tại do có trường hợp xóa nhiều lần
	unset($_SESSION['del']);
}
if($resultDELETE){
	header("location:public.php?msg=Xóa thành công!");
	exit();
}
else{
	echo "có lỗi trong quá trình xóa!!";
}
?>
