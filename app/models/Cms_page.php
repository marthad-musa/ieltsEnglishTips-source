<?php

namespace Model;

class Cms_page extends Model {
  protected $table = 'cms_pages';

  protected $allowedColumns = [
    'slug',
    'title',
    'seo_description',
    'route_key',
    'status',
    'created_by',
    'created_at',
    'updated_at',
    'published_at',
  ];

  public static function allowedRouteKeys() {
    return ['home', 'about', 'ielts', 'headway', 'computer', 'faculty', 'events', 'contact'];
  }

  public static function isReservedSlug($slug) {
    $reserved = [
      'admin', 'about', 'category', 'computer', 'contact', 'course_details',
      'courses', 'events', 'exam', 'faculty', 'headway', 'home', 'ielts',
      'login', 'logout', 'page', 'pricing', 'signup',
    ];

    return in_array(strtolower((string)$slug), $reserved, true);
  }

  public function schemaReady() {
    $tables = $this->query(
      "SELECT COUNT(*) AS `table_count`
       FROM `information_schema`.`tables`
       WHERE `table_schema` = DATABASE()
         AND `table_name` IN ('cms_pages', 'cms_page_blocks')"
    );
    return !empty($tables) && (int)$tables[0]->table_count === 2;
  }

  public function allForAdmin() {
    return $this->query(
      "SELECT `id`, `slug`, `title`, `route_key`, `status`, `updated_at`, `published_at`
       FROM `cms_pages`
       ORDER BY `updated_at` DESC, `id` DESC"
    ) ?: [];
  }

  public function publishedBySlug($slug) {
    return $this->first(['slug' => $slug, 'status' => 'published']);
  }

  public function publishedByRouteKey($route_key) {
    if (!in_array($route_key, self::allowedRouteKeys(), true)) {
      return false;
    }
    return $this->first(['route_key' => $route_key, 'status' => 'published']);
  }

  public function validatePage($data, $id = null) {
    $errors = [];
    $slug = trim((string)($data['slug'] ?? ''));
    $title = trim((string)($data['title'] ?? ''));
    $route_key = trim((string)($data['route_key'] ?? ''));

    if ($title === '' || strlen($title) > 1020) {
      $errors['title'] = 'Enter a page title up to 255 characters.';
    }

    if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug) || strlen($slug) > 180) {
      $errors['slug'] = 'Use a lowercase URL slug with letters, numbers, and single hyphens.';
    } elseif (self::isReservedSlug($slug)) {
      $errors['slug'] = 'This slug is reserved for an existing application route.';
    } else {
      $existing = $this->first(['slug' => $slug]);
      if ($existing && (int)$existing->id !== (int)$id) {
        $errors['slug'] = 'That page slug is already in use.';
      }
    }

    $description = trim((string)($data['seo_description'] ?? ''));
    if (strlen($description) > 1280) {
      $errors['seo_description'] = 'SEO description must be 320 characters or fewer.';
    }

    if ($route_key !== '' && !in_array($route_key, self::allowedRouteKeys(), true)) {
      $errors['route_key'] = 'Choose an available public page route.';
    } elseif ($route_key !== '') {
      $existing_route = $this->first(['route_key' => $route_key]);
      if ($existing_route && (int)$existing_route->id !== (int)$id) {
        $errors['route_key'] = 'That public route is already mapped to another CMS page.';
      }
    }

    return $errors;
  }
}
