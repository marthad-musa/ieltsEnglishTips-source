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

  .course-details-video-panel audio {
    width: 100%;
  }

  .course-lesson-article {
    max-height: 65vh;
    overflow-y: auto;
  }

  .course-lesson-pdf {
    border: 0;
    height: 70vh;
    width: 100%;
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
                                'audio' => 'Audio lesson',
                                'pdf' => 'PDF lesson',
                                'article' => 'Article',
                                'reading' => 'Reading',
                                'quiz' => 'Quiz',
                                'assignment' => 'Assignment',
                              ];
                              $item_type_label = $item_type_labels[$item_type] ?? 'Course item';
                              $has_lesson_file = !empty($lecture->file)
                                && is_file($lecture->file)
                                && is_readable($lecture->file);
                              $lesson_file = $has_lesson_file
                                ? ROOT . '/admin/lesson_media/' . (int)$lecture->id
                                : '';
                              $article_html = $item_type === 'article' && !empty($lecture->content_html)
                                ? \Model\Cms_page_block::sanitizeRichText($lecture->content_html)
                                : '';
                              $article_text = $article_html === null && $item_type === 'article'
                                ? strip_tags((string)($lecture->content_html ?? ''))
                                : '';
                            ?>
                            <div class="list-group-item">
                              <button
                                type="button"
                                class="course-lesson-button course-lesson-select"
                                data-title="<?=esc($lecture->title)?>"
                                data-type="<?=esc($item_type_label)?>"
                                data-description="<?=esc($lecture->description ?? '')?>"
                                data-format="<?=esc($item_type)?>"
                                data-file="<?=esc($lesson_file)?>"
                                data-article="<?=htmlspecialchars((string)($article_html ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?>"
                                data-article-text="<?=esc($article_text)?>"
                              >
                                <i class="bi <?=in_array($item_type, ['video', 'audio'], true) ? 'bi-play-circle' : 'bi-file-text'?>" aria-hidden="true"></i>
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
            <h5 id="selected-lesson-title" class="card-title">Course Details</h5>
            <?php $promo_video = !empty($course->course_promo_video) ? get_video($course->course_promo_video) : ''; ?>
            <video id="course-video" controls preload="metadata" <?=empty($promo_video) ? 'hidden' : ''?>>
              <source id="course-video-source" src="<?=esc($promo_video)?>" type="video/mp4">
              Your browser does not support video playback.
            </video>
            <audio id="course-audio" controls preload="metadata" hidden>
              <source id="course-audio-source">
              Your browser does not support audio playback.
            </audio>
            <iframe id="course-pdf" class="course-lesson-pdf" title="Selected lesson PDF" hidden></iframe>
            <a id="course-file-link" class="btn btn-outline-primary" href="#" target="_blank" rel="noopener" hidden>Open lesson material</a>
            <div id="course-article" class="course-lesson-article" hidden></div>
            <p id="selected-lesson-type" class="small text-muted mt-2 mb-0"><?= $promo_video ? 'Course promo video' : 'Select a lesson to begin' ?></p>
            <p id="selected-lesson-description" class="small text-muted mt-2 mb-0"></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
  (function() {
    const video = document.getElementById('course-video');
    const audio = document.getElementById('course-audio');
    const pdf = document.getElementById('course-pdf');
    const fileLink = document.getElementById('course-file-link');
    const article = document.getElementById('course-article');
    const title = document.getElementById('selected-lesson-title');
    const type = document.getElementById('selected-lesson-type');
    const description = document.getElementById('selected-lesson-description');
    const videoSource = document.getElementById('course-video-source');
    const audioSource = document.getElementById('course-audio-source');

    document.querySelectorAll('.course-lesson-select').forEach(function(button) {
      button.addEventListener('click', function() {
        const format = button.dataset.format;
        const fileUrl = button.dataset.file || '';
        const extension = fileUrl.split('.').pop().toLowerCase();

        video.pause();
        audio.pause();
        video.hidden = true;
        audio.hidden = true;
        pdf.hidden = true;
        pdf.removeAttribute('src');
        fileLink.hidden = true;
        fileLink.removeAttribute('href');
        article.hidden = true;
        article.replaceChildren();
        title.textContent = button.dataset.title || 'Selected lesson';
        type.textContent = button.dataset.type || '';
        description.textContent = button.dataset.description || '';

        if (format === 'video' && fileUrl) {
          videoSource.src = fileUrl;
          videoSource.type = {
            mp4: 'video/mp4',
            webm: 'video/webm',
            ogv: 'video/ogg'
          }[extension] || '';
          video.hidden = false;
          video.load();
        } else if (format === 'audio' && fileUrl) {
          audioSource.src = fileUrl;
          audioSource.type = {
            mp3: 'audio/mpeg',
            m4a: 'audio/mp4',
            wav: 'audio/wav',
            ogg: 'audio/ogg',
            oga: 'audio/ogg'
          }[extension] || '';
          audio.hidden = false;
          audio.load();
        } else if (format === 'article') {
          if (button.dataset.article) {
            article.innerHTML = button.dataset.article;
          } else {
            article.textContent = button.dataset.articleText || '';
          }
          article.hidden = false;
        } else if (format === 'pdf' && fileUrl) {
          pdf.src = fileUrl;
          pdf.hidden = false;
          fileLink.href = fileUrl;
          fileLink.hidden = false;
        } else if (fileUrl) {
          fileLink.href = fileUrl;
          fileLink.hidden = false;
        }
      });
    });
  })();
</script>

<?php $this->view('partials/private.footer',$data) ?>
