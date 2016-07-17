<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php
$queryDMT 	= "SELECT * FROM loaihoa";
$resultDMT 	= $mysqli->query ( $queryDMT );
if (isset ( $_POST ['them'] )) {
	//lay du lieu tu nguoi dung && loc loi
	$tentin 	= $mysqli->real_escape_string($_POST ['tentin']);
	$danhmuc 	= $_POST ['danhmuc'];
	$hinhanh 	= "";
	//xu ly hinh anh
	if($_FILES['hinhanh']['name']!=""){
		$hinhanh 	= $_FILES['hinhanh']['name'];
		$time 		= time();
		$arrName 	= explode(".", $hinhanh);
		//lay phan mo rong
		$PhanMoRong = $arrName[count($arrName)-1];
		$hinhanh 	= "file-$time.".$PhanMoRong;
		$filename 	=  $_FILES['hinhanh']['tmp_name'];
		$destination 	= $_SERVER['DOCUMENT_ROOT']."/files/".$hinhanh;
		$resultUPhinh 	= move_uploaded_file($filename, $destination);
	}
	$ngaydang 	= date('Y-m-d');
	$nguoidang 	= $_SESSION['user']['fullname'];
	$mota 		= $mysqli->real_escape_string($_POST ['mota']);
	$chitiet 	= $mysqli->real_escape_string($_POST ['chitiet']);
	//tao truy van them tin vao database
	$queryINSERT = "INSERT INTO news(NameNews,IdCat,Picture,Description,Detail,CreatBy,DateCreat)
					VALUES ('$tentin',$danhmuc,'$hinhanh','$mota','$chitiet','$nguoidang','$ngaydang')";
	//thuc hien truy van
	$resultINSERT = $mysqli->query($queryINSERT);
	//chuyen trang khi thanh cong
	if($resultINSERT){
		header ( "location:indexNews.php?msg=Thêm thành công!" );
	}
	else{
		echo("co loi trong qua trinh them");
	}	
}
?>
<script type="text/javascript">
			$(document).ready(function(){
			$("#frm-news").validate({
				ignore: [],
	            debug: false,
				rules: {
					tentin: {
						required: true,
					},
					mota: {
						required: true,
					},
					chitiet: {
						required: function() 
	                       {
	                        CKEDITOR.instances.chitiet.updateElement();
	                       },
					},
					
				},
				messages: {
					tentin: {
						required: "<p class = 'eror'>Chưa nhập tên tin!</p>",
					},
					mota: {
						required: "<p class = 'eror'>Chưa nhập mô tả!</p>",
					},
					chitiet: {
						required: "<p class = 'eror'>Chưa nhập chi tiết!</p>",
					},
				}
			});
		});
</script>
<!-- Form elements -->
<div class="grid_12">

	<div class="module">
		<h2>
			<span>Thêm tin tức</span>
		</h2>

		<div class="module-body">
			<form action="" method="post" name="frm-news" id = "frm-news"
				enctype="multipart/form-data">
				<p>
					<label>Tên tin</label> <input type="text" name="tentin" value=""
						class="input-medium" />
				</p>
				<p>
					<label>Danh mục tin</label> <select name="danhmuc"
						class="input-short">
						<?php
						
						while ( $arDMT = mysqli_fetch_assoc ( $resultDMT ) ) {
							$ID_DanhMucTin = $arDMT ['IdCat'];
							$TenDanhMucTin = $arDMT ['NameCat'];
							?>
						<option value="<?php echo $ID_DanhMucTin?>"><?php echo $TenDanhMucTin?></option>
						<?php }?>
					</select>
				</p>
				<p>
					<label>Hình ảnh</label> <input type="file" name="hinhanh" value="" />
				</p>
				<p>
					<label>Mô tả</label>
					<textarea name="mota" rows="7" cols="90" class="input-medium"></textarea>
				</p>
				<p>
					<label>Chi tiết</label>
					<textarea  class="ckeditor" name="chitiet" rows="7" cols="90" class="input-long"></textarea>
				</p>
				<fieldset>
					<input class="submit-green" name="them" type="submit" value="Thêm" />
					<input class="submit-gray" name="reset" type="reset"
						value="Nhập lại" />
				</fieldset>
			</form>
		</div>
		<!-- End .module-body -->

	</div>
	<!-- End .module -->
	<div style="clear: both;"></div>
</div>
<!-- End .grid_12 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?>  