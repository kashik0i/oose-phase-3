<?php

abstract class Model
{
    /** @noinspection SqlResolve */
    public static final function getById(int $id): self
    {
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE id='" . $id . "'");
        return self::executeQuerySingle($stmt);
    }

    public static final function getByAttr(string $attr, string $val): self
    {
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE " . $attr . "=' . $val . '");
        return self::executeQuerySingle($stmt);
    }

    private static final function executeQuerySingle(PDOStatement $stmt): self
    {
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    private static final function executeQueryMultiple(PDOStatement $stmt): array
    {
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
}