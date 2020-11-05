<?php
    session_start();

    if(isset($_GET['mod'])){
        $mod = $_GET['mod'];
    }else{
        $mod = 'public';
    }

    if(isset($_GET['act'])){
        $act = $_GET['act'];
    }else{
        $act = 'trangchu';
    }

    switch($mod){
        case 'public':{
            include_once('controller/HomeController.php');
            $home = new HomeController();
            switch($act){
                case 'dangnhap':{
                $home->dangnhap();
                break;
                }
                case 'dangky':{
                $home->dangky();
                break;
                }
                case 'dangkybe':{
                $home->dangkybe();
                break;
                }
                case 'dangnhapbe':{
                    $home->dangnhapbe();
                    break;
                }
                case 'trangchu':{
                    $home->trangchu();
                    break;
                }
                case 'dangxuat':{
                    $home->dangxuatbe();
                    break;
                }
                case 'timkiem':{
                    $home->timkiem();
                    break;
                }
                
            }
        break;
        }
        case 'admin':{
            include_once ("controller/AdminController.php");
            $admin = new AdminController();
            switch($act){
                case 'trangql':{
                    $admin->trangql();
                    break;
                }
                case 'them':{
                    $admin->thembb();
                    break;
                }
                case 'importcsv':{
                    $admin->themcsv();
                    break;
                }
                case 'sua':{
                    $admin->suabb();
                    break;
                }
                case 'xoa':{
                    $admin->xoabb();   
                    break;
                }
                case 'excel':{
                    $admin->excel();
                    break;
                }        
                case 'thongke':{
                    $admin->thongke();
                    break;
                }        
            }
        break;
        }        
        
    }
