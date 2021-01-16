<?php


class PDOWrapper
{
    private static PDO $db;

    public static function getConnection(): PDO
    {
        try
        {
            if (!isset(self::$db))
            {
                self::$db = new PDO('mysql:host=local;dbname=oose', 'root');
            }

        } catch (PDOException $e)
        {
            echo $e->getMessage();
        }
        return self::$db;


    }
}