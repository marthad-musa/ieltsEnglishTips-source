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
 * User()
 * *
 * The User MODEL
 */
class User extends Model {
  # -----| Properties | -----
  public $errors = [];
  protected $table = "users";
  protected $allowedColumns = [
    'firstname',
    'lastname',
    'email',
    'username',
    'company',
    'job',
    'country',
    'address',
    'phone',
    'bio',
    'password',
    'role',
    'language',
    'date',
    'image',
    'twitter_link',
    'facebook_link',
    'instagram_link',
    'linkedin_link',
  ];
  protected $afterSelect = [
    'get_role',
  ];
  # ---| ./Properties\. | ---
  
  # -----| Validate() | -----
  public function validate($data) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| FirstNAME Block
    if(empty($data['firstname'])) {
      $this->errors['firstname'] = "First name is required!";
    } else
    if(!preg_match("/^[a-zA-Z]+$/", trim($data['firstname']))) {
      $this->errors['firstname'] = "Only letters allowed!";
    }
    # ---| ./IF/ELSE(FirstNAME)

    # ...| LastNAME Block
    if(empty($data['lastname'])) {
      $this->errors['lastname'] = "Last name is required!";
    } else
    if(!preg_match("/^[a-zA-Z]+$/", trim($data['lastname']))) {
      $this->errors['lastname'] = "Only letters allowed!";
    }
    # ---| ./IF/ELSE(LastNAME)

    # ...| E-mail Block
    if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
      $this->errors['email'] = "E-mail not valid!";
    } else
    if($this->where(['email'=>$data['email']])) {
      $this->errors['email'] = "E-mail already exists!";
    }
    # ---| ./IF/ELSE(E-mail)

    # ...| UserNAME-SLUG Block
    if(empty($data['username'])) {
      $this->errors['username'] = "Username is required!";
    } else
    if(!preg_match("/^[a-zA-Z0-9]+$/", trim($data['username']))) {
      $this->errors['username'] = "Only letters and numbers allowed!";
    }
    # ---| ./IF/ELSE(UserNAME)

    # ...| Password Block
    if(empty($data['password'])) {
      $this->errors['password'] = "Password is required!";
    }
    # ---| ./IF(Password)

    # ...| Retype-Password Block
    if($data['password'] !== $data['retype_password']) {
      $this->errors['retype_password'] = "Passwords don't match!";
    }
    # ---| ./IF(Retype-Password)

    # ...| LANGUAGE Block
    if(empty($data['language'])) {
      $this->errors['language'] = "Please, choose a language!";
    }
    # ---| ./IF(LANGUAGE)

    # ...| TERMS Block
    if(empty($data['terms'])) {
      $this->errors['terms'] = "Please, accept the terms and conditions!";
    }
    # ---| ./IF(TERMS)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./Validate()\. | ---

  # -----| EDIT_Validate() | -----
  public function edit_validate($data,$id) {
    # -----| Reset Errors Array() | -----
    $this->errors = [];
    # ---| ./Reset Errors Array()\. | ---

    # -----| Error Handler | -----
    # ...| FirstNAME Block
    if(empty($data['firstname'])) {
      $this->errors['firstname'] = "First name is required!";
    } else
    if(!preg_match("/^[a-zA-Z]+$/", trim($data['firstname']))) {
      $this->errors['firstname'] = "Only letters allowed!";
    }
    # ---| ./IF/ELSE(FirstNAME)

    # ...| LastNAME Block
    if(empty($data['lastname'])) {
      $this->errors['lastname'] = "Last name is required!";
    } else
    if(!preg_match("/^[a-zA-Z]+$/", trim($data['lastname']))) {
      $this->errors['lastname'] = "Only letters allowed!";
    }
    # ---| ./IF/ELSE(LastNAME)

    # ...| E-mail-SLUG Block
    if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
      $this->errors['email'] = "E-mail not valid!";
    } else
    if($results = $this->where(['email'=>$data['email']])) {
      foreach ($results as $result) {
        if ($id != $result->id)
          $this->errors['email'] = "E-mail already exists!";
        # ---| ./IF(Result->ID)
      }
      # ---| ./FOREACH(Results)
    }
    # ---| ./IF/ELSE(FILTER E-MAIL)

    # ...| UserNAME-SLUG Block
    if(empty($data['username'])) {
      $this->errors['username'] = "Username is required!";
    } else
    if(!preg_match("/^[a-zA-Z0-9]+$/", trim($data['username']))) {
      $this->errors['username'] = "Only letters and numbers allowed!";
    }
    # ---| ./IF/ELSE(UserNAME)

    # ...| TWITTER_LINK Block
    if(!empty($data['twitter_link'])) {
      $data['twitter_link'] = filter_var($data['twitter_link'],FILTER_SANITIZE_URL);
      if(!filter_var($data['twitter_link'],FILTER_VALIDATE_URL)) {
        $this->errors['twitter_link'] = "Twitter link is not valid!";
      }
      # ---| ./IF(FILTER LINK)
    }
    # ---| ./IF(TWITTER_LINK)
    
    # ...| FACEBOOK_LINK Block
    if(!empty($data['facebook_link'])) {
      $data['facebook_link'] = filter_var($data['facebook_link'],FILTER_SANITIZE_URL);
      if(!filter_var($data['facebook_link'],FILTER_VALIDATE_URL)) {
        $this->errors['facebook_link'] = "Facebook link is not valid!";
      }
      # ---| ./IF(FILTER LINK)
    }
    # ---| ./IF(FACEBOOK_LINK)
    
    # ...| INSTAGRAM_LINK Block
    if(!empty($data['instagram_link'])) {
      $data['instagram_link'] = filter_var($data['instagram_link'],FILTER_SANITIZE_URL);
      if(!filter_var($data['instagram_link'],FILTER_VALIDATE_URL)) {
        $this->errors['instagram_link'] = "Instagram link is not valid!";
      }
      # ---| ./IF(FILTER LINK)
    }
    # ---| ./IF(INSTAGRAM_LINK)
    
    # ...| LINKEDIN_LINK Block
    if(!empty($data['linkedin_link'])) {
      $data['linkedin_link'] = filter_var($data['linkedin_link'],FILTER_SANITIZE_URL);
      if(!filter_var($data['linkedin_link'],FILTER_VALIDATE_URL)) {
        $this->errors['linkedin_link'] = "Linked-in link is not valid!";
      }
      # ---| ./IF(FILTER LINK)
    }
    # ---| ./IF(LINKEDIN_LINK)

    # ...| Phone Block
    if(!empty($data['phone'])) {
      # ...| TRUE Block (Phone Regular Expression)
      if(preg_match("/^((09|\+249)|(01|\+201)|(05|\+966)|(\+961)|(\+962)|(\+963)|(\+964)|(\+965)|(\+967)|(\+968)|(\+969)|(\+447))*[0-9]{9}$/", trim($data['phone']))) {
        $data['phone'] = $_POST['phone'];
      } else {
        # ...| FALSE Block
        $this->errors['phone'] = "Phone number not valid!";
      }
    }
    # ---| ./IF(PHONE)

    # ...| Company Block
    // if(!empty($data['company'])) {
    //   if(!preg_match("/^[a-zA-Z0-9 ]+$/", trim($data['company']))) {
    //     $this->errors['company'] = "Only letters, numbers and spaces allowed!";
    //   }
    // }
    # ---| ./IF(COMPANY)

    # ...| Job Block
    if(!empty($data['job'])) {
      if(!preg_match("/^[a-zA-Z0-9 ]+$/", trim($data['job']))) {
        $this->errors['job'] = "Only letters, numbers and spaces allowed!";
      }
    }
    # ---| ./IF(JOB)

    # ...| Country Block
    if(empty($data['country'])) {
      if(!preg_match("/^[a-zA-Z]+$/", trim($data['country']))) {
        $this->errors['country'] = "Only letters allowed!";
      }
    }
    # ---| ./IF(COUNTRY)

    # ...| Address Block
    // if(empty($data['address'])) {
    //   if(!preg_match("/^[a-zA-Z0-9 ]+$/", trim($data['address']))) {
    //     $this->errors['address'] = "Only letters, numbers and spaces allowed!";
    //   }
    // }
    # ---| ./IF(ADDRESS)

    # ...| Biography Block
    if(empty($data['bio'])) {
      if(!preg_match("/^[a-zA-Z0-9 ]+$/", trim($data['bio']))) {
        $this->errors['bio'] = "Only letters, numbers and spaces allowed!";
      }
    }
    # ---| ./IF(BIOGRAPHY)

    # ...| Image Block
    // if(empty($data['image'])) {
    //   $this->errors['image'] = "Image is required!";
    // }
    # ---| ./IF(IMAGE)

    # ...| LANGUAGE Block
    // if(empty($data['language'])) {
    //   $this->errors['language'] = "Please, choose a language!";
    // }
    # ---| ./IF(LANGUAGE)

    if(empty($this->errors)) {
      # ...| TRUE Block
      return true;
    }
    # ---| ./IF(ERRORS)

    return false;
  }
  # ---| ./EDIT_Validate()\. | ---

  # -----| Get_Permissions() | -----
  protected function get_role(mixed $data):mixed {
    if (!empty($data[0]->email) && !empty($data[0]->role)) {
      # ...| TRUE Block
      foreach ($data as $key => $row) {
        $query = "select role from roles where id = :id limit 1";
        $res = $this->query($query,['id'=>$row->role]);

        if ($res) {
          # ...| TRUE Block
          $data[$key]->role_name = $res[0]->role;
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
# -----| ./User()
