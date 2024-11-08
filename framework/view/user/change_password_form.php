<?php

helper('view/alert');

?>
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">เปลี่ยนรหัสผ่าน</h5>
      <div class="card-body">
      <?php
        if(!empty($_SESSION['response']['alert'])){
          gen_alert($_SESSION['response']['alert']);
          $_SESSION['response'] = null;
        }
      ?>
        <form action="<?= site_url('user/change_password') ?>" method="post">
          <div class="form-floating">
              <input
                type="password"
                name="current_password"
                class="form-control"
                id="floatingInput"
                placeholder="ป้อนรหัสผ่านปัจจุบัน"
                aria-describedby="floatingInputHelp"
                minlength=8
                required
              />
              <label for="floatingInput">รหัสผ่านปัจจุบัน</label>
              <div id="floatingInputHelp" class="form-text">
                
              </div>
          </div>
          <div class="form-floating">
              <input
                type="password"
                name="new_password"
                class="form-control"
                id="floatingInput"
                placeholder="กำหนดรหัสผ่านใหม่ไม่น้อยกว่า 8 ตัวอักษร"
                aria-describedby="floatingInputHelp"
                minlength=8
                required
              />
              <label for="floatingInput">รหัสผ่านใหม่</label>
              <div id="floatingInputHelp" class="form-text">

              </div>
          </div>
          <div class="form-floating">
              <input
                type="password"
                name="confirm_password"
                class="form-control"
                id="floatingInput"
                placeholder="กรอกรหัสผ่านใหม่อีกครั้งให้ตรงกัน"
                aria-describedby="floatingInputHelp"
                minlength=8
                required
              />
              <label for="floatingInput">ยืนยันรหัสผ่านใหม่</label>
              <div id="floatingInputHelp" class="form-text">

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