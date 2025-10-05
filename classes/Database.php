<?php 
    namespace Riptide;

    require_once ROOT . "/Config/config.php";
    require_once ROOT . "/Enums/EDebugLineType.php";

    class Database 
    {
        public static $Connection;

        public static function Query($query)
        {
            if(Database::$Connection)
            {
                $query = str_replace("/@table:", TABLE_PREFIX, $query);
                $q = mysqli_query(Database::$Connection, $query);

                if(Auth::$User && Auth::$User["permission"] == EPermission::Admin -> value)
                    Debug::NewLine(EDebugLineType::Normal, "Performed SQL Query (results: {$q -> num_rows})");

                return $q;
            }
        }

        public static function CreateUser($user)
        {
            Database::Query("INSERT INTO `/@table:users`(`username`) VALUE ('{$user["username"]}') ");
        }

        public static function GetUserById($id)
        {
            return Database::Query("SELECT * FROM `/@table:users` WHERE `id` = $id");
        }
    }

    Database::$Connection = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
?>