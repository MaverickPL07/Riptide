<?php 
    namespace Riptide;

    require __DIR__ . "/Debug.php";
    require_once __DIR__ . "/../enums/EDebugLineType.php";
    use Riptide\Debug;

    class Localization
    {
        public static $language;

        public static function Text($stringId)
        {
            $lang = isset(Localization::$language) ? Localization::$language : "en_EN";
            $path = __DIR__ . "/../localization/languages/$lang.json";
            $json = file_get_contents($path);
            $data = json_decode($json, true);

            return $data[$stringId]["text"];
        }        

        public static function SetLanguage($newLanguage)
        {
            Localization::$language = $newLanguage;
            
            setcookie("User_Language", Localization::$language, time() + (86400 * 30), "/");

            Debug::NewLine(EDebugLineType::Info, "Language set to $newLanguage");
        }

        public static function GetLanguage()
        {
            Localization::$language = isset($_COOKIE["User_Language"]) ? $_COOKIE["User_Language"] : "pl_PL";

            $lang = Localization::$language;

            Debug::NewLine(EDebugLineType::Info, "Language: $lang");
        }
    }
?>