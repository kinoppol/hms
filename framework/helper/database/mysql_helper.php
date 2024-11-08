<?php

class mysql_helper {

    private $sql;
    private $db;
    private $cur;

    function __construct($db_ref=null) {
        $this->db = $db_ref;
    }

    function select(...$fields) {
        $this->sql = 'SELECT ';
        foreach ($fields as $value) {
            $this->sql .= $value.', ';
        }
        $this->sql = rtrim($this->sql,", ");
        return $this;
    }


    function from(...$tables) {
        $this->sql .= ' FROM ';
        foreach ($tables as $value) {
            $this->sql .= $value.', ';
        }
        $this->sql = rtrim($this->sql,", ");
        return $this;
    }


    function where($conditions) {
        $this->sql .= ' WHERE ';
        foreach ($conditions as $field => $value) {
            $op = substr($value,0,2);
            if(preg_match("/> |< |>=|<=/", $op)){
                $this->sql .= $field.$op.$value.' AND ';
            }
            else {
                $this->sql .= $field.'='.$value.' AND ';
            }
        }
        $this->sql = rtrim($this->sql," AND ");

        return $this;
    }


    function insert($table,$data) {
        $this->sql = 'INSERT INTO '.$table.' SET ';
        foreach ($data as $key => $value) {
            if(is_string($value)) $value='"'.$value.'"';
            $this->sql .= $key.'='.$value.', ';
        }
        $this->sql = rtrim($this->sql,", ");
        return $this;
    }


    function update($table,$data) {
        $this->sql = 'UPDATE '.$table.' SET ';
        foreach ($data as $key => $value) {
            if(is_string($value)) $value='"'.$value.'"';
            $this->sql .= $key.'='.$value.', ';
        }
        $this->sql = rtrim($this->sql,", ");
        return $this;
    }


    function delete($table) {
        $this->sql = 'DELETE FROM '.$table;
        return $this;
    }


    function get_fields($table) {
        $this->sql = 'DESCRIBE '.$table;
        return $this;
    }


    function query_at($db) {
        return $db->query($this->sql);
    }


    function clear() {
        $this->sql = "";
        return $this;
    }

    function esc($string,$db=null) {
        $db = ($db ?? $this->db);
        if(empty($db)){
            return $string;
        }
        return $db->escape_string($string);
    }

}

?>