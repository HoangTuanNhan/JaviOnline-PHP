<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/templates/admin/inc/header.php';?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/javionline/functions/checkUser.php';?>
<?php
$query 	= "SELECT * FROM category";
$result = $mysqli->query($query); 
?>
            <div class="bottom-spacing">
                  <!-- Button -->
                  <div class="float-left">
                      <a href="/javionline/admin/addCats.php" class="button">
                      	<span>Thêm danh mục <img src="/javionline/templates/admin/images/plus-small.gif" alt="Thêm tin"></span>
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
                	<h2><span>Danh sách danh mục</span></h2>
                    
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:4%; text-align: center;">ID</th>
                                    <th style="width:20%">Danh mục</th>
                                    <th style="width:11%;r;">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php while($arTT = mysqli_fetch_assoc($result)){
                            		$ID_DanhMucTin 	= $arTT['IdCat'];
                            		$TenDanhMucTin 	= $arTT['NameCat'];
                            		?>
                                <tr>
                                    <td class="align-center"><?php echo $ID_DanhMucTin?></td>
                                    <td><?php echo $TenDanhMucTin?></td>
                                    <td align="center">
                                        <a href="editCat.php?cid=<?php echo $ID_DanhMucTin?>">Sửa <img src="/templates/admin/images/pencil.gif" alt="edit" /></a>
                                        <a href="deleteCat.php?cid=<?php echo $ID_DanhMucTin?>" onclick = "return confirm('Xác nhận xóa');">Xóa <img src="/templates/admin/images/bin.gif" width="16" height="16" alt="delete" /></a>
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