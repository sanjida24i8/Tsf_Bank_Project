<?php

// Include the database connection
include 'partials/_dbconnect.php';

// Fetch all transactions from the transactions1 table
$sql = "SELECT * FROM `transactions1`";
$result = mysqli_query($conn, $sql);

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
    <link rel="stylesheet" href="css/table.css">
    <title>Transaction Log</title>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>

    <div class="cover"></div>

    <h1>Transaction Log</h1>
    <div class="all_users" style="height: 500px;">
        <table>
            <tr>
                <th>ID</th>
                <th>Sender ID</th>
                <th>Receiver ID</th>
                <th>Balance</th>
                <th>Date & Time</th>
            </tr>
            <?php 
            // Fetch each transaction and display it in a table row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['sender_id']."</td>
                    <td>".$row['receiver_id']."</td>
                    <td>".$row['balance']."</td>
                    <td>".$row['time']."</td>
                </tr>
                ";
            }
            ?>
        </table>
    </div>

   
    <!-- Script -->
    <script src="js/navscroll.js"></script>
</body>

</html>
