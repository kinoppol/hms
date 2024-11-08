<?php

helper('view/alert');

?>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form
                action="<?= site_url('management/add_menu/user_type_id/'.$user_type['id']) ?>"
                method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">เพิ่มเมนู</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">เมนู</label>
                            <input type="text" id="nameBasic" class="form-control" placeholder="example/path"
                                name="new_menu" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        ปิด
                    </button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header">ข้อมูลพื้นฐาน</h5>
            <div class="card-body">
                <?php
        if(!empty($_SESSION['response']['alert'])) {
            gen_alert($_SESSION['response']['alert']);
            $_SESSION['response'] = null;
        }
?>
                <form
                    action="<?= site_url('management/edit_user_type/id/'.$user_type['id']) ?>"
                    method="post">

                    <div class="mb-3 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" placeholder="exampleusertype"
                                aria-describedby="floatingInputHelp" name="type_name"
                                value="<?= $user_type['type_name'] ?>"
                                required />
                            <label for="floatingInput">ชื่อประเภทผู้ใช้งาน</label>
                            <div id="floatingInputHelp" class="form-text">

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id"
                        value="<?= $user_type['id'] ?>">
                    <h5>เมนูที่อนุญาต</h5>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#basicModal">
                        เพิ่มเมนู
                    </button>


                    <?php $count = 0; 
                    ?>
                    <?php for($i=0;$i < count($user_type['active_menu']);$i++) { ?>
                    <?php if(empty($user_type['active_menu'][$i])) {
                        continue;
                    } ?>
                    <div class="row">
                        <div class="mb-3 col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="example/path"
                                    aria-describedby="floatingInputHelp"
                                    name="menu-<?= $count ?>"
                                    value="<?= $user_type['active_menu'][$i] ?>" />
                                <label for="floatingInput">เมนู</label>
                                <div id="floatingInputHelp" class="form-text">

                                </div>
                            </div>
                        </div>
                    </div>


                    <?php $count++;
                    } ?>

                    <div class="row">
                        <div class="d-grid gap-2 col-lg-6 col-md-12 mx-auto mt-3">
                        </div>
                        <div class="d-grid gap-2 col-lg-6 col-md-12 mx-auto mt-3">
                            <button class="btn btn-primary btn-lg" type="submit">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>