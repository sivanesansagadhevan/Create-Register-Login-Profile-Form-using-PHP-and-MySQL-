<?php
// start the session
session_start();

// check if user is logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

// get user data from database
$conn = new mysqli('localhost', 'username', 'password', 'database_name');
$stmt = $conn->prepare('SELECT name, email, age, dob, contact FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($name, $email, $age, $dob, $contact);
$stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
</head>
<body
