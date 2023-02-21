<?php
	include "functionku.php";
	if(cek_login()){
		redirect(base_url());
	}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?=$config['app_name']?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=$config['logo']?>">
	<link href="<?=resources('css/styles.css')?>" rel="stylesheet" />
	<script src="<?=resources('js/all.js')?>" crossorigin="anonymous"></script>
</head>
<body>
	<div id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<?php
				$data = get_flash('data');
				$username = '';
				if(!empty($data)){
					$username = $data['txt_username'];
				}
			?>
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-5">
							<div class="card shadow-lg border-0 rounded-lg mt-5">
								<div class="card-header"><h3 class="text-center font-weight-light my-4">Admin</h3></div>
								<div class="card-body">
									<form method="POST" action="<?=process('login')?>">
										<div class="form-floating mb-3">
											<input class="form-control" name="txt_username" id="txt_username" type="text" placeholder="Username" value="<?=$username?>" required/>
											<label for="txt_username">Username</label>
										</div>
										<div class="form-floating mb-3">
											<input class="form-control" name="txt_password" id="txt_password" type="password" placeholder="Password" required/>
											<label for="txt_password">Password</label>
										</div>
									    <div class="d-grid">
											<button type="submit" class="btn btn-primary">Sign In</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
	  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
		<div id="message-type" class="toast-header">
		  <strong id="message-title" class="me-auto">Bootstrap</strong>
		  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div id="message-text" class="toast-body">
		  Hello, world! This is a toast message.
		</div>
	  </div>
	</div>
	<script src="<?=resources('js/jquery-3.6.3.min.js')?>" crossorigin="anonymous"></script>
	<script src="<?=resources('js/bootstrap.bundle.min.js')?>" crossorigin="anonymous"></script>
	<script src="<?=resources('js/scripts.js')?>"></script>
	<script>
		$( document ).ready(function() {
			<?php
				$toast = get_flash('toast');
				if(!empty($toast)){
					echo 'toast_alert("'.$toast['title'].'","'.$toast['text'].'","'.$toast['type'].'")';
				}
			?>
		});
	</script>
</body>
</html>
<?php } ?>