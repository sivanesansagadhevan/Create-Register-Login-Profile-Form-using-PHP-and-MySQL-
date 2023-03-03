<?php
// start the session
session_start();

// check if user is already logged in, redirect to profile page
if (isset($_SESSION['user_id'])) {
  header('Location: profile.php');
  exit;
}

// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get form data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // connect to database
  $conn = new mysqli('localhost', 'username', 'password', 'database_name');

  // prepare SQL statement to check if email and password match
  $stmt = $conn->prepare('SELECT id FROM users WHERE email = ? AND password = ?');
  $stmt->bind_param('ss', $email, $password);
  $stmt->execute();
  $stmt->store_result();

  // if there's a match, set session and redirect to profile page
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $_SESSION['user_id'] = $user_id;
    header('Location: profile.php');
    exit;
  } else {
    $error_message = 'Invalid email or password';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <?php if (isset($error_message)) { ?>
    <div><?php echo $error_message; ?></div>
  <?php } ?>
  <form method="POST">
    <label>Email</label><br>
    <input type="email" name="email"><br>
    <label>Password</label><br>
    <input type="password" name="password"><br>
    <input type="submit" value="Login">
  </form>
</body>
</html>
