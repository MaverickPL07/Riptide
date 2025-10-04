<?php 
    namespace Riptide;
    
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

        public static function Run()
        {
            require_once __DIR__ . "/Config.php"; 
            require_once __DIR__ . "/Database.php"; 
            require_once __DIR__ . "/Localization.php"; 
            require_once __DIR__ . "/Auth.php";
            require_once __DIR__ . "/Core.php";
            require_once __DIR__ . "/../enums/EPermission.php";

            Auth::SignIn();
            Localization::GetLanguage();
        }
    }
?>