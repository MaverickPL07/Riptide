<?php 
    namespace Riptide;
    
    echo '<script src="js/index.js"></script>';
    echo '<link rel="stylesheet" href="index.css">';

    class Core 
    {
        public static function SetCookieOneYear($cookieName, $cookieValue, $path = "/")
        {
            setcookie($cookieName, $cookieValue, time() + (86400 * 365), $path);

            Debug::NewLine(EDebugLineType::Normal, "[Cookies] $cookieName value changed.");
        }

        public static function ClearCookie($cookieName, $path = "/")
        {
            setcookie($cookieName, "", time() + (86400 * 365), $path);
        }

        public static function Hash(string $string)
        {
            return hash("SHA256", $string);
        }


    }
?>