<?php
// Include the database connection file
include '../connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $performance_id = $_POST['performance_id'];
    $employee_id = $_POST['employee_id'];
    $review_date = $_POST['review_date'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    // Update the performance review in the database
    $query = 'UPDATE Performance SET EmployeeID = :employee_id, ReviewDate = TO_DATE(:review_date, \'YYYY-MM-DD\'), Rating = :rating, Comments = :comments WHERE PerformanceID = :performance_id';

    try {
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':performance_id', $performance_id);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':review_date', $review_date);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comments', $comments);
        $stmt->execute();
        header('Location: view.php'); // Redirect to the view page after updating
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit; // Terminate script execution if query fails
    }
}

// Get the performance review details for the given ID
$performance_id = $_GET['id'];
$query = 'SELECT * FROM Performance WHERE PerformanceID = :performance_id';

try {
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':performance_id', $performance_id);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$review) {
        echo "Error: Performance review not found.";
        exit;
    }
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
    <title>Edit Performance Review</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Edit Performance Review</h2>
        <form method="post" action="">
            <input type="hidden" name="performance_id" value="<?php echo htmlentities($review['PERFORMANCEID']); ?>">
            <div class="form-group">
                <label for="employee_id">Employee ID:</label>
                <input type="number" name="employee_id" id="employee_id" class="form-control" value="<?php echo htmlentities($review['EMPLOYEEID']); ?>" required>
            </div>
            <div class="form-group">
                <label for="review_date">Review Date:</label>
                <input type="date" name="review_date" id="review_date" class="form-control" value="<?php echo htmlentities($review['REVIEWDATE']); ?>" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" name="rating" id="rating" class="form-control" value="<?php echo htmlentities($review['RATING']); ?>" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea name="comments" id="comments" class="form-control" required><?php echo htmlentities($review['COMMENTS']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
