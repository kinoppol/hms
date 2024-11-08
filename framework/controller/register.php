<?php
class register{
    function index(){
        $content=view('register/form',array('action_url'=>site_url('register/check')));
        return view('_template/authen',array('content'=>$content,'title'=>'ลงทะเบียน'));
    }
    function check(){
        $username=trim($_POST['username']);
        $email=trim($_POST['email']);
        $password=trim($_POST['password']);
        
            $data=array(
                'username'=>$username,
                'password'=>md5($password),
                'email'=>$email,
            );
        $userModel=model('user_model');
        $user_id=$userModel->add_user($data);
        //print_r($user_id);
        $u=$userModel->get_user(['id'=>$user_id]);

        $_SESSION['user']=$u[0];
        $t=$userModel->get_user_type(['id'=>$u[0]['user_type_id']]);
        $_SESSION['user_type']=$t[0];
        return redirect(site_url('main'));

    }
}
  