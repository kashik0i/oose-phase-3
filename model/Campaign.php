<?php
require_once "../core/Model.php";

class Campaign extends Model
{
    public function getById(int $id): Campaign
    {
        $this->db->query("SELECT * FROM campaign WHERE id='" . $id . "'");
        // TODO: Build campaign model
    }

    public function getByAttr(string $attr, string $val): Campaign
    {
        $this->db->query("SELECT * FROM campaign WHERE " . $attr . "=' . $val . '");
        // TODO: Build campaign model
    }
}