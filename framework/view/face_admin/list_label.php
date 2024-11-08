              <!-- Basic Bootstrap Table -->
              <div class="card">
                  <h5 class="card-header">ข้อมูลใบหน้า</h5>
                  <div class="card-body">
                      <a href="<?= site_url('face_admin/add_face_form') ?>"
                          class="btn btn-success">+
                          เพิ่มข้อมูลใบหน้า
                      </a>
                  </div>
                  <div class="table-responsive text-nowrap">
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>หน่วยงาน</th>
                                  <th>รหัสประจำตัว</th>
                                  <th>ชื่อ</th>
                                  <th>รูปใบหน้า</th>
                                  <th>% ความสมบูรณ์</th>
                                  <th>จัดการ</th>
                              </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                              <?php
                                foreach($face as $fd) {
                                    ?>
                              <tr>
                                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>
                                          <?php print empty($fd['space_id'])?'ไม่มี':$space[$fd['space_id']]; ?>
                                      </strong></td>
                                      <td><?php print $fd['personal_id']; ?>
                                  <td><?php print $fd['name'].' '.$fd['surname']; ?>
                                  </td>
                                  <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <?php 
                                    $pic_counta=0;
                                  for($i=1;$i<=5;$i++){
                                    if(!empty($fd['labeled_image_'.$i])){
                                        $pic_counta++;
                                        print '<li
                                                data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                class="avatar avatar-xs pull-up"
                                                title="'.$fd['name'].' #'.$i.'"
                                                >';
                                        print '<img src="'.site_url('writable/labeled_images/'.$fd['labeled_image_'.$i],true).'" class="rounded-circle" />';
                                        print '</li>';
                                        }
                                  }
                                  ?>
                                  </ul>
                                  </td>
                                  <td>
                                  <div class="progress">
                                  <div
                                  <?php
                                    $percentage=$pic_counta/5*100;
                                    $bg_color=array(
                                        '0'=>'bg-danger',
                                        '1'=>'bg-danger',
                                        '2'=>'bg-warning',
                                        '3'=>'bg-warning',
                                        '4'=>'bg-primary',
                                        '5'=>'bg-success',
                                    );
                                  ?>
                        class="progress-bar <?php print $bg_color[$pic_counta]; ?>"
                        role="progressbar"
                        style="width: <?php print $percentage; ?>%"
                        aria-valuenow="<?php print $percentage; ?>"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      >
                      <?php print $percentage; ?>%
                      </div>
                      </div>
                                  </td>
                                  <td>
                                      <div class="dropdown">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                              data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                          <div class="dropdown-menu">
                                              <a class="dropdown-item"
                                                  href="<?php print site_url('face_admin/edit_face/id/'.$fd['id']); ?>"><i
                                                      class="bx bx-edit-alt me-1"></i> Edit</a>
                                              <a class="dropdown-item"
                                                  href="javascript:deleteFace(<?php print $fd['id']; ?>)"><i
                                                      class="bx bx-trash me-1"></i> Delete</a>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                              <?php
                                }
                      ?>
                          </tbody>
                      </table>
                  </div>
              </div>
              <!--/ Basic Bootstrap Table -->
              <script>
                function deleteFace(id) {
                    var ask = window.confirm("ยืนยันการลบข้อมูลรูป?");
                    if (ask) {
                        window.location.href = "<?php print site_url('face_admin/delete_face/id/')?>"+id;

                    }
                }
              </script>