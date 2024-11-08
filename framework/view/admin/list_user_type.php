<?php helper('view/alert'); ?>
          
          <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">ตารางประเภทผู้ใช้งาน</h5>
                <div class="card-body">
                  <?php if(!empty($_SESSION['response']['alert'])) {
                    gen_alert($_SESSION['response']['alert']);
                    $_SESSION['response']['alert'] = null;
                  } ?>
                  <div class="col-sm-6 col-md-4 col-lg-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                      เพิ่มประเภทผู้ใช้งาน
                    </button>
                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <form
                            action="<?= site_url('management/add_user_type') ?>"
                            method="post">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel1">เพิ่มประเภทผู้ใช้งาน</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col mb-3">
                                  <label for="nameBasic" class="form-label">ชื่อประเภทผู้ใช้งาน</label>
                                  <input type="text" id="nameBasic" class="form-control" placeholder="Enter Name" name="user_type_name" required/>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ชื่อประเภท</th>
                        <th>จัดการ</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                      <?php
                      foreach($user_types as $user_type_data) {
                          ?>

                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                          <strong><?= $user_type_data['type_name'] ?></strong>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item"
                                href="<?= site_url('management/edit_user_type_form/id/'.$user_type_data['id']) ?>"><i
                                  class="bx bx-edit-alt me-1"></i>
                                Edit</a>
                              <a class="dropdown-item"
                                href="<?= site_url('management/delete_user_type/id/'.$user_type_data['id']) ?>"><i
                                  class="bx bx-trash me-1"></i>
                                Delete</a>
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