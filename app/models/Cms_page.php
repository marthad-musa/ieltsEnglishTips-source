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
    if ($this->courseTargetSchemaReady()) {
      return $this->query(
        "SELECT p.`id`, p.`slug`, p.`title`, p.`route_key`, p.`status`,
                p.`updated_at`, p.`published_at`, t.`course_id`,
                c.`title` AS `course_title`, c.`slug` AS `course_slug`
         FROM `cms_pages` p
         LEFT JOIN `cms_page_course_targets` t ON t.`cms_page_id` = p.`id`
         LEFT JOIN `courses` c ON c.`id` = t.`course_id`
         ORDER BY p.`updated_at` DESC, p.`id` DESC"
      ) ?: [];
    }

    return $this->query(
      "SELECT `id`, `slug`, `title`, `route_key`, `status`, `updated_at`, `published_at`,
              NULL AS `course_id`, NULL AS `course_title`, NULL AS `course_slug`
       FROM `cms_pages`
       ORDER BY `updated_at` DESC, `id` DESC"
    ) ?: [];
  }

  public function courseTargetSchemaReady() {
    $tables = $this->query(
      "SELECT COUNT(*) AS `table_count`
       FROM `information_schema`.`tables`
       WHERE `table_schema` = DATABASE()
         AND `table_name` = 'cms_page_course_targets'"
    );
    return !empty($tables) && (int)$tables[0]->table_count === 1;
  }

  public function availableCourseTargets() {
    return $this->query(
      "SELECT `id`, `title`, `slug`
       FROM `courses`
       ORDER BY `title` ASC, `id` ASC"
    ) ?: [];
  }

  public function courseTargetForPage($page_id) {
    if (!$this->courseTargetSchemaReady()) {
      return false;
    }
    $targets = $this->query(
      "SELECT c.`id`, c.`title`, c.`slug`
       FROM `cms_page_course_targets` t
       JOIN `courses` c ON c.`id` = t.`course_id`
       WHERE t.`cms_page_id` = :page_id
       LIMIT 1",
      ['page_id' => (int)$page_id]
    );
    return $targets[0] ?? false;
  }

  public function saveCourseTarget($page_id, $course_id) {
    $this->query(
      "DELETE FROM `cms_page_course_targets` WHERE `cms_page_id` = :page_id",
      ['page_id' => (int)$page_id]
    );

    if ((int)$course_id > 0) {
      $this->query(
        "INSERT INTO `cms_page_course_targets` (`cms_page_id`, `course_id`, `created_at`)
         VALUES (:page_id, :course_id, :created_at)",
        [
          'page_id' => (int)$page_id,
          'course_id' => (int)$course_id,
          'created_at' => date('Y-m-d H:i:s'),
        ]
      );
    }
  }

  public function publishedBlocksForCourse($course_id) {
    return $this->query(
      "SELECT b.*
       FROM `cms_page_course_targets` t
       JOIN `cms_pages` p ON p.`id` = t.`cms_page_id` AND p.`status` = 'published'
       JOIN `cms_page_blocks` b ON b.`page_id` = p.`id`
       WHERE t.`course_id` = :course_id AND b.`is_enabled` = 1
       ORDER BY b.`sort_order` ASC, b.`id` ASC",
      ['course_id' => (int)$course_id]
    ) ?: [];
  }

  public function publishedBySlug($slug) {
    return $this->first(['slug' => $slug, 'status' => 'published']);
  }

  public function publishedPagesForLinks($exclude_id = null) {
    $params = [];
    $sql = "SELECT `id`, `slug`, `title` FROM `cms_pages` WHERE `status` = 'published'";
    if ((int)$exclude_id > 0) {
      $sql .= " AND `id` != :exclude_id";
      $params['exclude_id'] = (int)$exclude_id;
    }
    $sql .= " ORDER BY `title` ASC, `id` ASC";
    return $this->query($sql, $params) ?: [];
  }

  public function publishedPageSlugsByIds($page_ids) {
    $ids = array_values(array_unique(array_filter(array_map('intval', $page_ids), function ($id) {
      return $id > 0;
    })));
    if (empty($ids)) {
      return [];
    }

    $placeholders = [];
    $params = [];
    foreach ($ids as $index => $id) {
      $key = 'page_id_' . $index;
      $placeholders[] = ':' . $key;
      $params[$key] = $id;
    }

    $pages = $this->query(
      "SELECT `id`, `slug` FROM `cms_pages`
       WHERE `status` = 'published' AND `id` IN (" . implode(', ', $placeholders) . ")",
      $params
    ) ?: [];
    $slugs = [];
    foreach ($pages as $page) {
      $slugs[(int)$page->id] = $page->slug;
    }
    return $slugs;
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
    $course_id = trim((string)($data['course_id'] ?? ''));

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

    if ($route_key !== '' && $course_id !== '') {
      $errors['course_id'] = 'Choose either an existing public route or one course detail page, not both.';
    } elseif ($course_id !== '') {
      if (!ctype_digit($course_id) || (int)$course_id < 1) {
        $errors['course_id'] = 'Choose a valid published course detail page.';
      } elseif (!$this->courseTargetSchemaReady()) {
        $errors['course_id'] = 'Apply the CMS course-target migration before attaching content to a course page.';
      } else {
        $courses = $this->query(
          "SELECT `id` FROM `courses` WHERE `id` = :course_id LIMIT 1",
          ['course_id' => (int)$course_id]
        );
        if (empty($courses)) {
          $errors['course_id'] = 'Choose an existing course detail page.';
        } else {
          $existing_target = $this->query(
            "SELECT `cms_page_id` FROM `cms_page_course_targets` WHERE `course_id` = :course_id LIMIT 1",
            ['course_id' => (int)$course_id]
          );
          if (!empty($existing_target) && (int)$existing_target[0]->cms_page_id !== (int)$id) {
            $errors['course_id'] = 'Another CMS page is already attached to this course detail page.';
          }
        }
      }
    }

    return $errors;
  }
}
