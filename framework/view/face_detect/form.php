<?php

helper('view/alert');

?>
  <style>
  canvas {
      position: relative;
      top: 0;
      left: 0;
    }
  </style>
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <h5 class="card-header">ระบุใบหน้าด้วยภาพถ่าย</h5>
      <div class="card-body">
        <?php
        if(!empty($_SESSION['response']['alert'])) {
            gen_alert($_SESSION['response']['alert']);
            $_SESSION['response'] = null;
        }
        //print_r($face_data);
?>
        <form
          action="<?= site_url('face/save_face') ?>"
          method="post" enctype="multipart/form-data">
    <div class="mb-3 col-12">
            <div class="form-floating">
                <div class="mb-3">
                        <label for="formFile" class="form-label">เลือกภาพใบหน้าจากอุปกรณ์<?php print $i; ?></label>
                        <input class="form-control" type="file" id="imageUpload" name="face_image"/>
    </div>
              <div id="floatingInputHelp" class="form-text">

              </div>
            </div>
          </div>
          <div class="mb-3 col-12">
            <div class="form-floating">
                <div class="mb-3">
                <div id="status">โปรดรอสักครู่</div>
    </div>
              <div id="floatingInputHelp" class="form-text">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="d-grid gap-2 col-lg-6 col-md-12 mx-auto mt-3">
            </div>
            <div class="d-grid gap-2 col-lg-6 col-md-12 mx-auto mt-3">
              <button class="btn btn-primary btn-lg" type="submit">วิเคราะห์ใบหน้า</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<script defer src="recognition/face-api.min.js"></script>
<script defer src="<?php  print site_url('face_detect/script'); ?>"></script>