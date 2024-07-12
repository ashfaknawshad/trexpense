<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userloggedin'])) {
    header('Location: login.php');
    exit();
}

// Retrieve user details from session
$firstName = $_SESSION['firstname'];
$lastName = $_SESSION['lastname'];
$email = $_SESSION['userloggedin'];
$createdDate = $_SESSION['createdDate'];
$dob = $_SESSION['dob'];


// Convert dob and createdDate to desired format
$dobFormatted = (new DateTime($dob))->format('jS \of F, Y');
$createdDateFormatted = (new DateTime($createdDate))->format('jS \of F, Y');
?>

<div class="header--wrapper">
    <h2 class="header--title">User Profile</h2>
    <div class="user--info">
        <img src="profile_picture.jpg" alt="Profile Picture">
        <div>
            <h4>Username</h4>
            <p>user@example.com</p>
        </div>
    </div>
</div>
<div class="profile--container">
    <div class="card--container">
        <h3 class="main--title">Profile Information</h3>
        <div class="profile--info">
            <div class="info--item">
                <h4>Full Name:</h4>
                <p><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></p>
            </div>
            <div class="info--item">
                <h4>Email:</h4>
                <p><?php echo htmlspecialchars($email); ?></p>
            </div>
            <div class="info--item">
                <h4>Phone:</h4>
                <p>+123 456 7890</p>
            </div>
            <div class="info--item">
                <h4>Date of Birth:</h4>
                <p><?php echo htmlspecialchars($dobFormatted); ?></p>
            </div>
            <div class="info--item">
                <h4>Joined:</h4>
                <p><?php echo htmlspecialchars($createdDateFormatted); ?></p>
            </div>
        </div>
    </div>
</div>
