<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userloggedin'])) {
    header('Location: login.php');
    exit();
}

include_once "db_connection.php";  // Adjust the path as per your file structure

// Handle file upload
if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profilePicture']['tmp_name'];
    $fileName = $_FILES['profilePicture']['name'];
    $fileSize = $_FILES['profilePicture']['size'];
    $fileType = $_FILES['profilePicture']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Generate unique filename for storage
    $newFileName = "profile_" . uniqid('', true) . '.' . $fileExtension;

    // Directory where uploaded files are saved
    $uploadDirectory = 'uploads/';

    // Move uploaded file to the specified directory
    if (move_uploaded_file($fileTmpPath, $uploadDirectory . $newFileName)) {
        // Update profile picture in database for the current user
        $userId = $_SESSION['user_id'];
        $profilePicturePath = $uploadDirectory . $newFileName;

        $sql = "UPDATE user SET profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $profilePicturePath, $userId);
        $stmt->execute();
        $stmt->close();

        // Update session variable with new profile picture path
        $_SESSION['profile_picture'] = $profilePicturePath;

        // Redirect back to settings page with success message
        header('Location: index.php?upload=success');
        exit();
    } else {
        // Redirect back to settings page with error message
        header('Location: index.php?upload=error');
        exit();
    }
} else {
    // Redirect back to settings page if file upload failed
    header('Location: index.php?upload=failed');
    exit();
}
?>
