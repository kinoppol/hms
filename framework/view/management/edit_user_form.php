<?php

helper('view/alert');
helper('view/form');

?>

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
          action="<?= site_url('management/edit_user') ?>"
          method="post" enctype="multipart/form-data">
          <h5>รูปภาพประจำตัว</h5>
          <div class="mb-3">
            <?php
      if(!empty($user['picture'])) {
          ?>
            <img
              src="<?php print site_url('./writable/images/profile/'.$user['picture'], true); ?>"
              alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            <?php
      } else {
          ?>
            <img
              src="<?php print site_url('./images/robot-modern-style-vector.jpg', true); ?>"
              alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            <?php
      }
?>

            <label for="formFile" class="form-label">เลือกไฟล์รูปภาพประจำตัว</label>
            <input class="form-control" type="file" id="formFile" name="fileToUpload" />
          </div>

          <div class="mb-3 col-12">
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="exampleuser"
                aria-describedby="floatingInputHelp" name="username"
                value="<?= $user['username'] ?>" disabled />
              <label for="floatingInput">ชื่อผู้ใช้งาน</label>
              <div id="floatingInputHelp" class="form-text">

              </div>
            </div>
          </div>
          <div class="mb-3 col-12">
          <div class="form-floating">
              <?php form_gen_select('user_type_id','user_type_id',$user_types,$user_types[$user['user_type_id']]) ?>
              <label for="user_type_id">ประเภทผู้ใช้งาน</label>
              <div id="floatingInputHelp" class="form-text">

              </div>
            </div>
            
          </div>
          <input type="hidden" name="id" value="<?= $user['id'] ?>">

          <div class="row">
            <div class="mb-3 col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="สมชาย"
                  aria-describedby="floatingInputHelp" name="name"
                  value="<?= $user['name'] ?>" />
                <label for="floatingInput">ชื่อ</label>
                <div id="floatingInputHelp" class="form-text">

                </div>
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="สบายดี"
                  aria-describedby="floatingInputHelp" name="surname"
                  value="<?= $user['surname'] ?>" />
                <label for="floatingInput">สกุล</label>
                <div id="floatingInputHelp" class="form-text">

                </div>
              </div>
            </div>
          </div>

          <div class="mb-3 col-12">
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" placeholder="somchai@gmail.com"
                aria-describedby="floatingInputHelp" name="email"
                value="<?= $user['email'] ?>" />
              <label for="floatingInput">อีเมล</label>
              <div id="floatingInputHelp" class="form-text">

              </div>
            </div>
          </div>
          
          <div class="mb-3 col-12">
            <div class="form-floating">
              <input type="password" name="new_password" class="form-control" id="floatingInput"
                placeholder="กำหนดรหัสผ่านใหม่" aria-describedby="floatingInputHelp"/>
              <label for="floatingInput">รหัสผ่านใหม่ที่ต้องการเปลี่ยน</label>
              <div id="floatingInputHelp" class="form-text">

              </div>
            </div>
          </div>
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