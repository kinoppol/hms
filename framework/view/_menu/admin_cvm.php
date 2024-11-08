<?php

$menu['CVM']=array(
    'setting'=>array(
        'label'=>'สถานศึกษา CVM',
        'bullet'=>'tf-icons bx bx-home',
        'url'=>site_url('setting'),
    ),
);

print gen_menu($menu);