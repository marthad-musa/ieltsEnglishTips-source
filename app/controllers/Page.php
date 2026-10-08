<?php

namespace Controller;

use \Model\Cms_page;
use \Model\Cms_page_block;

class Page extends Controller {
  public function index($slug = null) {
    try {
      $pages = new Cms_page();
      if (!$pages->schemaReady()) {
        http_response_code(404);
        $this->view('404', ['title' => 'Page not found']);
        return;
      }

      $page = $pages->publishedBySlug((string)$slug);
      if (!$page) {
        http_response_code(404);
        $this->view('404', ['title' => 'Page not found']);
        return;
      }

      $blocks = Cms_page_block::forPage($page->id);
    } catch (\PDOException $error) {
      error_log('CMS page request failed: ' . $error->getMessage());
      http_response_code(503);
      echo 'This page is temporarily unavailable.';
      return;
    }

    $this->view('cms-page', [
      'title' => $page->title,
      'seo_description' => $page->seo_description ?? '',
      'cms_page' => $page,
      'cms_blocks' => $blocks,
      'is_preview' => false,
    ]);
  }
}
