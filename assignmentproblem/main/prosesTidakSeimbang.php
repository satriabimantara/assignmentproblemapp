<!-- 2. Buat tabel untuk memasukkan nilai dari user -->
<?php if (!isset($_SESSION['nilai'])): ?>
	<form method="post" action="index.php?page=Proses Dummy" style="display: inline-block;">
		<table class="table table-striped mt-2">
			<thead>
				<tr>
					<th scope="col" colspan="1"></th>
					<?php foreach ($typeKolom as $colname): ?>
						<th scope="col"><?php echo $colname; ?></th>
					<?php endforeach ?>
				</tr>
			</thead>
			<tbody>
				<!-- Perulangan Baris -->
				<?php for ($i=0; $i < count($typeBaris) ; $i++): ?>
					<tr>
						<th scope="row" ><?php echo $typeBaris[$i]; ?></th>
						<!-- Perulangan Kolom -->
						<?php  for ($j=0; $j <count($typeKolom) ; $j++):?>
							<?php $nilai[$i][$j] = $i."".$j; ?>
							<td>
								<input type="number" class="form-control col-md-8" id="<?php echo $nilai[$i][$j]; ?>" name="<?php echo $nilai[$i][$j]; ?>" aria-describedby="inputJumlahBarisHelp" required="true" value="" style="padding: 5px;">
							</td>
						<?php endfor; ?>
					</tr>
				<?php endfor; ?>
			</tbody>
		</table>
		<button class="btn btn-danger" type="submit" name="btnInputNilaiMatriksAwalProsesTidakSeimbang" id="btnInputNilaiMatriksAwalProsesTidakSeimbang">
			Hitung
		</button>
	</form>
	<?php else: ?>
		<!-- Lakukan logic perhitungan dari matriks -->
		<?php
		$nilai = $_SESSION['nilai'];
		if ($_SESSION['informasi']['baris'] > $_SESSION['informasi']['kolom']) {
			//dummy kolom
			//karena baris yang lebih besar dari kolom maka permutasi kemungkinan barisnya
			require_once 'bruteforcedummykolom.php';
		}elseif ($_SESSION['informasi']['kolom'] > $_SESSION['informasi']['baris']) {
			//dummy baris
			//karena kolom lebih besar dari baris maka permutasi kemungkinan kolomnya
			require_once 'bruteforcedummybaris.php';
		}

		?>
		<?php endif ?>