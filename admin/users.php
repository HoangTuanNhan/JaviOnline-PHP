<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkAdmin.php';//chỉ admin mới dc vào?>
<?php
$query = "SELECT * FROM users";
$result = $mysqli->query($query); 
?>
            <div class="bottom-spacing">
                  <!-- Button -->
                  <div class="float-left">
                      <a href="/admin/addUser.php" class="button">
                      	<span>Thêm người dùng <img src="/templates/admin/images/plus-small.gif" alt="Thêm tin"></span>
                      </a>
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
                	<h2><span>Danh sách người dùng</span></h2>
                    
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:4%; text-align: center;">ID</th>
                                    <th style="width:20%">Tên tài khoản</th>
                                    <th style="width:20%">Họ và tên</th>
                                    <th style="width:16%; text-align: center;">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php while($arrUser = mysqli_fetch_assoc($result)){
                            		$id_user 	= $arrUser['IdUser'];
                            		$username 	= $arrUser['username'];
                            		$fullname 	= $arrUser['FullName'];
                            		?>
                                <tr>
                                    <td class="align-center"><?php echo $id_user?></td>
                                    <td><a href="editUser.php?uid=<?php echo $id_user?>"><?php echo $username?></a></td>
                                    <td><?php echo $fullname?></td>
                                    <td align="center">
                                        <a href="editUser.php?uid=<?php echo $id_user?>">Sửa <img src="/templates/admin/images/pencil.gif" alt="edit" /></a>
                                        <?php if($username!='admin'){?>
                                        <a href="deleteUser.php?uid=<?php echo $id_user?>">Xóa <img src="/templates/admin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                        <?php }?>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        </form>
                     </div> <!-- End .module-table-body -->
                </div> <!-- End .module -->
                
			</div> <!-- End .grid_12 -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/footer.php';?>   