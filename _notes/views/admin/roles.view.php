<?php $this->view('admin/admin-header',$data) ?>

  <style>
    .tabs-holder {
      display: flex;
      margin-top: 10px;
      margin-bottom: 10px;
      justify-content: center;
      text-align: center;
      flex-wrap: wrap;
    }

    .my-tab {
      flex: 1;
      border-bottom: 2px solid #e2e2e2ff;
      padding-top: 10px;
      padding-bottom: 10px;
      cursor: pointer;
      user-select: none;
      min-width: 150px;
    }

    .my-tab:hover {
      color: #4154f1;
      transition: smooth;
    }

    .active-tab {
      color: #4154f1;
      border-bottom: 2px solid #4154f1;
    }

    .hide {
      display: none;
    }

    .loader {
      position: relative;
      width: 200px;
      height: 150px;
      left: 50%;
      top: 50%;
      transform: translateX(-50%);
      opacity: 0.9;
      user-select: none;
    }
  </style>

  <?php if ($action == 'add'): ?>
    <div class="pagetitle">
      <h1 class="fontClarity"><?=$data['title']?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>//">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=ROOT?>//admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><?=$data['title']?></li>
          <li class="breadcrumb-item active"><?=$data['action']?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="row mb-5">

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12 row">

            <!-- ---------- New-Roles ---------- -->
            <div class="card col-md-5 mx-auto">
              <div class="card-body">
                <h5 class="card-title fontClarity">
                  <i class="bi bi-journal-plus fs-5"></i>&nbsp;<?=ucfirst($data['action'])?>&nbsp;Roles
                </h5>

                <?php if(user_can('add_roles')):?>
                  <!-- Form with No Lables -->
                  <form class="row g-3" method="post">
                    <div class="col-md-12">
                      <input type="text" name="role" value="<?=set_value('role')?>" class="form-control <?=!empty($errors['role']) ? 'border-danger' : '';?> fontClarity" placeholder="Role Name" autofocus>
                      <!-- ---- COURSE Title Error ---- -->
                      <?php if(!empty($errors['role'])):?>
                        <small class="text-danger fontClarity"><?=$errors['role']?>.</small>
                      <?php endif;?>
                      <!-- -| ./COURSE Title Error\. |- -->
                    </div>
                    <div class="col-md-12">
                      <label for="inputState" class="form-label">Active&colon;</label>
                      <select name="disabled" id="inputState" class="form-select fontClarity">
                        <option value="" disabled>Active&nbsp;&quest;</option>
                        <option value="0" selected="">Yes</option>
                        <option value="1">No</option>
                      </select>
                    </div>
                    <div class="text-center fontClarity">
                      <button type="submit" class="btn btn-outline-primary"><i class="bx bx-save"></i> Save</button>
                      <a href="<?=ROOT?>//admin/roles">
                        <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  </form>
                  <!-- End Form with No Lables -->
                <?php else:?>
                  <div class="text-center fontClarity">
                    <h5 class="alert alert-danger"><i class="bi bi-exclamation-octagon fs-5"></i> Permission not allowed.</h5>
                    <a href="<?=ROOT?>//admin/roles">
                      <button type="button" class="mx-3 btn btn-secondary w-50"><i class="bi bi-box-arrow-left"></i> Back</button>
                    </a>
                  </div>
                <?php endif;?>
              </div>
              <!-- -| ./Card-Body\. |- -->
            </div>
            <!-- -------| ./New-Roles\. |------- -->
          </div>
          <!-- End Customers Card -->
        </div>
        <!-- End Left side columns -->
      </div>
    </section>

  <?php elseif ($action == 'delete'): ?>
    <div class="pagetitle">
      <h1><?=$data['title']?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>//">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=ROOT?>//admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><?=$data['title']?></li>
          <li class="breadcrumb-item active"><?=$data['action']?></li>
          <li class="breadcrumb-item"><?=$data['id']?></li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="row">

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <!-- -----| Delete Course Tabs |----- -->
            <div class="card col-md-6 mx-auto">
              <div class="card-body mt-3">
                <?php if (!empty($row)) :?>
                  <?php if (user_can('delete_roles')) :?>
                    <h5 class="card-title text-danger"><i class="bi bi-journal-x fs-5"></i> Are you sure you want to&nbsp;<?=$data['action']?>&nbsp;this record&quest;</h5>
                    <!-- Form with No Lables -->
                    <form class="row g-3" method="post">
                      <div class="col-md-12">
                        <div class="form-control fontClarity"><?=set_value('role',$row->role)?></div>
                        <!-- ---- COURSE Title Error ---- -->
                        <?php if(!empty($errors['role'])):?>
                          <small class="text-danger fontClarity"><?=$errors['role']?>.</small>
                        <?php endif;?>
                        <!-- -| ./COURSE Title Error\. |- -->
                      </div>
                      <div class="col-md-12">
                        <div class="form-control fontClarity">Active&colon;&nbsp;<?=set_value('disabled',$row->disabled ? 'No' : 'Yes')?></div>
                      </div>
                      <div class="text-center fontClarity">
                        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                        <a href="<?=ROOT?>//admin/roles">
                          <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                        </a>
                      </div>
                    </form>
                    <!-- End Form with No Lables -->
                  <?php else:?>
                    <div class="text-center fontClarity">
                      <h5 class="alert alert-danger"><i class="bi bi-exclamation-octagon fs-5"></i> Permission not allowed.</h5>
                      <a href="<?=ROOT?>//admin/roles">
                        <button type="button" class="mx-3 btn btn-secondary w-50"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  <?php endif;?>
                <?php else:?>
                  <div class="text-center fontClarity">
                    <h5 class="alert alert-danger mt-3"><i class="bi bi-emoji-frown"></i> Oh, no! Record not found.</h5>
                    <a href="<?=ROOT?>//admin/roles">
                      <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                    </a>
                  </div>
                <?php endif;?>
              </div>
            </div>
            <!-- ---| ./Delete Course Tabs\. |--- -->

          </div>
          <!-- End Customers Card -->
        </div>
        <!-- End Left side columns -->
      </div>
    </section>

  <?php elseif ($action == 'edit'): ?>
    <div class="pagetitle">
      <h1><?=$data['title']?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>//">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=ROOT?>//admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><?=$data['title']?></li>
          <li class="breadcrumb-item active"><?=$data['action']?></li>
          <li class="breadcrumb-item"><?=$data['id']?></li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="row">

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <!-- -----| Edit Course Tabs |----- -->
            <div class="card col-md-6 mx-auto">
              <div class="card-body mt-4">
                <h5 class="card-title fontClarity"><i class="bi bi-journal-code fs-5"></i>&nbsp;<?=ucfirst($data['action'])?>&nbsp;Permissions</h5>
                <?php if (!empty($row)) :?>
                  <?php if (user_can('edit_roles')) :?>
                    <!-- Form with No Lables -->
                    <form class="row g-3" method="post">
                      <div class="col-md-12">
                        <input type="text" name="role" value="<?=set_value('role',$row->role)?>" class="form-control <?=!empty($errors['role']) ? 'border-danger' : '';?> fontClarity" placeholder="Permissions Name" autofocus>
                        <!-- ---- COURSE Title Error ---- -->
                        <?php if(!empty($errors['role'])):?>
                          <small class="text-danger fontClarity"><?=$errors['role']?>.</small>
                        <?php endif;?>
                        <!-- -| ./COURSE Title Error\. |- -->
                      </div>
                      <div class="col-md-12">
                        <label for="inputState" class="form-label">Active&colon;</label>
                        <select name="disabled" id="inputState" class="form-select fontClarity">
                          <option value="" disabled>Active&nbsp;&quest;</option>
                          <option <?=set_select('disabled','0',$row->disabled)?> value="0" selected="">Yes</option>
                          <option <?=set_select('disabled','1',$row->disabled)?> value="1">No</option>
                        </select>
                      </div>
                      <div class="text-center fontClarity">
                        <button type="submit" class="btn btn-outline-primary"><i class="bx bx-save"></i> Save</button>
                        <a href="<?=ROOT?>//admin/roles">
                          <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                        </a>
                      </div>
                    </form>
                    <!-- End Form with No Lables -->
                  <?php else:?>
                    <div class="text-center fontClarity">
                      <h5 class="alert alert-danger"><i class="bi bi-exclamation-octagon fs-5"></i> Permission not allowed.</h5>
                      <a href="<?=ROOT?>//admin/roles">
                        <button type="button" class="mx-3 btn btn-secondary w-50"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  <?php endif;?>
                  <!-- -------| ./IF/ELSE(User_Can(Permissions))\. |------- -->
                <?php else:?>
                  <div class="text-center fontClarity">
                    <h5 class="alert alert-danger" data-aos="fade-in"><i class="bi bi-emoji-frown"></i> Oh, no! Record not found.</h5>
                    <a href="<?=ROOT?>//admin/roles">
                      <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                    </a>
                  </div>
                <?php endif;?>
              </div>
            </div>
            <!-- ---| ./Edit Permissions Tabs\. |--- -->

          </div>
          <!-- End Customers Card -->
        </div>
        <!-- End Left side columns -->
      </div>
    </section>

  <?php else: ?>
    <div class="pagetitle row">
      <div class="col-md-6">
        <h1 class=""><?=$data['title']?></h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>//">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=ROOT?>//admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active"><?=$data['title']?></li>
          </ol>
        </nav>
      </div>
      <div class="col-md-6 w-50">
        <!-- ---- CHECK Page MESSAGES ---- -->
        <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
          <?php if(message()):?>
            <span class="alert alert-warning">
              <i class="bi bi-envelope-dash"></i>
                <span class=""><?=message('',true)?></span>
            </span>
          <?php endif;?>
        </div>
        <!-- -| ./CHECK Page MESSAGES\. |- -->
      </div>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- ---------- Left side columns ---------- -->
        <!-- <div class="col-lg-8"> -->
          <div class="row">

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    <i class="bi bi-journal-text fs-5"></i> <?=ucfirst($data['title'])?>
                    <a href="<?=ROOT?>//admin/roles/add" class="fontAlido">
                      <button type="button" class="btn btn-outline-primary float-end"><i class="bi bi-journal-plus"></i> New Permissions</button>
                    </a>
                  </h5>

                  <?php if(user_can('view_roles')):?>
                    <!-- Table with stripped rows -->
                    <form class="" method="post">
                      <button type="submit" class="btn btn-outline-success d-block"><i class="bi bi-journal-bookmark-fill"></i> Save Permissions</button>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Role</th>
                              <th scope="col">Active</th>
                              <th scope="col" style="width:600px;">Permissions</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <?php if(!empty($rows)):?>
                            <tbody>
                              <?php foreach($rows as $row):?>
                                <tr>
                                  <th scope="row"><?=$row->id?></th>
                                  <td><?=esc($row->role)?></td>
                                  <td><?=esc($row->disabled ? 'No' : 'Yes')?></td>
                                  <td>
                                    <div class="row">
                                      <?php $num = 0; ?>
                                      <?php foreach (PERMISSIONS as $permission): ?>
                                        <?php
                                          $num++;
                                          $row->permissions = $row->permissions ?? [];
                                        ?>
                                        <!-- ---------- ADMIN ---------- -->
                                        <?php if(strtolower($row->role) == 'admin'):?>
                                          <div class="col-md-4 form-check form-switch">
                                            <input disabled checked class="form-check-input" type="checkbox" id="<?=$row->id?><?=$num?>CheckChecked">
                                            <label class="form-check-label" for="<?=$row->id?><?=$num?>CheckChecked">all permissions</label>
                                          </div>
                                          <?php break;?>
                                        <?php endif;?>
                                        <!-- -------| ./ADMIN\. |------- -->
                                        <div class="col-md-4 form-check form-switch">
                                          <input <?=in_array($permission, $row->permissions) ? 'checked' : ''?> name="<?=$row->id?>_<?=$num?>" value="<?=$permission?>" class="form-check-input" type="checkbox" id="<?=$row->id?><?=$num?>CheckChecked">
                                          <label class="form-check-label" for="<?=$row->id?><?=$num?>CheckChecked"><?=str_replace("_", " ", $permission)?></label>
                                        </div>
                                      <?php endforeach; ?>
                                    </div>
                                  </td>
                                  <td>
                                    <a href="<?=ROOT?>//admin/roles/edit/<?=$row->id?>">
                                      <i class="bx bx-pencil fs-5 text-success"></i> 
                                    </a>
                                    <a href="<?=ROOT?>//admin/roles/delete/<?=$row->id?>">
                                      <i class="bx bx-trash fs-5 text-danger"></i>
                                    </a>
                                  </td>
                                </tr>
                              <?php endforeach;?>
                            </tbody>
                          <?php else:?>
                            <tr>
                              <td class="text-center text-danger" colspan="10">
                                <span class="fs-3 d-block my-2"><i class="bi bi-emoji-frown"></i> Oh, no! No record found.</span>
                                <a href="<?=ROOT?>//admin/">
                                  <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                                </a>
                              </td>
                            </tr>
                          <?php endif;?>
                        </table>
                      </div>
                    </form>
                    <!-- End Table with stripped rows -->
                  <?php else:?>
                    <div class="text-center fontClarity">
                      <h5 class="alert alert-danger"><i class="bi bi-exclamation-octagon fs-5"></i> Permission not allowed.</h5>
                      <a href="<?=ROOT?>//admin/">
                        <button type="button" class="mx-3 btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  <?php endif;?>
                  <!-- -------| ./IF/ELSE(User_Can(Permissions))\. |------- -->

                </div>
              </div>
            </div>
            <!-- End Customers Card -->
          </div>
        <!-- </div> -->
        <!-- End Left side columns -->
      </div>
    </section>
  <?php endif; ?>

<!-- ======= Footer ======= -->
<?php $this->view('admin/admin-footer',$data) ?>