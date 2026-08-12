<form method="POST" enctype="multipart/form-data">
  <div class="col-md-10 mx-auto">
    <?php csrf() ?>

    <h2 class="my-4 h5 fw-bold">Course Duration</h2>

    <!-- ---- Introduction ---- -->
    <div class="">
      <div class="alert alert-warning alert-dismissible fade show row" role="alert">
        <div class="col-md-1 fs-bolder"><i class="bi bi-exclamation-octagon fs-2"></i></div>
        <div class="col-md-11">
          <small>Here's where you add <b>course duration</b> - Like course start date&comma;&nbsp;course end date&comma;&nbsp;and the whole duration.</small>
          <small>Click the <b><i class="bi bi-plus-square fs-6"></i></b>&nbsp;icon to get started.</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    <!-- -| ./Introduction\. |- -->

    <!-- ---- Course Objectives ---- -->
    <div class="row bg-light input-group px-4 py-3 my-4">
      <small class="mb-3">Choose when would you like to start your course.&nbsp;The admins will approve your course or contact you for more details.</small>

      <!-- ---------| Course Duration |--------- -->
      <div class="row mb-3">
        <label class="col-sm-12 col-form-label fw-bold">Course Duration:</label>
        <div class="col-sm-6 my-1">
          <label for="col-form-label">Starting Date&colon;</label>
          <input type="date" class="form-control" id="start_date" name="start_date" value="" placeholder="Starting Date">
        </div>
        <div class="col-sm-6 my-1">
          <label for="col-form-label">Ending Date&colon;</label>
          <input type="date" class="form-control" id="end_date" name="end_date" value="" placeholder="Ending Date">
        </div>
        <div class="col-sm-6 my-1">
          <label class="col-form-label">Course Duration&colon; <small>(in Weeks)</small></label>
          <input type="text" class="form-control" id="course_duration" name="course_duration" value="" placeholder="Course Duration">
        </div>
        <div class="col-sm-6 my-1">
          <label class="col-form-label">Total Number of Students&colon;</label>
          <input type="text" class="form-control" placeholder="Total Number of Students">
        </div>
      </div>
      <!-- -------| ./Course Duration\. |------- -->

    </div>
    <!-- -| ./Course Objectives\. |- -->

  </div>
</form>
