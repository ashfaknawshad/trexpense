<?php
session_start();
include_once "db_connection.php";

if (!isset($_SESSION['userloggedin'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$feedback = $_POST['feedback'];

// Insert the testimonial into the database
$sql = "INSERT INTO testimonials (user_id, feedback) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("is", $user_id, $feedback);
$stmt->execute();

if ($stmt->errno) {
    die('Error in executing query: ' . htmlspecialchars($stmt->error));
}

$stmt->close();

header('Location: index.php?message=Testimonial submitted successfully');
exit();
?>
