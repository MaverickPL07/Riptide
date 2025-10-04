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
                        echo "<script src='js/Debug.js'></script>";
                    }

                    if(!isset($_COOKIE["Logged_User"]))
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
    }
?>