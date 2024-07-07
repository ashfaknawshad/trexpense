<!DOCTYPE html>
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
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- <style>
    .field-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .input-group {
        position: relative;
    }
    .error-message {
        color: red;
    }
</style> -->

<?php include_once('nav-common.php'); ?>

<div class="container mb-5">
    <h1 class=" text-center mt-5 mb-4">Let's get started!</h1>
    <hr class="my-4">
</div>
<div class="container">
    <form action="dbregister.php" method="POST" class="regform mb-5 text-center" onsubmit="return validatePassword()">
        <div class="form-group mb-2">
            <input type="email" onkeyup="hideAlertBox()" class="form-control text-center" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="mb-4">
            <input type="text" class="form-control data-in text-center" id="firstName" name="fname" aria-describedby="firstNameHelp" placeholder="First Name">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control data-in text-center" id="lastName" name="lname" aria-describedby="lastNameHelp" placeholder="Last Name">
        </div>
        <div class="mb-4 input-group">
            <input type="password" class="form-control data-in text-center" id="password" name="password" aria-describedby="passwordHelp" placeholder="Password">
            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
        <small id="passwordHelp" class="form-text text-muted">Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one symbol.</small>
        <div id="passwordError" class="error-message"></div>
        <div class="mb-4">
            <small id="dobHelp" class="form-text">Date of Birth</small>                        
            <input type="date" class="form-control data-in text-center" id="date" name="dob" placeholder="Date of Birth">
        </div>
        <div class="mb-4">
            <div><label for="gender" class="form-label">Gender</label></div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                <label class="form-check-label" for="female">Female</label>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <button type="submit" class="btn submit-btn btn-dark">Create Account</button>
            </div>
            <div class="col-md-6 text-md-right">
                Returning user? <a href="login.php">Sign in!</a>
            </div>
        </div>
        <?php
            if(isset($_GET['error'])) {
                echo('
                <div id="alertbox" class="alert alert-danger mt-3" role="alert">
                    User with this email already exists
                </div>');
            }
        ?>
    </form>
</div>

<!-- Hide alertbox JS -->
<script>
    function hideAlertBox() {
        const alertBox = document.getElementById("alertbox");
        alertBox.style.display = "none";
    }
</script>

<!-- Password toggle show/hide JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });

    function validatePassword() {
        var password = document.getElementById("password").value;
        var errorMessage = "";
        var passwordHelp = document.getElementById("passwordHelp");

        // Check if password meets the criteria
        var hasUpperCase = /[A-Z]/.test(password);
        var hasLowerCase = /[a-z]/.test(password);
        var hasNumbers = /\d/.test(password);
        var hasNonalphas = /\W/.test(password);
        var isLongEnough = password.length >= 8;

        if (!isLongEnough) {
            errorMessage = "Password must be at least 8 characters long.";
        } else if (!hasUpperCase) {
            errorMessage = "Password must contain at least one uppercase letter.";
        } else if (!hasLowerCase) {
            errorMessage = "Password must contain at least one lowercase letter.";
        } else if (!hasNumbers) {
            errorMessage = "Password must contain at least one number.";
        } else if (!hasNonalphas) {
            errorMessage = "Password must contain at least one special character.";
        }

        if (errorMessage) {
            document.getElementById("passwordError").innerText = errorMessage;
            return false; // Prevent form submission
        } else {
            document.getElementById("passwordError").innerText = "";
            return true; // Allow form submission
        }
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
