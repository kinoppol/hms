<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once('function.php');

function redirect_on_error(){
    $debug_mode=true;
    if($debug_mode){
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    }
    if(!$debug_mode&&!defined('EVERYTHING_WENT_OK')){
        ob_end_clean();
        //header('Location: error.php');
        print view('_error/error404');
    }
}


register_shutdown_function('redirect_on_error');

ob_start();
session_start();

    
    function fw_run($controller_path,$function='',$param=array()){

    $inc_file='controller/'.$controller_path.'.php';
    
    require_once($inc_file);

    $seg = explode('/', $controller_path);
    $controller = array_pop($seg);

    $page=new $controller();

    if(empty($function)){
        print $page->index();
    }else{
        print $page->$function($param);
    }
    }
?>