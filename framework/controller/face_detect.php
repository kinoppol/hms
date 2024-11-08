
<?php
class face_detect{
    function from_image(){
        
        $data['content']=view('face_detect/form');
        $data['title']='ค้นหาใบหน้าจากภาพถ่าย';
        return view('_template/main',$data);
    }
    
    function script(){
        return view('face_detect/script');
    }
}