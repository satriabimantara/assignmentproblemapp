<?php
// Cek tujuan objective yang diinputkan user, jika minimum atau maksimum
if ($_SESSION['informasi']['tujuan']=="min") {
	//lakukan brute force untuk minimum yaitu mencari solusi minimum terbaik dari permutasi yang ada
	$allPermutation=array(); //array yang akan menampung semua daftar permutasi yang mungkin dari array $indeksBarisYangInginDipermutasi
	$daftarPermutasidariTotalNilaiSetiapPermutasi = array(); 
	$indeksBarisYangInginDipermutasi = array();
	$totalNilaiSetiapPermutasi=array(); //menampung total penjumlah nilai matriksnya untuk setiap permutasinya
	// Memasukan indeks kolom ke dalam array indeksBarisYangInginDipermutasi yang nantinya akan dilakukan permutasi
	/*
	Misal : jumlah kolom = 3
	(0,1,2) akan dimasukan ke dalam array indeksBarisYangInginDipermutasi
	array ini yang nantinya akan dipermutasi
	*/
	for ($i=0; $i < $_SESSION['informasi']['baris']; $i++) { 
		array_push($indeksBarisYangInginDipermutasi, $i);
	}
	$length = count($indeksBarisYangInginDipermutasi); //menampung panjang array
	// Memanggil fungsi permutasi
	permute($indeksBarisYangInginDipermutasi, 0, $length - 1,$allPermutation);
	$nilai = $_SESSION['nilai'];
	/*
	Karena allPermutation adalah array di dalam array yang mengandung semua daftar permutasi yang ada perindeksnya, maka lakukan perulangan untuk membuka array di dalam array dengan foreach
	*/
	foreach ($allPermutation as $perPermutasi) {
		$colMatriks = 0;
		$tempJumlahNilaiMatriks=0; 
		$arraySetiapPermutasi = array();
		/*
		Array kedua dari allPermutation juga masih berupa array dan lakukan perulangan untuk mendapatkan nilainya lebih spesifik.
		Pada perulangan ini akan dilakukan penjumlah nilai matriks berdasarkan indeks kolom sesuai permutasinya.
		Misal :
		permutasinya (2,0,1), maka
		m[0][2] + m[1][0] + m[1][1] --> nilai ini akan ditampung dan akan dibandingkan nantinya untuk semua kemungkinan permutasi tergantung tujuan objective, jika min cari yang paling minimum, jika max cari yang paling maksimum
		*/
		foreach ($perPermutasi as $rowMatriks) {
			$tempJumlahNilaiMatriks+=$nilai[$rowMatriks][$colMatriks];
			array_push($arraySetiapPermutasi, $rowMatriks); //memasukan nilai setiap permutasinya ke dalam arraySetiapPermutasi
			/*
			Misal rowM=2, rowM=1, rowM=0,
			maka arraySetiapPermutasi [2,1,0]
			misal arraySetiapPermutasi nya [2,4,1,3], maka :
			m[2][0] = nilai matriks
			m[4][1] = nilai matriks
			m[1][2] = nilai matriks
			m[3][3] = nilai matriks
			*/
			// cek variabel $colMatriks apakah tidak melebihi batas baris pada mtriks yang sudah ditambah 1 baris variabel dummy
			if ($colMatriks<$_SESSION['informasi']['kolom']) {
				$colMatriks++;
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
	$allPermutation=array(); //array yang akan menampung semua daftar permutasi yang mungkin dari array $indeksBarisYangInginDipermutasi
	$daftarPermutasidariTotalNilaiSetiapPermutasi = array(); 
	$indeksBarisYangInginDipermutasi = array();
	$totalNilaiSetiapPermutasi=array(); //menampung total penjumlah nilai matriksnya untuk setiap permutasinya
	// Memasukan indeks kolom ke dalam array indeksBarisYangInginDipermutasi yang nantinya akan dilakukan permutasi
	/*
	Misal : jumlah kolom = 3
	(0,1,2) akan dimasukan ke dalam array indeksBarisYangInginDipermutasi
	array ini yang nantinya akan dipermutasi
	*/
	for ($i=0; $i < $_SESSION['informasi']['baris']; $i++) { 
		array_push($indeksBarisYangInginDipermutasi, $i);
	}
	$length = count($indeksBarisYangInginDipermutasi); //menampung panjang array
	// Memanggil fungsi permutasi
	permute($indeksBarisYangInginDipermutasi, 0, $length - 1,$allPermutation);
	$nilai = $_SESSION['nilai'];
	/*
	Karena allPermutation adalah array di dalam array yang mengandung semua daftar permutasi yang ada perindeksnya, maka lakukan perulangan untuk membuka array di dalam array dengan foreach
	*/
	foreach ($allPermutation as $perPermutasi) {
		$colMatriks = 0;
		$tempJumlahNilaiMatriks=0; 
		$arraySetiapPermutasi = array();
		/*
		Array kedua dari allPermutation juga masih berupa array dan lakukan perulangan untuk mendapatkan nilainya lebih spesifik.
		Pada perulangan ini akan dilakukan penjumlah nilai matriks berdasarkan indeks kolom sesuai permutasinya.
		Misal :
		permutasinya (2,0,1), maka
		m[0][2] + m[1][0] + m[1][1] --> nilai ini akan ditampung dan akan dibandingkan nantinya untuk semua kemungkinan permutasi tergantung tujuan objective, jika min cari yang paling minimum, jika max cari yang paling maksimum
		*/
		foreach ($perPermutasi as $rowMatriks) {
			$tempJumlahNilaiMatriks+=$nilai[$rowMatriks][$colMatriks];
			array_push($arraySetiapPermutasi, $rowMatriks); //memasukan nilai setiap permutasinya ke dalam arraySetiapPermutasi
			/*
			Misal rowM=2, rowM=1, rowM=0,
			maka arraySetiapPermutasi [2,1,0]
			misal arraySetiapPermutasi nya [2,4,1,3], maka :
			m[2][0] = nilai matriks
			m[4][1] = nilai matriks
			m[1][2] = nilai matriks
			m[3][3] = nilai matriks
			*/
			// cek variabel $colMatriks apakah tidak melebihi batas baris pada mtriks yang sudah ditambah 1 baris variabel dummy
			if ($colMatriks<$_SESSION['informasi']['kolom']) {
				$colMatriks++;
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
function permute($indeksBarisYangInginDipermutasi, $l, $r,&$allPermutation) 
{ 
	if ($l == $r){
		array_push($allPermutation, $indeksBarisYangInginDipermutasi);
	}
	else
	{ 
		for ($i = $l; $i <= $r; $i++) 
		{ 
			$indeksBarisYangInginDipermutasi = swap($indeksBarisYangInginDipermutasi, $l, $i); 
			permute($indeksBarisYangInginDipermutasi, $l + 1, $r,$allPermutation); 
			$indeksBarisYangInginDipermutasi = swap($indeksBarisYangInginDipermutasi, $l, $i); 
		} 
	} 
} 
function swap($indeksBarisYangInginDipermutasi, $i, $j) 
{ 
	$temp; 
	$temp = $indeksBarisYangInginDipermutasi[$i] ; 
	$indeksBarisYangInginDipermutasi[$i] = $indeksBarisYangInginDipermutasi[$j]; 
	$indeksBarisYangInginDipermutasi[$j] = $temp;
	return $indeksBarisYangInginDipermutasi; 
} 
?>