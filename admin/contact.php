<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php
// thực hiện phân trang
$querySD 	= "SELECT COUNT(IdContact) AS 'sodong' FROM contact";
$resultSD 	= $mysqli->query ( $querySD );
$arSD 		= mysqli_fetch_assoc ( $resultSD );
$sodong 	= $arSD ['sodong'];
// tính số trang
$row_count 	= ROW_COUNTAd;
$sotrang 	= ceil ( $sodong / $row_count );
$current_page = 1;
if (isset ( $_GET ['page'] )) {
	$current_page = $_GET ['page'];
}
$offset 	= ($current_page - 1) * $row_count;
//truy vấn hiển thị dữ liệu
$queryTT 	= "SELECT * FROM contact ORDER BY IdContact DESC LIMIT $offset,$row_count";
$dem 		= 1;//biến đếm các ô checkbox
$resultTT 	= $mysqli->query ( $queryTT );

// THUẬT TOÁN XÓA(sử dụng session):-Nếu người dùng nhấn nút xóa có hai trường hợp:
// -Chưa chọn tin => báo chưa chọn tin và không chuyển sang trang delete.
// -Đã chọn tin -> lưu id tin tức cần xóa vào mảng session['del'](phân biệt với session user)

if (isset ( $_POST ['del'] )) {							//nếu nhấn nút xóa
	for($i = 1; $i <= $row_count; $i ++) {				//lặp i trong số trang hiển thị hiện tại
		if (isset ( $_POST [$i] )) {					//nếu có đánh vào ô check box
			$_SESSION ['del'] [$i] = $_POST [$i];		//đưa id vào session
		}
	}
	if(!isset($_SESSION ['del'])){
		header("location:contact.php?msg=Xóa rỗng");die(); //nếu session del rỗng,tức là chưa chọn tin nhưng vẫn nhấn nút xóa
	}
	header("location:delcontact.php");exit();				//trường hợp thỏa mãn đầy đủ điều kiện sẽ chuyển đến trang delete và thực hiện xóa bên trang delete
}

?>

<div class="bottom-spacing">
	<!-- Button -->
	<div class="float-left">
		<p style="color: green">
			<strong>
				<?php	//phần hiển thị thông báo sau khi xóa thành công,hoặc không chọn tin mà vẫn nhấn nút xóa.
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
			<span>Danh sách liên hệ</span>
		</h2>

		<div class="module-table-body">
			<form action="" method="post" name="frm-del" id="frm-del">
				<table id="myTable" class="tablesorter">
					<thead>
						<tr>
							<th style="width: 4%; text-align: center;">ID</th>
							<th style="width: 15%">Họ Và Tên</th>
							<th style="width: 15%">Email</th>
							<th style="width: 14%; text-align: center;">Ngày liên hệ</th>
							<th style="width: 5%; text-align: center;"><input type="submit"
								name="del" id="del" onclick="return confirm('Xác nhận xóa')"
								value="Xóa" /> <img src="/templates/admin/images/bin.gif"
								width="16" height="16" alt="delete" /></th>
						</tr>
					</thead>
					<tbody>
                            <?php
								while ( $arTT = mysqli_fetch_assoc ( $resultTT ) ) {
								$IdContact 	= $arTT ['IdContact'];
								$FullName 	= $arTT ['FullName'];
								$Email 		= $arTT ['Email'];
								$DateCreate = $arTT ['DateCreate'];
							?>
                        <tr>
							<td class="align-center"><?php echo $IdContact?></td>
							<td><a href = "detailcontact.php?id=<?php echo $IdContact?>"><?php echo $FullName?></a></td>
							<td><?php echo $Email?></td>
							<td align="center"><?php echo $DateCreate?></td>
							<td align="center"><input type="checkbox"
								value="<?php echo $IdContact;?>" name="<?php echo $dem++?>"
								id="sel" />
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
		<div class="numbers">
                        	<?php
								for($i = 1; $i <= $sotrang; $i ++) {
								if ($i == $current_page) {
									$active = "class = 'active'";
								} else
									$active = null;
							?>
                            	<a href="contact.php?page=<?php echo $i?>"
									<?php echo $active?>> <span>Trang:</span> 
	                            	<?php echo $i?>
                           		</a> 
	                            	<?php if($i!=$sotrang){?>
	                            	<span>|</span> 
	                            	<?php }?>
                             <?php }?>
                        </div>
		<div style="clear: both;"></div>
	</div>
</div>
<!-- End .grid_12 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?>   