<?php
$h = function ($value) {
  return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
$this->view('partials/public.header', $data);
$this->view('partials/public.navbar', $data);
?>

<main class="main cms-page">
  <?php if (!empty($is_preview)): ?>
    <div class="alert alert-info text-center m-0" role="status">Draft preview - this page is not public.</div>
  <?php endif; ?>

  <?php foreach ($cms_blocks as $block): ?>
    <?php
      if (empty($block->is_enabled) || !in_array($block->block_type, \Model\Cms_page_block::blockTypes(), true)) {
        continue;
      }
      $settings = json_decode((string)($block->data_json ?? ''), true);
      $settings = is_array($settings) ? $settings : [];
      $effect = in_array($block->animation_effect, \Model\Cms_page_block::animations(), true)
        ? $block->animation_effect
        : 'none';
      $safe_media = \Model\Cms_page_block::safeMedia($block->media_url ?? '');
      $safe_media = $safe_media === false ? '' : $safe_media;
      $content = \Model\Cms_page_block::sanitizeRichText((string)($block->content ?? ''));
      $safe_content = $content === null
        ? nl2br($h(strip_tags((string)($block->content ?? ''))))
        : $content;
      $attributes = $effect === 'fade-out'
        ? 'data-cms-effect="fade-out"'
        : ($effect !== 'none'
          ? 'data-aos="' . $h($effect === 'fade-in' ? 'fade' : $effect) . '"'
          : '');
      $button_url = \Model\Cms_page_block::safeLink($settings['button_url'] ?? '');
      $button_url = $button_url === false ? '' : $button_url;
      $button_text = trim((string)($settings['button_text'] ?? ''));
      $counter_items = $settings['counter_items'] ?? [];
      if (empty($counter_items) && isset($settings['counter_label'], $settings['counter_value'])) {
        $counter_items = [[
          'label' => $settings['counter_label'],
          'target' => $settings['counter_value'],
        ]];
      }
    ?>
    <?php if ($block->block_type === 'heading'): ?>
      <section class="section cms-block cms-heading" <?=$attributes?>>
        <div class="container">
          <h2><?=$h($block->title ?? '')?></h2>
          <?php if (trim(strip_tags((string)$safe_content)) !== ''): ?><div><?=$safe_content?></div><?php endif; ?>
        </div>
      </section>
    <?php elseif ($block->block_type === 'paragraph' || $block->block_type === 'article'): ?>
      <section class="section cms-block cms-<?=$h($block->block_type)?>" <?=$attributes?>>
        <div class="container">
          <?php if (trim((string)($block->title ?? '')) !== ''): ?><h2><?=$h($block->title)?></h2><?php endif; ?>
          <div class="content"><?=$safe_content?></div>
        </div>
      </section>
    <?php elseif ($block->block_type === 'image'): ?>
      <?php if ($safe_media !== ''): ?>
        <section class="section cms-block cms-image" <?=$attributes?>>
          <div class="container text-center">
            <figure>
              <img src="<?=$h($safe_media)?>" alt="<?=$h($block->title ?? '')?>" class="img-fluid">
              <?php if (trim((string)($block->content ?? '')) !== ''): ?><figcaption><?=$safe_content?></figcaption><?php endif; ?>
            </figure>
          </div>
        </section>
      <?php endif; ?>
    <?php elseif ($block->block_type === 'hero'): ?>
      <section class="section cms-block cms-hero dark-background" <?=$attributes?>>
        <?php if ($safe_media !== ''): ?><img src="<?=$h($safe_media)?>" alt="" class="cms-hero-image"><?php endif; ?>
        <div class="container position-relative">
          <?php if (trim((string)($block->title ?? '')) !== ''): ?><h1><?=$h($block->title)?></h1><?php endif; ?>
          <div><?=$safe_content?></div>
          <?php if ($button_text !== '' && $button_url !== ''): ?>
            <a class="btn-get-started" href="<?=$h($button_url)?>"><?=$h($button_text)?></a>
          <?php endif; ?>
        </div>
      </section>
    <?php elseif ($block->block_type === 'counter'): ?>
      <section class="section cms-block cms-counter" <?=$attributes?>>
        <div class="container text-center">
          <?php if (trim((string)($block->title ?? '')) !== ''): ?><h2><?=$h($block->title)?></h2><?php endif; ?>
          <div class="row gy-4">
            <?php foreach ($counter_items as $counter_item): ?>
              <?php if (!is_array($counter_item) || !ctype_digit((string)($counter_item['target'] ?? '')) || trim((string)($counter_item['label'] ?? '')) === '') continue; ?>
                <div class="col-md">
                  <div class="purecounter" data-purecounter-start="0" data-purecounter-end="<?=$h((string)$counter_item['target'])?>" data-purecounter-duration="1"></div>
                  <p><?=$h($counter_item['label'])?></p>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php elseif ($block->block_type === 'cta'): ?>
      <section class="section cms-block cms-cta text-center" <?=$attributes?>>
        <div class="container">
          <?php if (trim((string)($block->title ?? '')) !== ''): ?><h2><?=$h($block->title)?></h2><?php endif; ?>
          <div><?=$safe_content?></div>
          <?php if ($button_text !== '' && $button_url !== ''): ?>
            <a class="btn-get-started" href="<?=$h($button_url)?>"><?=$h($button_text)?></a>
          <?php endif; ?>
        </div>
      </section>
    <?php endif; ?>
  <?php endforeach; ?>
</main>

<style>
  .cms-hero { overflow: hidden; position: relative; }
  .cms-hero-image { inset: 0; height: 100%; object-fit: cover; opacity: .45; position: absolute; width: 100%; }
  .cms-hero .container { z-index: 1; }
  .cms-fade-out-ready { opacity: 0; transition: opacity .7s ease; }
  .cms-fade-out-ready.cms-fade-out-visible { opacity: 1; }
</style>
<script>
  document.querySelectorAll('[data-cms-effect="fade-out"]').forEach(function (element) {
    if (!('IntersectionObserver' in window)) return;
    element.classList.add('cms-fade-out-ready');
    new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        entry.target.classList.toggle('cms-fade-out-visible', entry.isIntersecting);
      });
    }, { threshold: 0.15 }).observe(element);
  });
</script>

<?php $this->view('partials/public.footer', $data); ?>
