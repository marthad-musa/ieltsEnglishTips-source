<form method="POST" enctype="multipart/form-data">
  <div class="col-md-10 mx-auto">
    <?php csrf() ?>

    <h2 class="my-4 h5 fw-bold">Intended learners</h2>

    <!-- ---- Course Introduction ---- -->
    <div class="input-group px-4 py-3 mb-4">
      <small>The following descriptions will be <b>publicly</b> visible on your <span class="text-primary">Course Landing Page</span> and will have a direct impact on your course performance.&nbsp;These descriptions will help learners decide if your course is right for them.</small>
    </div>
    <!-- -| ./Course Introduction\. |- -->

    <!-- ---- Course Objectives ---- -->
    <div class="row bg-light input-group px-4 py-3 mb-4">
      <label class="col-form-label mb-2">What will students learn in your course&quest;</label>
      <small class="mb-2">You must enter at least 4 <span class="text-primary">learning objectives or outcomes</span> that learners can expect to achieve after compeleting your course.</small>
      <small class="mb-2">Example&colon;&nbsp;Define the roles and responsibilities of a project manager</small>
      <!-- ---------| JS Students Learn |--------- -->
      <div class="col-sm-12 js-students-learn">
        <!-- -| ./FORM Input\. |- -->
      </div>
      <!-- -------| ./JS Students Learn\. |------- -->
      <!-- ---- Errors ---- -->
      <small class="error error-welcome_message w-100 text-danger"></small>
      <!-- -| ./Errors\. |- -->
      <button type="button" onclick="intended_learners.add_new('js-students-learn',{placeHolder:'Example&colon;&nbsp;Define the roles and responsibilities of a project manager',name:'students-learn'})" class="btn btn-sm btn-primary col-sm-3 col-md-2 rounded js-students-learn-add"><i class="bi bi-plus-circle"></i> Add more</button>
    </div>
    <!-- -| ./Course Objectives\. |- -->

    <!-- ---- Course Requirements ---- -->
    <div class="row input-group px-4 py-3 mb-4">
      <label class="fs-5">What are the requirements or prerequisites for taking your course&quest;</label>
      <small>List the required skills&comma; experience&comma; tools or equipment learners should have prior to taking your course.&nbsp;If there are no requirements&comma; use this space as an opportunity to lower the barrier for begginers.</small>
      <small class="mb-2">Example&colon;&nbsp;No programming experience needed. You will learn everything you need to know</small>
      <!-- ---------| JS Prerequisites |--------- -->
      <div class="col-sm-12 js-prerequisites">
        <!-- -| ./FORM Input\. |- -->
      </div>
      <!-- -------| ./JS Prerequisites\. |------- -->
      <!-- ---- Errors ---- -->
      <small class="error error-welcome_message w-100 text-danger"></small>
      <!-- -| ./Errors\. |- -->
      <button type="button" onclick="intended_learners.add_new('js-prerequisites',{placeHolder:'Example&colon;&nbsp;No programming experience needed. You will learn everything you need to know',name:'prerequisites',})" class="btn btn-sm btn-primary col-sm-3 col-md-2 rounded js-prerequisites-add"><i class="bi bi-plus-circle"></i> Add more</button>
    </div>
    <!-- -| ./Course Requirements\. |- -->

    <!-- ---- Course Target ---- -->
    <div class="row bg-light input-group px-4 py-3 mb-4">
      <label class="fs-5">Who is this course for&quest;</label>
      <small>Write a clear description of the <span class="text-primary">intended learners</span> for your course who will find your course content valuable.&nbsp;This will help you attract the right learners to your course.</small>
      <small class="mb-2">Example&colon;&nbsp;Begginer Python developers curious about data science</small>
      <!-- ---------| JS Students Learn |--------- -->
      <div class="col-sm-12 js-description">
        <!-- -| ./FORM Input\. |- -->
      </div>
      <!-- -------| ./JS Students Learn\. |------- -->
      <!-- ---- Errors ---- -->
      <small class="error error-welcome_message w-100 text-danger"></small>
      <!-- -| ./Errors\. |- -->
      <button type="button" onclick="intended_learners.add_new('js-description',{placeHolder:'Example&colon;&nbsp;Begginer Python developers curious about data science',name:'description',})" class="btn btn-sm btn-primary col-sm-3 col-md-2 rounded js-description-add"><i class="bi bi-plus-circle"></i> Add more</button>
    </div>
    <!-- -| ./Course Target\. |- -->
  </div>
</form>
