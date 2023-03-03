<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit();
}

require_once('db.php');

// Get the user's data from the database
$db = new DB();
$user_id = $_SESSION['user_id'];
$result = $db->query("SELECT * FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
</head>
<body>
  <h1>Welcome, <?php echo $user['name']; ?>!</h1>
  <p>Your email address is: <?php echo $user['email']; ?></p>
  <a href="logout.php">Logout</a>
</body>
</html>
