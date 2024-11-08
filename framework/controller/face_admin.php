<?php
class face_admin{
    function index(){
    }
    function list(){
        
        $face=model('labeled_face');
        $face_data=$face->get();

        $space=model('space');
        $space_data=$space->get();
        $sp_arr=array();
            foreach($space_data as $sp){
                $sp_arr[$sp['id']]=$sp['name'];
            }

        $data['space']=$sp_arr;
        $data['face']=$face_data;
        $data['content']=view('face_admin/list_label',$data);
        $data['title']='ฐานข้อมูลใบหน้า';
        return view('_template/main',$data);
    }
    function add_face_form(){
        
        $space=model('space');
        $where=array('working_status'=>'ACTIVE');
        $space_data=$space->get($where);
        $sp_arr=array();
            foreach($space_data as $sp){
                $sp_arr[$sp['id']]=$sp['name'];
            }
            
        $data['space']=$sp_arr;
        $data['content']=view('face_admin/face_form',$data);
        $data['title']='เพิ่มข้อมูลใบหน้า';
        return view('_template/main',$data);
    }
    function edit_face($param){
        
        $space=model('space');
        $where=array('working_status'=>'ACTIVE');
        $space_data=$space->get($where);
        $sp_arr=array();
            foreach($space_data as $sp){
                $sp_arr[$sp['id']]=$sp['name'];
            }
        $face=model('labeled_face');
        $where=array(
            'id'=>$param['id']
        );
        $face_data=$face->get($where);
        $data['face_data']=$face_data[0];
        $data['space']=$sp_arr;
        $data['content']=view('face_admin/face_form',$data);
        $data['title']='แก้ไขข้อมูลใบหน้า';
        return view('_template/main',$data);
    }


    function save_face(){
        $_SESSION['resent_space_id']=$_POST['space_id'];
        $data=array(
                    'space_id'=>$_POST['space_id'],
                    'personal_id'=>$_POST['personal_id'],
                    'name'=>$_POST['name'],
                    'surname'=>$_POST['surname'],
                );

                helper('labeled_image');

        if(!empty($_FILES["face_image_1"])&&$_FILES["face_image_1"]['size'] > 0){
            $labeled_image_1=upload_labeled_image($_FILES["face_image_1"]);
            $data['labeled_image_1']=$labeled_image_1['file_name'];
        }
        if(!empty($_FILES["face_image_2"])&&$_FILES["face_image_2"]['size'] > 0){
            $labeled_image_2=upload_labeled_image($_FILES["face_image_2"]);
            $data['labeled_image_2']=$labeled_image_2['file_name'];
        }
        if(!empty($_FILES["face_image_3"])&&$_FILES["face_image_3"]['size'] > 0){
            $labeled_image_3=upload_labeled_image($_FILES["face_image_3"]);
            $data['labeled_image_3']=$labeled_image_3['file_name'];
        }
        if(!empty($_FILES["face_image_4"])&&$_FILES["face_image_4"]['size'] > 0){
            $labeled_image_4=upload_labeled_image($_FILES["face_image_4"]);
            $data['labeled_image_4']=$labeled_image_4['file_name'];
        }
        if(!empty($_FILES["face_image_5"])&&$_FILES["face_image_5"]['size'] > 0){
            $labeled_image_5=upload_labeled_image($_FILES["face_image_5"]);
            $data['labeled_image_5']=$labeled_image_5['file_name'];
        }
        //exit();
        $face=model('labeled_face');
        if(empty($_POST['face_id'])){
            $face->create($data);
        }else{
            $where=array(
                'id'=>$_POST['face_id'],
            );
            $face->update($data,$where);
        }
        
        return redirect(site_url('face_admin/list'));
    }
    function delete_face($param){
            

        $face=model('labeled_face');
            $where=array(
                'id'=>$param['id'],
            );
            $face->delete($where);

        
        return redirect(site_url('face_admin/list'));
    }
    function delete_labeled_image($param){

        $face=model('labeled_face');
        $where=array(
            'id'=>$param['id'],
        );
        $data['labeled_image_'.$param['no']]='';
        $face->update($data,$where);
        unlink('writable/labeled_images/'.$param['file_name']);
        return redirect(site_url('face_admin/edit_face/id/'.$param['id']));
    }
}