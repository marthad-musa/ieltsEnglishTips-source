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
        <label class="col-form-label">Course Level:</label>
        <select name="level_id" class="form-select">
          <option disabled>Please, choose a level</option>
          <?php if(!empty($levels)): ?>
            <?php foreach($levels as $lvl): ?>
              <option <?=set_select('level_id',$lvl->id,($row->level_id ?? 1))?> value="<?=$lvl->id?>"><?=esc($lvl->level)?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <!-- ---- Level_ID Error ---- -->
        <small class="error error-level_id w-100 text-danger fontClarity"></small>
        <!-- -| ./Level_ID Error\. |- -->
      </div>
      <div class="col-sm-6 my-1">
        <label class="col-form-label">Course Category:</label>
        <select name="category_id" class="form-select">
          <option disabled>Please, choose a category</option>
          <?php if(!empty($categories)): ?>
            <?php foreach($categories as $cat): ?>
              <option <?=set_select('category_id',$cat->id,($row->category_id ?? 1))?> value="<?=$cat->id?>"><?=esc($cat->category)?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <!-- ---- Category_ID Error ---- -->
        <small class="error error-category_id w-100 text-danger fontClarity"></small>
        <!-- -| ./Category_ID Error\. |- -->
      </div>
      <div class="col-sm-6 my-1">
        <label class="col-form-label">Course Subcategory:</label>
        <select name="sub_category_id" class="form-select">
          <option disabled>Please, choose a subcategory</option>
          <?php if(!empty($subcategories)): ?>
            <?php foreach($subcategories as $cat): ?>
              <option <?=set_select('subcategory_id',$cat->id,($row->category_id ?? 1))?> value="<?=$cat->id?>"><?=esc($cat->category)?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <!-- ---- Sub_Category_ID Error ---- -->
        <small class="error error-sub_category_id w-100 text-danger fontClarity"></small>
        <!-- -| ./Sub_Category_ID Error\. |- -->
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
        <input onchange="upload_course_image(this.files[0])" class="js-image-upload-input" type="file" name="course_image">
        <div class="progress my-4">
          <div class="progress-bar progress-bar-image" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <div class="js-image-upload-info hide"></div>
        <button type="button" onclick="ajax_course_image_cancel()" class="js-image-upload-cancel-button btn btn-sm btn-outline-danger hide"><i class="bi bi-x-circle"></i></button>
      </div>
    </div>
    <!-- -| ./Course Image\. |- -->

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
        <div class="progress my-4">
          <div class="progress-bar progress-bar-video" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <div class="js-video-upload-info hide"></div>
        <button type="button" onclick="ajax_course_video_cancel()" class="js-video-upload-cancel-button btn btn-sm btn-outline-danger hide"><i class="bi bi-x-circle"></i></button>
      </div>
    </div>
    <!-- -| ./Course Promotion Video\. |- -->
  </div>
</form>