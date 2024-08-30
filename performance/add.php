<?php
// Include the database connection file
include '../connection.php';

// Define variables and initialize with empty values
$employee_id = $review_date = $rating = $comments = '';
$employee_id_err = $review_date_err = $rating_err = '';

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Employee ID
    if (empty(trim($_POST["employee_id"]))) {
        $employee_id_err = "Please enter the employee ID.";
    } else {
        $employee_id = trim($_POST["employee_id"]);
    }
    
    // Validate Review Date
    if (empty(trim($_POST["review_date"]))) {
        $review_date_err = "Please enter the review date.";
    } else {
        $review_date = trim($_POST["review_date"]);
    }
    
    // Validate Rating
    if (empty(trim($_POST["rating"]))) {
        $rating_err = "Please enter the rating.";
    } elseif (!ctype_digit($_POST["rating"]) || $_POST["rating"] < 1 || $_POST["rating"] > 5) {
        $rating_err = "Rating must be a number between 1 and 5.";
    } else {
        $rating = trim($_POST["rating"]);
    }
    
    // Comments
    $comments = trim($_POST["comments"]);

    // Check input errors before inserting into database
    if (empty($employee_id_err) && empty($review_date_err) && empty($rating_err)) {
        // Prepare an INSERT statement
        $sql = "INSERT INTO Performance (PerformanceID, EmployeeID, ReviewDate, Rating, Comments) VALUES (performance_seq.NEXTVAL, :employee_id, TO_DATE(:review_date, 'YYYY-MM-DD'), :rating, :comments)";

        if ($stmt = $connection->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":employee_id", $param_employee_id);
            $stmt->bindParam(":review_date", $param_review_date);
            $stmt->bindParam(":rating", $param_rating);
            $stmt->bindParam(":comments", $param_comments);

            // Set parameters
            $param_employee_id = $employee_id;
            $param_review_date = $review_date;
            $param_rating = $rating;
            $param_comments = $comments;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to view page
                header("location: view.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Performance Review</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add Performance Review</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Employee ID</label>
                <input type="text" name="employee_id" class="form-control <?php echo (!empty($employee_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $employee_id; ?>">
                <span class="invalid-feedback"><?php echo $employee_id_err; ?></span>
            </div>
            <div class="form-group">
                <label>Review Date</label>
                <input type="date" name="review_date" class="form-control <?php echo (!empty($review_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $review_date; ?>">
                <span class="invalid-feedback"><?php echo $review_date_err; ?></span>
            </div>
            <div class="form-group">
                <label>Rating</label>
                <input type="text" name="rating" class="form-control <?php echo (!empty($rating_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rating; ?>">
                <span class="invalid-feedback"><?php echo $rating_err; ?></span>
            </div>
            <div class="form-group">
                <label>Comments</label>
                <textarea name="comments" class="form-control"><?php echo $comments; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-secondary" href="view.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
