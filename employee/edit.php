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
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $hireDate = $_POST['hireDate'];
    $salary = $_POST['salary'];

    // Update employee details in the database
    $sql = "UPDATE Employee SET FirstName = :firstName, LastName = :lastName, DateOfBirth = TO_DATE(:dateOfBirth, 'YYYY-MM-DD'), 
            Position = :position, Department = :department, HireDate = TO_DATE(:hireDate, 'YYYY-MM-DD'), Salary = :salary 
            WHERE EmployeeID = :employeeID";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':dateOfBirth', $dateOfBirth);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':hireDate', $hireDate);
    $stmt->bindParam(':salary', $salary);
    $stmt->bindParam(':employeeID', $employeeID);

    if ($stmt->execute()) {
        // Redirect to view.php after saving changes
        header("Location: view.php");
        exit;
    } else {
        echo "Error updating employee details: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - HRMS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Employee</h2>
        <form id="editForm" action="" method="post">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($employee['FIRSTNAME'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($employee['LASTNAME'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="dateOfBirth">Date of Birth</label>
                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" value="<?php echo htmlspecialchars($employee['DATEOFBIRTH'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="<?php echo htmlspecialchars($employee['POSITION'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" class="form-control" id="department" name="department" value="<?php echo htmlspecialchars($employee['DEPARTMENT'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="hireDate">Hire Date</label>
                <input type="date" class="form-control" id="hireDate" name="hireDate" value="<?php echo htmlspecialchars($employee['HIREDATE'] ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" value="<?php echo htmlspecialchars($employee['SALARY'] ?? ''); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="view.php" class="btn btn-primary btn-sm">Back</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
