<?php
class management{
    function index(){
    }


    function list_user(){
        $userModel=model('user_model');
        $userTypeModel=model('user_type_model');
        $ud=$userModel->get();
        $ut=$userTypeModel->get();
        $user_type=array();
        foreach($ut as $t){
            $user_type[$t['id']]=$t;
        }
        $data['content']=view('admin/list_user',['userdata'=>$ud,'user_type'=>$user_type]);
        $data['title']='รายชื่อผู้ใช้';
        return view('_template/main',$data);
    }

    function edit_user_form($param){
        
        if(empty($param['id'])){
            return view('_error/error404');
        }

        $model = model('user_model');
        $user = $model->get($param['id']);
        
        if(empty($user)){
            return view('_error/error404');
        }

        $user_type_model = model('user_type_model');
        $user_types = $user_type_model->get();
        foreach ($user_types as $key => $value) {
            $user_types[$key] = $value['type_name'];
        }

        $data['title'] = 'แก้ไขข้อมูลส่วนตัว';
        $data['content'] = view('management/edit_user_form', ["user" => $user, "user_types" => $user_types]);
        return view('_template/main', $data);
    }


    function edit_user(){
        $model = model('user_model');

        $data = [
            "name" => ($_POST['name'] ?? ''),
            "surname" => ($_POST['surname'] ?? ''),
            "email" => ($_POST['email'] ?? ''),
            "user_type_id" => ($_POST['user_type_id'] ?? $_SESSION['user']['user_type_id'])
        ];

        if(!empty($_POST['new_password'])) {
            $data['password'] = md5($_POST['new_password']);
        }

        if($_FILES["fileToUpload"]['size'] > 0){
            if(!$model->update_avatar($_POST['id'],$_FILES["fileToUpload"])){
                $_SESSION['response']['alert']['type'] = 'danger';
                $_SESSION['response']['alert']['message'] = $model->error();
                return redirect(site_url('management/edit_user_form/id/'.$_POST['id']));
            }
        }

        if(!$model->update_user($_POST['id'],$data))
        {
            $_SESSION['response']['alert']['type'] = 'danger';
            $_SESSION['response']['alert']['message'] = $model->error();
            return redirect(site_url('management/edit_user_form/id/'.$_POST['id']));
        }

        # Update user session if update own account
        if($_POST['id'] == $_SESSION['user']['id']){
            $_SESSION['user'] = $model->get($_SESSION['user']['id']);
        }
        #---
        
        $_SESSION['response']['alert']['type'] = 'success';
        $_SESSION['response']['alert']['message'] = 'บันทึกข้อมูลเสร็จสิ้น!';
        return redirect(site_url('management/edit_user_form/id/'.$_POST['id']));
    }


    function add_user_form(){

        $model = model('user_model');

        $data['title'] = 'เพิ่มผู้ใช้งาน';
        $data['content'] = view('management/add_user_form');
        return view('_template/main', $data);

    }

    function add_user(){

        $model = model('user_model');

        $_SESSION['response']['alert']['type'] = 'danger';
        
        if(empty($_POST['username'])){
            $_SESSION['response']['alert']['message'] = 'ชื่อผู้ใช้งานไม่สามารถเว้นว่างได้ กรุณากรอกข้อมูลให้ครบถ้วนแล้วลองอีกครั้ง';
            return redirect(site_url('management/add_user_form'));
        }
        if(empty($_POST['new_password'])) {
            $_SESSION['response']['alert']['message'] = 'รหัสผ่านไม่สามารถเว้นว่างได้ กรุณากรอกข้อมูลให้ครบถ้วนแล้วลองอีกครั้ง';
            return redirect(site_url('management/add_user_form'));
        }

        $data = [
            'username' => ($_POST['username'] ?? ''),
            "name" => ($_POST['name'] ?? ''),
            "surname" => ($_POST['surname'] ?? ''),
            "email" => ($_POST['email'] ?? ''),
            'password' => md5($_POST['new_password'])
        ];

        $user_id = $model->add_user($data);
        if(!int($user_id))
        {
            $_SESSION['response']['alert']['message'] = 'เกิดช้อผิดพลาดบนเซิฟเวอร์ กรุณาลองใหม่อีกครั้งในภายหลัง';
            return redirect(site_url('management/add_user_form'));
        }

        
        if($_FILES["fileToUpload"]['size'] > 0){
            if(!$model->update_avatar($user_id,$_FILES["fileToUpload"])){
                $_SESSION['response']['alert']['message'] = $model->error();
                return redirect(site_url('management/edit_user_form/id/'.$user_id));
            }
        }
        
        $_SESSION['response']['alert']['type'] = 'success';
        $_SESSION['response']['alert']['message'] = 'บันทึกข้อมูลเสร็จสิ้น!';
        return redirect(site_url('management/edit_user_form/id/'.$user_id));
    }


    # User type section
    function user_type(){
        $userTypeModel=model('user_type_model');
        
        $data['content']=view('admin/list_user_type',['user_types' => $userTypeModel->get()]);
        $data['title']='ประเภทผู้ใช้';
        return view('_template/main',$data);
    }


    function edit_user_type_form($param){
        $userTypeModel=model('user_type_model');

        if(empty($param['id'] ?? null)){
            return view('_error/error404');
        }
        
        $data['content']=view('management/edit_user_type_form',['user_type' => $userTypeModel->get($param['id'])]);
        $data['title']='ประเภทผู้ใช้';
        return view('_template/main',$data);
    }


    function add_user_type(){
        if(empty($_POST['user_type_name'])){
            return view('_error/error404');
        }

        $userTypeModel=model('user_type_model');
        if(!$userTypeModel->insert(['type_name' => $_POST['user_type_name']])){
            $_SESSION['response']['alert']['type'] = 'danger';
            $_SESSION['response']['alert']['message'] = 'เกิดข้อผิดพลาดบนเซิฟเวอร์ กรุณาลองใหม่อีกครั้งในภายหลัง';
            return redirect(site_url('management/user_type'));
        }
        
        return redirect(site_url('management/edit_user_type_form/id/'.$userTypeModel->insert_id));
    }

    function edit_user_type($param){
        if(empty($param['id'])) {
            return view('_error/error404');
        }
        if(empty($_POST['type_name'])) {
            return view('_error/error404');
        }
        
        $is_updated = false;
        $userTypeModel=model('user_type_model');
        $user_type_data = $userTypeModel->get($param['id']);

        if($_POST['type_name'] != $user_type_data['type_name']){
            $is_updated = true;
            $user_type_data['type_name'] = $_POST['type_name'];
        }
        for($i=0;$i<count($user_type_data['active_menu']);$i++)
        {
            $menu = ($_POST['menu-'.$i] ?? '');
            if($menu != $user_type_data['active_menu'][$i]){
                $is_updated = true;
                $user_type_data['active_menu'][$i] = $menu;
            }
        }
        if($is_updated){
            if(!$userTypeModel->update($user_type_data['id'],$user_type_data)){
                $_SESSION['response']['alert']['type'] = 'danger';
                $_SESSION['response']['alert']['message'] = $userTypeModel->error();
                return redirect(site_url('management/edit_user_type_form/id/'.$param['id']));
            }
        }
        $_SESSION['response']['alert']['type'] = 'success';
        $_SESSION['response']['alert']['message'] = 'บันทึกข้อมูลเสร็จสิ้น';
        return redirect(site_url('management/edit_user_type_form/id/'.$param['id']));
    }


    function delete_user_type($param){
        $userTypeModel=model('user_type_model');

        if(empty($param['id'])){
            return view('_error/error404');
        }

        if(!$userTypeModel->delete($param['id'])){
            $_SESSION['response']['alert']['type'] = 'danger';
            $_SESSION['response']['alert']['message'] = 'เกิดข้อผิดพลาดบนเซิฟเวอร์ กรุณาลองใหม่อีกครั้งในภายหลัง';
            return redirect(site_url('management/user_type'));
        }

        $_SESSION['response']['alert']['type'] = 'success';
        $_SESSION['response']['alert']['message'] = 'ลบประเภทผู้ใช้งานเสร็จสิ้น!';
        
        $data['content']=view('admin/list_user_type',['user_types' => $userTypeModel->get()]);
        $data['title']='ประเภทผู้ใช้';
        return view('_template/main',$data);
    }


    function add_menu($param) {
        if(empty($param['user_type_id'])) {
            return view('_error/error404');
        }
        if(empty($_POST['new_menu'])) {
            return view('_error/error404');
        }
        $userTypeModel=model('user_type_model');
        $user_type_data = $userTypeModel->get($param['user_type_id']);
        array_push($user_type_data['active_menu'],$_POST['new_menu']);
        
        if(!$userTypeModel->update($user_type_data['id'],$user_type_data)){
            $_SESSION['response']['alert']['type'] = 'danger';
            $_SESSION['response']['alert']['message'] = 'เกิดข้อผิดพลาดบนเซิฟเวอร์ กรุณาลองใหม่อีกครั้งในภายหลัง';
            return redirect(site_url('management/edit_user_type_form/id/'.$param['user_type_id']));
        }

        $_SESSION['response']['alert']['type'] = 'success';
        $_SESSION['response']['alert']['message'] = 'เพิ่มเมนู '.$_POST['new_menu'].' เรียบร้อยแล้ว';
        return redirect(site_url('management/edit_user_type_form/id/'.$user_type_data['id']));
    }
}