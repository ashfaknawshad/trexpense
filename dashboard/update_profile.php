<?php
session_start();

if (!isset($_SESSION['userloggedin'])) {
    header('Location: login.php');
    exit();
}

// Include your database connection file here
include_once "db_connection.php";

// Retrieve user inputs
$user_id = $_SESSION['user_id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];

// Prepare update statement
$sql = "UPDATE user SET firstname = ?, lastname = ?, email = ?, gender = ?, dob = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $firstName, $lastName, $email, $gender, $dob, $user_id);

// Execute update
if ($stmt->execute()) {
    // Update session variables with new data
    $_SESSION['firstname'] = $firstName;
    $_SESSION['lastname'] = $lastName;
    $_SESSION['userloggedin'] = $email;
    $_SESSION['gender'] = $gender;
    $_SESSION['dob'] = $dob;

    // Redirect back to profile page with success message
    header('Location: index.php?message=Profile updated successfully');
} else {
    // Redirect back to profile page with error message
    header('Location: index.php?error=Failed to update profile');
}

$stmt->close();
$conn->close();
?>
