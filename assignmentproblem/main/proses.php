<?php
$baris = $_SESSION['informasi']['baris'];
$nomorBaris = $_SESSION['informasi']['nomorBaris'];
$kolom =$_SESSION['informasi']['kolom'];
$nomorKolom = $_SESSION['informasi']['nomorKolom'];
$tujuan = $_SESSION['informasi']['tujuan'];
$typeBaris = array();
$typeKolom = array();
//memberikan nama sesuai yang dipilih user (baris)
if ($nomorBaris == "baris1") {
	for ($i=0; $i < $baris; $i++) {
		$string = chr($i+65); 
		array_push($typeBaris, $string);
	}
}elseif ($nomorBaris=="baris2") {
	for ($i=0; $i < $baris; $i++) {
		array_push($typeBaris, ($i+1));
	}
}elseif ($nomorBaris=="baris3") {
	for ($i=0; $i < $baris; $i++) {
		$string = "Job ".($i+1); 
		array_push($typeBaris, $string);
	}
}
// memberikan nama sesuai yang dipilih user (kolom)
if ($nomorKolom == "kolom1") {
	for ($i=0; $i < $kolom; $i++) {
		$string = chr($i+65); 
		array_push($typeKolom, $string);
	}
}elseif ($nomorKolom=="kolom2") {
	for ($i=0; $i < $kolom; $i++) {
		array_push($typeKolom, ($i+1));
	}
}elseif ($nomorKolom=="kolom3") {
	for ($i=0; $i < $kolom; $i++) {
		$string = "Mesin ".($i+1); 
		array_push($typeKolom, $string);
	}
}
// Algoritma penugasan
//1. cek jumlah baris atau kolom, jika sama maka seimbang, jika tidak maka ada variabel dummy
if ($baris==$kolom) {
	require_once 'prosesSeimbang.php';
}elseif ($baris!==$kolom) {
	//metode dummy
	require_once 'prosesTidakSeimbang.php';
}
?>
