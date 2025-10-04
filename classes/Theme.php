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
            $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $last = basename($path);
            $themeFolder = Theme::$Folder;

            $templatePath = __DIR__ . "/../themes/$themeFolder/$last.php";

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