<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $this->load = new load();
        $this->db = new MySQL();
    }

    public function __destruct()
    {
        $this->db->close();
    }
}
