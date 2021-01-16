<?php

class User extends Model
{
    private string $id;
    private string $first_name;
    private string $last_name;

    public static function getById(int $id): User
    {
        $query = PDOWrapper::getConnection()->prepare("SELECT * FROM user WHERE id='" . $id . "'");
        $query->setFetchMode(PDO::FETCH_CLASS, "User");
        $query->execute();
        return $query->fetch();
    }

    public static function getByAttr(string $attr, string $val): User
    {
        $query = PDOWrapper::getConnection()->prepare("SELECT * FROM user WHERE " . $attr . "=' . $val . '");
        $query->setFetchMode(PDO::FETCH_CLASS, "User");
        $query->execute();
        return $query->fetch();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }
}