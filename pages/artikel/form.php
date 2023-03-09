<?php
	$msg = '';
	$required_img = true;
	$aksi = (isset($_GET['id']) ? 'edit' : 'tambah');
	$id_artikel = '';
	$nama_artikel = '';
	$keterangan_artikel = '';
	$img_artikel = '';
	$file_artikel='';
	$required_file = true;
	$penulis_artikel = '';
	$tanggal_rilis_artikel = '';
	
	if($aksi == 'edit'){
		$required_img = false;
		$data = mysqli_query($koneksi, "SELECT * FROM tbl_artikel WHERE id_artikel='".dekrip($_GET['id'])."'") or die (mysqli_error($koneksi));
		if(mysqli_num_rows($data) != 1){
			$msg = 'Data tidak ditemukan!';
		}else{
			$data = mysqli_fetch_array($data);
			$id_artikel = '&id='.enkrip($data['id_artikel']);
			$nama_artikel = $data['nama_artikel'];
			$keterangan_artikel = $data['keterangan_artikel'];
			$img_artikel = $data['img_artikel'];
			$file_artikel = $data['file_artikel'];
			$penulis_artikel = $data['penulis_artikel'];
			$tanggal_rilis_artikel = $data['tanggal_rilis_artikel'];
		}
	}
	
	$data = get_flash('data');
	if(!empty($data)){
		$nama_artikel = $data['txt_nama_artikel'];
		$keterangan_artikel = $data['txt_keterangan_artikel'];
		$penulis_artikel = $data['txt_penulis_artikel'];
		$tanggal_rilis_artikel = $data['date_tanggal_rilis_artikel'];
	}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Artikel</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=artikel')?>">List Data</a></li>
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
					<form class="d-flex flex-wrap" method="POST" enctype="multipart/form-data" action="<?=process('artikel_'.$aksi.$id_artikel)?>">
						<?php
							form_input([
								'name' => 'txt_nama_artikel',
								'label' => 'Nama Artikel',
								'value' => $nama_artikel,
							]);

							form_input([
								'name' => 'txt_penulis_artikel',
								'label' => 'Penulis Artikel',
								'required' => false,
								'value' => $penulis_artikel,
							]);
							
							form_input([
								'name' => 'txt_keterangan_artikel',
								'label' => 'Keterangan',
								'required' => false,
								'value' => $keterangan_artikel,
							]);
							
							
							if($aksi == 'edit' AND $msg == ''){
							?>
								<img class="img-thumbnail rounded col-3 mb-3" src="<?=resources($img_artikel)?>" alt="<?=$nama_artikel?>"/>
							<?php
							}
							
							form_input([
								'name' => 'file_gambar_artikel',
								'label' => 'Gambar_Artikel',
								'type' => 'file',
								'accept' => 'image/*',
								'required' => $required_img,
							]);

							form_input([
								'name' => 'file_pdf_artikel',
								'label' => 'File Artikel',
								'type' => 'file',
								'accept' => 'application/pdf',
								'required' => $required_file,
							]);

							form_input([
								'name' => 'date_tanggal_rilis_artikel',
								'label' => 'Tanggal Rilis',
								'type' => 'date',
								'col' => '2',
								'value' => $tanggal_rilis_artikel,
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