<?php

/**
 * User: TECH-Tag
 * Date: 08/16/2025
 * Time: 07:37 PM
 * * *
 * @author  Marthad Musa <marthad.musa@gmail.com>
 * @package https://marthadmusa.blogger.com
 */

# NameSpace  ---------------
namespace Controller;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

use \Model\Auth;
use \Model\Slider;

/**
 * Admin()
 * *
 * The Admin Page
 */
class Admin extends Controller {
  # -----| Index() | -----
  public function index() {
    // if (!Auth::logged_in()) {
    //   # ...| TRUE Block
    //   message('Please, log in!');
    //   redirect('login');
    // }
    # ---| ./IF(logged_in())

    $id = $id ?? Auth::getId();

    $user = new \Model\User();
    $data['row'] = $row = $user->first(['id'=>$id]);

    $data['title'] = "Page not found!";

    $this->view('admin/404',$data);
  }
  # ---| ./Index()\. | ---

  # -----| Dashboard() | -----
  public function dashboard() {
    // show($_SESSION['USER_DATA']);die;
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $id = $id ?? Auth::getId();

    $user = new \Model\User();
    $data['uid'] = $uid = $user->first(['id'=>$id]);
    # ---| ./User Details

    $data['students'] = $students = $user->where(['role_id'=>1]);
    $data['teachers'] = $teachers = $user->where(['role_id'=>2]);
    $data['admins']   = $admins   = $user->where(['role_id'=>3]);
    # ---| ./USERS Details

    $role = new \Model\Role();
    $roles = $role->findAll();
    $data['roles'] = array_reverse($roles);
    # ---| ./Role Details

    $course = new \Model\Course();
    $data['courses'] = $courses = $course->findAll();
    # ---| ./Course Details
    
    $course = new \Model\Exam();
    $data['exams'] = $exams = $course->findAll();
    # ---| ./Test Details

    $data['title'] = "Dashboard";

    $this->view('admin/dashboard',$data);
  }
  # ---| ./Dashboard()\. | ---

  public function cms_pages($action = null, $id = null) {
    $uid = $this->requireCmsAdmin();
    if (!$uid) {
      return;
    }

    $page_model = new \Model\Cms_page();
    $block_model = new \Model\Cms_page_block();
    if (!isset($_SESSION['cms_csrf_code'])
      || !is_string($_SESSION['cms_csrf_code'])
      || strlen($_SESSION['cms_csrf_code']) !== 64) {
      $_SESSION['cms_csrf_code'] = bin2hex(random_bytes(32));
    }
    $csrf_code = $_SESSION['cms_csrf_code'];

    try {
      $schema_ready = $page_model->schemaReady();
      $schema_error = 'CMS tables are missing. Apply the CMS page and block database migration, then reload this page.';
    } catch (\PDOException $error) {
      $this->cmsDatabaseUnavailable($error);
      return;
    }

    if (!$schema_ready) {
      http_response_code(503);
      $this->view('admin/cms-pages', [
        'uid' => $uid,
        'title' => 'Page Builder',
        'schema_error' => $schema_error,
        'csrf_code' => $csrf_code,
      ]);
      return;
    }

    $editor_page_id = ctype_digit((string)$action)
      ? (int)$action
      : ($action === 'save' ? (int)($_POST['id'] ?? 0) : 0);

    try {
      $course_target_schema_ready = $page_model->courseTargetSchemaReady();
      $course_targets = $course_target_schema_ready ? $page_model->availableCourseTargets() : [];
      $link_targets = $page_model->publishedPagesForLinks($editor_page_id);
    } catch (\PDOException $error) {
      $this->cmsDatabaseUnavailable($error);
      return;
    }

    if (in_array($action, ['publish', 'unpublish', 'delete'], true)) {
      if ($_SERVER['REQUEST_METHOD'] !== 'POST'
        || !$this->isValidCmsCsrf($_POST['csrf_code'] ?? null)) {
        http_response_code(400);
        echo $action === 'delete'
          ? 'Page deletion failed the security check.'
          : 'Page status update failed the security check.';
        return;
      }

      $page_id = (int)$id;
      try {
        $page_row = $page_model->first(['id' => $page_id]);
      } catch (\PDOException $error) {
        $this->cmsDatabaseUnavailable($error);
        return;
      }
      if (!$page_row) {
        message('CMS page not found.');
        redirect('admin/cms-pages');
      }

      if ($action === 'delete') {
        try {
          $page_model->transaction(function ($db) use ($page_id, $course_target_schema_ready) {
            $db->query(
              'DELETE FROM `cms_page_blocks` WHERE `page_id` = :page_id',
              ['page_id' => $page_id]
            );
            if ($course_target_schema_ready) {
              $db->query(
                'DELETE FROM `cms_page_course_targets` WHERE `cms_page_id` = :page_id',
                ['page_id' => $page_id]
              );
            }
            $db->query(
              'DELETE FROM `cms_pages` WHERE `id` = :page_id',
              ['page_id' => $page_id]
            );
          });
        } catch (\PDOException $error) {
          $this->cmsDatabaseUnavailable($error);
          return;
        }

        message('CMS page and its content blocks were deleted. Any mapped existing route has returned to its original page.');
        redirect('admin/cms-pages');
      }

      $status_data = [
        'status' => $action === 'publish' ? 'published' : 'draft',
        'updated_at' => date('Y-m-d H:i:s'),
      ];
      if ($action === 'publish') {
        $status_data['published_at'] = date('Y-m-d H:i:s');
      }
      try {
        $page_model->update($page_id, $status_data);
      } catch (\PDOException $error) {
        $this->cmsDatabaseUnavailable($error);
        return;
      }
      message($action === 'publish' ? 'Page published.' : 'Page unpublished.');
      redirect('admin/cms-pages');
    }

    if ($action === 'save' && $_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!$this->isValidCmsCsrf($_POST['csrf_code'] ?? null)) {
        http_response_code(400);
        echo 'Page save failed the security check.';
        return;
      }

      $page_id = (int)($_POST['id'] ?? 0);
      try {
        $page_errors = $page_model->validatePage($_POST, $page_id ?: null);
        $existing_page = $page_id > 0 ? $page_model->first(['id' => $page_id]) : false;
      } catch (\PDOException $error) {
        $this->cmsDatabaseUnavailable($error);
        return;
      }
      $block_errors = [];
      $blocks = \Model\Cms_page_block::normalizeSubmittedBlocks($_POST['blocks'] ?? [], $block_errors);
      $errors = array_merge($page_errors, $block_errors);
      if ($page_id > 0 && !$existing_page) {
        $errors['id'] = 'The CMS page being edited no longer exists.';
      }

      if (!empty($errors)) {
        $page_form = (object)[
          'id' => $page_id,
          'slug' => trim((string)($_POST['slug'] ?? '')),
          'title' => trim((string)($_POST['title'] ?? '')),
          'seo_description' => trim((string)($_POST['seo_description'] ?? '')),
          'route_key' => trim((string)($_POST['route_key'] ?? '')),
          'course_id' => trim((string)($_POST['course_id'] ?? '')),
          'status' => $existing_page->status ?? 'draft',
        ];
        $this->renderCmsEditor($uid, $page_form, $blocks, $errors, $csrf_code, $course_targets, $course_target_schema_ready, $link_targets);
        return;
      }

      $timestamp = date('Y-m-d H:i:s');
      $preserve_published_status = $existing_page && $existing_page->status === 'published';
      $page_data = [
        'slug' => trim((string)$_POST['slug']),
        'title' => trim((string)$_POST['title']),
        'seo_description' => trim((string)($_POST['seo_description'] ?? '')) ?: null,
        'route_key' => trim((string)($_POST['route_key'] ?? '')) ?: null,
        'updated_at' => $timestamp,
      ];

      try {
        $course_id = (int)($_POST['course_id'] ?? 0);
        $page_id = $page_model->transaction(function ($db) use ($page_model, $block_model, $page_id, $page_data, $blocks, $timestamp, $uid, $course_id, $course_target_schema_ready) {
          if ($page_id > 0) {
            $page_model->update($page_id, $page_data);
          } else {
            $page_data['status'] = 'draft';
            $page_data['created_by'] = (int)$uid->id;
            $page_data['created_at'] = $timestamp;
            $page_model->insert($page_data);
            $page_id = (int)$db->lastInsertId();
          }

          if ($course_target_schema_ready) {
            $page_model->saveCourseTarget($page_id, $course_id);
          }

          $db->query('DELETE FROM `cms_page_blocks` WHERE `page_id` = :page_id', ['page_id' => $page_id]);
          foreach ($blocks as $block) {
            $block['page_id'] = $page_id;
            $block['created_at'] = $timestamp;
            $block['updated_at'] = $timestamp;
            $block_model->insert($block);
          }

          return $page_id;
        });
      } catch (\PDOException $error) {
        error_log('CMS page save failed: ' . $error->getMessage());
        message((string)$error->getCode() === '23000'
          ? 'The page slug or route is already in use.'
          : 'The page could not be saved. Check the server error log.');
        redirect('admin/cms-pages');
      }

      message($preserve_published_status
        ? 'Published CMS page updated.'
        : 'CMS page saved as a draft. Publish it when it is ready.');
      redirect('admin/cms-pages/' . $page_id);
    }

    if (ctype_digit((string)$action) && (int)$action > 0) {
      try {
        $page_row = $page_model->first(['id' => (int)$action]);
        $page_blocks = $page_row ? \Model\Cms_page_block::forPage($page_row->id) : [];
        $course_target = $page_row ? $page_model->courseTargetForPage($page_row->id) : false;
      } catch (\PDOException $error) {
        $this->cmsDatabaseUnavailable($error);
        return;
      }
      if (!$page_row) {
        message('CMS page not found.');
        redirect('admin/cms-pages');
      }
      $page_row->course_id = $course_target ? (int)$course_target->id : '';
      $this->renderCmsEditor($uid, $page_row, $page_blocks, [], $csrf_code, $course_targets, $course_target_schema_ready, $link_targets);
      return;
    }

    if ($action === 'new') {
      $this->renderCmsEditor($uid, (object)[
        'id' => 0,
        'title' => '',
        'slug' => '',
        'seo_description' => '',
        'route_key' => '',
        'course_id' => '',
        'status' => 'draft',
      ], [], [], $csrf_code, $course_targets, $course_target_schema_ready, $link_targets);
      return;
    }

    try {
      $page_rows = $page_model->allForAdmin();
    } catch (\PDOException $error) {
      $this->cmsDatabaseUnavailable($error);
      return;
    }
    $this->view('admin/cms-pages', [
      'uid' => $uid,
      'title' => 'Page Builder',
      'pages' => $page_rows,
      'csrf_code' => $csrf_code,
      'course_target_schema_ready' => $course_target_schema_ready,
    ]);
  }

  public function cms_preview($id = null) {
    $uid = $this->requireCmsAdmin();
    if (!$uid) {
      return;
    }

    $page_model = new \Model\Cms_page();
    try {
      if (!$page_model->schemaReady()) {
        http_response_code(503);
        echo 'CMS database migration is required.';
        return;
      }
      $page_row = $page_model->first(['id' => (int)$id]);
      $page_blocks = $page_row ? \Model\Cms_page_block::forPage($page_row->id) : [];
    } catch (\PDOException $error) {
      $this->cmsDatabaseUnavailable($error);
      return;
    }
    if (!$page_row) {
      http_response_code(404);
      echo 'CMS page not found.';
      return;
    }
    $this->renderCmsPublicPage($page_row, true, $page_blocks);
  }

  private function requireCmsAdmin() {
    if (!Auth::logged_in()) {
      message('Please, log in!');
      redirect('login');
      return false;
    }

    $user = new \Model\User();
    $uid = $user->first(['id' => Auth::getId()]);
    if (!$uid || (int)$uid->role_id !== 3) {
      http_response_code(403);
      echo 'Administrator access required.';
      return false;
    }
    return $uid;
  }

  private function isValidCmsCsrf($submitted_token) {
    return is_string($_SESSION['cms_csrf_code'] ?? null)
      && is_string($submitted_token)
      && hash_equals($_SESSION['cms_csrf_code'], $submitted_token);
  }

  private function renderCmsEditor($uid, $page, $blocks, $errors, $csrf_code, $course_targets, $course_target_schema_ready, $link_targets) {
    $this->view('admin/cms-page-editor', [
      'uid' => $uid,
      'title' => !empty($page->id) ? 'Edit CMS Page' : 'Create CMS Page',
      'page' => $page,
      'blocks' => $blocks,
      'errors' => $errors,
      'csrf_code' => $csrf_code,
      'route_keys' => \Model\Cms_page::allowedRouteKeys(),
      'block_types' => \Model\Cms_page_block::blockTypes(),
      'animations' => \Model\Cms_page_block::animations(),
      'course_targets' => $course_targets,
      'course_target_schema_ready' => $course_target_schema_ready,
      'link_targets' => $link_targets,
    ]);
  }

  private function renderCmsPublicPage($page, $is_preview = false, $blocks = []) {
    $this->view('cms-page', [
      'title' => $page->title,
      'seo_description' => $page->seo_description ?? '',
      'cms_page' => $page,
      'cms_blocks' => $blocks,
      'is_preview' => $is_preview,
    ]);
  }

  private function cmsDatabaseUnavailable(\PDOException $error) {
    error_log('CMS database request failed: ' . $error->getMessage());
    http_response_code(503);
    echo 'CMS storage is temporarily unavailable. Check the server error log.';
  }

  # -----| Users() | -----
  public function users() {
    // show($_SESSION['USER_DATA']);die;
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $id = $id ?? Auth::getId();

    $user = new \Model\User();
    $data['uid'] = $uid = $user->first(['id'=>$id]);
    $data['users'] = $users = $user->findAll();
    $data['users'] = array_reverse($users);
    # ---| ./User Details

    $data['students'] = $students = $user->where(['role_id'=>1]);
    $data['teachers'] = $teachers = $user->where(['role_id'=>2]);
    $data['admins']   = $admins   = $user->where(['role_id'=>3]);
    # ---| ./USERS Details

    $role = new \Model\Role();
    $roles = $role->findAll();
    $data['roles'] = array_reverse($roles);
    # ---| ./Role Details

    $data['title'] = "Users";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['ajax'] ?? '') == '1') {
      if (($_POST['action'] ?? '') == 'set_role') {
        $csrf_code = $_POST['csrf_code'] ?? '';
        if (!empty($csrf_code) && $_SESSION['csrf_code'] != $csrf_code) {
          echo json_encode(['success' => false, 'message' => 'Security check failed.']);
          die;
        }

        $target_id = (int)($_POST['user_id'] ?? 0);
        $target = $user->first(['id'=>$target_id]);
        $new_role_id = (int)($_POST['role_id'] ?? $uid->role_id);

        if (!$target) {
          echo json_encode(['success' => false, 'message' => 'User not found.']);
          die;
        }

        if ($target->role_id == 3 && $uid->role_id != 3) {
          echo json_encode(['success' => false, 'message' => 'Only the super-admin can edit admin roles.']);
          die;
        }

        $user->update($target->id, ['role_id' => $new_role_id]);
        echo json_encode(['success' => true, 'message' => 'Role updated successfully.']);
        die;
      }
    }

    $this->view('admin/users',$data);
  }
  # ---| ./Users()\. | ---

  # -----| Exams() | -----
  public function exams($action = null, $id = null, $uid = null) {
    # ...| CHECK Log-in
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $user_id = Auth::getId();
    $exam = new \Model\Exam();
    $course = new \Model\Course();
    $user = new \Model\User();
    # ---| ./MODELS\. | ---

    # -----| AJAX Handlers |-----
    if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['ajax'])) {
      $ajax_action = $_POST['ajax'] ?? null;
      header('Content-Type: application/json');
      $current_user = $user->first(['id' => $user_id]);
      $current_role_id = (int)($current_user->role_id ?? 0);

      if ($ajax_action == 'request_exam_enrollment') {
        if ($current_role_id !== 1) {
          echo json_encode(['success' => false, 'message' => 'Only students can request exam enrollment.']);
          exit;
        }

        $exam_id = (int)($_POST['exam_id'] ?? 0);
        if ($exam_id <= 0) {
          echo json_encode(['success' => false, 'message' => 'Invalid exam.']);
          exit;
        }

        $request_result = $exam->transaction(function () use ($exam, $exam_id, $user_id) {
          $published_exam = $exam->query(
            'SELECT id FROM exam WHERE id = :exam_id AND approved = 1 AND published = 1 AND disabled = 0 FOR UPDATE',
            ['exam_id' => $exam_id]
          );
          if (empty($published_exam)) {
            return ['success' => false, 'message' => 'This exam is not currently available for enrollment.'];
          }

          $exam_enroll = new \Model\Exam_enroll();
          if ($exam_enroll->exists((int)$user_id, $exam_id)) {
            return ['success' => false, 'message' => 'You are already enrolled in this exam.'];
          }

          $exam_join_request = new \Model\Exam_join_request();
          $active_request = $exam_join_request->query(
            "SELECT id, status FROM exam_join_requests
             WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0 AND status IN ('Pending', 'Approved')
             ORDER BY id DESC LIMIT 1",
            ['exam_id' => $exam_id, 'user_id' => $user_id]
          );
          if (!empty($active_request)) {
            return [
              'success' => false,
              'message' => $active_request[0]->status === 'Approved'
                ? 'Your enrollment is already approved.'
                : 'Your enrollment request is already pending.',
            ];
          }

          $existing_request = $exam_join_request->query(
            'SELECT id FROM exam_join_requests
             WHERE exam_id = :exam_id AND user_id = :user_id AND disabled = 0
             ORDER BY id DESC LIMIT 1',
            ['exam_id' => $exam_id, 'user_id' => $user_id]
          );
          if (!empty($existing_request)) {
            $exam_join_request->query(
              "UPDATE exam_join_requests
               SET status = 'Pending', requested_at = :requested_at, approved_by = NULL, approved_at = NULL, notes = NULL, disabled = 0
               WHERE id = :id",
              ['requested_at' => date('Y-m-d H:i:s'), 'id' => (int)$existing_request[0]->id]
            );
          } else {
            $exam_join_request->insert([
              'exam_id' => $exam_id,
              'user_id' => $user_id,
              'status' => 'Pending',
              'requested_at' => date('Y-m-d H:i:s'),
              'disabled' => 0,
            ]);
          }

          return ['success' => true, 'message' => 'Your enrollment request has been submitted.'];
        });

        echo json_encode($request_result);
        exit;
      } elseif ($ajax_action == 'load_exam_requests') {
        # ...| Load Exam Enrollment Requests |-----
        $exam_id = (int)($_POST['exam_id'] ?? 0);
        if (!in_array($current_role_id, [2, 3], true)) {
          echo json_encode(['success' => false, 'message' => 'You are not authorized to review enrollment requests.']);
          exit;
        }

        $managed_exam = $exam->query(
          'SELECT id FROM exam WHERE id = :exam_id AND (:is_admin = 1 OR created_by = :created_by OR user_id = :user_id) LIMIT 1',
          [
            'exam_id' => $exam_id,
            'is_admin' => $current_role_id === 3 ? 1 : 0,
            'created_by' => $user_id,
            'user_id' => $user_id,
          ]
        );
        if (empty($managed_exam)) {
          echo json_encode(['success' => false, 'message' => 'Exam not found or not available to you.']);
          exit;
        }

        $exam_join_request = new \Model\Exam_join_request();
        
        $query = "SELECT ejr.*, u.firstname, u.lastname, u.email FROM exam_join_requests ejr 
                  JOIN users u ON ejr.user_id = u.id
                  WHERE ejr.exam_id = :exam_id AND ejr.disabled = 0
                  ORDER BY ejr.requested_at DESC";
        $requests = $exam_join_request->query($query, ['exam_id' => $exam_id]);
        
        $html = '';
        if ($requests) {
          foreach ($requests as $req) {
            $statusClass = $req->status == 'Approved' ? 'success' : ($req->status == 'Rejected' ? 'danger' : 'warning');
            $html .= "<tr>";
            $html .= "<td>" . htmlspecialchars($req->firstname . ' ' . $req->lastname) . "</td>";
            $html .= "<td>" . htmlspecialchars($req->email) . "</td>";
            $html .= "<td><span class='badge bg-{$statusClass}'>" . htmlspecialchars($req->status) . "</span></td>";
            $html .= "<td>";
            if ($req->status == 'Pending') {
              $html .= "<form class='request-form' data-exam-id='{$exam_id}' data-user-id='{$req->user_id}'>";
              $html .= "<select name='status' class='form-select form-select-sm' required>";
              $html .= "<option value=''>Select action...</option>";
              $html .= "<option value='Approved'>Approve</option>";
              $html .= "<option value='Rejected'>Reject</option>";
              $html .= "</select>";
              $html .= "</form>";
            } else {
              $html .= "<em>No action available</em>";
            }
            $html .= "</td>";
            $html .= "</tr>";
          }
        } else {
          $html = "<tr><td colspan='4' class='text-center text-muted'>No enrollment requests</td></tr>";
        }

        echo json_encode(['success' => true, 'html' => $html]);
        exit;
        # ---| ./Load Exam Requests\. |---
      } elseif ($ajax_action == 'update_request_status') {
        # ...| Update Enrollment Request Status |-----
        $exam_id = (int)($_POST['exam_id'] ?? 0);
        $student_id = (int)($_POST['user_id'] ?? 0);
        $status = $_POST['status'] ?? null;
        if (!in_array($current_role_id, [2, 3], true) || !in_array($status, ['Approved', 'Rejected'], true)) {
          echo json_encode(['success' => false, 'message' => 'You are not authorized to update this request.']);
          exit;
        }

        $managed_exam = $exam->query(
          'SELECT id FROM exam WHERE id = :exam_id AND (:is_admin = 1 OR created_by = :created_by OR user_id = :user_id) LIMIT 1',
          [
            'exam_id' => $exam_id,
            'is_admin' => $current_role_id === 3 ? 1 : 0,
            'created_by' => $user_id,
            'user_id' => $user_id,
          ]
        );
        if (empty($managed_exam) || $student_id <= 0) {
          echo json_encode(['success' => false, 'message' => 'Exam or student was not found.']);
          exit;
        }

        $exam_join_request = new \Model\Exam_join_request();
        $exam_enroll = new \Model\Exam_enroll();
        $pending_request = $exam_join_request->query(
          "SELECT id FROM exam_join_requests
           WHERE exam_id = :exam_id AND user_id = :student_id AND status = 'Pending' AND disabled = 0
           ORDER BY id DESC LIMIT 1",
          ['exam_id' => $exam_id, 'student_id' => $student_id]
        );
        if (empty($pending_request)) {
          echo json_encode(['success' => false, 'message' => 'No pending enrollment request was found.']);
          exit;
        }

        if ($status == 'Approved') {
          # ...| Create enrollment record
          $enrollment_data = ['user_id' => $student_id, 'exam_id' => $exam_id, 'attendance_status' => 'Absent'];
          if (!$exam_enroll->exists($student_id, $exam_id)) {
            $exam_enroll->insert($enrollment_data);
          }
        }

        # Update request status
        $query = "UPDATE exam_join_requests SET status = :status, approved_by = :approved_by, approved_at = :approved_at 
                  WHERE id = :id";
        $exam_join_request->query($query, [
          'status' => $status,
          'approved_by' => $user_id,
          'approved_at' => $status === 'Approved' ? date('Y-m-d H:i:s') : null,
          'id' => (int)$pending_request[0]->id,
        ]);

        echo json_encode(['success' => true, 'message' => 'Request ' . strtolower($status) . ' successfully']);
        exit;
        # ---| ./Update Request Status\. |---
      } elseif ($ajax_action == 'publish_exam') {
        $exam_id = (int)($_POST['exam_id'] ?? 0);

        if (!Auth::logged_in()) {
          echo json_encode(['success' => false, 'message' => 'Please log in first.']);
          exit;
        }

        $uid = $user->first(['id' => Auth::getId()]);
        if (!$uid || (int)$uid->role_id !== 3) {
          echo json_encode(['success' => false, 'message' => 'Only admins can publish exams.']);
          exit;
        }

        if ($exam_id <= 0) {
          echo json_encode(['success' => false, 'message' => 'Invalid exam id']);
          exit;
        }

        $exam = new \Model\Exam();
        $exam->query(
          "UPDATE exam SET approved = 1, published = 1 WHERE id = :id AND disabled = 0",
          ['id' => $exam_id]
        );

        echo json_encode(['success' => true, 'message' => 'Exam published successfully.']);
        exit;
      } elseif ($ajax_action == 'load_exam_results') {
        # ...| Load Exam Results for Review |-----
        $exam_id = $_POST['exam_id'] ?? null;
        $exam_result = new \Model\Exam_result();
        
        $results = $exam_result->getResultsByStatus($exam_id, 'Submitted');
        
        $html = '';
        if ($results) {
          foreach ($results as $result) {
            $html .= "<tr>";
            $html .= "<td>" . htmlspecialchars($result->user->firstname . ' ' . $result->user->lastname) . "</td>";
            $html .= "<td>" . htmlspecialchars($result->user->email) . "</td>";
            $html .= "<td>" . number_format($result->percentage, 2) . "%</td>";
            $html .= "<td>" . $result->submitted_at . "</td>";
            $html .= "<td>";
            $html .= "<button class='btn btn-sm btn-outline-success approve-result' data-exam-id='{$exam_id}' data-result-id='{$result->id}' data-user-id='{$result->user_id}'>Approve</button>";
            $html .= "</td>";
            $html .= "</tr>";
          }
        } else {
          $html = "<tr><td colspan='5' class='text-center text-muted'>No results to review</td></tr>";
        }

        echo json_encode(['success' => true, 'html' => $html]);
        exit;
        # ---| ./Load Exam Results\. |---
      } elseif ($ajax_action == 'approve_exam_result') {
        # ...| Approve Exam Result |-----
        $result_id = $_POST['result_id'] ?? null;
        $exam_id = $_POST['exam_id'] ?? null;
        $user_id = $_POST['user_id'] ?? null;
        $allow_retake = $_POST['allow_retake'] ?? 0;
        $exam_result = new \Model\Exam_result();

        $query = "UPDATE exam_results SET status = :status, reviewed_by = :reviewed_by, approved_at = :approved_at, retake_allowed = :retake_allowed 
                  WHERE id = :id";
        $exam_result->query($query, [
          'status' => 'Approved',
          'reviewed_by' => $user_id,
          'approved_at' => date('Y-m-d H:i:s'),
          'retake_allowed' => $allow_retake,
          'id' => $result_id
        ]);

        echo json_encode(['success' => true, 'message' => 'Result approved successfully']);
        exit;
        # ---| ./Approve Exam Result\. |---
      }
    }
    # ---| ./AJAX Handlers\. |---

    $question_button = '';
    $data = [];

    $uid = $uid ?? $user->first(['id'=>$user_id]);
    $data['uid'] = $uid;

    $data['action'] = $action = strtolower($action);
    $data['title'] = "Exam";

    if ($action == 'add') {
      # ...| ADD Block
      $data['courses'] = $course->findAll();

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if ($exam->validate($_POST)) {
          # ...| TRUE Block
          $_POST['exam_created_on'] = date("Y-m-d H:i:s");
          $_POST['user_id'] = $user_id;
          $_POST['created_by'] = $user_id;
          $_POST['exam_status'] = "Created";

          $exam->insert($_POST);

          message("Exam created! Please, complete EXAM information.");
          redirect('admin/exams');
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $exam->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block | Get Exam Information | -----
      $row = $exam->first(['user_id'=>$user_id,'id'=>$id]);
      $data['row'] = $row = $row;
      # ---| ./Get Exam Information\. | ---

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $query = "delete from exam where id = :id limit 1";
        $exam->query($query,['id'=>$row->id]);
        message("Exam deleted successfully!");
        redirect('admin/exams');
      } # ---| ./IF(POST)
      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block | Get Exam Information | -----
      // $row = $exam->first(['user_id'=>$user_id,'id'=>$id]);
      $query = "select * from exam where user_id = :user_id && id = :id";
      $row = $exam->query($query,['user_id'=>$user_id,'id'=>$id]);
      $data['row'] = $row = $row[0];
      # ---| ./Get Exam Information\. | ---
      
      $id = $row->id;
      $data['courses'] = $course->findAll();

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| SAVE Block 
        $exam->update($id,$_POST);
        
        message("Exam was saved successfully!");
        redirect('admin/exams');
        # ------------|  ./UPDATE()
  
        # Exam Questions  ---------------
        if ($exam->allowed_question_add($id)) {
          # ...| Adding Questions Block
          $data['question_button'] = true;
          // $question_button = `
          //   <div class="col-md-6">
          //     <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label>
          //     <button type="button" name="add_question" class="btn btn-sm btn-outline-info add_question w-100" id="`.$row->id.`"><i class="bi bi-question-circle"></i> Add Question</button>
          //   </div>
          // `;
        // } else {
          # ...| Viewing Question Block
          // $question_button = `
          //   <div class="col-md-6">
          //     <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label>
          //     <a href="`.ROOT.`/admin/question/`.$row->csrf_code.`" class="btn btn-sm btn-outline-warning w-100"></a>
          //   </div>
          // `;
        }
        # ---| ./IF/ELSE(Allowed Question Add)
      } # ---| ./IF(POST)
      # ---| ./Action=>EDIT\. |---
    } elseif ($action == 'view') {
      # ...| EDIT Block | Get Exam Information | -----
      // $row = $exam->first(['user_id'=>$user_id,'id'=>$id]);
      $query = "select * from exam where user_id = :user_id && id = :id";
      $row = $exam->query($query,['user_id'=>$user_id,'id'=>$id]);
      $data['row'] = $row = $row[0];
      # ---| ./Get Exam Information\. | ---
      
      $id = $row->id;
      $data['courses'] = $course->findAll();

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| SAVE Block 
        $exam->update($id,$_POST);
        
        message("Exam was saved successfully!");
        redirect('admin/exams');
        # ------------|  ./UPDATE()
  
        # Exam Questions  ---------------
        if ($exam->allowed_question_add($id)) {
          # ...| Adding Questions Block
          $data['question_button'] = true;
          // $question_button = `
          //   <div class="col-md-6">
          //     <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label>
          //     <button type="button" name="add_question" class="btn btn-sm btn-outline-info add_question w-100" id="`.$row->id.`"><i class="bi bi-question-circle"></i> Add Question</button>
          //   </div>
          // `;
        // } else {
          # ...| Viewing Question Block
          // $question_button = `
          //   <div class="col-md-6">
          //     <label for="add_question" class="ms-2 fontClarity">Exam Qustions</label>
          //     <a href="`.ROOT.`/admin/question/`.$row->csrf_code.`" class="btn btn-sm btn-outline-warning w-100"></a>
          //   </div>
          // `;
        }
        # ---| ./IF/ELSE(Allowed Question Add)
      } # ---| ./IF(POST)
      # ---| ./Action=>VIEW\. |---
    } else {
      # ...| EXAM MAIN PAGE Block
      $role_id = $uid->role_id ?? 1;
      
      # Load teacher's exams
      $query = "select id, exam_title, exam_datetime, exam_duration, exam_status, approved, published, exam_created_on from exam where (created_by = :created_by or user_id = :user_id) and disabled = 0 order by exam_created_on desc";
      $teacher_exams = $exam->query($query, ['created_by' => $user_id, 'user_id' => $user_id]);
      $data['role_id'] = $role_id;
      $data['teacher_exams'] = $teacher_exams;

      # Load published exams for all users
      $published_query = "select id, exam_title, exam_datetime, exam_duration, course_id, created_by from exam where approved = 1 and published = 1 and disabled = 0 order by exam_datetime asc";
      $published_exams = $exam->query($published_query);
      $data['published_exams'] = $published_exams;

      # Load student's enrolled exams
      $student_query = "select distinct e.id, e.exam_title, e.exam_datetime, e.exam_duration from exam_enroll ee 
                        join exam e on ee.exam_id = e.id 
                        where ee.user_id = :user_id and e.approved = 1 and e.published = 1 and e.disabled = 0
                        order by e.exam_datetime asc";
      $student_exams = $exam->query($student_query, ['user_id' => $user_id]);
      $data['student_exams'] = $student_exams;

      if ((int)$role_id === 1) {
        $request_rows = (new \Model\Exam_join_request())->query(
          'SELECT exam_id, status FROM exam_join_requests WHERE user_id = :user_id AND disabled = 0 ORDER BY id DESC',
          ['user_id' => $user_id]
        );
        $data['student_exam_requests'] = [];
        if (is_array($request_rows)) {
          foreach ($request_rows as $request_row) {
            if (!array_key_exists((int)$request_row->exam_id, $data['student_exam_requests'])) {
              $data['student_exam_requests'][(int)$request_row->exam_id] = $request_row->status;
            }
          }
        }

        $enrolled_rows = (new \Model\Exam_enroll())->query(
          'SELECT exam_id FROM exam_enroll WHERE user_id = :user_id',
          ['user_id' => $user_id]
        );
        $data['student_enrolled_exam_ids'] = [];
        if (is_array($enrolled_rows)) {
          foreach ($enrolled_rows as $enrolled_row) {
            $data['student_enrolled_exam_ids'][(int)$enrolled_row->exam_id] = true;
          }
        }
      }

      # Load pending exams for admin approval (only for admins)
      if ($role_id == 3) {
        $pending_query = "select id, exam_title, created_by, exam_created_on from exam where approved = 0 and published = 0 and disabled = 0 order by exam_created_on desc";
        $pending_exams = $exam->query($pending_query);
        $data['pending_exams'] = $pending_exams;
      }

      # ---| ./EXAM MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(Action)

    $this->view('admin/exams',$data);
  }
  # ---| ./Exams()\. | ---

  # -----| Question() | -----
  public function question($action = null, $id = null, $uid = null, $target_question = null, $target_exam = null) {
    # ...| CHECK Log-in
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $user_id = Auth::getId();
    $exam = new \Model\Exam();
    $question = new \Model\Question();
    $question_option = new \Model\Question_option();
    $question_asset = new \Model\Question_asset();
    $question_rubric = new \Model\Question_rubric();
    $user = new \Model\User();
    # ---| ./MODELS\. | ---

    $data = [];

    if ($action !== null && ctype_digit((string)$action)) {
      $id = $action;
      $action = null;
    }

    $action = strtolower((string)$action);
    $target_id = ctype_digit((string)$id) ? (int)$id : 0;
    $target_exam = $target_id > 0 ? $exam->first(['id' => $target_id]) : false;

    $uid = $uid ?? $user->first(['id'=>$user_id]);
    $data['uid'] = $uid;

    $data['action'] = $action;
    $data['title'] = "Questions";

    if ($action == 'add') {
      # ...| ADD Block
      if (!$target_exam) {
        message('Exam not found.');
        redirect('admin/exams');
      }
      $data['target_id'] = $target_id;

      $data['target_exam'] = $target_exam;

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($target_exam && (string)$target_id === (string)($_POST['exam_id'] ?? '') && ($_POST['add_question'] ?? '') === 'save') {
          if ($question->validate($_POST)) {
            $question_payload = $question->to_question_data($_POST);
            $question->insert([
              'exam_id' => (int)$target_id,
              'question_type' => $question_payload['question_type'],
              'question_title' => trim($_POST['question_title']),
              'question_data' => json_encode($question_payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
              'answer_option' => (string)($question_payload['answer_option'] ?? '1'),
            ]);

            $question_id = (int)$question->lastInsertId();
            if ($question_id > 0) {
              $option_count = in_array($question_payload['question_type'], ['true_false', 'yes_no'], true) ? 3 : 4;
              for ($option_number = 1; $option_number <= $option_count; $option_number++) {
                if (isset($question_payload['options'][$option_number])) {
                  $question_option->insert([
                    'question_id' => $question_id,
                    'option_number' => $option_number,
                    'option_title' => trim($question_payload['options'][$option_number]),
                  ]);
                }
              }

              $asset_fields = [
                'audio' => 'audio_file',
                'image' => 'image_file',
                'diagram' => 'diagram_file',
              ];

              foreach ($asset_fields as $asset_type => $field_name) {
                if (!empty($_FILES[$field_name]['name']) && ($_FILES[$field_name]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
                  try {
                    $question->save_uploaded_question_asset($question_id, $asset_type, $_FILES[$field_name], $_POST['audio_caption'] ?? ($_POST['image_caption'] ?? ($_POST['diagram_caption'] ?? '')));
                  } catch (\Throwable $e) {
                    $question->errors['file_' . $asset_type] = $e->getMessage();
                  }
                }
              }

              if (in_array($question_payload['question_type'], ['writing_prompt', 'speaking_prompt'], true)) {
                $rubric_text = trim((string)($question_payload['rubric_text'] ?? ''));
                if ($rubric_text !== '') {
                  $question_rubric->insert([
                    'question_id' => $question_id,
                    'rubric_type' => trim((string)($_POST['rubric_type'] ?? ($question_payload['question_type'] === 'writing_prompt' ? 'writing' : 'speaking'))),
                    'band_score' => (int)($_POST['band_score'] ?? 0),
                    'criteria' => $rubric_text,
                    'notes' => trim((string)($_POST['rubric_notes'] ?? '')),
                  ]);
                }
              }

              message('Question added successfully!');
              redirect('admin/question/'.$target_id);
            }

            $question->errors['question_title'] = 'The question could not be saved. Please try again.';
          }
        }
        $data['errors'] = $question->errors;
      }
      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block
      $target_question = $target_id;
      $data['target_question'] = $target_question;
      // $data['target_id'] = $target_id = $rows->exam_id;
      $data['question_options'] = $question_options = $question_option->where(['question_id'=>$target_question]);

      $data['rows'] = $rows = $question->where(['id'=>$target_question]);
      # ---| ./Get Question Information\. | ---

      if (!empty($rows)) {
        # ...| ROWS Block
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
          # ...| DELETE Options Block
          $question_option->query(
            'DELETE FROM question_option WHERE question_id = :question_id',
            ['question_id' => $target_question]
          );
          $question->delete((int)$target_question);
          # ---| ./IF(Option)

          message("Question successfully deleted!");
          redirect('admin/exams');
        }
        # ---| ./IF(SERVER)
      } # ---| ./IF(ROWS)
      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block
      $data['target_id'] = $target_id;
      $question_options = $question_option->where(['question_id'=>$target_id]);
      if (!empty($question_options)) {
        # ...| TRUE Block
        $question_options = array_reverse($question_options);
        $data['question_options'] = $question_options;
      }
      # ---| ./IF(Question Options)

      $exam_rows = $exam->findAll('asc');
      $data['exam_rows'] = is_array($exam_rows) ? array_reverse($exam_rows) : [];

      $data['rows'] = $rows = $question->first(['id'=>$target_id]);
      $Update = false;
      $option_inputs = [];

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($rows)) {
        # ...| Post Block
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "save") {
          # ...| Data_type = Save Block | Update Question Table |...
          $question->update($target_id,$_POST);
          $info['data'] = "";

          $options = [
            'option_number_1' => $_POST['option_number_1'],
            'option_number_2' => $_POST['option_number_2'],
            'option_number_3' => $_POST['option_number_3'],
            'option_number_4' => $_POST['option_number_4'],
          ];

          if (!empty($question_options)) {
            # ...| Check if Record is Not Empty (Update)
            $query = "update question_option set option_title = :option_title where question_id = :question_id && option_number = :option_number";

            # ...| Insert into Question Option Table |...
            for ($i=1; $i < 5; $i++) { 
              $result = $question_option->query(
                $query,[
                  'question_id'=>$target_id,
                  'option_number'=>$i,
                  'option_title'=>$options['option_number_'.$i]
                ]
              );
            }
            # ---| ./FOR(Result)
          } else {
            # ...| If Record is Empty (Insert)
            $query = "insert into question_option (question_id,option_number,option_title) values (:question_id,:option_number,:option_title)";

            # ...| Insert into Question Option Table |...
            foreach ($options as $key => $option) {
              # ...| Insert New Record
              $option_inputs = [
                'option_number'=>str_replace('option_number_','',$key),
                'option_title'=>$_POST['option_number'.str_replace('option_number','',$key)]
              ];
              $result = $question_option->query($query,['question_id'=>$target_id,'option_number'=>$option_inputs['option_number'],'option_title'=>$option_inputs['option_title']]);
            }
            # ---| ./FOREACH(Options)
          }
          # ---| ./IF/ELSE(Options)

          $info['data_type'] = "save";
          $info['data_url'] = $rows->exam_id;
          echo json_encode($info);die;

          // if ($Update) {
          //   # ...| Everything SAVED
          //   message("Your question was updated seccessfully!");
          //   redirect('admin/question/'.$rows->exam_id);
          // }
          // # ---| ./IF(EDIT Result)
        }
        # ---| ./IF(Data_Type = SAVE)

        // die;
      }
      # ---| ./IF(POST)

      $data['errors'] = $question->errors;

      # ---| ./Action=>EDIT\. |---
    } elseif ($action == 'view') {
      # ...| EDIT Block
      $data['target_id'] = $target_id;
      $question_options = $question_option->where(['question_id'=>$target_id]);
      if (!empty($question_options)) {
        # ...| TRUE Block
        $question_options = array_reverse($question_options);
        $data['question_options'] = $question_options;
      }
      # ---| ./IF(Question Options)

      $exam_rows = $exam->findAll('asc');
      $data['exam_rows'] = is_array($exam_rows) ? array_reverse($exam_rows) : [];

      $data['rows'] = $rows = $question->first(['id'=>$target_id]);

      $data['errors'] = $question->errors;
      # ---| ./Action=>EDIT\. |---
    } else {
      # ...| Question MAIN PAGE Block
      if (!$target_exam) {
        message('Exam not found.');
        redirect('admin/exams');
      }
      $data['target_id'] = $target_id;

      $query = "select * from question where exam_id = :exam_id";
      $rows = $question->query($query,['exam_id'=>$target_id]);
      $data['rows'] = $rows;
      $data['exam_total_question'] = $exam_total_question = (int)$exam->get_exam_question_limit($target_id);
    }
    # ---| ./IF/ELSE(Action)

    $this->view('admin/question',$data);
  }
  # ---| ./Question()\. | ---

  # -----| Courses() | -----
  public function courses($action = null, $id = null, $uid = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $uid = $uid;
    $user_id = Auth::getId();
    $course = new \Model\Course();
    $category = new \Model\Category();
    $language = new \Model\Language_model();
    $level = new \Model\Level_model();
    $price = new \Model\Price_model();
    $currency = new \Model\Currency_model();
    $user = new \Model\User();
    # ---| ./MODELS\. | ---

    $data = [];

    // Refresh date-driven course status logic in controllers.
    update_course_status_from_date();

    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    $data['row'] = $row = $user->first(['id'=>$user_id]);

    $data['action'] = $action;
    $data['id'] = $id;
    $data['title'] = "Courses";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['ajax'] ?? '') == '1') {
      if (($_POST['action'] ?? '') == 'set_course_status') {
        $csrf_code = $_POST['csrf_code'] ?? '';
        if (!empty($csrf_code) && $_SESSION['csrf_code'] != $csrf_code) {
          echo json_encode(['success' => false, 'message' => 'Security check failed.']);
          die;
        }

        $course_id = (int)($_POST['course_id'] ?? 0);
        $status = trim($_POST['status'] ?? '');
        $row = $course->first(['id'=>$course_id]);

        if (!$row) {
          echo json_encode(['success' => false, 'message' => 'Course not found.']);
          die;
        }

        $flags = course_status_flags($status);
        $course->update($row->id, $flags);

        echo json_encode(['success' => true, 'message' => 'Course status updated to '.$status]);
        die;
      }
    }

    if ($action == 'add') {
      # ...| ADD Block
      $data['categories'] = $category->findAll('asc');

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if ($course->validate($_POST)) {
          # ...| TRUE Block
          $_POST['create_date'] = date("Y-m-d H:i:s");
          $_POST['user_id'] = $user_id;
          // $_POST['price_id'] = 1;

          $base_slug = str_to_url($_POST['title']);
          $slug = $base_slug;
          $counter = 2;

          while ($course->first(['slug' => $slug])) {
            $slug = $base_slug.'-'.$counter;
            $counter++;
          }
          # ---| ./WHILE(SLUG)

          $_POST['slug'] = $slug;

          $course->insert($_POST);

          /**
           * To fetch the very LAST Course inserted by THIS EXACT USER
           */
          $row = $course->first(['user_id'=>$user_id,'published'=>0]);
          message("Your course was created seccessfully!");

          if ($row) {
            # ...| TRUE Block
            redirect('admin/courses/edit/'.$row->id);
          } else {
            # ...| FALSE Block
            message("There's was an issue and your course was not created!");
            redirect('admin/courses');
          }
          # ---| ./IF/ELSE(ROW)
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $course->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block
      $categories = $category->findAll('asc');
      $languages = $language->findAll('asc');
      $levels = $level->findAll('asc');
      $prices = $price->findAll('asc');
      $currencies = $currency->findAll('asc');

      # -----| Get Course Information | -----
      $data['row'] = $row = $course->first(['user_id'=>$user_id, 'id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $course_meta = new \Model\Course_meta();
        $course_lecture = new \Model\Course_lecture();

        $meta_rows = $course_meta->where(['course_id'=>$row->id]);
        if ($meta_rows) {
          foreach ($meta_rows as $meta_row) {
            if (!empty($meta_row->lectures_row)) {
              foreach ($meta_row->lectures_row as $lecture) {
                $course_lecture->delete($lecture->id);
              }
            }
            $course_meta->delete($meta_row->id);
          }
        }

        $course->delete($row->id);
        message("Courses deleted successfully!");
        redirect('admin/courses');
      } # ---| ./IF(POST)
      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'status') {
      # ...| STATUS Block
      $data['row'] = $row = array_reverse($course->first(['id'=>$id]));

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        $status = $_POST['status'] ?? '';
        $flags = course_status_flags($status);
        $course->update($row->id, $flags);
        message("Course status updated to $status");
        redirect('admin/courses');
      }
      # ---| ./Action=>STATUS\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block
      $database = new \Database();
      $database->ensure_course_subcategories();
      $data['categories'] = $categories = array_reverse($category->findAll('asc'));
      $data['languages'] = $languages = array_reverse($language->findAll('asc'));
      $data['levels'] = $levels = array_reverse($level->findAll('asc'));
      $data['prices'] = $prices = array_reverse($price->findAll('asc'));
      $data['currencies'] = $currencies = array_reverse($currency->findAll('asc'));

      /**
       * --------------------------
       * | Get Course Information |
       * --------------------------
       */
      $data['row'] = $row = $course->first(['user_id'=>$user_id, 'id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "read") {
          # ...| READ Process Block
          if ($_POST['tab_name'] == "intended-learners") {
            # ...| Intended Learners Block
            include views_path('course-edit-tabs/intended-learners');
          } else
          if ($_POST['tab_name'] == "curriculum") {
            # ...| Curriculum Block
            include views_path('course-edit-tabs/curriculum');
          } else
          if ($_POST['tab_name'] == "course-landing-page") {
            # ...| Course Landing Page Block
            $promo_video_model = new \Model\Course_promo_video();
            $promo_video_schema_ready = $promo_video_model->schemaReady();
            $promo_video_captions = array_fill(1, 5, '');
            $promo_video_titles = array_fill(1, 5, '');
            $promo_video_rows = [];
            if ($promo_video_schema_ready) {
              try {
                foreach ($promo_video_model->forCourse((int)$id) as $promo_video_row) {
                  $promo_video_slot = (int)$promo_video_row->video_slot;
                  if ($promo_video_slot >= 1 && $promo_video_slot <= 5) {
                    $promo_video_captions[$promo_video_slot] = $promo_video_row->caption ?? '';
                    $promo_video_titles[$promo_video_slot] = $promo_video_row->video_title ?? '';
                    if ($promo_video_slot >= 2) {
                      $promo_video_rows[$promo_video_slot] = $promo_video_row;
                    }
                  }
                }
              } catch (\PDOException $error) {
                error_log('Course promotional video editor data unavailable: ' . $error->getMessage());
                $promo_video_schema_ready = false;
              }
            }
            include views_path('course-edit-tabs/course-landing-page');
          } else
          if ($_POST['tab_name'] == "course-duration") {
            # ...| Promotion Block
            include views_path('course-edit-tabs/course-duration');
          } else
          if ($_POST['tab_name'] == "course-messages") {
            # ...| Course Messages Block
            include views_path('course-edit-tabs/course-messages');
          }
          # ---| ./IF/ELSE/IF(Tab_Name)
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "get-meta") {
          # ...| Get-Meta Process Block
          $course_meta = new \Model\Course_meta();

          $rows = $course_meta->where(['course_id'=>$_POST['course_id'],'disabled'=>0]);

          $info['data'] = [];
          if ($rows) {
            # ...| TRUE Block
            $course_lecture = new \Model\Course_lecture;

            foreach ($rows as $akey => $course_meta_row) {
              $row_lectures = $course_lecture->where(['unid'=>$course_meta_row->unid,'disabled'=>0]);

              if ($row_lectures) {
                # ...| TRUE Block
                foreach ($row_lectures as $vid_key => $vid_row) {
                  $row_lectures[$vid_key]->base_file = $vid_row->file;
                  $row_lectures[$vid_key]->file = !empty($vid_row->file)
                    ? ROOT . '/admin/lesson_media/' . (int)$vid_row->id
                    : '';
                }
                # ---| ./FOREACH(ROW Lectures)

                $rows[$akey]->lectures = $row_lectures;
              }
              # ---| ./IF(Row Lectures)
            }
            # ---| ./FOREACH(Rows)

            $info['data'] = $rows;
          }
          # ---| ./IF(ROWS)

          $info['data_type'] = "get-meta";

          echo json_encode($info);
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "save") {
          # ...| SAVE Process Block | \Check if Form is Valid, Invalide, Expired, Took Too-Long Time/ |------ **/
          if ($_SESSION['csrf_code'] == $_POST['csrf_code']) {
            # ...| TRUE Block
            if ($course->edit_validate($_POST,$id,$_POST['tab_name'])) {
              # ...| TAB SAVE Block
              if ($_POST['tab_name'] == "intended-learners") {
                # ...| TAB: (Intended Learners) Block
                $course_meta = new \Model\Course_meta();
                $meta_data = [];

                foreach ($_POST as $key => $value) {
                  if (!empty($value) && preg_match("/^[a-zA-Z\-]+_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $key = preg_replace("/_[0-9]+$/", "", $key);
                    $meta_data[$key][] = $value;
                  }
                  # ---| ./IF(Meta_DATA)
                }
                # ---| ./FOREACH()

                /**
                 * ------------------------------------------------
                 * | Disable All Records from a Certain Course_ID |
                 * ------------------------------------------------
                 */
                $old_records = $course_meta->where(['course_id'=>$id,'tab'=>$_POST['tab_name']]);
                $old_ids = [];
                if ($old_records) {
                  # ...| TRUE Block
                  $old_ids = array_column($old_records, 'id');
                  foreach ($old_records as $record) {
                    $course_meta->update($record->id,['disabled'=>1]);
                  }
                  # ---| ./FOREACH(Old_Records)
                }
                # ---| ./IF(Old_Records)

                if (!empty($meta_data)) {
                  # ...| True Block
                  foreach ($meta_data as $key => $rows) {
                    # ...| Grouping the KEY as a Column
                    $data_type = $key;
                    foreach ($rows as $value) {
                      $arr = [];
                      $arr['tab'] = $_POST['tab_name'];
                      $arr['data_type'] = $data_type;
                      $arr['course_id'] = $id;
                      $arr['value'] = $value;
                      // $arr['unid'] = $_POST['unid'];
                      $arr['disabled'] = 0;
                      
                      if (count($old_ids) > 0) {
                        # ...| TRUE Block | UPDATE |---
                        $my_old_ids = array_pop($old_ids);
                        $course_meta->update($my_old_ids, $arr);
                      } else {
                        # ...| FALSE Block | INSERT |---
                        $arr['unid'] = time().rand(100,999);
                        /**
                         * Check if the UniqueID is not stored in DB
                        */
                        while ($course_meta->where(['unid'=>$arr['unid']])) {
                          $arr['unid'] = time().rand(100,999);
                        }
                        # ---| ./WHILE(UNID)
                        $course_meta->insert($arr);
                      }
                      # ---| ./IF/ELSE(Old_IDs)
                    }
                    # ---| ./FOREACH(ROWS)
                  }
                  # ---| ./FOREACH(Meta_data)
                }
                # ---| ./ IF(Meta_data)

                $info['data'] = "Course saved successfully!";
                $info['data_type'] = "save";
              } else
              if ($_POST['tab_name'] == "curriculum") {
                # ...| TAB: (Curriculum) Block
                $course_meta = new \Model\Course_meta();
                $course_lecture = new \Model\Course_lecture;
                if (!$course_lecture->duration_schema_ready()) {
                  $info['errors'] = [
                    'curriculum' => 'Apply the course-duration migration before saving curriculum videos. No curriculum data was changed.',
                  ];
                  $info['data'] = "Course duration database migration is required.";
                  $info['data_type'] = "save";
                  echo json_encode($info);
                  return;
                }

                $has_article = false;
                foreach ($_POST as $field => $value) {
                  if (preg_match('/^item_type_lecture_[0-9]+_curriculum_[0-9]+$/', $field)
                    && $value === 'article') {
                    $has_article = true;
                    break;
                  }
                }
                $article_schema_ready = $course_lecture->article_schema_ready();
                if ($has_article && !$article_schema_ready) {
                  $info['errors'] = [
                    'curriculum' => 'Apply the lesson article migration before saving article lessons. No curriculum data was changed.',
                  ];
                  $info['data'] = "The lesson article database migration is required.";
                  $info['data_type'] = "save";
                  echo json_encode($info);
                  return;
                }

                $meta_data = [];
                $meta_data_unids = [];
                $meta_data_descriptions = [];
                $meta_data_index = [];

                $lecture_data = [];
                $lecture_data_unids = [];
                $lecture_data_descriptions = [];
                $lecture_data_types = [];
                $lecture_data_durations = [];
                $lecture_data_previews = [];
                $lecture_data_content = [];
                $lecture_data_new_files = [];
                $lecture_data_index = [];
                $uploaded_lesson_files = [];

                foreach ($_POST as $key => $value) {
                  /**
                   * ----------------
                   * | For Curriculum Sections |
                   * ----------------
                   */
                  if (!empty($value) && preg_match("/^curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $mainkey = preg_replace("/_[0-9]+$/", "", $key);
                    $subkey = preg_replace("/^curriculum_/", "", $key);
                    $meta_data[$mainkey][$subkey] = $value;
                  } else
                  # ---| ./IF(Meta_DATA)

                  if (!empty($value) && preg_match("/^unid_curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $mainkey = preg_replace("/_[0-9]+$/", "", $key);
                    $subkey = preg_replace("/^unid_curriculum_/", "", $key);
                    $meta_data_unids[$mainkey][$subkey] = $value;
                  } else
                  # ---| ./IF(Meta_DATA)

                  if (!empty($value) && preg_match("/^description_curriculum_[0-9]+$/", $key)) {
                    # ...| TRUE Block
                    $mainkey = preg_replace("/_[0-9]+$/", "", $key);
                    $subkey = preg_replace("/^description_curriculum_/", "", $key);
                    $meta_data_descriptions[$mainkey][$subkey] = $value;
                  }
                  # ---| ./IF/ELSE/IF(Meta_DATA)

                  /**
                   * ----------------
                   * | For Lectures |
                   * ----------------
                   */
                  if (preg_match("/^lecture_([0-9]+)_curriculum_([0-9]+)$/", $key, $matches)) {
                    $lecture_data[$matches[2]][$matches[1]] = trim($value);
                  }
                  # ---| ./IF(Curriculum)

                  if (preg_match("/^description_lecture_([0-9]+)_curriculum_([0-9]+)$/", $key, $matches)) {
                    $lecture_data_descriptions[$matches[2]][$matches[1]] = trim($value);
                  }
                  # ---| ./IF(Lecture Description)

                  if (preg_match("/^item_type_lecture_([0-9]+)_curriculum_([0-9]+)$/", $key, $matches)) {
                    $lecture_data_types[$matches[2]][$matches[1]] = $value;
                  }

                  if (preg_match("/^duration_minutes_lecture_([0-9]+)_curriculum_([0-9]+)$/", $key, $matches)) {
                    $lecture_data_durations[$matches[2]][$matches[1]] = $value;
                  }

                  if (preg_match("/^is_preview_lecture_([0-9]+)_curriculum_([0-9]+)$/", $key, $matches)) {
                    $lecture_data_previews[$matches[2]][$matches[1]] = $value;
                  }

                  if (preg_match("/^content_html_lecture_([0-9]+)_curriculum_([0-9]+)$/", $key, $matches)) {
                    $lecture_data_content[$matches[2]][$matches[1]] = (string)$value;
                  }

                }
                # ---| ./FOREACH()

                foreach ($lecture_data_types as $section_index => $section_types) {
                  foreach ($section_types as $item_index => $item_type) {
                    if ($item_type !== 'article') {
                      continue;
                    }
                    $article_html = $lecture_data_content[$section_index][$item_index] ?? '';
                    if (strlen($article_html) > 1000000) {
                      $info['errors'] = ['curriculum' => 'Article content must be no more than 1 MB.'];
                      $info['data'] = "Please shorten the lesson article and try again.";
                      $info['data_type'] = "save";
                      echo json_encode($info);
                      return;
                    }
                    $sanitized_html = \Model\Cms_page_block::sanitizeRichText($article_html);
                    if ($sanitized_html === null) {
                      $info['errors'] = ['curriculum' => 'Article sanitization is unavailable. Enable PHP DOM support before saving article lessons.'];
                      $info['data'] = "The lesson article could not be safely sanitized.";
                      $info['data_type'] = "save";
                      echo json_encode($info);
                      return;
                    }
                    $lecture_data_content[$section_index][$item_index] = $sanitized_html;
                  }
                }

                foreach ($_FILES as $new_key => $file) {
                  if (!preg_match('/^new_file_lecture_([0-9]+)_curriculum_([0-9]+)$/', $new_key, $matches)
                    || empty($file['name'])) {
                    continue;
                  }
                  $item_index = $matches[1];
                  $section_index = $matches[2];
                  $item_type = $lecture_data_types[$section_index][$item_index] ?? 'video';
                  $upload = $course_lecture->store_lesson_upload($file, $item_type);
                  if ($upload['error'] !== null) {
                    foreach ($uploaded_lesson_files as $uploaded_path) {
                      if (is_file($uploaded_path)) {
                        unlink($uploaded_path);
                      }
                    }
                    $info['errors'] = ['curriculum' => $upload['error']];
                    $info['data'] = "Please choose a valid lesson file and try again.";
                    $info['data_type'] = "save";
                    echo json_encode($info);
                    return;
                  }
                  $lecture_data_new_files[$section_index][$item_index] = $upload['path'];
                  $uploaded_lesson_files[] = $upload['path'];
                }

                /**
                 * ------------------------------------------------
                 * | Disable All Records from a Certain Course_ID |
                 * ------------------------------------------------
                 */
                $old_records = $course_meta->where(['course_id'=>$id,'tab'=>$_POST['tab_name']]);
                $old_ids = [];
                if ($old_records) {
                  # ...| TRUE Block
                  $old_ids = array_column($old_records, 'id');
                  foreach ($old_records as $record) {
                    $course_meta->update($record->id,['disabled'=>1]);
                  }
                  # ---| ./FOREACH(Old_Records)
                }
                # ---| ./IF(Old_Records)

                if (!empty($meta_data)) {
                  # ...| True Block
                  foreach ($meta_data as $key => $rows) {
                    # ...| Grouping the KEY as a Column
                    $data_type = $key;
                    foreach ($rows as $key2 => $value) {
                      $arr = [];
                      $arr['data_type'] = $data_type;
                      $arr['course_id'] = $id;
                      $arr['value'] = $value;
                      $arr['disabled'] = 0;
                      $arr['tab'] = $_POST['tab_name'];

                      if (!empty($meta_data_unids['unid_'.$key][$key2])) {
                        # ... TRUE Block
                        $arr['unid'] = $meta_data_unids['unid_'.$key][$key2];
                      }

                      if (!empty($meta_data_descriptions['description_'.$key][$key2])) {
                        # ... TRUE Block
                        $arr['description'] = $meta_data_descriptions['description_'.$key][$key2];
                      }
                      # ---| ./IF()

                      if (count($old_ids) > 0) {
                        # ...| TRUE Block | UPDATE |---
                        $my_old_ids = array_pop($old_ids);
                        $course_meta->update($my_old_ids, $arr);
                      } else {
                        # ...| FALSE Block | INSERT |---
                        $arr['unid'] = time().rand(100,999);
                        /**
                         * ---------------------------------------------
                         * | Check if the UniqueID is not stored in DB |
                         * ---------------------------------------------
                        */
                        while ($course_meta->where(['unid'=>$arr['unid']])) {
                          $arr['unid'] = time().rand(100,999);
                        }
                        # ---| ./WHILE(UNID)

                        $course_meta->insert($arr);
                      }
                      # ---| ./IF/ELSE(Old_IDs)

                      /**
                       * --------------------------
                       * | SAVE to Lectures Table |
                       * --------------------------
                       */
                      if (!empty($lecture_data[$key2])) {
                        # ...| TRUE Block
                        $myunid = $arr['unid'] ?? time().rand(100,999);

                        /**
                         * --------------------------------------------------
                         * | Disable All Records from Course Lectures Table |
                         * --------------------------------------------------
                         */
                        $old_lecture_records = $course_lecture->where(['unid'=>$myunid]);
                        $old_lecture_ids = [];
                        $old_lecture_file_by_id = [];
                        if ($old_lecture_records) {
                          # ...| TRUE Block
                          $old_lecture_ids = array_column($old_lecture_records, 'id');

                          foreach ($old_lecture_records as $record) {
                            $old_lecture_file_by_id[$record->id] = $record->file;
                            $course_lecture->update($record->id,['disabled'=>1]);
                          }
                          # ---| ./FOREACH(Old_Records)
                        }
                        # ---| ./IF(Old_Records)

                        foreach ($lecture_data[$key2] as $key3 => $lec_title) {
                          if ($lec_title === '') {
                            continue;
                          }

                          # ...| Lectures Block
                          $arr = [];
                          $arr['unid'] = $myunid;
                          $arr['disabled'] = 0;
                          $arr['title'] = $lec_title;
                          $arr['description'] = $lecture_data_descriptions[$key2][$key3] ?? "";
                          $arr['item_type'] = $lecture_data_types[$key2][$key3] ?? 'video';
                          $arr['duration_minutes'] = ($lecture_data_durations[$key2][$key3] ?? '') !== ''
                            ? (int)$lecture_data_durations[$key2][$key3]
                            : null;
                          $arr['is_preview'] = !empty($lecture_data_previews[$key2][$key3]) ? 1 : 0;
                          $arr['file'] = $lecture_data_new_files[$key2][$key3] ?? "";
                          if ($article_schema_ready) {
                            $arr['content_html'] = $lecture_data_content[$key2][$key3] ?? '';
                          }

                          $delete_old_file = false;
                          $old_filename = "";
                          if (count($old_lecture_ids) > 0) {
                            # ...| TRUE Block | UPDATE |---
                            $my_old_lecture_ids = array_pop($old_lecture_ids);
                            $old_filename = $old_lecture_file_by_id[$my_old_lecture_ids] ?? '';
                            if (empty($arr['file'])) {
                              $arr['file'] = $old_filename;
                            } else {
                              $delete_old_file = $arr['file'] !== $old_filename;
                            }
                            if ($arr['item_type'] !== 'video' || $delete_old_file) {
                              $arr['duration_seconds'] = null;
                            }
                            $course_lecture->update($my_old_lecture_ids, $arr);

                            /**
                             * ---------------------------------
                             * | Delete Old Video Files exists |
                             * ---------------------------------
                             */
                            $old_real_path = $old_filename !== '' ? realpath($old_filename) : false;
                            $lesson_upload_root = realpath('uploads/courses/lessons');
                            $legacy_upload_root = realpath('uploads/courses');
                            $is_managed_upload = $old_real_path
                              && (($lesson_upload_root && dirname($old_real_path) === $lesson_upload_root)
                                || ($legacy_upload_root && dirname($old_real_path) === $legacy_upload_root));
                            if ($delete_old_file && $is_managed_upload && is_file($old_real_path)) {
                              unlink($old_real_path);
                            }
                            # ---| ./IF(Delete_Old_File)
                          } else {
                            # ...| FALSE Block | SAVE |---
                            $arr['file'] = $lecture_data_new_files[$key2][$key3] ?? '';
                            $arr['duration_seconds'] = null;
                            $course_lecture->insert($arr);
                          }
                          # ---| ./IF/ELSE(Old_IDs)
                        }
                        # ---| ./FOREACH(Lecture Name)
                      }
                      # ---| ./IF(Lecture)
                    }
                    # ---| ./FOREACH(ROWS)
                  }
                  # ---| ./FOREACH(Meta_data)
                }
                # ---| ./ IF(Meta_data)

                $video_lessons = $course_lecture->query(
                  "SELECT DISTINCT `cl`.`id`, `cl`.`file`, `cl`.`duration_seconds`
                   FROM `courses_lectures` AS `cl`
                   INNER JOIN `courses_meta` AS `cm` ON `cm`.`unid` = `cl`.`unid`
                   WHERE `cm`.`course_id` = :course_id
                     AND `cm`.`tab` = 'curriculum'
                     AND `cm`.`disabled` = 0
                     AND `cl`.`disabled` = 0
                     AND `cl`.`item_type` = 'video'",
                  ['course_id' => $id]
                );
                $total_video_seconds = 0;
                $unmeasured_video_count = 0;
                $video_measurement_deadline = microtime(true) + 20;
                foreach ($video_lessons ?: [] as $video_lesson) {
                  $duration_seconds = (int)($video_lesson->duration_seconds ?? 0);
                  if (empty($video_lesson->file)
                    || !is_file($video_lesson->file)
                    || !is_readable($video_lesson->file)) {
                    if ($duration_seconds > 0) {
                      $course_lecture->update($video_lesson->id, ['duration_seconds' => null]);
                    }
                    $unmeasured_video_count++;
                    continue;
                  }
                  if ($duration_seconds <= 0) {
                    if (microtime(true) >= $video_measurement_deadline) {
                      $unmeasured_video_count++;
                      continue;
                    }
                    $measurement = $course_lecture->measure_video_duration_seconds($video_lesson->file ?? '');
                    if ($measurement['seconds'] === null) {
                      $unmeasured_video_count++;
                      continue;
                    }

                    $duration_seconds = $measurement['seconds'];
                    $course_lecture->update($video_lesson->id, [
                      'duration_seconds' => $duration_seconds,
                    ]);
                  }

                  $total_video_seconds += $duration_seconds;
                }

                $course->update($id, [
                  'course_timeline' => $unmeasured_video_count === 0
                    ? round($total_video_seconds / 3600, 2)
                    : null,
                ]);

                $info['data'] = $unmeasured_video_count > 0
                  ? "Curriculum saved. Video/content hours could not be calculated because {$unmeasured_video_count} active video lesson(s) have no readable measured duration. Check the video files and ensure FFprobe is installed and available to PHP."
                  : "Course curriculum saved. Video/content hours were recalculated from active video lessons.";
                $info['data_type'] = "save";
              } else
              if ($_POST['tab_name'] == "course-landing-page") {
                # ...| TAB: (Course Landing Page) Block
                $landing_fields = [
                  'title',
                  'subtitle',
                  'description',
                  'language_id',
                  'sub_category_id',
                  'category_id',
                  'currency_id',
                  'price_id',
                  'primary_subject',
                ];
                $update_data = array_intersect_key($_POST, array_flip($landing_fields));
                $old_course_image = '';

                if (!empty($row->course_image_tmp) && file_exists($row->course_image_tmp) && $row->csrf_code == ($_POST['csrf_code'] ?? '')) {
                  $old_course_image = $row->course_image ?? '';
                  $update_data['course_image'] = $row->course_image_tmp;
                  $update_data['course_image_tmp'] = '';
                }
    
                $effective_category_id = $update_data['category_id'] ?? ($row->category_id ?? null);
                if (!empty($effective_category_id)) {
                  $selected_category = $category->first(['id' => $effective_category_id]);
                  if ($selected_category && strcasecmp(trim($selected_category->category), 'IT & Software') === 0) {
                    $update_data['sub_category_id'] = null;
                  }
                }

                if (array_key_exists('category_id', $update_data)) {
                  if ((int)$update_data['category_id'] !== (int)$row->category_id) {
                    $update_data['sub_category_id'] = null;
                  }
                }

                if (!empty($update_data)) {
                  $course->update($id, $update_data);
                  if ($old_course_image && file_exists($old_course_image)) {
                    unlink($old_course_image);
                  }
                }

                $promo_video_model = new \Model\Course_promo_video();
                if ($promo_video_model->schemaReady()) {
                  $captions = is_array($_POST['promo_video_caption'] ?? null)
                    ? $_POST['promo_video_caption']
                    : [];
                  $titles = is_array($_POST['promo_video_title'] ?? null)
                    ? $_POST['promo_video_title']
                    : [];
                  try {
                    $promo_video_model->transaction(function () use ($promo_video_model, $captions, $titles, $id) {
                      for ($slot = 1; $slot <= 5; $slot++) {
                        if (array_key_exists($slot, $captions) || array_key_exists($slot, $titles)) {
                          $caption = trim((string)($captions[$slot] ?? ''));
                          $video_title = trim((string)($titles[$slot] ?? ''));
                          $promo_video_model->saveDetails((int)$id, $slot, $video_title, $caption);
                        }
                      }
                    });
                    $info['data'] = "Course and promotional video titles and text saved successfully!";
                  } catch (\PDOException $error) {
                    error_log('Course promotional video titles and captions could not be saved: ' . $error->getMessage());
                    $info['data'] = "Course details saved, but promotional video titles and text could not be saved. Please try again.";
                  }
                } else {
                  $info['data'] = "Course saved. Promotional video titles and text are unavailable until the promotional video title migration is applied.";
                }
                $info['data_type'] = "save";
              } else
              if ($_POST['tab_name'] == "course-duration") {
                # ...| TAB: (Course Duration) Block
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                  $duration_fields = ['start_date', 'end_date'];
                  $duration_data = array_intersect_key($_POST, array_flip($duration_fields));
                  foreach ($duration_fields as $field) {
                    if (array_key_exists($field, $duration_data) && $duration_data[$field] === '') {
                      $duration_data[$field] = null;
                    }
                  }
                  $duration_data['course_duration'] = \Model\Course::calculate_course_weeks(
                    $duration_data['start_date'] ?? null,
                    $duration_data['end_date'] ?? null
                  );
                  $course->update($id, $duration_data);

                  $info['data'] = "Course saved successfully!";
                  $info['data_type'] = "save";
                }
                # ---| ./IF(POST)
              } else
              if ($_POST['tab_name'] == "course-messages") {
                # ...| TAB: (Course Messages) Block
                $course->update($id, [
                  'welcome_message' => trim((string)($_POST['welcome_message'] ?? '')),
                ]);
                $info['data'] = "Course welcome message saved successfully!";
                $info['data_type'] = "save";
              }
              # ---| ./IF/ELSE/IF(TAB)
            } else {
              # ...| FALSE Block
              $info['errors'] = $course->errors;
              $info['data'] = "Please, fix all errors!";
              $info['data_type'] = "save";
            }
            # ---| ./IF/ELSE(VALIDATE)
          } else {
            # ...| FLASE Block
            $info['errors'] = ['key'=>'value'];
            $info['data'] = "Oh, NO! This form is not valid.";
            $info['data_type'] = $_POST['data_type'];
          }
          # ---| ./IF/ELSE(Security_Code)

          echo json_encode($info);
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_image") {
          header('Content-Type: application/json; charset=utf-8');
          $csrf_code = $_POST['csrf_code'] ?? '';
          if (!is_string($csrf_code) || $csrf_code === ''
            || !hash_equals((string)($_SESSION['csrf_code'] ?? ''), $csrf_code)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Security check failed. Refresh the course editor and try again.']);
            die;
          }

          $image = $_FILES['image'] ?? null;
          if (!is_array($image)
            || ($image['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK
            || !is_string($image['tmp_name'] ?? null)
            || !is_uploaded_file($image['tmp_name'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Select a valid JPG or PNG course image.']);
            die;
          }

          $image_info = getimagesize($image['tmp_name']);
          $allowed_image_types = [
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
          ];
          if (!$image_info || !isset($allowed_image_types[$image_info[2]])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Only JPG and PNG course images are allowed.']);
            die;
          }

          $folder = 'uploads/courses/';
          if (!is_dir($folder) && !mkdir($folder, 0775, true) && !is_dir($folder)) {
            http_response_code(503);
            echo json_encode(['success' => false, 'message' => 'The course image upload folder could not be created.']);
            die;
          }

          $destination = $folder . 'course_' . (int)$id . '_pending_' . bin2hex(random_bytes(12)) . '.' . $allowed_image_types[$image_info[2]];
          if (!move_uploaded_file($image['tmp_name'], $destination)) {
            http_response_code(503);
            echo json_encode(['success' => false, 'message' => 'The course image could not be saved.']);
            die;
          }

          $old_temp_image = (string)($row->course_image_tmp ?? '');
          try {
            $course->update($id, [
              'course_image_tmp' => $destination,
              'csrf_code' => $csrf_code,
            ]);
          } catch (\PDOException $error) {
            unlink($destination);
            error_log('Course image upload could not be registered: ' . $error->getMessage());
            http_response_code(503);
            echo json_encode(['success' => false, 'message' => 'The course image was uploaded but could not be attached to the course. Please retry.']);
            die;
          }

          $managed_upload_root = realpath($folder);
          $old_temp_realpath = $old_temp_image !== '' ? realpath($old_temp_image) : false;
          if ($managed_upload_root && $old_temp_realpath
            && dirname($old_temp_realpath) === $managed_upload_root
            && is_file($old_temp_realpath)) {
            unlink($old_temp_realpath);
          }

          echo json_encode([
            'success' => true,
            'image' => get_image($destination),
            'message' => 'Course image uploaded. Save the course to apply it.',
          ]);
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_video") {
          # ...| TRUE Block
          $folder = "uploads/courses/";
          if (!file_exists($folder)) {
            # ...| TRUE Block
            mkdir($folder,0777,true);
          }

          if (!empty($_FILES['video']['name'])) {
            # ...| TRUE Block
            $destination = $folder . time() . basename($_FILES['video']['name']);
            if (move_uploaded_file($_FILES['video']['tmp_name'], $destination)) {
              if (!empty($row->course_promo_video) && file_exists($row->course_promo_video)) {
                unlink($row->course_promo_video);
              }

              $course->update($id,['course_promo_video'=>$destination,'csrf_code'=>$_POST['csrf_code']]);
            }
          }
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_additional_video") {
          header('Content-Type: application/json; charset=utf-8');
          $csrf_code = $_POST['csrf_code'] ?? '';
          if (empty($csrf_code) || !hash_equals($_SESSION['csrf_code'] ?? '', $csrf_code)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Security check failed.']);
            die;
          }

          $video_slot = (int)($_POST['video_slot'] ?? 0);
          if (empty($row) || $video_slot < 2 || $video_slot > 5) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Course or promotional video slot was not found.']);
            die;
          }

          $promo_video_model = new \Model\Course_promo_video();
          if (!$promo_video_model->schemaReady()) {
            http_response_code(409);
            echo json_encode([
              'success' => false,
              'message' => 'Apply database/migrations/20261027_create_course_promo_videos.sql before uploading additional promotional videos.',
            ]);
            die;
          }

          $video = $_FILES['video'] ?? null;
          if (!$video || ($video['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($video['tmp_name'] ?? '')) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Select a valid MP4 video to upload.']);
            die;
          }

          $extension = strtolower(pathinfo($video['name'] ?? '', PATHINFO_EXTENSION));
          $mime_type = function_exists('mime_content_type') ? mime_content_type($video['tmp_name']) : '';
          if ($extension !== 'mp4' || $mime_type !== 'video/mp4') {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Only MP4 promotional videos are allowed.']);
            die;
          }

          if (($video['size'] ?? 0) <= 0 || ($video['size'] ?? 0) > 100 * 1024 * 1024) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Promotional videos must be smaller than 100 MB.']);
            die;
          }

          $folder = 'uploads/courses/promo/';
          if (!is_dir($folder) && !mkdir($folder, 0775, true) && !is_dir($folder)) {
            http_response_code(503);
            echo json_encode(['success' => false, 'message' => 'The promotional video upload folder could not be created.']);
            die;
          }

          $destination = $folder . 'course_' . (int)$id . '_slot_' . $video_slot . '_' . bin2hex(random_bytes(12)) . '.mp4';
          if (!move_uploaded_file($video['tmp_name'], $destination)) {
            http_response_code(503);
            echo json_encode(['success' => false, 'message' => 'The promotional video could not be saved.']);
            die;
          }

          try {
            $old_video_rows = $promo_video_model->forCourse((int)$id);
            $old_video_path = '';
            foreach ($old_video_rows as $old_video_row) {
              if ((int)$old_video_row->video_slot === $video_slot) {
                $old_video_path = (string)($old_video_row->video_path ?? '');
                break;
              }
            }
            $promo_video_model->saveVideo((int)$id, $video_slot, $destination);
          } catch (\PDOException $error) {
            unlink($destination);
            error_log('Additional course promotional video could not be registered: ' . $error->getMessage());
            http_response_code(503);
            echo json_encode(['success' => false, 'message' => 'The video was uploaded but could not be added to the course. Please retry.']);
            die;
          }

          $managed_video_root = realpath($folder);
          $old_video_realpath = $old_video_path !== '' ? realpath($old_video_path) : false;
          if ($managed_video_root && $old_video_realpath && dirname($old_video_realpath) === $managed_video_root && is_file($old_video_realpath)) {
            unlink($old_video_realpath);
          }

          echo json_encode([
            'success' => true,
            'video' => get_video($destination),
            'message' => 'Promotional video uploaded successfully.',
          ]);
        } else
        if (!empty($_POST['data_type']) && $_POST['data_type'] == "upload_course_hero_image") {
          header('Content-Type: application/json; charset=utf-8');
          $csrf_code = $_POST['csrf_code'] ?? '';
          if (empty($csrf_code) || !hash_equals($_SESSION['csrf_code'] ?? '', $csrf_code)) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Security check failed.']);
            die;
          }

          $image = $_FILES['hero_image'] ?? null;
          if (!$image || ($image['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($image['tmp_name'] ?? '')) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Select a valid image to upload.']);
            die;
          }

          $image_info = getimagesize($image['tmp_name']);
          $allowed_image_types = [
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_WEBP => 'webp',
          ];
          if (!$image_info || !isset($allowed_image_types[$image_info[2]])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Only JPG, PNG, and WebP images are allowed.']);
            die;
          }

          $folder = "uploads/courses/hero/";
          if (!is_dir($folder) && !mkdir($folder, 0775, true) && !is_dir($folder)) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Could not create the hero image upload directory.']);
            die;
          }

          $destination = $folder . 'hero_' . bin2hex(random_bytes(12)) . '.' . $allowed_image_types[$image_info[2]];
          if (!move_uploaded_file($image['tmp_name'], $destination)) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Could not save the uploaded hero image.']);
            die;
          }

          $old_hero_image = $row->hero_background_image ?? '';
          $course->update($id, ['hero_background_image' => $destination]);
          if ($old_hero_image && file_exists($old_hero_image)) {
            unlink($old_hero_image);
          }

          echo json_encode([
            'success' => true,
            'image' => get_image($destination),
            'message' => 'Hero background image updated.',
          ]);
        }
        # ---| ./IF/ELSE/IF(Data_Type)

        die;
      } # ---| ./IF(POST)
      # ---| ./Action=>EDIT\. |---
    } elseif ($action == 'course') {
      # ...| Single-COURSE Block
      $data['rows'] = array_reverse(array_reverse($course->findAll()));
    } elseif ($action == 'lecture') {
      # ...| Single-COURSE Block
      $data['rows'] = array_reverse($course->findAll());
    } else {
      # ...| ALL My Courses Block
      $course->limit = 100;

      if ($uid->role_id == 3) {
        $data['approved_courses'] = array_reverse($course->where(['approved'=>1,'published'=>1]));
        $data['rows'] = array_reverse($course->findAll());
      } elseif ($uid->role_id == 2) {
        $data['approved_courses'] = array_reverse($course->where(['user_id'=>$user_id,'approved'=>1,'published'=>1]));
        $data['rows'] = array_reverse($course->where(['user_id'=>$user_id,'approved'=>0,'published'=>0]));
      } else {
        $data['approved_courses'] = array_reverse($course->where(['approved'=>1,'published'=>1]));
        $data['rows'] = [];
      }
      # ---| ./COURSES MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(ACTION)

    $this->view('admin/courses',$data);
  }
  # ---| ./Courses()\. | ---

  # -----| Lessons() | -----
  public function lessons() {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $user_id    = Auth::getId();
    $course     = new \Model\Course();
    $enrollment = new \Model\Enrollment();
    $course_request = new \Model\Course_join_request();
    $course_meta = new \Model\Course_meta();
    $course_lecture = new \Model\Course_lecture();
    $user       = new \Model\User();

    $data = [];
    $data['uid'] = $uid = $user->first(['id'=>$user_id]);

    $approved_courses = $course->where(['approved'=>1,'published'=>1]);
    $data['approved_courses'] = $approved_courses ?: [];

    $teacher_courses = $course->where(['user_id'=>$user_id,'approved'=>1,'published'=>1]);
    $data['teacher_courses'] = $teacher_courses ?: [];

    $student_approved_requests = $course_request->where(['user_id'=>$user_id,'status'=>'Approved']);
    $student_courses = [];
    if ($student_approved_requests) {
      foreach ($student_approved_requests as $request) {
        $course_row = $course->first(['id'=>$request->course_id,'approved'=>1,'published'=>1]);
        if ($course_row) {
          $student_courses[] = $course_row;
        }
      }
    }
    $data['student_courses'] = $student_courses;

    $enrolled = $enrollment->where(['user_id'=>$user_id,'disabled'=>0]);
    $rows = [];
    if ($enrolled) {
      foreach ($enrolled as $er) {
        $c = $course->first(['id'=>$er->course_id]);
        if ($c) $rows[] = $c;
      }
    }
    $data['rows'] = $rows;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($_POST['ajax'] ?? '') == '1') {
      $action = $_POST['action'] ?? '';

      if ($action == 'load_course_requests') {
        $course_id = (int)($_POST['course_id'] ?? 0);
        $selected_course = $course->first(['id'=>$course_id,'approved'=>1,'published'=>1]);

        if (!$selected_course) {
          echo json_encode(['success' => false, 'message' => 'Course not found.']);
          die;
        }

        $requests = $course_request->where(['course_id'=>$course_id]);
        $rows_html = '<div class="card"><div class="card-body"><h6 class="card-title">Enrollment requests for '.esc($selected_course->title).'</h6>';

        if ($requests) {
          $rows_html .= '<div class="table-responsive"><table class="table table-bordered align-middle"><thead><tr><th>Student</th><th>Status</th><th>Action</th></tr></thead><tbody>';
          foreach ($requests as $request) {
            $student = $user->first(['id'=>$request->user_id]);
            $status = $request->status ?? 'Pending';
            $rows_html .= '<tr>';
            $rows_html .= '<td>'.esc($student->firstname ?? 'Student').' '.esc($student->lastname ?? '').'</td>';
            $rows_html .= '<td><span class="badge bg-'.($status == 'Approved' ? 'success' : ($status == 'Rejected' ? 'danger' : 'warning')).'">'.esc($status).'</span></td>';
            $rows_html .= '<td>';
            $rows_html .= '<form method="post" class="d-inline-block request-status-form" data-course-id="'.$course_id.'" data-request-user-id="'.$request->user_id.'">';
            $rows_html .= '<input type="hidden" name="csrf_code" value="'.($_SESSION['csrf_code'] ?? '').'">';
            $rows_html .= '<select name="status" class="form-select form-select-sm d-inline-block" style="width:auto;min-width:120px;">';
            $rows_html .= '<option value="Pending" '.($status == 'Pending' ? 'selected' : '').'>Pending</option>';
            $rows_html .= '<option value="Approved" '.($status == 'Approved' ? 'selected' : '').'>Approve</option>';
            $rows_html .= '<option value="Rejected" '.($status == 'Rejected' ? 'selected' : '').'>Reject</option>';
            $rows_html .= '</select>';
            $rows_html .= '<button type="submit" class="btn btn-sm btn-primary ms-2">Save</button>';
            $rows_html .= '</form>';
            $rows_html .= '</td>';
            $rows_html .= '</tr>';
          }
          $rows_html .= '</tbody></table></div>';
        } else {
          $rows_html .= '<div class="alert alert-light border">No student requests for this course yet.</div>';
        }

        $rows_html .= '</div></div>';

        echo json_encode(['success' => true, 'html' => $rows_html]);
        die;
      }

      if ($action == 'load_student_course') {
        $course_id = (int)($_POST['course_id'] ?? 0);
        $selected_course = $course->first(['id'=>$course_id,'approved'=>1,'published'=>1]);

        if (!$selected_course) {
          echo json_encode(['success' => false, 'message' => 'Course not found.']);
          die;
        }

        $course_sections = $course_meta->where(['course_id'=>$course_id,'disabled'=>0]);
        $sections_html = '<div class="list-group">';
        if ($course_sections) {
          foreach ($course_sections as $section) {
            $lecture_items = $course_lecture->where(['unid'=>$section->unid,'disabled'=>0]);
            $sections_html .= '<div class="list-group-item">';
            $sections_html .= '<strong>'.esc($section->value ?? 'Section').'</strong>';
            if ($lecture_items) {
              $sections_html .= '<ul class="mb-0 mt-2 ps-3">';
              foreach ($lecture_items as $lecture) {
                $sections_html .= '<li>'.esc($lecture->title).'</li>';
              }
              $sections_html .= '</ul>';
            }
            $sections_html .= '</div>';
          }
        } else {
          $sections_html .= '<div class="list-group-item">No course sections found.</div>';
        }
        $sections_html .= '</div>';

        $other_courses = array_filter($student_courses, function($item) use ($course_id) {
          return $item->id != $course_id;
        });

        $other_html = '<div class="list-group">';
        if ($other_courses) {
          foreach ($other_courses as $other_course) {
            $other_html .= '<a href="#" class="list-group-item list-group-item-action">'.esc($other_course->title).'</a>';
          }
        } else {
          $other_html .= '<div class="list-group-item">No other approved courses.</div>';
        }
        $other_html .= '</div>';

        $html = '<div class="row g-3"><div class="col-lg-4"><div class="card"><div class="card-body"><h6 class="card-title">'.esc($selected_course->title).'</h6><p class="small text-muted">'.esc($selected_course->description ?? 'No description available').'</p>'.$sections_html.'</div></div></div><div class="col-lg-4"><div class="card"><div class="card-body"><video class="w-100" controls><source src="'.get_image($selected_course->course_promo_video ?: $selected_course->course_image).'" type="video/mp4"></video></div></div></div><div class="col-lg-4"><div class="card"><div class="card-body"><h6 class="card-title">Other approved courses</h6>'.$other_html.'</div></div></div></div>';

        echo json_encode(['success' => true, 'html' => $html]);
        die;
      }

      if ($action == 'update_request_status') {
        $course_id = (int)($_POST['course_id'] ?? 0);
        $user_id = (int)($_POST['user_id'] ?? 0);
        $status = trim($_POST['status'] ?? 'Pending');
        $csrf_code = $_POST['csrf_code'] ?? '';

        if (!empty($csrf_code) && ($_SESSION['csrf_code'] ?? '') != $csrf_code) {
          echo json_encode(['success' => false, 'message' => 'Security check failed.']);
          die;
        }

        $request = $course_request->first(['course_id'=>$course_id,'user_id'=>$user_id]);
        if (!$request) {
          $course_request->insert([
            'course_id' => $course_id,
            'user_id' => $user_id,
            'status' => $status,
            'requested_at' => date('Y-m-d H:i:s'),
            'approved_by' => $user_id,
            'approved_at' => ($status == 'Approved') ? date('Y-m-d H:i:s') : null,
            'disabled' => 0,
          ]);
          echo json_encode(['success' => true, 'message' => 'Enrollment request updated.']);
          die;
        }

        $course_request->update($request->id, [
          'status' => $status,
          'approved_by' => $user_id,
          'approved_at' => ($status == 'Approved') ? date('Y-m-d H:i:s') : null,
          'disabled' => 0,
        ]);

        if ($status == 'Approved') {
          $exists = $enrollment->first(['user_id'=>$user_id,'course_id'=>$course_id]);
          if (!$exists) {
            $enrollment->insert([
              'user_id' => $user_id,
              'course_id' => $course_id,
              'disabled' => 0,
            ]);
          }
        }

        echo json_encode(['success' => true, 'message' => 'Request status saved.']);
        die;
      }
    }

    $data['title'] = "Enrolled Courses";

    $this->view('admin/lessons',$data);
  }
  # ---| ./Lessons()\. | ---

  public function lesson_media($lesson_id = null) {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET' && $_SERVER['REQUEST_METHOD'] !== 'HEAD') {
      http_response_code(405);
      header('Allow: GET, HEAD');
      return;
    }

    $lesson_model = new \Model\Course_lecture();
    $lesson_rows = $lesson_model->query(
      "SELECT `cl`.*, `c`.`id` AS `course_id`, `c`.`user_id` AS `course_owner_id`,
              `c`.`approved`, `c`.`published`
       FROM `courses_lectures` AS `cl`
       INNER JOIN `courses_meta` AS `cm` ON `cm`.`unid` = `cl`.`unid`
       INNER JOIN `courses` AS `c` ON `c`.`id` = `cm`.`course_id`
       WHERE `cl`.`id` = :lesson_id
         AND `cl`.`disabled` = 0
         AND `cm`.`disabled` = 0
         AND `cm`.`tab` = 'curriculum'
       LIMIT 1",
      ['lesson_id' => (int)$lesson_id]
    );
    if (empty($lesson_rows)) {
      http_response_code(404);
      return;
    }

    $lesson = $lesson_rows[0];
    $public_preview = (int)$lesson->is_preview === 1
      && (int)$lesson->approved === 1
      && (int)$lesson->published === 1;
    if (!$public_preview) {
      if (!Auth::logged_in()) {
        http_response_code(403);
        return;
      }

      $user_id = Auth::getId();
      $user = (new \Model\User())->first(['id' => $user_id]);
      $is_owner = (int)$lesson->course_owner_id === (int)$user_id;
      $is_admin = (int)($user->role_id ?? 0) === 3;
      $is_enrolled = (new \Model\Enrollment())->first([
        'user_id' => $user_id,
        'course_id' => $lesson->course_id,
        'disabled' => 0,
      ]);
      if (!$is_owner && !$is_admin && !$is_enrolled) {
        http_response_code(403);
        return;
      }
    }

    $file_path = realpath((string)$lesson->file);
    $lesson_upload_root = realpath('uploads/courses/lessons');
    $legacy_upload_root = realpath('uploads/courses');
    $is_lesson_upload = $file_path && $lesson_upload_root && dirname($file_path) === $lesson_upload_root;
    $is_legacy_upload = $file_path && $legacy_upload_root && dirname($file_path) === $legacy_upload_root;
    if (!$file_path || (!$is_lesson_upload && !$is_legacy_upload) || !is_readable($file_path)) {
      http_response_code(404);
      return;
    }

    $mime_by_extension = [
      'mp4' => ['video/mp4'],
      'webm' => ['video/webm'],
      'ogv' => ['video/ogg'],
      'mp3' => ['audio/mpeg'],
      'm4a' => ['audio/mp4', 'audio/x-m4a'],
      'wav' => ['audio/wav', 'audio/x-wav'],
      'ogg' => ['audio/ogg', 'application/ogg'],
      'oga' => ['audio/ogg', 'application/ogg'],
      'pdf' => ['application/pdf'],
    ];
    $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    if (!isset($mime_by_extension[$extension]) || !class_exists('\finfo')) {
      http_response_code(415);
      return;
    }

    $finfo = new \finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($file_path);
    if (!in_array($mime_type, $mime_by_extension[$extension], true)) {
      http_response_code(415);
      return;
    }

    $file_size = filesize($file_path);
    if ($file_size === false) {
      http_response_code(404);
      return;
    }

    $start = 0;
    $end = $file_size - 1;
    $status = 200;
    if (isset($_SERVER['HTTP_RANGE'])) {
      if (!preg_match('/^bytes=(\d*)-(\d*)$/', trim($_SERVER['HTTP_RANGE']), $range)
        || ($range[1] === '' && $range[2] === '')) {
        http_response_code(416);
        header('Content-Range: bytes */' . $file_size);
        return;
      }
      if ($range[1] === '') {
        $suffix_length = (int)$range[2];
        $start = max(0, $file_size - $suffix_length);
      } else {
        $start = (int)$range[1];
        $end = $range[2] !== '' ? min((int)$range[2], $end) : $end;
      }
      if ($start > $end || $start >= $file_size) {
        http_response_code(416);
        header('Content-Range: bytes */' . $file_size);
        return;
      }
      $status = 206;
    }

    $handle = fopen($file_path, 'rb');
    if (!$handle || fseek($handle, $start) !== 0) {
      if (is_resource($handle)) {
        fclose($handle);
      }
      error_log('Unable to open or seek a curriculum media file.');
      http_response_code(404);
      return;
    }

    http_response_code($status);
    header('Content-Type: ' . $mime_type);
    header('X-Content-Type-Options: nosniff');
    header('Accept-Ranges: bytes');
    header('Cache-Control: private, no-store');
    header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . ($end - $start + 1));
    if ($status === 206) {
      header("Content-Range: bytes {$start}-{$end}/{$file_size}");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
      fclose($handle);
      return;
    }

    $remaining = $end - $start + 1;
    while ($remaining > 0 && !feof($handle)) {
      $chunk = fread($handle, min(8192, $remaining));
      if ($chunk === false) {
        error_log('Unable to read a curriculum media file.');
        break;
      }
      if ($chunk === '') {
        break;
      }
      echo $chunk;
      $remaining -= strlen($chunk);
    }
    if ($remaining > 0) {
      error_log('Curriculum media ended before the declared content length.');
    }
    fclose($handle);
  }

  # -----| Course_Details() | -----
  public function course_details($slug = null) {
    $course = new \Model\Course();
    $course_meta = new \Model\Course_meta();
    $user = new \Model\User();

    $data['title'] = "Course Details";
    $data['course'] = $course->first([
      'slug' => $slug,
      'approved' => 1,
      'published' => 1,
    ]);

    if (!$data['course']) {
      message('Course not found.');
      redirect('admin/lessons');
    }

    if (!Auth::logged_in()) {
      message('Please log in and enroll in this course to access its lessons.');
      redirect('course_details/' . $data['course']->slug);
    }

    $data['uid'] = $user->first(['id'=>Auth::getId()]);
    $enrollment = new \Model\Enrollment();
    $user_id = Auth::getId();
    $is_course_owner = (int)$data['course']->user_id === (int)$user_id;
    $is_admin = (int)($data['uid']->role_id ?? 0) === 3;
    $is_enrolled = $enrollment->first([
      'user_id' => $user_id,
      'course_id' => $data['course']->id,
      'disabled' => 0,
    ]);

    if (!$is_course_owner && !$is_admin && !$is_enrolled) {
      message('Enroll in this course to access its lessons.');
      redirect('course_details/' . $data['course']->slug);
    }

    $data['course_sections'] = $course_meta->where([
      'course_id' => $data['course']->id,
      'disabled' => 0,
      'data_type' => 'curriculum',
    ]) ?: [];

    $data['course_sections'] = array_reverse($data['course_sections']);

    $this->view('admin/course-details', $data);
  }
  # ---| ./Course_Details()\. | ---

  # -----| Lectures() | -----
  public function lectures($action = null, $id = null) {
    if (!Auth::logged_in()) {
      message('Please, log in!');
      redirect('login');
    }

    $user_id = Auth::getId();
    $course_lecture = new \Model\Course_lecture();
    $course_meta = new \Model\Course_meta();
    $course = new \Model\Course();
    $user = new \Model\User();

    $data = [];
    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    $data['title'] = "Lectures";
    $data['action'] = $action;
    $data['id'] = $id;

    if ($action == 'add') {
      $sections = $course_meta->query("select distinct cm.unid, cm.course_id, c.title as course_title from courses_meta cm left join courses c on cm.course_id = c.id where cm.disabled = 0 order by c.title asc");
      $data['sections'] = $sections;

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $lecture_data = [
          'unid' => $_POST['unid'] ?? null,
          'title' => trim($_POST['title'] ?? ''),
          'description' => trim($_POST['description'] ?? ''),
          'disabled' => 0,
        ];

        if (empty($lecture_data['unid']) || empty($lecture_data['title'])) {
          $data['errors']['lecture'] = "Please select a section and provide a lecture title.";
        } else {
          $filename = "";
          if (!empty($_FILES['file']['name'])) {
            $folder = "uploads/courses/";
            if (!file_exists($folder)) {
              mkdir($folder,0777,true);
            }
            $filename = $folder . time() . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);
          }
          $lecture_data['file'] = $filename;
          $course_lecture->insert($lecture_data);
          message("Lecture created successfully!");
          redirect('admin/lectures');
        }
      }

      $this->view('admin/lectures',$data);
      return;
    }

    if ($action == 'delete' && $_SERVER['REQUEST_METHOD'] == 'POST') {
      $row = $course_lecture->first(['id'=>$id]);
      if ($row) {
        $course_lecture->delete($row->id);
        message("Lecture deleted successfully!");
      }
      redirect('admin/lectures');
    }

    $query = "select cl.*, cm.course_id, cm.tab, cm.data_type from courses_lectures cl left join courses_meta cm on cl.unid = cm.unid group by cl.id order by cl.id desc";
    $rows = $course_lecture->query($query);
    $data['rows'] = array_reverse($rows);

    $this->view('admin/lectures',$data);
  }
  # ---| ./Lectures()\. | ---

  # -----| Quizzes() | -----
  public function quizzes($action = null, $id = null) {
    if (!Auth::logged_in()) {
      message('Please, log in!');
      redirect('login');
    }

    $user_id = Auth::getId();
    $exam = new \Model\Exam();
    $course = new \Model\Course();

    $data = [];
    $data['title'] = "Quizzes";

    if ($action == 'add') {
      redirect('admin/exams/add');
    }

    if ($action == 'delete' && $_SERVER['REQUEST_METHOD'] == 'POST') {
      $row = $exam->first(['id'=>$id, 'user_id'=>$user_id]);
      if ($row) {
        $exam->delete($row->id);
        message("Quiz deleted successfully!");
      }
      redirect('admin/quizzes');
    }

    $data['rows'] = $exam->query("select * from exam where user_id = :user_id order by id desc", ['user_id'=>$user_id]);
    $data['courses'] = $course->findAll();

    $this->view('admin/quizzes',$data);
  }
  # ---| ./Quizzes()\. | ---

  # -----| Categories() | -----
  public function categories($action = null, $id = null, $uid = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $uid = $uid;
    $user_id = Auth::getId();
    $category = new \Model\Category();
    # ---| ./MODELS\. | ---

    $user = new \Model\User();
    $data = [];

    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    // $data['row'] = $row = $user->first(['id'=>$user_id]);

    $data['action'] = $action;
    $data['id'] = $id;
    $data['title'] = "Categories";

    if ($action == 'add') {
      # ...| ADD Block
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if (user_can('add_categories')) {
          # ...| TRUE Block
          if ($category->validate($_POST)) {
            # ...| TRUE Block
            $_POST['slug'] = str_to_url($_POST['category']);
            $category->insert($_POST);
            message("Your category was created seccessfully!");
            redirect('admin/categories');
          }
          # ---| ./IF(VALIDATE)
        } else {
          # ...| FALSE Block
          $category->errors['category'] = "Permission not allowed!";
        }
        # ---| ./IF/ELSE(User_Can(Permission))

        $data['errors'] = $category->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block -----| Get Category Information | -----
      $data['row'] = $row = $category->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $category->delete($row->id);
        message("Your category was deleted seccessfully!");
        redirect('admin/categories');

        $data['errors'] = $category->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block -----| Get Category Information | -----
      $data['row'] = $row = $category->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        if ($category->validate($_POST)) {
          # ...| TRUE Block
          $category->update($row->id, $_POST);
          message("Your category was updated seccessfully!");
          redirect('admin/categories');
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $category->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>EDIT\. |---
    } else {
      # ...| ALL Categories Block
      $data['rows'] = $category->findAll();
      # ---| ./Category MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(ACTION)

    $this->view('admin/categories',$data);
  }
  # ---| ./Categories()\. | ---

  # -----| Prices() | -----
  public function prices($action = null, $id = null, $uid = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $uid = $uid;
    $user_id = Auth::getId();
    $price = new \Model\Price_model();
    # ---| ./MODELS\. | ---

    $user = new \Model\User();
    $data = [];

    $data['uid'] = $uid = $user->first(['id'=>$user_id]);

    $data['action'] = $action;
    $data['id'] = $id;
    $data['title'] = "Prices";

    if ($action == 'add') {
      # ...| ADD Block
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if (user_can('add_prices')) {
          # ...| TRUE Block
          if ($price->validate($_POST)) {
            # ...| TRUE Block
            // $_POST['slug'] = str_to_url($_POST['price']);
            $price->insert($_POST);
            message("Your price was created seccessfully!");
            redirect('admin/prices');
          }
          # ---| ./IF(VALIDATE)
        } else {
          # ...| FALSE Block
          $price->errors['price'] = "Permission not allowed!";
        }
        # ---| ./IF/ELSE(User_Can(Permission))

        $data['errors'] = $price->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block -----| Get Price Information | -----
      $data['row'] = $row = $price->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $price->delete($row->id);
        message("Your price was deleted seccessfully!");
        redirect('admin/prices');

        $data['errors'] = $price->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block -----| Get Price Information | -----
      $data['row'] = $row = $price->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        if ($price->validate($_POST)) {
          # ...| TRUE Block
          $price->update($row->id, $_POST);
          message("Your price was updated seccessfully!");
          redirect('admin/prices');
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $price->errors;
      }
      # ---| ./IF(POST)

      # ---| ./Action=>EDIT\. |---
    } else {
      # ...| ALL Prices Block
      $data['rows'] = $price->findAll();
      # ---| ./Price MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(ACTION)

    $this->view('admin/prices',$data);
  }
  # ---| ./Prices()\. | ---

  # -----| Roles() | -----
  public function roles($action = null, $id = null, $uid = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())

    $uid = $uid;
    $user_id = Auth::getId();
    $role = new \Model\Role();
    # ---| ./MODELS\. | ---

    $user = new \Model\User();
    $data = [];

    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    // $data['row'] = $row = $user->first(['id'=>$user_id]);

    $data['action'] = $action;
    $data['id'] = $id;
    $data['title'] = "Roles";

    if ($action == 'add') {
      # ...| ADD Block
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block
        if (user_can('add_permissions')) {
          # ...| TRUE Block
          if ($role->validate($_POST)) {
            # ...| TRUE Block
            $_POST['slug'] = str_to_url($_POST['role']);
            $role->insert($_POST);
            message("Your role was created seccessfully!");
            redirect('admin/roles');
          }
          # ---| ./IF(VALIDATE)
        } else {
          # ...| FALSE Block
          $role->errors['role'] = "Permission not allowed!";
        }
        # ---| ./IF/ELSE(User_Can(Permission))

        $data['errors'] = $role->errors;
      } # ---| ./IF(POST)
      # ---| ./Action=>ADD\. |---
    } elseif ($action == 'delete') {
      # ...| DELETE Block -----| Get Category Information | -----
      $data['row'] = $row = $role->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        $role->delete($row->id);
        message("Your role was deleted seccessfully!");
        redirect('admin/roles');

        $data['errors'] = $role->errors;
      } # ---| ./IF(POST)
      # ---| ./Action=>DELETE\. |---
    } elseif ($action == 'edit') {
      # ...| EDIT Block -----| Get Category Information | -----
      $data['row'] = $row = $role->first(['id'=>$id]);

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $row) {
        # ...| TRUE Block
        if ($role->validate($_POST)) {
          # ...| TRUE Block
          $role->update($row->id, $_POST);
          message("Your role was updated seccessfully!");
          redirect('admin/roles');
        }
        # ---| ./IF(VALIDATE)

        $data['errors'] = $role->errors;
      } # ---| ./IF(POST)
      # ---| ./Action=>EDIT\. |---
    } else {
      # ...| Roles Block
      $data['rows'] = $role->findAll();

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # ...| TRUE Block -----| Disable ALL Permissions |-----
        $query = "update permissions_map set disabled = 1 where id > 0";
        $role->query($query);
        
        foreach ($_POST as $key => $permission) {
          if (preg_match("/[0-9]+\_[0-9]+/", $key)) {
            # ...| TRUE Block
            $role_id = preg_replace("/\_[0-9]+/", "", $key);
            
            /**
             * ------------------------------------------------- 
             * | Instead of using the DATABASE() Model() to    |
             * | use query() Method, Use the ROLE() Model      |
             * | Which Extends and provide all Model() Methods |
             * | THEN, INSERT INTO Permisssions_Map Table      |
             * -------------------------------------------------
             */
            $arr = [];
            $arr['role_id'] = $role_id;
            $arr['permission'] = $permission;

            # Check if() Record Exists |--------
            $query = "select id from permissions_map where permission = :permission && role_id = :role_id limit 1";
            $check = $role->query($query,$arr);
            if ($check) {
              # ...| TRUE Block ---| UPDATE |---
              $query = "update permissions_map set disabled = 0 where permission = :permission && role_id = :role_id limit 1";
            } else {
              # ...| FALSE Block ---| CREATE |---
              $query = "insert into permissions_map (role_id,permission) values (:role_id,:permission)";
            }
            # ---| ./IF/ELSE(Check)

            $role->query($query,$arr);
          }
          # ---| ./IF(KEY)
        }
        # ---| ./FOREACH($_POST)

        redirect('admin/roles');
      } # ---| ./IF(POST)
      # ---| ./Category MAIN PAGE\. |---
    }
    # ---| ./IF/ELSE(ACTION)

    $this->view('admin/roles',$data);
  }
  # ---| ./Roles()\. | ---

  # -----| Profile() | -----
  public function profile($id = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())
  
    $id = $id ?? Auth::getId();

    $user = new \Model\User();
    $data['uid'] = $uid = $user->first(['id'=>$id]);

    if ($_SERVER['REQUEST_METHOD'] == "POST" && $uid) {
      # ...| TRUE Block
      $folder = "uploads/images/";
      if (!file_exists($folder)) {
        # ...| TRUE Block
        mkdir($folder,0777,true);
        file_put_contents($folder."index.php", "<?php //Silence");
        file_put_contents("uploads/index.php", "<?php //Silence");
      }
      # ---| ./IF(Folder)

      if ($user->edit_validate($_POST,$id)) {
        # ...| TRUE Block
        $id = $uid->id;
        $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

        # ----- | CHECK IMAGES | -----
        if (!empty($_FILES['image']['name'])) {
          # ...| TRUE Block
          if ($_FILES['image']['error'] == 0) {
            # ...| TRUE Block
            if (in_array($_FILES['image']['type'], $allowed)) {
              # ...| TRUE Block | EVERYTHING'S GOOD
              $destination = $folder.time().$_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'], $destination);

              resize_image($destination);
              $_POST['image'] = $destination;

              // if (file_exists($row->image)) {
              if (file_exists($uid->image)) {
                # ...| TRUE Block
                unlink($uid->image);
              }
              # ---| ./IF(imageExist)
            } else {
              # ...| FALSE Block
              $user->errors['image'] = "Sorry, this file type is not allowed!";
            }
            # ---| ./IF/ELSE(IMAGE TYPE)
          } else {
            # ...| FALSE Block
            $user->errors['image'] = "Sorry, cannot upload image!";
          }
          # ---| ./IF/ELSE(ERROR)
        }
        # ---| ./IF(IMAGE NAME)

        $user->update($id,$_POST);

        // message("Successful Update!");
        // redirect('admin/profile/'.$id);
      }
      # ---| ./IF(EDIT_VALIDATE)

      if (empty($user->errors)) {
        # ...| TRUE Block
        $arr['message'] = "Successful Update!";
      } else {
        # ...| FALSE Block
        $arr['message'] = "Please, double check inputs before Update!";
        $arr['errors'] = $user->errors;
      }
      # ---| ./IF/ELSE(Errors)

      echo json_encode($arr);
      die;
    }
    # ---| ./IF(POST)

    $data['title'] = "Profile";
    $data['errors'] = $user->errors;
    $this->view('admin/profile',$data);
  }
  # ---| ./Profile()\. | ---

  public function change_password() {
    if (!Auth::logged_in()) {
      message('Please, log in!');
      redirect('login');
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      redirect('admin/profile');
    }

    if (($_POST['csrf_code'] ?? '') !== ($_SESSION['csrf_code'] ?? '')) {
      message('Security check failed.');
      redirect('admin/profile');
    }

    $user = new \Model\User();
    $user_id = Auth::getId();
    $current_user = $user->first(['id'=>$user_id]);

    if (!$current_user) {
      message('User not found.');
      redirect('admin/profile');
    }

    if ($user->validate_password_change($_POST, $current_user)) {
      $user->update($user_id, [
        'password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT),
      ]);
      message('Password changed successfully.');
    } else {
      message(implode(' ', $user->errors));
    }

    redirect('admin/profile');
  }
  # ---| ./Change_Password()\. | ---

  # -----| Slider_Images() | -----
  public function slider_images($id = null) {
    if (!Auth::logged_in()) {
      # ...| TRUE Block
      message('Please, log in!');
      redirect('login');
    }
    # ---| ./IF(logged_in())
  
    $user = new \Model\User();
    $slider = new Slider();

    $user_id = Auth::getId();
    $data['uid'] = $uid = $user->first(['id'=>$user_id]);
    $data['rows'] = [];
    $rows = $slider->where(['disabled'=>0]);

    if ($rows) {
      # ...| TRUE Block
      foreach ($rows as $key => $obj) {
        $num = $obj->id;
        $data['rows'][$num] = $obj;
      }
      # ---| ./FOREACH(ROWS)
    }
    # ---| ./IF(ROWS)

    $id = $_POST['id'] ?? 0;
    $row = $slider->first(['id'=>$id]);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      # ...| TRUE Block
      $folder = "uploads/slides/";
      if (!file_exists($folder)) {
        # ...| TRUE Block
        mkdir($folder,0777,true);
        file_put_contents($folder."index.php", "<?php //Silence");
        file_put_contents("uploads/index.php", "<?php //Silence");
      }
      # ---| ./IF(Folder)

      $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

      # ----- | CHECK IMAGES | -----
      if (!empty($_FILES['image']['name'])) {
        # ...| TRUE Block
        if ($_FILES['image']['error'] == 0) {
          # ...| TRUE Block
          if (in_array($_FILES['image']['type'], $allowed)) {
            # ...| TRUE Block | EVERYTHING'S GOOD
            $destination = $folder.time().$_FILES['image']['name'];

            $_POST['image'] = $destination;
          } else {
            # ...| FALSE Block
            $slider->errors['image'] = "Sorry, this file type is not allowed!";
          }
          # ---| ./IF/ELSE(IMAGE TYPE)
        } else {
          # ...| FALSE Block
          $slider->errors['image'] = "Sorry, cannot upload image!";
        }
        # ---| ./IF/ELSE(ERROR)
      }
      # ---| ./IF(IMAGE NAME)

      if ($slider->validate($_POST,$id)) {
        # ...| TRUE Block
        if (!empty($destination)) {
          # ...| TRUE Block
          move_uploaded_file($_FILES['image']['tmp_name'], $destination);

          // Keep the original uploaded file at its native resolution,
          // and create a smaller thumbnail for previews only.
          create_slider_thumbnail($destination);

          if ($row && file_exists($row->image)) {
            # ...| TRUE Block
            unlink($row->image);

            $old_thumb = slider_thumb_path($row->image);
            if (file_exists($old_thumb)) {
              unlink($old_thumb);
            }
          }
          # ---| ./IF(imageExist)
        }
        # ---| ./IF(DESTINATION)

        # CHECK IF RECORED ALREADY EXIST |------
        if ($row) {
          # ...| TRUE Block
          unset($_POST['id']);
          $slider->update($id,$_POST);
        } else {
          # ...| FALSE Block
          $slider->insert($_POST);
        }
        # ---| ./IF/ELSE(RESULT)

        // message("Successful Update!");
        // redirect('admin/profile/'.$id);
      }
      # ---| ./IF(EDIT_VALIDATE)

      if (empty($slider->errors)) {
        # ...| TRUE Block
        $arr['message'] = "Slider details saved successfully!";
      } else {
        # ...| FALSE Block
        $arr['message'] = "Please, double check inputs before complete!";
        $arr['errors'] = $slider->errors;
      }
      # ---| ./IF/ELSE(Errors)

      echo json_encode($arr);
      die;
    }
    # ---| ./IF(POST)

    $data['title'] = "Slider Images";
    $data['errors'] = $slider->errors;

    $this->view('admin/slider-images',$data);
  }
  # ---| ./Slider_Images()\. | ---

}
# -----| ./Admin()
