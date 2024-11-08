    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="<?php print site_url('courses_teaching/create_courses'); ?>" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">ข้อมูลชั้นเรียน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating">
                    <input name="courses_name" type="text" class="form-control" id="courses_name" placeholder="ระบุชื่อวิชา"
                        aria-describedby="floatingInputHelp" required/>
                    <label for="floatingInput">ชื่อวิชา</label>
                    <div id="floatingInputHelp" class="form-text">

                    </div>
                </div>
                <div class="form-floating">
                    <input name="class_name" type="text" class="form-control" id="class_name" placeholder="ปวส. 1"
                        aria-describedby="floatingInputHelp" />
                    <label for="floatingInput">ชั้นเรียน</label>
                    <div id="floatingInputHelp" class="form-text">

                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    ยกเลิก
                </button>
                <button type="submit" class="btn btn-primary">บันทึก</button>

            </div>
    </div>
    </form>
</div>