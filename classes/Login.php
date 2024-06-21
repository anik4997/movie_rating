<?php
require_once 'database.php';
class Login{
    private $user_id; // Class property to store the user ID
    private $input_email;
    private $input_password;
    public $obj;
    // This constractor is for creating an object for the class database where have all the connections(db connection, insert, show query connections)
    public function __construct(){

       $this->obj = Database::getInstance();
    }

    //  login validation
    public function validation($data_validation) {
        // form validation
        $this->input_email = $data_validation['email'];
        $this->input_password = $data_validation['password'];
        
    
        // Query to fetch the user by email
        $validation_query = "SELECT id, email, password FROM user WHERE email='$this->input_email'";
        $validation_query_connection = $this->obj->validation($validation_query);
    
        if (mysqli_num_rows($validation_query_connection) > 0) {
            // Fetch the user data from the query result
            while ($row = mysqli_fetch_assoc($validation_query_connection)) {
                if (password_verify($this->input_password, $row['password'])) {
                    // Assign the user ID to the class property
                    $this->user_id = $row['id'];
                    return $row['id'];
                }
            }
        }
        return false; // Indicate invalid credentials
    }  
}