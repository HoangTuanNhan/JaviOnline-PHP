<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
$query 		= "SELECT * FROM aboutus";
$result 	= $mysqli->query ( $query);
$ar 		= mysqli_fetch_assoc($result);
$gioithieu 	= $ar['Description'];
?>
<?php 
///lấy dữ liệu mới từ người dùng nhập vào
if(isset($_POST['sua'])){
	$gioithieumoi 	= $mysqli->real_escape_string($_POST['gioithieu']);
	//truy van du lieu
	$queryUPDATE 	= "UPDATE aboutus SET 
					Description = ('$gioithieumoi')";
	$resultUPDATE 	= $mysqli->query($queryUPDATE);
	if($resultUPDATE){
		header("location:aboutus.php?msg=Sửa thành công!");
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
				ignore: [],
	            debug: false,
				rules: {
					gioithieu:{
                        required: function() 
                       {
                        CKEDITOR.instances.gioithieu.updateElement();
                       },
                       minlength:20,
                   }
				},
				messages: {
					gioithieu:{
                        required:"<p class ='eror'>Chưa nhập lời giới thiệu.</p>",
                        minlength:"<p class ='eror'>Giới thiệu quá ngắn.</p>",
                    }
				},
			});
		});
</script>
            <div class="grid_12">
                <div class="module">
                     <h2><span>Sửa lời giới thiệu</span></h2>
                     <div class="module-body">
                        <form action="" method = "post" enctype="multipart/form-data" name = "frm-edit" id = "news">
                            <p>
                                <label>Lời giới thiệu</label>
                                <textarea id = "gioithieu" class = "ckeditor" rows="7" cols="90" class="input-medium" name = "gioithieu" class="input-medium"><?php echo $gioithieu?></textarea>
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