<form method="POST" enctype="multipart/form-data">
  <div class="col-md-10 mx-auto">
    <?php csrf() ?>

    <h2 class="my-4 h5 fw-bold">Curriculum</h2>

    <!-- ---- Introduction ---- -->
    <div class="">
      <div class="alert alert-warning alert-dismissible fade show row" role="alert">
        <div class="col-md-1 fs-bolder"><i class="bi bi-exclamation-octagon fs-2"></i></div>
        <div class="col-md-11">
          <small>Here's where you add <b>course contant</b> - Like lectures&comma;&nbsp;course sections&comma;&nbsp;assignments&comma;&nbsp;and more.</small>
          <small>Click <b><i class="bi bi-plus-square fs-6"></i></b>&nbsp;icon to get started.</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    <!-- -| ./Introduction\. |- -->

    <!-- ---- Course Objectives ---- -->
    <div class="row bg-light input-group px-4 py-3 my-4">
      <small class="mb-2">Start putting together your course by creating sections&comma;&nbsp;lectures and practice (quizzes, exercises and assignments).</small>
      <small class="mb-2">If you're intending to offer course for free&comma;&nbsp;the total length of video content must be less than 2 hours.</small>
      <!-- ---------| JS Curriculum |--------- -->
      <div class="col-sm-12 js-curriculum">

      </div>
      <!-- -------| ./JS Curriculum\. |------- -->
      <!-- ---- Errors ---- -->
      <small class="error error-welcome_message w-100 text-danger"></small>
      <!-- -| ./Errors\. |- -->
      <button type="button" onclick="curriculum.add_new('js-curriculum',{placeHolder:'Enter a title',name:'curriculum'})" class="btn btn-sm btn-primary col-sm-3 col-md-2 rounded js-curriculum-add"><i class="bi bi-plus-square"></i> Add section</button>
    </div>
    <!-- -| ./Course Objectives\. |- -->

  </div>
</form>
