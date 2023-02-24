<?php
	$msg = '';
	$required_img = true;
	$aksi = (isset($_GET['id']) ? 'edit' : 'tambah');
	$id_user= '';
	$id_hasil = '';
    $id_jawaban = '';
    $id_mapel = '';
	$id_quiz = '';
    $tanggal_mengerjakan = '';
	$img_profil = '';
	
	if($aksi == 'edit'){
		$required_img = false;
		$data = mysqli_query($koneksi, "SELECT * FROM tbl_history WHERE id_user='".dekrip($_GET['id'])."'") or die (mysqli_error($koneksi));
		if(mysqli_num_rows($data) != 1){
			$msg = 'Data tidak ditemukan!';
		}else{
			$data = mysqli_fetch_array($data);
			$id_user = '&id='.enkrip($data['id_user']);
			$id_mapel = $data[''];
            $tanggal_mengerjakann = $data['tanggal_mengerjakan'];
			$id_quiz = $data['id_quiz'];
            $id_hasil = $data['id_hasil'];
            $id_jawaban = $data['id_jawaban'];
			$img_profil = $data['img_user'];
		}
	}
	
	$data = get_flash('data');
	if(!empty($data)){
		$id_mapel = $data[''];
        $tanggal_mengerjakann = $data['tanggal_mengerjakan'];
		$id_quiz = $data['id_quiz'];
        $id_hasil = $data['id_hasil'];
        $id_jawaban = $data['id_jawaban'];
		$img_profil = $data['img_user'];
	}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">History</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=history')?>">List Data</a></li>
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
					<form class="d-flex flex-wrap" method="POST" enctype="multipart/form-data" action="<?=process('history_'.$aksi.$id_user)?>">
						<?php
                            
							form_input([
								'name' => 'txt_nama_user',
								'label' => 'Nama User',
								'value' => $nama_user,
							]);

							form_input([
								'name' => 'txt_nama',
								'label' => 'Nama',
								'required' => false,
								'value' => $nama,
							]);
							
							form_input([
								'name' => 'txt_keterangan_user',
								'label' => 'Keterangan',
								'required' => false,
								'value' => $keterangan_user,
							]);
							
							
							if($aksi == 'edit' AND $msg == ''){
							?>
								<img class="img-thumbnail rounded col-3 mb-3" src="<?=resources($img_profil)?>" alt="<?=$nama_user?>"/>
							<?php
							}
							
							form_input([
								'name' => 'file_gambar_user',
								'label' => 'Gambar_User',
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