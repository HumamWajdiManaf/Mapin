<?php
	$id_materi = dekrip($_GET['id_materi']);
	$getmateri = query_row("SELECT * FROM tbl_materi WHERE id_materi='".$id_materi."'");
	$getmapel = query_row("SELECT * FROM tbl_mapel WHERE id_mapel='".$getmateri['id_mapel']."'");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Mapel <?=$getmapel['nama_mapel']?></h4>
            <h1>BAB Materi <?=$getmateri['nama_materi']?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=materi')?>">List Mapel</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('?page=materi&id_mapel='.enkrip($getmateri['id_mapel']))?>">List Materi</a></li>
                <li class="breadcrumb-item active">List BAB</li>
            </ol>
            <div class="card mb-4">
				<div class="card-header">
					<div class="row justify-content-between">
					<div class="col-auto me-auto align-self-center">
					  <i class="fas fa-table me-1"></i>Data BAB
					</div>
					<div class="col-auto">
					  <a class="btn btn-success" href="?page=bab_form&id_materi=<?=enkrip($id_materi)?>" role="button"><i class="fas fa-plus me-1"></i>Tambah</a>
					</div>
				  </div>
				</div>
				<div class="card-body">
					<table class="data-tables table table-striped table-hover">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th width="110px">Nomor BAB</th>
								<th>Nama BAB</th>
								<th width="130px">File</th>
								<th width="10px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 0;
								$getdata = mysqli_query($koneksi, "SELECT * FROM tbl_bab WHERE id_materi='".$id_materi."' ORDER BY no_bab ASC") or die (mysqli_error($koneksi));
								while($row = mysqli_fetch_assoc($getdata)){
							?>
							<tr>
								<td><?=++$no?></td>
								<td><?=$row['no_bab']?></td>								
								<td><?=$row['nama_bab']?></td>								
								<td>
									<a class="btn btn-info btn-sm" target="_blank" href="<?=resources($row['file_bab'])?>" role="button">Lihat</a>
									<a class="btn btn-success btn-sm" href="<?=resources($row['file_bab'])?>" download="<?='BAB '.$row['no_bab'].' '.$row['nama_bab']?>">Download</a>
								</td>
								<td>
									<a class="text-primary" href="?page=bab_form&id_materi=<?=enkrip($row['id_materi'])?>&id=<?=enkrip($row['id_bab'])?>"><i class="fas fa-solid fa-pen-to-square"></i></a>
									|
									<a class="text-danger" onclick="return confirm_alert('Hapus','Apakah anda ingin menghapus BAB <?=$row['nama_bab']?>?')" href="<?=process('bab_hapus&id_materi='.enkrip($row['id_materi']).'&id='.enkrip($row['id_bab']))?>"><i class="fas fa-solid fa-trash-can"></i></a>
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