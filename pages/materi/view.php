<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Materi Mata Pelajaran</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List Data</li>
            </ol>
			<div class="d-flex justify-content-evenly flex-wrap">
			<?php
				$no = 0;
				$getdata = mysqli_query($koneksi, "SELECT * FROM tbl_mapel ORDER BY nama_mapel ASC") or die (mysqli_error($koneksi));
				while($row = mysqli_fetch_assoc($getdata)){
			?>
				<a class="col-lg-3 col-md-3 col-sm-12 card p-3 m-1 mb-5 shadow-sm" href="?page=materi&id_mapel=<?=enkrip($row['id_mapel'])?>">
					<div class="d-flex align-items-center h-100">
						<div class="col-3 me-3">
							<img class="img-thumbnail border-0 w-100 h-auto" src="<?=resources($row['img_mapel'])?>"/>
						</div>
						<div class="flex-shrink-1">
							<p class="btn m-0 fw-bolder fs-5 text-secondary"><?=$row['nama_mapel']?></p>
						</div>
					</div>
				</a>
			<?php } ?>
			</div>
        </div>
	</main>
</div>