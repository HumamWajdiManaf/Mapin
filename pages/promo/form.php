<?php
	$msg = '';
	$required_img = true;
	$aksi = (isset($_GET['id']) ? 'edit' : 'tambah');
	$id_promo = '';
	$nama_promo = '';
	$kelas_promo = '';
	$keterangan_promo = '';
	$img_promo = '';
	
	if($aksi == 'edit'){
		$required_img = false;
		$data = mysqli_query($koneksi, "SELECT * FROM tbl_promo WHERE id_promo='".dekrip($_GET['id'])."'") or die (mysqli_error($koneksi));
		if(mysqli_num_rows($data) != 1){
			$msg = 'Data tidak ditemukan!';
		}else{
			$data = mysqli_fetch_array($data);
			$id_promo = '&id='.enkrip($data['id_promo']);
			$nama_promo = $data['nama_promo'];
			$kelas_promo = $data['kelas_promo'];
			$keterangan_promo = $data['keterangan_promo'];
			$img_promo = $data['img_promo'];
		}
	}
	
	$data = get_flash('data');
	if(!empty($data)){
		$nama_promo = $data['txt_nama_promo'];
		$keterangan_promo = $data['txt_keterangan_promo'];
		$kelas_promo = $data['txt_kelas_promo'];
	}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Promo</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=promo')?>">List Data</a></li>
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
					<form class="d-flex flex-wrap" method="POST" enctype="multipart/form-data" action="<?=process('promo_'.$aksi.$id_promo)?>">
						<?php
							form_input([
								'name' => 'txt_kelas_promo',
								'type' => 'select',
								'col' => '2',
								'population' => ['7'=>'7','8'=>'8','9'=>'9'],
								'value' => $kelas_promo,
							]);

							form_input([
								'name' => 'txt_nama_promo',
								'label' => 'Nama Promo',
								'value' => $nama_promo,
							]);
							
							form_input([
								'name' => 'txt_keterangan_promo',
								'label' => 'Keterangan',
								'required' => false,
								'value' => $keterangan_promo,
							]);
							
							if($aksi == 'edit' AND $msg == ''){
							?>
								<img class="img-thumbnail rounded col-3 mb-3" src="<?=resources($img_promo)?>" alt="<?=$nama_promo?>"/>
							<?php
							}
							
							form_input([
								'name' => 'file_gambar_promo',
								'label' => 'Gambar Promo',
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