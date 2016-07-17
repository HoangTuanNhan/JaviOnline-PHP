<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
///lấy dữ liệu mới từ người dùng nhập vào
if(isset($_POST['sua'])){
	$_SESSION['phantrang']['public']	=$_POST['phantrangpublic'];
	$_SESSION['phantrang']['admin']		=$_POST['phantrangadmin'];
	header("location:phantrang.php?msg=Đã Reset lại phân trang.");
}
?>
            <div class="grid_12">
                <div class="module">
                	<?php if(isset($_GET['msg'])){
                		$msg = $_GET['msg'];
                		echo "<p style = 'color:green'><strong>$msg</strong></p>";
                	}
                		?>
                     <h2><span>Sửa phân trang</span></h2>
                     <div class="module-body">
                        <form action="" method = "post" enctype="multipart/form-data" name = "frm-edit" id = "news">
                            <p>
                                <label class = 'eror'>Phân trang giao diện public</label>
                                <select name = "phantrangpublic">
                                	<?php for($i=1;$i<=10;$i++){
                                		if($i==5){	//trường hợp người dùng chưa reset phần phân trang thì hiển thị số phân trang mặc định trong thẻ option	
                                			$selectphantrang = "selected = 'selected'";
                                		}else $selectphantrang=null;
                                		if(isset($_SESSION['phantrang'])){	//trường hợp đã reset phân trang và tồn tại sesion phân trang
                                			if($i==$_SESSION['phantrang']['public']){		//hiển thị số phân trang mới trong thẻ option
                                				$selectphantrang = "selected = 'selected'";
                                			}else $selectphantrang = null;
                                		}
                                		?>
                                		<option value = "<?php echo $i?>" <?php echo $selectphantrang?>><?php echo $i?></option>
                                	<?php }?>
                                </select><br />
                                <label class = 'eror'>Phân trang admin</label>
                                <select name = "phantrangadmin">
                                	<?php for($i=1;$i<=10;$i++){	//tương tự như phần phân trang puplic ở trên
                                		if($i==5){
                                			$selectphantrang = "selected = 'selected'";
                                		}else $selectphantrang=null;
                                		if(isset($_SESSION['phantrang'])){
                                			if($i==$_SESSION['phantrang']['admin']){
                                				$selectphantrang = "selected = 'selected'";
                                			}else $selectphantrang = null;
                                		}
                                		?>
                                		<option value = "<?php echo $i?>" <?php echo $selectphantrang?>><?php echo $i?></option>
                                	<?php }?>
                                </select>
                            </p>
                            <fieldset>
                                <input class="submit-green" type="submit" value="Sửa" name = "sua" /> 
                            </fieldset>
                        </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div> <!-- End .grid_12 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?> 