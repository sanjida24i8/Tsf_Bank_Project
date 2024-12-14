<?php

// Include the database connection
include 'partials/_dbconnect.php';

// Check if the transfer form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the form data (sender, receiver, balance to transfer)
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $balance = $_POST['balance'];  // Balance instead of amount

    // Check if sender has sufficient balance
    $checkSenderSql = "SELECT `balance` FROM `users` WHERE `user_id` = '$sender_id'";
    $senderResult = mysqli_query($conn, $checkSenderSql);

    if ($senderResult) {
        $senderData = mysqli_fetch_assoc($senderResult);
        $sender_balance = $senderData['balance'];

        if ($sender_balance >= $balance) {
            // Deduct balance from sender's account
            $updateSenderSql = "UPDATE `users` SET `balance` = `balance` - '$balance' WHERE `user_id` = '$sender_id'";
            $senderUpdateResult = mysqli_query($conn, $updateSenderSql);

            if ($senderUpdateResult) {
                // Add balance to receiver's account
                $updateReceiverSql = "UPDATE `users` SET `balance` = `balance` + '$balance' WHERE `user_id` = '$receiver_id'";
                $receiverUpdateResult = mysqli_query($conn, $updateReceiverSql);

                if ($receiverUpdateResult) {
                    // Log the transaction in the transactions1 table
                    $transactionSql = "INSERT INTO `transactions1` (`sender_id`, `receiver_id`, `balance`) VALUES ('$sender_id', '$receiver_id', '$balance')";
                    mysqli_query($conn, $transactionSql);

                    echo "<script>alert('Transfer Successful!');</script>";
                } else {
                    echo "<script>alert('Error updating receiver balance!');</script>";
                }
            } else {
                echo "<script>alert('Error updating sender balance!');</script>";
            }
        } else {
            echo "<script>alert('Insufficient balance in sender account!');</script>";
        }
    } else {
        echo "<script>alert('Error fetching sender data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/transfer.css">
    <title>Transfer Money</title>
</head>
<body>

    <?php include 'partials/_navbar.php'; ?>

    <div class="transfer-form">
        <h1>Transfer Money</h1>

        <!-- Transfer Form -->
        <form method="POST">
            <input type="text" name="sender_id" placeholder="Sender ID" required>
            <input type="text" name="receiver_id" placeholder="Receiver ID" required>
            <input type="number" name="balance" placeholder="Balance to Transfer" required>
            <button type="submit">Transfer</button>
        </form>
    </div>

    <?php include 'partials/_footer.php'; ?>

</body>
</html>
