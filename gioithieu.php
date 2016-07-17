<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/header.php"?>

<div class="body-left fl">
		<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/leftmenu.php"?>					
					
</div>
<div class="body-right fr">
	<div class="news-block">
		<h2 class="title-cat">Giới thiệu website thông tin về Việt - Nhật</h2>
		<div class="content-cat1">
			<div class="content-detail gioithieu">
				<?php 
				$query ="SELECT * FROM aboutus";
				$result = $mysqli->query($query);
				$arr = mysqli_fetch_assoc($result);
				$gioithieu = $arr['Description'];
				echo $gioithieu;
				?>
			</div>							
		</div>
	</div>
		
</div>
