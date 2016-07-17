<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php
$queryTT 	= "SELECT * FROM suport";
$resultTT 	= $mysqli->query ( $queryTT );
?>
<p class = 'eror'>Cố định số lượng hỗ trợ online là 2 người nên bỏ chức năng thêm người hỗ trợ,chĩ sửa 2 người này,trường hợp thêm nhiều quá sẽ bị vỡ trang .</p>

<div class="bottom-spacing">
	<!-- Button -->
	<div class="float-left">
		<p style="color: green">
			<strong>
				<?php
				if (isset ( $_GET ['msg'] ))
					echo $_GET ['msg'];
				?>
            </strong>
		</p>
	</div>
	<div class="clear"></div>
</div>

<div class="grid_12">
	<!-- Example table -->
	<div class="module">
		<h2>
			<span>Danh sách hỗ trợ</span>
		</h2>
		<div class="module-table-body">
			<form action="" method="post" name="frm-del" id="frm-del">
				<table id="myTable" class="tablesorter">
					<thead>
						<tr>
							<th style="width: 4%; text-align: center;">ID</th>
							<th>Họ tên</th>
							<th style="width: 20%">yahoo</th>
							<th style="width: 16%; text-align: center;">Skyper</th>
							<th style="width: 11%; text-align: center;">Chức năng</th>
						</tr>
					</thead>
					<tbody>
                            <?php
								while ( $arTT = mysqli_fetch_assoc ( $resultTT ) ) {
								$IdSub 	= $arTT ['IdSup'];
								$Name 	= $arTT ['Name'];
								$yahoo 	= $arTT ['yahoo'];
								$skyper = $arTT ['skyper'];
							?>
                        <tr>
							<td class="align-center"><?php echo $IdSub?></td>
							<td><?php echo $Name?></td>
							<td><?php echo $yahoo?></td>
							<td align="center"><?php echo $skyper?></td>
							<td align="center">
								<a href="editsuport.php?idtt=<?php echo $IdSub?>">Sửa 
									<img src="/templates/admin/images/pencil.gif" alt="edit" />
								</a>
							</td>
						</tr>
                                <?php }?>
                            </tbody>
				</table>
			</form>
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