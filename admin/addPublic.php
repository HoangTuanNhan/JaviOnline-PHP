<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php
if (isset ( $_POST ['them'] )) {
	//lay du lieu tu nguoi dung && loc loi
	$tenquangcao 	= $mysqli->real_escape_string($_POST ['tenquangcao']);
	$link 			= $_POST ['link'];
	//xu ly hinh anh
	$hinhanh 		= $_FILES['hinhanh']['name'];
	$time 			= time();
	$arrName 		= explode(".", $hinhanh);
	//lay phan mo rong
	$PhanMoRong 	= $arrName[count($arrName)-1];
	$hinhanh 		= "file-$time.".$PhanMoRong;
	$filename 		=  $_FILES['hinhanh']['tmp_name'];
	$destination 	= $_SERVER['DOCUMENT_ROOT']."/files/".$hinhanh;
	$resultUPhinh 	= move_uploaded_file($filename, $destination);
	//tao truy van them tin vao database
	$queryINSERT 	= "INSERT INTO puplic(Name,Link,Photo)
					VALUES ('$tenquangcao','$link','$hinhanh')";
	//thuc hien truy van
	$resultINSERT 	= $mysqli->query($queryINSERT);
	//chuyen trang khi thanh cong
	if($resultINSERT){
		header ( "location:public.php?msg=Thêm thành công!" );
	}
	else{
		echo("co loi trong qua trinh them");
	}	
}
?>
<script type="text/javascript">
			$(document).ready(function(){
			$("#frm-news").validate({
				rules: {
					tenquangcao: {
						required: true,
					},
					link: {
						required: true,
					},
					hinhanh: {
						required: true,
					},
					},
					messages: {
					tenquangcao: {
						required: "<p class = 'eror'>Chưa nhập tên!</p>",
					},
					link: {
						required: "<p class = 'eror'>Chưa nhập link</p>",
					},
					hinhanh: {
						required: "<p class = 'eror'>Phần quảng cáo phải có hình ảnh</p>",
					},
				},
			});
		});
</script>
<!-- Form elements -->
<div class="grid_12">

	<div class="module">
		<h2>
			<span>Thêm quảng cáo</span>
		</h2>

		<div class="module-body">
			<form action="" method="post" name="frm-news" id = "frm-news"
				enctype="multipart/form-data">
				<p>
					<label>Tên quảng cáo</label>
					<input type="text" name="tenquangcao" value="" class="input-medium" />
				</p>
				<p>
					<label>Hình ảnh</label>
					<input type="file" name="hinhanh" value="" />
				</p>
				<p>
					<label>Link quảng cáo</label>
					<input type="text" name="link" value="" class="input-medium" />
				</p>
				<fieldset>
					<input class="submit-green" name="them" type="submit" value="Thêm" />
					<input class="submit-gray" name="reset" type="reset" value="Nhập lại" />
				</fieldset>
			</form>
		</div>
		<!-- End .module-body -->

	</div>
	<!-- End .module -->
	<div style="clear: both;"></div>
</div>
<!-- End .grid_12 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?>  