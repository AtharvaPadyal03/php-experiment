<?php
include("connect.php");

// Fetch the last inserted message
$query = "SELECT * FROM messages ORDER BY id DESC LIMIT 1";
$result = mysqli_query($con, $query);
$messageData = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Sent - TechCon 2025</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            color: #444;
        }
        header {
            background-color: #f93f22;
            color: white;
            padding: 25px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        section {
            padding: 25px;
            margin: 40px auto;
            max-width: 700px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        section h2 {
            color: #007bff;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        .success {
            color: #28a745;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .message-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            text-align: left;
            margin-top: 20px;
        }
        .message-box p {
            margin: 10px 0;
            font-size: 1.1rem;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            font-size: 1.1rem;
            font-weight: bold;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Message Sent Successfully!</h1>
    </header>

    <section>
        <div class="success">Thank you for your message!</div>

        <?php if ($messageData): ?>
            <div class="message-box">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($messageData['sender_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($messageData['sender_email']); ?></p>
                <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($messageData['message'])); ?></p>
            </div>
        <?php else: ?>
            <p>Something went wrong. No message found.</p>
        <?php endif; ?>

        <a href="index.php" class="back-btn">Back to Home</a>
    </section>
</body>
</html>
