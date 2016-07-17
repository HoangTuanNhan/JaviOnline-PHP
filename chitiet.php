<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/header.php"?>
<div class="body-left fl">
<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/leftmenu.php"?>									
</div>
<?php
$idn = $_GET ['idn'];
$query = "SELECT * FROM news WHERE IdNews = $idn";
$result = $mysqli->query ( $query );
$arr = mysqli_fetch_assoc ( $result );
$name = $arr ['NameNews'];
$id = $arr ['IdNews'];
$idcat = $arr ['IdCat'];
$detail = $arr ['Detail'];
$date = $arr ['DateCreat'];
?>
<div class="body-right fr">
	<div class="news-block detail">
		<h1 class="title"><?php echo $name?></h1>
		<p class="cat-date">
			<a title="<?php echo $name?>" href="#">Toàn cảnh Nhật Bản</a> <span>Cập nhật: <?php echo $date?></span>
		</p>
		<div class="content-detail">
			<p
				style="padding-top: 1em; padding-bottom: 1em; outline: none; list-style: none; border-style: none; color: rgb(51, 51, 51); font-family: Arial; font-size: 14px; line-height: 21px;">
				<span
					style="outline: none; list-style: none; border-style: none; font-size: medium;">
<?php echo $detail?>
</span>
			</p>
		</div>
		<div class="orther-detail">
			<div class="orther-news">
				<p class="title orther-icon">Các tin khác</p>
				<div class="items">
					<ul>
	<?php
	// truy vấn hiển thị tin liên quan
	$queryLQ = "SELECT * FROM news WHERE IdNews!=$idn && IdCat=$idcat ORDER BY IdNews DESC LIMIT 10";
	$resultLQ = $mysqli->query ( $queryLQ );
	$kt = 1;	//tạo biến kiểm tra để kiểm tra việc in ra
	while ( $arrLQ = mysqli_fetch_assoc ( $resultLQ ) ) {
		$idnLQ = $arrLQ ['IdNews'];
		$NameLQ = $arrLQ ['NameNews'];
		$pictureLQ = $arrLQ ['Picture'];
		if ($kt <= 4) {			//nếu $kt còn bé hơn 4 thì in ra
			$kt ++;				//tăng $i lên 1->sẽ in dc 4 tin đầu tiên kèm hình ảnh
			?>
			<li><a href="chitiet.php?idn=<?php echo $idnLQ?>"
							title="<?php echo $NameLQ?>">
					<?php if($pictureLQ!=""){?>
					<img alt="<?php echo $nameLQ?>" src="files/<?php echo $pictureLQ?>">
					<?php }?>
				</a>
							<p>
								<a href="chitiet.php?idn=<?php echo $idnLQ?>"
									title="<?php echo $NameLQ?>"><?php echo $NameLQ?></a>
							</p></li>
	<?php
		} else {			//trường hợp in xong 4 tin đầu
			if ($kt == 5) {	//kiểm tra $kt==5 thì in phần code tiếp theo..phần code này chỉ in một lần
				$kt ++;		//tăng $kt lên để lần lặp sau không in code này nữa.
				?>
	</ul>
					<div class="clr"></div>
				</div>
				<div class="items-noimg">
					<ul>
						<?php }?>
						<li><a href="chitiet.php?idn=<?php echo $idnLQ?>"
							title="<?php echo $NameLQ?>"><?php echo $NameLQ?>
							</a></li>
						<?php
		}
	}
	?>
					</ul>
					<div class="clr"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/footer.php"?>
