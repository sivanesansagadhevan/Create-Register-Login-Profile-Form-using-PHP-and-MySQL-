<?php
// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // connect to database
  $conn = new mysqli('localhost', 'username', 'password', 'database_name');

  // prepare SQL statement to insert data into database
  $stmt = $conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
  $stmt->bind_param('sss', $name, $email, $password);

  // execute the statement and check if it's successful
  if ($stmt->execute()) {
    echo 'success';
  } else {
    echo 'Error: ' . $conn->error;
  }
}
?>
