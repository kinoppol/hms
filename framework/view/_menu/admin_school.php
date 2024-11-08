<?php

$menu['ผู้ดูแลระบบสถานศึกษา']=array(
    'money'=>array(
        'label'=>'จัดการผู้ใช้',
        'bullet'=>'tf-icons bx bx-user',
        'url'=>site_url('money'),
        'item'=>array(
            'teacher'=>array(
                'label'=>'ครู-อาจารย์',
                'url'=>site_url('user/teacher'),
            ),
            'student'=>array(
                'label'=>'นักเรียน-นักศึกษา',
                'url'=>site_url('money/student'),
            ),
        ),
    ),
);

print gen_menu($menu);