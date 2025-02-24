<?php
include("connect.php");

// Fetch all messages from the database
$query = "SELECT * FROM messages ";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Messages</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.8rem;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        .search-box {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }
        .delete-btn:hover {
            background-color: #c82333;
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
    Admin Panel - Messages
</header>

<div class="container">
    <h2>All Messages</h2>

    <input type="text" id="searchBox" class="search-box" placeholder="Search messages...">

    <table id="messagesTable">
        <thead>
            <tr>
                <th onclick="sortTable(0)">ID</th>
                <th onclick="sortTable(1)">Name</th>
                <th onclick="sortTable(2)">Email</th>
                <th>Message</th>
               
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['sender_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['sender_email']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                  
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="index.php" class="back-btn">Back to Home</a>
</div>

<script>
    // Search Functionality
    document.getElementById('searchBox').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#messagesTable tbody tr");

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });

    // Sorting Functionality
    function sortTable(columnIndex) {
        let table = document.getElementById("messagesTable");
        let rows = Array.from(table.rows).slice(1);
        let ascending = table.dataset.order === "asc";

        rows.sort((rowA, rowB) => {
            let cellA = rowA.cells[columnIndex].textContent.trim().toLowerCase();
            let cellB = rowB.cells[columnIndex].textContent.trim().toLowerCase();

            if (!isNaN(cellA) && !isNaN(cellB)) {
                return ascending ? cellA - cellB : cellB - cellA;
            }
            return ascending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        });

        table.tBodies[0].append(...rows);
        table.dataset.order = ascending ? "desc" : "asc";
    }
</script>

</body>
</html>
