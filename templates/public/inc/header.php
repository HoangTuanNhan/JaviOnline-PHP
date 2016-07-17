<?php session_start ();?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/functions/db.php"?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/functions/define.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD Xhtml 1.0 Strict//EN" "http://www.w3.org/TR/xphp1/DTD/xphp1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xphp">
<head>
<title>Tin tức Việt - Nhật | JaviOnline.net</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<meta http-equiv="Content-Type" content="text/php; charset=UTF-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords"
	content="tin tuc viet nhat, tin tức việt nhật, tin nhật bản, tin nhat ban" />
<meta name="description"
	content="Tin tức Việt - Nhật, cập nhật liên tục hằng ngày" />
<link href="/javionline/templates/public/css/style.css" type="text/css"
	rel="stylesheet" />
<script type="text/javascript"
	src="/javionline/templates/admin/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript"
	src="/javionline/templates/admin/js/jquery.validate.js"></script>
<script type="text/javascript" src="/javionline/libraries/ckeditor/ckeditor.js"></script>
</head>
<body>
	<a name="totop"></a>
	<div class="wrapper">
		<div id="top-nav">
			<div class="main-content">
				<p class="fl">
					<a href="lienhe.php?current=lienhe" title="">[+] Gửi ý kiến phản hồi cho chúng tôi</a>
				</p>
				<p class="fr mail-icon">
					<a href="lienhe.php?current=lienhe" title="">HOT line: 0909.123.456 - 064.3456.789</a>
				</p>
				<div class="clr"></div>
			</div>
		</div>

		<div id="top-menu">
			<div class="main-content">
				<ul>
					<?php 
						$index = 'parent current';
						$lienhe = null;
						$gioithieu = null;
						if(isset($_GET['current'])){
							$current = $_GET['current'];
							if($current=='index'){
								$index = 'parent current';
							}
							else{
								$index = null;
							}
							if($current=='lienhe'){
								$lienhe = 'parent current';
							}
							else{
								$lienhe = null;
							}
							if($current=='gioithieu'){
								$gioithieu = 'parent current';
							}
							else{
								$gioithieu = null;
							}
						}
					?>
					<li class="<?php echo $index?>"><a href="index.php?current=index">Trang chủ</a></li>
					<li class="<?php echo $gioithieu?>"><a href="gioithieu.php?current=gioithieu">Giới thiệu</a></li>
					<li class="<?php echo $lienhe?>"><a href="lienhe.php?current=lienhe">Liên hệ</a></li>

				</ul>
				<div class="clr"></div>
				<div class="clr"></div>
			</div>
		</div>

		<div id="main-body">
			<div class="main-content">