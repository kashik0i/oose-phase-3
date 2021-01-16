<?php
require_once "../core/Model.php";

class User extends Model
{
    public function getById(int $id): User
    {
        $this->db->query("SELECT * FROM user WHERE id='" . $id . "'");
        // TODO: Build user model
    }

    public function getByAttr(string $attr, string $val): User
    {
        $this->db->query("SELECT * FROM user WHERE " . $attr . "=' . $val . '");
        // TODO: Build user model
    }
}