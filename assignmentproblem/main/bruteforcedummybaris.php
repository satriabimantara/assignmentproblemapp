<?php
// Cek tujuan objective yang diinputkan user, jika minimum atau maksimum
if ($_SESSION['informasi']['tujuan']=="min") {
	//lakukan brute force untuk minimum yaitu mencari solusi minimum terbaik dari permutasi yang ada
	$allPermutation=array(); //array yang akan menampung semua daftar permutasi yang mungkin dari array $indeksKolomYangInginDipermutasi
	$daftarPermutasidariTotalNilaiSetiapPermutasi = array(); 
	$indeksKolomYangInginDipermutasi = array();
	$totalNilaiSetiapPermutasi=array(); //menampung total penjumlah nilai matriksnya untuk setiap permutasinya
	// Memasukan indeks kolom ke dalam array indeksKolomYangInginDipermutasi yang nantinya akan dilakukan permutasi
	/*
	Misal : jumlah kolom = 3
	(0,1,2) akan dimasukan ke dalam array indeksKolomYangInginDipermutasi
	array ini yang nantinya akan dipermutasi
	*/
	for ($i=0; $i < $_SESSION['informasi']['kolom']; $i++) { 
		array_push($indeksKolomYangInginDipermutasi, $i);
	}
	$length = count($indeksKolomYangInginDipermutasi); //menampung panjang array
	// Memanggil fungsi permutasi
	permute($indeksKolomYangInginDipermutasi, 0, $length - 1,$allPermutation);
	$nilai = $_SESSION['nilai'];
	/*
	Karena allPermutation adalah array di dalam array yang mengandung semua daftar permutasi yang ada perindeksnya, maka lakukan perulangan untuk membuka array di dalam array dengan foreach
	*/
	foreach ($allPermutation as $perPermutasi) {
		$rowMatriks = 0;
		$tempJumlahNilaiMatriks=0; 
		$arraySetiapPermutasi = array();
		/*
		Array kedua dari allPermutation juga masih berupa array dan lakukan perulangan untuk mendapatkan nilainya lebih spesifik.
		Pada perulangan ini akan dilakukan penjumlah nilai matriks berdasarkan indeks kolom sesuai permutasinya.
		Misal :
		permutasinya (2,0,1), maka
		m[0][2] + m[1][0] + m[1][1] --> nilai ini akan ditampung dan akan dibandingkan nantinya untuk semua kemungkinan permutasi tergantung tujuan objective, jika min cari yang paling minimum, jika max cari yang paling maksimum
		*/
		foreach ($perPermutasi as $colMatriks) {
			$tempJumlahNilaiMatriks+=$nilai[$rowMatriks][$colMatriks];
			array_push($arraySetiapPermutasi, $colMatriks); //memasukan nilai setiap permutasinya ke dalam arraySetiapPermutasi
			/*
			Misal colM=2, colM=1, colM=0,
			maka arraySetiapPermutasi [2,1,0]
			misal arraySetiapPermutasi nya [2,4,1,3], maka :
			m[0][2] = nilai matriks
			m[1][4] = nilai matriks
			m[2][1] = nilai matriks
			m[2][3] = nilai matriks
			*/
			// cek variabel $rowMatriks apakah tidak melebihi batas baris pada mtriks yang sudah ditambah 1 baris variabel dummy
			if ($rowMatriks<$_SESSION['informasi']['baris']) {
				$rowMatriks++;
			}
		}
		array_push($totalNilaiSetiapPermutasi, $tempJumlahNilaiMatriks);
		array_push($daftarPermutasidariTotalNilaiSetiapPermutasi,$arraySetiapPermutasi); //push array ke dalam array
	}
	$solusiOptimal = min($totalNilaiSetiapPermutasi); //karena tujuan min, maka cari yg paling minimum
	$indexMin = array_keys($totalNilaiSetiapPermutasi,$solusiOptimal); //mencari indeks dari array yg memuat solusiOptimal tadi
	$indeksTotalPermutasiTerkecil;
	//array_keys mengembalikan array jadi harus dibuka arraynya
	foreach ($indexMin as $keyMinimum) {
		$indeksTotalPermutasiTerkecil = $keyMinimum;
	}
	$count=0;
	$hasilAkhir = array(array());
	// Mencari daftarPermutasi yang menyebabkan nilai TotalNilaiSetiapPermutasi minimum dan jadikan permutasi tersebut sebagai rute tujuan akhirnya
	foreach ($daftarPermutasidariTotalNilaiSetiapPermutasi as $jalur) {
		if ($count!=$indeksTotalPermutasiTerkecil) {
			$count++;
		}else{
			$hasilAkhir['rute'] = $jalur;
			break;
		}
	}
	/*
	Isi dari variabel $hasilAkhir['rute'] :
	array(3) { [0]=> int(2) [1]=> int(0) [2]=> int(1) }
	s	*/
	$hasilAkhir['solusiOptimal']= $solusiOptimal; //nilai minimum dari totalNilaiSetiapPermutasi
	$_SESSION['hasilAkhir'] = $hasilAkhir; //permutasi yang menyebabkan nlainya minimum, ini yang akan ditampilkan pada halaman solusiOptimal.php
}elseif ($_SESSION['informasi']['tujuan']=="max") {
	//lakukan brute force untuk minimum yaitu mencari solusi minimum terbaik dari permutasi yang ada
	$allPermutation=array(); //array yang akan menampung semua daftar permutasi yang mungkin dari array $indeksKolomYangInginDipermutasi
	$daftarPermutasidariTotalNilaiSetiapPermutasi = array(); 
	$indeksKolomYangInginDipermutasi = array();
	$totalNilaiSetiapPermutasi=array(); //menampung total penjumlah nilai matriksnya untuk setiap permutasinya
	// Memasukan indeks kolom ke dalam array indeksKolomYangInginDipermutasi yang nantinya akan dilakukan permutasi
	/*
	Misal : jumlah kolom = 3
	(0,1,2) akan dimasukan ke dalam array indeksKolomYangInginDipermutasi
	array ini yang nantinya akan dipermutasi
	*/
	for ($i=0; $i < $_SESSION['informasi']['kolom']; $i++) { 
		array_push($indeksKolomYangInginDipermutasi, $i);
	}
	$length = count($indeksKolomYangInginDipermutasi); //menampung panjang array
	// Memanggil fungsi permutasi
	permute($indeksKolomYangInginDipermutasi, 0, $length - 1,$allPermutation);
	$nilai = $_SESSION['nilai'];
	/*
	Karena allPermutation adalah array di dalam array yang mengandung semua daftar permutasi yang ada perindeksnya, maka lakukan perulangan untuk membuka array di dalam array dengan foreach
	*/
	foreach ($allPermutation as $perPermutasi) {
		$rowMatriks = 0;
		$tempJumlahNilaiMatriks=0; 
		$arraySetiapPermutasi = array();
		/*
		Array kedua dari allPermutation juga masih berupa array dan lakukan perulangan untuk mendapatkan nilainya lebih spesifik.
		Pada perulangan ini akan dilakukan penjumlah nilai matriks berdasarkan indeks kolom sesuai permutasinya.
		Misal :
		permutasinya (2,0,1), maka
		m[0][2] + m[1][0] + m[1][1] --> nilai ini akan ditampung dan akan dibandingkan nantinya untuk semua kemungkinan permutasi tergantung tujuan objective, jika min cari yang paling minimum, jika max cari yang paling maksimum
		*/
		foreach ($perPermutasi as $colMatriks) {
			$tempJumlahNilaiMatriks+=$nilai[$rowMatriks][$colMatriks];
			array_push($arraySetiapPermutasi, $colMatriks); //memasukan nilai setiap permutasinya ke dalam arraySetiapPermutasi
			/*
			Misal colM=2, colM=1, colM=0,
			maka arraySetiapPermutasi [2,1,0]
			misal arraySetiapPermutasi nya [2,4,1,3], maka :
			m[0][2] = nilai matriks
			m[1][4] = nilai matriks
			m[2][1] = nilai matriks
			m[2][3] = nilai matriks
			*/
			// cek variabel $rowMatriks apakah tidak melebihi batas baris pada mtriks yang sudah ditambah 1 baris variabel dummy
			if ($rowMatriks<$_SESSION['informasi']['baris']) {
				$rowMatriks++;
			}
		}
		array_push($totalNilaiSetiapPermutasi, $tempJumlahNilaiMatriks);
		array_push($daftarPermutasidariTotalNilaiSetiapPermutasi,$arraySetiapPermutasi); //push array ke dalam array
	}
	$solusiOptimal = max($totalNilaiSetiapPermutasi); //karena tujuan min, maka cari yg paling minimum
	$indexMin = array_keys($totalNilaiSetiapPermutasi,$solusiOptimal); //mencari indeks dari array yg memuat solusiOptimal tadi
	$indeksTotalPermutasiTerkecil;
	//array_keys mengembalikan array jadi harus dibuka arraynya
	foreach ($indexMin as $keyMinimum) {
		$indeksTotalPermutasiTerkecil = $keyMinimum;
	}
	$count=0;
	$hasilAkhir = array(array());
	// Mencari daftarPermutasi yang menyebabkan nilai TotalNilaiSetiapPermutasi minimum dan jadikan permutasi tersebut sebagai rute tujuan akhirnya
	foreach ($daftarPermutasidariTotalNilaiSetiapPermutasi as $jalur) {
		if ($count!=$indeksTotalPermutasiTerkecil) {
			$count++;
		}else{
			$hasilAkhir['rute'] = $jalur;
			break;
		}
	}
	/*
	Isi dari variabel $hasilAkhir['rute'] :
	array(3) { [0]=> int(2) [1]=> int(0) [2]=> int(1) }
	s	*/
	$hasilAkhir['solusiOptimal']= $solusiOptimal; //nilai minimum dari totalNilaiSetiapPermutasi
	$_SESSION['hasilAkhir'] = $hasilAkhir; //permutasi yang menyebabkan nlainya minimum, ini yang akan ditampilkan pada halaman solusiOptimal.php
}
?>
<!-- FUNCTION untuk melakukan permutasi dan swap 1,2,3 -- 1,3,2 dst -->
<?php
function permute($indeksKolomYangInginDipermutasi, $l, $r,&$allPermutation) 
{ 
	if ($l == $r){
		array_push($allPermutation, $indeksKolomYangInginDipermutasi);
	}
	else
	{ 
		for ($i = $l; $i <= $r; $i++) 
		{ 
			$indeksKolomYangInginDipermutasi = swap($indeksKolomYangInginDipermutasi, $l, $i); 
			permute($indeksKolomYangInginDipermutasi, $l + 1, $r,$allPermutation); 
			$indeksKolomYangInginDipermutasi = swap($indeksKolomYangInginDipermutasi, $l, $i); 
		} 
	} 
} 
function swap($indeksKolomYangInginDipermutasi, $i, $j) 
{ 
	$temp; 
	$temp = $indeksKolomYangInginDipermutasi[$i] ; 
	$indeksKolomYangInginDipermutasi[$i] = $indeksKolomYangInginDipermutasi[$j]; 
	$indeksKolomYangInginDipermutasi[$j] = $temp;
	return $indeksKolomYangInginDipermutasi; 
} 
?>