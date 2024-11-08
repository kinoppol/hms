<div class="row">
    <div class="col-12 col-12 col-md-12 col-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <img src="./writable/images/profile/<?= $_SESSION['user']['picture'] ?>" alt
                        class="w-px-40 h-auto rounded-circle" />
                    <?php print $_SESSION['user']['name']." ".$_SESSION['user']['surname'] ?>
                </div>
                <form action="<?php print site_url('courses_teaching/create_forum_topic'); ?>" method="post">
                    <input type="hidden" name="courses_id" value="<?php print $courses_id; ?>">
                    <div class="input-group">
                        <input name="topic_subject" type="text" class="form-control" id="topic_subject"
                            placeholder="บอกทุกคนในชั้นเรียนว่า.." aria-describedby="floatingInputHelp"
                            aria-describedby="button-addon2" required />
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">ตกลง</button>
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
                        <div class="avatar flex-shrink-0 me-3">
                            <a href="#"
                                title=" <?php print $_SESSION['user']['name']." ".$_SESSION['user']['surname'] ?>">
                                <img src="./writable/images/profile/<?= $_SESSION['user']['picture'] ?>"
                                    alt=" <?php print $_SESSION['user']['name']." ".$_SESSION['user']['surname'] ?>"
                                    class="w-px-40 h-auto rounded-circle" /></a>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0"><?php print $topic['subject']; ?></h6>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="<?php print  site_url('courses_teaching/edit_forum_topic/id/'.$topic['id'].'/c/'.$topic['courses_id']); ?>">แก้ไข</a>
                                    <a class="dropdown-item" href="<?php print 'javascript:if(confirm(\'ยืนยันการลบประกาศ\'))window.location.href=\''.site_url('courses_teaching/delete_topic/id/'.$topic['id'].'/c/'.$topic['courses_id']).'\''; ?>">ลบ</a>
                                </div>
                            </div>
                    </li>



                </div>
                วันที่ <?php print date('Y-m-d',strtotime($topic['createTime'])); ?> เวลา
                <?php print date('H:i',strtotime($topic['createTime'])); ?> น.
            </div>
        </div>
    </div>
</div>
<?php
}
?>