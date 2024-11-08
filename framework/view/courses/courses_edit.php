<div class="row">
<div class="col-lg-12 mb-4 order-0">
           <form class="modal-content" action="<?php print site_url('courses_teaching/update_courses'); ?>" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">ข้อมูลชั้นเรียน</h5>
                
            </div>
            <div class="modal-body">
                <div class="form-floating">
                    <input name="courses_name" type="text" class="form-control" id="courses_name" placeholder="ระบุชื่อวิชา"
                        aria-describedby="floatingInputHelp" value="<?php print $courses['name']; ?>" required/>
                    <label for="floatingInput">ชื่อวิชา</label>
                    <div id="floatingInputHelp" class="form-text">

                    </div>
                </div>
                <div class="form-floating">
                    <input name="class_name" type="text" class="form-control" id="class_name" placeholder="ปวส. 1"
                        aria-describedby="floatingInputHelp" value="<?php print $courses['section']; ?>" />
                    <label for="floatingInput">ชั้นเรียน</label>
                    <div id="floatingInputHelp" class="form-text">
                    </div>

                </div>
                
                <div class="form-floating">
                        <select name="cover_color" class="form-control form-select form-select-lg" id="exampleFormControlSelect1" aria-label="Default select example">
                         <?php
                            $default_selection=$courses['cover_color'];
                            $selection=array(
                                'primary'=>'น้ำเงิน',
                                'secondary'=>'เทา',
                                'success'=>'เขียว',
                                'danger'=>'แดง',
                                'warning'=>'เหลือง',
                                'info'=>'ฟ้า',
                            );
                            print gen_option($selection, $default_selection);
                         ?>
                        </select>
                    <label for="floatingInput">สีหน้าปก</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input name="visibility" value="public" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                        <?php print $courses['visibility']=='PUBLIC'?' checked':''; ?>
                         />
                        <label class="form-check-label" for="flexSwitchCheckDefault"
                          >ตั้งเป็นชั้นเรียนต้นแบบ (เผยแพร่สาธารณะ)</label
                        >
                      </div>
                </div>
            </div>

            <div class="modal-footer">
                <?php
                    if($courses['state']=='ACTIVE'){
                ?>
                <a class="btn btn-outline-secondary" href="<?php print 'javascript:if(confirm(\'ยืนยันการเก็บชั้นเรียน\'))window.location.href=\''.site_url('courses_teaching/archive/c/'.$courses['id']).'\''; ?>">
                    เก็บชั้นเรียน
                </a>
                <?php
                    }else{
                ?>
                <a class="btn btn-outline-secondary" href="<?php print 'javascript:if(confirm(\'ยืนยันการกู้คืนชั้นเรียน\'))window.location.href=\''.site_url('courses_teaching/active/c/'.$courses['id']).'\''; ?>">
                    กู้คืนชั้นเรียน
                </a>
                <?php 
                    }
                ?>
                <input type="hidden" name="courses_id" value="<?php print $courses['id']; ?>">
                <button type="submit" class="btn btn-primary">บันทึก</button>

            </div>
    </div>
    </form>
    </div>
    </div>