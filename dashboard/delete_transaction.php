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
    // Get the transaction ID
    $transaction_id = $_POST['delete_id'];
    $user_id = $_SESSION['user_id'];

    // Fetch the transaction details to get the amount and type before deletion
    $fetch_transaction_sql = "SELECT transaction_type, amount FROM transactions WHERE id = ? AND user_id = ?";
    $fetch_stmt = $conn->prepare($fetch_transaction_sql);
    $fetch_stmt->bind_param("ii", $transaction_id, $user_id);
    $fetch_stmt->execute();
    $fetch_stmt->bind_result($transaction_type, $amount);
    $fetch_stmt->fetch();
    $fetch_stmt->close();

    // Delete the transaction
    $delete_transaction_sql = "DELETE FROM transactions WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_transaction_sql);
    $delete_stmt->bind_param("ii", $transaction_id, $user_id);

    if ($delete_stmt->execute()) {
        // Transaction successfully deleted, now update user totals
        update_user_totals($conn, $user_id, $transaction_type, -$amount);

        header('Location: index.php?deleted');
        exit();
    } else {
        echo "Error: " . $delete_stmt->error;
    }

    // Close the statement
    $delete_stmt->close();
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
?>
