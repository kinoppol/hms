<?php

class user
{
    public function index()
    {
    }


    public function logout()
    {
        unset($_SESSION['user']);
        $content = redirect(site_url('login'), 2);
        $content .= 'กรุณารอสักครู่..';
        return $content;//view('template/authen',array('content'=>$content));
    }


    public function view()
    {
        $data['content'] = 'รายชื่อผู้ใช้';

        $menu = view('_menu/admin').view('_menu/budget');
        $data['menu'] = $menu;
        $data['title'] = 'จัดการผู้ใช้';
        return view('_template/main', $data);
    }


    public function update_user_form()
    {
        $data['content'] = view('user/update_user_form', ["user" => $_SESSION["user"]]);
        $data['title'] = 'แก้ไขข้อมูลส่วนตัว';
        return view('_template/main', $data);
    }


    public function update_user()
    {
        $model = model('user_model');

        $data = [
            "name" => ($_POST['name'] ?? ''),
            "surname" => ($_POST['surname'] ?? ''),
            "email" => ($_POST['email'] ?? '')
        ];

        if($_FILES["fileToUpload"]['size'] > 0){
            if(!$model->update_avatar($_SESSION['user']['id'],$_FILES["fileToUpload"])){
                $_SESSION['response']['alert']['type'] = 'danger';
                $_SESSION['response']['alert']['message'] = $model->error();
                return redirect(site_url('user/update_user_form'));
            }
        }

        if(!$model->update_user($_SESSION['user']['id'],$data))
        {
            $_SESSION['response']['alert']['type'] = 'danger';
            $_SESSION['response']['alert']['message'] = $model->error();
            return redirect(site_url('user/update_user_form'));
        }
        $new_data=$model->get_user(['id'=>$_SESSION['user']['id']]);
        $_SESSION['user']=$new_data[0];

        $_SESSION['response']['alert']['type'] = 'success';
        $_SESSION['response']['alert']['message'] = 'บันทึกข้อมูลเสร็จสิ้น!';

        $_SESSION['user'] = $model->get($_SESSION['user']['id']);

        return redirect(site_url('user/update_user_form'));

    }


    public function change_password_form()
    {
        $data['content'] = view('user/change_password_form');
        $data['title'] = 'เปลี่ยนรหัสผ่าน';
        return view('_template/main', $data);
    }


    public function change_password()
    {

        if(empty($_POST['current_password'])) {
            return redirect(site_url('user/change_password_form'));
        }

        if($_POST['new_password'] != $_POST['confirm_password']) {
            $_SESSION['response']['alert']['type'] = "danger";
            $_SESSION['response']['alert']['message'] = "รหัสผ่านใหม่ไม่ตรงกัน กรุณาตรวจสอบและลองอีกครั้ง!";
            return redirect(site_url('user/change_password_form'));
        }

        $model = model('user_model');
        $passwd = md5($_POST['current_password']);
        $user_data = $model->get($_SESSION['user']['id']);

        if($passwd != $user_data['password']) {
            $_SESSION['response']['alert']['type'] = "danger";
            $_SESSION['response']['alert']['message'] = "รหัสผ่านปัจจุบันไม่ถูกต้อง กรุณาตรวจสอบและลองอีกครั้ง!";
            return redirect(site_url('user/change_password_form'));
        }

        $new_passwd = md5($_POST['new_password']);

        if(!$model->update($_SESSION['user']['id'], ["password" => $new_passwd])) {
            $_SESSION['response']['alert']['type'] = "danger";
            $_SESSION['response']['alert']['message'] = "เกิดปัญหาระหว่างเซิฟเวอร์ กรุณาลองอีกครั้งในภายหลัง";
            return redirect(site_url('user/change_password_form'));
        }

        $_SESSION['response']['alert']['type'] = "success";
        $_SESSION['response']['alert']['message'] = "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว!";
        return redirect(site_url('user/change_password_form'));

    }


}
