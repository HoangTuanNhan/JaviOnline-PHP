<?php
//trường hợp chỉ một người dùng vào dc một profile của người đó..trừ admin.
if ($_SESSION ['user'] ['username'] != 'admin') {
	if ($uid != $_SESSION ['user'] ['id_user']) {
		echo "<p class='eror'>Không hợp lệ!!</p>";
		die ();
	}
}
?>