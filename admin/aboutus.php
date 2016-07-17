<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php
$query = "SELECT * FROM aboutus";
$result = $mysqli->query($query); 
$arAu = mysqli_fetch_assoc($result);
$NameAbout = $arAu['NameAbout'];
$IdAu = $arAu['IdAu'];
?>
            <div class="bottom-spacing">
                  <!-- Button -->
                  <div class="float-left">
                      <p style = "color:green"><strong>
                      	<?php if(isset($_GET['msg']))
                      		echo $_GET['msg'];
                      		?>
                      </strong></p>
                  </div>
                  <div class="clear"></div>
            </div>
            
            <div class="grid_12">
                <!-- Example table -->
                <div class="module">
                	<h2><span>Giới thiệu về chúng tôi</span></h2>
                    
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:15%">Tên</th>
                                    <th style="width:11%;r;">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center"><a href = "editAu.php"><?php echo $NameAbout?></a></td>
                                    <td align="center">
                                        <a href="editAu.php">Sửa <img src="/templates/admin/images/pencil.gif" alt="edit" /></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </form>
                     </div> <!-- End .module-table-body -->
                </div> <!-- End .module -->
			</div> <!-- End .grid_12 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?>   