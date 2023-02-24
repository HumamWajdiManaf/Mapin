<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List Data</li>
            </ol>
            <div class="card mb-4">
				<div class="card-header">
					<div class="row justify-content-between">
					<div class="col-auto me-auto align-self-center">
					  <i class="fas fa-table me-1"></i>Data User
					</div>
					<div class="col-auto">
					  <a class="btn btn-success" href="?page=user_form" role="button"><i class="fas fa-plus me-1"></i>Tambah</a>
					</div>
				  </div>
				</div>
				<div class="card-body">
					<table class="data-tables table table-striped table-hover">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th width="100px">Photo Profil</th>
								<th>Nama User</th>
								<th>Nama</th>								
								<th>Keterangan</th>
								<th width="10px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 0;
								$getdata = mysqli_query($koneksi, "SELECT * FROM tbl_user2 ORDER BY nama_user2 ASC") or die (mysqli_error($koneksi));
								while($row = mysqli_fetch_assoc($getdata)){
							?>
							<tr>
								<td><?=++$no?></td>
								<td><img class="img-thumbnail rounded col-12" src="<?=resources($row['img_user2'])?>" alt="<?=$row['nama_user2']?>"/></td>
								<td><?=$row['nama_user2']?></td>
								<td><?=$row['nama']?></td>						
								<td><?=$row['keterangan_user2']?></td>
								<td>
									<a class="text-primary" href="?page=user_form&id=<?=enkrip($row['id_user2'])?>"><i class="fas fa-solid fa-pen-to-square"></i></a>
									|
									<a class="text-danger" onclick="return confirm_alert('Hapus','Apakah anda ingin menghapus user <?=$row['nama_user2']?>?')" href="<?=process('user_hapus&id='.enkrip($row['id_user2']))?>"><i class="fas fa-solid fa-trash-can"></i></a>
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