<?php
require_once "../utilities/database/PDOWrapper.php";

abstract class BaseModel
{


    public PDO $db;

    public function __construct()
    {
        $this->db=PDOWrapper::getConnection();
    }
    public abstract function getByAttr();
    public abstract function getById();
}