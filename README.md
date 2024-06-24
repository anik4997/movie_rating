Movie Rating System
Overview
The Movie Rating System is a web application that allows users to view a list of movies, search for movies, and rate them. It also provides admin functionalities to add, edit, and delete movies.

Features
Guest Access: Guests can view the list of movies and search for movies without logging in.
User Authentication: Users can register and log in to the system.
Movie Rating: Logged-in users can rate movies.
Admin Features: Admins can add, edit, and delete movies.
Technologies Used
Frontend: HTML, CSS, Bootstrap
Backend: PHP
Database: MySQL
Installation
Prerequisites
PHP 7.x or higher
MySQL 5.x or higher
Web server (e.g., Apache, Nginx)
Steps
1. Clone the repository: git clone https://github.com/your-username/movie-rating-system.git
2. Navigate to the project directory: cd movie-rating-system
3. Import the database:
Create a MySQL database.
Import the SQL file located at database/movie_rating_system.sql into your database.
4. Configure the database connection:

Open classes/Database.php.
Set your database host, username, password, and database name.
private $host = 'your-database-host';
private $user = 'your-database-username';
private $password = 'your-database-password';
private $database = 'your-database-name';
5. Start your web server and navigate to the project directory in your web browser.

Usage
User Authentication:
Register: Users can register by filling out the registration form.
Login: Users can log in with their email and password.
Movie List:
Guests and logged-in users can view the list of movies.
Guests and logged-in users can search for movies using the search bar.
Movie Rating:
Logged-in users can rate movies by selecting a rating and submitting it.
Admin Features:
Admins can add new movies by navigating to the add_movie.php page.
Admins can edit or delete existing movies by clicking the respective buttons on the movie list page.

Project Structure:

movie-rating-system/
│
├── classes/
│   ├── Database.php        // Database connection class
│   ├── FetchMovie.php      // Class for fetching movie data
│   ├── FetchUser.php       // Class for fetching user data
│   ├── Ratings.php         // Class for handling movie ratings
│
├── database/
│   └── movie_rating_system.sql   // SQL file to create and populate the database
│
├── style/
│   └── style.css           // Custom CSS styles
│
├── add_movie.php           // Page for adding a new movie
├── delete_movie.php        // Page for deleting a movie
├── edit_movie.php          // Page for editing a movie
├── index.php               // Home page (login/register)
├── logout.php              // Page for logging out
├── movie_list.php          // Main page displaying the list of movies
├── search.php              // Page for handling search results
│
└── README.md               // This README file


Acknowledgements:
Bootstrap for the frontend framework.
PHP for the server-side scripting language.
MySQL for the database management system.
