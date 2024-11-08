<div class="row">
    <div class="col-12 col-12 col-md-12 col-6 mb-4">
        <div class="card">
            <div class="card-body">
               
                <form action="<?php print site_url('courses_teaching/create_courses_topic'); ?>" method="post">
                    <input type="hidden" name="courses_id" value="<?php print $courses_id; ?>">
                    <div class="input-group">
                        <input name="topic_name" type="text" class="form-control" id="topic_name"
                            placeholder="ชื่อบทเรียน.." aria-describedby="floatingInputHelp"
                            aria-describedby="button-addon2" required />
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">เพิ่มบทเรียน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
foreach($topics as $topic){
?>
<div class="row">
    <div class="col-12 col-md-12 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">


                    <li class="d-flex mb-4 pb-1">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h5 class="mb-0"><?php print $topic['name']; ?></h5>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    
                                    <a class="dropdown-item" href="<?php print site_url('courses_teaching/edit_courses_topic/id/'.$topic['id'].'/c/'.$topic['courses_id']).'\''; ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?php print 'javascript:if(confirm(\'ยืนยันการลบบทเรียน\'))window.location.href=\''.site_url('courses_teaching/delete_courses_topic/id/'.$topic['id'].'/c/'.$topic['courses_id']).'\''; ?>">ลบ</a>
                                </div>
                            </div>
                    </li>
                    <?php
                        $pretest=array(
                            'color'=>empty($topic['pretest'])?'secondary':'warning',
                            'url'=>empty($topic['pretest'])?'#':$topic['pretest'],
                            'disabled'=>empty($topic['pretest'])?' disabled':'',
                        );
                        
                        $media=array(
                            'color'=>empty($topic['media'])?'secondary':'primary',
                            'url'=>empty($topic['media'])?'#':$topic['media'],
                            'disabled'=>empty($topic['media'])?' disabled':'',
                        );
                        
                        $posttest=array(
                            'color'=>empty($topic['posttest'])?'secondary':'danger',
                            'url'=>empty($topic['posttest'])?'#':$topic['posttest'],
                            'disabled'=>empty($topic['posttest'])?' disabled':'',
                        );
                        
                    ?>
                    <a class="btn<?php print $pretest['disabled']; ?> btn-<?php print $pretest['color']; ?>" href="<?php print $pretest['url']; ?>" target="_blank"><i class="bx bx-edit-alt me-1"></i>  แบบทดสอบก่อนเรียน</a>
                    <a class="btn<?php print $media['disabled']; ?> btn-<?php print $media['color']; ?>" href="<?php print $media['url']; ?>" target="_blank"></i> สื่อการเรียนการสอน</a>
                    <a class="btn<?php print $posttest['disabled']; ?> btn-<?php print $posttest['color']; ?>" href="<?php print $posttest['url']; ?>" target="_blank"><i class="bx bx-edit me-1"></i> แบบทดสอบหลังเรียน</a>


                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>