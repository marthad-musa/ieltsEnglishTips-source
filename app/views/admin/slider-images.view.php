<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<style>
  .hide {
    display: none;
  }
</style>

<main id="main" class="main">
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
      <!-- <div class="<?=!message() ? 'd-none' : ''?> text-center my-4">
        <?php if(message()):?>
          <span class="alert alert-warning">
            <i class="bi bi-envelope-dash"></i>
              <span class=""><?=message('',true)?></span>
          </span>
        <?php endif;?>
      </div> -->
      <!-- -| ./CHECK Page MESSAGES\. |- -->
    </div>
  </div>
  <!-- End Page Title -->

  <?php // if (user_can('edit_roles')) :?>
  <?php if($uid->role_id == 3):?>
    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" id="profile-overw-tab">Slider 1</button>
                </li>

                <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" id="profile-edit-tab">Slider 2</button>
                </li>

                <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings" id="profile-settings-tab">Slider 3</button>
                </li>

                <!-- <li class="nav-item">
                  <button onclick="set_tab(this.getAttribute('data-bs-target'))" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" id="profile-change-password-tab">Slider 4</button>
                </li> -->

              </ul>

                <div class="tab-content pt-2">

                  <!-- ---- Slider 1 Settings ---- -->
                  <div class="tab-pane fade pt-3 show active profile-overview" id="profile-overview">
                    <form method="post" enctype="multipart/form-data">
                      <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Slider Image</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <div class="row">
                            <img class="js-image-preview col-sm-12" src="<?=get_image($rows[1]->image ?? '')?>" alt="Slider-1">
                            <div class="js-filename m-2">Selected file: None</div>
                          </div>
                          <div class="pt-2">
                            <label class="btn btn-primary btn-sm" title="Upload new profile image">
                              <i class="bi bi-upload text-white"></i>
                              <input class="js-profile-image-input d-none" onchange="load_image(event,this.files[0])" type="file" name="image" title="Upload my profile image">
                            </label>
                            <!-- ---- Image Error ---- -->
                            <?php if(!empty($errors['image'])):?>
                              <small class="js-error-image text-danger fontClarity"><?=$errors['image']?>.</small>
                            <?php endif;?>
                            <small class="js-error-image text-danger fontClarity"></small>
                            <!-- -| ./Image Error\. |- -->
                            <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Slider heading</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <input name="title" type="text" class="form-control <?=!empty($errors['title']) ? 'border-danger' : '';?>" id="title" value="<?=set_value('title',$rows[1]->title ?? '')?>" placeholder="Edit slider title" required>
                        </div>
                        <!-- ---- Title Error ---- -->
                        <?php if(!empty($errors['title'])):?>
                          <small class="js-error-title text-danger fontClarity"><?=$errors['title']?>.</small>
                        <?php endif;?>
                        <small class="js-error-title text-danger fontClarity"></small>
                        <!-- -| ./Title Error\. |- -->
                      </div>

                      <!-- ---- Description ---- -->
                      <div class="row mb-3">
                        <label for="description" class="col-md-4 col-lg-3 col-form-label">Slider description</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <textarea name="description" class="form-control" id="description" style="height: 100px" placeholder="Edit slider description"><?=set_value('description',$rows[1]->description ?? '')?></textarea>
                        </div>
                      </div>
                      <!-- -| ./Description\. |- -->

                      <!-- ---- Description Error ---- -->
                      <?php if(!empty($errors['description'])):?>
                        <small class="js-error-description text-danger fontClarity"><?=$errors['description']?>.</small>
                      <?php endif;?>
                      <small class="js-error-description text-danger fontClarity"></small>
                      <!-- -| ./Description Error\. |- -->

                      <!-- ---- FORM PROGRESS BAR ---- -->
                      <div class="js-prog progress my-4 hide">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Saving.. 0%</div>
                      </div>
                      <!-- -| ./FORM PROGRESS BAR\. |- -->

                      <!-- ---------- Form-Buttons ---------- -->
                      <div class="text-center">
                        <a href="<?=ROOT?>/admin">
                          <button type="button" class="btn btn-secondary col-sm-12 col-md-4 float-start fontClarity">Go back!</button>
                        </a>
                        <button type="button" onclick="save_image(event,1)" type="submit" class="btn btn-primary col-sm-12 col-md-4 float-end fontClarity">Save Changes</button>
                      </div>
                      <!-- -------| ./Form-Buttons\. |------- -->
                    </form>
                  </div>
                  <!-- -| ./Slider 1 Settings\. |- -->

                  <!-- ---- Slider 2 Settings ---- -->
                  <div class="tab-pane fade pt-3 show profile-edit" id="profile-edit">
                    <form method="post" enctype="multipart/form-data">
                      <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Slider Image</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <div class="row">
                            <img class="js-image-preview col-md-12" src="<?=get_image($rows[2]->image ?? '')?>" alt="Slider-2">
                            <div class="js-filename m-2">Selected file: None</div>
                          </div>
                          <div class="pt-2">
                            <label class="btn btn-primary btn-sm" title="Upload new profile image">
                              <i class="bi bi-upload text-white"></i>
                              <input class="js-profile-image-input d-none" onchange="load_image(event,this.files[0])" type="file" name="image" title="Upload my profile image">
                            </label>
                            <!-- ---- Image Error ---- -->
                            <?php if(!empty($errors['image'])):?>
                              <small class="js-error-image text-danger fontClarity"><?=$errors['image']?>.</small>
                            <?php endif;?>
                            <small class="js-error-image text-danger fontClarity"></small>
                            <!-- -| ./Image Error\. |- -->
                            <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Slider heading</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <input name="title" type="text" class="form-control <?=!empty($errors['title']) ? 'border-danger' : '';?>" id="title" value="<?=set_value('title',$rows[2]->title ?? '')?>" placeholder="Edit slider title" required>
                        </div>
                        <!-- ---- Title Error ---- -->
                        <?php if(!empty($errors['title'])):?>
                          <small class="js-error-title text-danger fontClarity"><?=$errors['title']?>.</small>
                        <?php endif;?>
                        <small class="js-error-title text-danger fontClarity"></small>
                        <!-- -| ./Title Error\. |- -->
                      </div>

                      <!-- ---- Description ---- -->
                      <div class="row mb-3">
                        <label for="description" class="col-md-4 col-lg-3 col-form-label">Slider description</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <textarea name="description" class="form-control" id="description" style="height: 100px" placeholder="Edit slider description"><?=set_value('description',$rows[2]->description ?? '')?></textarea>
                        </div>
                      </div>
                      <!-- -| ./Description\. |- -->

                      <!-- ---- Description Error ---- -->
                      <?php if(!empty($errors['description'])):?>
                        <small class="js-error-description text-danger fontClarity"><?=$errors['description']?>.</small>
                      <?php endif;?>
                      <small class="js-error-description text-danger fontClarity"></small>
                      <!-- -| ./Description Error\. |- -->

                      <!-- ---- FORM PROGRESS BAR ---- -->
                      <div class="js-prog progress my-4 hide">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Saving.. 0%</div>
                      </div>
                      <!-- -| ./FORM PROGRESS BAR\. |- -->

                      <!-- ---------- Form-Buttons ---------- -->
                      <div class="text-center">
                        <a href="<?=ROOT?>/admin">
                          <button type="button" class="btn btn-secondary col-sm-12 col-md-4 float-start fontClarity">Go back!</button>
                        </a>
                        <button type="button" onclick="save_image(event,2)" type="submit" class="btn btn-primary col-sm-12 col-md-4 float-end fontClarity">Save Changes</button>
                      </div>
                      <!-- -------| ./Form-Buttons\. |------- -->
                    </form>
                  </div>
                  <!-- -| ./Slider 2 Settings\. |- -->

                  <!-- ---- Slider 3 Settings ---- -->
                  <div class="tab-pane fade pt-3 profile-settings" id="profile-settings">
                    <form method="post" enctype="multipart/form-data">
                      <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Slider Image</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <div class="row">
                            <img class="js-image-preview col-sm-12" src="<?=get_image($rows[3]->image ?? '')?>" alt="Slider-3">
                            <div class="js-filename m-2">Selected file: None</div>
                          </div>
                          <div class="pt-2">
                            <label class="btn btn-primary btn-sm" title="Upload new profile image">
                              <i class="bi bi-upload text-white"></i>
                              <input class="js-profile-image-input d-none" onchange="load_image(event,this.files[0])" type="file" name="image" title="Upload my profile image">
                            </label>
                            <!-- ---- Image Error ---- -->
                            <?php if(!empty($errors['image'])):?>
                              <small class="js-error-image text-danger fontClarity"><?=$errors['image']?>.</small>
                            <?php endif;?>
                            <small class="js-error-image text-danger fontClarity"></small>
                            <!-- -| ./Image Error\. |- -->
                            <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Slider heading</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <input name="title" type="text" class="form-control <?=!empty($errors['title']) ? 'border-danger' : '';?>" id="title" value="<?=set_value('title',$rows[3]->title ?? '')?>" placeholder="Edit slider title" required>
                        </div>
                        <!-- ---- Title Error ---- -->
                        <?php if(!empty($errors['title'])):?>
                          <small class="js-error-title text-danger fontClarity"><?=$errors['title']?>.</small>
                        <?php endif;?>
                        <small class="js-error-title text-danger fontClarity"></small>
                        <!-- -| ./Title Error\. |- -->
                      </div>

                      <!-- ---- Description ---- -->
                      <div class="row mb-3">
                        <label for="description" class="col-md-4 col-lg-3 col-form-label">Slider description</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <textarea name="description" class="form-control" id="description" style="height: 100px" placeholder="Edit slider description"><?=set_value('description',$rows[3]->description ?? '')?></textarea>
                        </div>
                      </div>
                      <!-- -| ./Description\. |- -->

                      <!-- ---- Description Error ---- -->
                      <?php if(!empty($errors['description'])):?>
                        <small class="js-error-description text-danger fontClarity"><?=$errors['description']?>.</small>
                      <?php endif;?>
                      <small class="js-error-description text-danger fontClarity"></small>
                      <!-- -| ./Description Error\. |- -->

                      <!-- ---- FORM PROGRESS BAR ---- -->
                      <div class="js-prog progress my-4 hide">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Saving.. 0%</div>
                      </div>
                      <!-- -| ./FORM PROGRESS BAR\. |- -->

                      <!-- ---------- Form-Buttons ---------- -->
                      <div class="text-center">
                        <a href="<?=ROOT?>/admin">
                          <button type="button" class="btn btn-secondary col-sm-12 col-md-4 float-start fontClarity">Go back!</button>
                        </a>
                        <button type="button" onclick="save_image(event,3)" type="submit" class="btn btn-primary col-sm-12 col-md-4 float-end fontClarity">Save Changes</button>
                      </div>
                      <!-- -------| ./Form-Buttons\. |------- -->
                    </form>
                  </div>
                  <!-- -| ./Slider 3 Settings\. |- -->

                  <!-- ---- Slider 4 Settings ---- -->
                  <div class="tab-pane fade pt-3 profile-change-password" id="profile-change-password">
                    <form method="post" enctype="multipart/form-data">
                      <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Slider Image</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <div class="row">
                            <img class="js-image-preview col-sm-12" src="<?=get_image($rows[4]->image ?? '')?>" alt="Slider-4">
                            <div class="js-filename m-2">Selected file: None</div>
                          </div>
                          <div class="pt-2">
                            <label class="btn btn-primary btn-sm" title="Upload new profile image">
                              <i class="bi bi-upload text-white"></i>
                              <input class="js-profile-image-input d-none" onchange="load_image(event,this.files[0])" type="file" name="image" title="Upload my profile image">
                            </label>
                            <!-- ---- Image Error ---- -->
                            <?php if(!empty($errors['image'])):?>
                              <small class="js-error-image text-danger fontClarity"><?=$errors['image']?>.</small>
                            <?php endif;?>
                            <small class="js-error-image text-danger fontClarity"></small>
                            <!-- -| ./Image Error\. |- -->
                            <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Slider heading</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <input name="title" type="text" class="form-control <?=!empty($errors['title']) ? 'border-danger' : '';?>" id="title" value="<?=set_value('title',$rows[4]->title ?? '')?>" placeholder="Edit slider title" required>
                        </div>
                        <!-- ---- Title Error ---- -->
                        <?php if(!empty($errors['title'])):?>
                          <small class="js-error-title text-danger fontClarity"><?=$errors['title']?>.</small>
                        <?php endif;?>
                        <small class="js-error-title text-danger fontClarity"></small>
                        <!-- -| ./Title Error\. |- -->
                      </div>

                      <!-- ---- Description ---- -->
                      <div class="row mb-3">
                        <label for="description" class="col-md-4 col-lg-3 col-form-label">Slider description</label>
                        <div class="col-xs-4 col-md-8 col-lg-9">
                          <textarea name="description" class="form-control" id="description" style="height: 100px" placeholder="Edit slider description"><?=set_value('description',$rows[4]->description ?? '')?></textarea>
                        </div>
                      </div>
                      <!-- -| ./Description\. |- -->

                      <!-- ---- Description Error ---- -->
                      <?php if(!empty($errors['description'])):?>
                        <small class="js-error-description text-danger fontClarity"><?=$errors['description']?>.</small>
                      <?php endif;?>
                      <small class="js-error-description text-danger fontClarity"></small>
                      <!-- -| ./Description Error\. |- -->

                      <!-- ---- FORM PROGRESS BAR ---- -->
                      <div class="js-prog progress my-4 hide">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Saving.. 0%</div>
                      </div>
                      <!-- -| ./FORM PROGRESS BAR\. |- -->

                      <!-- ---------- Form-Buttons ---------- -->
                      <div class="text-center">
                        <a href="<?=ROOT?>/admin">
                          <button type="button" class="btn btn-secondary col-sm-6 col-md-4 float-start fontClarity">Go back!</button>
                        </a>
                        <button type="button" onclick="save_image(event,4)" type="submit" class="btn btn-primary col-sm-6 col-md-4 float-end fontClarity">Save Changes</button>
                      </div>
                      <!-- -------| ./Form-Buttons\. |------- -->
                    </form>
                  </div>
                  <!-- -| ./Slider 4 Settings\. |- -->

                </div>
                <!-- End Bordered Tabs -->
            </div>
          </div>

        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- ---- SCRIPTS ---- -->
  <script>
    // Variables  ---------------
    var tab = sessionStorage.getItem("tab") ? sessionStorage.getItem("tab") : "#profile-overview";
    var uploading = false;
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

    function load_image(e,file){
      var form = e.currentTarget.form;
      form.querySelector(".js-filename").innerHTML = "Selected file: " + file.name;

      var mylink = window.URL.createObjectURL(file);
      form.querySelector(".js-image-preview").src = mylink;
    }
    // ---| ./LOAD-IMAGE()

    window.onload = function(){
      show_tab(tab);
    }

    /* -----| Upload Functions | ----- */
    function save_image(e,id){
      if (uploading) {
        // ...| TRUE Block
        alert("Please, wait for image to complete uploading!");
        return;
      }
      // ---| ./IF(Uploading)

      uploading = true;
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

      // Add Form ID  ---------------
      obj.id = id;
      // ------------|  ./Add Form ID

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
      } else {
        // ...| FLASE Block
        alert("Image is required!");
        // console.log("Image is required!");
        return;
      }
      // ---| ./IF/ELSE(Image is Added)

      // VALIDATE JavaScript  ---------------
      if (obj.title == "") {
        // ...| TRUE Block
        alert("Title is required!");
        return;
      }
      
      if (obj.description == "") {
        // ...| TRUE Block
        alert("Title is required!");
        return;
      }
      // ------------|  ./VALIDATE JavaScript

      send_data(obj);
    }
    // ---| ./Save_Slider()

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
            uploading = false;
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
      console.log(result);
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
          // alert("Successful!");
          alert(obj.message);
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

<!-- ======= Footer ======= -->
<?php $this->view('partials/private.footer',$data) ?>
