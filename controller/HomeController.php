<?php
    include_once('model/User.php');
    class HomeController{

        private $usermodel;

        public function __construct()
        {
            $this->usermodel = new User();
        }

        public function dangnhap(){
            require_once('view/dangnhap.php');            
        }
        public function dangky(){
            require_once('view/dangky.php');
        }
        public function dangkybe(){
            $this->usermodel->dangkybe(); 
        }

        public function dangnhapbe(){
            $verify = $this->usermodel->dangnhapbe();
            if($verify === true){
                $_SESSION['login'] = "true";                
                header("Location:index.php?mod=admin&act=trangql");     
                exit();         
            }else{
                $_SESSION['message'] = "Tài khoản hoặc mật khẩu không chính xác";
                header("Location:index.php?mod=public&act=dangnhap");
                exit();
            }
        }

        public function dangxuatbe(){
            if(isset($_POST['dxsubmit'])){
                unset($_SESSION['login']);
                header("Location:index.php?mod=public&act=dangnhap");
                exit();
            }
        }
        
        public function trangchu(){
            require_once('view/trangchu.php');
        }

        public function timkiem(){
            $data = $this->usermodel->timkiem();
            echo $data;
        }       
    }

?>