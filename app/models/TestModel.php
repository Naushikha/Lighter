<?php

class TestModel extends Model
{
    public function Test($id)
    {
        echo $id;
        // $sql = "SELECT * FROM test WHERE test_id = ?";

        // return $this->db->query($sql, $id)->fetchAll();
    }
}
