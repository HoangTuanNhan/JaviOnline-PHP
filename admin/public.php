<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php
$queryTT 	= "SELECT * FROM puplic";
$queryDong 	= "SELECT COUNT(IdPub) AS 'sodong' FROM puplic";
$resultDong = $mysqli->query($queryDong);
$arrDong 	= mysqli_fetch_assoc($resultDong);
$sodong 	= $arrDong['sodong'];
$resultTT 	= $mysqli->query ( $queryTT );

// THUẬT TOÁN XÓA(sử dụng session):-Nếu người dùng nhấn nút xóa có hai trường hợp:
// -Chưa chọn tin => báo chưa chọn tin và không chuyển sang trang delete.
// -Đã chọn tin -> lưu id tin tức cần xóa vào mảng session['del'](phân biệt với session user)
$dem = 1;//biến đếm các ô checkbox
if (isset ( $_POST ['del'] )) {										//nếu nhấn nút xóa
	for($i = 1; $i <= $sodong; $i ++) {
		if (isset ( $_POST [$i] )) {
			$_SESSION ['del'] [$i] = $_POST [$i];					//đưa idnews cần xóa vào session
		}
	}
	if(!isset($_SESSION ['del'])){
		header("location:public.php?msg=Chưa chọn tin");die(); 		//trường hợp không tồn tại session del mà vẫn nhấn nút xóa -> chuyển về trang hiện tại và thông báo chưa chọn tin
	}
	header("location:deletePublic.php");exit();						//trường hợp thỏa mãn đầy đủ điều kiện sẽ chuyển đến trang delete và thực hiện xóa bên trang delete
}
?>
<div class="bottom-spacing">
	<!-- Button -->
	<div class="float-left">
		<a href="/admin/addPublic.php" class="button"> <span>Thêm quảng cáo <img
				src="/templates/admin/images/plus-small.gif" alt="Thêm tin"></span>
		</a>
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
			<span>Sửa quảng cáo</span>
		</h2>
		<div class="module-table-body">
			<form action="" method="post" name="frm-del" id="frm-del">
				<table id="myTable" class="tablesorter">
					<thead>
						<tr>
							<th>ID</th>
							<th>Tên</th>
							<th style="width: 20%">Link</th>
							<th style="width: 16%; text-align: center;">Hình ảnh</th>
							<th style="width: 10%; text-align: center;">Chức năng</th>
							<th style="width: 5%; text-align: center;"><input type="submit"
								name="del" id="del" onclick="return confirm('Xác nhận xóa')"
								value="Xóa" /> <img src="/templates/admin/images/bin.gif"
								width="16" height="16" alt="delete" /></th>
						</tr>
					</thead>
					<tbody>
                            <?php
								while ( $arTT = mysqli_fetch_assoc ( $resultTT ) ) {
								$IdPub 	= $arTT ['IdPub'];
								$Name 	= $arTT ['Name'];
								$Link 	= $arTT ['Link'];
								$Photo 	= $arTT ['Photo'];
							?>
                        <tr>
							<td class="align-center"><?php echo $IdPub?></td>
							<td><?php echo $Name?></td>
							<td><a href = "<?php echo $Link?>"><?php echo $Link?></a></td>
							<td align="center"><img width="100px" src = "/files/<?php echo $Photo?>"></td>
							<td align="center">
								<a href="editpuplic.php?idtt=<?php echo $IdPub?>">Sửa 
									<img src="/templates/admin/images/pencil.gif" alt="edit" />
								</a>
							</td>
							<td align="center"><input type="checkbox"
								value="<?php echo $IdPub;?>" name="<?php echo $dem++?>"
								id="sel" /></td>
							
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