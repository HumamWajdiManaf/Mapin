<?php
	date_default_timezone_set("Asia/Jakarta");
	include "koneksi.php";
	//error_reporting(1);
	session_start();
	
	$config = [
		'app_name' => 'Admin Mapin',
		'logo' => resources('assets/logo.svg'),
	];
	
	function print_log($data){
		echo json_encode($data);
	}
	
	function base_url($url=null){
		return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].'/admin_mapin/'.$url;
	}
	
	function resources($url=null){
		return base_url('resources/'.$url);
	}
	
	function process($aksi){
		return base_url('proses.php?aksi='.$aksi);
	}
	
	function redirect($url){
		header('Location: '.$url);
	}
	
	function randomstring($length=20){
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzasdfgHJKLTRFVBFSFD6574TBBBDFG4443';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function randomnumber($length=4){
		$characters = '012345678902583697413698521478852236698558445578545785';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function enkrip($string){
		$key = "sdfjk7863875bjksbd9";
		$plaintext = $string;
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
		$ciphertext = str_replace(array('+','/','='),array('-','_',''),$ciphertext);
		return $ciphertext;
	}
	
	function dekrip($string){
		$key = "sdfjk7863875bjksbd9";
		$string = str_replace(array('-','_'),array('+','/'),$string);
		$c = base64_decode($string);
		$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len=32);
		$ciphertext_raw = substr($c, $ivlen+$sha2len);
		$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		return $original_plaintext;
	}
	
	function cek_login(){
		if(isset($_SESSION['user'])){
			return true;
		}else{
			return false;
		}
	}
	
	function footer(){
		return '
		<footer class="py-4 bg-light mt-auto">
			<div class="container-fluid px-4">
				<div class="d-flex align-items-center justify-content-between small">
					<div class="text-muted">Copyright &copy; Website '.$GLOBALS['config']['app_name'].' '.date('Y').'</div>
				</div>
			</div>
		</footer>';
	}
	
	function set_toast($title,$text,$type='info'){
		return [
			'title' => $title,
			'text' => $text,
			'type' => $type,
		];
	}
	
	function set_flash($session,$data){
		$_SESSION[strtolower($session)] = $data;
	}
	
	function get_flash($session){
		$session = strtolower($session);
		$flash = null;
		if(isset($_SESSION[$session])){
			$flash = $_SESSION[$session];
			unset($_SESSION[$session]);
		}
		return $flash;
	}
	
	function form_input($data){
		$data['label'] = (isset($data['label']) ? $data['label'] : ucwords(str_replace('_',' ',str_replace('txt_','',$data['name']))));
		$data['type'] = (isset($data['type']) ? strtolower($data['type']) : 'text');
		$data['value'] = (isset($data['value']) ? $data['value'] : '');
		$data['required'] = (isset($data['required']) ? $data['required'] : TRUE);
		$data['required'] = ($data['required'] ? 'required' : '');
		$data['readonly'] = (isset($data['readonly']) ? $data['readonly'] : FALSE);
		$data['readonly'] = ($data['readonly'] ? 'readonly' : '');
		$data['disabled'] = (isset($data['disabled']) ? $data['disabled'] : FALSE);
		$data['disabled'] = ($data['disabled'] ? 'disabled' : '');
		$data['autocomplete'] = (isset($data['autocomplete']) ? $data['autocomplete'] : FALSE);
		$data['autocomplete'] = ($data['autocomplete'] ? 'on' : 'off');
		$data['min'] = (isset($data['min']) ? 'min="'.$data['min'].'"' : '');
		$data['max'] = (isset($data['max']) ? 'max="'.$data['max'].'"' : '');
		
		$data['col'] = (isset($data['col']) ? $data['col'] : '12');
		
		if($data['type'] == 'file'){
			$data['accept'] = (isset($data['accept']) ? 'accept="'.$data['accept'].'"' : '');
			echo '
			<div class="col-12 col-lg-'.$data['col'].' input-group mb-3">
			  <button class="btn btn-secondary" type="button" id="'.$data['name'].'">'.$data['label'].'</button>
			  <input type="'.$data['type'].'" class="form-control" id="'.$data['name'].'" name="'.$data['name'].'"
					 aria-describedby="'.$data['name'].'" aria-label="Upload" '.$data['required'].' '.$data['readonly'].' '.$data['disabled'].' '.$data['accept'].'>
			</div>';
		}else if($data['type'] == 'select'){
			$data['population'] = (isset($data['population']) ? $data['population'] : []);
			$population = '';
			foreach($data['population'] as $key => $value){
				$population .= '<option value="'.$key.'" '.($data['value'] == $value ? 'selected' : '').'>'.$value.'</option>';
			}
			echo '
			<div class="col-12 col-lg-'.$data['col'].' form-floating mb-3">
			  <select id="'.$data['name'].'" name="'.$data['name'].'" class="form-select" aria-label="'.$data['name'].'" '.$data['required'].' '.$data['readonly'].' '.$data['disabled'].'>
				<option value="" '.($data['value'] == '' ? 'selected' : '').'>Pilih '.$data['label'].'</option>'.$population.'
			  </select>
			  <label for="'.$data['name'].'">'.$data['label'].'</label>
			</div>';
		}else{
			echo '
			<div class="col-12 col-lg-'.$data['col'].' form-floating mb-3">
			  <input id="'.$data['name'].'" name="'.$data['name'].'" type="'.$data['type'].'" value="'.$data['value'].'" class="form-control"
					 placeholder="'.$data['label'].'" autocomplete="'.$data['autocomplete'].'" '.$data['required'].' '.$data['readonly'].' '.$data['disabled'].' '.$data['min'].' '.$data['max'].'>
			  <label for="'.$data['name'].'">'.$data['label'].'</label>
			</div>';
		}
	}
	
	function get_file($file){
		$ext = explode(".",basename($file['name']));
		return [
			'tmp' => $file['tmp_name'],
			'name' => basename($file['name']),
			'size' => $file['size'],
			'type' => $file['type'],
			'ext' => strtolower(end($ext)),
		];
	}
	
	function upload_file($file,$dir){
		if(move_uploaded_file($file, $_SERVER['DOCUMENT_ROOT'].'/admin_mapin/resources/'.$dir)){
			return true;
		}else{
			return false;
		}
	}
	
	function delete_file($file){
		return unlink($_SERVER['DOCUMENT_ROOT'].'/admin_mapin/resources/'.$file);
	}
	
	function query_row($sql){
		$getdata = mysqli_query($GLOBALS['koneksi'], $sql) or die (mysqli_error($GLOBALS['koneksi']));
		return mysqli_fetch_assoc($getdata);
	}
	
	function query_insert($table,$data){
		$numItems = count($data);
		$i = 0;
		$query = 'INSERT INTO '.$table.' ';
		$columns = ''; $values = '';
		foreach($data as $key => $value){
			$columns .= $key;
			$values .= '"'.$value.'"';
			if(++$i != $numItems){
				$columns .= ',';
				$values .= ',';
			}
		}
		$query .= '('.$columns.') VALUES ('.$values.')';
		return $query;
	}
	
	function query_update($table,$data,$where){
		$numItems = count($data);
		$i = 0;
		$query = 'UPDATE '.$table.' ';
		$sets = '';
		foreach($data as $key => $value){
			if($value == ''){
				$sets .= $key.'=null';
			}else{
				$sets .= $key.'="'.$value.'"';
			}
			if(++$i != $numItems){
				$sets .= ',';
			}
		}
		$query .= 'SET '.$sets.' WHERE '.$where;
		return $query;
	}
	
	function query_delete($table,$where){
		return mysqli_query($GLOBALS['koneksi'], 'DELETE FROM '.$table.' WHERE '.$where);
	}
	
	function alert($msg=null,$type='info'){
		if(!empty($msg)){
			return '<div class="alert alert-'.$type.'" role="alert">'.$msg.'</div>';
		}else{
			return '';
		}
	}
?>