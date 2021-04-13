<?php

class TestModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Test($id)
    {
        // $sql = "SELECT * FROM test WHERE test_id = ?";

        // return $this->db->query($sql, $id)->fetchAll();
    }
}
