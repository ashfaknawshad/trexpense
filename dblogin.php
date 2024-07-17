<?php
session_start();

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$uname = $_POST['email'];
$pass = $_POST['password'];

//Handling the Admin Login to Access UsersList.php 
if($uname == "admin@gmail.com" && $pass == "admin2024"){
    $_SESSION['adminloggedin'] = true;
    header('Location:userslist.php');
    exit();
}

//Handling the User Login to Access Dashboard.php

// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trexpense";

// Prepare and execute the SQL query to fetch the user details
$conn = new mysqli($servername, $username, $password, $dbname);
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $uname);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Verify the password
    if ($user['password'] === $pass) {
        // Store user details in session
        $_SESSION['userloggedin'] = $uname;
        $_SESSION['firstname'] = $user['firstName'];
        $_SESSION['lastname'] = $user['lastName'];
        $_SESSION['gender'] = $user['gender'];
        $_SESSION['dob'] = $user['dob'];
        $_SESSION['createdDate'] = $user['createdDate'];
        $_SESSION['profile_picture'] = $user['profile_picture'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['total_income'] = $user['total_income'];
        $_SESSION['total_expenses'] = $user['total_expenses'];
        $_SESSION['total_fixed_savings'] = $user['total_fixed_savings'];
        $_SESSION['total_equity'] = $user['total_equity'];
        $_SESSION['net_balance'] = $user['net_balance'];
        



        

        // Redirect to the desired page
        header("Location: dashboard/index.php");
        exit();
    } else {
        // Invalid password
        header("Location: login.php?error");
        exit();
    }
} else {
    // Invalid email or user does not exist
    header("Location: login.php?error");
    exit();
}

// Close the database connection
$stmt->close();
$conn->close();
?>
