<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/header.php"?>
<div class="body-left fl">
	<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/leftmenu.php"?>							
</div>
<?php 
//lấy dữ liệu từ người dùng.
if(isset($_POST['submit'])){
	$name = $mysqli->real_escape_string($_POST['HO_VA_TEN']);
	$email = $mysqli->real_escape_string($_POST['EMAIL']);
	$phone = $mysqli->real_escape_string($_POST['PHONE']);
	$website = $mysqli->real_escape_string($_POST['WEBSITE']);
	$content = $mysqli->real_escape_string($_POST['CONTENT']);
	$ngaylienhe = date('Y-m-d');
	//insert dữ liệu
	$query = "INSERT INTO contact(FullName,Email,Phone,Website,Content,DateCreate)
				VALUES('$name','$email','$phone','$website','$content','$ngaylienhe')";
	$result = $mysqli->query($query);
	if($result){
		header("location:index.php");exit();
	}
	else echo "Có lỗi.Vui lòng thử lại";
}
?>
<script type="text/javascript">
			$(document).ready(function(){
			$("#fcontact").validate({
				ignore: [],
	            debug: false,
				rules: {
					CONTENT:{
                        required: function() 
                       {
                        CKEDITOR.instances.CONTENT.updateElement();
                       },
                       minlength:20,
                   },
                   HO_VA_TEN: {
						required: true,
					},
					EMAIL: {
						required: true,
						email:true,
					},
					PHONE: {
						required: true,
						number:true,
					},
					WEBSITE: {
						required: true,
					},
				},
				messages: {
					CONTENT:{
                        required:"<p class ='eror'>Chưa nhập nội dung.</p>",
                        minlength:"<p class ='eror'>Nội dung bạn nhập bé hơn 20 ký tự.</p>",
                    },
                    HO_VA_TEN: {
						required: "<p class = 'eror'>Chưa nhập tên</p>",
					},
					EMAIL: {
						required: "<p class = 'eror'>Chưa nhập email</p>",
						email:"<p class = 'eror'>Định dạng email chưa đúng.</p>",
					},
					PHONE: {
						required: "<p class = 'eror'>Chưa nhập số điện thoại</p>",
						number: "<p class = 'eror'>Số điện thoại không hợp lệ</p>",
					},
					WEBSITE: {
						required: "<p class = 'eror'>Chưa nhập số điện thoại</p>",
					},
				}
			});
		});
</script>
<div class="body-right fr">
	<div class="news-block">
		<h2 class="title-cat">Liên hệ</h2>
		<div class="content-cat1">
			<div class="content-detail">
				<div class="FromBox">
					<h4>Liên hệ javionline.net</h4>
					<form name="fcontact" method="post" action="" id="fcontact"
						enctype="multipart/form-data" novalidate="novalidate">

						<div class="FieldRow">
							<label>Họ và tên:<span class="RSM_form_star_color">(*)</span></label>
							<input type="text" value="" class="" maxlength="50"
								name="HO_VA_TEN" id="HO_VA_TEN">
						</div>

						<div class="FieldRow">
							<label>Email:<span class="RSM_form_star_color">(*)</span></label>
							<input type="text" value="" class="" maxlength="50" name="EMAIL"
								id="EMAIL">
						</div>

						<div class="FieldRow">
							<label>Điện thoại:</label> <input type="text" value="" class=""
								maxlength="50" name="PHONE" id="PHONE">
						</div>

						<div class="FieldRow">
							<label>Website:</label> <input type="text" value="" class=""
								maxlength="50" name="WEBSITE" id="WEBSITE">
						</div>

						<div class="FieldRow">
							<label>Nội dung:<span class="RSM_form_star_color">(*)</span></label>
							<textarea class="ckeditor" style="width: 100%; height: 140px;"
								name="CONTENT" id="CONTENT"></textarea>
						</div>


						<div class="FieldRow" style="margin-top: 24px;">
							<input class="button_submit" type="submit" id="submit"
								name="submit" value="Gửi liên hệ"> <input class="button_submit"
								type="reset" id="submit" name="submit" value="Nhập lại">
						</div>

					</form>
				</div>


			</div>
		</div>
	</div>

</div>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/javionline/templates/public/inc/footer.php"?>