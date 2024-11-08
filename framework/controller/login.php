<?php
class login{
    function index(){
    
        $content=view('login/form',array('action_url'=>site_url('login/check')));
        return view('_template/authen',array('content'=>$content,'title'=>'ลงชื่อเข้าใช้'));
    }

    function check(){
        $username=trim($_POST['email-username']);
        $password=trim($_POST['password']);
        //$store_id=trim($_POST['store_id']);
        if(!empty($_POST['remember-me'])){
            $llogin=array(
                //'store_id'=>$store_id,
                'username'=>$username,
            );
            $remember_data=json_encode($llogin);
            setcookie('last_login', $remember_data, time() + (86400 * 365), "/");
        }
        if(empty($username)||empty($password)){
            $_SESSION['err_message']='กรุณาระบุชื่อผู้ใช้และรหัสผ่าน';
            return redirect(site_url('login'));
        }else{
            $user=model('user_model');
            $data=array(
                //'store_id'=>$store_id,
                'username'=>$username,
                'password'=>md5($password),
            );
            $u1=$user->get_user($data);

            $data=array(
                //'store_id'=>$store_id,
                'email'=>$username,
                'password'=>md5($password),
            );
            $u2=$user->get_user($data);
            $u=$u1;
            if(count($u1)<1){
                $u=$u2;
            }
            if(count($u)<1){
                $_SESSION['err_message']='ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
                return redirect(site_url('login'));
            }else{
                $_SESSION['user']=$u[0];
                $t=$user->get_user_type(['id'=>$u[0]['user_type_id']]);
                $_SESSION['user_type']=$t[0];
                return redirect(site_url('main'));
            }
        }
    }
}