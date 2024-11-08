<?php
class showcase{
    function index(){
        return view('showcase/index',array('title'=>'ระบบระบุตัวตนด้วยใบหน้า'));
    }
    function script(){
        return view('showcase/script');
    }
}
?>