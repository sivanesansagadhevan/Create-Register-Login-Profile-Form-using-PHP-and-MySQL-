<?php
session_start();
require_once('config.php');
require_once('db.php');

// If the user is already logged in, redirect to the profile page
if (isset($_SESSION['user_id'])) {
  header('Location: profile.php');
  exit();
}

// Handle the login form submission
if (isset($_POST['login'])) {
  // Get the user input from the login form
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate the user input
  $errors = array();
  if (empty($email)) {
    $errors[] = 'Email is required';
  }
  if (empty($password)) {
    $errors[] = 'Password is required';
  }

  // If there are no errors, attempt to log the user in
  if (count($errors) == 0) {
    $db = new DB();
    $result = $db->query("SELECT * FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
      // The user is authenticated, store their ID in the session and redirect to the profile page
      $_SESSION['user_id'] = $user['id'];
      header('Location: profile.php');
      exit();
    } else {
      // The email or password is incorrect, show an error message
      $errors[] = 'Email or password is incorrect';
    }
  }

  // If there are errors, return them as a JSON response
  if (count($errors) > 0) {
    http_response_code(
