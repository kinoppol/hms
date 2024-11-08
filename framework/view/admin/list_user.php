              <!-- Basic Bootstrap Table -->
              <div class="card">
                  <h5 class="card-header">ผู้ใช้งาน</h5>
                  <div class="card-body">
                      <a href="<?= site_url('management/add_user_form') ?>"
                          class="btn btn-primary">
                          เพิ่มประเภทผู้ใช้งาน
                      </a>
                  </div>
                  <div class="table-responsive text-nowrap">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>ชื่อผู้ใช้</th>
                                  <th>ประเภทผู้ใช้</th>
                                  <th>อีเมล</th>
                                  <th>ชื่อ</th>
                                  <th>นามสกุล</th>
                                  <th>จัดการ</th>
                              </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                              <?php
                                foreach($userdata as $user) {
                                    ?>
                              <tr>
                                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>
                                          <?php print $user['username']; ?>
                                      </strong></td>
                                  <td><?php print $user_type[$user['user_type_id']]['type_name']; ?>
                                  </td>
                                  <td><?php print $user['email']; ?>
                                  </td>
                                  <td>
                                      <?php print $user['name']; ?>
                                  </td>
                                  <td><?php print $user['surname']; ?>
                                  </td>
                                  <td>
                                      <div class="dropdown">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                              data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                          <div class="dropdown-menu">
                                              <a class="dropdown-item"
                                                  href="<?php print site_url('management/edit_user_form/id/'.$user['id']); ?>"><i
                                                      class="bx bx-edit-alt me-1"></i> Edit</a>
                                              <a class="dropdown-item"
                                                  href="<?php print site_url('management/delete_user/id/'.$user['id']); ?>"><i
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