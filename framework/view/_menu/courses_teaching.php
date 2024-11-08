<?php

$menu['ชั้นเรียน']=array(
    'courses_teaching'=>array(
        'label'=>'ชั้นเรียน',
        'bullet'=>'tf-icons bx bx-book',
        'url'=>site_url('courses_teaching'),
        'item'=>array(
                'my_courses'=>array(
                'label'=>'ชั้นเรียนของฉัน',
                'url'=>site_url('courses_teaching/my_courses'),
            ),
                'courses_browser'=>array(
                'label'=>'ชั้นเรียนต้นแบบ',
                'url'=>site_url('courses_teaching/courses_browser'),
            ),
                'courses_archived'=>array(
                'label'=>'ชั้นเรียนที่เก็บ',
                'url'=>site_url('courses_teaching/courses_archived'),
        ),
        ),
    ),
);

print gen_menu($menu);