<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php

if (isset ( $_POST ['them'] )) {
	// lay du lieu tu nguoi dung && loc loi
	$tentin = $mysqli->real_escape_string ( $_POST ['danhmuc'] );
	// tao truy van them tin vao database
	$queryINSERT = "INSERT INTO category(NameCat)
					VALUES ('$tentin')
					";
	// thuc hien truy van
	$resultINSERT = $mysqli->query ( $queryINSERT );
	// chuyen trang khi thanh cong
	if ($resultINSERT) {
		header ( "location:indexCat.php?msg=Thêm thành công!" );
	} else {
		echo ("co loi trong qua trinh them");
	}
}
?>
<script type="text/javascript">
			$(document).ready(function(){
			$("#news").validate({
				rules: {
					danhmuc: {
						required: true,
					},
					
				},
				messages: {
					danhmuc: {
						required: "<p class = 'eror'>Bạn chưa nhập danh mục</p>",
					},
				}
			});
		});
</script>
<!-- Form elements -->
<div class="grid_12">
	<div class="module">
		<h2>
			<span>Thêm danh mục</span>
		</h2>
		<div class="module-body">
			<form action="" method="post" name="frm-news" id="news"
				enctype="multipart/form-data">
				<p>
					<label>Tên danh mục</label> <input type="text" name="danhmuc"
						value="" class="input-medium" />
				</p>
				<fieldset>
					<input class="submit-green" name="them" type="submit" value="Thêm" />
					<input class="submit-gray" name="reset" type="reset"
						value="Nhập lại" />
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