<?php
require_once 'singleton.php';
class Database {
    // Achieving singleton behavior for this class by singleton trait from'singleton.php' file
    use \singleton;

    private $db_host = 'localhost';
    private $db_username = 'root';
    private $db_password = '';
    private $db_name = 'movie_rating';   
    private $db_conn;

    public static function db_connect() {
        $db = self::getInstance();
        $db->db_conn = mysqli_connect($db->db_host, $db->db_username, $db->db_password, $db->db_name);
        if (!$db->db_conn) {
            die("Not connected" . mysqli_error($db->db_conn)); // Pass the connection object to mysqli_error()
        }
        return $db->db_conn;
    }
    
      // Insert users to database
      public function insert($insert_query){
        $insert_query_connection = mysqli_query($this->db_conn, $insert_query) or die($this->db_conn->error.__LINE__);
        if($insert_query_connection){
            return $insert_query_connection;
        } else {
            return false;
        }
    }
    // select user query connection
    public function select_user_connection($select_alluserdata){
        $select_user_connection = mysqli_query($this->db_conn, $select_alluserdata) or die($this->db_conn->error.__LINE__);
        if($select_user_connection){
            return $select_user_connection;
        } else {
            return false;
        }
    }


    // select ratings query connection
    public function select_ratings_connection($query, $params = []){
        $stmt = $this->db_conn->prepare($query);
        if ($params) {
            $stmt->bind_param(...$params);
        }
        $stmt->execute();
        return $stmt->get_result();
    }



      // Add movie to database
      public function insert_movie($movie_insert_query){
        $movie_insert_query_connection = mysqli_query($this->db_conn, $movie_insert_query) or die($this->db_conn->error.__LINE__);
        if($movie_insert_query_connection){
            return $movie_insert_query_connection;
        } else {
            return false;
        }
    }

    // Add ratings to database
    public function insert_movie_rating($rating_insert_query){
        $rating_insert_query_connection = mysqli_query($this->db_conn, $rating_insert_query) or die($this->db_conn->error.__LINE__);
        if($rating_insert_query_connection){
            return $rating_insert_query_connection;
        } else {
            return false;
        }
    }

     // Show movie list connection
     public function select($show_movie_query) {
        $show_movie_query_connection = mysqli_query($this->db_conn, $show_movie_query) or die($this->db_conn->error.__LINE__);
        if(mysqli_num_rows($show_movie_query_connection)>0) {
            return $show_movie_query_connection;
        } else {
            return false;
        }
    }

    // delete movie
    public function delete_movie($delete_query) {
        $delete_movie_query_connection = mysqli_query($this->db_conn, $delete_query) or die($this->db_conn->error.__LINE__);
        if($delete_movie_query_connection) {
            return $delete_movie_query_connection;
        } else {
            return false;
        }
    }

    // Update movie
    public function update_movie($update_movie_query) {
        $update_query_connection = mysqli_query($this->db_conn, $update_movie_query) or die($this->db_conn->error.__LINE__);
        if($update_query_connection) {
            return $update_query_connection;
        } else {
            return false;
        }
    }

     // validation query connection
     public function validation($validation_query){
        $validation_query_connection = mysqli_query($this->db_conn, $validation_query) or die($this->db_conn->error.__LINE__);
        if($validation_query_connection){
            return $validation_query_connection;
        } else {
            return false;
        }
    }


     // Prepare and execute prepared statement
    public function prepareAndExecute($query, $params) {
        $stmt = $this->db_conn->prepare($query);
        if ($stmt === false) {
            die("Error in prepare statement: " . $this->db_conn->error);
        }

        if (!empty($params)) {
            $stmt->bind_param(...$params);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

        return $result;
    }



    // Execute regular SQL query
    public function executeQuery($query) {
        $result = mysqli_query($this->db_conn, $query);
        if ($result === false) {
            die("Error in executing query: " . mysqli_error($this->db_conn));
        }

        return $result;
    }


    // Search query connection
    public function search_movie($search_query){
        $search_query_connection = mysqli_query($this->db_conn, $search_query) or die($this->db_conn->error.__LINE__);
        if($search_query_connection){
            return $search_query_connection;
        } else {
            return false;
        }
    }


}

// Get a single instance of the database object
$db = Database::getInstance();

// Establish database connection
$db_conn = $db->db_connect();