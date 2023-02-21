<?php
	$id_mapel = dekrip($_GET['id_mapel']);
	$getmapel = query_row("SELECT * FROM tbl_mapel WHERE id_mapel='".$id_mapel."'");
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mapel <?=$getmapel['nama_mapel']?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=materi')?>">List Mapel</a></li>
                <li class="breadcrumb-item active">List Materi</li>
            </ol>
            <div class="card mb-4">
				<div class="card-header">
					<div class="row justify-content-between">
					<div class="col-auto me-auto align-self-center">
					  <i class="fas fa-table me-1"></i>Data Materi
					</div>
					<div class="col-auto">
					  <a class="btn btn-success" href="?page=materi_form&id_mapel=<?=enkrip($id_mapel)?>" role="button"><i class="fas fa-plus me-1"></i>Tambah</a>
					</div>
				  </div>
				</div>
				<div class="card-body">
					<table class="data-tables table table-striped table-hover">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th width="110px">Nomor Materi</th>
								<th>Nama Materi</th>
								<th>BAB Materi</th>								
								<th>Penulis</th>
								<th>Tanggal Rilis</th>
								<th width="90px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 0;
								$getdata = mysqli_query($koneksi, "SELECT a.*,count(b.id_bab) bab FROM tbl_materi a
									LEFT JOIN tbl_bab b ON a.id_materi=b.id_materi WHERE a.id_mapel='".$id_mapel."'
									GROUP BY a.id_materi ORDER BY a.no_materi ASC") or die (mysqli_error($koneksi));
								while($row = mysqli_fetch_assoc($getdata)){
							?>
							<tr>
								<td><?=++$no?></td>
								<td><?=$row['no_materi']?></td>								
								<td><?=$row['nama_materi']?></td>								
								<td><?=$row['bab']?> BAB</td>								
								<td><?=$row['penulis_materi']?></td>
								<td><?=$row['tanggal_rilis_materi']?></td>
								<td>
									<a class="text-success" href="?page=bab&id_materi=<?=enkrip($row['id_materi'])?>"><i class="fas fa-solid fa-book-bookmark"></i> BAB</a>
									|
									<a class="text-primary" href="?page=materi_form&id_mapel=<?=enkrip($row['id_mapel'])?>&id=<?=enkrip($row['id_materi'])?>"><i class="fas fa-solid fa-pen-to-square"></i></a>
									|
									<a class="text-danger" onclick="return confirm_alert('Hapus','Apakah anda ingin menghapus materi <?=$row['nama_materi']?>?')" href="<?=process('materi_hapus&id_mapel='.enkrip($row['id_mapel']).'&id='.enkrip($row['id_materi']))?>"><i class="fas fa-solid fa-trash-can"></i></a>
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