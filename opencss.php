<?php
    $css = [];
    if(isset($_GET['page'])){
        $page = strtolower($_GET ['page']);
        switch($page){
            case 'dashboard':
                break;
            case 'tambah_materi':
                //$css = [];
                break;
            case 'materi_biologi':
                
                break;
            case 'tambah_quiz':
                
                break;
            case 'tambah_promo':
                
                break;
            case 'charts':
                
                break;
		}
	}
	
	foreach($css as $value){
		echo '<link href="'.resources($value).'" rel="stylesheet" />';
	}
?>