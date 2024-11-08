<?php

$menu['จัดการโรงแรม']=array(
    '้hotel_admin'=>array(
        'label'=>'รายชื่อโรงแรม',
        'bullet'=>'tf-icons bx bx-home',
        'url'=>site_url('hotel_admin/list'),
        'item'=>array(
                'list_user'=>array(
                'label'=>'โรงแรมในระบบ',
                'url'=>site_url('hotel_admin/list'),
            ),
                'user_type'=>array(
                'label'=>'โรงแรมที่ขอใช้ระบบ',
                'url'=>site_url('hotel_admin/submit_list'),
            ),
        ),
    ),
);

print gen_menu($menu);