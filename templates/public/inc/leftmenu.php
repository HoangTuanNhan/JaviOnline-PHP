<?php
// khởi tạo truy vấn danh mục tin
$queryCat = "SELECT * FROM category";
$resultCat = $mysqli->query ( $queryCat );
// khởi tạo truy vấn quảng cáo.
$queryPuplic = "SELECT * FROM puplic";
$resultPuplic = $mysqli->query ( $queryPuplic );
?>
<div class="left-menu">
	<ul>
		<?php
		while ( $arrCat = mysqli_fetch_assoc ( $resultCat ) ) {
			$IdCat = $arrCat ['IdCat'];
			$NameCat = $arrCat ['NameCat'];
			?>
		<li class="parent"><a href="danhmuc.php?iddmt=<?php echo $IdCat?>"><?php echo $NameCat?></a></li>
		<?php }?>
	</ul>
	<div class="clr"></div>
</div>

<div class="support">
	<p>Hỗ trợ trực tuyến</p>
	<div class="yahoo">
		<ul>
			<?php 
				$queryYahoo="SELECT yahoo,Name FROM suport";
				$resultYahoo = $mysqli->query($queryYahoo);
				while($arrYahoo = mysqli_fetch_assoc($resultYahoo)){
					$yahoo = $arrYahoo['yahoo'];
					$name = $arrYahoo['Name'];
			?>
			<li><a href="ymsgr:sendIM?<?php echo $yahoo?>"
				title="Chat with <?php echo $name?>"><?php echo $name?></a></li>
			<?php }?>
		</ul>
		<div class="clr"></div>
	</div>

	<div class="skype">
		<ul>
			<?php 
				$querySkyper="SELECT skyper,Name FROM suport";
				$resultSkyper = $mysqli->query($querySkyper);
				while($arrSkyper = mysqli_fetch_assoc($resultSkyper)){
					$skyper = $arrSkyper['skyper'];
					$namesky = $arrSkyper['Name'];
			?>
			<li><a href="Skype:<?php echo $skyper?>?chat" title="Chat with <?php echo $namesky?>"><?php echo $namesky?></a>
			</li>
			<?php }?>
		</ul>
		<div class="clr"></div>
	</div>

	<div class="orther">
		<p>
			Email: <span>trandangxuan@gmail.com</span>
		</p>
		<p>
			Số điện thoại: <span>0903154678</span>
		</p>
	</div>
</div>

<div class="advs">
	<?php while($arPuplic=mysqli_fetch_assoc($resultPuplic)){
		$IdPub =$arPuplic['IdPub'];
		$Link =$arPuplic['Link'];
		$Photo =$arPuplic['Photo'];
		?>
	<a href="<?php echo $Link?>" title=""><img
		src="/files/<?php echo $Photo?>" alt="" /></a>
	<?php }?>
</div>
