<?php
// Website.php - Handles website-specific data and functions
require_once __DIR__ . '/DBController.php';

class Website {
    private $db_handle;

    public function __construct() {
        $this->db_handle = new DBController();
    }

    // Get agent_bikes by city/location (city_id)
    public function get_agent_bikes_by_city($city_id) {
        $query = "SELECT ab.*, b.name AS bike_name, b.brand AS bike_brand, b.image AS bike_image, a.city AS agent_city FROM agent_bikes ab 
                  JOIN agent a ON ab.aid = a.id 
                  JOIN bikes b ON ab.bid = b.id 
                  WHERE a.city = '" . intval($city_id) . "' AND ab.available = 1";
        return $this->db_handle->runBaseQuery($query);
    }

    // Get all agent_bikes (optionally filter by availability)
    public function get_all_agent_bikes($only_available = true) {
        $query = "SELECT ab.*, b.name AS bike_name, b.brand AS bike_brand, b.image AS bike_image, a.city AS agent_city FROM agent_bikes ab 
                  JOIN agent a ON ab.aid = a.id 
                  JOIN bikes b ON ab.bid = b.id ";
        if ($only_available) {
            $query .= "WHERE ab.available = 1 ";
        }
        return $this->db_handle->runBaseQuery($query);
    }

    // Get city name by city_id
    public function get_city($city_id) {
        $query = "SELECT * FROM cities WHERE id = '" . intval($city_id) . "'";
        return $this->db_handle->runBaseQuery($query);
    }

    // Get all cities with agents
    public function get_distinct_agent_cities() {
        $query = "SELECT DISTINCT c.id, c.name as city FROM agent a LEFT JOIN cities c ON a.city = c.id WHERE a.city IS NOT NULL AND a.city != '' ORDER BY c.name ASC";
        return $this->db_handle->runBaseQuery($query);
    }

    // Get single agent_bike by ID
    public function get_agent_bike_by_id($id) {
        $query = "SELECT ab.*, b.name AS bike_name, b.brand AS bike_brand, b.image AS bike_image, a.city AS agent_city, u.uname AS agent_name, a.phone AS agent_phone 
              FROM agent_bikes ab 
              JOIN agent a ON ab.aid = a.id 
              JOIN bikes b ON ab.bid = b.id 
              LEFT JOIN tbluser u ON a.uid = u.id 
              WHERE ab.id = '" . intval($id) . "'";
        $result = $this->db_handle->runBaseQuery($query);
        return !empty($result) ? $result[0] : null;
    }

    // User Signup
    public function user_signup($uname, $phone, $email, $address, $password, $licence, $adhar) {
        // Check if email already exists
        $check_query = "SELECT id FROM user WHERE email = '" . $this->db_handle->escape_string($email) . "'";
        $existing = $this->db_handle->runBaseQuery($check_query);
        
        if (!empty($existing)) {
            return ['status' => 'error', 'message' => 'Email already registered'];
        }
        
        // Check if phone already exists
        $check_phone = "SELECT id FROM user WHERE phone = '" . $this->db_handle->escape_string($phone) . "'";
        $existing_phone = $this->db_handle->runBaseQuery($check_phone);
        
        if (!empty($existing_phone)) {
            return ['status' => 'error', 'message' => 'Phone number already registered'];
        }
        
        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user
        $query = "INSERT INTO user (uname, phone, email, address, password, otp, licence, adhar) 
                  VALUES (
                      '" . $this->db_handle->escape_string($uname) . "',
                      '" . $this->db_handle->escape_string($phone) . "',
                      '" . $this->db_handle->escape_string($email) . "',
                      '" . $this->db_handle->escape_string($address) . "',
                      '" . $hashed_password . "',
                      '" . intval($otp) . "',
                      '" . $this->db_handle->escape_string($licence) . "',
                      '" . $this->db_handle->escape_string($adhar) . "'
                  )";
        
        $result = $this->db_handle->execute($query);
        
        if ($result) {
            // Send OTP email (you can implement this with PHPMailer)
            return ['status' => 'success', 'message' => 'Registration successful! Please verify your email.', 'otp' => $otp, 'user_id' => $this->db_handle->lastInsertId()];
        } else {
            return ['status' => 'error', 'message' => 'Registration failed. Please try again.'];
        }
    }

    // User Signin
    public function user_signin($email, $password) {
        $query = "SELECT * FROM user WHERE email = '" . $this->db_handle->escape_string($email) . "'";
        $result = $this->db_handle->runBaseQuery($query);
        
        if (empty($result)) {
            return ['status' => 'error', 'message' => 'Invalid email or password'];
        }
        
        $user = $result[0];
        
        if (password_verify($password, $user['password'])) {
            return [
                'status' => 'success', 
                'message' => 'Login successful',
                'user' => [
                    'id' => $user['id'],
                    'uname' => $user['uname'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'address' => $user['address']
                ]
            ];
        } else {
            return ['status' => 'error', 'message' => 'Invalid email or password'];
        }
    }

    // Verify OTP
    public function verify_otp($user_id, $otp) {
        $query = "SELECT * FROM user WHERE id = '" . intval($user_id) . "' AND otp = '" . intval($otp) . "'";
        $result = $this->db_handle->runBaseQuery($query);
        
        if (!empty($result)) {
            // Update OTP to 0 after verification
            $update = "UPDATE user SET otp = 0 WHERE id = '" . intval($user_id) . "'";
            $this->db_handle->execute($update);
            return ['status' => 'success', 'message' => 'Email verified successfully'];
        } else {
            return ['status' => 'error', 'message' => 'Invalid OTP'];
        }
    }

    // Get user by ID
    public function get_user_by_id($id) {
        $query = "SELECT id, uname, phone, email, address, licence, adhar FROM user WHERE id = '" . intval($id) . "'";
        $result = $this->db_handle->runBaseQuery($query);
        return !empty($result) ? $result[0] : null;
    }
}
