<?php
	$id_mapel = dekrip($_GET['id_mapel']);
	$getmapel = query_row("SELECT * FROM tbl_mapel WHERE id_mapel='".$id_mapel."'");
	$msg = '';
	$id_materi = '';
	$aksi = (isset($_GET['id']) ? 'edit' : 'tambah');
	$nama_materi = '';
	$penulis_materi = '';
	$tanggal_rilis = '';
	$no_materi = '';
	
	if($aksi == 'tambah'){
		$getno = query_row("SELECT IFNULL(MAX(no_materi)+1,1) as no FROM tbl_materi WHERE id_mapel='".$id_mapel."'");
		$no_materi = $getno['no'];
	}else if($aksi == 'edit'){
		$required_img = false;
		$data = mysqli_query($koneksi, "SELECT * FROM tbl_materi WHERE id_materi='".dekrip($_GET['id'])."'") or die (mysqli_error($koneksi));
		if(mysqli_num_rows($data) != 1){
			$msg = 'Data tidak ditemukan!';
		}else{
			$data = mysqli_fetch_array($data);
			$id_materi = '&id='.enkrip($data['id_materi']);
			$nama_materi = $data['nama_materi'];
			$penulis_materi = $data['penulis_materi'];
			$tanggal_rilis = $data['tanggal_rilis_materi'];
			$no_materi = $data['no_materi'];
		}
	}
	
	$data = get_flash('data');
	if(!empty($data)){
		$nama_materi = $data['txt_nama_materi'];
		$penulis_materi = $data['txt_penulis_materi'];
		$tanggal_rilis = $data['date_tanggal_rilis'];
		$no_materi = $data['number_no_materi'];
	}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Materi <?=$getmapel['nama_mapel']?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=materi')?>">List Mapel</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('?page=materi&id_mapel='.enkrip($id_mapel))?>">List Materi</a></li>
                <li class="breadcrumb-item active"><?=ucwords($aksi)?></li>
            </ol>
			<?=alert($msg,'danger')?>
            <div class="card mb-4">
				<div class="card-header">
					<div class="row justify-content-between">
					<div class="col-auto me-auto align-self-center">
					  <i class="fas fa-table me-1"></i>Form <?=ucwords($aksi)?>
					</div>
				  </div>
				</div>
				<div class="card-body">
					<form class="d-flex flex-wrap" method="POST" enctype="multipart/form-data" action="<?=process('materi_'.$aksi.'&id_mapel='.enkrip($id_mapel).$id_materi)?>">
						<?php
							form_input([
								'name' => 'txt_nama_materi',
								'label' => 'Nama Materi',
								'value' => $nama_materi,
							]);
							
							form_input([
								'name' => 'txt_penulis_materi',
								'label' => 'Penulis',
								'value' => $penulis_materi,
							]);
							
							form_input([
								'name' => 'date_tanggal_rilis',
								'label' => 'Tanggal Rilis',
								'type' => 'date',
								'col' => '2',
								'value' => $tanggal_rilis,
							]);
							
							form_input([
								'name' => 'number_no_materi',
								'label' => 'Nomor Materi',
								'type' => 'number',
								'col' => '2',
								'min' => '1',
								'value' => $no_materi,
							]);
						?>
						<div class="col-12 d-flex justify-content-between">
							<button type="submit" class="btn btn-success">Simpan</button>
							<button type="reset" class="btn btn-secondary">Reset</button>
						</div>
					</form>
				</div>
			</div>
        </div>
	</main>
</div>