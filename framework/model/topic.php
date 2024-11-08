<?php

helper("model/dummy_model");
class topic extends dummy_model{
    protected $table = 'courses_topics';
    protected $primary_key = 'id';
    function __construct($db_ref){
        parent::__construct($db_ref);
    }
    function get($data=array()){
        $sql='select * from '.$this->table.' where '.arr2and($data);
        //print $sql;
        $result=$this->db->query($sql);

            $res=array();
            while($row=$result->fetch_assoc()){
                $res[]=$row;
            }
            return $res;
        
    }
    function create($data=array()){
        $sql='insert into '.$this->table.' set '.arr2set($data);
        //print $sql;
        $result=$this->db->query($sql);
        return $this->db->insert_id;
    }
    function update($data=array(),$where=array()){
        $sql='update '.$this->table.' set '.arr2set($data).' where '.arr2and($where);
        //print $sql;
        $result=$this->db->query($sql);
        return $result;
    }

    function delete($where=array()){
        $sql='delete from '.$this->table.' where '.arr2and($where);
        print $sql;
        $result=$this->db->query($sql);
        return $result;
    }

}