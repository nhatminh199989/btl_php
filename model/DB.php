<?php
    class DB{
        private static $conn = NULL;
        public static function mysqli(){
            $DB_SERVER = "localhost";
            $DB_USERNAME = "root";
            $DB_PASSWORD = "";
            $DB_NAME = "thuchanh3";
            self::$conn = new mysqli($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_NAME);
            self::$conn->character_set_name();
            self::$conn->set_charset("utf8");            
            if(self::$conn === FALSE){
                echo "Lỗi kết nối: ".self::$conn->error;
            }    
            return self::$conn;
        }
    }
?>  