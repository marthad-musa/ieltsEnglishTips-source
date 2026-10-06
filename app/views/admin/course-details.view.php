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

  .course-section-description,
  .course-item-description {
    white-space: pre-line;
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
            <h2 class="h4"><?=esc($course->title)?></h2>
            <?php if (!empty($course->description)): ?>
              <p class="text-muted"><?=nl2br(esc($course->description))?></p>
            <?php endif; ?>
            <h5 class="card-title">Course Sections</h5>

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
                      <?php if (!empty($section->description)): ?>
                        <p class="course-section-description p-3 pb-0 mb-0"><?=esc($section->description)?></p>
                      <?php endif; ?>
                      <?php
                        $lectures = array_filter($section->lectures_row ?? [], function ($lecture) {
                          return (int)($lecture->disabled ?? 0) === 0;
                        });
                      ?>
                      <?php if (!empty($lectures)): ?>
                        <div class="list-group list-group-flush">
                          <?php foreach ($lectures as $lecture): ?>
                            <?php
                              $item_type = $lecture->item_type ?? 'video';
                              $item_type_labels = [
                                'video' => 'Video lesson',
                                'reading' => 'Reading',
                                'quiz' => 'Quiz',
                                'assignment' => 'Assignment',
                              ];
                              $item_type_label = $item_type_labels[$item_type] ?? 'Course item';
                              $lesson_file = !empty($lecture->file) ? get_video($lecture->file) : '';
                            ?>
                            <div class="list-group-item">
                              <button
                                type="button"
                                class="course-lesson-button"
                                data-video="<?=esc($item_type === 'video' ? $lesson_file : '')?>"
                                data-type="<?=esc($item_type_label)?>"
                                data-description="<?=esc($lecture->description ?? '')?>"
                              >
                                <i class="bi <?=$item_type === 'video' ? 'bi-play-circle' : 'bi-file-text'?>" aria-hidden="true"></i>
                                <span>
                                  <strong><?=esc($lecture->title)?></strong>
                                  <small class="d-block text-muted">
                                    <?=esc($item_type_label)?>
                                    <?php if (!empty($lecture->duration_minutes)): ?>
                                      &middot; <?=esc($lecture->duration_minutes)?> min
                                    <?php endif; ?>
                                  </small>
                                </span>
                              </button>
                              <?php if (!empty($lecture->description)): ?>
                                <p class="course-item-description small text-muted mb-1"><?=esc($lecture->description)?></p>
                              <?php endif; ?>
                              <?php if ($item_type !== 'video' && $lesson_file): ?>
                                <a href="<?=esc($lesson_file)?>" target="_blank" rel="noopener">Open attached material</a>
                              <?php endif; ?>
                            </div>
                          <?php endforeach; ?>
                        </div>
                      <?php else: ?>
                        <p class="text-muted p-3 mb-0">No curriculum items in this section yet.</p>
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
              <?php $promo_video = !empty($course->course_promo_video) ? get_video($course->course_promo_video) : ''; ?>
              <?php if ($promo_video): ?>
                <source id="course-video-source" src="<?=esc($promo_video)?>" type="video/mp4">
              <?php endif; ?>
              Your browser does not support video playback.
            </video>
            <p id="selected-lesson" class="small text-muted mt-2 mb-0">Course promo video</p>
            <p id="selected-lesson-description" class="small text-muted mt-2 mb-0"></p>
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
      let source = document.getElementById('course-video-source');
      const lessonTitle = lessonButton.querySelector('span').textContent;
      const description = document.getElementById('selected-lesson-description');

      document.getElementById('selected-lesson').textContent = lessonTitle + ' · ' + lessonButton.dataset.type;
      description.textContent = lessonButton.dataset.description || '';

      if (videoUrl) {
        if (!source) {
          source = document.createElement('source');
          source.id = 'course-video-source';
          source.type = 'video/mp4';
          video.appendChild(source);
        }
        source.src = videoUrl;
        video.hidden = false;
        video.load();
        video.play().catch(function () {});
      } else {
        video.pause();
        video.hidden = true;
      }
    });
  });
</script>

<?php $this->view('partials/private.footer',$data) ?>
