<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee - HRMS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Add Employee</h2>
        <form action="add_employee.php" method="post">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="dateOfBirth">Date of Birth</label>
                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <div class="form-group">
                <label for="hireDate">Hire Date</label>
                <input type="date" class="form-control" id="hireDate" name="hireDate" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Employee</button>
            <a href="view.php" class="btn btn-primary btn-sm">Back</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Include the database connection file
include '../connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = date('Y-m-d', strtotime($_POST['dateOfBirth'])); // Format date as YYYY-MM-DD
    $position = $_POST['position'];
    $department = $_POST['department'];
    $hireDate = date('Y-m-d', strtotime($_POST['hireDate'])); // Format date as YYYY-MM-DD
    $salary = $_POST['salary'];

    try {
        // SQL to insert data into the Employee table
        $sql = "INSERT INTO Employee (EmployeeID, FirstName, LastName, DateOfBirth, Position, Department, HireDate, Salary)
                VALUES (employee_seq.NEXTVAL, :firstName, :lastName, TO_DATE(:dateOfBirth, 'YYYY-MM-DD'), :position, :department, TO_DATE(:hireDate, 'YYYY-MM-DD'), :salary)";

        // Prepare the SQL statement
        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':hireDate', $hireDate);
        $stmt->bindParam(':salary', $salary);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: view.php");
            exit;
        } else {
            echo "Error adding employee: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
