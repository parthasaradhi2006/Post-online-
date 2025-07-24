<?php
session_start();
include "config.php";
if ($_SESSION["role"] !== "admin") {
    echo "Access denied.";
    exit;
}
$id = $_GET["id"];
$conn->query("DELETE FROM posts WHERE id=$id");
header("Location: dashboard.php");
?>