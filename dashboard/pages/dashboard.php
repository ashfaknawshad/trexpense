<?php
session_start();
include_once "../db_connection.php";


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

// Fetch user details including totals from the user table
$user_id = $_SESSION['user_id'];
$sql = "SELECT total_income, total_expenses, total_fixed_savings, total_equity, net_balance FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($total_income, $total_expenses, $total_fixed_savings, $total_equity, $net_balance);
$stmt->fetch();
$stmt->close();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <div class="header--wrapper">
        <div class="header--title">
            <span><?php echo htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']); ?></span>
            <h2>Dashboard</h2>
        </div>
        <form action="" method="GET">
            <div class="user--info">
                <div class="search--box">
                    <button type="submit"><i class="fa-solid fa-search"></i></button>
                    <input type="text" placeholder="Description or Category" id="" name="search">
                </div>
                <div class="circle-container">
                
                    <img src="<?php echo htmlspecialchars($_SESSION['profile_picture']); ?>" alt="user-icon" >
                
                </div>
                
            </div>
        </form>
    </div>

    <div class="card--container">
        <h3 class="main--title">Today's data </h3>
        <div class="card--wrapper">
            <div class="payment--card light--green">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Total Income</span>
                        <span class="amount--value">LKR.<?php echo htmlspecialchars(number_format($total_income, 2)); ?></span>
                    </div>
                    <i class="fa-solid fa-circle-dollar-to-slot icon dark--green"></i>
                </div>
                <span class="card--detail">**** **** **** 3484</span>
            </div>

            <div class="payment--card light--red">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Total Expenses</span>
                        <span class="amount--value">LKR.<?php echo htmlspecialchars(number_format($total_expenses, 2)); ?></span>
                    </div>
                    <i class="fa-solid fa-money-bill-transfer icon dark--red"></i>
                </div>
                <span class="card--detail">**** **** **** 3484</span>
            </div>

            <div class="payment--card light--purple">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Fixed Savings</span>
                        <span class="amount--value">LKR.<?php echo htmlspecialchars(number_format($total_fixed_savings, 2)); ?></span>
                    </div>
                    <i class="fa-solid fa-piggy-bank icon dark--purple"></i>
                </div>
                <span class="card--detail">**** **** **** 3484</span>
            </div>

            <div class="payment--card light--blue">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Net Balance</span>
                        <span class="amount--value">LKR.<?php echo htmlspecialchars(number_format($net_balance, 2)); ?></span>
                    </div>
                    <i class="fa-solid fa-wallet icon dark--blue"></i>
                </div>
                <span class="card--detail">**** **** **** 3484</span>
            </div>
        </div>
    </div>

    <div class="tabular--wrapper">
        <h3 class="main--title">Finance Data</h3>
        <div class="table--container">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Transaction Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch transactions for the user
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id, transaction_type, description, amount, category, status, date FROM transactions WHERE user_id = ? ORDER BY date DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $transactionType = ucfirst($row["transaction_type"]);
                            $Status = ucfirst($row["status"]);

                            // Set the color class based on the transaction type
                            switch (strtolower($transactionType)) {
                                case 'income':
                                    $colorClass = 'income';
                                    break;
                                case 'expenses':
                                    $colorClass = 'expense';
                                    break;
                                case 'fixed savings':
                                    $colorClass = 'fixed-savings';
                                    break;
                                case 'equity':
                                    $colorClass = 'equity';
                                    break;
                                default:
                                    $colorClass = ''; // default class if needed
                                    break;
                            }

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                            echo "<td class='$colorClass'>" . htmlspecialchars($transactionType) . "</td>";
                            echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                            echo "<td> LKR." . htmlspecialchars(number_format($row["amount"], 2)) . "</td>";
                            echo "<td>" . htmlspecialchars($row["category"]) . "</td>";
                            echo "<td>" . htmlspecialchars($Status) . "</td>";
                            echo "<td><button class='deleteBtn' data-id='" . $row['id'] . "'>Delete</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No transactions found.</td></tr>";
                    }

                    // Close the statement and connection
                    $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">Net Balance : LKR.<?php echo htmlspecialchars(number_format($net_balance, 2)); ?></td>
                    </tr>
                </tfoot>
            </table>
            <button id="openModalBtn">+ Add New Transaction</button>
        </div>
    </div>
</body>
</html>
