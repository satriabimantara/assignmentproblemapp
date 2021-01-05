<?php
//url dasar
define('BASEURL', 'http://localhost/ro/main');

//DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ro');
$koneksi = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
?>