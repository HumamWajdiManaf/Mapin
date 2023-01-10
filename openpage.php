<?php
    $path = 'pages';
    $page = 'dashboard';
    if(isset($_GET['page'])){
        switch($_GET ['page']){
            case 'dashboard':
                $page = 'dashboard';
                break;
            case 'tambah_materi':
                $page = 'tambah_materi';
                break;
            case 'materi_biologi':
                $page = 'materi_biologi';
                break;
            case 'tambah_quiz':
                $page = 'tambah_quiz';
                break;
            case 'tambah_promo':
                $page = 'tambah_promo';
                break;
            case 'charts':
                $page = 'charts';
                break;
            default:
                $page = 'dashboard';
        }
    }
    include $path.'/'.$page.'.php';
?>php