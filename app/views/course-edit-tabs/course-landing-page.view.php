<form method="POST" enctype="multipart/form-data">
  <div class="col-md-8 mx-auto">
    <?php csrf() ?>

    <h2 class="my-4 h5 fw-bold">Course Landing Page</h2>

    <!-- ---- Course Title ---- -->
    <div class="input-group mb-2">
      <span class="input-group-text">Course Title:</span>
      <input type="text" name="title" value="<?=esc($row->title)?>" class="form-control <?=!empty($errors['title']) ? 'border-danger' : '';?>" placeholder="Course Title">
      <!-- ---- Title Error ---- -->
      <small class="error error-title w-100 text-danger fontClarity"></small>
      <!-- -| ./Title Error\. |- -->
    </div>
    <!-- -| ./Course Title\. |- -->

    <!-- ---- Course Sub-Title ---- -->
    <div class="input-group mb-2">
      <span class="input-group-text">Course Subtitle:</span>
      <input type="text" name="subtitle" value="<?=esc($row->subtitle)?>" class="form-control <?=!empty($errors['subtitle']) ? 'border-danger' : '';?>" placeholder="Course Subtitle">
      <!-- ---- Sub-Title Error ---- -->
      <small class="error error-subtitle w-100 text-danger fontClarity"></small>
      <!-- -| ./Sub-Title Error\. |- -->
    </div>
    <!-- -| ./Course Sub-Title\. |- -->

    <!-- ---- Course Description ---- -->
    <div class="input-group mb-2">
      <span class="input-group-text">Course Description:</span>
      <textarea name="description" class="form-control <?=!empty($errors['description']) ? 'border-danger' : '';?>" aria-label="Course Description:" placeholder="Describe your course with few words"><?=esc($row->description)?></textarea>
      <!-- ---- Description Error ---- -->
      <small class="error error-description w-100 text-danger fontClarity"></small>
      <!-- -| ./Description Error\. |- -->
    </div>
    <!-- -| ./Course Description\. |- -->

    <!-- ---- Basic Info ---- -->
    <div class="alert alert-secondary row mb-3">
      <label class="col-sm-12 col-form-label fw-bold">Basic information:</label>
      <div class="col-sm-6 my-1">
        <label class="col-form-label">Course Language:</label>
        <select name="language_id" class="form-select">
          <option disabled>Please, choose a language</option>
          <?php if(!empty($languages)): ?>
            <?php foreach($languages as $lang): ?>
              <option <?=set_select('language_id',$lang->id,($row->language_id ?? 1))?> value="<?=$lang->id?>"><?=esc($lang->language)?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <!-- ---- Language_ID Error ---- -->
        <small class="error error-language_id w-100 text-danger fontClarity"></small>
        <!-- -| ./Language_ID Error\. |- -->
      </div>
      <div class="col-sm-6 my-1">
        <label class="col-form-label">Course Category:</label>
        <select name="category_id" id="course-category-select" class="form-select" onchange="course_category_changed(this)">
          <option value="">Please, choose a category</option>
          <?php if(!empty($categories)): ?>
            <?php foreach($categories as $cat): ?>
              <option <?=set_select('category_id',$cat->id,($row->category_id ?? 1))?> value="<?=$cat->id?>" data-category="<?=esc($cat->category)?>"><?=esc($cat->category)?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <!-- ---- Category_ID Error ---- -->
        <small class="error error-category_id w-100 text-danger fontClarity"></small>
        <!-- -| ./Category_ID Error\. |- -->
      </div>
      <div class="col-sm-6 my-1">
        <label class="col-form-label">Course Subcategory:</label>
        <select name="sub_category_id" id="course-subcategory-select" class="form-select">
          <option value="">Choose a category first</option>
          <?php
            $seen_subcategories = [];
            if (!empty($levels)):
              foreach ($levels as $lvl):
                if (in_array($lvl->level, $seen_subcategories, true)) {
                  continue;
                }
                $seen_subcategories[] = $lvl->level;
          ?>
                <option <?=set_select('sub_category_id',$lvl->id,($row->sub_category_id ?? ''))?> value="<?=$lvl->id?>" data-subcategory="<?=esc($lvl->level)?>"><?=esc($lvl->level)?></option>
          <?php
              endforeach;
            endif;
          ?>
        </select>
        <small class="error error-sub_category_id w-100 text-danger fontClarity"></small>
      </div>
    </div>
    <!-- -| ./Basic Info\. |- -->

    <!-- ---- Pricing ---- -->
    <div class="row mb-4">
      <label class="col-sm-12 col-form-label fw-bold">Price:</label>
      <div class="col-sm-3 my-1">
        <select name="currency_id" class="form-select">
          <option value="">Currency</option>
          <?php if(!empty($currencies)): ?>
            <?php foreach($currencies as $crn): ?>
              <option <?=set_select('currency_id',$crn->id,($row->currency_id ?? 1))?> value="<?=$crn->id?>"><?=esc($crn->symbol . " ($crn->currency)")?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <!-- ---- Currency_ID Error ---- -->
        <small class="error error-currency_id w-100 text-danger fontClarity"></small>
        <!-- -| ./Currency_ID Error\. |- -->
      </div>
      <div class="col-sm-8 my-1">
        <select name="price_id" class="form-select">
          <option value="">Select Price</option>
          <?php if(!empty($prices)): ?>
            <?php foreach($prices as $price): ?>
              <option <?=set_select('price_id',$price->id,($row->price_id ?? 1))?> value="<?=$price->id?>"><?=esc($price->name . " ($price->price)")?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <!-- ---- Price_ID Error ---- -->
        <small class="error error-price_id w-100 text-danger fontClarity"></small>
        <!-- -| ./Price_ID Error\. |- -->
      </div>
    </div>
    <!-- -| ./Pricing\. |- -->

    <!-- ---- Primary Subject ---- -->
    <div class="input-group mb-2">
      <span class="input-group-text">Primary Subject:</span>
      <input type="text" name="primary_subject" value="<?=esc($row->primary_subject)?>" class="form-control <?=!empty($errors['primary_subject']) ? 'border-danger' : '';?>" placeholder="Course Title">
      <!-- ---- Primary Subject Error ---- -->
      <small class="error error-primary_subject w-100 text-danger fontClarity"></small>
      <!-- -| ./Primary Subject Error\. |- -->
    </div>
    <!-- -| ./Primary Subject\. |- -->

    <!-- ---- Course Image ---- -->
    <div class="my-4 row">
      <div class="col-sm-4">
        <img class="js-image-upload-preview" src="<?=get_image($row->course_image)?>" alt="<?=$row->title?>" style="width: 100%;height: 200px;object-fit: cover;">
      </div>
      <div class="col-sm-8">
        <h5 class="h5 fw-bold">Course Image:</h5>
        <p class="fontClarity">Upload your course image here. It must meet our <span class="text-primary">course image quality standards</span> to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg, .gif, or .png. No text on the image.</p>
        <input onchange="upload_course_image(this.files[0], this)" class="js-image-upload-input" type="file" name="course_image" accept="image/jpeg,image/png,.jpg,.jpeg,.png">
        <div class="progress my-4 js-image-upload-progress-container hide">
          <div class="progress-bar progress-bar-image" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <div class="js-image-upload-info hide"></div>
        <button type="button" onclick="ajax_course_image_cancel()" class="js-image-upload-cancel-button btn btn-sm btn-outline-danger hide"><i class="bi bi-x-circle"></i></button>
      </div>
    </div>
    <!-- -| ./Course Image\. |- -->

    <!-- ---- Course Hero Background ---- -->
    <div class="my-4 row">
      <div class="col-sm-4">
        <img
          class="js-hero-image-preview"
          src="<?=!empty($row->hero_background_image) ? get_image($row->hero_background_image) : ROOT . '/assets/img/hero-3.png'?>"
          alt="<?=esc($row->title)?> hero background"
          style="width: 100%;height: 200px;object-fit: cover;"
        >
      </div>
      <div class="col-sm-8">
        <h5 class="h5 fw-bold">Course Hero Background Image:</h5>
        <p class="fontClarity">Choose the background image shown behind the course title on its public details page. JPG, PNG, or WebP images are supported.</p>
        <input onchange="upload_course_hero_image(this.files[0])" class="js-hero-image-input form-control" type="file" accept="image/jpeg,image/png,image/webp">
        <div class="progress my-4 js-hero-image-progress-container hide">
          <div class="progress-bar js-hero-image-progress" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <div class="js-hero-image-upload-info hide"></div>
      </div>
    </div>
    <!-- -| ./Course Hero Background\. |- -->

    <!-- ---- Course Promotion Video ---- -->
    <div class="my-4 row">
      <div class="col-sm-4">
        <?php if (!empty($row->course_promo_video)) : ?>
          <video controls class="js-video-upload-preview" style="width: 100%; max-height: 240px;">
            <source src="<?=get_video($row->course_promo_video)?>" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        <?php else: ?>
          <img src="<?=ROOT?>/assets/img/noimage.jpg" alt="Video not available" style="width: 100%; height: auto; object-fit: cover;">
        <?php endif; ?>
      </div>
      <div class="col-sm-8">
        <h5 class="h5 fw-bold">Course Promotion Video:</h5>
        <p class="fontClarity">Students who watch a well-made promo video are <span class="fw-b">5X more likely to enroll</span> in your course. We've seen that statistic go up to 10X for exceptionally awesome videos. <span class="text-primary">Learn how to make yours awesome</span>!.</p>
        <input onchange="upload_course_video(this.files[0])" class="js-video-upload-input" type="file" name="course_promo_video">
        <div class="progress my-4 js-video-upload-progress-container hide">
          <div class="progress-bar progress-bar-video" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <div class="js-video-upload-info hide"></div>
        <button type="button" onclick="ajax_course_video_cancel()" class="js-video-upload-cancel-button btn btn-sm btn-outline-danger hide"><i class="bi bi-x-circle"></i></button>
      </div>
    </div>
    <?php if (!empty($promo_video_schema_ready)): ?>
      <div class="mb-4">
        <label for="promo-video-title-1" class="form-label fw-bold">Course promotion video title:</label>
        <input id="promo-video-title-1" name="promo_video_title[1]" class="form-control mb-3" type="text" maxlength="255" value="<?=esc($promo_video_titles[1] ?? '')?>" placeholder="Title shown in the promotional video list">
        <label for="promo-video-caption-1" class="form-label fw-bold">Course promotion video text:</label>
        <textarea id="promo-video-caption-1" name="promo_video_caption[1]" class="form-control" rows="2" maxlength="2000" placeholder="Text displayed underneath this video"><?=esc($promo_video_captions[1] ?? '')?></textarea>
      </div>

      <?php for ($promo_slot = 2; $promo_slot <= 5; $promo_slot++): ?>
        <?php $promo_video_row = $promo_video_rows[$promo_slot] ?? null; ?>
        <div class="promo-video-editor my-4 p-3 border rounded" data-video-slot="<?=$promo_slot?>">
          <h5 class="h6 fw-bold">Additional promotional video <?=$promo_slot - 1?></h5>
          <div class="row align-items-start">
            <div class="col-sm-4">
              <video class="js-additional-video-preview w-100" controls preload="metadata" style="max-height: 240px;" <?=!empty($promo_video_row->video_path) && is_file($promo_video_row->video_path) ? '' : 'hidden'?>>
                <?php if (!empty($promo_video_row->video_path) && is_file($promo_video_row->video_path)): ?>
                  <source src="<?=esc(get_video($promo_video_row->video_path))?>" type="video/mp4">
                <?php endif; ?>
                Your browser does not support video playback.
              </video>
              <p class="js-additional-video-empty text-muted mb-0" <?=!empty($promo_video_row->video_path) && is_file($promo_video_row->video_path) ? 'hidden' : ''?>>No video uploaded yet.</p>
            </div>
            <div class="col-sm-8">
              <label class="form-label" for="promo-video-upload-<?=$promo_slot?>">Upload MP4 video (maximum 100 MB)</label>
              <input id="promo-video-upload-<?=$promo_slot?>" class="form-control js-additional-video-input" type="file" accept="video/mp4,.mp4" onchange="upload_additional_course_video(this, <?=$promo_slot?>)">
              <div class="progress mt-3 js-additional-video-progress-container" hidden>
                <div class="progress-bar js-additional-video-progress" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
              </div>
              <div class="small mt-2 js-additional-video-info" role="status"></div>
            </div>
          </div>
          <div class="mt-3">
            <label for="promo-video-title-<?=$promo_slot?>" class="form-label">Video title</label>
            <input id="promo-video-title-<?=$promo_slot?>" name="promo_video_title[<?=$promo_slot?>]" class="form-control mb-3" type="text" maxlength="255" value="<?=esc($promo_video_titles[$promo_slot] ?? '')?>" placeholder="Title shown in the promotional video list">
            <label for="promo-video-caption-<?=$promo_slot?>" class="form-label">Text displayed underneath this video</label>
            <textarea id="promo-video-caption-<?=$promo_slot?>" name="promo_video_caption[<?=$promo_slot?>]" class="form-control" rows="2" maxlength="2000" placeholder="Add a short description for this video"><?=esc($promo_video_captions[$promo_slot] ?? '')?></textarea>
          </div>
        </div>
      <?php endfor; ?>
    <?php else: ?>
      <div class="alert alert-warning" role="alert">
        The promotional video title and text fields are unavailable until the course promo-video table
        is created and <code>database/migrations/20261028_add_course_promo_video_titles.sql</code> is applied.
      </div>
    <?php endif; ?>
    <!-- -| ./Course Promotion Video\. |- -->
  </div>
</form>