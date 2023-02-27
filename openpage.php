<?php
    $path = 'pages';
    $page = 'dashboard';
    if(isset($_GET['page'])){
		$page = strtolower($_GET ['page']);
        switch($page){
            case 'dashboard':
                $page = 'dashboard';
                break;
			case 'mapel':
			case 'bab':
			case 'quiz':
			case 'promo':
			case 'artikel':
                $page .= '/view';
				break;
			case 'mapel_form':
			case 'materi_form':
			case 'bab_form':
			case 'promo_form':
			case 'artikel_form':
			case 'user_form':
			case 'history_form':
			case 'quizjawaban_form':
			case 'quiz_list':
			case 'quiz_form':
                $page = str_replace('_','/',$page);
                break;
			
            case 'materi':
				if(isset($_GET['id_mapel'])){
					$page .= '/list';
				}else{
					$page .= '/view';
				}
                break;
			case 'editprofile':
				$page .= '/editprofile';
				break;
			case 'profile':
				$page .= '/profile';
				break; 
			case 'user':
				$page .= '/user_view';
				break;
			case 'history':
				$page .= '/view_history';
				break;
			   
            default:
                $page = '404';
		}
	}
	include $path.'/'.$page.'.php';
?>