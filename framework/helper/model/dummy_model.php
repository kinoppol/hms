<?php

helper("database/mysql_helper");

class dummy_model
{
    protected $db;
    protected $table;
    protected $primary_key;
    protected $error;
    protected $helper;
    public $insert_id;

    public function __construct($db_ref)
    {
        $this->db = $db_ref;
        $this->helper = new mysql_helper();
    }

    public function get($id=null)
    {
        
        $ret = [];
        $this->helper->select("*")->from($this->table);
        if(isset($id)){
            $this->helper->where([$this->primary_key => $id]);
        }
        $result = $this->helper->query_at($this->db);
        if($result->num_rows  == 1){
            return $result->fetch_assoc();
        }
        while($row = $result->fetch_assoc()){
            $ret[$row[$this->primary_key]] = $row;
        }
        return $ret;
    }

    public function update($id,$data)
    {
        $result = $this->helper->update($this->table,$data)->where([$this->primary_key => $id])->query_at($this->db);
        return $result;
    }

    public function delete($id)
    {
        $result = $this->helper->delete($this->table)->where([$this->primary_key => $id])->query_at($this->db);
        return $result;
    }

    public function insert($data)
    {
        $result = $this->helper->insert($this->table,$data)->query_at($this->db);
        $this->insert_id = $this->db->insert_id;
        return $result;
    }

    function error(){
        $error = $this->error;
        $this->error = null;
        return $error;
    }
}

?>
