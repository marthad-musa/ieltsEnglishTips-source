<?php

namespace Model;

class Cms_page_block extends Model {
  protected $table = 'cms_page_blocks';

  protected $allowedColumns = [
    'page_id',
    'block_type',
    'title',
    'content',
    'media_url',
    'data_json',
    'animation_effect',
    'sort_order',
    'is_enabled',
    'created_at',
    'updated_at',
  ];

  public static function blockTypes() {
    return ['heading', 'paragraph', 'article', 'image', 'hero', 'counter', 'cta'];
  }

  public static function animations() {
    return ['none', 'fade-up', 'fade-down', 'fade-in', 'fade-left', 'fade-right', 'fade-out'];
  }

  public static function forPage($page_id) {
    return (new self())->query(
      "SELECT * FROM `cms_page_blocks`
       WHERE `page_id` = :page_id
       ORDER BY `sort_order` ASC, `id` ASC",
      ['page_id' => (int)$page_id]
    ) ?: [];
  }

  public static function safeLink($url) {
    $url = trim((string)$url);
    if ($url === '') {
      return '';
    }

    if (preg_match('/[\x00-\x20\\\\]/', $url)) {
      return false;
    }

    if (substr($url, 0, 1) === '/' && substr($url, 0, 2) !== '//') {
      return $url;
    }

    if (substr($url, 0, 1) === '#') {
      return $url;
    }

    if (preg_match('/^https?:\/\//i', $url) && filter_var($url, FILTER_VALIDATE_URL)) {
      return $url;
    }

    if (preg_match('/^mailto:[^@\s]+@[^@\s]+\.[^@\s]+$/i', $url)) {
      return $url;
    }

    return false;
  }

  public static function safeMedia($url) {
    $url = trim((string)$url);
    if ($url === '') {
      return '';
    }
    if (substr($url, 0, 1) === '/' && substr($url, 0, 2) !== '//') {
      return self::safeLink($url);
    }
    if (preg_match('/^https?:\/\//i', $url)) {
      return self::safeLink($url);
    }
    return false;
  }

  public static function sanitizeRichText($html) {
    if (!class_exists('\DOMDocument')) {
      return null;
    }

    $previous_errors = libxml_use_internal_errors(true);
    $dom = new \DOMDocument('1.0', 'UTF-8');
    $loaded = $dom->loadHTML(
      '<!DOCTYPE html><html><body><div id="cms-content-root">' . (string)$html . '</div></body></html>',
      LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED
    );
    libxml_clear_errors();
    libxml_use_internal_errors($previous_errors);

    if (!$loaded) {
      return null;
    }

    $root = $dom->getElementById('cms-content-root');
    if (!$root) {
      return null;
    }

    self::sanitizeChildren($root, $dom);
    $clean = '';
    foreach ($root->childNodes as $child) {
      $clean .= $dom->saveHTML($child);
    }
    return $clean;
  }

  private static function sanitizeChildren(\DOMNode $parent, \DOMDocument $dom) {
    $allowed_tags = [
      'a', 'blockquote', 'br', 'code', 'em', 'h2', 'h3', 'h4', 'hr',
      'li', 'ol', 'p', 'strong', 'u', 'ul',
    ];
    $remove_with_contents = ['iframe', 'object', 'script', 'style', 'svg', 'math'];

    foreach (iterator_to_array($parent->childNodes) as $child) {
      if ($child instanceof \DOMComment) {
        $parent->removeChild($child);
        continue;
      }

      if (!$child instanceof \DOMElement) {
        continue;
      }

      $tag = strtolower($child->tagName);
      if (in_array($tag, $remove_with_contents, true)) {
        $parent->removeChild($child);
        continue;
      }

      if (!in_array($tag, $allowed_tags, true)) {
        self::sanitizeChildren($child, $dom);
        while ($child->firstChild) {
          $parent->insertBefore($child->firstChild, $child);
        }
        $parent->removeChild($child);
        continue;
      }

      $href = $tag === 'a' ? self::safeLink($child->getAttribute('href')) : false;
      while ($child->attributes->length > 0) {
        $child->removeAttributeNode($child->attributes->item(0));
      }
      if ($tag === 'a' && $href !== false && $href !== '') {
        $child->setAttribute('href', $href);
        $child->setAttribute('rel', 'nofollow noopener noreferrer');
      }

      self::sanitizeChildren($child, $dom);
    }
  }

  public static function normalizeSubmittedBlocks($submitted, &$errors) {
    $errors = [];
    $normalized = [];
    if (!is_array($submitted)) {
      return $normalized;
    }
    if (count($submitted) > 50) {
      $errors['blocks'] = 'A page can contain no more than 50 blocks.';
      return [];
    }

    foreach (array_values($submitted) as $position => $block) {
      if (!is_array($block)) {
        $errors['blocks'] = 'A submitted page block is invalid.';
        continue;
      }

      $type = (string)($block['block_type'] ?? '');
      $animation = (string)($block['animation_effect'] ?? 'none');
      if (!in_array($type, self::blockTypes(), true)) {
        $errors['blocks'] = 'Choose a supported content block type.';
        continue;
      }
      if (!in_array($animation, self::animations(), true)) {
        $errors['blocks'] = 'Choose a supported slide effect.';
        continue;
      }

      $title = trim((string)($block['title'] ?? ''));
      $content = (string)($block['content'] ?? '');
      $media_url = self::safeMedia($block['media_url'] ?? '');
      if ($media_url === false || strlen((string)$media_url) > 2048) {
        $errors['blocks'] = 'Use a safe relative or HTTP(S) URL for block media.';
        continue;
      }
      if (strlen($title) > 1020 || strlen($content) > 1000000) {
        $errors['blocks'] = 'Block title or content is too long.';
        continue;
      }

      $settings_input = is_array($block['settings'] ?? null) ? $block['settings'] : [];
      $settings = [];
      if (in_array($type, ['hero', 'cta'], true)) {
        $button_text = trim((string)($settings_input['button_text'] ?? ''));
        $button_url = self::safeLink($settings_input['button_url'] ?? '');
        if ($button_url === false || strlen((string)$button_url) > 2048 || strlen($button_text) > 400) {
          $errors['blocks'] = 'Enter a valid button label and safe button URL.';
          continue;
        }
        $settings['button_text'] = $button_text;
        $settings['button_url'] = $button_url;
      }
      if ($type === 'counter') {
        $counter_items_input = $settings_input['counter_items'] ?? null;
        if (!is_array($counter_items_input)) {
          $counter_items_input = [[
            'label' => $settings_input['counter_label'] ?? '',
            'target' => $settings_input['counter_value'] ?? '',
          ]];
        }
        if (count($counter_items_input) > 12) {
          $errors['blocks'] = 'A counter row can contain no more than 12 items.';
          continue;
        }

        $counter_items = [];
        foreach ($counter_items_input as $counter_item) {
          if (!is_array($counter_item)) {
            $errors['blocks'] = 'Counter items must include a label and target.';
            continue 2;
          }
          $counter_label = trim((string)($counter_item['label'] ?? ''));
          $counter_value = (string)($counter_item['target'] ?? '');
          if ($counter_label === '' && $counter_value === '') {
            continue;
          }
          if ($counter_label === '' || strlen($counter_label) > 400
            || !ctype_digit($counter_value) || (float)$counter_value > 2147483647) {
            $errors['blocks'] = 'Each counter needs a label and a non-negative whole-number target.';
            continue 2;
          }
          $counter_items[] = [
            'label' => $counter_label,
            'target' => (int)$counter_value,
          ];
        }
        if (empty($counter_items)) {
          $errors['blocks'] = 'Add at least one labeled counter with a non-negative whole-number target.';
          continue;
        }
        $settings['counter_items'] = $counter_items;
      }

      $clean_content = self::sanitizeRichText($content);
      if ($clean_content === null && trim($content) !== '') {
        $errors['blocks'] = 'Rich-text sanitization is unavailable. Enable PHP DOM or remove rich-text markup.';
        continue;
      }
      if ($type === 'image' && $media_url === '') {
        $errors['blocks'] = 'Image blocks need a safe image URL.';
        continue;
      }

      $data_json = json_encode($settings, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      if ($data_json === false) {
        $errors['blocks'] = 'Block settings contain invalid text encoding.';
        continue;
      }

      $normalized[] = [
        'block_type' => $type,
        'title' => $title === '' ? null : $title,
        'content' => $clean_content ?? '',
        'media_url' => $media_url === '' ? null : $media_url,
        'data_json' => $data_json,
        'animation_effect' => $animation,
        'sort_order' => $position,
        'is_enabled' => !empty($block['is_enabled']) ? 1 : 0,
      ];
    }

    return $normalized;
  }
}
