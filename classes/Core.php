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

        public static function Run($renderTheme = true)
        {
            require_once __DIR__ . "/Config.php"; 
            require_once __DIR__ . "/Database.php"; 
            require_once __DIR__ . "/Localization.php"; 
            require_once __DIR__ . "/Auth.php";
            require_once __DIR__ . "/Core.php";
            require_once __DIR__ . "/Theme.php";
            require_once __DIR__ . "/../enums/EPermission.php";

            Config::Init();
            Auth::SignIn();
            Localization::GetLanguage();

            if($renderTheme)
                Theme::Render();
            else 
                Debug::NewLine(EDebugLineType::Warning, "Theme rendering is disabled!");
        }
    }
?>