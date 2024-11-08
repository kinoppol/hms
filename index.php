<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Bangkok');
require_once('framework/fw.php');
require_once('conf/db.php');

$controller_guest_allowed=array(
    'login',
    'register',
    'showcase',
    'showcourses'
);

$controller=null;
$function=null;
$param=array();

if(!empty($_GET['p'])){
    $p=$_GET['p'];
    //$pv = strrev($p); 
    $seg = explode('/', $p); 

    $param_pos = null;
    foreach ($seg as $key => $value) {
        if(is_dir($value)) {
            $controller .= $value.'/';
        } else {
            $controller .= $value;
            if(count($seg)>$key+1)$function=$seg[$key+1];
            if(count($seg)>$key+2)$param_pos=$key+2;
            break;
        }
    }
    if(!empty($param_pos)){
        $k=null;
        foreach (array_slice($seg,$param_pos) as $key => $value) {
            if($key%2==0){
                $k = $value;
            } else {
                $param[$k] = $value;
            }
        }
    }
}
    if(empty($controller)){
        $controller='login';
    }
    
    if(empty($_SESSION['user'])&&!is_numeric(array_search($controller,$controller_guest_allowed))){
        //print "Restrict access.";
        print "<b>ท่านยังไม่ได้เข้าสู่ระบบ</b><br>
        ระบบกำลังพาไปหน้าเข้าสู่ระบบ โปรดรอสักครู่..";
        print redirect(site_url('login'),2);
        exit();
    }
    fw_run($controller,$function,$param);
    define('EVERYTHING_WENT_OK', TRUE);