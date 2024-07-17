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
$dob = $_SESSION['dob'];
$gender = $_SESSION['gender'];
$profilePicture = $_SESSION['profile_picture'];

// Convert dob to desired format
$dobFormatted = (new DateTime($dob))->format('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <link rel="stylesheet" href="styles.css"> <!-- Replace with your stylesheet path -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome for icons -->
</head>
<body>
    <div class="header--wrapper">
        <h2 class="header--title">User Settings</h2>
    </div>

    <div class="profile--container">
        <div class="card--container">
            <h2 >Edit Profile Information</h2>
            <form id="profileForm" action="update_profile.php" method="POST">
                <div class="form--group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
                </div>
                <div class="form--group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
                </div>
                <div class="form--group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="form--group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="m" <?php echo ($gender === 'm') ? 'selected' : ''; ?>>Male</option>
                        <option value="f" <?php echo ($gender === 'f') ? 'selected' : ''; ?>>Female</option>
                        <option value="o" <?php echo ($gender === 'o') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="form--group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dobFormatted); ?>" required>
                </div>
                <div class="form--group">
                    <button type="submit">Save Changes</button>
                </div>
            </form>
        </div>
        
        <div class="profile--container propicupdate">
        <form action="update_profile_picture.php" method="POST" enctype="multipart/form-data">
            <h2>Current Profile Picture</h2>
            <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture">
            <h2>Upload New Profile Picture</h2>
            <div class="input-group">
                <input type="file" name="profilePicture" id="profilePicture" accept="image/*">
            </div>
            <button type="submit">Upload Picture</button>
        </form>

        </div>



       
