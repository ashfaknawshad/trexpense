<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - TrExpense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicons -->
    <link href="https://i.ibb.co/x74SzZ2/techwave-favicon.png" rel="icon">
    <link href="https://i.ibb.co/fQppK8D/techwave-apple-touch-icon.png" rel="apple-touch-icon">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

<?php include_once('nav-common.php'); ?>

<div class="container mb-5">
    <h1 class="text-center mt-5 mb-4">Let's get started!</h3>
    <hr class="my-4">
</div>
<div class="container">
    <form action="dbregister.php" method="POST" class="regform mb-5 text-center" onsubmit="return validateForm()">
        <div class="form-group mb-2">
            <input type="email" onkeyup="hideAlertBox()" class="form-control text-center" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <div id="emailError" class="error-message"></div>
        </div>
        <div class="mb-4">
            <input type="text" class="form-control data-in text-center" id="firstName" name="fname" aria-describedby="firstNameHelp" placeholder="First Name" required>
        </div>
        <div class="mb-4">
            <input type="text" class="form-control data-in text-center" id="lastName" name="lname" aria-describedby="lastNameHelp" placeholder="Last Name" required>
        </div>
        <div class="mb-4 input-group">
            <input type="password" class="form-control data-in text-center" id="password" name="password" aria-describedby="passwordHelp" placeholder="Password" required>
        </div>
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePassword()">
            <label class="form-check-label" for="showPassword">
                Show Password
            </label>
        </div>
        <small id="passwordHelp" class="form-text text-muted">Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one symbol.</small>
        <div id="passwordError" class="error-message"></div>
        <div class="mb-4">
            <small id="dobHelp" class="form-text">Date of Birth</small>                        
            <input type="date" class="form-control data-in text-center" id="date" name="dob" placeholder="Date of Birth" required>
        </div>
        <div class="mb-4">
            <div><label for="gender" class="form-label">Gender</label></div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
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
        if (alertBox) {
            alertBox.style.display = "none";
        }
    }
</script>

<!-- Show/Hide Password JS -->
<script>
    function togglePassword() {
        var password = document.getElementById("password");
        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    }

    function validateForm() {
        const email = document.getElementById('exampleInputEmail1').value;
        const fname = document.getElementById('firstName').value;
        const lname = document.getElementById('lastName').value;
        const password = document.getElementById('password').value;
        const dob = document.getElementById('date').value;
        const genderMale = document.getElementById('male').checked;
        const genderFemale = document.getElementById('female').checked;

        if (email === "" || fname === "" || lname === "" || password === "" || dob === "" || (!genderMale && !genderFemale)) {
            alert("Please fill out all fields.");
            return false;
        }

        // Check if email contains "@" symbol
        if (!email.includes('@')) {
            document.getElementById('emailError').textContent = "Please enter a valid email address.";
            return false;
        } else {
            document.getElementById('emailError').textContent = "";
        }

        return validatePassword();
    }

    function validatePassword() {
        var password = document.getElementById("password").value;
        var errorMessage = "";

        var hasUpperCase = /[A-Z]/.test(password);
        var hasLowerCase = /[a-z]/.test(password);
        var hasNumbers = /\d/.test(password);
        var hasNonalphas = /\W/.test(password);

        if (password.length < 8) {
            errorMessage = "Password must be at least 8 characters long.";
        } else if (!hasUpperCase) {
            errorMessage = "Password must contain at least one uppercase letter.";
        } else if (!hasLowerCase) {
            errorMessage = "Password must contain at least one lowercase letter.";
        } else if (!hasNumbers) {
            errorMessage = "Password must contain at least one number.";
        } else if (!hasNonalphas) {
            errorMessage = "Password must contain at least one symbol.";
        }

        // Display error message if any
        var passwordError = document.getElementById("passwordError");
        if (errorMessage) {
            passwordError.textContent = errorMessage;
            return false;
        } else {
            passwordError.textContent = "";
            return true;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzK4Cp2JySg4l4PKDErP91G6HA6IRIB5SZu0uo0uoNmR" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-ho+pP2nHU6qODLy2k5bZT5lAA6Y1iQ0ynmL65btlCLrdk5siQbcG9r+z2aLe3d7K" crossorigin="anonymous"></script>
</body>
</html>
