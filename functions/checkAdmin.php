<?php
//phân quyền admin
if (( $_SESSION ['user'] ['username'] ) != 'admin') {
	echo "<p class='eror'>Đây là quyền admin!</p>";
	die ();
}
?>