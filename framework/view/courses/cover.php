<div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">
              <?php print $courses['name']; ?>
            </h5>
            <p class="mb-4">
              <?php print $courses['section']; ?>
            </p>

            <a href="<?php print site_url('courses_teaching/edit/c/'.$courses['id']); ?>"
              class="btn btn-sm btn-outline-primary">แก้ไขชั้นเรียน</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="<?php 
                            if($courses['state']=='ACTIVE'){
                              print site_url('images/man-with-laptop-light.png',true); 
                            }else{
                              print site_url('images/Hypersomnia-300x300.png',true); 
                            }
                            
                            ?>" height="140" alt="View Badge User"
              data-app-dark-img="illustrations/man-with-laptop-dark.png"
              data-app-light-img="illustrations/man-with-laptop-light.png" />
          </div>
        </div>
      </div>
    </div>