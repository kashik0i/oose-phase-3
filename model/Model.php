<?php

abstract class Model
{
    public static abstract function validate(array $args): array;

    public static function validateExistence(array $args, array $argNames): array
    {
        $errors = [];

        foreach ($argNames as $argName) {
            $arg = $args[$argName];
            if (!isset($arg) || strlen(trim($arg)) == 0) {
                $argName = str_replace('_', ' ', $argName);
                array_push($errors, ucwords($argName) . ' cannot be empty');
            }
        }

        return $errors;
    }

    /** @noinspection SqlResolve */
    public static final function getById(int $id): self
    {
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE id='" . $id . "'");
        return self::executeQuerySingle($stmt);
    }

    public static final function get(string $attr, string $val): self
    {
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE " . $attr . "='" . $val . "'");
        return self::executeQuerySingle($stmt);
    }

    public static final function getAll(string $attr, string $val): array
    {
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE " . $attr . "='" . $val . "'");
        return self::executeQueryMultiple($stmt);
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