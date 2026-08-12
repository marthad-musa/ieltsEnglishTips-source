<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<!-- ---------| Main |--------- -->
<main id="main" class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="pagetitle">
    <h1 class=""><?=$data['title']?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=ROOT?>">Home</a></li>
        <li class="breadcrumb-item active"><?=$data['title']?></li>
      </ol>
    </nav>
  </div>
  <!-- -------| ./Page Title\. |------- -->
  
  <!-- ---- CHECK Page MESSAGES ---- -->
  <div class="row">
    <div class="col-md-6 w-50">
      <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
        <?php if(message()):?>
          <span class="alert alert-warning">
            <i class="bi bi-envelope-dash"></i>
              <span class=""><?=message('',true)?></span>
          </span>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div style="display:none"><?php csrf() ?></div>
  <!-- -| ./CHECK Page MESSAGES\. |- -->

  <!-- ---------| Main Content |--------- -->
  <?php if ($uid->role_id == 3): ?>

    <section class="section dashboard">
      <!-- TOP side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Admins Card -->
          <div class="col-xxl-4 col-lg-4">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Admins</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-badge"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      <?php if (!empty($admins)): ?>
                        <?=count($admins)?>
                      <?php else: ?>
                        0 <sub>Empty</sub>
                      <?php endif; ?>
                    </h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Admins Card -->

          <!-- Teachers Card -->
          <div class="col-xxl-4 col-lg-4">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Teachers</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      <?php if (!empty($teachers)): ?>
                        <?=count($teachers)?>
                      <?php else: ?>
                        0 <sub>Empty</sub>
                      <?php endif; ?>
                    </h6>
                  </div>
                </div>

              </div>
            </div>

          </div>
          <!-- End Teachers Card -->

          <!-- Students Card -->
          <div class="col-xxl-4 col-lg-4">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Students</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      <?php if (!empty($students)): ?>
                        <?=count($students)?>
                      <?php else: ?>
                        0 <sub>Empty</sub>
                      <?php endif; ?>
                    </h6>
                  </div>
                </div>

              </div>
            </div>

          </div>
          <!-- End Students Card -->

        </div>
      </div>
      <!-- End TOP side columns -->

      <div class="row">
        
        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Approved Table -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Approve <?=esc($data['title'])?></h5>

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Role</th>
                        <!-- <th scope="col">Action</th> -->
                        <!-- <th scope="col">Status</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($users): ?>
                        <?php foreach ($users as $usr): ?>
                          <tr>
                            <th scope="row"><a href="#"><?=esc($usr->id)?></a></th>
                            <td><?=esc($usr->firstname)?> <?=esc($usr->lastname)?></td>
                            <td><img src="<?=get_image($usr->image)?>" alt="<?=esc($usr->firstname)?> <?=esc($usr->lastname)?>" style="max-width: 100px;"></td>
                            <td>
                              <?php if ($usr->id == $uid->id): ?>
                                <span class="text-muted"><?=esc(ucfirst($usr->role_name))?> (Your role)</span>
                              <?php else: ?>
                                <?php $disabled = ($usr->role_id == 3) ? 'disabled' : ''; ?>
                                <select
                                  class="form-select form-select-sm user-role-select"
                                  data-user-id="<?=esc($usr->id)?>"
                                  data-current-role="<?=esc($usr->role_id)?>"
                                  style="width:160px;display:inline-block"
                                  <?=$disabled?>
                                  <?php if ($disabled): ?>title="Admin roles editable by super-admin only."<?php endif; ?>
                                >
                                  <?php foreach ($roles as $role): ?>
                                    <option value="<?=esc($role->id)?>" <?= $role->id == $usr->role_id ? 'selected' : '' ?>><?=esc(ucfirst($role->role))?></option>
                                  <?php endforeach; ?>
                                </select>
                                <div class="role-update-status text-muted small mt-1"></div>
                              <?php endif; ?>
                            </td>
                            <!-- <td>
                              <a href="<?=ROOT?>/admin/users/edit/<?=$usr->id?>">
                                <i class="bx bx-pencil fs-5 text-success"></i> 
                              </a>
                              <a href="<?=ROOT?>/admin/users/delete/<?=$usr->id?>">
                                <i class="bx bx-trash fs-5 text-danger"></i>
                              </a>
                            </td> -->
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <th scope="row"><a href="#">#2457</a></th>
                          <td>Brandon Jacob</td>
                          <td><img src="<?=ROOT?>/assets/img/noimage.jpg" alt="..." style="max-width: 100px;"></td>
                          <td>Student</td>
                          <td>
                            <i class="bx bx-pencil fs-5 text-success"></i> 
                            <i class="bx bx-trash fs-5 text-danger"></i>
                          </td>
                          <td><span class="badge bg-success">Approved</span></td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            <!-- End Approved Table -->

          </div>
          <!-- End Row -->
        </div>
        <!-- End Left side columns -->

      </div>
    </section>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const csrfInput = document.querySelector('.js-csrf_code');

        if (!csrfInput) {
          return;
        }

        document.querySelectorAll('.user-role-select').forEach(function(select) {
          const status = select.closest('td').querySelector('.role-update-status');
          const originalRole = select.dataset.currentRole;

          select.addEventListener('change', function() {
            const userId = select.dataset.userId;
            const newRoleId = select.value;
            const payload = new URLSearchParams();

            payload.append('ajax', '1');
            payload.append('action', 'set_role');
            payload.append('user_id', userId);
            payload.append('role_id', newRoleId);
            payload.append('csrf_code', csrfInput.value);

            select.disabled = true;
            status.textContent = 'Saving...';
            status.classList.remove('text-danger', 'text-success');

            fetch(window.location.href, {
              method: 'POST',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              body: payload.toString()
            })
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              if (data.success) {
                status.textContent = data.message;
                status.classList.add('text-success');
                select.dataset.currentRole = newRoleId;
              } else {
                status.textContent = data.message;
                status.classList.add('text-danger');
                select.value = originalRole;
              }
            })
            .catch(function() {
              status.textContent = 'Save failed. Try again.';
              status.classList.add('text-danger');
              select.value = originalRole;
            })
            .finally(function() {
              select.disabled = false;
            });
          });
        });
      });
    </script>

  <?php elseif ($uid->role_id == 2): ?>
    <div class="alert alert-dark"><?=ucfirst($uid->role_name)?> Nothing to show</div>
  <?php elseif ($uid->role_id == 1): ?>
    <div class="alert alert-info"><?=ucfirst($uid->role_name)?> Nothing to show</div>
  <?php endif; ?>
  <!-- -------| ./Main Content\. |------- -->

</main>
<!-- -------| ./Main\. |------- -->

<?php $this->view('partials/private.footer',$data) ?>
