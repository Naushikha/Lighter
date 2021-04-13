<?php

class TestModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'Test';
    }

    public function Test($id)
    {
        // // $sql = "SELECT * FROM answer ";
        // $sql = "SELECT * FROM answer WHERE question_id = ? ";
        // // $sql = "SELECT * FROM answer WHERE 'question_id' = ? AND 'quiz_id' = ? "; not needed

        // return $this->db->query($sql, $id)->fetchAll();
    }
}
