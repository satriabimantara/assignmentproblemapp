<?php
$_GET['page'] = "Metode Penugasan";
require_once '../header/header.php';
$nilai = array(array()); //menampung nilai dari matriks 2 dimensinya
?>
<!-- Main content for Operation Research -->
<div class="container mt-3 mb-3">
	<div class="card shadow bg-light">
		<div class="card-header text-center">
			<h4 class="display-4">Metode Penugasan</h4>
		</div>
		<div class="card-body">
			<form method="post" action="index.php">
				<div class="form-group">
					<label for="inputJumlahBaris">Jumlah Baris</label>
					<input type="number" class="form-control" id="inputJumlahBaris" name="inputJumlahBaris" aria-describedby="inputJumlahBarisHelp" required="true" value="">
					<small id="inputJumlahBarisHelp" class="form-text text-muted">Masukan jumlah pekerjaan</small>
				</div>
				<div class="form-group">
					<label for="pilihNamaBaris">Nama Baris</label>
					<select class="form-control" id="pilihNamaBaris" name="pilihNamaBaris" required="true">
						<option value="">-pilih nama baris-</option>
						<option value="baris1">A,B,C,...</option>
						<option value="baris2">1,2,3,...</option>
						<option value="baris3">Job 1,Job 2,Job 3,...</option>
					</select>
				</div>
				<div class="form-group">
					<label for="inputJumlahKolom">Jumlah Kolom</label>
					<input type="number" class="form-control" id="inputJumlahKolom" aria-describedby="inputJumlahKolomHelp" value="" name="inputJumlahKolom" required="true">
					<small id="inputJumlahKolomHelp" class="form-text text-muted">Masukan jumlah sumber daya</small>
				</div>
				<div class="form-group">
					<label for="pilihNamaKolom">Nama Kolom</label>
					<select class="form-control" id="pilihNamaKolom" name="pilihNamaKolom" required="true">
						<option value="">-pilih nama kolom-</option>
						<option value="kolom1">A,B,C,...</option>
						<option value="kolom2">1,2,3,...</option>
						<option value="kolom3">Mesin 1,Mesin 2,Mesin 3,...</option>
					</select>
				</div>
				<label for="pilihObjective1">Objective</label>
				<div class="form-check mb-2">
					<input class="form-check-input" type="radio" name="pilihObjective" id="pilihObjective1" value="max" checked="">
					<label class="form-check-label" for="pilihObjective1">
						Maksimasi
					</label>
				</div>
				<div class="form-check mt-2 mb-2">
					<input class="form-check-input" type="radio" name="pilihObjective" id="pilihObjective2" value="min">
					<label class="form-check-label" for="pilihObjective2">
						Minimasi
					</label>
				</div>
				<button type="submit" class="btn btn-primary" id="btnNextProses" name="btnNextProses">Next</button>
			</form>
			<!-- Cek apakah button Next ditekan -->
			<?php
			if (isset($_POST['btnNextProses'])) {
				//setiap button ini ditekan maka destroy session yang pernah dibuat
				unset($_SESSION['nilai']);
				$informasi = array(array());
				$informasi['baris'] = $_POST['inputJumlahBaris'];
				$informasi['kolom'] = $_POST['inputJumlahKolom'];
				$informasi['nomorBaris'] = $_POST['pilihNamaBaris'];
				$informasi['nomorKolom'] = $_POST['pilihNamaKolom'];
				$informasi['tujuan'] = $_POST['pilihObjective'];
				$_SESSION['informasi'] = $informasi;
				// Cek kalau baris dan kolom yang dimasukkan minimal 2 tidak boleh < 2
				if ($informasi['baris']<2 || $informasi['kolom']<2) {
					//beri alert kalau minimal baris atau kolom harus 2
					echo "<script>
					Swal.fire({
						title: 'INPUTAN TIDAK SESUAI',
						text: 'Baris atau Kolom minimal satu yaa!!',
						icon: 'warning',
						showCancelButton: false,
						confirmButtonColor: '#4BB543',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ganti'
						}).then((result) => {
						})</script>";
					}else{
						require_once 'proses.php';
					}
				}
				?>
				<!-- Cek apakah button dari prosesSeimbang.php ditekan -->
				<?php if (isset($_POST['btnInputNilaiMatriksAwalProsesSeimbang'])): ?>
					<!-- Mengisi variabel nilai -->
					<?php for ($i=0; $i < $_SESSION['informasi']['baris']; $i++):?>
						<?php for ($j=0; $j < $_SESSION['informasi']['kolom']; $j++):?>
							<?php 
							$string= $i."".$j;
							$nilai[$i][$j] = (int)$_POST[$string]; 
							?>
						<?php endfor; ?>
					<?php endfor; ?>
					<?php
					$_SESSION['nilai'] = $nilai;
					require_once 'prosesSeimbang.php';
					?>
					<?php
					if (isset($_SESSION['hasilAkhir'])) {
						require_once 'solusiOptimal.php';
					}
					?>
				<?php endif ?>
				<!-- Cek apakah buttin dari prosesTidakSeimbang.php ditekan -->
				<?php
				if (isset($_POST['btnInputNilaiMatriksAwalProsesTidakSeimbang'])){
						// Mengisi variabel nilai
						// Jika 2 x n dimana n > 2, maka tambahkan  1 variabel dummny pada baris
						// JIka m x 2 dimana m > 2, maka tambahkan 1 variabel dummy pada kolom
						//Jika 2 x n
					if ($_SESSION['informasi']['kolom']>$_SESSION['informasi']['baris']) {
						for ($i=0; $i < $_SESSION['informasi']['baris'] + 1; $i++){
							for ($j=0; $j < $_SESSION['informasi']['kolom']; $j++){
								//tambahkan variabel dummy pada baris n+1 dengan nilai 0
								if ($i == $_SESSION['informasi']['baris']) {
									$nilai[$i][$j] = 0;
								}else{
									$string= $i."".$j;
									$nilai[$i][$j] = (int)$_POST[$string]; 
								}
							}
						}
					}elseif ($_SESSION['informasi']['baris']>$_SESSION['informasi']['kolom']) {
						for ($i=0; $i < $_SESSION['informasi']['baris']; $i++){
							for ($j=0; $j < $_SESSION['informasi']['kolom'] + 1; $j++){
						//tambahkan variabel dummy pada kolom m+1 dengan nilai 0
								if ($j == $_SESSION['informasi']['kolom']) {
									$nilai[$i][$j] = 0;
								}else{
									$string= $i."".$j;
									$nilai[$i][$j] = (int)$_POST[$string]; 
								}
							}
						}
					}
					$_SESSION['nilai'] = $nilai;
					require_once 'prosesTidakSeimbang.php';
					if (isset($_SESSION['hasilAkhir'])) {
						require_once 'solusiOptimal.php';
					}
				}
				?>
			</div>
			<div class="card-footer text-center">
				<h5>I Made Satria Bimantara</h5>
			</div>
		</div>
	</div>

	<?php
	require_once '../footer/footer.php';
	?>