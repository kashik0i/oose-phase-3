<?php /** @noinspection SqlResolve */

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

    public static final function create(array $args): ?self
    {
        PDOWrapper::getConnection()->beginTransaction();

        $stmt = PDOWrapper::getConnection()->prepare("INSERT INTO activity VALUES ()");
        $stmt->execute();

        $activityId = PDOWrapper::getConnection()->lastInsertId();

        $createUserQuery = "INSERT INTO " . get_called_class() . ' (';
        $keys = array_keys($args);
        for ($i = 0; $i < sizeof($keys); $i++) {
            if ($i > 0) {
                $createUserQuery .= ', ';
            }
            $createUserQuery .= $keys[$i];
        }
        $createUserQuery .= ', activity_id) VALUES (';

        for ($i = 0; $i < sizeof($keys); $i++) {
            if ($i > 0) {
                $createUserQuery .= ', ';
            }
            $createUserQuery .= "'" . $args[$keys[$i]] . "'";
        }
        $createUserQuery .= ', ' . $activityId . ')';

        $stmt = PDOWrapper::getConnection()->prepare($createUserQuery);
        $stmt->execute();

        $userId = PDOWrapper::getConnection()->lastInsertId();
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE id='" . $userId . "'");
        $user = self::executeSingleFetch($stmt);

        return PDOWrapper::getConnection()->commit() ? $user : null;
    }

    public static final function getById(int $id): ?self
    {
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE id='" . $id . "'");
        return self::executeSingleFetch($stmt);
    }

    public static final function get(string $attr, string $val): ?self
    {
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE " . $attr . "='" . $val . "'");
        return self::executeSingleFetch($stmt);
    }

    public static final function getAll(string $attr, string $val): array
    {
        $stmt = PDOWrapper::getConnection()->prepare("SELECT * FROM " . get_called_class() . " WHERE " . $attr . "='" . $val . "'");
        return self::executeMultipleFetch($stmt);
    }

    private static final function executeSingleFetch(PDOStatement $stmt): ?self
    {
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetch();
    }

    private static final function executeMultipleFetch(PDOStatement $stmt): array
    {
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $stmt->execute();
        return $stmt->fetchAll();
    }
}