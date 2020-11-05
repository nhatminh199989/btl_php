<?php   
    if(isset($_SESSION['login']) && $_SESSION['login'] == "true"){
        include_once ('model/BienBan.php'); 
    }else{
        header("Location:index.php?mod=public&act=dangnhap");
        exit();
    }  
    
    class AdminController{
        private $bienBanModel;
        public function __construct()
        {
            $this->bienBanModel = new bienBan();
        }

        public function trangql(){
            $data = $this->bienBanModel->hienthi();
            require_once('view/trangql.php');
        }

        public function hienthi(){
            $this->bienBanModel->hienthi();
        }

        public function thembb(){            
            if($this->bienBanModel->them()){
                $data = $this->bienBanModel->hienthi();
            }           
            echo $data;
        }

        public function themcsv(){            
            if($this->bienBanModel->importcsv()){
                $data = $this->bienBanModel->hienthi();
            }           
            echo $data;
        }

        public function suabb(){            
            if($this->bienBanModel->sua()){
                $data = $this->bienBanModel->hienthi();                
            }           
            echo $data;
        }

        public function xoabb(){
            if($this->bienBanModel->xoa()){
                $data = $this->bienBanModel->hienthi();
            }
            echo $data;
        }

        public function excel(){
            $this->bienBanModel->excel();
        }

        public function thongke(){
            $data = $this->bienBanModel->thongkept();
            $data_loi = $this->bienBanModel->thongkeloi();
            require_once('view/thongke.php');
        }        
        

    }

    
?>