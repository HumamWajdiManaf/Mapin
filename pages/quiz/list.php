<?php
	$id_bab = dekrip($_GET['id']);
	$getbab = query_row("SELECT * FROM tbl_bab WHERE id_bab='".$id_bab."'");
	$getmateri = query_row("SELECT * FROM tbl_materi WHERE id_materi='".$getbab['id_materi']."'");
	$getmapel = query_row("SELECT * FROM tbl_mapel WHERE id_mapel='".$getmateri['id_mapel']."'");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?='Mapel '.$getmapel['nama_mapel'].' / '.$getmateri['no_materi'].'. '.$getmateri['nama_materi']?></h4>
            <h1><?='BAB '.$getbab['no_bab'].'. '.$getbab['nama_bab']?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=quiz')?>">List BAB</a></li>
                <li class="breadcrumb-item active">List Quiz</li>
            </ol>
            <div class="card mb-4">
				<div class="card-header">
					<div class="row justify-content-between">
					<div class="col-auto me-auto align-self-center">
					  <i class="fas fa-table me-1"></i>Data Quiz
					</div>
					<div class="col-auto">
					  <a class="btn btn-success" href="?page=quiz_form&id_bab=<?=enkrip($id_bab)?>" role="button"><i class="fas fa-plus me-1"></i>Tambah</a>
					</div>
				  </div>
				</div>
				<div class="card-body">
					<table class="data-tables table table-striped table-hover">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th width="100px">Nomor Soal</th>
								<th>Pertanyaan</th>
								<th>Jawaban</th>
								<th width="120px">Jawaban Benar</th>
								<th width="10px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 0;
								$getdata = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_bab='".$id_bab."' ORDER BY no_soal ASC") or die (mysqli_error($koneksi));
								while($row = mysqli_fetch_assoc($getdata)){
							?>
							<tr>
								<td><?=++$no?></td>
								<td><?=$row['no_soal']?></td>								
								<td><?=$row['pertanyaan']?></td>								
								<td>
								<?php
									echo '
										A. '.$row['jawaban_a'].'<br>
										B. '.$row['jawaban_b'].'<br>
										C. '.$row['jawaban_c'].'<br>
										D. '.$row['jawaban_d'].'<br>';
								?>
								</td>								
								<td><?=$row['jawaban_benar']?></td>
								<td>
									<a class="text-primary" href="?page=quiz_form&id_bab=<?=enkrip($row['id_bab'])?>&id=<?=enkrip($row['id_soal'])?>"><i class="fas fa-solid fa-pen-to-square"></i></a>
									|
									<a class="text-danger" onclick="return confirm_alert('Hapus','Apakah anda ingin menghapus Soal <?=$row['pertanyaan']?>')" href="<?=process('quiz_hapus&id_bab='.enkrip($row['id_bab']).'&id='.enkrip($row['id_soal']))?>"><i class="fas fa-solid fa-trash-can"></i></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
	</main>
</div>