<?php
session_start();
include 'home_db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Fetch user by email
    $stmt = $conn->prepare("SELECT id, name, password FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Login successful
            $_SESSION["customer_id"] = $id;
            $_SESSION["customer_name"] = $name;
            header("Location: home.php?success=Welcome+" . urlencode($name));
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Customer Login</title>
  <link rel="stylesheet" href="home_style.css">
</head>
<body>
<div class="container">
  <h1>Customer Login</h1>

  <?php if ($error): ?>
    <p class="error-msg"><?php echo $error; ?></p>
  <?php endif; ?>

  <form method="POST" action="login.php" style="max-width: 400px;">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Log In</button>
  </form>
</div>
</body>
</html>
