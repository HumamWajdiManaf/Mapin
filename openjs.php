<?php
    $js = [];
    if(isset($_GET['page'])){
        $page = strtolower($_GET ['page']);
        switch($page){
            case 'dashboard':
				$js = [
					'js/Chart.min.js',
					'assets/demo/chart-area-demo.js',
					'assets/demo/chart-bar-demo.js',
					'js/simple-datatables@latest',
					'js/datatables-simple-demo.js',
				];
                break;
			case 'mapel':
				//$js = [];
				break;
            case 'tambah_materi':
                $js = [];
                break;
            case 'materi_biologi':
                
                break;
            case 'tambah_quiz':
                
                break;
            case 'tambah_promo':
                
                break;
            case 'charts':
                
                break;
			default:
				$js = [];
		}
	}
	
	foreach($js as $value){
		echo '<script src="'.resources($value).'" crossorigin="anonymous"></script>';
	}
?>