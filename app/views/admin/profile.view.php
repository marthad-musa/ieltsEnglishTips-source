<?php $this->view('admin/admin-header',$data) ?>

  <?php if(!empty($row)): ?>
    <div class="pagetitle row">
      <div class="col-md-6">
        <h1 class=""><?=$data['title']?></h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>//">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=ROOT?>//admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><?=$data['title']?></li>
            <li class="breadcrumb-item active"><?=esc(ucfirst($row->firstname))?> <?=esc(ucfirst($row->lastname))?></li>
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

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?=get_image($row->image)?>" alt="<?=esc($row->firstname)?> <?=esc($row->lastname)?> Profile" class="rounded-circle" style="width:150px;max-width:150px;height:150px;object-fit:cover;">
              <h2 class=""><?=esc($row->firstname)?> <?=esc($row->lastname)?></h2>
              <h3 class="fontClarity"><?=esc(ucfirst($row->role_name))?></h3>
              <div class="social-links mt-2">
                <a href="<?=esc($row->twitter_link)?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="<?=esc($row->facebook_link)?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?=esc($row->instagram_link)?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="<?=esc($row->linkedin_link)?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
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

                <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" id="profile-settings-tab">Settings</button>
                </li>

                <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" id="profile-change-password-tab">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?=esc(ucfirst($row->bio))?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc(ucfirst($row->firstname))?> <?=esc(ucfirst($row->lastname))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">User Name</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc(ucfirst($row->username))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc(ucfirst($row->company))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc(ucfirst($row->job))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc(ucfirst($row->country))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc(ucfirst($row->address))?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc($row->phone)?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc($row->email)?></div>
                  </div>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Password</div>
                    <div class="col-lg-9 col-md-8 fontClarity"><?=esc($row->password)?></div>
                  </div> -->

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="d-flex">
                          <img class="js-image-preview" src="<?=ROOT?>//<?=esc($row->image)?>" alt="<?=esc($row->firstname)?> <?=esc($row->lastname)?> Profile" style="width:150px;max-width:150px;height:150px;object-fit: cover;">
                          <div class="js-filename m-2">Selected file: None</div>
                        </div>
                        <div class="pt-2">
                          <label class="btn btn-primary btn-sm" title="Upload new profile image">
                            <i class="bi bi-upload text-white"></i>
                            <input class="js-profile-image-input d-none" onchange="load_image(this.files[0])" type="file" name="image" title="Upload my profile image">
                          </label>
                          <!-- ---- Image Error ---- -->
                          <?php if(!empty($errors['image'])):?>
                            <small class="js-error-image text-danger fontClarity"><?=$errors['image']?>.</small>
                          <?php endif;?>
                          <small class="js-error-image text-danger fontClarity"></small>
                          <!-- -| ./Image Error\. |- -->
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control <?=!empty($errors['firstname']) ? 'border-danger' : '';?>" id="firstname" value="<?=set_value('firstname',$row->firstname)?>" placeholder="Edit first name" required>
                      </div>
                      <!-- ---- Firstname Error ---- -->
                      <?php if(!empty($errors['firstname'])):?>
                        <small class="js-error-firstname text-danger fontClarity"><?=$errors['firstname']?>.</small>
                      <?php endif;?>
                      <small class="js-error-firstname text-danger fontClarity"></small>
                      <!-- -| ./Firstname Error\. |- -->
                    </div>

                    <div class="row mb-3">
                      <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control <?=!empty($errors['lastname']) ? 'border-danger' : '';?>" id="lastname" value="<?=set_value('lastname',$row->lastname)?>" placeholder="Edit last name" required>
                      </div>
                      <!-- ---- Lastname Error ---- -->
                      <?php if(!empty($errors['lastname'])):?>
                        <small class="js-error-lastname text-danger fontClarity"><?=$errors['lastname']?>.</small>
                      <?php endif;?>
                      <small class="js-error-lastname text-danger fontClarity"></small>
                      <!-- -| ./Lastname Error\. |- -->
                    </div>

                    <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">User Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control <?=!empty($errors['username']) ? 'border-danger' : '';?>" id="username" value="<?=set_value('username',$row->username)?>" placeholder="Edit user name" required>
                      </div>
                      <!-- ---- Username Error ---- -->
                      <?php if(!empty($errors['username'])):?>
                        <small class="js-error-username text-danger fontClarity"><?=$errors['username']?>.</small>
                      <?php endif;?>
                      <small class="js-error-username text-danger fontClarity"></small>
                      <!-- -| ./Username Error\. |- -->
                    </div>

                    <div class="row mb-3">
                      <label for="bio" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="bio" class="form-control" id="bio" style="height: 100px" placeholder="Edit biography"><?=set_value('bio',$row->bio)?></textarea>
                      </div>
                    </div>
                    <!-- ---- Biography Error ---- -->
                    <?php if(!empty($errors['bio'])):?>
                      <small class="js-error-bio text-danger fontClarity"><?=$errors['bio']?>.</small>
                    <?php endif;?>
                    <small class="js-error-bio text-danger fontClarity"></small>
                    <!-- -| ./Biography Error\. |- -->

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="<?=set_value('company',$row->company)?>" placeholder="Edit company">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="<?=set_value('job',$row->job)?>" placeholder="Edit job title">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="Country" value="<?=set_value('country',$row->country)?>" placeholder="Edit country">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?=set_value('address',$row->address)?>" placeholder="Edit address">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control <?=!empty($errors['phone']) ? 'border-danger' : '';?>" id="Phone" value="<?=set_value('phone',$row->phone)?>" placeholder="Edit phone number">
                      </div>
                      <!-- ---- Phone Error ---- -->
                      <?php if(!empty($errors['phone'])):?>
                        <small class="js-error-phone text-danger fontClarity"><?=$errors['phone']?>.</small>
                      <?php endif;?>
                      <small class="js-error-phone text-danger fontClarity"></small>
                      <!-- -| ./Phone Error\. |- -->
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control <?=!empty($errors['email']) ? 'border-danger' : '';?>" id="Email" value="<?=set_value('email',$row->email)?>" placeholder="Edit E-mail" required>
                      </div>
                      <!-- ---- E-mail Error ---- -->
                      <?php if(!empty($errors['email'])):?>
                        <small class="js-error-email text-danger fontClarity"><?=$errors['email']?>.</small>
                      <?php endif;?>
                      <small class="js-error-email text-danger fontClarity"></small>
                      <!-- -| ./E-mail Error\. |- -->
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9 fontClarity">
                        <input name="twitter_link" type="text" class="form-control <?=!empty($errors['twitter_link']) ? 'border-danger' : '';?>" id="Twitter" value="<?=set_value('twitter_link',$row->twitter_link)?>" placeholder="Edit Twitter profile link">
                      </div>
                      <!-- ---- Twitter Error ---- -->
                      <?php if(!empty($errors['twitter_link'])):?>
                        <small class="js-error-twitter_link text-danger fontClarity"><?=$errors['twitter_link']?>.</small>
                      <?php endif;?>
                      <small class="js-error-twitter_link text-danger fontClarity"></small>
                      <!-- -| ./Twitter Error\. |- -->
                    </div>
                    
                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9 fontClarity">
                        <input name="facebook_link" type="text" class="form-control <?=!empty($errors['facebook_link']) ? 'border-danger' : '';?>" id="Facebook" value="<?=set_value('facebook_link',$row->facebook_link)?>" placeholder="Edit Facebook profile link">
                      </div>
                      <!-- ---- Facebook Error ---- -->
                      <?php if(!empty($errors['facebook_link'])):?>
                        <small class="js-error-facebook_link text-danger fontClarity"><?=$errors['facebook_link']?>.</small>
                      <?php endif;?>
                      <small class="js-error-facebook_link text-danger fontClarity"></small>
                      <!-- -| ./Facebook Error\. |- -->
                    </div>
                      
                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9 fontClarity">
                        <input name="instagram_link" type="text" class="form-control <?=!empty($errors['instagram_link']) ? 'border-danger' : '';?>" id="Instagram" value="<?=set_value('instagram_link',$row->instagram_link)?>" placeholder="Edit Instagram profile link">
                      </div>
                      <!-- ---- Instagram Error ---- -->
                      <?php if(!empty($errors['instagram_link'])):?>
                        <small class="js-error-instagram_link text-danger fontClarity"><?=$errors['instagram_link']?>.</small>
                      <?php endif;?>
                      <small class="js-error-instagram_link text-danger fontClarity"></small>
                      <!-- -| ./Instagram Error\. |- -->
                    </div>
                        
                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9 fontClarity">
                        <input name="linkedin_link" type="text" class="form-control <?=!empty($errors['linkedin_link']) ? 'border-danger' : '';?>" id="Linkedin" value="<?=set_value('linkedin_link',$row->linkedin_link)?>" placeholder="Edit Linked-in profile link">
                      </div>
                      <!-- ---- LinkedIn Error ---- -->
                      <?php if(!empty($errors['linkedin_link'])):?>
                        <small class="js-error-linkedin_link text-danger fontClarity"><?=$errors['linkedin_link']?>.</small>
                      <?php endif;?>
                      <small class="js-error-linkedin_link text-danger fontClarity"></small>
                      <!-- -| ./LinkedIn Error\. |- -->
                    </div>

                    <!-- ---- FORM PROGRESS BAR ---- -->
                    <div class="js-prog progress my-4 hide">
                      <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Saving.. 50%</div>
                    </div>
                    <!-- -| ./FORM PROGRESS BAR\. |- -->

                    <div class="text-center">
                      <a href="<?=ROOT?>//admin">
                        <button type="button" class="btn btn-secondary w-25 float-start fontClarity">Go back!</button>
                      </a>
                      <button type="button" onclick="save_profile(event)" type="submit" class="btn btn-success w-25 float-end fontClarity">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->
                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <!-- ---- LANGUAGE ---- -->
                    <!-- <div class="row mb-3 col-9">
                      <select class="form-select text-start mb-1 py-3" name="language" aria-label=".form-select example">
                        <option class="fs-6 fw-bold fontClarity" selected disabled>- Language -</option>
                        <option class="fs-6 fontTunisia" value="en" <?= ($row->language =='en') ? 'selected': ''; ?>>English</option>
                        <option class="fs-6 fontTunisia" value="ar" <?= ($row->language =='ar') ? 'selected': ''; ?>>Arabic</option>
                        <option class="fs-6 fontTunisia" value="fr" <?= ($row->language =='fr') ? 'selected': ''; ?>>Fronce</option>
                      </select>
                    </div> -->
                    <!-- -| ./LANGUAGE\. |- -->

                    <!-- ---- Notifications ---- -->
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>
                    <!-- -| ./Notifications\. |- -->

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
  <?php else:?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <!-- <span class="fontClarity fs-5">Sorry, profile not found!</span> -->
       <span class="fs-3 d-block my-2"><i class="bi bi-emoji-frown"></i> Oh, no! No record found.</span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif;?>

  <!-- ---- SCRIPTS ---- -->
  <script>
    // Variables  ---------------
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "#profile-overview";
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
    }/*39*/

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
      
      // ajax.open('post','',ture);
      ajax.open('post','');
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
          alert("Please, double check inputs before Update!")
        } else {
          // ...| FALSE Block | No Errors & Save Complete
          alert("Successful Update!")
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

<!-- ======= Footer ======= -->
<?php $this->view('admin/admin-footer',$data) ?>
