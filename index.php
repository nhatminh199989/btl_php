<?php
    session_start();

    if(isset($_GET['mod'])){
        $mod = preg_replace("/[^A-Za-z0-9\-\']/", '',$_GET['mod'] );
    }else{
        $mod = 'public';
    }

    if(isset($_GET['act'])){
        $act = preg_replace("/[^A-Za-z0-9\-\']/", '',$_GET['act'] );
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
                case 'dangnhapz':{
                    $home->dangnhapz();
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
                case 'dangnhapotp':{
                    $home->dangnhapotp();
                    break;
                }
                case 'sendotp':{
                    $home->sendOTP();
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
                default: {
                    header("Location:index.php?mod=public&act=dangnhap"); 
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
                default: {
                    header("Location:index.php");
                    break;
                }       
            }
        break;
        }        
        default:{
            header("Location:index.php");
            break;
        }
    }
