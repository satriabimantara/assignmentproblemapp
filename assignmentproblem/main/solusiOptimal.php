<?php
$rute = $_SESSION['hasilAkhir']['rute'];
$copiedNilai = $nilai;
$optimalSolutionValue = $_SESSION['hasilAkhir']['solusiOptimal'];
$rowMatriks = 0;
$colMatriks = 0;
$baris = $_SESSION['informasi']['baris'];
$nomorBaris = $_SESSION['informasi']['nomorBaris'];
$kolom =$_SESSION['informasi']['kolom'];
$nomorKolom = $_SESSION['informasi']['nomorKolom'];
$tujuan = $_SESSION['informasi']['tujuan'];
$typeBaris = array();
$typeKolom = array();
if ($baris>$kolom) {
	foreach ($rute as $barisPenugasan) {
		$copiedNilai[$barisPenugasan][$colMatriks] = (string) "Assigned (".$copiedNilai[$barisPenugasan][$colMatriks].")";
		if ($colMatriks<$_SESSION['informasi']['kolom']) {
			$colMatriks++;
		}
	}
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
	if ($nomorKolom == "kolom1") {
		for ($i=0; $i < $kolom+1; $i++) {
			$string = chr($i+65); 
			array_push($typeKolom, $string);
		}
	}elseif ($nomorKolom=="kolom2") {
		for ($i=0; $i < $kolom+1; $i++) {
			array_push($typeKolom, ($i+1));
		}
	}elseif ($nomorKolom=="kolom3") {
		for ($i=0; $i < $kolom+1; $i++) {
			$string = "Mesin ".($i+1); 
			array_push($typeKolom, $string);
		}
	}
}elseif ($kolom>$baris) {
	foreach ($rute as $kolomPenugasan) {
		$copiedNilai[$rowMatriks][$kolomPenugasan] = (string) "Assigned (".$copiedNilai[$rowMatriks][$kolomPenugasan].")";
		if ($rowMatriks<$_SESSION['informasi']['baris']) {
			$rowMatriks++;
		}
	}
	//memberikan nama sesuai yang dipilih user (baris)
	if ($nomorBaris == "baris1") {
		for ($i=0; $i < $baris+1; $i++) {
			$string = chr($i+65); 
			array_push($typeBaris, $string);
		}
	}elseif ($nomorBaris=="baris2") {
		for ($i=0; $i < $baris+1; $i++) {
			array_push($typeBaris, ($i+1));
		}
	}elseif ($nomorBaris=="baris3") {
		for ($i=0; $i < $baris+1; $i++) {
			$string = "Job ".($i+1); 
			array_push($typeBaris, $string);
		}
	}
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
}elseif ($baris==$kolom) {
	foreach ($rute as $kolomPenugasan) {
		$copiedNilai[$rowMatriks][$kolomPenugasan] = (string) "Assigned (".$copiedNilai[$rowMatriks][$kolomPenugasan].")";
		$rowMatriks++;
	}
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
}

?>
<div class="jumbotron jumbotron-fluid mt-4">
	<div class="container">
		<h1 class="display-4">Hasil Akhir</h1>
		<p class="lead">Optimal solution value >> <?php echo number_format($optimalSolutionValue); ?></p>
		<p class="lead">Jumlah Baris >> <?php echo  $baris; ?></p>
		<p class="lead">Jumlah Kolom >> <?php echo $kolom; ?></p>
		<p class="lead">Objective >> <?php echo strtoupper($tujuan); ?></p>
	</div>
</div>
<form method="post" action="solusiOptimal.php" style="display: inline-block;">
	<table class="table table-striped  mb-2 align-item-center">
		<thead>
			<tr>
				<th scope="col" colspan="1"></th>
				<?php foreach ($typeKolom as $colname): ?>
					<th scope="col"><?php echo $colname; ?></th>
				<?php endforeach ?>
			</tr>
		</thead>
		<tbody>
			<?php if ($baris>$kolom): ?>
				<!-- Perulangan Baris -->
				<?php for ($i=0; $i < $_SESSION['informasi']['baris'] ; $i++): ?>
					<tr>
						<th scope="row" ><?php echo $typeBaris[$i]; ?></th>
						<!-- Perulangan Kolom -->
						<?php  for ($j=0; $j <$_SESSION['informasi']['kolom']+1 ; $j++):?>
							<td>
								<input type="text" class="form-control col-md-8" id="" name="" value="<?php echo $copiedNilai[$i][$j]; ?>" style="padding: 5px;" readonly="true">
							</td>
						<?php endfor; ?>
					</tr>
				<?php endfor; ?>
			<?php endif ?>
			<?php if ($kolom>$baris): ?>
				<!-- Perulangan Baris -->
				<?php for ($i=0; $i < $_SESSION['informasi']['baris'] + 1 ; $i++): ?>
					<tr>
						<th scope="row" ><?php echo $typeBaris[$i]; ?></th>
						<!-- Perulangan Kolom -->
						<?php  for ($j=0; $j <$_SESSION['informasi']['kolom'] ; $j++):?>
							<td>
								<input type="text" class="form-control col-md-8" id="" name="" value="<?php echo $copiedNilai[$i][$j]; ?>" style="padding: 5px;" readonly="true">
							</td>
						<?php endfor; ?>
					</tr>
				<?php endfor; ?>
			<?php endif ?>
			<?php if ($baris==$kolom): ?>
				<!-- Perulangan Baris -->
				<?php for ($i=0; $i < $_SESSION['informasi']['baris'] ; $i++): ?>
					<tr>
						<th scope="row" ><?php echo $typeBaris[$i]; ?></th>
						<!-- Perulangan Kolom -->
						<?php  for ($j=0; $j <$_SESSION['informasi']['kolom'] ; $j++):?>
							<td>
								<input type="text" class="form-control col-md-8" id="" name="" value="<?php echo $copiedNilai[$i][$j]; ?>" style="padding: 5px;" readonly="true">
							</td>
						<?php endfor; ?>
					</tr>
				<?php endfor; ?>
			<?php endif ?>
		</tbody>
	</table>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-warning mt-5" data-toggle="modal" data-target="#exampleModal">
		Assignment List
	</button>
</form>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Assignment List</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Jobs</th>
							<th scope="col">Assign to</th>
							<th scope="col">Cost</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$rowMatriks=0; //if kolom>baris
						$colMatriks=0; //if baris>kolom
						?>
						<?php if ($baris>$kolom): ?>
							<?php foreach ($rute as $barisPenugasan) :?>
								<?php if ($colMatriks<$_SESSION['informasi']['kolom']): ?>
									<tr>
										<!-- Karena yang dipermutasi baris, maka jobs yang menempati hasil permutasinya pada variabel barisPenugasan -->
										<th><?php echo "Job ".($barisPenugasan+1); ?></th>
										<td><?php echo "Machine ".($colMatriks+1); ?></td>
										<td><?php echo number_format($nilai[$barisPenugasan][$colMatriks]); ?></td>
									</tr>
									<?php $colMatriks++; endif; ?>
								<?php endforeach;?>
								<?php elseif ($kolom>$baris): ?>
									<!-- Jika $kolom > $baris -->
									<?php foreach ($rute as $kolomPenugasan) :?>
										<?php if ($rowMatriks<$_SESSION['informasi']['baris']): ?>
											<tr>
												<th><?php echo "Job ".($rowMatriks+1); ?></th>
												<!-- Karena yang dipermutasi kolom, maka machine yang menempati hasil permutasinya pada variabel kolomPenugasan -->
												<td><?php echo "Machine ".($kolomPenugasan+1); ?></td>
												<td><?php echo number_format($nilai[$rowMatriks][$kolomPenugasan]); ?></td>
											</tr>
											<?php $rowMatriks++; endif; ?>
										<?php endforeach;?>
										<?php elseif ($kolom==$baris):?>
											<?php foreach ($rute as $jobs => $mesin) :?>
												<tr>
													<th><?php echo "Job ".($jobs+1); ?></th>
													<td><?php echo "Machine ".($mesin+1); ?></td>
													<td><?php echo $nilai[$jobs][$mesin]; ?></td>
												</tr>
											<?php endforeach;?>
										<?php endif ?>
										<tr>
											<th scope="row">Total</th>
											<td colspan="1"></td>
											<td><?php echo number_format($_SESSION['hasilAkhir']['solusiOptimal']); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>