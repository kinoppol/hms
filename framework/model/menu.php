<?php

class menu{
    private $db;
    function __construct($db_ref){
        $this->db=$db_ref;
    }
    function get_user_menu($data=array()){
       
        $sql='select * from user_type';
        if(count($data)){
          $sql.=' where '.arr2and($data);
        }
        //print $sql;
        $result=$this->db->query($sql);

            $res=array();
            $data=$result->fetch_assoc();
                $menu=explode(',',$data['active_menu']);
            return $menu;
        
    }
}