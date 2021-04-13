<?php

class Model{

    protected $db;
    protected $table;
    
    public function __construct(){
        $this->load = new load();
        $this->db = new MySQL();
    }

    public function __destruct(){
        $this->db->close();
    }
    
}

?>