<?php
session_start();
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]);
    if (!empty($title) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $content);
        $stmt->execute();
        header("Location: dashboard.php");
    } else {
        echo "All fields are required.";
    }
}
?>
<form method="POST">
  Title: <input type="text" name="title" required><br>
  Content:<br><textarea name="content" required></textarea><br>
  <button type="submit">Post</button>
</form>