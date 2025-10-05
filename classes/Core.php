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

        public static function Run($renderTheme = true)
        {
            require_once ROOT . "/classes/Config.php"; 
            require_once ROOT . "/classes/Database.php"; 
            require_once ROOT . "/classes/Localization.php"; 
            require_once ROOT . "/classes/Auth.php";
            require_once ROOT . "/classes/Core.php";
            require_once ROOT . "/classes/Theme.php";
            require_once ROOT . "/enums/EPermission.php";

            echo '<script src="' . ROOT_URL . "/js/index.js" . '"></script>';
            echo '<link rel="stylesheet" href="' . ROOT_URL . '/index.css">';

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