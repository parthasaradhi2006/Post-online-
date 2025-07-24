<?php
session_start();
include "config.php";
if ($_SESSION["role"] !== "admin") {
    echo "Access denied.";
    exit;
}
$id = $_GET["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: dashboard.php");
}
$result = $conn->query("SELECT * FROM posts WHERE id=$id");
$post = $result->fetch_assoc();
?>
<form method="POST">
  Title: <input type="text" name="title" value="<?php echo $post['title']; ?>"><br>
  Content:<br><textarea name="content"><?php echo $post['content']; ?></textarea><br>
  <button type="submit">Update</button>
</form>