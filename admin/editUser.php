<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php

$uid 	= $_GET ['uid'];
require_once $_SERVER ['DOCUMENT_ROOT'] . '/functions/checkall.php';
$query 	= "SELECT * FROM users WHERE IdUser = $uid";
$result = $mysqli->query ( $query );
if (! $result) {
	echo "<p style='color:red'><strong>Không hợp lệ!!</strong></p>";
	die ();
}
$aruser 	= mysqli_fetch_assoc ( $result );
$username 	= $aruser ['username'];
$fullname 	= $aruser ['FullName'];
if (isset ( $_POST ['sua'] )) {
	// lay du lieu tu nguoi dung && loc loi
	$username = $_POST ['user'];
	$password = md5 ( $_POST ['password'] );
	$fullname = $mysqli->real_escape_string ( $_POST ['fullname'] );
	
	// tao truy van them tin vao database
	$queryUPDATE 	= "UPDATE users SET password ='$password',FullName = '$fullname' WHERE IdUser = $uid";
	// thuc hien truy van
	$resultUPDATE 	= $mysqli->query ( $queryUPDATE );
	// chuyen trang khi thanh cong
	if ($resultUPDATE) {
		header ( "location:users.php?msg=Sửa thành công!&&current=nguoidung" );
	} else {
		echo ("<p class = 'eror'>co loi trong qua trinh sua</p>");
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
						equalTo:"#password",
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
			<span>Sửa người dùng</span>
		</h2>
		<div class="module-body">
			<form action="" method="post" name="frm-news" id="frm-news"
				enctype="multipart/form-data">
				<p>
					<label>Tên tài khoản:<?php echo "<strong>".$username."</strong>"?></label>
				</p>
				<p>
					<label>Mật khẩu</label> <input type="password" name="password" id = "password"
						value="" class="input-medium" />
				</p>
				<p>
					<label>Xác nhận mật khẩu</label> <input type="password"
						name="repassword" id="confim_pass" value="" class="input-medium" />
				</p>
				<p>
					<label>Họ và tên ngươi dùng</label> <input type="text"
						name="fullname" value="<?php echo $fullname?>"
						class="input-medium" />
				</p>
				<fieldset>
					<input class="submit-green" name="sua" type="submit" value="Sửa" />
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