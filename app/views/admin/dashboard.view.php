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
  
  <!-- ---------| Main Content |--------- -->
  <?php if ($uid->role_id == 3): ?>
    <section class="section dashboard">
      <!-- TOP side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Courses Card -->
          <div class="col-xxl-3 col-lg-3">
            <div class="card info-card sales-card">

              <div class="card-body">
                <h5 class="card-title">Courses</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-mortarboard"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?=count($courses) ?: '0 <sub>Empty</sub>'?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Courses Card -->

          <!-- Tests Card -->
          <div class="col-xxl-3 col-lg-3">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Quizes</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-circle-question"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?=count($exams) ?: '0 <sub>Empty</sub>'?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Tests Card -->

          <!-- teachers Card -->
          <div class="col-xxl-3 col-lg-3">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Teachers</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?=count($teachers) ?: '0 <sub>Empty</sub>'?></h6>
                  </div>
                </div>

              </div>
            </div>

          </div>
          <!-- End Teachers Card -->

          <!-- Students Card -->
          <div class="col-xxl-3 col-lg-3">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Students</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?=count($students) ?: '0 <sub>Empty</sub>'?></h6>
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
        <div class="col-lg-8">
          <div class="row">

            <!-- Approved Table -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Approved Table <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                        <td>$64</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                        <td>$47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                        <td>$147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                        <td>$67</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
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

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Events -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent Events <span>| Today</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Voluptatem blanditiis blanditiis eveniet
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 hrs</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Voluptates corrupti molestias voluptatem
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">1 day</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 days</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    Est sit eum reiciendis exercitationem
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">4 weeks</div>
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                  </div>
                </div><!-- End activity item-->

              </div>

            </div>
          </div><!-- End Recent Events -->

        </div><!-- End Right side columns -->

      </div>
    </section>
  <?php elseif ($uid->role_id == 2): ?>
    <div class="alert alert-dark"><?=ucfirst($uid->role_name)?> Nothing to show</div>
  <?php elseif ($uid->role_id == 1): ?>
    <div class="alert alert-info"><?=ucfirst($uid->role_name)?> Nothing to show</div>
  <?php endif; ?>
  <!-- -------| ./Main Content\. |------- -->

</main>
<!-- -------| ./Main\. |------- -->

<?php $this->view('partials/private.footer',$data) ?>
