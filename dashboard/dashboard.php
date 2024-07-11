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
?>


<div class="header--wrapper">
    <div class="header--title">
        <span><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></span>
        <h2>Dashboard</h2>
    </div>
    <div class="user--info">
        <div class="search--box">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Search" id="">
        </div>
        <img src="//i.ibb.co/4NKGSv5/user-icon-in-trendy-flat-style-isolated-on-grey-background-user-symbol-for-your-web-site-design-logo.jpg" alt="user-icon">
    </div>
</div>
<div class="card--container">
    <h3 class="main--title">Today's data</h3>
    <div class="card--wrapper">
        <div class="payment--card light--green">
            <div class="card--header">
                <div class="amount">
                    <span class="title">Total Income</span>
                    <span class="amount--value">$ 10,000</span>
                </div>
                <i class="fa-solid fa-circle-dollar-to-slot icon dark--green"></i>
            </div>
            <span class="card--detail">**** **** **** 3484</span>
        </div>

        <div class="payment--card light--red">
            <div class="card--header">
                <div class="amount">
                    <span class="title">Total Expenses</span>
                    <span class="amount--value">$ 10,000</span>
                </div>
                <i class="fa-solid fa-money-bill-transfer icon dark--red"></i>
            </div>
            <span class="card--detail">**** **** **** 3484</span>
        </div>

        <div class="payment--card light--purple">
            <div class="card--header">
                <div class="amount">
                    <span class="title">Fixed Savings</span>
                    <span class="amount--value">$ 10,000</span>
                </div>
                <i class="fa-solid fa-piggy-bank icon dark--purple"></i>
            </div>
            <span class="card--detail">**** **** **** 3484</span>
        </div>

        <div class="payment--card light--blue">
            <div class="card--header">
                <div class="amount">
                    <span class="title">Net Balance</span>
                    <span class="amount--value">$ 10,000</span>
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
                    <tr>
                        <td>
                            2022-11-11
                        </td>
                        <td>
                            Expenses
                        </td>
                        <td>
                            Clothing
                        </td>
                        <td>
                            $100
                        </td>
                        <td>
                            Personal Expenses
                        </td>
                        <td>
                            Done
                        </td>
                        <td><button>Edit</button></td>
                    </tr>
                    <tr>
                        <td>
                            2022-11-11
                        </td>
                        <td>
                            Expenses
                        </td>
                        <td>
                            Clothing
                        </td>
                        <td>
                            $100
                        </td>
                        <td>
                            Personal Expenses
                        </td>
                        <td>
                            Done
                        </td>
                        <td><button>Edit</button></td>
                    </tr>
                    <tr>
                        <td>
                            2022-11-11
                        </td>
                        <td>
                            Expenses
                        </td>
                        <td>
                            Clothing
                        </td>
                        <td>
                            $100
                        </td>
                        <td>
                            Personal Expenses
                        </td>
                        <td>
                            Done
                        </td>
                        <td><button>Edit</button></td>
                    </tr>
                    <tr>
                        <td>
                            2022-11-11
                        </td>
                        <td>
                            Expenses
                        </td>
                        <td>
                            Clothing
                        </td>
                        <td>
                            $100
                        </td>
                        <td>
                            Personal Expenses
                        </td>
                        <td>
                            Done
                        </td>
                        <td><button>Edit</button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">Total: $400</td>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>