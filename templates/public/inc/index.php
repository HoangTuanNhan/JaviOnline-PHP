<?php
$mysqliDMT = "SELECT * FROM category";
$resultDMT = $mysqli->query ( $mysqliDMT );
while ( $arDMT = mysqli_fetch_assoc ( $resultDMT ) ) {
	$kt = 1;
	$NameCat = $arDMT ['NameCat'];
	$IdCat = $arDMT ['IdCat'];
	$mysqliTT = "SELECT * FROM news WHERE IdCat = $IdCat ORDER BY IdNews DESC LIMIT 4";
	$resultTT = $mysqli->query ( $mysqliTT );
	?>
<div class="news-block">
	<h2 class="title-cat">
		<a href="" title=""><?php echo $NameCat?></a>
	</h2>
	<div class="content-cat">
			<?php
	while ( $arTT = mysqli_fetch_assoc ( $resultTT ) ) {
		$IdNews = $arTT ['IdNews'];
		$NameNews = $arTT ['NameNews'];
		$Decription = $arTT ['Description'];
		$Picture = $arTT ['Picture'];
		$DateCreat = $arTT ['DateCreat'];
		if ($kt == 1) {						//nếu kiểm tra ==1 thì in tin top
			$kt ++;							//tăng kiểm tra lên để lần sau không in tin top này nữa
			?>
		<div class="item-left fl">
			<a
				href="chitiet.php?idn=<?php echo $IdNews?>"
				title="<?php echo $NameNews?>"><img
				src="/files/<?php echo $Picture?>" alt="<?php echo $NameNews?>"></a>
			<a
				href="chitiet.php?idn=<?php echo $IdNews?>"
				title="<?php echo $NameNews?>" class="title"><?php echo $NameNews?></a>
			<p><?php echo $Decription?></p>
		</div>
				<?php
		} else {				//trường hợp in các tin bình thường
			?>
			<div class="item-right fr">
			<ul>
				<li><a
					href="chitiet.php?idn=<?php echo $IdNews?>"
					title="<?php echo $NameNews?>" class="title"><?php echo $NameNews?></a>
					<p class="cat-date">
						<a
							href="cat.php?idn=<?php echo $IdNews?>"
							title="<?php echo $TenDanhMucTin?>"><?php echo $NameCat?></a> <span>Cập nhật: <?php echo $DateCreat?></span>
					</p>
					<p class="preview"></p><?php echo $Decription?></li>
			</ul>
			</div>
				<?php
		}
	}
	?>
		<div class="clr"></div>
	</div>
</div>
<?php }?>
