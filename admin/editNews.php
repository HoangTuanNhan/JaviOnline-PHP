<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php 
$ID_TinTuc 	= $_GET['idtt'];
$queryDMT 	= "SELECT * FROM category";
$resultDMT 	= $mysqli->query ( $queryDMT );
$queryTT 	= "SELECT * FROM news WHERE IdNews = $ID_TinTuc";
$resultTT 	= $mysqli->query($queryTT);
$arTT 		= mysqli_fetch_assoc($resultTT);
$ID_TinTuc 	= $arTT['IdNews'];
$TenTinTuc 	= $arTT['NameNews'];
$MoTa 		= $arTT['Description'];
$ChiTiet 	= $arTT['Detail'];
$idc 		= $arTT['IdCat'];
$HinhAnh 	= $arTT['Picture'];
$ngaydang 	= $arTT['DateCreat'];
$arngaydang = explode("-", $ngaydang);
?>
<?php 
///lấy dữ liệu mới từ người dùng nhập vào
if(isset($_POST['sua'])){
	$tentintuc 	= $mysqli->real_escape_string($_POST['tentintuc']);
	$danhmuc 	= $_POST['danhmuc'];
	$mota 		= $mysqli->real_escape_string($_POST['mota']);
	$chitiet 	= $mysqli->real_escape_string($_POST['chitiet']);
	//lấy ngày tháng
	$day 		= $_POST['day'];
	$month 		= $_POST['month'];
	$year 		= $_POST['year'];
	$ngaydangmoi 	= "$year-$month-$day";
	$nguoidang 		= $_SESSION['user']['fullname'];
	//ten hinh
	$hinhanhsua 	= $HinhAnh;
	if($_FILES['hinhanh']['name']!=""){
		$hinhanhsua = $_FILES['hinhanh']['name'];
		$time 		= time();
		$arName 	= explode(".", $hinhanhsua);
		//lấy phần mở rộng
		$phanmorong = $arName[count($arName)-1];
		$hinhanhsua = "file-$time.".$phanmorong;
		$filename 		= $_FILES['hinhanh']['tmp_name'];
		$destination 	= $_SERVER['DOCUMENT_ROOT']."/files/".$hinhanhsua;
		move_uploaded_file($filename, $destination);
		//xóa ảnh cũ
		$anhcu = $_SERVER['DOCUMENT_ROOT']."/files/".$HinhAnh;
		unlink($anhcu);
	}
	//truy van du lieu
	$queryUPDATE = "UPDATE news SET 
					NameNews = ('$tentintuc'), IdCat = $danhmuc, Description = ('$mota') ,Detail = ('$chitiet'),
					Picture=('$hinhanhsua'),DateCreat = ('$ngaydangmoi'),CreatBy = ('$nguoidang')
					WHERE IdNews = $ID_TinTuc LIMIT 1";
	$resultUPDATE = $mysqli->query($queryUPDATE);
	if($resultUPDATE){
		header("location:indexNews.php?msg=Sửa thành công!");
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
				ignore: [],
	            debug: false,
				rules: {
					chitiet:{
                        required: function() 
                       {
                        CKEDITOR.instances.chitiet.updateElement();
                       },
                       minlength:20,
                   },
					tentintuc: {
						required: true,
					},
					mota: {
						required: true,
					},
				},
				messages: {
					chitiet:{
                        required:	"<p class ='eror'>Chưa nhập chi tiết tin.</p>",
                        minlength:	"<p class ='eror'>Chi tiết tin phải lớn hơn 20 ký tự</p>",
                    },
					tentintuc: {
						required: 	"<p class = 'eror'>Chưa nhập tên tin!</p>",
					},
					mota: {
						required: 	"<p class = 'eror'>Chưa nhập mô tả!</p>",
					},
				}
			});
		});
</script>
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Sửa tin tức</span></h2>
                        
                     <div class="module-body">
                        <form action="" method = "post" enctype="multipart/form-data" name = "frm-edit" id = "frm-edit">
                            <p>
                                <label>Tên tin tức</label>
                                <input type="text" class="input-medium" name = "tentintuc" value="<?php echo $TenTinTuc?>" />
                            </p>
                            <p>
                                <label>Tên danh mục tin</label>
                                <select name = "danhmuc">
                                	<?php while($arDMT = mysqli_fetch_assoc($resultDMT)){
                                		$TenDanhMucTin = $arDMT['NameCat'];
                                		$ID_DanhMucTin =  $arDMT['IdCat'];
                                		if($idc == $ID_DanhMucTin){
                                			$select = 'selected = "selected"';
                                		}
                                		else $select = null;
                                		?>
                                	<option value = "<?php echo $ID_DanhMucTin?>" <?php echo $select?> class = "input-short"><?php echo $TenDanhMucTin?></option>
                                	<?php }?>
                                </select>
                            </p>
                            <p>
                                <label>Ngày đăng</label>
                                <?php 
                                		$arNgay 	= range(1, 31);
                                		$arThang 	= range(1, 12);
                                		$arNam 		= range(2010, 2016);
                                ?>
                                <select name = "day">
                                	<?php foreach($arNgay as $key=>$ngay){
                                		if($ngay == $arngaydang[2]){
                                			$select = "selected = 'selected'";
                                		}
                                		else $select = null;
                                		?>
                                		<option value = '<?php echo $ngay?>' class="input-short" <?php echo $select?>><?php echo $ngay?></option>
                                	<?php }?>
                                </select>/
                                <select name = "month">
                                	<?php foreach($arThang as $key=>$thang){
                                		if($thang == $arngaydang[1]){
                                			$select = "selected = 'selected'";
                                		}
                                		else $select = null
                                		?>
                                		<option value = '<?php echo $thang?>' class="input-short" <?php echo $select?>><?php echo $thang?></option>
                                	<?php }?>
                                </select>/
                                <select name = "year">
                                	<?php foreach($arNam as $key=>$nam){
                                		if($nam == $arngaydang[0]){
                                			$select = "selected = 'selected'";
                                		}
                                		else $select = null
                                		?>
                                		<option value = '<?php echo $nam?>' class="input-short" <?php echo $select?>><?php echo $nam?></option>
                                	<?php }?>
                                </select>
                            </p>
							<p>
                                <label>Hình ảnh</label>
                                <br />
                                <?php if($HinhAnh!=""){?>
                                <img src="/files/<?php echo $HinhAnh?>" alt="" width="100px" /><br />
                                <?php }?>
                                <input type="file" value="" name = "hinhanh" />
                            </p>                       
                            <p>
                                <label>Mô tả</label>
                                <textarea rows="7" cols="90" class="input-medium" name = "mota"><?php echo $MoTa?></textarea>
                            </p>
                            <p>
                                <label>Chi tiết</label>
                                <textarea class = "ckeditor" rows="7" cols="90" class="input-medium" name = "chitiet"><?php echo $ChiTiet?></textarea>
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