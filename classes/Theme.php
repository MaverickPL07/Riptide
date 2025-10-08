<?php 
    namespace Riptide;

    class Theme
    {
        public static $Name = "Riptide";
        public static $Folder = "riptide";
        
        public static function LinkScript()
        {

        }

        public static function Render()
        {                
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $baseDir = basename(dirname($_SERVER['SCRIPT_NAME']));
            $last = basename($url);
            $themeFolder = Theme::$Folder;
            $uri = trim($_SERVER['REQUEST_URI'], '/');

            if($uri === $baseDir || $uri === $baseDir . '/') {
                $last = "index";
            }

            $templatePath = ROOT . "/Themes/$themeFolder/$last.php";

            if(file_exists($templatePath))
            {
                include_once $templatePath;
                $name = Theme::$Name;

                Debug::NewLine(EDebugLineType::Info, "Loaded theme: $name");
            }
            else 
            {
                $templatePath = str_replace('\\', '/', $templatePath);
                Debug::NewLine(EDebugLineType::Error, "Could not find template file at $templatePath");
            }
        }
    }
?>