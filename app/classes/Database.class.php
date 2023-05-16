<?php

class Database {
    private static $host = "localhost";
    private static $dbname = "jckzwkyk_intelligent_system";
    private static $user = "jckzwkyk";
    private static $pass = "@dmin143!!!";

    // private static $host = "localhost";
    // private static $dbname = "lgt_systems";
    // private static $user = "root";
    // private static $pass = "";

    public static function connection()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $pdo = new PDO('mysql:host='. self::$host .';dbname='.self::$dbname, self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}