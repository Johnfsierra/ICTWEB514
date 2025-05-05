<?php
include 'home_db.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email is already registered
    $check = $conn->prepare("SELECT id FROM customers WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Email is already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO customers (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        if ($stmt->execute()) {
            $success = "Registration successful!";
        } else {
            $error = "Error: Could not register.";
        }
        $stmt->close();
    }
    $check->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Customer Registration</title>
  <link rel="stylesheet" href="home_style.css">
</head>
<body>
<div class="container">
  <h1>Register</h1>

  <?php
  if ($success) echo "<p class='success-msg'>$success</p>";
  if ($error) echo "<p class='error-msg'>$error</p>";
  ?>

  <form method="POST" action="register.php" style="max-width: 400px;">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
  </form>
</div>
</body>
</html>
