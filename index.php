<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !is_numeric($name)) {
        // Prepare the SQL statement
        $query = "INSERT INTO messages (sender_name, sender_email, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header("Location: done.php");
            exit;
        } else {
            echo "Error: Could not prepare the statement.";
        }
    } else {
        echo "Enter valid information.";
    }
}
?>


<!DOCTYPE html>
<head>
    <title>JSPM's RSCOE TechCon 2025</title>
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
        nav {
            background-color: #343a40;
            /* Dark Gray */
            text-align: center;
            padding: 12px 0;
        }
        nav a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 20px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
        nav a:hover {
            color: #ff6347;
            /* Tomato */
            text-decoration: underline;
        }
        section {
            padding: 25px;
            margin: 20px auto;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        section:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }
        section h2 {
            color: #007bff;
            /* Bright Blue */
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th,
        table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #f1f1f1;
            font-weight: 600;
            color: #333;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 12px 0;
            font-size: 1.2rem;
        }
        ul li strong {
            color: #007bff;
        }
        form {
            max-width: 650px;
            margin: 25px auto;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        form input,
        form textarea,
        form button {
            width: 100%;
            padding: 14px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }
        form input:focus,
        form textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        form button {
            background-color: #007bff;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #0056b3;
        }
        form button:active {
            background-color: #004085;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to JSPM's RSCOE TechCon 2025</h1>
        <p>The Ultimate Technology and Programming Conference</p>
    </header>
    <nav>
        <a href="#about">About</a> |
        <a href="#schedule">Schedule</a> |
        <a href="#speakers">Speakers</a> |
        <a href="#contact">Contact</a>   |
        <a href="admin.php">Admin</a>    

    </nav>
    <section id="about">
        <h2>About the Event</h2>
        <p>GeeksforGeeks TechCon 2025 brings together leading minds in programming,
             tech, and innovation. Join us for a
            day of insightful talks, hands-on workshops, and an opportunity
             to network with fellow geeks and
            professionals from all around the world.</p>
    </section>
    <section id="schedule">
        <h2>Event Schedule</h2>
        <table>
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Session</th>
                    <th>Contest</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>9:00 AM</td>
                    <td>Opening Keynote</td>
                    <td>GeeksforGeeks Coding Platform</td>
                </tr>
                <tr>
                    <td>10:30 AM</td>
                    <td>Understanding AI and Machine Learning</td>
                    <td>Mr. Arvind Kumar</td>
                </tr>
                <tr>
                    <td>1:00 PM</td>
                    <td>Lunch Break</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>2:00 PM</td>
                    <td>Exploring the Future of Cloud Computing</td>
                    <td>Ms. Neha Gupta</td>
                </tr>
            </tbody>
        </table>
    </section>
    <section id="speakers">
        <h2>Meet the Speakers</h2>
        <ul>
            <li><strong>Dr. Radhika Sharma:</strong> AI Expert and Researcher</li>
            <li><strong>Mr. Arvind Kumar:</strong> Senior Data Scientist at TechWave</li>
            <li><strong>Ms. Neha Gupta:</strong> Cloud Computing Specialist at CloudTech</li>
            <li><strong>Mr. Sandeep Reddy:</strong> Full Stack Developer and Open-Source Contributor</li>
        </ul>
    </section>
    <section id="contact">
        <h2>Contact Us</h2>
        <form  method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br><br>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="4"></textarea><br><br>
            <button type="submit">Send</button>
        </form>
    </section>
</body>
</html>
