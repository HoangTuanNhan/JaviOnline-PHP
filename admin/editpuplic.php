<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
$IdPub 		= $_GET['idtt'];
$queryTT 	= "SELECT * FROM puplic WHERE IdPub = $IdPub";
$resultTT 	= $mysqli->query($queryTT);
$arTT 		= mysqli_fetch_assoc($resultTT);
$Name 		= $arTT['Name'];
$Link 		= $arTT['Link'];
$Photo 		= $arTT['Photo'];
?>
<?php 
///lấy dữ liệu mới từ người dùng nhập vào
if(isset($_POST['sua'])){
	$Name = $mysqli->real_escape_string($_POST['Name']);
	$Link = $mysqli->real_escape_string($_POST['Link']);
	//xử lý tên ảnh
	$newname = $Photo;
	if($_FILES['Photo']['name']!=""){
		$time 			= time();
		$name 			= $_FILES['Photo']['name'];
		$arrName 		= explode('.', $name);
		$extend 		= $arrName[count($arrName)-1];
		$newname 		= "file-$time.".$extend;
		$filename 		= $_FILES['Photo']['tmp_name'];
		$destination 	= $_SERVER['DOCUMENT_ROOT']."/files/".$newname;
		move_uploaded_file($filename, $destination);
		//xóa ảnh cũ
		$anhcu = $_SERVER['DOCUMENT_ROOT']."/files/".$Photo;
		unlink($anhcu);
	}
	//truy van du lieu
	$queryUPDATE = "UPDATE puplic SET 
					Name = ('$Name'), Link = ('$Link'), Photo = ('$newname')
					WHERE IdPub = $IdPub LIMIT 1";
	$resultUPDATE = $mysqli->query($queryUPDATE);
	if($resultUPDATE){
		header("location:public.php?msg=Sửa thành công!");
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
					Link: {
						required: true,
					},
				},
				messages: {
					Name: {
						required: "<p class = 'eror'>Chưa nhập tên tin!</p>",
					},
					Link: {
						required: "<p class = 'eror'>Chưa nhập mô tả!</p>",
					},
				}
			});
		});
</script>
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Sửa quảng cáo</span></h2>
                        
                     <div class="module-body">
                        <form action="" method = "post" enctype="multipart/form-data" name = "frm-edit" id = "frm-edit">
                            <p>
                                <label>Tên</label>
                                <input type="text" class="input-medium" name = "Name" value="<?php echo $Name?>" />
                            </p>
                            <p>
                                <label>Link</label>
                                <input type="text" class="input-medium" name = "Link" value="<?php echo $Link?>" />
                            </p>
							<p>
                                <label>Hình ảnh</label>
                                <img src = "/files/<?php echo $Photo?>" width="100px" /><br />
                                <input type="file" class="input-medium" name = "Photo" value="<?php echo $Photo?>" />
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