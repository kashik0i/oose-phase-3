<?php

abstract class Model
{
    /** @noinspection SqlResolve */
    public static final function getById(int $id): self
    {
        $className = get_called_class();
        $query = PDOWrapper::getConnection()->prepare("SELECT * FROM " . $className . " WHERE id='" . $id . "'");
        $query->setFetchMode(PDO::FETCH_CLASS, $className);
        $query->execute();
        return $query->fetch();
    }

    public static final function getByAttr(string $attr, string $val): self
    {
        $className = get_called_class();
        $query = PDOWrapper::getConnection()->prepare("SELECT * FROM " . $className . " WHERE " . $attr . "=' . $val . '");
        $query->setFetchMode(PDO::FETCH_CLASS, $className);
        $query->execute();
        return $query->fetch();
    }
}