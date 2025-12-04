<?php
/*
  Student: Naiim Mayes
  Date: 2025-10-17
*/

header('Content-Type: text/html; charset=utf-8');

// include DB connection
require_once 'db.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method not allowed.";
    exit;
}

// Simple server-side validation & sanitization
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$title    = isset($_POST['title'])    ? trim($_POST['title'])    : '';
$category = isset($_POST['category']) ? trim($_POST['category']) : '';
$message  = isset($_POST['message'])  ? trim($_POST['message'])  : '';

$errors = [];
if ($username === '') $errors[] = "Username is required.";
if ($title === '')    $errors[] = "Post title is required.";
if ($category === '') $errors[] = "Category is required.";
if ($message === '')  $errors[] = "Message cannot be empty.";

if (!empty($errors)) {
    // Simple error feedback — in a real app, re-display form with preserved values
    foreach ($errors as $err) {
        echo "<p style='color:red;'>".htmlspecialchars($err)."</p>";
    }
    echo "<p><a href='forum.php'>Back to forum</a></p>";
    exit;
}

// Insert with prepared statement to prevent SQL injection
$sql = "INSERT INTO posts (username, title, category, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "<p>Prepare failed: " . htmlspecialchars($conn->error) . "</p>";
    exit;
}

$stmt->bind_param('ssss', $username, $title, $category, $message);
$ok = $stmt->execute();

if ($ok) {
    // redirect back to forum with success flag (Post/Redirect/Get)
    header("Location: forum.php?status=success");
    exit;
} else {
    echo "<p>Insert failed: " . htmlspecialchars($stmt->error) . "</p>";
    echo "<p><a href='forum.php'>Back</a></p>";
}

$stmt->close();
$conn->close();
?>
