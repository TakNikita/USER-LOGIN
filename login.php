<?php
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "@Abcd1234";
$dbname = "nikitadb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["loginUsername"]) && isset($_POST["loginPassword"])) {
        // Process login form
        $username = $_POST["loginUsername"];
        $password = $_POST["loginPassword"];

        // Validate and authenticate user (you should hash passwords in production)
        $sql = "SELECT * FROM user_info WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Login successful!";
        } else {
            echo "Invalid username or password";
        }
    } elseif (isset($_POST["registerUsername"]) && isset($_POST["registerPassword"])) {
        // Process registration form
        $username = $_POST["registerUsername"];
        $password = $_POST["registerPassword"];

        // Insert new user into the database (you should hash passwords in production)
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
