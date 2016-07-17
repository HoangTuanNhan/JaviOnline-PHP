<?php
// khoi tao doi tuong
$mysqli = new mysqli ( "localhost", "root", "", "news" );
// thiet lap font chu tieng viet
$mysqli->set_charset ( "utf8" );
// hien thi thong bao loi neu co
if (mysqli_connect_errno ()) {
	echo "khong the ket noi toi database." . mysqli_connect_errno ();
	exit ();
}
?>