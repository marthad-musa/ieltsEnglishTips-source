-- Additive CMS schema migration.
-- Back up the database before running this migration.
-- Safe to re-run when these tables already exist with this schema.

CREATE TABLE IF NOT EXISTS `cms_pages` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `slug` varchar(180) NOT NULL,
  `title` varchar(255) NOT NULL,
  `seo_description` varchar(320) DEFAULT NULL,
  `route_key` varchar(100) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `route_key` (`route_key`),
  KEY `status` (`status`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `cms_page_blocks` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `block_type` varchar(40) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `media_url` varchar(2048) DEFAULT NULL,
  `data_json` mediumtext,
  `animation_effect` varchar(24) NOT NULL DEFAULT 'none',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  KEY `page_id_sort_order` (`page_id`, `sort_order`),
  KEY `page_id_enabled` (`page_id`, `is_enabled`),
  KEY `block_type` (`block_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
