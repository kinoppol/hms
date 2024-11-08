<?php

$menu['ตรวจสอบใบหน้า']=array(
    'detect'=>array(
        'label'=>'ค้นหาบุคคลจากภาพถ่าย',
        'bullet'=>'tf-icons bx bx-image',
        'url'=>site_url('face_detect/from_image'),
    ),
);

print gen_menu($menu);