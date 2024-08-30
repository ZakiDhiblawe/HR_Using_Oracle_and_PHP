<?php
// Include the database connection file
include '../connection.php';

// Check if EmployeeID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Employee ID is missing.";
    exit;
}

// Fetch employee details based on EmployeeID
$employeeID = $_GET['id'];
$sql = "SELECT * FROM Employee WHERE EmployeeID = :employeeID";
$stmt = $connection->prepare($sql);
$stmt->bindParam(':employeeID', $employeeID);
$stmt->execute();
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if employee with provided ID exists
if (!$employee) {
    echo "Employee not found.";
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete employee record from the database
    $sql = "DELETE FROM Employee WHERE EmployeeID = :employeeID";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':employeeID', $employeeID);

    if ($stmt->execute()) {
        // Redirect to view.php after deleting employee
        header("Location: view.php");
        exit;
    } else {
        echo "Error deleting employee record: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee - HRMS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Delete Employee</h2>
        <p>Are you sure you want to delete the following employee record?</p>
        <p><strong>Employee ID:</strong> <?php echo htmlspecialchars($employee['EMPLOYEEID'] ?? ''); ?></p>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($employee['FIRSTNAME'] ?? ''); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($employee['LASTNAME'] ?? ''); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($employee['DATEOFBIRTH'] ?? ''); ?></p>
        <p><strong>Position:</strong> <?php echo htmlspecialchars($employee['POSITION'] ?? ''); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($employee['DEPARTMENT'] ?? ''); ?></p>
        <p><strong>Hire Date:</strong> <?php echo htmlspecialchars($employee['HIREDATE'] ?? ''); ?></p>
        <p><strong>Salary:</strong> <?php echo htmlspecialchars($employee['SALARY'] ?? ''); ?></p>
        <form action="" method="post">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
            <a href="view.php" class="btn btn-primary btn-sm">Back</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
