<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<!-- Dashboard icons -->
<div class="grid_main_l">
	<a href="addNews.php" class="dashboard-module"> <img
		src="/templates/admin/images/Crystal_Clear_write.gif" width="64"
		height="64" alt="edit" /> <span>Thêm tin tức</span>
	</a> <a href="addCats.php" class="dashboard-module"> <img
		src="/templates/admin/images/Crystal_Clear_files.gif" width="64"
		height="64" alt="edit" /> <span>Thêm danh mục</span>
	</a>
	<div style="clear: both"></div>
</div>
<!-- End .grid_7 -->

<!-- Account overview -->
<div class="grid_main_r">
	<div class="module">
		<h2>
			<span>Quản trị hệ thống</span>
		</h2>

		<div class="module-body">
			<p class="p">
				<strong>Phần mềm</strong> được viết trên nền tảng PHP-MySQL <br /> <strong>Học
					viên thực hiện: </strong>Trần Nguyễn Gia Huy<br /> <strong>Email: </strong>huytng@vinatab.net<br />
				<strong>Phone: </strong>0909.123.456<br />
			</p>
		</div>
	</div>
	<div style="clear: both;"></div>
	<div class="padding-bottom"></div>
</div>
<!-- End .grid_5 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?>              