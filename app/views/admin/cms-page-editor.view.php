<?php
$h = function ($value) {
  return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
$this->view('partials/private.header', $data);
$this->view('partials/private.nav', $data);
$get_value = function ($block, $key, $default = '') {
  if (is_array($block)) {
    return $block[$key] ?? $default;
  }
  return $block->$key ?? $default;
};
$get_settings = function ($block) use ($get_value) {
  $raw = $get_value($block, 'data_json', '');
  if ($raw === '' && is_array($block)) {
    return is_array($block['settings'] ?? null) ? $block['settings'] : [];
  }
  $settings = is_array($raw) ? $raw : json_decode((string)$raw, true);
  return is_array($settings) ? $settings : [];
};
$block_count = 0;
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1><?=$h($title)?></h1>
    <nav><ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/cms-pages">CMS Pages</a></li>
      <li class="breadcrumb-item active"><?=$h($page->title ?: 'New page')?></li>
    </ol></nav>
  </div>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
      <strong>Review the following before saving:</strong>
      <ul class="mb-0"><?php foreach ($errors as $error): ?><li><?=$h($error)?></li><?php endforeach; ?></ul>
    </div>
  <?php endif; ?>

  <form method="post" action="<?=ROOT?>/admin/cms-pages/save" id="cms-page-form">
    <input type="hidden" name="csrf_code" value="<?=$h($csrf_code)?>">
    <input type="hidden" name="id" value="<?=$h((string)$page->id)?>">
    <input type="hidden" name="current_status" value="<?=$h($page->status ?? 'draft')?>">
    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Page details</h5>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="cms-title">Title</label>
              <input class="form-control" id="cms-title" name="title" maxlength="255" required value="<?=$h($page->title ?? '')?>">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cms-slug">URL slug</label>
              <input class="form-control" id="cms-slug" name="slug" maxlength="180" pattern="[a-z0-9]+(?:-[a-z0-9]+)*" required value="<?=$h($page->slug ?? '')?>">
              <small class="text-muted">Public URL: <?=ROOT?>/page/your-slug</small>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cms-route">Optional existing-page route</label>
              <select class="form-select" id="cms-route" name="route_key">
                <option value="">Do not replace an existing page</option>
                <?php foreach ($route_keys as $route_key): ?>
                  <option value="<?=$h($route_key)?>" <?=($page->route_key ?? '') === $route_key ? 'selected' : ''?>><?=$h(ucfirst($route_key))?></option>
                <?php endforeach; ?>
              </select>
              <small class="text-muted">A published mapping takes over that exact top-level route; unpublishing restores the original page.</small>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cms-course-target">Append blocks to a course detail page</label>
              <select class="form-select" id="cms-course-target" name="course_id" <?=empty($course_target_schema_ready) ? 'disabled' : ''?>>
                <option value="">Do not attach to a course</option>
                <?php foreach ($course_targets as $course_target): ?>
                  <option value="<?=$h((string)$course_target->id)?>" <?=((string)($page->course_id ?? '') === (string)$course_target->id) ? 'selected' : ''?>>
                    <?=$h($course_target->title)?> (<?=$h($course_target->slug)?>)
                  </option>
                <?php endforeach; ?>
              </select>
              <?php if (empty($course_target_schema_ready)): ?>
                <small class="text-warning">Apply the CMS course-target migration to enable course-page attachments.</small>
              <?php else: ?>
                <small class="text-muted">Published blocks are appended below the selected course’s existing details. Existing course content and enrollment remain unchanged.</small>
              <?php endif; ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cms-seo">SEO description</label>
              <textarea class="form-control" id="cms-seo" name="seo_description" rows="2" maxlength="320"><?=$h($page->seo_description ?? '')?></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Content blocks</h2>
        <div>
          <select id="new-block-type" class="form-select d-inline-block w-auto">
            <?php foreach ($block_types as $block_type): ?><option value="<?=$h($block_type)?>"><?=$h(ucfirst($block_type))?></option><?php endforeach; ?>
          </select>
          <button type="button" class="btn btn-outline-primary" id="add-cms-block">Add block</button>
        </div>
      </div>

      <p class="text-muted">Use Remove to take a component out of this draft. The removal is saved when you click Save changes.</p>
      <div id="cms-block-list">
        <?php foreach ($blocks as $block): ?>
          <?php
            $index = $block_count++;
            $type = (string)$get_value($block, 'block_type');
            $settings = $get_settings($block);
            $counter_items = $settings['counter_items'] ?? [];
            if (empty($counter_items) && !empty($settings['counter_label'])) {
              $counter_items = [[
                'label' => $settings['counter_label'],
                'target' => $settings['counter_value'] ?? '',
              ]];
            }
            $is_enabled = (bool)$get_value($block, 'is_enabled', 1);
          ?>
          <div class="card cms-block-editor" data-block-index="<?=$index?>">
            <div class="card-header d-flex justify-content-between align-items-center">
              <strong class="cms-block-label"><?=$h(ucfirst($type))?> block</strong>
              <div>
                <button type="button" class="btn btn-sm btn-outline-secondary cms-move-up" aria-label="Move block up">Up</button>
                <button type="button" class="btn btn-sm btn-outline-secondary cms-move-down" aria-label="Move block down">Down</button>
                <button type="button" class="btn btn-sm btn-outline-danger cms-remove-block">Remove</button>
              </div>
            </div>
            <div class="card-body row g-3">
              <div class="col-md-4">
                <label class="form-label">Block type</label>
                <select class="form-select cms-type" name="blocks[<?=$index?>][block_type]">
                  <?php foreach ($block_types as $block_type): ?><option value="<?=$h($block_type)?>" <?=$type === $block_type ? 'selected' : ''?>><?=$h(ucfirst($block_type))?></option><?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-5">
                <label class="form-label">Heading / title</label>
                <input class="form-control" name="blocks[<?=$index?>][title]" maxlength="255" value="<?=$h($get_value($block, 'title'))?>">
              </div>
              <div class="col-md-3">
                <label class="form-label">Animation</label>
                <select class="form-select" name="blocks[<?=$index?>][animation_effect]">
                  <?php foreach ($animations as $animation): ?><option value="<?=$h($animation)?>" <?=((string)$get_value($block, 'animation_effect', 'none') === $animation) ? 'selected' : ''?>><?=$h(ucfirst(str_replace('-', ' ', $animation)))?></option><?php endforeach; ?>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label">Text / article / caption</label>
                <textarea class="form-control tinymce-editor" rows="5" name="blocks[<?=$index?>][content]"><?=$h($get_value($block, 'content'))?></textarea>
                <small class="text-muted">Formatting is sanitized when saved. To link text, select it in TinyMCE and use Link. Scripts, embeds, and unsafe links are removed.</small>
              </div>
              <div class="col-md-6 cms-media-setting">
                <label class="form-label">Image URL (relative or HTTP(S))</label>
                <input class="form-control" name="blocks[<?=$index?>][media_url]" value="<?=$h($get_value($block, 'media_url'))?>">
              </div>
              <div class="col-md-3 cms-button-setting">
                <label class="form-label">Button label</label>
                <input class="form-control" name="blocks[<?=$index?>][settings][button_text]" maxlength="100" value="<?=$h($settings['button_text'] ?? '')?>">
              </div>
              <div class="col-md-4 cms-button-setting">
                <label class="form-label">Link to a published CMS page</label>
                <select class="form-select cms-link-target" name="blocks[<?=$index?>][settings][button_page_id]">
                  <option value="">Choose CMS page...</option>
                  <?php foreach ($link_targets as $link_target): ?>
                    <option value="<?=$h((string)$link_target->id)?>" <?=((string)($settings['button_page_id'] ?? '') === (string)$link_target->id) ? 'selected' : ''?>>
                      <?=$h($link_target->title)?> (<?=$h($link_target->slug)?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-5 cms-button-setting">
                <label class="form-label">Or enter a safe URL</label>
                <input class="form-control cms-manual-link" name="blocks[<?=$index?>][settings][button_url]" value="<?=$h($settings['button_url'] ?? '')?>" placeholder="https://... or /page/path">
              </div>
              <div class="col-12 cms-counter-setting">
                <div class="row g-2">
                  <?php for ($counter_index = 0; $counter_index < 3; $counter_index++): $counter = $counter_items[$counter_index] ?? []; ?>
                    <div class="col-md-4">
                      <div class="row g-2">
                        <div class="col-7">
                          <label class="form-label">Counter <?=($counter_index + 1)?> label</label>
                          <input class="form-control" name="blocks[<?=$index?>][settings][counter_items][<?=$counter_index?>][label]" maxlength="100" value="<?=$h($counter['label'] ?? '')?>">
                        </div>
                        <div class="col-5">
                          <label class="form-label">Target</label>
                          <input class="form-control" type="number" min="0" max="2147483647" step="1" name="blocks[<?=$index?>][settings][counter_items][<?=$counter_index?>][target]" value="<?=$h($counter['target'] ?? '')?>">
                        </div>
                      </div>
                    </div>
                  <?php endfor; ?>
                </div>
                <small class="text-muted">Leave unused counter label/target pairs blank.</small>
              </div>
              <div class="col-12">
                <label class="form-check">
                  <input class="form-check-input" type="checkbox" name="blocks[<?=$index?>][is_enabled]" value="1" <?=$is_enabled ? 'checked' : ''?>>
                  <span class="form-check-label">Enabled on the page</span>
                </label>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-primary"><?=($page->status ?? 'draft') === 'published' ? 'Save changes' : 'Save as draft'?></button>
        <a class="btn btn-outline-secondary" href="<?=ROOT?>/admin/cms-pages">Cancel</a>
        <?php if (!empty($page->id)): ?>
          <a class="btn btn-outline-info" target="_blank" rel="noopener" href="<?=ROOT?>/admin/cms-preview/<?=$h((string)$page->id)?>">Preview</a>
        <?php endif; ?>
      </div>
    </section>
  </form>

  <?php if (!empty($page->id) && ($page->status ?? '') === 'published'): ?>
    <form class="mt-3" method="post" action="<?=ROOT?>/admin/cms-pages/unpublish/<?=$h((string)$page->id)?>">
      <input type="hidden" name="csrf_code" value="<?=$h($csrf_code)?>">
      <button type="submit" class="btn btn-outline-warning">Unpublish page</button>
    </form>
  <?php endif; ?>
  <?php if (!empty($page->id)): ?>
    <form class="mt-3 cms-delete-page-form" method="post" action="<?=ROOT?>/admin/cms-pages/delete/<?=$h((string)$page->id)?>" data-page-title="<?=$h($page->title)?>">
      <input type="hidden" name="csrf_code" value="<?=$h($csrf_code)?>">
      <button type="submit" class="btn btn-outline-danger">Delete this page</button>
    </form>
  <?php endif; ?>
</main>

<template id="cms-block-template">
  <div class="card cms-block-editor">
    <div class="card-header d-flex justify-content-between align-items-center">
      <strong class="cms-block-label">Block</strong>
      <div>
        <button type="button" class="btn btn-sm btn-outline-secondary cms-move-up" aria-label="Move block up">Up</button>
        <button type="button" class="btn btn-sm btn-outline-secondary cms-move-down" aria-label="Move block down">Down</button>
        <button type="button" class="btn btn-sm btn-outline-danger cms-remove-block">Remove</button>
      </div>
    </div>
    <div class="card-body row g-3">
      <div class="col-md-4">
        <label class="form-label">Block type</label>
        <select class="form-select cms-type" name="blocks[__INDEX__][block_type]">
          <?php foreach ($block_types as $block_type): ?><option value="<?=$h($block_type)?>"><?=$h(ucfirst($block_type))?></option><?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-5"><label class="form-label">Heading / title</label><input class="form-control" name="blocks[__INDEX__][title]" maxlength="255"></div>
      <div class="col-md-3">
        <label class="form-label">Animation</label>
        <select class="form-select" name="blocks[__INDEX__][animation_effect]"><?php foreach ($animations as $animation): ?><option value="<?=$h($animation)?>"><?=$h(ucfirst(str_replace('-', ' ', $animation)))?></option><?php endforeach; ?></select>
      </div>
      <div class="col-12"><label class="form-label">Text / article / caption</label><textarea class="form-control tinymce-editor" rows="5" name="blocks[__INDEX__][content]"></textarea><small class="text-muted">Formatting is sanitized when saved. To link text, select it in TinyMCE and use Link. Scripts, embeds, and unsafe links are removed.</small></div>
      <div class="col-md-6 cms-media-setting"><label class="form-label">Image URL (relative or HTTP(S))</label><input class="form-control" name="blocks[__INDEX__][media_url]"></div>
      <div class="col-md-3 cms-button-setting"><label class="form-label">Button label</label><input class="form-control" name="blocks[__INDEX__][settings][button_text]" maxlength="100"></div>
      <div class="col-md-4 cms-button-setting">
        <label class="form-label">Link to a published CMS page</label>
        <select class="form-select cms-link-target" name="blocks[__INDEX__][settings][button_page_id]">
          <option value="">Choose CMS page...</option>
          <?php foreach ($link_targets as $link_target): ?><option value="<?=$h((string)$link_target->id)?>"><?=$h($link_target->title)?> (<?=$h($link_target->slug)?>)</option><?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-5 cms-button-setting"><label class="form-label">Or enter a safe URL</label><input class="form-control cms-manual-link" name="blocks[__INDEX__][settings][button_url]" placeholder="https://... or /page/path"></div>
      <div class="col-12 cms-counter-setting">
        <div class="row g-2">
          <?php for ($counter_index = 0; $counter_index < 3; $counter_index++): ?>
            <div class="col-md-4">
              <div class="row g-2">
                <div class="col-7"><label class="form-label">Counter <?=($counter_index + 1)?> label</label><input class="form-control" name="blocks[__INDEX__][settings][counter_items][<?=$counter_index?>][label]" maxlength="100"></div>
                <div class="col-5"><label class="form-label">Target</label><input class="form-control" type="number" min="0" max="2147483647" step="1" name="blocks[__INDEX__][settings][counter_items][<?=$counter_index?>][target]"></div>
              </div>
            </div>
          <?php endfor; ?>
        </div>
        <small class="text-muted">Leave unused counter label/target pairs blank.</small>
      </div>
      <div class="col-12"><label class="form-check"><input class="form-check-input" type="checkbox" name="blocks[__INDEX__][is_enabled]" value="1" checked><span class="form-check-label">Enabled on the page</span></label></div>
    </div>
  </div>
</template>

<style>.cms-block-editor{margin-bottom:1rem}.cms-block-editor .card-header{gap:.5rem}</style>
<script>
(function () {
  document.querySelectorAll('.cms-delete-page-form').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      var pageTitle = form.getAttribute('data-page-title') || 'this page';
      if (!window.confirm('Delete "' + pageTitle + '" and all its content blocks? This cannot be undone.')) {
        event.preventDefault();
      }
    });
  });

  var list = document.getElementById('cms-block-list');
  var template = document.getElementById('cms-block-template');
  var nextIndex = <?=$block_count?>;

  function updateBlock(block) {
    var type = block.querySelector('.cms-type').value;
    block.querySelector('.cms-block-label').textContent = type.charAt(0).toUpperCase() + type.slice(1) + ' block';
    block.querySelectorAll('.cms-media-setting').forEach(function (field) {
      field.hidden = type !== 'image' && type !== 'hero';
    });
    block.querySelectorAll('.cms-button-setting').forEach(function (field) {
      field.hidden = type !== 'hero' && type !== 'cta';
    });
    block.querySelectorAll('.cms-counter-setting').forEach(function (field) {
      field.hidden = type !== 'counter';
    });
  }

  function syncButtonDestination(changed) {
    var buttonBlock = changed.closest('.cms-block-editor');
    if (!buttonBlock) return;
    var pageSelect = buttonBlock.querySelector('.cms-link-target');
    var manualLink = buttonBlock.querySelector('.cms-manual-link');
    if (changed === pageSelect && pageSelect.value !== '') manualLink.value = '';
    if (changed === manualLink && manualLink.value.trim() !== '') pageSelect.value = '';
  }

  function renumber() {
    list.querySelectorAll('.cms-block-editor').forEach(function (block, index) {
      block.querySelectorAll('[name]').forEach(function (field) {
        field.name = field.name.replace(/blocks\[\d+\]/, 'blocks[' + index + ']');
      });
    });
  }

  function addBlock(type) {
    var html = template.innerHTML.replace(/__INDEX__/g, String(nextIndex++));
    var wrapper = document.createElement('div');
    wrapper.innerHTML = html.trim();
    var block = wrapper.firstElementChild;
    block.querySelector('.cms-type').value = type;
    list.appendChild(block);
    updateBlock(block);
    if (window.tinymce) {
      var textarea = block.querySelector('textarea');
      textarea.id = 'cms-editor-' + nextIndex;
      window.tinymce.init({ target: textarea, menubar: false, plugins: 'lists link', toolbar: 'undo redo | bold italic | bullist numlist | link' });
    }
  }

  list.querySelectorAll('.cms-block-editor').forEach(updateBlock);
  document.getElementById('add-cms-block').addEventListener('click', function () {
    addBlock(document.getElementById('new-block-type').value);
  });
  list.addEventListener('change', function (event) {
    if (event.target.classList.contains('cms-type')) updateBlock(event.target.closest('.cms-block-editor'));
    if (event.target.classList.contains('cms-link-target')) syncButtonDestination(event.target);
  });
  list.addEventListener('input', function (event) {
    if (event.target.classList.contains('cms-manual-link')) syncButtonDestination(event.target);
  });
  list.addEventListener('click', function (event) {
    var block = event.target.closest('.cms-block-editor');
    if (!block) return;
    if (event.target.classList.contains('cms-remove-block')) {
      var editor = block.querySelector('textarea');
      if (window.tinymce && editor.id && window.tinymce.get(editor.id)) {
        window.tinymce.get(editor.id).remove();
      }
      block.remove();
      renumber();
    } else if (event.target.classList.contains('cms-move-up') && block.previousElementSibling) {
      list.insertBefore(block, block.previousElementSibling);
      renumber();
    } else if (event.target.classList.contains('cms-move-down') && block.nextElementSibling) {
      list.insertBefore(block.nextElementSibling, block);
      renumber();
    }
  });
  document.getElementById('cms-page-form').addEventListener('submit', function () {
    if (window.tinymce) window.tinymce.triggerSave();
    renumber();
  });

  var routeSelect = document.getElementById('cms-route');
  var courseSelect = document.getElementById('cms-course-target');
  function synchronizeTargets(changed) {
    if (!routeSelect || !courseSelect) return;
    if (changed === routeSelect && routeSelect.value !== '') courseSelect.value = '';
    if (changed === courseSelect && courseSelect.value !== '') routeSelect.value = '';
  }
  routeSelect.addEventListener('change', function () { synchronizeTargets(routeSelect); });
  courseSelect.addEventListener('change', function () { synchronizeTargets(courseSelect); });
})();
</script>

<?php $this->view('partials/private.footer', $data); ?>
