<?php
require_once "../utilities/database/PDOWrapper.php";

abstract class Model
{
    protected PDO $db;

    protected function __construct()
    {
        $this->db = PDOWrapper::getConnection();
    }

    public abstract function getById(int $id): Model;

    public abstract function getByAttr(string $attr, string $val): Model;
}