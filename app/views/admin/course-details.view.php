<?php $this->view('partials/private.header',$data) ?>
<?php $this->view('partials/private.nav',$data) ?>

<style>
  .course-details-video-panel {
    position: sticky;
    top: 1rem;
  }

  .course-details-video-panel video {
    width: 100%;
    max-height: 70vh;
    object-fit: contain;
    background: #000;
  }

  .course-lesson-button {
    border: 0;
    background: transparent;
    color: inherit;
    display: flex;
    gap: .5rem;
    padding: .75rem 1rem;
    text-align: left;
    width: 100%;
  }

  .course-lesson-button:hover,
  .course-lesson-button:focus {
    background: #f1f3f5;
  }
</style>

<main class="main" id="main">
  <div class="pagetitle">
    <h1><?=esc($data['title'])?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=ROOT?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/lessons">Lessons</a></li>
        <li class="breadcrumb-item active"><?=esc($course->slug)?></li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row g-4">
      <div class="col-lg-7">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Course Sections</h5>
            <p class="text-muted">Course: <?=esc($course->title)?></p>

            <?php if (!empty($course_sections)): ?>
              <div class="accordion" id="course-sections">
                <?php foreach ($course_sections as $section_index => $section): ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="section-heading-<?=$section_index?>">
                      <button class="accordion-button <?=($section_index > 0) ? 'collapsed' : ''?>" type="button" data-bs-toggle="collapse" data-bs-target="#section-<?=$section_index?>">
                        <?=esc($section->value ?: 'Untitled section')?>
                      </button>
                    </h2>
                    <div id="section-<?=$section_index?>" class="accordion-collapse collapse <?=($section_index === 0) ? 'show' : ''?>" data-bs-parent="#course-sections">
                      <?php
                        $lectures = array_filter($section->lectures_row ?? [], function ($lecture) {
                          return (int)($lecture->disabled ?? 0) === 0;
                        });
                      ?>
                      <?php if (!empty($lectures)): ?>
                        <div class="list-group list-group-flush">
                          <?php foreach ($lectures as $lecture): ?>
                            <?php $lesson_video = !empty($lecture->file) ? get_image($lecture->file) : ''; ?>
                            <button type="button" class="list-group-item list-group-item-action course-lesson-button" data-video="<?=esc($lesson_video)?>">
                              <i class="bi bi-play-circle"></i>
                              <span><?=esc($lecture->title)?></span>
                            </button>
                          <?php endforeach; ?>
                        </div>
                      <?php else: ?>
                        <p class="text-muted p-3 mb-0">No lessons in this section yet.</p>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <div class="alert alert-warning mb-0">No course sections are available.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card course-details-video-panel">
          <div class="card-body">
            <h5 class="card-title">Course Details</h5>
            <video id="course-video" controls preload="metadata">
              <?php $promo_video = !empty($course->course_promo_video) ? get_image($course->course_promo_video) : ''; ?>
              <?php if ($promo_video): ?>
                <source id="course-video-source" src="<?=esc($promo_video)?>" type="video/mp4">
              <?php endif; ?>
              Your browser does not support video playback.
            </video>
            <p id="selected-lesson" class="small text-muted mt-2 mb-0">Course promo video</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
  document.querySelectorAll('.course-lesson-button').forEach(function (lessonButton) {
    lessonButton.addEventListener('click', function () {
      const videoUrl = lessonButton.dataset.video;
      const video = document.getElementById('course-video');
      const source = document.getElementById('course-video-source');
      const lessonTitle = lessonButton.querySelector('span').textContent;

      if (!videoUrl || !source) {
        return;
      }

      source.src = videoUrl;
      video.load();
      video.play().catch(function () {});
      document.getElementById('selected-lesson').textContent = lessonTitle;
    });
  });
</script>

<?php $this->view('partials/private.footer',$data) ?>
