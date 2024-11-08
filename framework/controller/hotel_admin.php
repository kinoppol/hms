<?php
class hotel_admin{
    function index(){
        $content='Hello-Hotel';
        return view('_template/main',array('content'=>$content,'title'=>'หน้าหลัก'));
    }
    function list(){

        $data['content']='รายชื่อโรงแรม';
        return view('_template/main',$data);
    }
    
    function submit_list(){

        $data['content']='โรงแรมที่ขอใช้ระบบ';
        return view('_template/main',$data);
    }
}
?>