<?php
helper("model/dummy_model");
class courses extends dummy_model{
    protected $table = 'courses';
    protected $primary_key = 'id';
    function __construct($db_ref){
        parent::__construct($db_ref);
    }
    function get_courses($data=array()){
        $sql='select * from courses where '.arr2and($data);
        //print $sql;
        $result=$this->db->query($sql);

            $res=array();
            while($row=$result->fetch_assoc()){
                $res[]=$row;
            }
            return $res;
        
    }
    function create($data=array()){
        $sql='insert into courses set '.arr2set($data);
        $result=$this->db->query($sql);
        return $this->db->insert_id;
    }
    function update($data=array(),$where=array()){
        $sql='update courses set '.arr2set($data).' where '.arr2and($where);
        $result=$this->db->query($sql);
        return $result;
    }
}