<?php

class PDOWrapper
{
    private static PDO $db;

    public static function getConnection(): ?PDO
    {
        try {
            if (!isset(self::$db)) {
                self::$db = new PDO('mysql:host=localhost;dbname=oose', 'root');
            }
            return self::$db;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }
}