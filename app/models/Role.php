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
namespace Model;
# ------------|  ./NameSpace

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK


/**
 * Role()
 * *
 * The Categories MODEL
 */
class Role extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "roles";
  protected $afterSelect = [
    'get_permissions',
  ];
  protected $allowedColumns = [
    'role',
    'disabled',
  ];
  # ---| ./Properties\. | ---
  
  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| Role Block
    if(empty($data['role'])) {
      $this->errors['role'] = "Role is required!";
    } else
    if(!preg_match("/^[a-zA-Z \&\']+$/", trim($data['role']))) {
      $this->errors['role'] = "Only letters and spaces are allowed!";
    }
    # ---| ./IF/ELSE(Role)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. | ---

  # -----| Get_Permissions() | -----
  protected function get_permissions(mixed $data):mixed {
    if (!empty($data[0]->id) && !empty($data[0]->role)) {
      # ...| TRUE Block
      foreach ($data as $key => $row) {
        $query = "select permission from permissions_map where role_id = :role_id && disabled = 0";
        $res = $this->query($query,['role_id'=>$row->id]);

        if ($res) {
          # ...| TRUE Block
          $data[$key]->permissions = array_column($res, 'permission');
        }
        # ---| ./IF(Result)
      }
      # ---| ./FOREACH(Data)
    }
    # ---| ./IF(Data)

    return $data;
  }
  # ---| ./Get_Permissions()\. | ---
}
# -----| ./Role()
