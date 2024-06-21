<?php
require_once 'database.php';
require_once 'FetchUser.php';
class UserRegistration{
    private $user_id; // Class property to store the user ID
    private $user_name;
    private $user_phone;
    private $user_email;
    private $user_password;
    private $hashed_password;
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }

    public function adduser($data) {
        // Taking values of input field by post(super global variable)
        $this->user_name = $data['name'];
        $this->user_phone = $data['phone'];
        $this->user_email = $data['email'];
        $this->user_password = $data['password'];

        // Hash the password before saving
        $this->hashed_password = password_hash($this->user_password, PASSWORD_BCRYPT);
        $fetch_user_obj = new FetchUser();
        // Fetch all users
        $all_users = $fetch_user_obj->selectuser();
        $email_exists = false;
        $phone_exists = false;
    
        // Check if email or phone already exists
        while ($row = mysqli_fetch_assoc($all_users)) {
            if ($row['email'] === $this->user_email) {
                $email_exists = true;
            }
            if ($row['phone'] === $this->user_phone) {
                $phone_exists = true;
            }
            // If both exist, no need to continue checking
            if ($email_exists && $phone_exists) {
                break;
            }
        }
    
        if ($email_exists && $phone_exists) {
            echo 'This email and phone number already exist';
        } elseif ($email_exists) {
            echo 'This email already exists';
        } elseif ($phone_exists) {
            echo 'This phone number already exists';
        } else {
            // Insert query
            $insert_query = "INSERT INTO user (name, phone, email, password) VALUES ('$this->user_name', '$this->user_phone', '$this->user_email', '$this->hashed_password')";
            $insert_query_connection = $this->obj->insert($insert_query); // This method is from database.php file
    
            if ($insert_query_connection) {
                header("Location: index.php");
                exit; // Ensure that no other code is executed after the redirect
            } else {
                $insert_error_msg = "Failed to add user!";
                return $insert_error_msg;
            }
        }

    }
}