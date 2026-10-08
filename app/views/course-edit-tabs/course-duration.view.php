<form method="POST" enctype="multipart/form-data">
  <div class="col-md-10 mx-auto">
    <?php csrf() ?>

    <h2 class="my-4 h5 fw-bold">Course Duration</h2>

    <!-- ---- Introduction ---- -->
    <!-- <div class="">
      <div class="alert alert-warning alert-dismissible fade show row" role="alert">
        <div class="col-md-1 fs-bolder"><i class="bi bi-exclamation-octagon fs-2"></i></div>
        <div class="col-md-11">
          <small>Here's where you add <b>course duration</b> - Like course start date&comma;&nbsp;course end date&comma;&nbsp;and the whole duration.</small>
          <small>Click the <b><i class="bi bi-plus-square fs-6"></i></b>&nbsp;icon to get started.</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div> -->
    <!-- -| ./Introduction\. |- -->

    <!-- ---- Course Objectives ---- -->
    <div class="row bg-light input-group px-4 py-3 my-4">
      <small class="mb-3">Choose when would you like to start your course.&nbsp;The admins will approve your course or contact you for more details.</small>

      <!-- ---------| Course Duration |--------- -->
      <div class="row mb-3">
        <label class="col-sm-12 col-form-label fw-bold">Course Schedule and Length:</label>
        <div class="col-sm-6 my-1">
          <label for="start_date">Starting Date&colon;</label>
          <input type="date" class="form-control" id="start_date" name="start_date" value="<?=esc(!empty($row->start_date) ? substr($row->start_date, 0, 10) : '')?>">
          <small class="error error-start_date w-100 text-danger"></small>
        </div>
        <div class="col-sm-6 my-1">
          <label for="end_date">Ending Date&colon;</label>
          <input type="date" class="form-control" id="end_date" name="end_date" value="<?=esc(!empty($row->end_date) ? substr($row->end_date, 0, 10) : '')?>">
          <small class="error error-end_date w-100 text-danger"></small>
        </div>
        <div class="col-sm-12 my-1">
          <label for="course_duration" class="col-form-label">Course length <small>(weeks)</small></label>
          <input type="number" class="form-control" id="course_duration" value="<?=esc($row->course_duration ?? '')?>" placeholder="Calculated from the course dates" readonly>
          <small class="form-text text-muted">Calculated from both dates inclusively; partial weeks round up.</small>
        </div>
        <div class="col-sm-12 my-1">
          <label for="course_timeline" class="col-form-label">Video/content time <small>(hours)</small></label>
          <input type="number" class="form-control" id="course_timeline" value="<?=esc($row->course_timeline ?? '')?>" placeholder="Calculated from active curriculum videos" readonly>
          <small class="form-text text-muted">Rounded to two decimal places. Recalculated when the curriculum is saved; hours remain blank if any active video duration cannot be measured.</small>
        </div>
      </div>
      <!-- -------| ./Course Duration\. |------- -->

    </div>
    <!-- -| ./Course Objectives\. |- -->

  </div>
</form>

<script></script>