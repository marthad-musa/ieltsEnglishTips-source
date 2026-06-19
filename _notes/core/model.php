<?php

# SECURITY CHECK  ---------------
// if (!defined("ROOT")) die ("direct script access denied!");
// define("ABSPATH") ? "" : die();
# ------------|  ./SECURITY CHECK

namespace Model;

/**
 * Model()
 * *
 * The Main MODEL Class
 */
class Model extends \Database {
  # -----| Properties | -----
  public $order = 'desc';
  public $limit = 10;
  public $offset = 0;

  protected $table = "";
  # ---| ./Properties\. | ---

  # -----| INSERT() | -----
  public function insert($data) {
    # Remove Unwanted Columns  ---------------
    if (!empty($this->allowedColumns)) {
      # ...| TRUE Block
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedColumns)) {
          # ...| TRUE Block
          unset($data[$key]);
        } # ...| ./IF
      } # ...| ./FOREACH
    } # ...| ./IF
    # ------------|  ./Remove Unwanted Columns

    # Construct QUERY  ------
    $keys   = array_keys($data);
    $values = array_values($data);

    $query  = "insert into " . $this->table;
    $query .= " (".implode(",", $keys).") values (:".implode(",:", $keys).");";
    # ---|  ./Construct QUERY

    $this->query($query,$data);
  }
  # ---| ./INSERT()\. | ---

  # -----| UPDATE() | -----
  public function update($id,$data) {
    # Remove Unwanted Columns  ---------------
    if (!empty($this->allowedColumns)) {
      # ...| TRUE Block
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowedColumns)) {
          # ...| TRUE Block
          unset($data[$key]);
        } # ...| ./IF
      } # ...| ./FOREACH
    } # ...| ./IF
    # ------------|  ./Remove Unwanted Columns

    # Construct QUERY  ------
    $keys   = array_keys($data);
    $values = array_values($data);

    $query  = "update ".$this->table." set ";
    foreach ($keys as $key) {
      $query .= $key . "=:" . $key . ",";
    }
    # ---| ./FOREACH()
    $query  = trim($query,",");
    $query .= " where id = :id";
    # ---|  ./Construct QUERY

    $data['id'] = $id;
    $this->query($query,$data);
  }
  # ---| ./UPDATE()\. | ---

  # -----| DELETE() | -----
  public function delete(int $id):bool {
    $query = "delete from ".$this->table." where id = :id limit 1";
    $res = $this->query($query,['id'=>$id]);

    return true;
  }
  # ---| ./DELETE()\. | ---

  # -----| FindALL() | -----
  public function findAll($order = 'desc') {
    # Construct QUERY  --------
    // $keys = array_keys($data);
    // $query = "select * from ".$this->table." order by id $this->order limit $this->limit offset $this->offset;";
    $query = "select * from ".$this->table." order by id $this->order;";
    $res = $this->query($query);
    # -----|  ./Construct QUERY

    if (is_array($res)) {
      # ...| TRUE Block | Run AfterSELECT Functions
      if (property_exists($this,'afterSelect')) {
        # ...| TRUE Block
        foreach ($this->afterSelect as $func) {
          $res = $this->$func($res);
        } # ---| ./FOREACH(FUNCTION)
      } # ---| ./IF(Property Exists)
      # ---| ./AfterSELECT Functions\. |---

      return $res;
    }
    # ---| ./IF

    return false;
  }
  # ---| ./FindALL()\. | ---

  # -----| WHERE() | -----
  public function where($data) {
    # Construct QUERY  --------
    $keys = array_keys($data);
    $query = "select * from ".$this->table." where ";
    foreach ($keys as $key) {
      $query .= $key . "=:" . $key . " && ";
    }
    # ---| ./FOREACH()
    $query = trim($query,"&& ");
    $query .= " order by id $this->order limit $this->limit offset $this->offset";

    $res = $this->query($query,$data);
    # -----|  ./Construct QUERY

    if (is_array($res)) {
      # ...| TRUE Block | Run AfterSELECT Functions
      if (property_exists($this,'afterSelect')) {
        # ...| TRUE Block
        foreach ($this->afterSelect as $func) {
          $res = $this->$func($res);
        } # ---| ./FOREACH(FUNCTION)
      } # ---| ./IF(Property Exists)
      # ---| ./AfterSELECT Functions\. |---

      return $res;
    }
    # ---| ./IF(Result())

    return false;
  }
  # ---| ./WHERE()\. | ---

  # -----| FIRST() | -----
  public function first($data) {
    # Construct QUERY  --------
    $keys = array_keys($data);
    $query = "select * from ".$this->table." where ";
    foreach ($keys as $key) {
      $query .= $key . "=:" . $key . " && ";
    }
    # ---| ./FOREACH()

    $query = trim($query,"&& ");
    $query .= " order by id $this->order limit 1";

    $res = $this->query($query,$data);
    # -----|  ./Construct QUERY

    if (is_array($res)) {
      # ...| TRUE Block | Run AfterSELECT Functions
      if (property_exists($this,'afterSelect')) {
        # ...| TRUE Block
        foreach ($this->afterSelect as $func) {
          $res = $this->$func($res);
        } # ---| ./FOREACH(FUNCTION)
      } # ---| ./IF(Property Exists)
      # ---| ./AfterSELECT Functions\. |---

      return $res[0];
    }
    # ---| ./IF

    return false;
  }
  # ---| ./FIRST()\. | ---
}
# ------------|  ./Main MODEL Class