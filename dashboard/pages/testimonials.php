<?php
session_start();
include_once "../db_connection.php";

if (!isset($_SESSION['userloggedin'])) {
    header('Location: login.php');
    exit();
}

// Retrieve user details from session
$user_id = $_SESSION['user_id'];
$firstName = $_SESSION['firstname'];
$lastName = $_SESSION['lastname'];
$email = $_SESSION['userloggedin'];

// Fetch testimonials from the database
$sql = "SELECT t.feedback, t.created_at, u.firstname, u.lastname, u.profile_picture
        FROM testimonials t
        JOIN user u ON t.user_id = u.id
        ORDER BY t.created_at DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Testimonials</title>
    <link rel="stylesheet" href="styles.css"> <!-- Replace with your stylesheet path -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome for icons -->
</head>
<body>
    <div class="header--wrapper testimonial--header">
        <h2 class="header--title">User Testimonials</h2>
    </div>

    <div class="testimonials--container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="testimonial--card">
                    <div class="profile--picture">
                        <img src="<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="Profile Picture">
                    </div>
                    <div class="testimonial--content">
                        <h3><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></h3>
                        <p><?php echo '"' . htmlspecialchars($row['feedback']) . '"'; ?></p>
                        <span class="testimonial--date"><?php echo htmlspecialchars(date('F j, Y \a\t h:i A', strtotime($row['created_at']))); ?></span>


                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No testimonials found.</p>
        <?php endif; ?>
    </div>

    <div class="add--testimonial">
        <h3>Add Feedback</h3>
        <form action="submit_testimonial.php" method="POST">
            <div class="form--group">
                <label for="feedback">Your Feedback</label>
                <textarea id="feedback" name="feedback" rows="4" required></textarea>
            </div>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
