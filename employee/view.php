<?php
// Include the database connection file
include '../connection.php';

// Initialize the $employees array
$employees = [];

// Query to select all employees
$sql = "SELECT * FROM Employee";

try {
    // Execute the query using PDO
    $stmt = $connection->query($sql);

    // Check if the query was successful
    if ($stmt) {
        // Fetch all employee records as an associative array
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        throw new Exception("Error executing query: " . $connection->errorInfo()[2]);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees - HRMS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>View Employees  
            <a href="add_employee.php" class="btn btn-primary btn-sm">add employee</a>
            <a href="../index.php" class="btn btn-primary btn-sm">Go Home</a> </h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Hire Date</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo $employee['EMPLOYEEID']; ?></td>
                    <td><?php echo $employee['FIRSTNAME'] ?? ''; ?></td>
                    <td><?php echo $employee['LASTNAME'] ?? ''; ?></td>
                    <td><?php echo $employee['DATEOFBIRTH'] ?? ''; ?></td>
                    <td><?php echo $employee['POSITION'] ?? ''; ?></td>
                    <td><?php echo $employee['DEPARTMENT'] ?? ''; ?></td>
                    <td><?php echo $employee['HIREDATE'] ?? ''; ?></td>
                    <td><?php echo $employee['SALARY'] ?? ''; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $employee['EMPLOYEEID']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete.php?id=<?php echo $employee['EMPLOYEEID']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
