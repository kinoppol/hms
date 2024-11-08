<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <form class="modal-content" action="<?php print site_url('courses_teaching/update_forum_topic'); ?>" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">ข้อมูลประกาศ</h5>

            </div>
            <div class="modal-body">
                <div class="form-floating">
                    <input name="subject" type="text" class="form-control" id="subject"
                        placeholder="ข้อความที่ประกาศ" aria-describedby="floatingInputHelp"
                        value="<?php print $topic_data['subject']; ?>" required />
                    <label for="floatingInput">ข้อความ</label>
                    <div id="floatingInputHelp" class="form-text">

                    </div>
                </div>

            </div>
    </div>

    <div class="modal-footer">
        <input type="hidden" name="courses_id" value="<?php print $topic_data['courses_id']; ?>">
        <input type="hidden" name="topic_id" value="<?php print $topic_data['id']; ?>">
        <button type="reset" onclick="window.history.go(-1); return false;" class="btn btn-secondary">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">บันทึก</button>

    </div>
</div>
</form>
</div>
</div>