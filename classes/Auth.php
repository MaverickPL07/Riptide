<?php 
    namespace Riptide;

    class Auth 
    {
        public static $User;

        public static function SignIn($id = null)
        {
            if(isset($_COOKIE["Logged_User"]) || isset($id))
            {
                $id = isset($id) ? $id : $_COOKIE["Logged_User"];
                $q = Database::GetUserById($id);

                if($q)
                {
                    Auth::$User = $q -> fetch_assoc();
                    $usr = Auth::$User;

                    if(Auth::$User["permission"] == EPermission::Admin -> value  && DEBUG_MODE){
                        $scriptPath =  ROOT . "/js/Debug.js";
                        echo "<script src='$scriptPath'></script>";
                    }

                    if(!isset($_COOKIE["Logged_User"]) || $id != $_COOKIE["Logged_User"])
                        Core::SetCookieOneYear("Logged_User", $id);

                    Debug::NewLine(EDebugLineType::Info, "Authenticated as {$usr['username']}");
                }
            }
        }

        public static function SignOut()
        {
            Auth::$User = null;
            Core::ClearCookie("Logged_User");
        }

        public static function FindUser($loginMethod, $login, $password)
        {
            $q = Database::Query("SELECT `id` FROM `/@table:users` WHERE `$loginMethod` = '$login' AND `password` = '$password' AND `permission` = 'Admin'");
            $r = $q -> fetch_assoc();
            
            if($q -> num_rows == 1)
                Auth::SignIn($r["id"]);
        }
    }
?>