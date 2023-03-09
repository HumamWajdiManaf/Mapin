<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Quiz</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List Data</li>
            </ol>
            <div class="card mb-4">
				<div class="card-header">
					<div class="row justify-content-between">
					<div class="col-auto me-auto align-self-center">
					  <i class="fas fa-table me-1"></i>Data Materi
					</div> 
				  </div>
				</div>
				<div class="card-body">
					<table class="data-tables table table-striped table-hover">
						<thead>
							<tr>
								<th width="10px">No</th>
								<th>Mapel</th>
								<th>Nama Materi</th>
								<th>Nama BAB</th>
								<th width="65px">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 0;
								$getdata = mysqli_query($koneksi, "SELECT
										a.id_mapel, a.nama_mapel, a.img_mapel, a.keterangan_mapel,
										b.id_materi, b.no_materi, b.nama_materi,
										c.id_bab, c.no_bab, c.nama_bab
									FROM tbl_mapel a
									LEFT JOIN tbl_materi b ON a.id_mapel=b.id_mapel
									LEFT JOIN tbl_bab c ON b.id_materi=c.id_materi
									LEFT JOIN tbl_soal d ON c.id_bab=d.id_bab
									ORDER BY a.nama_mapel ASC, b.no_materi ASC, c.no_bab ASC") or die (mysqli_error($koneksi));
								while($row = mysqli_fetch_assoc($getdata)){
							?>
							<tr>
								<td><?=++$no?></td>
								<td><?=$row['nama_mapel']?></td>								
								<td><?=$row['no_materi'].'. '.$row['nama_materi']?></td>								
								<td><?='BAB '.$row['no_bab'].'. '.$row['nama_bab']?></td>						
								<td>
									<a class="text-primary" href="?page=quiz_list&id=<?=enkrip($row['id_bab'])?>"><i class="fas fa-solid fa-list-check"></i> List Soal</a>
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