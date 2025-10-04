<?php 
    namespace Riptide;
    
    class Config 
    {
        public static $RiptideVersion = "1.0.0";
        public static $MinPHPVersion = "8.1";
        public static $Options;

        public static function Init()
        {
            $q = Database::Query("SELECT * FROM `/@table:config`");
            
            while($r = $q -> fetch_assoc())
            {
                self::$Options[$r["id"]] = $r["value"];
            }
        }
    }
?>