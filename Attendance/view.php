<?php
include '../connection.php'; // Include the database connection file

$employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : '';
$attendance_date = isset($_GET['attendance_date']) ? $_GET['attendance_date'] : '';

$query = 'SELECT * FROM EmployeeAttendanceView WHERE 1=1';

if ($employee_id) {
    $query .= ' AND EmployeeID = :employee_id';
}

if ($attendance_date) {
    $query .= ' AND AttendanceDate = :attendance_date';
}

try {
    $stmt = $connection->prepare($query);

    if ($employee_id) {
        $stmt->bindParam(':employee_id', $employee_id);
    }

    if ($attendance_date) {
        $stmt->bindParam(':attendance_date', $attendance_date);
    }

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
    <title>View Attendance</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mt-4">View Attendance 
    <a href="log.php" class="btn btn-primary btn-sm">Log attendance</a>
    <a href="../index.php" class="btn btn-primary btn-sm">Go Home</a>
        
</h1>
    
    <form method="get" action="" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="employee_id">Employee ID:</label>
                <input type="number" name="employee_id" id="employee_id" class="form-control" value="<?php echo htmlentities($employee_id); ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="attendance_date">Date:</label>
                <input type="date" name="attendance_date" id="attendance_date" class="form-control" value="<?php echo htmlentities($attendance_date); ?>">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Employee ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Attendance Date</th>
                <th scope="col">Time In</th>
                <th scope="col">Time Out</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . htmlentities($row['EMPLOYEEID']) . '</td>';
                echo '<td>' . htmlentities($row['FIRSTNAME']) . '</td>';
                echo '<td>' . htmlentities($row['LASTNAME']) . '</td>';
                echo '<td>' . htmlentities($row['ATTENDANCEDATE']) . '</td>';
                echo '<td>' . htmlentities($row['TIMEIN']) . '</td>';
                echo '<td>' . htmlentities($row['TIMEOUT']) . '</td>';
                echo '<td>' . htmlentities($row['STATUS']) . '</td>';
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
