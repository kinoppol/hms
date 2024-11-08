<?php

$menu['จัดการระบบ']=array(
    'management'=>array(
        'label'=>'จัดการผู้ใช้',
        'bullet'=>'tf-icons bx bx-group',
        'url'=>site_url('management'),
        'item'=>array(
                'list_user'=>array(
                'label'=>'ผู้ใช้ทั้งหมด',
                'url'=>site_url('management/list_user'),
            ),
                'user_type'=>array(
                'label'=>'ประเภทผู้ใช้',
                'url'=>site_url('management/user_type'),
            ),
        ),
    ),/*
    'cvm_group'=>array(
        'label'=>'ผู้ใช้ CVM',
        'bullet'=>'tf-icons bx bx-id-card',
        'url'=>site_url('cvm/user_cvm'),
        'item'=>array(),
    ),*/
    'config'=>array(
        'label'=>'ตั้งค่าการทำงาน',
        'url'=>site_url('config'),
        'bullet'=>'tf-icons bx bx-cog',
        'item'=>array(/*
            'store'=>array(
                'label'=>'ข้อมูลร้าน',
                'bullet'=>'fa fa-shopping-cart',
                'url'=>site_url('config/store'),
            ),
            'time'=>array(
                'label'=>'เวลาทำการ',
                'bullet'=>'fa fa-clock-o',
                'url'=>site_url('config/time'),
            ),*/
        ),
    )
);

print gen_menu($menu);