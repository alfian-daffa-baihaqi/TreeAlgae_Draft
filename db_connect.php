<?php
// Database connection settings
$host = "punyadaffa.my.id";
$user = "punyada1_admin1";
$password = "punyadaffa1";
$database = "punyada1_treealgae";

// Connect to MySQL database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>