<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'partials/_dbconnect.php';

    // Get data from POST request
    $name = $_POST['name'];
    $email = $_POST['email'];
    $balance = $_POST['balance'];  // Changed 'amount' to 'balance' as per your table

    // Check whether this user email already exists
    $existSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRow = mysqli_num_rows($result);

    if ($numExistRow > 0) {
        // If the user already exists
        echo "<script> alert('Email Already Exists! Please use another Email'); </script>"; 
    } else {
        // Inserting new user data
        $sql = "INSERT INTO `users` (`name`, `email`, `balance`) VALUES ('$name', '$email', '$balance')"; // Adjust column names here based on your table
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            echo "<script> alert('Congrats! New User Added'); </script>"; 
        } else {
            echo "<script> alert('Error: " . mysqli_error($conn) . "'); </script>"; 
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/index.css">
    <title>ADD USER</title>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>

    <div class="cover"></div>

    <div class="create">
        <h1>CREATE &nbsp; USER</h1>
        <div class="createUser">
            <div class="userimg">
                <img src="images/undraw_male_avatar_323b.svg" alt="user image">
            </div>
            <div class="userdata">
                <!-- Create user Form -->
                <form method="POST">
                    <input id="name" type="text" placeholder="NAME" name="name" required>
                    <input id="email" type="email" placeholder="EMAIL" name="email" required>
                    <input id="balance" type="number" placeholder="BALANCE" name="balance" required>  <!-- Changed 'amount' to 'balance' -->
                    <button type="submit">ADD USER</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <!-- scripts  -->
    <script src="js/navscroll.js"></script>
</body>

</html>
