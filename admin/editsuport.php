<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
$IdSup 		= $_GET['idtt'];
$queryTT 	= "SELECT * FROM suport WHERE IdSup = $IdSup";
$resultTT 	= $mysqli->query($queryTT);
$arTT 		= mysqli_fetch_assoc($resultTT);
$Name 		= $arTT['Name'];
$yahoo 		= $arTT['yahoo'];
$skyper 	= $arTT['skyper'];
?>
<?php 
///lấy dữ liệu mới từ người dùng nhập vào
if(isset($_POST['sua'])){
	$Name 	= $mysqli->real_escape_string($_POST['Name']);
	$yahoo 	= $_POST['yahoo'];
	$skyper = $_POST['skyper'];
	//truy van du lieu
	$queryUPDATE 	= "UPDATE suport SET 
					Name = ('$Name'), yahoo = ('$yahoo'), skyper = ('$skyper')
					WHERE IdSup = $IdSup LIMIT 1";
	$resultUPDATE 	= $mysqli->query($queryUPDATE);
	if($resultUPDATE){
		header("location:suport.php?msg=Sửa thành công!");
		exit();
	}
	else{
		echo "Sửa tin không thành công";
	}
}
?>
<script type="text/javascript">
			$(document).ready(function(){
			$("#frm-edit").validate({
				rules: {
					Name: {
						required: true,
					},
					yahoo: {
						required: true,
						email:true,
					},
					skyper: {
						required: true,
						minlength:6,
					},
				},
				messages: {
					Name: {
						required: "<p class = 'eror'>Chưa nhập tên tin!</p>",
					},
					yahoo: {
						required: "<p class = 'eror'>Chưa nhập mô tả!</p>",
						email: "<p class = 'eror'>Email không hợp lệ</p>",
					},
					skyper: {
						required: "<p class = 'eror'>Chưa nhập chi tiết!</p>",
						minlength: "<p class = 'eror'>Skyper quá ngắn</p>",
					},
				}
			});
		});
</script>
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Sửa hỗ trợ online</span></h2>
                        
                     <div class="module-body">
                        <form action="" method = "post" enctype="multipart/form-data" name = "frm-edit" id = "frm-edit">
                            <p>
                                <label>Họ tên</label>
                                <input type="text" class="input-medium" name = "Name" value="<?php echo $Name?>" />
                            </p>
                            <p>
                                <label>Yahoo</label>
                                <input type="text" class="input-medium" name = "yahoo" value="<?php echo $yahoo?>" />
                            </p>
							<p>
                                <label>Skyper</label>
                                <input type="text" class="input-medium" name = "skyper" value="<?php echo $skyper?>" />
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