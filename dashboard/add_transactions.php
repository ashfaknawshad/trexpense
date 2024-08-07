<?php
session_start();
include_once "db_connection.php"; // Include your database connection file

if (!isset($_SESSION['userloggedin'])) {
    header('Location: login.php');
    exit();
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trexpense";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $date = $_POST['date'];
    $transaction_type = $_POST['transaction_type'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $user_id = $_SESSION['user_id'];

    // Prepare and execute the SQL statement to insert transaction
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, transaction_type, description, amount, category, status, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $user_id, $transaction_type, $description, $amount, $category, $status, $date);

    if ($stmt->execute()) {
        // Transaction successfully inserted, now update user totals if necessary
        update_user_totals($conn, $user_id, $transaction_type, $amount);

        header('Location: index.php?inserted');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

/**
 * Function to update user totals based on transaction type
 */
function update_user_totals($conn, $user_id, $transaction_type, $amount) {
    // Initialize variables
    $total_income = 0;
    $total_expenses = 0;
    $total_fixed_savings = 0;
    $total_equity = 0;
    $net_balance = 0;

    // Fetch current totals from user table
    $fetch_totals_sql = "SELECT total_income, total_expenses, total_fixed_savings, total_equity FROM user WHERE id = ?";
    $fetch_stmt = $conn->prepare($fetch_totals_sql);
    $fetch_stmt->bind_param("i", $user_id);
    $fetch_stmt->execute();
    $fetch_stmt->bind_result($total_income, $total_expenses, $total_fixed_savings, $total_equity);
    $fetch_stmt->fetch();
    $fetch_stmt->close();

    // Update totals based on transaction type
    switch ($transaction_type) {
        case 'income':
            $total_income += $amount;
            break;
        case 'expenses':
            $total_expenses += $amount;
            break;
        case 'fixed savings':
            $total_fixed_savings += $amount;
            break;
        case 'equity':
            $total_equity += $amount;
            break;
        default:
            // Handle default case if needed
            break;
    }

    // Calculate net balance
    $net_balance = $total_income + $total_fixed_savings + $total_equity - $total_expenses;

    // Update user table with new totals
    $update_totals_sql = "UPDATE user SET total_income = ?, total_expenses = ?, total_fixed_savings = ?, total_equity = ?, net_balance = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_totals_sql);
    $update_stmt->bind_param("iiiiii", $total_income, $total_expenses, $total_fixed_savings, $total_equity, $net_balance, $user_id);
    $update_stmt->execute();
    $update_stmt->close();
}

