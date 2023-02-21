<?php
	$msg = '';
	$required_img = true;
	$aksi = (isset($_GET['id']) ? 'edit' : 'tambah');
	$id_mapel = '';
	$nama_mapel = '';
	$keterangan_mapel = '';
	$img_mapel = '';
	
	if($aksi == 'edit'){
		$required_img = false;
		$data = mysqli_query($koneksi, "SELECT * FROM tbl_mapel WHERE id_mapel='".dekrip($_GET['id'])."'") or die (mysqli_error($koneksi));
		if(mysqli_num_rows($data) != 1){
			$msg = 'Data tidak ditemukan!';
		}else{
			$data = mysqli_fetch_array($data);
			$id_mapel = '&id='.enkrip($data['id_mapel']);
			$nama_mapel = $data['nama_mapel'];
			$keterangan_mapel = $data['keterangan_mapel'];
			$img_mapel = $data['img_mapel'];
		}
	}
	
	$data = get_flash('data');
	if(!empty($data)){
		$nama_mapel = $data['txt_nama_mapel'];
		$keterangan_mapel = $data['txt_keterangan_mapel'];
	}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mata Pelajaran</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=mapel')?>">List Data</a></li>
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
					<form class="d-flex flex-wrap" method="POST" enctype="multipart/form-data" action="<?=process('mapel_'.$aksi.$id_mapel)?>">
						<?php
							form_input([
								'name' => 'txt_nama_mapel',
								'label' => 'Nama Mata Pelajaran',
								'value' => $nama_mapel,
							]);
							
							form_input([
								'name' => 'txt_keterangan_mapel',
								'label' => 'Keterangan',
								'required' => false,
								'value' => $keterangan_mapel,
							]);
							
							if($aksi == 'edit' AND $msg == ''){
							?>
								<img class="img-thumbnail rounded col-3 mb-3" src="<?=resources($img_mapel)?>" alt="<?=$nama_mapel?>"/>
							<?php
							}
							
							form_input([
								'name' => 'file_gambar_mapel',
								'label' => 'Gambar Mata Pelajaran',
								'type' => 'file',
								'accept' => 'image/*',
								'required' => $required_img,
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