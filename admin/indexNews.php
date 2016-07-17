<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php

$idt 		= ""; 				// khởi tạo id danh mục tìm kiếm
if (isset ( $_GET ['idt'] )) { 	// nếu người dùng chọn chức năng tìm kiếm theo danh mục
	$idt 	= $_GET ['idt']; 	// lưu id danh mục cần tìm lại = $idt
}

// khởi tạo truy vấn lấy danh mục tin hiển thị trong thẻ select
$query 	= "SELECT * FROM category";
$result = $mysqli->query ( $query );

$txtsearch 		= "Từ khóa tin tức"; 	// khởi tạo biến text tìm kiếm
$searchElement 	= null; 				// khởi tạo biến truy vấn tìm kiếm.biến này được gán vào câu lệnh select vào database
                       
// thao tác khi người dùng nhấn nút hiển thị tất cả
if (isset ( $_POST ['showall'] )) {
	$searchElement = null; 				// phần tử tìm kiếm bằng null(select không có điều kiện)
	header ( "location:indexNews.php" );	
	die ();
}

// THUẬT TOÁN TÌM KIẾM:
// kiểm tra biến text tìm kiếm đã có trước đó chưa(trường hợp người dùng gõ tìm kiếm xong click vào phân trang thì vẫn lưu text tìm kiếm này)
if (isset ( $_GET ['txtSearch'] )) {
	$txtsearch = $_GET ['txtSearch']; 	// lấy text tìm kiếm
	if($txtsearch=='Từ khóa tin tức'){	//nếu text tìm kiếm = từ khóa mặc định thì đặt nó bằng null nếu không sẽ tìm theo từ khóa này -> sai kết quả
		$txtsearch=null;
	}
	if ($idt != "") { 					// kiểm tra xem trước đó người dùng có chọn chức năng tìm kiếm theo danh mục không
		$idt = $_GET ['idt']; 			// nếu có thì lấy id danh mục cần tìm
		$searchElement = "WHERE NameNews LIKE '%$txtsearch%'&&Idcat=$idt"; // khởi tạo biến truy vấn tìm kiếm với hai điều kiện là tìm theo tin tức và danh mục
	} else {
		$searchElement = "WHERE NameNews LIKE '%$txtsearch%'"; 	// nếu không chọn danh mục cần tìm thì chỉ tìm theo tin tức người dùng nhập vào
	}
} else if ($idt != "") { 										// nếu không tồn tại text tìm kiếm,kiểm tra xem có tồn tại id danh mục tin cần tìm không
	$searchElement = "WHERE IdCat=$idt"; 						// có thì chỉ tìm với điều kiện id danh mục
}
// thao tác khi người nhấn vào nút tìm kiếm,lúc này phải khởi tạo lại text tìm kiếm mới,kết hợp kiểm tra xem có chọn danh mục tìm kiếm không
if (isset ( $_POST ['Search'] )) { 		// kiểm tra nhấn nút search
	$txtsearch = $_POST ['txtSearch']; 	// update biến text tìm kiếm
	if ($idt != "") { // kiểm tra xem có chọn danh mục cần tìm không
		$searchElement = "WHERE NameNews LIKE '%$txtsearch%'&&Idcat=$idt"; 	// nếu chọn danh mục cần tìm thì truy vấn với hai điều kiện
	} else {
		$searchElement = "WHERE NameNews LIKE '%$txtsearch%'"; 				// ngược lại thì tìm kiếm với một điều kiện
	}
}

// THỰC HIỆN PHÂN TRANG
// số trang cần phân phải phụ thuộc vào số tin tìm được từ thuật toàn tìm kiếm trên,tức là phụ thuộc vào $searchElement
$querySD 	= "SELECT COUNT(IdNews) AS 'sodong' FROM news $searchElement";
$resultSD 	= $mysqli->query ( $querySD );
$arSD 		= mysqli_fetch_assoc ( $resultSD );
$sodong 	= $arSD ['sodong'];
// tính số trang cần phân chia.
$row_count 	= ROW_COUNTAd;
$sotrang 	= ceil ( $sodong / $row_count );
$current_page = 1;
if (isset ( $_GET ['page'] )) {
	$current_page = $_GET ['page'];
}
$offset = ($current_page - 1) * $row_count;
// thực hiện truy vấn hiển thị
$queryTT = "SELECT c.*,n.* FROM category AS c INNER JOIN news AS n USING(IdCat) $searchElement ORDER BY IdNews DESC LIMIT $offset,$row_count";
$resultTT = $mysqli->query ( $queryTT );

// THUẬT TOÁN XÓA(sử dụng session):-Nếu người dùng nhấn nút xóa có hai trường hợp:
// -Chưa chọn tin => báo chưa chọn tin và không chuyển sang trang delete.
// -Đã chọn tin -> lưu id tin tức cần xóa vào mảng session['del'](phân biệt với session user)
 $dem = 1; // biến đếm các ô checkbox
// if (isset ( $_POST ['del'] )) { 			// nếu nhấn nút xóa
// 	for($i = 1; $i <= $row_count; $i ++) {	//lặp i trong số trang hiển thị hiện tại
// 		if (isset ( $_POST ['item'.$i] )) {		//nếu có đánh vào ô check box
// 			$_SESSION ['del'] [$i] = $_POST ['item'.$i]; // thì đưa idnews cần xóa vào session
// 		}
// 	}
// 	if (! isset ( $_SESSION ['del'] )) {						//nếu session del rỗng,tức là chưa chọn tin nhưng vẫn nhấn nút xóa
// 		header ( "location:indexNews.php?msg=Chưa chọn tin" );	//thông báo chưa chọn tin,,không chuyển đến delete.
// 		exit (); 												// nếu không có điều kiện này -> không chọn tin vẫn báo xóa thành công(không hợp lý)
// 	}
// 	header ( "location:deleteNews.php" );
// 	exit (); // trường hợp thỏa mãn đầy đủ điều kiện xóa sẽ chuyển đến trang delete và thực hiện xóa bên trang delete
// }

//THUẬT TOÁN XÓA SỬ DỤNG HÀM XỬ LÝ CHUỖI
//lấy được mảng chứa các id cần xóa
//chuyển mảng thành chuỗi
//bằng phương thức GET đưa chuỗi đó sang trang delete
//trang delete chuyển chuỗi id cần xóa thành mảng để thực hiện xóa.
if(isset($_POST['del'])){
	for($i=1;$i<=$row_count;$i++){
		if(isset($_POST['item'.$i])){
			$arrItem[$i]=$_POST['item'.$i];
		}
	}
	echo "<pre>";
		print_r($arrItem[1]);
	echo "</pre>";
	die();
}
?>
<!-- select all -->

<script type="text/javascript">
$(document).ready(function() {
	$('#selecctall').click(function(event) {  //on toggle click 
		if(this.checked) { // check toggle status
			$('.checkbox1').each(function() { //select all checkboxes with class "checkbox1"
				this.checked = true;                        
			});
		}else{
			$('.checkbox1').each(function() { //disselect all checkboxes with class "checkbox1"
				this.checked = false;                        
			});			
		}
	});
	
});
</script>
<!-- 	<input type="checkbox" id="selecctall"/> Selecct All -->
<!-- 	<input class="checkbox1" type="checkbox" > This is Item 1 -->
<!-- 	<input class="checkbox1" type="checkbox" > This is Item 2 -->

<div class="bottom-spacing">
	<!-- Button -->
	<div class="float-left">
		<a href="/admin/addNews.php" class="button"> <span>Thêm tin <img
				src="/templates/admin/images/plus-small.gif" alt="Thêm tin"></span>
		</a>
		<p style="color: green">
			<strong>
				<?php
				// phần hiển thị thông báo sau khi xóa thành công,hoặc không chọn tin mà vẫn nhấn nút xóa.
				if (isset ( $_GET ['msg'] ))
					echo $_GET ['msg'];
				?>
            </strong>
		</p>
		<div>
			<br />
			<form id="frmTimKiem" action="" method="POST">
				Danh mục: <select name="selectDM" id="selectDM">
							<option value="0">Tất cả danh mục</option>
	            			<?php
							$queryDM 	= "SELECT * FROM category";
							$resultDM 	= $mysqli->query ( $queryDM );
							while ( $arrDM = mysqli_fetch_assoc ( $resultDM ) ) {
								$idDM 	= $arrDM ['IdCat'];
								$nameDM = $arrDM ['NameCat'];
								$str 	= null;
								if (isset ( $idt )) {
									if ($idDM == $idt)
										$str = "selected = 'selected'";
								}
								?>
	            		  	<option value="indexNews.php?idt=<?php echo $idDM?>"
							<?php echo $str?>><?php echo $nameDM?></option>
	            		  	<?php }?>
            		 	 </select>
            	Tìm kiếm: 	<input type="search" id="txtSearch" name="txtSearch" placeholder="<?php echo $txtsearch?>" /> 
							<input type="submit" id="btnSearch" name="Search" value="Tìm kiếm" /> 
							<input type="submit" id="showall" name="showall" value="Hiển thị tất cả" />
				<br />
			</form>
			<script type="text/javascript">
						var menu=document.getElementById("selectDM");
						menu.onchange=function() 
						{
							var chosenoption=this.options[this.selectedIndex];
							if (chosenoption.value!=0) 
							{
								var val = chosenoption.value;
								document.location.href=val;
							}
							else
							{
								document.location.href="indexNews.php?idt=";
							}
						}
			</script>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="grid_12">
	<!-- Example table -->
	<div class="module">
		<h2>
			<span>Danh sách tin</span>
		</h2>
		<div class="module-table-body">
			<form action="" method="post" name="frm-del" id="frm-del">
				<table id="myTable" class="tablesorter">
					<thead>
						<tr>
							<th style="width: 4%; text-align: center;">ID</th>
							<th style="width: 20%">Tên</th>
							<th style="width: 15%">Danh mục</th>
							<th style="width: 10%">Ngày đăng</th>
							<th style="width: 10%">Người đăng</th>
							<th style="width: 15%; text-align: center;">Hình ảnh</th>
							<th style="width: 5%; text-align: center;">Chức năng</th>
							<th style="width: 5%; text-align: center;"><input type="submit"
								name="del" id="del" onclick="return confirm('Xác nhận xóa')"
								value="Xóa" /> 
								<input type="checkbox" id="selecctall"/>
							</th>
						</tr>
					</thead>
					<tbody>
                            <?php
								while ( $arTT = mysqli_fetch_assoc ( $resultTT ) ) {
									$ID_DanhMucTin 	= $arTT ['IdCat'];
									$TenDanhMucTin 	= $arTT ['NameCat'];
									$ID_TinTuc 		= $arTT ['IdNews'];
									$TenTinTuc 		= $arTT ['NameNews'];
									$MoTa			= $arTT ['Description'];
									$HinhAnh 		= $arTT ['Picture'];
									$ChiTiet 		= $arTT ['Detail'];
									$date 			= $arTT ['DateCreat'];
									$NguoiDang 		= $arTT ['CreatBy'];
									$urlPic = "/files/" . $HinhAnh;
							?>
                        <tr>
							<td class="align-center"><?php echo $ID_TinTuc?></td>
							<td><a href="editNews.php?idtt=<?php echo $ID_TinTuc?>"><?php echo $TenTinTuc?></a></td>
							<td><?php echo $TenDanhMucTin?></td>
							<td><?php echo $date?></td>
							<td><?php echo $NguoiDang?></td>
							<td align="center">
                                    	<?php if($HinhAnh!=""){?>
                                    	<img src="<?php echo $urlPic?>"
								class="hoa" />
                                    	<?php }else echo "Không có hình ảnh.";?>
                                    </td>
							<td align="center"><a
								href="editNews.php?idtt=<?php echo $ID_TinTuc?>">Sửa <img
									src="/templates/admin/images/pencil.gif" alt="edit" /></a></td>
							<td align="center">
								<input type="checkbox" class="checkbox1" value="<?php echo $ID_TinTuc;?>" name="item<?php $dem++?>" />
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
                            	<a href="indexNews.php?page=<?php echo $i?>&&txtSearch=<?php echo $txtsearch?>&&idt=<?php echo $idt?>" <?php echo $active?>> 
                            		<span>Trang:</span> 
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