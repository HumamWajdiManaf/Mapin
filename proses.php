<?php
	include "functionku.php";
	switch(strtolower($_GET['aksi'])){
		case 'login':
			login();
			break;
		case 'logout':
			logout();
			break;
		case 'mapel_tambah':
			mapel_tambah();
			break;
		case 'mapel_edit':
			mapel_edit();
			break;
		case 'mapel_hapus':
			mapel_hapus();
			break;
		case 'materi_tambah':
			materi_tambah();
			break;
		case 'materi_edit':
			materi_edit();
			break;
		case 'materi_hapus':
			materi_hapus();
			break;
		case 'bab_tambah':
			bab_tambah();
			break;
		case 'bab_edit':
			bab_edit();
			break;
		case 'bab_hapus':
			bab_hapus();
			break;
		case 'quiz_tambah':
			quiz_tambah();
			break;
		case 'quiz_edit':
			quiz_edit();
			break;
		case 'quiz_hapus':
			quiz_hapus();
			break;
		case 'promo_tambah':
			promo_tambah();
			break;
		case 'promo_edit':
			promo_edit();
			break;
		case 'promo_hapus':
			promo_hapus();
			break;
		case 'artikel_tambah':
			artikel_tambah();
			break;
		case 'artikel_edit':
			artikel_edit();
			break;
		case 'artikel_hapus':
			artikel_hapus();
			break;
			case 'user_tambah':
				user_tambah();
				break;
			case 'user_edit':
				user_edit();
				break;
			case 'user_hapus':
				user_hapus();
				break;
		
	}
	
	function login(){
		$login = FALSE;
		$username = $_POST['txt_username'];
		$password = $_POST['txt_password'];
		$getdata = mysqli_query($GLOBALS['koneksi'], "SELECT * FROM tbl_user") or die (mysqli_error($GLOBALS['koneksi']));
		while($row = mysqli_fetch_assoc($getdata)){
			if($username == $row['user_name'] AND $password == dekrip($row['user_password'])){
				$login = TRUE;
				$_SESSION['user'] = [
					'id_user' => enkrip($row['id_user']),
					'full_name' => $row['full_name'],
					'user_name' => $row['user_name'],
					'user_level' => $row['user_level'],
				];
			}
		}
		if($login){
			set_flash('toast',set_toast('Halo!','Selamat datang kembali '.$_SESSION['user']['full_name'].'.','info'));
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Akun tidak ditemukan!','Cek kembali username dan password Anda!','danger'));
		}
		redirect(base_url());
	}
	
	function logout(){
		unset($_SESSION['user']);
		set_flash('toast',set_toast('Informasi','Anda telah logout!'));
		redirect(base_url());
	}
	
	
	function mapel_tambah(){
		$file = get_file($_FILES['file_gambar_mapel']);
		$filename = 'assets/img/img_mapel_'.time().'.'.$file['ext'];
		$id_mapel = 'MPL-'.randomstring();
		
		$data = [
			'id_mapel' => $id_mapel,
			'nama_mapel' => $_POST['txt_nama_mapel'],
			'keterangan_mapel' => $_POST['txt_keterangan_mapel'],
			'img_mapel' => $filename,
			'created_by' => dekrip($_SESSION['user']['id_user']),
			'created_date' => date('Y-m-d H:i:s'),
		];
		
		if(mysqli_query($GLOBALS['koneksi'], query_insert('tbl_mapel',$data))){
			if(upload_file($file['tmp'],$filename)){
				set_flash('toast',set_toast('Berhasil','Mata Pelajaran '.$data['nama_mapel'].' berhasil disimpan.','success'));
				redirect(base_url('?page=mapel'));
			}else{
				query_delete('tbl_mapel',"id_mapel='".$id_mapel."'");
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=mapel_form'));
			}
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
			redirect(base_url('?page=mapel_form'));
		}
	}
	
	function mapel_edit(){
		$id_mapel = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_mapel WHERE id_mapel='".$id_mapel."'");
		$data = [
			'nama_mapel' => $_POST['txt_nama_mapel'],
			'keterangan_mapel' => $_POST['txt_keterangan_mapel'],
			'modify_by' => dekrip($_SESSION['user']['id_user']),
			'modify_date' => date('Y-m-d H:i:s'),
		];
		$file = get_file($_FILES['file_gambar_mapel']);
		if(!empty($file['tmp'])){
			$filename = 'assets/img/img_mapel_'.time().'.'.$file['ext'];
			$data['img_mapel'] = $filename;
		}
		if(mysqli_query($GLOBALS['koneksi'], query_update('tbl_mapel',$data,"id_mapel='".$id_mapel."'"))){
			$success = true;
			if(!empty($file['tmp'])){
				if(upload_file($file['tmp'],$filename)){
				}else{
					$success = false;
				}
			}
			if($success){
				if(!empty($file['tmp'])){
					delete_file($getdata['img_mapel']);
				}
				set_flash('toast',set_toast('Berhasil','Mata Pelajaran '.$data['nama_mapel'].' berhasil di edit.','success'));
				redirect(base_url('?page=mapel'));
			}else{
				mysqli_query($GLOBALS['koneksi'], query_update('tbl_mapel',$getdata,"id_mapel='".$id_mapel."'"));
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=mapel_form&id='.enkrip($id_mapel)));
			}
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
			redirect(base_url('?page=mapel_form&id='.enkrip($id_mapel)));
		}
	}
	
	function mapel_hapus(){
		$id_mapel = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_mapel WHERE id_mapel='".$id_mapel."'");
		if(query_delete('tbl_mapel',"id_mapel='".$id_mapel."'")){
			delete_file($getdata['img_mapel']);
			set_flash('toast',set_toast('Berhasil','Mata Pelajaran '.$getdata['nama_mapel'].' berhasil di hapus.','success'));
		}else{
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
		}
		redirect(base_url('?page=mapel'));
	}
	
	function materi_tambah(){
		$id_mapel = dekrip($_GET['id_mapel']);
		$id_materi = 'MTR-'.randomstring();
		$cekdata = query_row("SELECT COUNT(no_materi) as no FROM tbl_materi WHERE id_mapel='".$id_mapel."' AND no_materi='".$_POST['number_no_materi']."'");
		if($cekdata['no'] == '1'){
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal','Nomor Materi '.$_POST['number_no_materi'].' sudah ada!','danger'));
			redirect(base_url('?page=materi_form&id_mapel='.enkrip($id_mapel)));
		}else{
			$data = [
				'id_materi' => $id_materi,
				'id_mapel' => $id_mapel,
				'no_materi' => $_POST['number_no_materi'],
				'nama_materi' => $_POST['txt_nama_materi'],
				'penulis_materi' => $_POST['txt_penulis_materi'],
				'tanggal_rilis_materi' => $_POST['date_tanggal_rilis'],
				'created_by' => dekrip($_SESSION['user']['id_user']),
				'created_date' => date('Y-m-d H:i:s'),
			];
			
			if(mysqli_query($GLOBALS['koneksi'], query_insert('tbl_materi',$data))){
				set_flash('toast',set_toast('Berhasil','Materi '.$data['nama_materi'].' berhasil disimpan.','success'));
				redirect(base_url('?page=materi&id_mapel='.enkrip($id_mapel)));
			}else{
				set_flash('data',$_POST);
				set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
				redirect(base_url('?page=materi_form&id_mapel='.enkrip($id_mapel)));
			}
		}
	}
	
	function materi_edit(){
		$cek = FALSE;
		$id_mapel = dekrip($_GET['id_mapel']);
		$id_materi = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_materi WHERE id_materi='".$id_materi."'");
		if($getdata['no_materi'] != $_POST['number_no_materi']){
			$cekdata = query_row("SELECT COUNT(no_materi) as no FROM tbl_materi WHERE id_mapel='".$id_mapel."' AND no_materi='".$_POST['number_no_materi']."'");
			if($cekdata['no'] == '1'){
				set_flash('data',$_POST);
				set_flash('toast',set_toast('Gagal','Nomor Materi '.$_POST['number_no_materi'].' sudah ada!','danger'));
				redirect(base_url('?page=materi_form&id_mapel='.enkrip($id_mapel).'&id='.enkrip($id_materi)));
			}else{
				$cek = TRUE;
			}
		}else{
			$cek = TRUE;
		}
		if($cek){
			$data = [
				'no_materi' => $_POST['number_no_materi'],
				'nama_materi' => $_POST['txt_nama_materi'],
				'penulis_materi' => $_POST['txt_penulis_materi'],
				'tanggal_rilis_materi' => $_POST['date_tanggal_rilis'],
				'modify_by' => dekrip($_SESSION['user']['id_user']),
				'modify_date' => date('Y-m-d H:i:s'),
			];
			if(mysqli_query($GLOBALS['koneksi'], query_update('tbl_materi',$data,"id_materi='".$id_materi."'"))){
				set_flash('toast',set_toast('Berhasil','Materi '.$data['nama_materi'].' berhasil di edit.','success'));
				redirect(base_url('?page=materi&id_mapel='.enkrip($id_mapel)));
			}else{
				set_flash('data',$_POST);
				set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
				redirect(base_url('?page=materi_form&id_mapel='.enkrip($id_mapel).'&id='.enkrip($id_materi)));
			}
		}
	}
	
	function materi_hapus(){
		$id_mapel = dekrip($_GET['id_mapel']);
		$id_materi = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_materi WHERE id_materi='".$id_materi."'");
		if(query_delete('tbl_materi',"id_materi='".$id_materi."'")){
			set_flash('toast',set_toast('Berhasil','Materi '.$getdata['nama_materi'].' berhasil di hapus.','success'));
		}else{
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
		}
		redirect(base_url('?page=materi&id_mapel='.enkrip($id_mapel)));
	}
	
	function bab_tambah(){
		$id_materi = dekrip($_GET['id_materi']);
		$file = get_file($_FILES['file_bab']);
		if($file['ext'] != 'pdf'){
			set_flash('data',$_POST);
			set_flash('toast',set_toast('File','Format file harus PDF!','danger'));
			redirect(base_url('?page=bab_form&id_materi='.enkrip($id_materi)));
		}else{
			$cekdata = query_row("SELECT COUNT(no_bab) as no FROM tbl_bab WHERE id_materi='".$id_materi."' AND no_bab='".$_POST['number_no_bab']."'");
			if($cekdata['no'] == '1'){
				set_flash('data',$_POST);
				set_flash('toast',set_toast('Gagal','Nomor BAB '.$_POST['number_no_bab'].' sudah ada!','danger'));
				redirect(base_url('?page=bab_form&id_materi='.enkrip($id_materi)));
			}else{
				$filename = 'assets/bab/file_bab_'.time().'.'.$file['ext'];
				$id_bab = 'BAB-'.randomstring();
				
				$data = [
					'id_bab' => $id_bab,
					'id_materi' => $id_materi,
					'no_bab' => $_POST['number_no_bab'],
					'nama_bab' => $_POST['txt_nama_bab'],
					'file_bab' => $filename,
					'created_by' => dekrip($_SESSION['user']['id_user']),
					'created_date' => date('Y-m-d H:i:s'),
				];
				
				if(mysqli_query($GLOBALS['koneksi'], query_insert('tbl_bab',$data))){
					if(upload_file($file['tmp'],$filename)){
						set_flash('toast',set_toast('Berhasil','BAB '.$data['nama_bab'].' berhasil disimpan.','success'));
						redirect(base_url('?page=bab&id_materi='.enkrip($id_materi)));
					}else{
						query_delete('tbl_bab',"id_bab='".$id_bab."'");
						set_flash('data',$_POST);
						set_flash('toast',set_toast('File','File gagal di upload!','danger'));
						redirect(base_url('?page=bab_form&id_materi='.enkrip($id_materi)));
					}
				}else{
					set_flash('data',$_POST);
					set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
					redirect(base_url('?page=bab_form&id_materi='.enkrip($id_materi)));
				}
			}
		}
	}
	
	function bab_edit(){
		$cek = FALSE;
		$id_materi = dekrip($_GET['id_materi']);
		$id_bab = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_bab WHERE id_bab='".$id_bab."'");
		if($getdata['no_bab'] != $_POST['number_no_bab']){
			$cekdata = query_row("SELECT COUNT(no_bab) as no FROM tbl_bab WHERE id_materi='".$id_materi."' AND no_bab='".$_POST['number_no_bab']."'");
			if($cekdata['no'] == '1'){
				set_flash('data',$_POST);
				set_flash('toast',set_toast('Gagal','Nomor BAB '.$_POST['number_no_bab'].' sudah ada!','danger'));
				redirect(base_url('?page=bab_form&id_materi='.enkrip($id_materi).'&id='.enkrip($id_bab)));
			}else{
				$cek = TRUE;
			}
		}else{
			$cek = TRUE;
		}
		if($cek){
			$data = [
				'no_bab' => $_POST['number_no_bab'],
				'nama_bab' => $_POST['txt_nama_bab'],
				'modify_by' => dekrip($_SESSION['user']['id_user']),
				'modify_date' => date('Y-m-d H:i:s'),
			];
			$cek = FALSE;
			$file = get_file($_FILES['file_bab']);
			if(!empty($file['tmp'])){
				if($file['ext'] != 'pdf'){
					set_flash('data',$_POST);
					set_flash('toast',set_toast('File','Format file harus PDF!','danger'));
					redirect(base_url('?page=bab_form&id_materi='.enkrip($id_materi).'&id='.enkrip($id_bab)));
				}else{
					$filename = 'assets/bab/file_bab_'.time().'.'.$file['ext'];
					$data['file_bab'] = $filename;
					$cek = TRUE;
				}
			}else{
				$cek = TRUE;
			}
			if($cek){
				if(mysqli_query($GLOBALS['koneksi'], query_update('tbl_bab',$data,"id_bab='".$id_bab."'"))){
					if(!empty($file['tmp'])){
						if(upload_file($file['tmp'],$filename)){
						}else{
							$cek = false;
						}
					}
					if($cek){
						if(!empty($file['tmp'])){
							delete_file($getdata['file_bab']);
						}
						set_flash('toast',set_toast('Berhasil','BAB '.$data['nama_bab'].' berhasil di edit.','success'));
						redirect(base_url('?page=bab&id_materi='.enkrip($id_materi)));
					}else{
						mysqli_query($GLOBALS['koneksi'], query_update('tbl_bab',$getdata,"id_bab='".$id_bab."'"));
						set_flash('data',$_POST);
						set_flash('toast',set_toast('File','File gagal di upload!','danger'));
						redirect(base_url('?page=bab_form&id_materi='.enkrip($id_materi).'&id='.enkrip($id_bab)));
					}
				}else{
					set_flash('data',$_POST);
					set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
					redirect(base_url('?page=bab_form&id_materi='.enkrip($id_materi).'&id='.enkrip($id_bab)));
				}
			}
		}
		
	}
	
	function bab_hapus(){
		$id_materi = dekrip($_GET['id_materi']);
		$id_bab = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_bab WHERE id_bab='".$id_bab."'");
		if(query_delete('tbl_bab',"id_bab='".$id_bab."'")){
			delete_file($getdata['file_bab']);
			set_flash('toast',set_toast('Berhasil','BAB '.$getdata['nama_bab'].' berhasil di hapus.','success'));
		}else{
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
		}
		redirect(base_url('?page=bab&id_materi='.enkrip($id_materi)));
	}
	
	function quiz_tambah(){
		$id_bab = dekrip($_GET['id_bab']);
		$id_soal = 'SOL-'.randomstring();
		$cekdata = query_row("SELECT COUNT(no_soal) as no FROM tbl_soal WHERE id_bab='".$id_bab."' AND no_soal='".$_POST['number_no_soal']."'");
		if($cekdata['no'] == '1'){
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal','Nomor Soal '.$_POST['number_no_soal'].' sudah ada!','danger'));
			redirect(base_url('?page=quiz_form&id_bab='.enkrip($id_bab)));
		}else{
			$data = [
				'id_soal' => $id_soal,
				'id_bab' => $id_bab,
				'no_soal' => $_POST['number_no_soal'],
				'pertanyaan' => $_POST['txt_pertanyaan'],
				'jawaban_a' => $_POST['txt_jawaban_a'],
				'jawaban_b' => $_POST['txt_jawaban_b'],
				'jawaban_c' => $_POST['txt_jawaban_c'],
				'jawaban_d' => $_POST['txt_jawaban_d'],
				'jawaban_benar' => $_POST['txt_jawaban_benar'],
				'created_by' => dekrip($_SESSION['user']['id_user']),
				'created_date' => date('Y-m-d H:i:s'),
			];
			
			if(mysqli_query($GLOBALS['koneksi'], query_insert('tbl_soal',$data))){
				set_flash('toast',set_toast('Berhasil','Soal '.$data['pertanyaan'].' berhasil disimpan.','success'));
				redirect(base_url('?page=quiz_list&id='.enkrip($id_bab)));
			}else{
				set_flash('data',$_POST);
				set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
				redirect(base_url('?page=quiz_form&id_bab='.enkrip($id_bab)));
			}
		}
	}
	
	function quiz_edit(){
		$cek = FALSE;
		$id_bab = dekrip($_GET['id_bab']);
		$id_soal = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_soal WHERE id_soal='".$id_soal."'");
		if($getdata['no_soal'] != $_POST['number_no_soal']){
			$cekdata = query_row("SELECT COUNT(no_soal) as no FROM tbl_soal WHERE id_bab='".$id_bab."' AND no_soal='".$_POST['number_no_soal']."'");
			if($cekdata['no'] == '1'){
				set_flash('data',$_POST);
				set_flash('toast',set_toast('Gagal','Nomor Soal '.$_POST['number_no_soal'].' sudah ada!','danger'));
				redirect(base_url('?page=quiz_form&id_bab='.enkrip($id_bab).'&id='.enkrip($id_soal)));
			}else{
				$cek = TRUE;
			}
		}else{
			$cek = TRUE;
		}
		if($cek){
			$data = [
				'no_soal' => $_POST['number_no_soal'],
				'pertanyaan' => $_POST['txt_pertanyaan'],
				'jawaban_a' => $_POST['txt_jawaban_a'],
				'jawaban_b' => $_POST['txt_jawaban_b'],
				'jawaban_c' => $_POST['txt_jawaban_c'],
				'jawaban_d' => $_POST['txt_jawaban_d'],
				'jawaban_benar' => $_POST['txt_jawaban_benar'],
				'modify_by' => dekrip($_SESSION['user']['id_user']),
				'modify_date' => date('Y-m-d H:i:s'),
			];
			if(mysqli_query($GLOBALS['koneksi'], query_update('tbl_soal',$data,"id_soal='".$id_soal."'"))){
				set_flash('toast',set_toast('Berhasil','Soal '.$data['pertanyaan'].' berhasil di edit.','success'));
				redirect(base_url('?page=quiz_list&id='.enkrip($id_bab)));
			}else{
				set_flash('data',$_POST);
				set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
				redirect(base_url('?page=quiz_form&id_bab='.enkrip($id_bab).'&id='.enkrip($id_soal)));
			}
		}
	}
	
	function quiz_hapus(){
		$id_bab = dekrip($_GET['id_bab']);
		$id_soal = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_soal WHERE id_soal='".$id_soal."'");
		if(query_delete('tbl_soal',"id_soal='".$id_soal."'")){
			set_flash('toast',set_toast('Berhasil','Soal '.$getdata['pertanyaan'].' berhasil di hapus.','success'));
		}else{
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
		}
		redirect(base_url('?page=quiz_list&id='.enkrip($id_bab)));
	}
	function promo_tambah(){
		$file = get_file($_FILES['file_gambar_promo']);
		$filename = 'assets/img/img_promo_'.time().'.'.$file['ext'];
		$id_promo = 'PRM-'.randomstring();
		
		$data = [
			'id_promo' => $id_promo,
			'nama_promo' => $_POST['txt_nama_promo'],
			'kelas_promo' => $_POST['txt_kelas_promo'],
			'keterangan_promo' => $_POST['txt_keterangan_promo'],
			'img_promo' => $filename,
			'created_by' => dekrip($_SESSION['user']['id_user']),
			'created_date' => date('Y-m-d H:i:s'),
		];
		
		if(mysqli_query($GLOBALS['koneksi'], query_insert('tbl_promo',$data))){
			if(upload_file($file['tmp'],$filename)){
				set_flash('toast',set_toast('Berhasil','Promo '.$data['nama_promo'].' berhasil disimpan.','success'));
				redirect(base_url('?page=promo'));
			}else{
				query_delete('tbl_promo',"id_promo='".$id_promo."'");
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=promo_form'));
			}
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
			redirect(base_url('?page=promo_form'));
		}
	}
	function promo_edit(){
		$id_promo = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_promo WHERE id_promo='".$id_promo."'");
		$data = [
			'id_promo' => $id_promo,
			'nama_promo' => $_POST['txt_nama_promo'],
			'kelas_promo' => $_POST['txt_kelas_promo'],
			'keterangan_promo' => $_POST['txt_keterangan_promo'],
			'modify_by' => dekrip($_SESSION['user']['id_user']),
			'modify_date' => date('Y-m-d H:i:s'),
		];
		$file = get_file($_FILES['file_gambar_promo']);
		if(!empty($file['tmp'])){
			$filename = 'assets/img/img_promo_'.time().'.'.$file['ext'];
			$data['img_promo'] = $filename;
		}
		if(mysqli_query($GLOBALS['koneksi'], query_update('tbl_promo',$data,"id_promo='".$id_promo."'"))){
			$success = true;
			if(!empty($file['tmp'])){
				if(upload_file($file['tmp'],$filename)){
				}else{
					$success = false;
				}
			}
			if($success){
				if(!empty($file['tmp'])){
					delete_file($getdata['img_promo']);
				}
				set_flash('toast',set_toast('Berhasil','Promo'.$data['nama_promo'].' berhasil di edit.','success'));
				redirect(base_url('?page=promo'));
			}else{
				mysqli_query($GLOBALS['koneksi'], query_update('tbl_promo',$getdata,"id_promo='".$id_promo."'"));
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=promo_form='.enkrip($id_promo)));
			}
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
			redirect(base_url('?page=promo_form='.enkrip($id_promo)));
		}
	}
	function promo_hapus(){
		$id_promo = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_promo WHERE id_promo='".$id_promo."'");
		if(query_delete('tbl_promo',"id_promo='".$id_promo."'")){
			delete_file($getdata['img_promo']);
			set_flash('toast',set_toast('Berhasil','Mata Pelajaran '.$getdata['nama_promo'].' berhasil di hapus.','success'));
		}else{
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
		}
		redirect(base_url('?page=promo'));
	}

	function artikel_tambah(){
		$file_gambar = get_file($_FILES['file_gambar_artikel']);
		$file_artikel = get_file($_FILES['file_pdf_artikel']);
		$filename_gambar = 'assets/img/img_artikel_'.time().'.'.$file_gambar['ext'];
		$filename_artikel = 'assets/files/file_artikel_'.time().'.'.$file_artikel['ext'];
		$id_artikel = 'ATK-'.randomstring();
		
		$data = [
			'id_artikel' => $id_artikel,
			'nama_artikel' => $_POST['txt_nama_artikel'],
			'penulis_artikel' => $_POST['txt_penulis_artikel'],
			'keterangan_artikel' => $_POST['txt_keterangan_artikel'],
			'file_artikel' => $filename_artikel,
			'tanggal_rilis_artikel' => $_POST['date_tanggal_rilis_artikel'],
			'img_artikel' => $filename_gambar,
			'created_by' => dekrip($_SESSION['user']['id_user']),
			'created_date' => date('Y-m-d H:i:s'),
		];
		
		if(mysqli_query($GLOBALS['koneksi'], query_insert('tbl_artikel',$data))){
			if(upload_file($file_gambar['tmp'],$filename_gambar)){
				//set_flash('toast',set_toast('Berhasil','Artikel '.$data['nama_artikel'].' berhasil disimpan.','success'));
				//redirect(base_url('?page=artikel'));
			}else{
				query_delete('tbl_artikel',"id_artikel='".$id_artikel."'");
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=artikel_form'));
			}
			if(upload_file($file_artikel['tmp'],$filename_artikel)){
				set_flash('toast',set_toast('Berhasil','Artikel '.$data['nama_artikel'].' berhasil disimpan.','success'));
				redirect(base_url('?page=artikel'));
			}else{
				query_delete('tbl_artikel',"id_artikel='".$id_artikel."'");
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=artikel_form'));
			}
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
			redirect(base_url('?page=artikel_form'));
		}
	}
	function artikel_edit(){
		$id_artikel = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_artikel WHERE id_artikel='".$id_artikel."'");
		$data = [
			'nama_artikel' => $_POST['txt_nama_artikel'],
			'penulis_artikel' => $_POST['txt_penulis_artikel'],
			'keterangan_artikel' => $_POST['txt_keterangan_artikel'],
			'tanggal_rilis_artikel' => $_POST['date_tanggal_rilis_artikel'],
			'modify_by' => dekrip($_SESSION['user']['id_user']),
			'modify_date' => date('Y-m-d H:i:s'),
		];
		$file_gambar = get_file($_FILES['file_gambar_artikel']);
		$file_artikel = get_file($_FILES['file_pdf_artikel']);
		if(!empty($file_gambar['tmp'])){
			$filename_gambar = 'assets/img/img_artikel_'.time().'.'.$file_gambar['ext'];
			$data['img_artikel'] = $filename_gambar;
		}
		if(!empty($file_artikel['tmp'])){
			$filename_artikel = 'assets/files/file_artikel_'.time().'.'.$file_artikel['ext'];
			$data['file_artikel'] = $filename_artikel;
		}
		if(mysqli_query($GLOBALS['koneksi'], query_update('tbl_artikel',$data,"id_artikel='".$id_artikel."'"))){
			$success = true;
			if(!empty($file_gambar['tmp'])){
				if(upload_file($file_gambar['tmp'],$filename_gambar)){
				}else{
					$success = false;
				}
			}
			if(!empty($file_artikel['tmp'])){
				if(upload_file($file_artikel['tmp'],$filename_artikel)){
				}else{
					$success = false;
				}
			}
			if($success){
				if(!empty($file_gambar['tmp'])){
					delete_file($getdata['img_artikel']);
				}
				if(!empty($file_artikel['tmp'])){
					delete_file($getdata['file_artikel']);
				}
				set_flash('toast',set_toast('Berhasil','Artikel'.$data['nama_artikel'].' berhasil di edit.','success'));
				redirect(base_url('?page=artikel'));
			}else{
				mysqli_query($GLOBALS['koneksi'], query_update('tbl_artikel',$getdata,"id_artikel='".$id_artikel."'"));
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=artikel_form&id='.enkrip($id_artikel)));
			}
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
			redirect(base_url('?page=artikel_form&id='.enkrip($id_artikel)));
		}
	}
	function artikel_hapus(){
		$id_artikel = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_artikel WHERE id_artikel='".$id_artikel."'");
		if(query_delete('tbl_artikel',"id_artikel='".$id_artikel."'")){
			delete_file($getdata['img_artikel']);
			set_flash('toast',set_toast('Berhasil','Artikel '.$getdata['nama_artikel'].' berhasil di hapus.','success'));
		}else{
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
		}
		redirect(base_url('?page=artikel'));
	}

	//user function by Alif

	function user_tambah(){
		$file = get_file($_FILES['file_gambar_user']);
		$filename = 'assets/img/img_user_'.time().'.'.$file['ext'];
		$id_user = 'USR-'.randomstring();
		
		$data = [
			'id_user2' => $id_user,
			'nama_user2' => $_POST['txt_nama_user'],
			'nama' => $_POST['txt_nama'],
			'keterangan_user2' => $_POST['txt_keterangan_user'],
			'img_user2' => $filename,

		];
		
		if(mysqli_query($GLOBALS['koneksi'], query_insert('tbl_user2',$data))){
			if(upload_file($file['tmp'],$filename)){
				set_flash('toast',set_toast('Berhasil','User '.$data['nama_user2'].' berhasil disimpan.','success'));
				redirect(base_url('?page=user'));
			}else{
				query_delete('tbl_user2',"id_user2='".$id_user."'");
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=user_form'));
			}
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
			redirect(base_url('?page=user_form'));
		}
	}
	function user_edit(){
		$id_user = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_user2 WHERE id_user2='".$id_user."'");
		$data = [
			'nama_user2' => $_POST['txt_nama_user'],
			'nama' => $_POST['txt_nama'],
			'keterangan_user2' => $_POST['txt_keterangan_user'],
			
		];
		$file = get_file($_FILES['file_gambar_user']);
		if(!empty($file['tmp'])){
			$filename = 'assets/img/img_user_'.time().'.'.$file['ext'];
			$data['img_user'] = $filename;
		}
		if(mysqli_query($GLOBALS['koneksi'], query_update('tbl_user2',$data,"id_user2='".$id_user."'"))){
			$success = true;
			if(!empty($file['tmp'])){
				if(upload_file($file['tmp'],$filename)){
				}else{
					$success = false;
				}
			}
			if($success){
				if(!empty($file['tmp'])){
					delete_file($getdata['img_user2']);
				}
				set_flash('toast',set_toast('Berhasil','User'.$data['nama_user'].' berhasil di edit.','success'));
				redirect(base_url('?page=user'));
			}else{
				mysqli_query($GLOBALS['koneksi'], query_update('tbl_user2',$getdata,"id_user2='".$id_user."'"));
				set_flash('data',$_POST);
				set_flash('toast',set_toast('File','File gagal di upload!','danger'));
				redirect(base_url('?page=user_form&id='.enkrip($id_user)));
			}
		}else{
			set_flash('data',$_POST);
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
			redirect(base_url('?page=user_form&id='.enkrip($id_user)));
		}
	}
	function user_hapus(){
		$id_user = dekrip($_GET['id']);
		$getdata = query_row("SELECT * FROM tbl_user2 WHERE id_user2='".$id_user."'");
		if(query_delete('tbl_user2',"id_user2='".$id_user."'")){
			delete_file($getdata['img_user2']);
			set_flash('toast',set_toast('Berhasil','User '.$getdata['nama_user2'].' berhasil di hapus.','success'));
		}else{
			set_flash('toast',set_toast('Gagal',addslashes(mysqli_error($GLOBALS['koneksi'])),'danger'));
		}
		redirect(base_url('?page=user'));
	}
?>