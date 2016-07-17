<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkAdmin.php';//chỉ admin mới dc vào?>
<?php

if (isset ( $_POST ['them'] )) {
	// lay du lieu tu nguoi dung && loc loi
	$username 	= $_POST ['user'];
	$queryKT 	= "SELECT username FROM users WHERE username LIKE '$username'";
	$resultKT 	= $mysqli->query ( $queryKT );
	$arKT 		= mysqli_fetch_assoc ( $resultKT );
	$password 	= md5 ( $_POST ['password'] );
	$fullname 	= $_POST ['fullname'];
	// kiểm tra tên tài khoản tồn tại chưa?
	if (count ( $arKT ) > 0) {
		header ( "location:addUser.php?msg=Tài khoản đã tồn tại!" );
	} else {
		// tao truy van them tin vao database
		$queryINSERT = "INSERT INTO users(username,password,FullName)
			VALUES ('$username','$password','$fullname')
			";
		// thuc hien truy van
		$resultINSERT = $mysqli->query ( $queryINSERT );
		// chuyen trang khi thanh cong
		if ($resultINSERT) {
			header ( "location:users.php?msg=Thêm thành công!" );
		} else {
			echo ("co loi trong qua trinh them");
		}
	}
}
?>
<script type="text/javascript">
			$(document).ready(function(){
			$("#frm-news").validate({
				rules: {
					password: {
						required: true,
						minlength:4,
						maxlength:20,
					},
					repassword: {
						required: true,
						equalTo:"#confim_pass",
					},
					fullname: {
						required: true,
					},
				},
				messages: {
					password: {
						required: "<p class = 'eror'>Bạn chưa nhập mật khẩu</p>",
						minlength: "<p class = 'eror'>Mật khẩu ít nhất 4 ký tự</p>",
						maxlength: "<p class = 'eror'>Mật khẩu tối đa 20 ký tự</p>", 
					},
					repassword: {
						required: "<p class = 'eror'>Bạn chưa nhập xác nhận mật khẩu</p>",
						equalTo: "<p class = 'eror'>Xác nhận mật khẩu chưa khớp</p>",
					},
					fullname: {
						required: "<p class = 'eror'>Bạn chưa nhập họ tên</p>",
					},
				}
			});
		});
</script>
<!-- Form elements -->
<div class="grid_12">

	<div class="module">
		<h2>
			<span>Thêm người dùng</span>
		</h2>
		<div class="module-body">
			<form action="" method="post" name="frm-news" id="frm-news"
				enctype="multipart/form-data">
				<p>
					<label>Tên tài khoản</label> <input type="text" name="user"
						value="" class="input-medium" />
						<?php if(isset($_GET['msg'])){
							$msg = $_GET['msg'];
							echo "<p class = 'eror'>$msg</p>";}
							?>
				</p>
				<p>
					<label>Mật khẩu</label> <input type="password" name="password"
						id="confim_pass" value="" class="input-medium" />
				</p>
				<p>
					<label>Xác nhận mật khẩu</label> <input type="password"
						name="repassword" value="" class="input-medium" />
				</p>
				<p>
					<label>Họ và tên ngươi dùng</label> <input type="text"
						name="fullname" value="" class="input-medium" />
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