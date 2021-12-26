<?php

namespace App\Models;
use CodeIgniter\Model;

class Custom_model extends Model
{
    protected $table;
    protected $db;
    protected $db_builder = null;

    public function __construct($table=null)
    {
        $this->db = db_connect();
        $this->useTable($table);    
    }

    protected function useTable($table) 
    {
        $this->db_builder = $this->db->table($this->table);
    }

    /**
     * insert new row into a table.
     *
     * @param string $table table name
     * @param array  $data  associative array for data
     * @param bool   $batch insert batch or single row
     *
     * @return int/string successfully insert retuns id else string
     */
    public function insertRow($data, $batch = false)
    {        
        if ($batch) {
            $result = $this->db_builder->insertBatch($data);
        } else {
            $result = $this->db_builder->insert($data);
        }
        if ($result) {
            return $this->db->insertID();
        }

        return false;
    }
}




?>