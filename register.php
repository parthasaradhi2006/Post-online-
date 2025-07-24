<?php
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    if (!empty($username) && !empty($password) && !empty($role)) {
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        $stmt->execute();
        echo "Registration successful. <a href='login.php'>Login</a>";
    } else {
        echo "All fields are required.";
    }
}
?>
<form method="POST">
  Username: <input type="text" name="username" required><br>
  Password: <input type="password" name="password" required><br>
  Role: <select name="role">
    <option value="admin">Admin</option>
    <option value="editor">Editor</option>
  </select><br>
  <button type="submit">Register</button>
</form>