
<?php
    session_start();
    if(!isset($_SESSION['userloggedin'])) {
        header('Location: ../login.php');
        exit();
    }
?>

<?php
    // Enable error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "trexpense";

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the form data
        $date = $_POST['date'];
        $transaction_type = $_POST['transaction_type'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        $user_id=$_SESSION['user_id'];

        

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("INSERT INTO transactions (user_id, transaction_type, description, amount, category, status, date)
VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $user_id, $transaction_type, $description, $amount, $category, $status, $date);

        if ($stmt->execute()) {
            header('Location:index.php?inserted');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }


    //Check if a delete request is made
    if(isset($_GET['delid'])){
        $delid = $_GET['delid'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "DELETE FROM transactions WHERE id = $delid";
        if($conn->query($sql) === TRUE){
            header('Location:index.php?deleted');
            exit();
        };
        $conn->close();
    }
    
?>