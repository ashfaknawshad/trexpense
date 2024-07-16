

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard </title>
    

    <link rel="stylesheet" href="dashboard.css">
    <!-- Favicons -->
    <link href="https://i.ibb.co/m0qwzgZ/trexpense-favicon.png" rel="icon">
    <link href="https://i.ibb.co/kG3Pn2M/trexpense-apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <ul class="menu">
                <li class="active" data-page="dashboard">
                    <a class="no-pointer">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li data-page="profile">
                    <a class="no-pointer">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li data-page="statistics">
                    <a class="no-pointer">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistics</span>
                    </a>
                </li>
                <li data-page="career">
                    <a class="no-pointer">
                        <i class="fas fa-briefcase"></i>
                        <span>Career</span>
                    </a>
                </li>
                <li data-page="faqs">
                    <a class="no-pointer">
                        <i class="fas fa-question-circle"></i>
                        <span>FAQs</span>
                    </a>
                </li>
                <li data-page="testimonials">
                    <a class="no-pointer">
                        <i class="fas fa-star"></i>
                        <span>Testimonials</span>
                    </a>
                </li>
                <li data-page="settings">
                    <a class="no-pointer">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="../index.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main--content" id="content">
        <!-- Dynamic content will be loaded here -->
         
    </div> 
     <!-- Modal HTML structure -->
     <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Add New Entry</h2>
                <form action="add_transactions.php" method="POST">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required><br><br>
                    <label for="transaction_type">Transaction Type:</label>
                    <select id="transaction_type" name="transaction_type" required>
                        <option value="income">Income</option>
                        <option value="expenses">Expenses</option>
                    </select><br><br>
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" required><br><br>
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" required><br><br>
                    <label for="category">Category:</label>
                    <input type="text" id="category" name="category" required><br><br>
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="done">Done</option>
                        <option value="pending">Pending</option>
                    </select><br><br>
                    <button type="submit">Add Entry</button>
                </form>
            </div>
        </div>
    
    <script src="app.js"></script>
</body>
</html>
