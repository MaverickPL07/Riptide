<?php 
    namespace Riptide;

    class Debug
    {
        public static function NewLine(EDebugLineType $type, $text)
        {
            $now = date('d.m.Y H:i:s');
            $time = "<span>$now</span>";
            
            switch($type)
            {
                case EDebugLineType::Info:
                {
                    $line = "<div>$time <span style='color: blue;'>$text</span></div>";
                    break;
                }

                case EDebugLineType::Normal: 
                {
                    $line = "<div>$time <span style='color: white;'>$text</span></div>";
                    break; 
                }
            }

            echo "<script>AddDebugLine(`$line`);</script>";
        }
    }
?>