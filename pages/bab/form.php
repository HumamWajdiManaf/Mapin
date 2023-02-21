<?php
	$id_materi = dekrip($_GET['id_materi']);
	$getmateri = query_row("SELECT * FROM tbl_materi WHERE id_materi='".$id_materi."'");
	$getmapel = query_row("SELECT * FROM tbl_mapel WHERE id_mapel='".$getmateri['id_mapel']."'");
	
	$msg = '';
	$required_file = true;
	$aksi = (isset($_GET['id']) ? 'edit' : 'tambah');
	$id_bab = '';
	$nama_bab = '';
	$no_bab = '';
	
	if($aksi == 'tambah'){
		$getno = query_row("SELECT IFNULL(MAX(no_bab)+1,1) as no FROM tbl_bab WHERE id_materi='".$id_materi."'");
		$no_bab = $getno['no'];
	}else if($aksi == 'edit'){
		$required_file = false;
		$data = mysqli_query($koneksi, "SELECT * FROM tbl_bab WHERE id_bab='".dekrip($_GET['id'])."'") or die (mysqli_error($koneksi));
		if(mysqli_num_rows($data) != 1){
			$msg = 'Data tidak ditemukan!';
		}else{
			$data = mysqli_fetch_array($data);
			$id_bab = '&id='.enkrip($data['id_bab']);
			$nama_bab = $data['nama_bab'];
			$no_bab = $data['no_bab'];
		}
	}
	
	$data = get_flash('data');
	if(!empty($data)){
		$nama_bab = $data['txt_nama_bab'];
		$no_bab = $data['number_no_bab'];
	}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4">Mapel <?=$getmapel['nama_mapel']?></h4>
            <h1>BAB Materi <?=$getmateri['nama_materi']?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=materi')?>">List Mapel</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('?page=materi&id_mapel='.enkrip($getmateri['id_mapel']))?>">List Materi</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('?page=bab&id_materi='.enkrip($id_materi))?>">List BAB</a></li>
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
					<form class="d-flex flex-wrap" method="POST" enctype="multipart/form-data" action="<?=process('bab_'.$aksi.'&id_materi='.enkrip($id_materi).$id_bab)?>">
						<?php
							form_input([
								'name' => 'txt_nama_bab',
								'label' => 'Nama BAB',
								'col' => '10',
								'value' => $nama_bab,
							]);
							
							form_input([
								'name' => 'number_no_bab',
								'label' => 'Nomor BAB',
								'type' => 'number',
								'col' => '2',
								'min' => '1',
								'value' => $no_bab,
							]);
							
							if($aksi == 'edit' AND $msg == ''){
							?>
								
							<?php
							}
							
							form_input([
								'name' => 'file_bab',
								'label' => 'File BAB',
								'type' => 'file',
								'accept' => 'application/pdf',
								'required' => $required_file,
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