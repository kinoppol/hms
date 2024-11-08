<?php
helper('base');
$id=toBase($courses['id']);
?>
<ul class="nav nav-pills flex-column flex-md-row mb-3">
  <li class="nav-item">
    <a class="nav-link<?php if($navigator=="forum"){ print ' active';} ?>" href="<?php print site_url('courses_teaching/forum/c/'.$id); ?>"><i class="bx bx-chalkboard me-1"></i> กระดานข่าว</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<?php if($navigator=="work"){ print ' active';} ?>" href="<?php print site_url('courses_teaching/work/c/'.$id); ?>"><i
        class="bx bx-calendar-check me-1"></i> บทเรียน</a>
  </li>
  <!--
  <li class="nav-item">
    <a class="nav-link<?php if($navigator=="person"){ print ' active';} ?>" href="<?php print site_url('courses_teaching/person/c/'.$id); ?>"><i
        class="bx bx-group me-1"></i> ผู้คน</a>
  </li>
  -->
</ul>

<div class="row">
  <div class="col-lg-12 mb-4 order-0">
    <?php print $cover; ?>
  </div>


  <div class="row">
    <div class="col-lg-3 col-md-12 col-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">

          </div>

          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <img src="<?php print site_url('./images/logo_meet_2020q4_color_1x_web_48dp.png',true); ?>" alt="Meet"
                class="rounded" />
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Meet</h6>
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                  <a class="dropdown-item" href="javascript:copyMeetLink();">คัดลอกลิงก์</a>
                  <!--
                  <a class="dropdown-item" href="javascript:void(0);">จัดการ</a>
                  -->
                </div>
              </div>
          </li>

          <div class="d-grid gap-12 col-lg-12 mx-auto">
            <?php
              if(empty($meet_url)){
            ?>
            <script>
        function copyMeetLink() {

            alert("กรุณาสร้างลิงก์ก่อน");
        }
    </script>         
            <a href="<?php print site_url('courses_teaching/create_meet_link/c/'.$courses['id']); ?>" class="btn btn-primary">สร้างลิงก์</a>
            <?php
              }else{
                ?>       
                 <script>
        function copyMeetLink() {

            /* Copy text into clipboard */
            navigator.clipboard.writeText
                ("<?php print $meet_url; ?>");
        }
    </script>         
                <h5><a href="<?php print $meet_url; ?>" target="_blank"><?php print $meet_url; ?></a></h5>
                <a href="<?php print $meet_url; ?>" target="_blank" class="btn btn-primary">เข้าร่วม</a>
                <?php
                  }
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-12 col-12 mb-4">
      <?php print $topic; ?>
    </div>

  </div>

</div>