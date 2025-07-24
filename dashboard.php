<?php
session_start();
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
$isAdmin = ($_SESSION["role"] === "admin");
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>
<h2>Welcome, <?php echo $_SESSION["username"]; ?> (<?php echo $_SESSION["role"]; ?>)</h2>
<a href="create.php">Add Post</a> | <a href="logout.php">Logout</a>
<hr>
<?php while ($row = $result->fetch_assoc()) { ?>
  <h3><?php echo htmlspecialchars($row["title"]); ?></h3>
  <p><?php echo htmlspecialchars($row["content"]); ?></p>
  <?php if ($isAdmin): ?>
    <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a> |
    <a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
  <?php endif; ?>
  <hr>
<?php } ?>