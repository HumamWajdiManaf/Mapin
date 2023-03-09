<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Artikel</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List Data</li>
            </ol>
            <div class="card mb-4">
				<div class="card-header">
					<div class="row justify-content-between">
					<div class="col-auto me-auto align-self-center">
					  <i class="fas fa-table me-1"></i>Data Artikel
					</div>
					<div class="col-auto">
					  <a class="btn btn-success" href="?page=artikel_form" role="button"><i class="fas fa-plus me-1"></i>Tambah</a>
					</div>
				  </div>
				</div>
				<div class="card-body">
					<table class="data-tables table table-striped table-hover">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th width="100px">Gambar</th>
								<th>Nama artikel</th>
								<th>Nama Penulis</th>								
								<th>Keterangan</th>
								<th>Tanggal RIlis</th>
								<th>File Artikel</th>
								<th width="10px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 0;
								$getdata = mysqli_query($koneksi, "SELECT * FROM tbl_artikel ORDER BY nama_artikel ASC") or die (mysqli_error($koneksi));
								while($row = mysqli_fetch_assoc($getdata)){
							?>
							<tr>
								<td><?=++$no?></td>
								<td><img class="img-thumbnail rounded col-12" src="<?=resources($row['img_artikel'])?>" alt="<?=$row['nama_artikel']?>"/></td>
								<td><?=$row['nama_artikel']?></td>
								<td><?=$row['penulis_artikel']?></td>						
								<td><?=$row['keterangan_artikel']?></td>
								<td><?=$row['tanggal_rilis_artikel']?></td>
								<td><?=$row['file_artikel']?>
								
									<a class="btn btn-info btn-sm" target="_blank" href="<?=resources($row['file_artikel'])?>" role="button">Lihat</a>
									<a class="btn btn-success btn-sm" href="<?=resources($row['file_artikel'])?>" download="<?='ART '.$row['file_artikel'].' '.$row['nama_artikel']?>">Download</a>
								
								</td>
								<td>
									<a class="text-primary" href="?page=artikel_form&id=<?=enkrip($row['id_artikel'])?>"><i class="fas fa-solid fa-pen-to-square"></i></a>
									|
									<a class="text-danger" onclick="return confirm_alert('Hapus','Apakah anda ingin menghapus artikel <?=$row['nama_artikel']?>?')" href="<?=process('artikel_hapus&id='.enkrip($row['id_artikel']))?>"><i class="fas fa-solid fa-trash-can"></i></a>
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