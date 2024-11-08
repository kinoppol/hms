<?php

helper("model/dummy_model");
class user_model extends dummy_model{
    protected $table = 'user_data';
    protected $primary_key = 'id';
    function __construct($db_ref){
        parent::__construct($db_ref);
    }
    function get_user($data=array()){
        $sql='select * from user_data where '.arr2and($data);
        //print $sql;
        $result=$this->db->query($sql);

            $res=array();
            while($row=$result->fetch_assoc()){
                $res[]=$row;
            }
            return $res;
        
    }
    function add_user($data=array()){
        $sql='insert into user_data set '.arr2set($data);
        $result=$this->db->query($sql);
        return $this->db->insert_id;
    }
    function get_user_type($data=array()){
        $sql='select * from user_type where '.arr2and($data);
        //print $sql;
        $result=$this->db->query($sql);

            $res=array();
            while($row=$result->fetch_assoc()){
                $res[]=$row;
            }
            return $res;
        
    }

    function update_avatar($id=null,$picture=null){

        $acl = ['1'];

        if($id != $_SESSION['user']['id']){
            if(!in_array($_SESSION['user_type']['id'],$acl)){
                $this->error = "บัญชีผู้ใช้งานนี้ไม่มีมีสิทธิ์ในการเปลี่ยนข้อมูล";
                return false;
            }
            $user = $this->get($id);
        } else {
            $user = $_SESSION['user'];
        }
        
        helper('upload/file');
        helper("image");

        $target_dir = "writable/images/profile/";
        $imageFileType = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
        $file_name = basename(base64_encode($user['username'])) . '.' . $imageFileType;
        $uploadOk = 1;
        
        $check = getimagesize($picture["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check file size
        if ($picture["size"] > 5000000) {
            $this->error = "ไฟล์รูปมีขนาดเกิน 5 MB กรุณาเปลี่ยนรูปภาพแล้วลองใหม่อีกครั้ง";
            return false;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
            $this->error = "ผิดรูปแบบประเภทไฟล์ที่อนุญาต กรุณาตรวจสอบแล้วลองใหม่อีกครั้ง";
            return false;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $this->error = "ไฟล์รูปภาพมีปัญหา กรุณาเปลี่ยนรูปภาพแล้วลองใหม่อีกครั้ง";
            return false;

        // if everything is ok, try to upload file
        }

        $uploaded_file = upload_file($picture, $target_dir, $file_name);

        helper('avatar');
        square_thumbnail_with_proportion($uploaded_file,$uploaded_file,$square_side=200,$quality=90);
        //exit();
        if (empty($uploaded_file)) {
            $this->error = "เกิดข้อผิดพลาดบนเซิฟเวอร์ กรุณาลองใหม่อีกครั้งในภายหลัง";
            return false;
        }

        if($imageFileType != "jpg"){
            $avatar_path = converttojpg($uploaded_file,true);
        } else {
            $avatar_path = $uploaded_file;
        }

        # Resize Image
        list($width, $height) = getimagesize($avatar_path);
        $image_p = imagecreatetruecolor(100, 100);
        $image = imagecreatefromjpeg($avatar_path);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, 100, 100, $width, $height);
        imagejpeg($image_p, $avatar_path);

        $update_data['picture'] = basename(base64_encode($user['username'])).'.jpg';
        if(!$this->update($user['id'], $update_data)) {
            $this->error = "เกิดข้อผิดพลาดบนเซิฟเวอร์ กรุณาลองใหม่อีกครั้งในภายหลัง";
            return false;
        }
        return true;
            

    }
    function update_user($id=null,$data=null){

        $data_struct = [
            "name" => "",
            "surname" => "",
            "email" => "",
            "user_type_id"
        ];

        helper('validation/email');

        $acl = ['1'];

        if($id != $_SESSION['user']['id']){
            if(!in_array($_SESSION['user_type']['id'],$acl)){
                $this->error = "บัญชีผู้ใช้งานนี้ไม่มีมีสิทธิ์ในการเปลี่ยนข้อมูล";
                return false;
            }
            $user = $this->get($id);
        } else {
            $user = $_SESSION['user'];
        }

        $update_data = array();

        if(empty($data['email'])) {
            $this->error = "อีเมลล์ไม่ถูกต้อง กรุณาตรวจสอบและลองอีกครั้ง";
            return false;
        }

        if($data['name'] != $user['name']) {
            $update_data['name'] = $this->helper->esc($data['name']);
        }

        if($data['surname'] != $user['surname']) {
            $update_data['surname'] = $this->helper->esc($data['surname']);
        }

        if(!empty($data['password'])){
            $update_data['password'] = $this->helper->esc($data['password']);
        }

        if(!empty($data['user_type_id']) && $data['user_type_id'] != $user['user_type_id']) {
            $update_data['user_type_id'] = $this->helper->esc($_POST['user_type_id']);
        }

        if($data['email'] != $user['email']) {
            if(!is_validated_email($data['email'])) {
                $this->error = "อีเมลไม่ถูกต้อง กรุณาตรวจสอบและลองอีกครั้ง!";
                return false;
            }
            $update_data['email'] = $data['email'];
        }

        if(count($update_data) < 1) {
            return true;
        }

        if(!$this->update($user['id'], $update_data)) {
            $this->error = "เกิดปัญหาระหว่างเซิฟเวอร์ กรุณาลองอีกครั้งในภายหลัง";
            return false;
        }

        return true;

    }
}