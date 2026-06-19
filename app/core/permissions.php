<?php

/**
 * User: TECH-Tag
 * Date: Feb 15, 2026
 * Time: 03:30 PM
 * * *
 * @author  Marthad Musa <marthad_musa@yahoo.com>
 * @package https://github.com/marthad-musa
 */

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

/**
 * Controlling the website Users PERMISSIONS
 * *
 */
define('PERMISSIONS', [
  # Admin Area  ---------------
  'view_admin_area',
  // 'add_admin_area',
  // 'edit_admin_area',
  // 'delete_admin_area',
  # ------------|  ./Admin Area
  # Dashboard  ---------------
  'view_dashboard',
  // 'add_dashboard',
  // 'edit_dashboard',
  // 'delete_dashboard',
  # ------------|  ./Dashboard
  # ALL Courses  ---------------
  'view_all_courses',
  'add_all_courses',
  'edit_all_courses',
  'delete_all_courses',
  # ------------|  ./ALL Courses
  # MY Courses  ---------------
  'view_my_courses',
  'add_my_courses',
  'edit_my_courses',
  'delete_my_courses',
  # ------------|  ./MY Courses
  # Categories  ---------------
  'view_categories',
  'add_categories',
  'edit_categories',
  'delete_categories',
  # ------------|  ./Categories
  # Enrolled  ---------------
  'view_enrolled',
  // 'add_enrolled',
  // 'edit_enrolled',
  // 'delete_enrolled',
  # ------------|  ./Enrolled
  # History  ---------------
  'view_history',
  // 'add_history',
  // 'edit_history',
  // 'delete_history',
  # ------------|  ./History
  # Permissions  ---------------
  'view_permissions',
  'add_permissions',
  'edit_permissions',
  'delete_permissions',
  # ------------|  ./Permissions
  # Roles  ---------------
  'view_roles',
  'add_roles',
  'edit_roles',
  'delete_roles',
  # ------------|  ./Roles
  # Materials  ---------------
  'view_material',
  'add_material',
  'edit_material',
  'delete_material',
  # ------------|  ./Materials
  # Quiz  ---------------
  'view_quiz',
  'add_quiz',
  'edit_quiz',
  'delete_quiz',
  # ------------|  ./Quiz
  # Score  ---------------
  'view_score',
  // 'add_score',
  // 'edit_score',
  // 'delete_score',
  # ------------|  ./Score
  # Final Score  ---------------
  'view_final_score',
  // 'add_final_score',
  // 'edit_final_score',
  // 'delete_final_score',
  # ------------|  ./Final Score
  # USERS  ---------------
  'view_users',
  // 'add_users',
  // 'edit_users',
  // 'delete_users',
  # ------------|  ./USERS
  # ADMINS  ---------------
  'view_admins',
  'add_admins',
  'edit_admins',
  'delete_admins',
  # ------------|  ./ADMINS
  # Managers  ---------------
  'view_mgr',
  'add_mgr',
  'edit_mgr',
  'delete_mgr',
  # ------------|  ./Managers
  # Instructors  ---------------
  'view_instructor',
  'add_instructor',
  'edit_instructor',
  'delete_instructor',
  # ------------|  ./Instructors
  # Students  ---------------
  'view_student',
  'add_student',
  'edit_student',
  'delete_student',
  # ------------|  ./Students
  # Slider  ---------------
  'view_slider_images',
  // 'add_slider_images',
  'edit_slider_images',
  // 'delete_slider_images',
  # ------------|  ./Slider
  # Sales  ---------------
  'view_sales',
  // 'add_sales',
  // 'edit_sales',
  // 'delete_sales',
  # ------------|  ./Sales
  # Receipt  ---------------
  'view_receipt',
  // 'add_receipt',
  // 'edit_receipt',
  // 'delete_receipt',
  # ------------|  ./Receipt
  # Income  ---------------
  'view_income',
  // 'add_income',
  // 'edit_income',
  // 'delete_income',
  # ------------|  ./Income
]);
# ------------|  ./Users PERMISSIONS
