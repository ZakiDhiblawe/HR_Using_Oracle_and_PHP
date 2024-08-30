<?php
// Include the database connection file
include '../connection.php';

$query = 'SELECT * FROM Performance';

try {
    $stmt = $connection->prepare($query);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit; // Terminate script execution if query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Performance Reviews</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Performance Reviews</h2>
        <a href="add.php" class="btn btn-primary mb-4">Add Performance Review</a>
        <a href="../index.php" class="btn btn-primary btn-sm">Go Home</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Performance ID</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Review Date</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . htmlentities($row['PERFORMANCEID']) . '</td>';
                    echo '<td>' . htmlentities($row['EMPLOYEEID']) . '</td>';
                    echo '<td>' . htmlentities($row['REVIEWDATE']) . '</td>';
                    echo '<td>' . htmlentities($row['RATING']) . '</td>';
                    echo '<td>' . htmlentities($row['COMMENTS']) . '</td>';
                    echo '<td>';
                    echo '<a href="edit.php?id=' . $row['PERFORMANCEID'] . '" class="btn btn-warning btn-sm mr-2">Edit</a>';
                    echo '<a href="delete.php?id=' . $row['PERFORMANCEID'] . '" class="btn btn-danger btn-sm">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
