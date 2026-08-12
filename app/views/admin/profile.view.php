<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<style>
  .hide {
    display: none;
  }
</style>

<!-- ---------| Main |--------- -->
<main id="main" class="main">

  <!-- ---------| Page Title |--------- -->
  <div class="pagetitle">
    <h1 class=""><?=$data['title']?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><?=$data['title']?></li>
          <li class="breadcrumb-item active"><?=esc(ucfirst($uid->firstname))?> <?=esc(ucfirst($uid->lastname))?></li>
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
  <!-- -| ./CHECK Page MESSAGES\. |- -->

  <!-- ---------| Main Content |--------- -->
  <?php if(!empty($uid)): ?>
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?=get_image($uid->image)?>" alt="<?=esc($uid->firstname)?> <?=esc($uid->lastname)?> Profile" class="rounded-circle" style="width:150px;max-width:150px;height:150px;object-fit:cover;">
              <h2 class=""><?=esc($uid->firstname)?> <?=esc($uid->lastname)?></h2>
              <span class="badge bg-<?=show_role($uid->role_id)?>"><i class="bi bi-star me-1"> <?=esc(ucfirst($uid->role_name))?></i> </span>
              <div class="social-links mt-2">
                <a href="<?=esc($uid->facebook_link)?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?=esc($uid->instagram_link)?>" class="instagram"><i class="bi bi-instagram"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" id="profile-overw-tab">Overview</button>
                </li>

                <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" id="profile-edit-tab">Edit Profile</button>
                </li>

                <!-- <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" id="profile-settings-tab">Settings</button>
                </li> -->

                <!-- <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" id="profile-change-password-tab">Change Password</button>
                </li> -->

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?=esc(show_details($uid->bio))?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=esc(show_details($uid->firstname))?> <?=esc(show_details($uid->lastname))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">User Name</div>
                    <div class="col-lg-9 col-md-8"><?=esc(show_details($uid->username))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8"><?=esc(show_details($uid->company))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?=esc(show_details($uid->job))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8"><?=esc(show_details($uid->country))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?=esc(show_details($uid->address))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?=esc(show_details($uid->phone))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=esc(show_details($uid->email))?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" enctype="multipart/form-data">

                    <!-- ---| Profile Image |--- -->
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="d-flex">
                          <img class="js-image-preview" src="<?=ROOT?>/<?=esc($uid->image) ?: No_Image?>" alt="<?=esc($uid->firstname)?> <?=esc($uid->lastname)?> Profile">
                          <div class="js-filename m-2">Selected file: None</div>
                        </div>
                        <div class="pt-2">
                          <label class="btn btn-primary btn-sm" title="Upload new profile image">
                            <i class="bi bi-upload text-white"></i>
                            <input class="js-profile-image-input d-none" onchange="load_image(this.files[0])" type="file" name="image" title="Upload my profile image">
                          </label>
                          <!-- ---- Image Error ---- -->
                          <?php if(!empty($errors['image'])):?>
                            <small class="js-error-image text-danger"><?=$errors['image']?>.</small>
                          <?php endif;?>
                          <small class="js-error-image text-danger"></small>
                          <!-- -| ./Image Error\. |- -->
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>
                    <!-- -| ./Profile Image\. |- -->

                    <!-- ---| Firstname |--- -->
                    <div class="row mb-3">
                      <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control <?=!empty($errors['firstname']) ? 'border-danger' : '';?>" id="firstname" value="<?=set_value('firstname',$uid->firstname)?>" placeholder="Edit first name" required>
                      </div>
                      <!-- ---- Firstname Error ---- -->
                      <?php if(!empty($errors['firstname'])):?>
                        <small class="js-error-firstname text-danger"><?=$errors['firstname']?>.</small>
                      <?php endif;?>
                      <small class="js-error-firstname text-danger"></small>
                      <!-- -| ./Firstname Error\. |- -->
                    </div>
                    <!-- -| ./Firstname\. |- -->

                    <!-- ---| Lastname |--- -->
                    <div class="row mb-3">
                      <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control <?=!empty($errors['lastname']) ? 'border-danger' : '';?>" id="lastname" value="<?=set_value('lastname',$uid->lastname)?>" placeholder="Edit last name" required>
                      </div>
                      <!-- ---- Lastname Error ---- -->
                      <?php if(!empty($errors['lastname'])):?>
                        <small class="js-error-lastname text-danger"><?=$errors['lastname']?>.</small>
                      <?php endif;?>
                      <small class="js-error-lastname text-danger"></small>
                      <!-- -| ./Lastname Error\. |- -->
                    </div>
                    <!-- -| ./Lastname\. |- -->

                    <!-- ---| Username |--- -->
                    <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">User Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control <?=!empty($errors['username']) ? 'border-danger' : '';?>" id="username" value="<?=set_value('username',$uid->username)?>" placeholder="Edit user name" required>
                      </div>
                      <!-- ---- Username Error ---- -->
                      <?php if(!empty($errors['username'])):?>
                        <small class="js-error-username text-danger"><?=$errors['username']?>.</small>
                      <?php endif;?>
                      <small class="js-error-username text-danger"></small>
                      <!-- -| ./Username Error\. |- -->
                    </div>
                    <!-- -| ./Username\. |- -->

                    <!-- ---| Biography |--- -->
                    <div class="row mb-3">
                      <label for="bio" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="bio" class="form-control" id="bio" style="height: 100px" placeholder="Edit biography"><?=set_value('bio',$uid->bio)?></textarea>
                      </div>
                      <!-- ---- Biography Error ---- -->
                      <?php if(!empty($errors['bio'])):?>
                        <small class="js-error-bio text-danger"><?=$errors['bio']?>.</small>
                      <?php endif;?>
                      <small class="js-error-bio text-danger"></small>
                      <!-- -| ./Biography Error\. |- -->
                    </div>
                    <!-- -| ./Biography\. |- -->

                    <!-- ---| Company |--- -->
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="<?=set_value('company',$uid->company)?>" placeholder="Edit company">
                      </div>
                      <!-- ---- Company Error ---- -->
                      <?php if(!empty($errors['company'])):?>
                        <small class="js-error-company text-danger"><?=$errors['company']?>.</small>
                      <?php endif;?>
                      <small class="js-error-company text-danger"></small>
                      <!-- -| ./Company Error\. |- -->
                    </div>
                    <!-- -| ./Company\. |- -->

                    <!-- ---| Job |--- -->
                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="<?=set_value('job',$uid->job)?>" placeholder="Edit job title">
                      </div>
                      <!-- ---- JOB Error ---- -->
                      <?php if(!empty($errors['job'])):?>
                        <small class="js-error-job text-danger"><?=$errors['job']?>.</small>
                      <?php endif;?>
                      <small class="js-error-job text-danger"></small>
                      <!-- -| ./JOB Error\. |- -->
                    </div>
                    <!-- -| ./Job\. |- -->

                    <!-- ---| Country |--- -->
                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="<?=set_value('country',$uid->country)?>" placeholder="Edit country">
                      </div>
                      <!-- ---- Country Error ---- -->
                      <?php if(!empty($errors['country'])):?>
                        <small class="js-error-country text-danger"><?=$errors['country']?>.</small>
                      <?php endif;?>
                      <small class="js-error-country text-danger"></small>
                      <!-- -| ./Country Error\. |- -->
                    </div>
                    <!-- -| ./Country\. |- -->

                    <!-- ---| LANGUAGE |--- -->
                    <div class="row mb-3">
                      <label for="Language" class="col-md-4 col-lg-3 col-form-label">Language</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select text-start" name="language_id" id="Language" aria-label=".form-select example">
                          <option class="fs-6 fw-bold" selected disabled>- Language -</option>
                          <option class="fs-6" value="1" <?= ($uid->language_id =='1') ? 'selected': ''; ?>>English</option>
                          <option class="fs-6" value="2" <?= ($uid->language_id =='2') ? 'selected': ''; ?>>Arabic</option>
                        </select>
                      </div>
                    </div>
                    <!-- -| ./LANGUAGE\. |- -->

                    <!-- ---| Address |--- -->
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?=set_value('address',$uid->address)?>" placeholder="Edit address">
                      </div>
                      <!-- ---- Address Error ---- -->
                      <?php if(!empty($errors['address'])):?>
                        <small class="js-error-address text-danger"><?=$errors['address']?>.</small>
                      <?php endif;?>
                      <small class="js-error-address text-danger"></small>
                      <!-- -| ./Address Error\. |- -->
                    </div>
                    <!-- -| ./Address\. |- -->

                    <!-- ---| Phone |--- -->
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control <?=!empty($errors['phone']) ? 'border-danger' : '';?>" id="Phone" value="<?=set_value('phone',$uid->phone)?>" placeholder="Edit phone number">
                      </div>
                      <!-- ---- Phone Error ---- -->
                      <?php if(!empty($errors['phone'])):?>
                        <small class="js-error-phone text-danger"><?=$errors['phone']?>.</small>
                      <?php endif;?>
                      <small class="js-error-phone text-danger"></small>
                      <!-- -| ./Phone Error\. |- -->
                    </div>
                    <!-- -| ./Phone\. |- -->

                    <!-- ---| E-mail |--- -->
                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control <?=!empty($errors['email']) ? 'border-danger' : '';?>" id="Email" value="<?=set_value('email',$uid->email)?>" placeholder="Edit E-mail" required>
                      </div>
                      <!-- ---- E-mail Error ---- -->
                      <?php if(!empty($errors['email'])):?>
                        <small class="js-error-email text-danger"><?=$errors['email']?>.</small>
                      <?php endif;?>
                      <small class="js-error-email text-danger"></small>
                      <!-- -| ./E-mail Error\. |- -->
                    </div>
                    <!-- -| ./E-mail\. |- -->

                    <!-- ---| Facebook |--- -->
                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook_link" type="text" class="form-control <?=!empty($errors['facebook_link']) ? 'border-danger' : '';?>" id="Facebook" value="<?=set_value('facebook_link',$uid->facebook_link)?>" placeholder="Edit Facebook profile link">
                      </div>
                      <!-- ---- Facebook Error ---- -->
                      <?php if(!empty($errors['facebook_link'])):?>
                        <small class="js-error-facebook_link text-danger"><?=$errors['facebook_link']?>.</small>
                      <?php endif;?>
                      <small class="js-error-facebook_link text-danger"></small>
                      <!-- -| ./Facebook Error\. |- -->
                    </div>
                    <!-- -| ./Facebook\. |- -->
                      
                    <!-- ---| Instagram |--- -->
                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram_link" type="text" class="form-control <?=!empty($errors['instagram_link']) ? 'border-danger' : '';?>" id="Instagram" value="<?=set_value('instagram_link',$uid->instagram_link)?>" placeholder="Edit Instagram profile link">
                      </div>
                      <!-- ---- Instagram Error ---- -->
                      <?php if(!empty($errors['instagram_link'])):?>
                        <small class="js-error-instagram_link text-danger"><?=$errors['instagram_link']?>.</small>
                      <?php endif;?>
                      <small class="js-error-instagram_link text-danger"></small>
                      <!-- -| ./Instagram Error\. |- -->
                    </div>
                    <!-- -| ./Instagram\. |- -->
                        
                    <!-- ---| FORM PROGRESS BAR |--- -->
                    <div class="js-prog progress my-4 hide">
                      <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">Saving.. 0%</div>
                    </div>
                    <!-- -| ./FORM PROGRESS BAR\. |- -->

                    <!-- ---| Submit |--- -->
                    <div class="text-center">
                      <a href="<?=ROOT?>/admin/dashboard">
                        <button type="button" class="btn btn-secondary w-25 float-start">Go back!</button>
                      </a>
                      <button type="button" onclick="save_profile(event)" type="submit" class="btn btn-success w-25 float-end">Save Changes</button>
                    </div>
                    <!-- -| ./Submit\. |- -->
                  </form>
                  <!-- End Profile Edit Form -->
                </div>

                <!-- <div class="tab-pane fade pt-3" id="profile-settings"> -->

                  <!-- Settings Form -->
                  <!-- <form method="post"> -->

                    <!-- ---- LANGUAGE ---- -->
                    <!-- <div class="row mb-3 mx-auto col-9">
                      <select class="form-select text-start mb-1 py-3" name="language_id" aria-label=".form-select example">
                        <option class="fs-6 fw-bold" selected disabled>- Language -</option>
                        <option class="fs-6" value="1" <?= ($uid->language_id =='1') ? 'selected': ''; ?>>English</option>
                        <option class="fs-6" value="2" <?= ($uid->language_id =='2') ? 'selected': ''; ?>>Arabic</option>
                      </select>
                    </div> -->
                    <!-- -| ./LANGUAGE\. |- -->

                    <!-- ---- FORM PROGRESS BAR ---- -->
                    <!-- <div class="js-prog progress my-4 hide">
                      <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">Saving.. 0%</div>
                    </div> -->
                    <!-- -| ./FORM PROGRESS BAR\. |- -->

                    <!-- <div class="text-center">
                      <a href="<?=ROOT?>/admin/dashboard">
                        <button type="button" class="btn btn-secondary w-25 float-start">Go back!</button>
                      </a>
                      <button type="button" onclick="save_profile(event)" type="submit" class="btn btn-success w-25 float-end">Save Changes</button>
                    </div>
                  </form> -->
                  <!-- End settings Form -->

                <!-- </div> -->

                <!-- <div class="tab-pane fade pt-3" id="profile-change-password"> -->

                  <!-- ---------| Change Password |--------- -->
                  <!-- <form method="post"> -->
                    <!-- ---| Current Password |--- -->
                    <!-- <div class="row mb-3">
                      <label for="current-Password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="current-password" type="password" class="form-control <?=!empty($errors['current-password']) ? 'border-danger' : '';?>" id="current-password" value="<?=set_value('password',$uid->password)?>" placeholder="Type your current password, please!" required>
                      </div> -->
                      <!-- ---- Password Error ---- -->
                      <!-- <?php if(!empty($errors['current-password'])):?>
                        <small class="js-error-password text-danger"><?=$errors['current-password']?>.</small>
                      <?php endif;?>
                      <small class="js-error-password text-danger"></small> -->
                      <!-- -| ./Password Error\. |- -->
                    <!-- </div> -->
                    <!-- -| ./Current Password\. |- -->

                    <!-- ---| New Password |--- -->
                    <!-- <div class="row mb-3">
                      <label for="new-Password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="new-password" type="password" class="form-control <?=!empty($errors['new-password']) ? 'border-danger' : '';?>" id="new-password" value="" placeholder="Type your new password, please!" required>
                      </div> -->
                      <!-- ---- Password Error ---- -->
                      <!-- <?php if(!empty($errors['new-password'])):?>
                        <small class="js-error-password text-danger"><?=$errors['new-password']?>.</small>
                      <?php endif;?>
                      <small class="js-error-password text-danger"></small> -->
                      <!-- -| ./Password Error\. |- -->
                    <!-- </div> -->
                    <!-- -| ./New Password\. |- -->

                    <!-- ---| Retype Password |--- -->
                    <!-- <div class="row mb-3">
                      <label for="retype-Password" class="col-md-4 col-lg-3 col-form-label">Re-Type Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="retype-password" type="password" class="form-control <?=!empty($errors['retype-password']) ? 'border-danger' : '';?>" id="retype-password" value="" placeholder="Re-type your password, please!" required>
                      </div> -->
                      <!-- ---- Password Error ---- -->
                      <!-- <?php if(!empty($errors['retype-password'])):?>
                        <small class="js-error-password text-danger"><?=$errors['retype-password']?>.</small>
                      <?php endif;?>
                      <small class="js-error-password text-danger"></small> -->
                      <!-- -| ./Password Error\. |- -->
                    <!-- </div> -->
                    <!-- -| ./Retype Password\. |- -->

                    <!-- ---| FORM PROGRESS BAR |--- -->
                    <!-- <div class="js-prog progress my-4 hide">
                      <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0">Saving.. 0%</div>
                    </div> -->
                    <!-- -| ./FORM PROGRESS BAR\. |- -->

                    <!-- ---| Submit |--- -->
                    <!-- <div class="text-center">
                      <a href="<?=ROOT?>/admin/dashboard">
                        <button type="button" class="btn btn-secondary w-25 float-start">Go back!</button>
                      </a>
                      <button type="button" onclick="save_profile(event)" type="submit" class="btn btn-success w-25 float-end">Save Changes</button>
                    </div> -->
                    <!-- -| ./Submit\. |- -->
                  <!-- </form> -->
                  <!-- -------| ./Change Password\. |------- -->

                <!-- </div> -->

              </div>
              <!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
  <?php else:?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <span class="fs-3 d-block my-2"><i class="bi bi-emoji-frown"></i> Oh, no! No record found.</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif;?>

  <!-- -------| ./Main Content\. |------- -->

  <!-- ---- SCRIPTS ---- -->
  <script>
    // Variables  ---------------
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "overview";
    var dirty = false;
    // ------------|  ./Variables

    function show_tab(tab_name){
      const someTabTriggerEl = document.querySelector(tab_name  + "-tab");
      const tab = new bootstrap.Tab(someTabTriggerEl);
      tab.show();
    }
    // ---| ./Show_Tab()

    function set_tab(tab_name){
      tab = tab_name;
      sessionStorage.setItem("tab", tab_name);
    }
    // ---| ./Set_Tab()

    function load_image(file){
      document.querySelector(".js-filename").innerHTML = "Selected file: " + file.name;

      var mylink = window.URL.createObjectURL(file);
      document.querySelector(".js-image-preview").src = mylink;
    }
    // ---| ./LOAD-IMAGE()

    window.onload = function(){
      show_tab(tab);
    }

    /* -----| Upload Functions | ----- */
    function save_profile(e){
      var form = e.currentTarget.form;
      var inputs = form.querySelectorAll("input,textarea");
      var obj = {};
      var image_added = false;

      for (let i = 0; i < inputs.length; i++) {
        var key = inputs[i].name;
        if(key == 'image'){
          // ...| TRUE Block
          if(typeof inputs[i].files[0] == 'object'){
            obj[key] = inputs[i].files[0];
            image_added = true;
          }
          // ---| ./IF(TypeOF)
        }else{
          // ...| FALSE Block
          obj[key] = inputs[i].value;
        }
        // ___| ./IF/ELSE(KEY)
      }
      // ---| ./FOR()

      /* -----| Validate Image | ----- */
      if (image_added) {
        // ...| TRUE Block
        var allowed = ['jpg','jpeg','png','gif'];
        if(typeof obj.image == 'object'){
          // ...| TRUE Block
          var ext = obj.image.name.split(".").pop();
        }
        // ---| ./IF(TypeOF)

        if(!allowed.includes(ext.toLowerCase())){
          // ...| TRUE Block
          alert("Allowed file types are: " + allowed.toString(","));
          return;
        }
        // ---| ./IF(Includes)
      }
      // ---| ./IF(ImageAdded)

      send_data(obj);
    }
    // ---| ./Save_Profile()

    function send_data(obj, progbar = 'js-prog'){
      var prog = document.querySelector("."+progbar);
      prog.children[0].style.width = "0%";
      prog.classList.remove("hide");

      var myform = new FormData();
      for (key in obj){
        myform.append(key,obj[key]);
      }
      // ---| ./FOR()

      var ajax = new XMLHttpRequest();

      ajax.addEventListener('readystatechange',function(){
        if (ajax.readyState == 4){
          // ...| TRUE Block
          if (ajax.status == 200){
            // ...| TRUE Block | Success!
            // alert("Upload Complete!");
            // window.location.reload();
            handle_result(ajax.responseText);
          } else {
            //  ...| FALSE Block | Error!
            alert("Error Occurred!");
          }
          // ---| ./IF/ELSE(AJAX.Status)
        }
        // ---| ./IF(AJAX.ReadyState)
      });
      
      ajax.upload.addEventListener('progress',function(e){
        var percent = Math.round((e.loaded / e.total) * 100);
        prog.children[0].style.width = percent + "%";
        prog.children[0].innerHTML = "Saving.. " + percent + "%";
      });
      
      ajax.open('POST','',true);
      ajax.send(myform);
    }
    // ---| ./Send_Data()

    function handle_result(result){
      /* --- Converting to JSON --- */
      var obj = JSON.parse(result);
      
      /* --- IF Valid Object --- */
      if (typeof obj == 'object') {
        // ...| TRUE Block | Valid Object
        if (typeof obj.errors == 'object') {
          // ...| TRUE Block | Errors Exists
          display_errors(obj.errors);
          alert("Please, double check inputs before Update!");
          // window.location.reload();
        } else {
          // ...| FALSE Block | No Errors & Save Complete
          alert("Successful Update!");
          window.location.reload();
        }
        // ---| ./IF/ELSE(Errors Exists)
      }
      // ---| ./IF(Object Exists)
    }
    // ---| ./Handle_Result()

    function display_errors(errors) {
      for (key in errors) {
        document.querySelector(".js-error-"+key).innerHTML = errors[key];
      }
      // ---| ./FOR(KEY)
    }
    // ---| Display_Errors
    /* ---| ./Upload Functions\. |--- */
  </script>
  <!-- -| ./SCRIPTS\. |- -->

</main>
<!-- -------| ./Main\. |------- -->

<?php $this->view('partials/private.footer',$data) ?>
