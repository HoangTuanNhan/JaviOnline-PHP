<?php
ob_start ();
session_start ();
?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/functions/db.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/functions/define.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>VinaTAB EDU - Admin template</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css"
	href="/javionline/templates/admin/css/styles.css" media="screen" />
<script type="text/javascript"
	src="/javionline/templates/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript"
	src="/javionline/templates/admin/js/jquery.validate.js"></script>
<script type="text/javascript"
	src="/javionline/libraries/ckeditor/ckeditor.js"></script>


</head>
<body>
	<!-- Header -->
	<div id="header">
		<!-- Header. Status part -->
		<div id="header-status">
			<div class="container_12">
				<div class="grid_4">
					<?php
					
if (isset ( $_SESSION ['user'] )) {
						$fullname = $_SESSION ['user'] ['fullname'];
						$id_user = $_SESSION ['user'] ['id_user'];
						$username = $_SESSION ['user'] ['username'];
						?>
					<ul class="user-pro">
						<li><a href="logout.php">Logout</a></li>
						<li>Chào, <a href="editUser.php?uid=<?php echo $id_user?>"><?php echo $fullname?></a></li>
					</ul>
					<?php }else{?>
						<ul class="user-pro">
						<li><a href="login.php">Login</a></li>
					</ul>
					<?php }?>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
		<!-- End #header-status -->

		<!-- Header. Main part -->
		<div id="header-main">
			<div class="container_12">
				<div class="grid_12">
					<div id="logo">
						<ul id="nav">
							<?php 
								$stringtaikhoan=null;
								$stringnguoidung=null;
								$stringquantri='id="current"';
								if(isset($_GET['current'])){
									$current=$_GET['current'];
									if($current == 'quantri'){
										$stringquantri = 'id="current"';
									}else $stringquantri = null;
									if($current == 'taikhoan'){
										$stringtaikhoan = 'id="current"';
									}else $stringtaikhoan=null;
									if($current == 'nguoidung'){
										$stringnguoidung = 'id="current"';
									}else $stringnguoidung=null;
								}
							?>
							<li <?php echo $stringquantri?>><a href="index.php?current=quantri">Quản trị</a></li>
							<li <?php echo $stringtaikhoan?>><a href="editUser.php?uid=<?php echo $id_user?>&&current=taikhoan">Tài khoản</a></li>
							<li <?php echo $stringnguoidung?>><a href="users.php?current=nguoidung">Người dùng</a></li>
						</ul>
					</div>
					<!-- End. #Logo -->
				</div>
				<!-- End. .grid_12-->
				<div style="clear: both;"></div>
			</div>
			<!-- End. .container_12 -->
		</div>
		<!-- End #header-main -->
		<div style="clear: both;"></div>
		<!-- Sub navigation -->
		<div id="subnav">
			<div class="container_12">
				<div class="grid_12">
					<ul>
						<li><a href="indexNews.php">Tin tức</a></li>
						<li><a href="indexCat.php">Danh mục</a></li>
						<li><a href="aboutus.php">Giới thiệu</a></li>
						<li><a href="contact.php">Liên hệ</a></li>
						<li><a href="suport.php">Trợ giúp</a></li>
						<li><a href="public.php">Quảng cáo</a></li>
						<li><a href="phantrang.php">Phân trang</a></li>
					</ul>

				</div>
				<!-- End. .grid_12-->
			</div>
			<!-- End. .container_12 -->
			<div style="clear: both;"></div>
		</div>
		<!-- End #subnav -->
	</div>
	<!-- End #header -->

	<div class="container_12">