<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php 
if(isset($_SESSION['user'])){
	header("location:/admin/index.php");//kiếm tra user đã tồn tại hay chưa if(tồn tại thì chuyển sang trang index)
	exit();
}
?>
<?php
if (isset ( $_POST ['login'] )) {
	// lay du lieu tu nguoi dung && loc loi
	$username 		= $_POST ['user'];
	$password 		= md5 ( $_POST ['password'] );
	// tao truy van them tin vao database
	$queryINSERT 	= "SELECT * FROM users WHERE username = '$username' && password = '$password' LIMIT 1";
	// thuc hien truy van
	$resultINSERT 	= $mysqli->query ( $queryINSERT );
	$arUser = mysqli_fetch_assoc ( $resultINSERT );
	if (count ( $arUser ) > 0) {
		$_SESSION['user']['username']=$username;
		$_SESSION['user']['id_user']=$arUser['IdUser'];
		$_SESSION['user']['fullname']=$arUser['FullName'];
		header("location:index.php");
	} else {
		echo "<p style ='color:red'><strong>Sai tên tài khoản hoặc mật khẩu.</strong></p>";
	}
}
?>
<script type="text/javascript">
			$(document).ready(function(){
			$("#frm-news").validate({
				rules: {
					user: {
						required: true,
					},
					password: {
						required: true,
					},
				},
				messages: {
					user: {
						required: "<strong><span style = 'color:red'>Bạn chưa nhập tên tài khoản</span></strong>",
					},
					password: {
						required: "<strong><span style = 'color:red'>Bạn chưa nhập mật khẩu</span></strong>",
					},
				}
			});
		});
</script>
<!-- Form elements -->
<div class="grid_12">

	<div class="module">
		<h2>
			<span>Đăng nhập</span>
		</h2>
		<div class="module-body">
			<form action="" method="post" name="frm-news" id="frm-news"
				enctype="multipart/form-data">
				<p>
					<label>Tên tài khoản</label> <input type="text" name="user"
						value="" class="input-medium" />
				</p>
				<p>
					<label>Mật khẩu</label> <input type="password" name="password"
						id="confim_pass" value="" class="input-medium" />
				</p>
				
				<fieldset>
					<input class="submit-green" name="login" type="submit"
						value="Đăng nhập" />
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