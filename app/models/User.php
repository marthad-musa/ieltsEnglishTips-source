<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Register user
    public function register($data) {
        $this->db->query('INSERT INTO users (full_name, dob, email, password, role, verification_token) VALUES (:full_name, :dob, :email, :password, :role, :token)');
        // Bind values
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':token', $data['token']);

        // Execute
        if ($this->db->execute()) {
            $user_id = $this->db->lastInsertId();
            // Create empty profile
            $this->db->query('INSERT INTO profiles (user_id) VALUES (:user_id)');
            $this->db->bind(':user_id', $user_id);
            $this->db->execute();
            return true;
        } else {
            return false;
        }
    }

    // Login user
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get user by ID
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    // Get Profile by User ID
    public function getProfileByUserId($id) {
        $this->db->query('SELECT * FROM profiles WHERE user_id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    // Update Profile
    public function updateProfile($data) {
        $this->db->query('UPDATE profiles SET city = :city, state = :state, country = :country, mobile = :mobile, facebook = :facebook, instagram = :instagram, twitter = :twitter, tiktok = :tiktok, subject_to_teach = :subject_to_teach WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':state', $data['state']);
        $this->db->bind(':country', $data['country']);
        $this->db->bind(':mobile', $data['mobile']);
        $this->db->bind(':facebook', $data['facebook']);
        $this->db->bind(':instagram', $data['instagram']);
        $this->db->bind(':twitter', $data['twitter']);
        $this->db->bind(':tiktok', $data['tiktok']);
        $this->db->bind(':subject_to_teach', $data['subject_to_teach']);
        $this->db->bind(':user_id', $data['user_id']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Verify Email
    public function verifyEmail($token) {
        $this->db->query('UPDATE users SET status = "active", email_verified_at = CURRENT_TIMESTAMP, verification_token = NULL WHERE verification_token = :token');
        $this->db->bind(':token', $token);

        if ($this->db->execute()) {
            return $this->db->rowCount() > 0;
        } else {
            return false;
        }
    }
}
