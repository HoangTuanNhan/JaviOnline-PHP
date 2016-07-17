<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/header.php"?>
<div class="body-left fl">
<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/leftmenu.php"?>					
</div>
<?php
$cid = $_GET ['iddmt'];
//thuc hien phan trang
//dem so dong
$querydong = "SELECT COUNT(IdNews) AS 'sodong' FROM news WHERE IdCat = $cid";
$resultdong = $mysqli->query($querydong);
$arrdong = mysqli_fetch_assoc($resultdong);
$sodong = $arrdong['sodong'];
//so trang
$row_count = ROW_COUNTPub;
$sotrang = ceil ( $sodong / $row_count );
$current_page = 1;
if (isset ( $_GET ['page'] )) {
	$current_page = $_GET ['page'];
}
$offset = ($current_page - 1) * $row_count;
//truy van
$queryCat = "SELECT * FROM category WHERE IdCat = $cid";
$resultCat = $mysqli->query ( $queryCat );
$arrCat = mysqli_fetch_assoc ( $resultCat );
$NameCat = $arrCat ['NameCat'];
$queryNews = "SELECT * FROM news WHERE IdCat = $cid ORDER BY IdNews DESC LIMIT $offset,$row_count";
$resultNews = $mysqli->query ( $queryNews );
$kt = 1;
?>
<div class="body-right fr">
	<div class="news-block">
		<h2 class="title-cat">
			<a href="#" title="<?php echo $NameCat?>"><?php echo $NameCat?></a>
		</h2>
		<div class="content-cat1">
			<?php
			while ( $arrNews = mysqli_fetch_assoc ( $resultNews ) ) {
				$IdNews = $arrNews ['IdNews'];
				$NameNews = $arrNews ['NameNews'];
				$Description = $arrNews ['Description'];
				$Picture = $arrNews ['Picture'];
				if ($kt == 1) {
					$kt ++;
					?>
			<div class="item-top">
				<div class="item-left fl">
					<a href="chitiet.php?idn=<?php echo $IdNews?>"
						title="<?php echo $NameNews?>">
						<?php if($Picture!=""){?> 
						<img src="/files/<?php echo $Picture?>"
						alt="<?php echo $NameNews?>">
						<?php }?>
					</a>
				</div>
				<div class="item-right-cat fr">
					<a href="chitiet.php?idn=<?php echo $IdNews?>"
						title="<?php echo $NameNews?>" class="title"><?php echo $NameNews?></a>
					<div style="margin: 10px;"></div>
					<p class="preview"><?php echo $Description?></p>
				</div>
				<div class="clr"></div>
			</div><?php }else{?>
			<div class="item">
				<div class="item-left fl">
					<a href="chitiet.php?idn=<?php echo $IdNews?>"
						title="<?php echo $NameNews?>"> <?php if($Picture!=""){?> 
						<img src="/files/<?php echo $Picture?>"
						alt="<?php echo $NameNews?>">
						<?php }?></a>
				</div>
				<div class="item-right-cat fr">
					<a href="chitiet.php?idn=<?php echo $IdNews?>"
						title="<?php echo $NameNews?>" class="title"><?php echo $NameNews?></a>
					<div style="margin: 10px;"></div>
					<p class="preview"><?php echo $Description?></p>
				</div>
				<div class="clr"></div>
			</div>
			<?php }}?>
		</div>
		<div class="pager">
			<style>
.page-blue a {
	padding: 3px 7px;
	border: 1px solid green;
	background: green;
	color: #FFF;
	font-weight: bold;
	text-decoration: none;
}
.page-blue a:hover {
	padding: 3px 7px;
	border: 1px solid #144879;
	background: #144879;
	color: #FFF;
	font-weight: bold;
	text-decoration: none;
}

.page-blue .nav-current-page {
	padding: 3px 7px;
	border: 1px solid #144879;
	background: #144879;
	color: #FFF;
	font-weight: bold;
}
</style>
			<div class="page-blue">
				<?php 
					for($i=1;$i<=$sotrang;$i++){
						if($i==$current_page){
							$active = "class = 'active'";
						}else{
							$active=null;
						}
				?>
				<a href="danhmuc.php?page=<?php echo $i?>&&iddmt=<?php echo $cid?>" <?php echo $active?>><?php echo $i?></a>
				<?php }?>
			</div>
		</div>

	</div>

</div>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/public/inc/footer.php"?>