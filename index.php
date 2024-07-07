<!doctype html>
<html lang="en">

 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - TrExpense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicons -->
    <link href="https://i.ibb.co/m0qwzgZ/trexpense-favicon.png" rel="icon">
    <link href="https://i.ibb.co/kG3Pn2M/trexpense-apple-touch-icon.png" rel="apple-touch-icon">
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<?php
      include_once('nav-common.php');
    ?>

    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to TrExpense</h1>
        <p class="lead">Manage your finances with ease using TrExpense. Keep track of your spending, stay within budget, and achieve your financial goals.</p>
        <hr class="my-4">
        <h3 class="display-7 mb-4">Ready for your savings journey?</h3>
        <a class="btn btn-success btn-lg" href="register.php" role="button">Register Now!</a>
        
    </div>

    <div class="container">
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Balance</h5>
                        <p class="card-text">$0.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Budget</h5>
                        <p class="card-text">$0.00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            Already have an account? <a  href="login.php" role="button">Login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
