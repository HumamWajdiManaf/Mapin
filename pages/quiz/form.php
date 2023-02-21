<?php
	$id_bab = dekrip($_GET['id_bab']);
	$getbab = query_row("SELECT * FROM tbl_bab WHERE id_bab='".$id_bab."'");
	$getmateri = query_row("SELECT * FROM tbl_materi WHERE id_materi='".$getbab['id_materi']."'");
	$getmapel = query_row("SELECT * FROM tbl_mapel WHERE id_mapel='".$getmateri['id_mapel']."'");
	
	$aksi = (isset($_GET['id']) ? 'edit' : 'tambah');
	
	$msg = '';
	$id_soal = '';
	$no_soal = '';
	$pertanyaan = '';
	$jawaban_a = '';
	$jawaban_b = '';
	$jawaban_c = '';
	$jawaban_d = '';
	$jawaban_benar = '';
	
	
	if($aksi == 'tambah'){
		$getno = query_row("SELECT IFNULL(MAX(no_soal)+1,1) as no FROM tbl_soal WHERE id_bab='".$id_bab."'");
		$no_soal = $getno['no'];
	}else if($aksi == 'edit'){
		$data = mysqli_query($koneksi, "SELECT * FROM tbl_soal WHERE id_soal='".dekrip($_GET['id'])."'") or die (mysqli_error($koneksi));
		if(mysqli_num_rows($data) != 1){
			$msg = 'Data tidak ditemukan!';
		}else{
			$data = mysqli_fetch_array($data);
			$id_soal = '&id='.enkrip($data['id_soal']);
			$no_soal = $data['no_soal'];
			$pertanyaan = $data['pertanyaan'];
			$jawaban_a = $data['jawaban_a'];
			$jawaban_b = $data['jawaban_b'];
			$jawaban_c = $data['jawaban_c'];
			$jawaban_d = $data['jawaban_d'];
			$jawaban_benar = $data['jawaban_benar'];
		}
	}
	
	$data = get_flash('data');
	if(!empty($data)){
		$no_soal = $data['number_no_soal'];
		$pertanyaan = $data['txt_pertanyaan'];
		$jawaban_a = $data['txt_jawaban_a'];
		$jawaban_b = $data['txt_jawaban_b'];
		$jawaban_c = $data['txt_jawaban_c'];
		$jawaban_d = $data['txt_jawaban_d'];
		$jawaban_benar = $data['txt_jawaban_benar'];
	}
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h4 class="mt-4"><?='Mapel '.$getmapel['nama_mapel'].' / '.$getmateri['no_materi'].'. '.$getmateri['nama_materi']?></h4>
            <h1><?='BAB '.$getbab['no_bab'].'. '.$getbab['nama_bab']?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?=base_url('?page=quiz')?>">List BAB</a></li>
                <li class="breadcrumb-item active"><a href="<?=base_url('?page=quiz_list&id='.enkrip($id_bab))?>">List Quiz</a></li>
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
					<form class="d-flex flex-wrap" method="POST" enctype="multipart/form-data" action="<?=process('quiz_'.$aksi.'&id_bab='.enkrip($id_bab).$id_soal)?>">
						<?php
							form_input([
								'name' => 'txt_pertanyaan',
								'value' => $pertanyaan,
							]);
							
							form_input([
								'name' => 'txt_jawaban_a',
								'col' => '6',
								'value' => $jawaban_a,
							]);
							
							form_input([
								'name' => 'txt_jawaban_b',
								'col' => '6',
								'required' => FALSE,
								'value' => $jawaban_b,
							]);
							
							form_input([
								'name' => 'txt_jawaban_c',
								'col' => '6',
								'required' => FALSE,
								'value' => $jawaban_c,
							]);
							
							form_input([
								'name' => 'txt_jawaban_d',
								'col' => '6',
								'required' => FALSE,
								'value' => $jawaban_d,
							]);
							
							form_input([
								'name' => 'txt_jawaban_benar',
								'type' => 'select',
								'col' => '2',
								'population' => ['A'=>'A','B'=>'B','C'=>'C','D'=>'D'],
								'value' => $jawaban_benar,
							]);
							
							form_input([
								'name' => 'number_no_soal',
								'label' => 'Nomor Soal',
								'type' => 'number',
								'col' => '2',
								'min' => '1',
								'value' => $no_soal,
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