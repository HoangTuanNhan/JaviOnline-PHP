<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php
$id 	= $_GET['id'];
$query 	= "SELECT * FROM contact WHERE IdContact = $id";
$result = $mysqli->query($query);
$arr 	= mysqli_fetch_assoc($result);
$FullName 	= $arr ['FullName'];
$Phone 		= $arr ['Phone'];
$Website 	= $arr ['Website'];
$Content 	= $arr ['Content'];
$Date 		= $arr ['DateCreate'];
?>

<div class="grid_12">
	<!-- Example table -->
	<div class="module">
		<div class="module-table-body">
			<p>Họ và tên người gửi liên hệ: <?php echo $FullName?></p>
			<p>Ngày gửi: <?php echo $Date?></p>
			<p>Số điện thoại: <?php echo $Phone?></p>
			<p>Website: <a href="<?php echo $Website?>"><?php echo $Website?></a></p>
			<p><b>Nội dung: <?php echo $Content?></b></p>
		</div>
		<!-- End .module-table-body -->
	</div>
	<!-- End .module -->
	<div class="pagination">
		<div style="clear: both;"></div>
	</div>
</div>
<!-- End .grid_12 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?>   