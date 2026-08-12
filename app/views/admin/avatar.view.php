<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

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

  <!-- ---------| Course Details Modal |--------- -->
  <div class="modal fade" id="detailsModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Course Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="pricing-card">
            <!-- <img src="<?=ROOT?>/assets/img/course-1.png" class="w-50" alt=""> -->
            <span class="h5">$199/course</span>
          
            <div class="course-features">
              <div class="feature"><i class="bi bi-clock"></i> <span>40 hours of content</span></div>
              <div class="feature"><i class="bi bi-trophy"></i> <span>Certificate of completion</span></div>
              <div class="feature"><i class="bi bi-phone"></i> <span>Mobile and desktop access</span></div>
              <div class="feature"><i class="bi bi-infinity"></i> <span>Lifetime access</span></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <span class="datte">2026/07/03</span>
        </div>
      </div>
    </div>
  </div>
  <!-- -------| ./Course Details Modal\. |------- -->

  <!-- ---------| Course Approve Form Modal |--------- -->
  <div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Course Approve</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="pricing-card">
            <!-- <img src="<?=ROOT?>/assets/img/course-1.png" class="w-50" alt=""> -->
            <span class="h5">$199/course</span>
          
            <div class="course-features">
              <div class="feature"><i class="bi bi-clock"></i> <span>40 hours of content</span></div>
              <div class="feature"><i class="bi bi-trophy"></i> <span>Certificate of completion</span></div>
              <div class="feature"><i class="bi bi-phone"></i> <span>Mobile and desktop access</span></div>
              <div class="feature"><i class="bi bi-infinity"></i> <span>Lifetime access</span></div>
            </div>
          
            <button class="btn btn-sm w-100 btn-success my-2">Approve</button>
            <button class="btn btn-sm w-100 btn-warning my-2">Pending</button>
            <button class="btn btn-sm w-100 btn-danger" my-2>Reject</button>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
          <span class="date">2026/07/03</span>
        </div>
      </div>
    </div>
  </div>
  <!-- -------| ./Course Approve Form Modal\. |------- -->

  <!-- ---------| MAIN |--------- -->
  <main id="main" class="main">
    <?php if ($action == 'add'): ?>
      <?php if ($uid->role_id == '3' || $uid->role_id == '2'): ?>
        <div class="pagetitle">
          <h1 class="fontClarity"><?=$data['title']?></h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
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

                <!-- ---------- New-Course ---------- -->
                <div class="card col-md-5 mx-auto">
                  <div class="card-body">
                    <h5 class="card-title fontClarity"><i class="bx bxs-video-plus fs-5"></i>&nbsp;<?=ucfirst($data['action'])?>&nbsp;Course</h5>

                    <!-- Form with No Lables -->
                    <form class="row g-3" method="post">
                      <div class="col-md-12">
                        <input type="text" name="title" value="<?=set_value('title')?>" class="form-control <?=!empty($errors['title']) ? 'border-danger' : '';?> fontClarity" placeholder="Course Title">
                        <!-- ---- COURSE Title Error ---- -->
                        <?php if(!empty($errors['title'])):?>
                          <small class="text-danger fontClarity"><?=$errors['title']?>.</small>
                        <?php endif;?>
                        <!-- -| ./COURSE Title Error\. |- -->
                      </div>
                      <div class="col-md-12">
                        <input type="text" name="primary_subject" value="<?=set_value('primary_subject')?>" class="form-control <?=!empty($errors['primary_subject']) ? 'border-danger' : '';?> fontClarity" placeholder="Primary subject e.g. Photography or Design">
                        <!-- ---- COURSE Primary-Subject Error ---- -->
                        <?php if(!empty($errors['primary_subject'])):?>
                          <small class="text-danger fontClarity"><?=$errors['primary_subject']?>.</small>
                        <?php endif;?>
                        <!-- -| ./COURSE Primary-Subject Error\. |- -->
                      </div>
                      <div class="col-md-12">
                        <select name="category_id" id="inputState" class="form-select <?=!empty($errors['category_id']) ? 'border-danger' : '';?> fontClarity">
                          <option value="" selected="" disabled>Course Category...</option>
                          <?php if(!empty($categories)): ?>
                            <?php foreach($categories as $cat): ?>
                              <option <?=set_select('category_id',$cat->id)?> value="<?=$cat->id?>"><?=esc($cat->category)?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                        <!-- ---- COURSE Category_ID Error ---- -->
                        <?php if(!empty($errors['category_id'])):?>
                          <small class="text-danger fontClarity"><?=$errors['category_id']?>.</small>
                        <?php endif;?>
                        <!-- -| ./COURSE Category_ID Error\. |- -->
                      </div>
                      <div class="text-center fontClarity">
                        <button type="submit" class="btn btn-outline-primary "><i class="bx bx-save"></i> Save</button>
                        <a href="<?=ROOT?>/admin/courses">
                          <button type="button" class="mx-3 btn btn-secondary "><i class="bi bi-box-arrow-left"></i> Back</button>
                        </a>
                      </div>
                    </form>
                    <!-- End Form with No Lables -->
                  </div>
                  <!-- -| ./Card-Body\. |- -->
                </div>
                <!-- -------| ./New-Course\. |------- -->
              </div>
              <!-- End Customers Card -->
            </div>
            <!-- End Left side columns -->
          </div>
        </section>
      <?php else: ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <span class="fs-3 d-block my-2"><i class="bi bi-emoji-frown"></i> Oh, no! You're not allowed here!</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

    <?php elseif ($action == 'delete'): ?>
      <div class="pagetitle">
        <h1><?=$data['title']?></h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
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
              <div class="card col-md-8 mx-auto">
                <div class="card-body">
                  <?php if (!empty($row)) :?>
                    <h5 class="card-title text-danger"><i class="bi bi-trash fs-5"></i> Are you sure you want to&nbsp;<?=$data['action']?>&nbsp;this record&quest;</h5>
                    <form method="POST">
                      <div class="mt-3 float-end fontClarity">
                        <button class="btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</button>
                        <a href="<?=ROOT?>/admin/courses">
                          <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                        </a>
                      </div>
                      <p class="">Course Title&colon;&nbsp;<span class="text-primary fs-5"><?=esc($row->title)?></span></p>
                      <p class="">Primary Subject&colon;&nbsp;<?=esc($row->primary_subject)?></p>
                      <p class="">Category&colon;&nbsp;<?=esc($row->category_row->category)?></p>
                      <p class="">Date created&colon;&nbsp;<?=get_date($row->date)?></p>
                    </form>
                  <?php else:?>
                    <div class="text-center fontClarity">
                      <h5 class="alert alert-danger"><i class="bi bi-emoji-frown"></i> Oh, no! Record not found.</h5>
                      <a href="<?=ROOT?>/admin/courses">
                        <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
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
            <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
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
              <div class="card">
                <div class="card-body">
                  <?php if (!empty($row)) :?>
                    <div class="mt-3 float-end fontClarity">
                      <button onclick="save_content()" class="js-save-button btn btn-secondary disabled"><i class="ri-save-3-fill"></i> Save</button>
                      <a href="<?=ROOT?>/admin/courses">
                        <button class="btn btn-outline-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                    <!-- <h5 class="card-title text-success"><i class="bx bx-pencil fs-5"></i>&nbsp;<?php //ucfirst($data['action'])?>&nbsp;Course &dash; <?=esc($row->title)?></h5> -->
                    <h5 class="card-title text-success"><i class="bx bx-pencil fs-5"></i>&nbsp;<?=esc($row->title)?></h5>

                    <!-- ---- Progress-Bar ---- -->
                    <div class="progress my-2 js-save-progress hide">
                      <div class="progress-bar progress-bar-video js-save-progress-inner" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <!-- -| ./Progress-Bar\. |- -->

                    <!-- ---- Tabs ---- -->
                    <div class="tabs-holder">
                      <div onclick="set_tab(this.id,this)" id="intended-learners" class="my-tab active-tab">Intended learners</div>
                      <div onclick="set_tab(this.id,this)" id="curriculum" class="my-tab">Curriculum</div>
                      <div onclick="set_tab(this.id,this)" id="course-landing-page" class="my-tab">Course landing page</div>
                      <div onclick="set_tab(this.id,this)" id="course-duration" class="my-tab">Course Duration</div>
                      <div onclick="set_tab(this.id,this)" id="course-messages" class="my-tab">Course messages</div>
                    </div>
                    <!-- -| ./Tabs\. |- -->

                    <!-- ---- Div-Tabs ---- -->
                    <div oninput="something_changed(event)" class="">
                      <div id="tabs-content">
                        <!-- ---- ./Loader\. ---- -->
                      </div>
                    </div>
                    <!-- -| ./Div-Tabs\. |- -->
                  <?php else:?>
                    <div class="text-center fontClarity">
                      <h5 class="alert alert-danger"><i class="bi bi-emoji-frown"></i> Oh, no! Record not found.</h5>
                      <a href="<?=ROOT?>/admin/courses">
                        <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                      </a>
                    </div>
                  <?php endif;?>
                </div>
              </div>
              <!-- ---| ./Edit Course Tabs\. |--- -->

            </div>
            <!-- End Customers Card -->
          </div>
          <!-- End Left side columns -->
        </div>
      </section>

    <?php else: ?>
      <!-- ---------| Action=>'READ' |--------- -->
      <div class="pagetitle row">
        <div class="col-md-6">
          <h1 class=""><?=$data['title']?></h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=ROOT?>/">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
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

      <!-- ---- Approved Courses ---- -->
      <?php if ($uid->role_id == '2' || $uid->role_id == '3'): ?>
        <div class="row">
          <div class="col-md-12 row">

            <div class="card col-md-3 mx-1">
              <div class="card-header">
                <img src="<?=ROOT?>/assets/img/noIMG.jpg" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                <h5 class="fs-5 card-title text-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                  $199/course
                </h5>
              </div>
              <div class="card-footer">
                <span class="date">2026/07/03</span>
              </div>
            </div>

          </div>
        </div>
      <?php endif; ?>
      <!-- -| ./Approved Courses\. |- -->

      <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <!-- <div class="col-lg-8"> -->
            <div class="row">

              <!-- Courses View -->
              <div class="col-xxl-4 col-xl-12">

                <?php if ($uid->role_id == 1): ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="fs-3 d-block my-2">
                      <i class="bi bi-x-octagon"></i>
                      As a <?=esc(ucfirst($uid->role_name))?>&comma; you're not allowed here.
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php elseif ($uid->role_id == 2): ?>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">
                        <i class="bx bxs-graduation fs-5"></i> My <?=$data['title']?>
                        <a href="<?=ROOT?>/admin/courses/add" class="fontAlido">
                          <button class="btn btn-outline-primary float-end fontClarity"><i class="bx bxs-video-plus"></i> New Course</button>
                        </a>
                      </h5>

                      <!-- ---- TEACHER Block ---- -->
                      <table class="table table-border">
                        <thead>
                          <tr>
                            <th class="bg-light" scope="col">#</th>
                            <th class="bg-light" scope="col">Title</th>
                            <th class="bg-light" scope="col">Category</th>
                            <th class="bg-light" scope="col">Price</th>
                            <th class="bg-light" scope="col">Duration</th>
                            <th class="bg-light" scope="col">Status</th>
                            <th class="bg-light" scope="col">Action</th>
                          </tr>
                        </thead>
                        <?php if(!empty($rows)):?>
                          <tbody>
                            <?php foreach($rows as $row):?>
                              <tr>
                                <th scope="row"><?=$row->id ?: esc('#1')?></th>
                                <td>
                                  <span class="text-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                    <?=esc($row->title) ?: 'Brandon Jacob'?>
                                  </span>
                                </td>
                                <td><?=esc($row->category_id) ?: 'At praesentium minu'?></td>
                                <td><?=esc($row->price_id) ?: '$64'?></td>
                                <td><span class=""><?=esc($row->course_duration) ?: 'Jul 16, 2026</span>'?></td>
                                <td><span class="badge bg-primary">Created</span></td>
                                <td>
                                  <a href="<?=ROOT?>/admin/avatar/edit/<?=$row->id?>">
                                    <i class="bx bx-pencil fs-5 text-success"></i> 
                                  </a>
                                  <a href="<?=ROOT?>/admin/avatar/delete/<?=$row->id?>">
                                    <i class="bx bx-trash fs-5 text-danger"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php endforeach;?>
                          </tbody>
                        <?php else:?>
                          <tbody>
                            <tr>
                              <td class="text-center text-danger" colspan="10">
                                <span class="fs-3 d-block my-2"><i class="bi bi-emoji-frown"></i> Oh, no! No record found.</span>
                                <a href="<?=ROOT?>/admin/avatar">
                                  <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        <?php endif;?>
                      </table>
                      <!-- -| ./TEACHER Block\. |- -->

                    </div>
                  </div>
                <?php elseif ($uid->role_id == 3): ?>
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">
                        <i class="bi bi-mortarboard fs-5"></i> My <?=ucfirst($title)?>
                        <a href="<?=ROOT?>/admin/courses/add" class="fontAlido">
                          <button class="btn btn-outline-primary float-end fontClarity"><i class="bx bxs-video-plus"></i> New Course</button>
                        </a>
                      </h5>

                      <!-- ---| Table with stripped rows |--- -->
                      <div class="card-body">
                        <h5 class="card-title"><?=ucfirst($title)?> <span>| All</span></h5>
                        <table class="table table-border">
                          <thead>
                            <tr>
                              <th class="bg-light" scope="col">#</th>
                              <th class="bg-light" scope="col">Title</th>
                              <th class="bg-light" scope="col">Category</th>
                              <th class="bg-light" scope="col">Price</th>
                              <th class="bg-light" scope="col">Date</th>
                              <th class="bg-light" scope="col">Status</th>
                              <th class="bg-light" scope="col">Action</th>
                              <!--
                              id 	|title 	description 	user_id 	|category_id 	sub_category_id 	level_id 	language_id 	|price_id
                              promo_link 	course_image 	course_image_tmp 	course_promo_video 	primary_subject 	course_duration
                              total_student 	create_date 	start_date 	end_date 	tags 	congratulations_message 	welcome_message
                              |approved 	published 	subtitle 	currency_id 	csrf_code 	views 	trending 	slug
                              -->
                            </tr>
                          </thead>
                          <?php if(!empty($rows)):?>
                            <tbody>
                              <?php foreach($rows as $row):?>
                                <tr>
                                  <th scope="row"><?=$row->id?></th>
                                  <td>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                      <?=esc($row->title)?>
                                    </span>
                                  </td>
                                  <td><?=esc($row->category_row->category)?></td>
                                  <td><?=esc($row->price_row->name.' '.$row->currency_row->currency)?></td>
                                  <td><span class=""><?=esc($row->course_duration)?></span></td>
                                  <td><span class="badge bg-primary">Created</span></td>
                                  <td>
                                    <a href="<?=ROOT?>/admin/avatar/edit/<?=$row->id?>">
                                      <i class="bx bx-pencil fs-5 text-success"></i> 
                                    </a>
                                    <a href="<?=ROOT?>/admin/avatar/delete/<?=$row->id?>">
                                      <i class="bx bx-trash fs-5 text-danger"></i>
                                    </a>
                                  </td>
                                </tr>
                              <?php endforeach;?>
                            </tbody>
                          <?php else:?>
                            <tbody>
                              <tr>
                                <td class="text-center text-danger" colspan="10">
                                  <span class="fs-3 d-block my-2"><i class="bi bi-emoji-frown"></i> Oh, no! No record found.</span>
                                  <a href="<?=ROOT?>/admin/avatar">
                                    <button class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i> Back</button>
                                  </a>
                                </td>
                              </tr>
                            </tbody>
                          <?php endif;?>
                        </table>
                      </div>
                      <!-- -| ./Table with stripped rows\. |- -->

                    </div>
                  </div>
                <?php else: ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="fs-3 d-block my-2">
                      <i class="bi bi-x-octagon"></i>
                      As a <?=esc(ucfirst($uid->role_name))?>&comma; You're not allowed here.
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif; ?>
              </div>
              <!-- End Courses View -->
            </div>
          <!-- </div> -->
          <!-- End Left side columns -->
        </div>
      </section>
      <!-- -------| ./Action=>'READ'\. |------- -->
    <?php endif; ?>
  </main>
  <!-- -------| ./MAIN\. |------- -->

  <!-- ---- SCRIPTS ---- -->
  <script>
    // Variables  ---------------
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "intended-learners";
    var dirty = false;
    var get_meta = true;
    // ------------|  ./Variables

    function show_tab(tab_name){
      var contentDiv = document.querySelector("#tabs-content");
      show_loader(contentDiv);

      /**
       * Private Code
       * *
       * ----------|Changing ACTIVE Tabs|----------
       */
      var div = document.querySelector("#"+tab_name);
      var children = div.parentNode.children;

      /** ---|Removing ACTIVE Feature|--- **/
      for (var i = 0; i < children.length; i++) {
        children[i].classList.remove("active-tab");
      }
      // ---| ./FOR() | Removing ACTIVE Feature

      div.classList.add("active-tab");

      /* -----|Load Tab Information|----- */
      send_data({
        tab_name:tab,
        data_type:"read",
      });
      /** -------| ./Changing ACTIVE Tabs\. |------- **/

      disable_save_button(false);
    }
    // ---| ./Show_Tab()

    function send_data(obj) {
      var myform = new FormData();
      for (key in obj){
        myform.append(key,obj[key]);
      }
      // ---| ./FOR()

      var ajax = new XMLHttpRequest();

      /**
       * ----------------
       * | Progress Bar |
       * ----------------
       */
      document.querySelector(".js-save-progress-inner").style.width = 0 + "%";
      document.querySelector(".js-save-progress-inner").innerHTML = 0 + "%";
      document.querySelector(".js-save-progress").classList.remove("hide");
      ajax.upload.addEventListener('progress',function(e){
        // ...| Calculate Pregress Precentage
        var percent = Math.round((e.loaded / e.total) * 100);
        document.querySelector(".js-save-progress-inner").style.width = percent + "%";
        document.querySelector(".js-save-progress-inner").innerHTML = percent + "%";
      });
      // ---| ./Progress Bar

      ajax.addEventListener('readystatechange',function(){
        if (ajax.readyState == 4){
          // ...| TRUE Block
          if (ajax.status == 200){
            // ...| TRUE Block | Success!
            // alert("Upload Complete!");
            document.querySelector(".js-save-progress").classList.add("hide");
            handle_result(ajax.responseText);
            // window.location.reload();
          } else {
            //  ...| FALSE Block | Error!
            alert("Oh, no! Error Occurred.");
          }
          // ---| ./IF/ELSE(AJAX.Status)
        }
        // ---| ./IF(AJAX.ReadyState)
      });
      
      ajax.open('post','',true);
      // ajax.open('post','');
      ajax.send(myform);
    }
    // ---| ./Send_Data()

    function handle_result(result) {
      // console.log(result);
      if (result.substr(0,2) == '{"') {
        // ...| TRUE Block
        var obj = JSON.parse(result);
        if (typeof obj == 'object') {
          // ...| TRUE Block
          if (obj.data_type == "save") {
            // ...| SAVE Block
            // alert(obj.data);

            /* -----|Clear All ERRORS|----- */
            var error_containers = document.querySelectorAll(".error");
            for (var i = 0; i < error_containers.length; i++) {
              error_containers[i].innerHTML = "";
            }
            /* ---| ./FOR(Error Containers)\. |--- */

            /* -----|Show Any Errors|----- */
            if (typeof obj.errors == 'object') {
              // ...| TRUE Block
              for (key in obj.errors) {
                document.querySelector(".error-"+key).innerHTML = obj.errors[key];
              }
              // ---| ./FOR(Object Keys)
            } else {
              // ...| FALSE Block
              disable_save_button(false);
              dirty = false;
              alert(obj.data);
              window.location.reload();
            }
            /* ---| ./IF/ELSE(OBJECT-Errors)\. |--- */
          } else 
          if (obj.data_type == "get-meta") {
            // ...| GET-Meta Block
            var obj_name = tab.replace("-","_");
            window[obj_name].handle_result(obj.data);
          }
          // ---|./IF/ELSE/IF(Data_type)
        }
        // ---| ./IF(OBJECT)
      } else {
        // ...| FALSE Block | LOAD TAB CONTENT
        var contentDiv = document.querySelector("#tabs-content");
        contentDiv.innerHTML = result;

        // -----| Do Stuff After TAB is Loaded |-----
        var obj_name = tab.replace("-","_");

        if (get_meta) {
          // ...| TRUE Block
          get_meta = false;
          window[obj_name].get_meta(<?=$row->id?>);
        }
        // ---| ./IF(Get_Meta)
      }
      // ---| ./IF/ELSE(SubString)
    }
    // ---| ./Handle_Result()

    function set_tab(tab_name){
      if (dirty) {
        // ...| TRUE Block | Ask User to SAVE when switching Tabs |-----
        if (!confirm("If you don\'t save, your changes will be lost. Save?")) {
          // ...| TRUE Block
          return;
        }
        // ---| ./IF(Confirm)
      }
      // ---| ./IF(Dirty=>'Change')

      get_meta = true;
      tab = tab_name;
      sessionStorage.setItem("tab", tab_name);

      dirty = false;
      show_tab(tab_name);
    }
    // ---| ./Set_Tab()

    function something_changed(e) {
      /** 
       * if an input was edited in a tab, we must locate it
       */
      dirty = tab;
      disable_save_button(true);
    }
    // ---| ./Something_Changed()

    function disable_save_button(status = false) {
      if (status) {
        // ...| TRUE Block
        document.querySelector(".js-save-button").classList.remove("disabled");
        document.querySelector(".js-save-button").classList.remove("btn-secondary");
        document.querySelector(".js-save-button").classList.add("btn-outline-success");
      } else {
        // ...| FALSE Block
        document.querySelector(".js-save-button").classList.add("disabled");
        document.querySelector(".js-save-button").classList.add("btn-secondary");
      }
      // ---| ./IF/ELSE(Status)
    }
    // ---| ./Disable_Save_Button()

    function show_loader(item) {
      item.innerHTML = '<img class="loader" src="<?=ROOT?>/assets/img/loading.gif">';
    }
    // ---| ./Show_Loader()

    /**
     * -----------------------
     * | Saving Tab Contents |
     * -----------------------
     */
    function save_content() {
      var content = document.querySelector("#tabs-content");
      var inputs = content.querySelectorAll("input,textarea,select");

      var obj = {};
      obj.data_type = "save";
      obj.tab_name = tab;

      for (var i = 0; i < inputs.length; i++) {
        var key = inputs[i].name;
        obj[key] = inputs[i].value;
        
        if (inputs[i].type == 'file')
          obj[key] = inputs[i].files[0];

        if (inputs[i].getAttribute('unid'))
          obj['unid_'+key] = inputs[i].getAttribute('unid');

        // if (inputs[i].getAttribute('index'))
        //   obj['index_'+key] = inputs[i].getAttribute('index');
      }
      // ---| ./FOR(Inputs)

      send_data(obj);
    }
    // ---| ./Save_Content()

    /* ------------| Add Image |------------ */
    var course_image_uploading = false;
    var ajax_course_image = null;

    function upload_course_image(file) {
      if(course_image_uploading) {
        // ...| TRUE Block
        alert('Please, wait while the other image uploads!');
        return;
      }
      // ---| ./IF(Course_Image_Uploading)

      // ------| Validating Extensions & Accepting IMAGE |------
      var allowed_types = ['jpg','jpeg','png'];
      var ext = file.name.split(".").pop();
      ext = ext.toLowerCase();

      if (!allowed_types.includes(ext)) {
        // ...| TRUE Block
        alert("Only these types are allowed: "+allowed_types.toString(","));
        return;
      }
      // ---| ./IF() | Validating Extensions & Accepting IMAGE\.

      /* ----| Display Image Preview |---- */
      var img = document.querySelector(".js-image-upload-preview");
      var link = URL.createObjectURL(file);
      img.src = link;
      /* --| ./Display Image Preview\. |-- */
      
      // ------| Begin Uploading |------
      course_image_uploading = true;

      document.querySelector(".js-image-upload-info").innerHTML = file.name;
      document.querySelector(".js-image-upload-info").classList.remove("hide");
      document.querySelector(".js-image-upload-input").classList.add("hide");
      document.querySelector(".js-image-upload-cancel-button").classList.remove("hide");

      var myform = new FormData();
      ajax_course_image = new XMLHttpRequest();

      ajax_course_image.addEventListener('readystatechange',function(){
        if (ajax_course_image.readyState == 4){
          // ...| TRUE Block
          if (ajax_course_image.status == 200){
            // ...| TRUE Block | Success!
            // alert("Upload Complete!");
            // window.location.reload();
            // alert(ajax_course_image.responseText);
          }
          // ---| ./IF(AJAX.Status)

          course_image_uploading = false;
          document.querySelector(".js-image-upload-info").classList.add("hide");
          document.querySelector(".js-image-upload-input").classList.remove("hide");
          document.querySelector(".js-image-upload-cancel-button").classList.add("hide");
        }
        // ---| ./IF(AJAX.ReadyState)
      });

      ajax_course_image.addEventListener('error',function(){
        alert("Oh, NO! An error Occurred.");
      });

      ajax_course_image.addEventListener('abort',function(){
        alert("Upload aborted!");
      });

      ajax_course_image.upload.addEventListener('progress',function(e){
        // ...| Calculate Pregress Precentage
        var percent = Math.round((e.loaded / e.total) * 100);
        document.querySelector(".progress-bar-image").style.width = percent + "%";
        document.querySelector(".progress-bar-image").innerHTML = percent + "%";
      });

      myform.append('data_type','upload_course_image');
      myform.append('tab_name',tab);
      myform.append('image',file);
      myform.append('csrf_code',document.querySelector(".js-csrf_code").value);
      // ----| ./Uploading\. |----

      ajax_course_image.open('post','',true);
      ajax_course_image.send(myform);
    }
    // ---| ./Upload_Course_Image() | Add Image\.

    function ajax_course_image_cancel() {
      ajax_course_image.abort();
    }
    // ---| ./AJAX_Course_Image_Cancel()

    /* ------------| Add Video |------------ */
    var course_video_uploading = false;
    var ajax_course_video = null;

    function upload_course_video(file) {
      if(course_video_uploading) {
        // ...| TRUE Block
        alert('Please, wait while the other video uploads!');
        return;
      }
      // ---| ./IF(Course_Video_Uploading)

      // ------| Validating Extensions & Accepting VIDEO |------
      var allowed_types = ['mp4'];
      var ext = file.name.split(".").pop();
      ext = ext.toLowerCase();

      if (!allowed_types.includes(ext)) {
        // ...| TRUE Block
        alert("Only this type is allowed: "+allowed_types.toString(","));
        return;
      } // ---| ./IF()
      // ----| ./Validating Extensions & Accepting VIDEO\. |----

      /* ----| Display Video Preview |---- */
      var vdo = document.querySelector(".js-video-upload-preview");
      var link = URL.createObjectURL(file);
      vdo.src = link;
      /* --| ./Display Video Preview\. |-- */
      
      // ------| Begin Uploading |------
      course_video_uploading = true;

      document.querySelector(".js-video-upload-info").innerHTML = file.name;
      document.querySelector(".js-video-upload-info").classList.remove("hide");
      document.querySelector(".js-video-upload-input").classList.add("hide");
      document.querySelector(".js-video-upload-cancel-button").classList.remove("hide");

      var myform = new FormData();
      ajax_course_video = new XMLHttpRequest();

      ajax_course_video.addEventListener('readystatechange',function(){
        if (ajax_course_video.readyState == 4){
          // ...| TRUE Block
          if (ajax_course_video.status == 200){
            // ...| TRUE Block | Success!
            // alert("Upload Complete!");
            // window.location.reload();
            // alert(ajax_course_video.responseText);
          }
          // ---| ./IF(AJAX.Status)

          course_video_uploading = false;
          document.querySelector(".js-video-upload-info").classList.add("hide");
          document.querySelector(".js-video-upload-input").classList.remove("hide");
          document.querySelector(".js-video-upload-cancel-button").classList.add("hide");
        }
        // ---| ./IF(AJAX.ReadyState)
      });

      ajax_course_video.addEventListener('error',function(){
        alert("Oh, NO! An error Occurred.");
      });

      ajax_course_video.addEventListener('abort',function(){
        alert("Upload aborted!");
      });

      ajax_course_video.upload.addEventListener('progress',function(e){
        // ...| Calculate Pregress Precentage
        var percent = Math.round((e.loaded / e.total) * 100);
        document.querySelector(".progress-bar-video").style.width = percent + "%";
        document.querySelector(".progress-bar-video").innerHTML = percent + "%";
      });

      myform.append('data_type','upload_course_video');
      myform.append('tab_name',tab);
      myform.append('video',file);
      myform.append('csrf_code',document.querySelector(".js-csrf_code").value);
      // ----| ./Uploading\. |----

      ajax_course_video.open('post','',true);
      ajax_course_video.send(myform);
    }
    // ---| ./Upload_Course_Video() | ./______Add Video______\.

    function ajax_course_video_cancel() {
      ajax_course_video.abort();
    }
    // ---| ./AJAX_Course_Video_Cancel()

    function show_name() {
      alert(document.querySelector("#test-card").name);
    }
    // ---| ./SHOW_NAME()

    show_tab(tab);
    // --| ./SHOW Selected Tab
  </script>

  <script>
    var intended_learners = {
      students_learn: {
        minimum_input: 4,
        inputs_count: 0,
      },
      prerequisites: {
        minimum_input: 1,
        inputs_count: 0,
      },
      description: {
        minimum_input: 1,
        inputs_count: 0,
      },
      item_to_drag: null,
      item_to_drag_to: null,

      /**
       * Add_NEW()
       * *
       * To add a new input field to the FORM
       */
      add_new: function(section,obj){
        var id = section.replace("js-","");
        id = id.replaceAll("-","_");
        /**
         * Create a div similar to:
         * myDIV = <div class="js-input input-group mb-3">
         */
        var mydiv = document.createElement('div');
        mydiv.classList.add('js-input');
        mydiv.classList.add('input-group');
        mydiv.classList.add('mb-3');
        mydiv.setAttribute('onclick','intended_learners.tab_action(event)');
        mydiv.setAttribute('ondragstart','intended_learners.tab_dragstart(event)');
        mydiv.setAttribute('ondragover','intended_learners.tab_dragover(event)');
        mydiv.setAttribute('ondragend','intended_learners.tab_drop(event)');
        mydiv.setAttribute('draggable','true');

        var min = 1;
        if (section == "js-students-learn") {
          // ...| JS-Students-Learn Block
          min = intended_learners.students_learn.minimum_input;
        } else
        if (section == "js-prerequisites") {
          // ...| JS-Prerequisites Block
          min = intended_learners.prerequisites.minimum_input;
        } else
        if (section == "js-description") {
          // ...| JS-Description Block
          min = intended_learners.description.minimum_input;
        }
        // ---| ./IF/ELSE/IF(Section)

        /**
         * ------------------------------
         * |Add a VALUE if() none exists|
         * ------------------------------
         */
        if (typeof obj.value == 'undefined') {
          // ...| TRUE Block
          obj.value = "";
        }
        // ---| ./IF(VALUE)

        mydiv.innerHTML += `
          <!-- ---------| FORM Input |--------- -->
          <input type="text" value="${obj.value}" name="${obj.name}_${intended_learners[id].inputs_count}" class="form-control" placeholder="${obj.placeHolder}" autofocus>
          <span id="delete" min="${min}" class="input-group-text" style="cursor:pointer;">
            <i id="delete" min="${min}" class="bi bi-trash-fill text-danger"></i>
          </span>
          <span class="input-group-text" style="cursor:pointer;">
            <i id="move-up" class="bi bi-caret-up-fill"></i>
            <i id="move-down" class="bi bi-caret-down-fill"></i>
          </span>
          <span id="move" class="input-group-text" style="cursor:pointer;">
            <i class="bi bi-arrows-move"></i>
          </span>
          <!-- -------| ./FORM Input\. |------- -->
        `;
        document.querySelector('.'+section).appendChild(mydiv);
        intended_learners[id].inputs_count++;
      },
      // ---| ./Add_New()

      tab_action: function(e) {
        // Variables  ---------------
        var action = e.target.id;
        var min = parseInt(e.target.getAttribute("min"));
        // ------------|  ./Variables

        if (action == "delete") {
          // ...| DELETE Block
          if (e.currentTarget.parentNode.children.length <= min) {
            // ...| TRUE BLock
            alert(`You must provide at least ${min} item.`);
            return;
          }
          // ---| ./IF(Students_Learn_Minimum_Input)

          if (!confirm("Sure you want to delete this item?")) {
            // ...| TRUE Block
            return;
          }
          // ---| ./IF(Confirm)

          e.currentTarget.remove();
          something_changed(e);
        } else
        if (action == "move-up") {
          // ...| Move UP Block
          var to_move = e.currentTarget;
          var move_to = e.currentTarget.previousElementSibling;
          var container = e.currentTarget.parentNode;

          if (move_to) {
            // ...| TRUE Block
            container.insertBefore(to_move, move_to);
            something_changed(e);
          }
          // ---| IF(Move_To)
        } else
        if (action == "move-down") {
          // ...| Move DOWN Block
          var to_move = e.currentTarget;
          var move_to = e.currentTarget.nextElementSibling.nextElementSibling;
          var container = e.currentTarget.parentNode;

          container.insertBefore(to_move, move_to);
          something_changed(e);
        }
        // ---| ./IF/ELSE/IF(Action)
      },
      // ---| ./Tab_Action()
      
      handle_result: function(result) {
        intended_learners.load_inputs(result);
      },
      // ---| ./Handle_Result()

      get_meta: function(course_id) {
        var obj = {};
        obj.data_type = "get-meta";
        obj.tab_name = tab;
        obj.course_id = course_id;

        send_data(obj);
      },
      // ---| ./Get_Meta()

      load_inputs: function(data = []) {
        // -----| Students-Learn |-----
        if (data.length == 0) {
          // ...| TRUE Block
          for (var i = 0; i < intended_learners.students_learn.minimum_input; i++) {
            intended_learners.add_new('js-students-learn',{
              placeHolder:'Example&colon;&nbsp;Define the roles and responsibilities of a project manager',
              name:'students-learn'
            });
          } // ---| ./FOR()
          // ---| ./Students-Learn\. |---

          // -----| Prerequisites |-----
          for (var i = 0; i < intended_learners.prerequisites.minimum_input; i++) {
            intended_learners.add_new('js-prerequisites',{
              placeHolder:'Example&colon;&nbsp;No programming experience needed. You will learn everything you need to know',
              name:'prerequisites',
            });
          }
          // ---| ./Prerequisites\. |---

          // -----| Description |-----
          for (var i = 0; i < intended_learners.description.minimum_input; i++) {
            intended_learners.add_new('js-description',{
              placeHolder:'Example&colon;&nbsp;Begginer Python developers curious about data science',
              name:'description',
            });
          }
          // ---| ./Description\. |---
        } else {
          // ...| FALSE Block
          let max = data.length;
          for (var i = max - 1; i >= 0; i--) {
            // -----| Students-Learn |-----
            if (data[i].data_type == 'students-learn') {
              intended_learners.add_new('js-students-learn',{
                placeHolder:'Example&colon;&nbsp;Define the roles and responsibilities of a project manager',
                name:'students-learn',
                value:data[i].value,
              });
            }
            // ---| ./IF(Data_Type) | ./Students-Learn\. |---

            // -----| Prerequisites |-----
            if (data[i].data_type == 'prerequisites') {
              intended_learners.add_new('js-prerequisites',{
                placeHolder:'Example&colon;&nbsp;No programming experience needed. You will learn everything you need to know',
                name:'prerequisites',
                value:data[i].value,
              });
            }
            // ---| ./IF(Data_Type) | ./Prerequisites\. |---

            // -----| Description |-----
            if (data[i].data_type == 'description') {
              intended_learners.add_new('js-description',{
                placeHolder:'Example&colon;&nbsp;Begginer Python developers curious about data science',
                name:'description',
                value:data[i].value,
              });
            }
            // ---| ./IF(Data_Type) | ./Description\. |---
          }
          // ---| ./FOR()
        }
        // ---| ./IF/ELSE(Data)
      },
      // ---| ./Load_Inputs()

      tab_dragstart: function(e) {
        intended_learners.item_to_drag = e.currentTarget;
      },
      // ---| ./Tab_DragStart()

      tab_dragover: function(e) {
        intended_learners.item_to_drag_to = e.currentTarget;
      },
      // ---| ./Intended_Learners_Tab_DragOver()

      tab_drop: function(e) {
        intended_learners.item_to_drag_to.parentNode.insertBefore(intended_learners.item_to_drag, intended_learners.item_to_drag_to.nextElementSibling);
        something_changed(e);
      },
      // ---| ./Intended_Learners_Tab_Drop()
    }
    // ---| ./Intended_Learners
  </script>

  <script>
    var curriculum = {
      curriculum: {
        minimum_input: 0,
        inputs_count: 0,
      },
      item_to_drag: null,
      item_to_drag_to: null,

      /**
       * Add_NEW()
       * *
       * To add a new input field to the FORM
       */
      add_new: function(section,obj){
        // console.log(obj);
        var id = section.replace("js-","");
        id = id.replaceAll("-","_");
        /**
         * Create a div similar to:
         * myDIV = <div class="js-input input-group mb-3">
         */
        var mydiv = document.createElement('div');
        mydiv.classList.add('js-input');
        mydiv.classList.add('input-group');
        mydiv.classList.add('mb-3');
        mydiv.setAttribute('onclick','curriculum.tab_action(event)');
        mydiv.setAttribute('ondragstart','curriculum.tab_dragstart(event)');
        mydiv.setAttribute('ondragover','curriculum.tab_dragover(event)');
        mydiv.setAttribute('ondragend','curriculum.tab_drop(event)');
        mydiv.setAttribute('draggable','true');

        var min = 1;
        if (section == "js-curriculum") {
          // ...| JS-Curriculum Block
          min = curriculum.curriculum.minimum_input;
        }
        // ---| ./IF(Section)

        /**
         * ------------------------------
         * |Add a VALUE if() none exists|
         * ------------------------------
         */
        if (typeof obj.value == 'undefined') {
          // ...| TRUE Block
          obj.value = "";
        }
        // ---| ./IF(VALUE)

        if (typeof obj.unid == 'undefined') {
          // ...| TRUE Block
          obj.unid = "";
        }
        // ---| ./IF(UniqueID)

        if (typeof obj.description == 'undefined') {
          // ...| TRUE Block
          obj.description = "";
        }
        // ---| ./IF(Description)

        mydiv.innerHTML += `
          <!-- ---------| FORM Input |--------- -->
          <span id="delete" min="${min}" class="input-group-text" style="cursor:pointer;">
            <i id="delete" min="${min}" class="bi bi-trash-fill text-danger"></i>
          </span>
          <span class="input-group-text" style="cursor:pointer;">
            <i id="move-up" class="bi bi-caret-up-fill"></i>
            <i id="move-down" class="bi bi-caret-down-fill"></i>
          </span>
          <span id="move" class="input-group-text" style="cursor:pointer;">
            <i class="bi bi-arrows-move"></i>
          </span>
          <span class="col-8 g-3">
            <input type="text" value="${obj.value}" unid="${obj.unid}" index="${curriculum[id].inputs_count}" name="${obj.name}_${curriculum[id].inputs_count}" class="form-control w-100" placeholder="${obj.placeHolder}" autofocus>
            <input type="text" value="${obj.description}" name="description_${obj.name}_${curriculum[id].inputs_count}" class="form-control" placeholder="Enter a description">
          </span>
          <hr>
          <div>
            <h6 class="fs-6 fontAlido">Lecture&colon;</h6>
            <div class="col-12 js-lecture-${curriculum.curriculum.inputs_count}">

            </div>
          </div>
          <button type="button" onclick="lecture.add_new('js-lecture-${curriculum.curriculum.inputs_count}',{placeHolder:'Enter lecture title',name:'lecture',unid:'${obj.unid}',index:'${curriculum[id].inputs_count}'})" class="mt-1 btn btn-sm btn-secondary col-sm-3 col-md-2 rounded js-lecture-add fontClarity"><i class="bi bi-display"></i> Add Lecture</button>
          <hr class="input-group">
          <!-- -------| ./FORM Input\. |------- -->
        `;

        /**
         * ------------------------------------------
         * | Add Lectures Input Data if() Available |
         * ------------------------------------------
         */
        lecture.curriculum_id = curriculum.curriculum.inputs_count;

        document.querySelector('.'+section).appendChild(mydiv);
        curriculum[id].inputs_count++;

        // console.log(obj.data);
        if (typeof obj.data == 'object') {
          lecture.load_inputs(obj.data);
        }
        // ---| ./IF(TypeOF Object)
      },
      // ---| ./Add_New()

      tab_action: function(e) {
        // Variables  ---------------
        var action = e.target.id;
        var min = parseInt(e.target.getAttribute("min"));
        // ------------|  ./Variables

        if (action == "delete") {
          // ...| DELETE Block
          if (e.currentTarget.parentNode.children.length <= min) {
            // ...| TRUE BLock
            alert(`You must provide at least ${min} item.`);
            return;
          }
          // ---| ./IF(Students_Learn_Minimum_Input)

          if (!confirm("Sure you want to delete this item?")) {
            // ...| TRUE Block
            return;
          }
          // ---| ./IF(Confirm)

          e.currentTarget.remove();
          something_changed(e);
        } else
        if (action == "move-up") {
          // ...| Move UP Block
          var to_move = e.currentTarget;
          var move_to = e.currentTarget.previousElementSibling;
          var container = e.currentTarget.parentNode;

          if (move_to) {
            // ...| TRUE Block
            container.insertBefore(to_move, move_to);
            something_changed(e);
          }
          // ---| IF(Move_To)
        } else
        if (action == "move-down") {
          // ...| Move DOWN Block
          var to_move = e.currentTarget;
          var move_to = e.currentTarget.nextElementSibling.nextElementSibling;
          var container = e.currentTarget.parentNode;

          container.insertBefore(to_move, move_to);
          something_changed(e);
        }
        // ---| ./IF/ELSE/IF(Action)
      },
      // ---| ./Tab_Action()
      
      handle_result: function(result) {
        curriculum.load_inputs(result);
      },
      // ---| ./Handle_Result()

      get_meta: function(course_id) {
        var obj = {};
        obj.data_type = "get-meta";
        obj.tab_name = tab;
        obj.course_id = course_id;

        send_data(obj);
      },
      // ---| ./Get_Meta()

      load_inputs: function(data = []) {
        // -----| Curriculum |-----
        // console.log(data);
        if (data.length == 0) {
          // ...| TRUE Block
          for (var i = 0; i < curriculum.curriculum.minimum_input; i++) {
            curriculum.add_new('js-curriculum',{
              placeHolder:'Enter a title',
              name:'curriculum'
            });
          } // ---| ./FOR()
          // ---| ./Curriculum\. |---
        } else {
          // ...| FALSE Block
          let max = data.length;
          for (var i = max - 1; i >= 0; i--) {
            // -----| Curriculum |-----
            if (data[i].data_type == 'curriculum') {
              curriculum.add_new('js-curriculum',{
                placeHolder:'Enter a title',
                name:'curriculum',
                value:data[i].value,
                unid:data[i].unid,
                description:data[i].description,
                data:data[i].lectures || false,
              });
            }
            // ---| ./IF(Data_Type) | ./Curriculum\. |---
          }
          // ---| ./FOR()
        }
        // ---| ./IF/ELSE(Data)
      },
      // ---| ./Load_Inputs()

      tab_dragstart: function(e) {
        curriculum.item_to_drag = e.currentTarget;
      },
      // ---| ./Tab_DragStart()

      tab_dragover: function(e) {
        curriculum.item_to_drag_to = e.currentTarget;
      },
      // ---| ./Curriculum_Tab_DragOver()

      tab_drop: function(e) {
        curriculum.item_to_drag_to.parentNode.insertBefore(curriculum.item_to_drag, curriculum.item_to_drag_to.nextElementSibling);
        something_changed(e);
      },
      // ---| ./Curriculum_Tab_Drop()
    }
    // ---| ./Curriculum
  </script>

  <script>
    var lecture = {
      root: '<?=ROOT?>',
      lecture: {
        minimum_input: 0,
        inputs_count: 0,
      },
      curriculum_id: 0,
      prev_curriculum_id: 0,
      item_to_drag: null,
      item_to_drag_to: null,

      /**
       * Add_NEW()
       * *
       * To add a new input field to the FORM
       */
      add_new: function(section,obj){
        var id = section.replace("js-","");
        id = id.replaceAll("-","_");
        /**
         * Create a div similar to:
         * myDIV = <div class="js-input input-group mb-3">
         */
        var mydiv = document.createElement('div');
        mydiv.classList.add('js-input');
        mydiv.classList.add('input-group');
        mydiv.classList.add('mb-3');
        mydiv.setAttribute('onclick','lecture.tab_action(event)');
        mydiv.setAttribute('ondragstart','lecture.tab_dragstart(event)');
        mydiv.setAttribute('ondragover','lecture.tab_dragover(event)');
        mydiv.setAttribute('ondragend','lecture.tab_drop(event)');
        mydiv.setAttribute('draggable','true');

        var min = 1;
        min = lecture.lecture.minimum_input;

        if (lecture.prev_curriculum_id != lecture.curriculum_id) {
          // ...| TRUE Block
          lecture['lecture'].inputs_count = 0;
        }
        // ---| ./IF(Curriculum ID)

        /**
         * --------------------------------
         * | Add a VALUE if() none exists |
         * --------------------------------
         */
        if (typeof obj.value == 'undefined') {
          // ...| TRUE Block
          obj.value = "";
        }
        // ---| ./IF(VALUE)

        if (typeof obj.unid == 'undefined') {
          // ...| TRUE Block
          obj.unid = "";
        }
        // ---| ./IF(UniqueID)

        if (typeof obj.index == 'undefined') {
          // ...| TRUE Block
          obj.index = "";
        }
        // ---| ./IF(INDEX)

        if (typeof obj.description == 'undefined') {
          // ...| TRUE Block
          obj.description = "";
        }
        // ---| ./IF(Description)

        if (typeof obj.file == 'undefined') {
          // ...| TRUE Block
          obj.file = "";
        }
        // ---| ./IF(Video)

        if (typeof obj.base_file == 'undefined') {
          // ...| TRUE Block
          obj.base_file = "";
        }
        // ---| ./IF(Video Path)

        mydiv.innerHTML = `
          <!-- ---------| FORM Input |--------- -->
          <span class="d-flex">
            <span id="delete" min="${min}" class="input-group-text" style="cursor:pointer;">
              <i id="delete" min="${min}" class="bi bi-trash-fill text-danger"></i>
            </span>
            <span class="input-group-text" style="cursor:pointer;">
              <i id="move-up" class="bi bi-caret-up-fill"></i>
              <i id="move-down" class="bi bi-caret-down-fill"></i>
            </span>
            <span id="move" class="input-group-text" style="cursor:pointer;">
              <i class="bi bi-arrows-move"></i>
            </span>
          </span>
          <span class="col-8 g-3">
            <input type="text" value="${obj.value}" unid="${obj.unid}" index="${obj.index}" name="${obj.name}_${lecture['lecture'].inputs_count}_curriculum_${obj.index}" class="form-control" placeholder="${obj.placeHolder}" autofocus>
            <input type="text" value="${obj.description}" name="description_${obj.name}_${lecture['lecture'].inputs_count}_curriculum_${obj.index}" class="form-control" placeholder="Enter a description">
            <input type="hidden" value="${obj.base_file}" name="file_${obj.name}_${lecture['lecture'].inputs_count}_curriculum_${obj.index}" class="form-control" placeholder="Browse... to upload a video file">
            <a href="#" name="file_${obj.name}_${lecture['lecture'].inputs_count}_curriculum_${obj.index}" class="form-control">${obj.base_file}</a>
            <input type="file" name="new_file_${obj.name}_${lecture['lecture'].inputs_count}_curriculum_${obj.index}" class="form-control">
            <div class="container col-8 g-3">
        `;

        // alert(obj.file.match("noimage"));
        if (obj.file.match("no_image.jpg")) {
          // ...| TRUE Block
          mydiv.innerHTML += `
            <img src="${obj.file}" class="col-8">
          `;
        } else {
          // FALSE Block
          mydiv.innerHTML += `
            <video controls class="col-8">
              <source type="video/mp4" src="${obj.file}"></source>
            </video>
          `;
        }
        // ---| ./IF/ELSE()

        mydiv.innerHTML += `
            </div>
          </span>
          <hr>
          <!-- -------| ./FORM Input\. |------- -->
        `;

        document.querySelector('.'+section).appendChild(mydiv);
        lecture['lecture'].inputs_count++;

        lecture.prev_curriculum_id = lecture.curriculum_id;
        console.log(lecture['lecture'].inputs_count);
      },
      // ---| ./Add_New()

      tab_action: function(e) {
        /**
         * -----------------------------
         * | Stop Bubbling Propagation |
         * -----------------------------
         */
        e.stopPropagation();

        // Variables  ---------------
        var action = e.target.id;
        var min = parseInt(e.target.getAttribute("min"));
        // ------------|  ./Variables

        if (action == "delete") {
          // ...| DELETE Block
          if (e.currentTarget.parentNode.children.length <= min) {
            // ...| TRUE BLock
            alert(`You must provide at least ${min} item.`);
            return;
          }
          // ---| ./IF(Students_Learn_Minimum_Input)

          if (!confirm("Sure you want to delete this item?")) {
            // ...| TRUE Block
            return;
          }
          // ---| ./IF(Confirm)

          e.currentTarget.remove();
          something_changed(e);
        } else
        if (action == "move-up") {
          // ...| Move UP Block
          var to_move = e.currentTarget;
          var move_to = e.currentTarget.previousElementSibling;
          var container = e.currentTarget.parentNode;

          if (move_to) {
            // ...| TRUE Block
            container.insertBefore(to_move, move_to);
            something_changed(e);
          }
          // ---| IF(Move_To)
        } else
        if (action == "move-down") {
          // ...| Move DOWN Block
          var to_move = e.currentTarget;
          var move_to = e.currentTarget.nextElementSibling.nextElementSibling;
          var container = e.currentTarget.parentNode;

          container.insertBefore(to_move, move_to);
          something_changed(e);
        }
        // ---| ./IF/ELSE/IF(Action)
      },
      // ---| ./Tab_Action()
      
      handle_result: function(result) {
        lecture.load_inputs(result);
      },
      // ---| ./Handle_Result()

      get_meta: function(course_id) {
        var obj = {};
        obj.data_type = "get-meta";
        obj.tab_name = tab;
        obj.course_id = course_id;

        send_data(obj);
      },
      // ---| ./Get_Meta()

      load_inputs: function(data = []) {
        // console.log(data);
        // -----| Lecture |-----
        if (data.length == 0) {
          // ...| TRUE Block
          for (var i = 0; i < lecture.lecture.minimum_input; i++) {
            lecture.add_new('js-lecture-'+lecture.curriculum_id,{
              placeHolder:'Enter lecture title',
              name:'lecture'
            });
          } // ---| ./FOR()
          // ---| ./Lecture\. |---
        } else {
          // ...| FALSE Block
          let max = data.length;
          for (var i = max - 1; i >= 0; i--) {
            // -----| Lecture |-----
            lecture.add_new('js-lecture-'+lecture.curriculum_id,{
              placeHolder:'Enter lecture title',
              name:'lecture',
              index:lecture.curriculum_id,
              description:data[i].description,
              value:data[i].title,
              unid:data[i].unid,
              file:data[i].file,
              base_file:data[i].base_file,
            });
            // ---| ./Lecture\. |---
          }
          // ---| ./FOR()
        }
        // ---| ./IF/ELSE(Data)
      },
      // ---| ./Load_Inputs()

      tab_dragstart: function(e) {
        lecture.item_to_drag = e.currentTarget;
      },
      // ---| ./Tab_DragStart()

      tab_dragover: function(e) {
        lecture.item_to_drag_to = e.currentTarget;
      },
      // ---| ./Lecture_Tab_DragOver()

      tab_drop: function(e) {
        lecture.item_to_drag_to.parentNode.insertBefore(lecture.item_to_drag, lecture.item_to_drag_to.nextElementSibling);
        something_changed(e);
      },
      // ---| ./Lecture_Tab_Drop()
    }
    // ---| ./Lecture
  </script>

  <script>
    // var course_duration = {
    //   course_duration: {
    //     minimum_input: 0,
    //     inputs_count: 0,
    //   },
    //   item_to_drag: null,
    //   item_to_drag_to: null,

    //   /**
    //    * Add_NEW()
    //    * *
    //    * To add a new input field to the FORM
    //    */
    //   add_new: function(section,obj){
    //     // console.log(obj);
    //     var id = section.replace("js-","");
    //     id = id.replaceAll("-","_");
    //     /**
    //      * Create a div similar to:
    //      * myDIV = <div class="js-input input-group mb-3">
    //      */
    //     var mydiv = document.createElement('div');
    //     mydiv.classList.add('js-input');
    //     mydiv.classList.add('input-group');
    //     mydiv.classList.add('mb-3');
    //     mydiv.setAttribute('onclick','course-duraion.tab_action(event)');
    //     mydiv.setAttribute('ondragstart','course-duraion.tab_dragstart(event)');
    //     mydiv.setAttribute('ondragover','course-duraion.tab_dragover(event)');
    //     mydiv.setAttribute('ondragend','course-duraion.tab_drop(event)');
    //     mydiv.setAttribute('draggable','true');

    //     var min = 1;
    //     if (section == "js-course-duraion") {
    //       // ...| JS-Curriculum Block
    //       min = course-duraion.course-duraion.minimum_input;
    //     }
    //     // ---| ./IF(Section)

    //     /**
    //      * ------------------------------
    //      * |Add a VALUE if() none exists|
    //      * ------------------------------
    //      */
    //     if (typeof obj.value == 'undefined') {
    //       // ...| TRUE Block
    //       obj.value = "";
    //     }
    //     // ---| ./IF(VALUE)

    //     if (typeof obj.unid == 'undefined') {
    //       // ...| TRUE Block
    //       obj.unid = "";
    //     }
    //     // ---| ./IF(UniqueID)

    //     if (typeof obj.description == 'undefined') {
    //       // ...| TRUE Block
    //       obj.description = "";
    //     }
    //     // ---| ./IF(Description)

    //     mydiv.innerHTML += `
    //       <!-- ---------| FORM Input |--------- -->
    //       <span id="delete" min="${min}" class="input-group-text" style="cursor:pointer;">
    //         <i id="delete" min="${min}" class="bi bi-trash-fill text-danger"></i>
    //       </span>
    //       <span class="input-group-text" style="cursor:pointer;">
    //         <i id="move-up" class="bi bi-caret-up-fill"></i>
    //         <i id="move-down" class="bi bi-caret-down-fill"></i>
    //       </span>
    //       <span id="move" class="input-group-text" style="cursor:pointer;">
    //         <i class="bi bi-arrows-move"></i>
    //       </span>
    //       <span class="col-8 g-3">
    //         <input type="text" value="${obj.value}" unid="${obj.unid}" index="${curriculum[id].inputs_count}" name="${obj.name}_${curriculum[id].inputs_count}" class="form-control w-100" placeholder="${obj.placeHolder}" autofocus>
    //         <input type="text" value="${obj.description}" name="description_${obj.name}_${curriculum[id].inputs_count}" class="form-control" placeholder="Enter a description">
    //       </span>
    //       <hr>
    //       <div>
    //         <h6 class="fs-6 fontAlido">Lecture&colon;</h6>
    //         <div class="col-12 js-lecture-${curriculum.curriculum.inputs_count}">

    //         </div>
    //       </div>
    //       <button type="button" onclick="lecture.add_new('js-lecture-${curriculum.curriculum.inputs_count}',{placeHolder:'Enter lecture title',name:'lecture',unid:'${obj.unid}',index:'${curriculum[id].inputs_count}'})" class="mt-1 btn btn-sm btn-secondary col-sm-3 col-md-2 rounded js-lecture-add fontClarity"><i class="bi bi-display"></i> Add Lecture</button>
    //       <hr class="input-group">
    //       <!-- -------| ./FORM Input\. |------- -->
    //     `;

    //     /**
    //      * ------------------------------------------
    //      * | Add Lectures Input Data if() Available |
    //      * ------------------------------------------
    //      */
    //     lecture.curriculum_id = curriculum.curriculum.inputs_count;

    //     document.querySelector('.'+section).appendChild(mydiv);
    //     curriculum[id].inputs_count++;

    //     // console.log(obj.data);
    //     if (typeof obj.data == 'object') {
    //       lecture.load_inputs(obj.data);
    //     }
    //     // ---| ./IF(TypeOF Object)
    //   },
    //   // ---| ./Add_New()

    //   tab_action: function(e) {
    //     // Variables  ---------------
    //     var action = e.target.id;
    //     var min = parseInt(e.target.getAttribute("min"));
    //     // ------------|  ./Variables

    //     if (action == "delete") {
    //       // ...| DELETE Block
    //       if (e.currentTarget.parentNode.children.length <= min) {
    //         // ...| TRUE BLock
    //         alert(`You must provide at least ${min} item.`);
    //         return;
    //       }
    //       // ---| ./IF(Students_Learn_Minimum_Input)

    //       if (!confirm("Sure you want to delete this item?")) {
    //         // ...| TRUE Block
    //         return;
    //       }
    //       // ---| ./IF(Confirm)

    //       e.currentTarget.remove();
    //       something_changed(e);
    //     } else
    //     if (action == "move-up") {
    //       // ...| Move UP Block
    //       var to_move = e.currentTarget;
    //       var move_to = e.currentTarget.previousElementSibling;
    //       var container = e.currentTarget.parentNode;

    //       if (move_to) {
    //         // ...| TRUE Block
    //         container.insertBefore(to_move, move_to);
    //         something_changed(e);
    //       }
    //       // ---| IF(Move_To)
    //     } else
    //     if (action == "move-down") {
    //       // ...| Move DOWN Block
    //       var to_move = e.currentTarget;
    //       var move_to = e.currentTarget.nextElementSibling.nextElementSibling;
    //       var container = e.currentTarget.parentNode;

    //       container.insertBefore(to_move, move_to);
    //       something_changed(e);
    //     }
    //     // ---| ./IF/ELSE/IF(Action)
    //   },
    //   // ---| ./Tab_Action()
      
    //   handle_result: function(result) {
    //     curriculum.load_inputs(result);
    //   },
    //   // ---| ./Handle_Result()

    //   get_meta: function(course_id) {
    //     var obj = {};
    //     obj.data_type = "get-meta";
    //     obj.tab_name = tab;
    //     obj.course_id = course_id;

    //     send_data(obj);
    //   },
    //   // ---| ./Get_Meta()

    //   load_inputs: function(data = []) {
    //     // -----| Curriculum |-----
    //     // console.log(data);
    //     if (data.length == 0) {
    //       // ...| TRUE Block
    //       for (var i = 0; i < curriculum.curriculum.minimum_input; i++) {
    //         curriculum.add_new('js-curriculum',{
    //           placeHolder:'Enter a title',
    //           name:'curriculum'
    //         });
    //       } // ---| ./FOR()
    //       // ---| ./Curriculum\. |---
    //     } else {
    //       // ...| FALSE Block
    //       let max = data.length;
    //       for (var i = max - 1; i >= 0; i--) {
    //         // -----| Curriculum |-----
    //         if (data[i].data_type == 'curriculum') {
    //           curriculum.add_new('js-curriculum',{
    //             placeHolder:'Enter a title',
    //             name:'curriculum',
    //             value:data[i].value,
    //             unid:data[i].unid,
    //             description:data[i].description,
    //             data:data[i].lectures || false,
    //           });
    //         }
    //         // ---| ./IF(Data_Type) | ./Curriculum\. |---
    //       }
    //       // ---| ./FOR()
    //     }
    //     // ---| ./IF/ELSE(Data)
    //   },
    //   // ---| ./Load_Inputs()

    //   tab_dragstart: function(e) {
    //     curriculum.item_to_drag = e.currentTarget;
    //   },
    //   // ---| ./Tab_DragStart()

    //   tab_dragover: function(e) {
    //     curriculum.item_to_drag_to = e.currentTarget;
    //   },
    //   // ---| ./Curriculum_Tab_DragOver()

    //   tab_drop: function(e) {
    //     curriculum.item_to_drag_to.parentNode.insertBefore(curriculum.item_to_drag, curriculum.item_to_drag_to.nextElementSibling);
    //     something_changed(e);
    //   },
    //   // ---| ./Curriculum_Tab_Drop()
    // }
    // ---| ./Curriculum
  </script>

  <!-- -| ./SCRIPTS\. |- -->

<?php $this->view('partials/private.footer',$data) ?>