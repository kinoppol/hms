<?php

helper('model/dummy_model');

class user_type_model extends dummy_model {
    
    protected $table = 'user_type';
    protected $primary_key = 'id';
    

     function __construct($db_ref) {
        parent::__construct($db_ref);
    }

    function get($id=null) {
        $user_types = parent::get($id);

        if(empty($id)) {
            foreach ($user_types as $key => $user_type_data) {
                $user_types[$key]['active_menu'] = explode(',',$user_type_data['active_menu']);
            }
            return $user_types;
        }

        $user_types['active_menu'] = explode(',',$user_types['active_menu']);
        return $user_types;
    }


    function delete($id) {
        $result = $this->helper->select('id')->from('user_data')->where(['user_type_id' => $id])->query_at($this->db);
        if($result->num_rows > 0){
            $this->error = 'ไม่สามารถลบประเภทผู้ใช้ได้เนื่องจากมีผู้ใช้ที่ยังอยู่ในประเภทผู้ใช้นี้';
            return false;
        }
        if(!parent::delete($id)){
            $this->error = 'เกิดข้อผิดพลาดบนเซิฟเวอร์ กรุณาลองใหม่อีกครั้งในภายหลัง';
            return false;
        }
        return true;
    }

    function update($id,$data) {
        $data['active_menu'] = join(',',array_filter($data['active_menu']));
        $data['active_menu'] = trim($data['active_menu'],',');
        if(!parent::update($id,$data)){
            $this->error = 'เกิดข้อผิดพลาดบนเซิฟเวอร์ กรุณาลองใหม่อีกครั้งในภายหลัง';
            return false;
        }
        return true;
    }


}


?>