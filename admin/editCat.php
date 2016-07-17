<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
$cid 			= $_GET['cid'];
$queryDMT 		= "SELECT * FROM category WHERE IdCat = $cid";
$resultDMT 		= $mysqli->query ( $queryDMT );
$arDMT 			= mysqli_fetch_assoc($resultDMT);
$TenDanhMucTin 	= $arDMT['NameCat'];
?>
<?php 
///lấy dữ liệu mới từ người dùng nhập vào
if(isset($_POST['sua'])){
	$tendanhmuc = $mysqli->real_escape_string($_POST['danhmuc']);
	//truy van du lieu
	$queryUPDATE	= "UPDATE category SET 
					NameCat = ('$tendanhmuc')
					WHERE IdCat = $cid LIMIT 1";
	$resultUPDATE 	= $mysqli->query($queryUPDATE);
	if($resultUPDATE){
		header("location:indexCat.php?msg=Sửa thành công!");
		exit();
	}
	else{
		echo "Sửa tin không thành công";
	}
}
?>
<script type="text/javascript">
			$(document).ready(function(){
			$("#news").validate({
				rules: {
					danhmuc: {
						required: true,
					},
					
				},
				messages: {
					danhmuc: {
						required: "<p class = 'eror'>Bạn chưa nhập danh mục</p>",
					},
				}
			});
		});
</script>
            <div class="grid_12">
                <div class="module">
                     <h2><span>Sửa tên danh mục</span></h2>
                     <div class="module-body">
                        <form action="" method = "post" enctype="multipart/form-data" name = "frm-edit" id = "news">
                            <p>
                                <label>Tên danh mục</label>
                                <input type="text" class="input-medium" name = "danhmuc" value="<?php echo $TenDanhMucTin?>" />
                            </p>
                            <fieldset>
                                <input class="submit-green" type="submit" value="Sửa" name = "sua" /> 
                                <input class="submit-gray" type="submit" value="Nhập lại" />
                            </fieldset>
                        </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div> <!-- End .grid_12 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?> 