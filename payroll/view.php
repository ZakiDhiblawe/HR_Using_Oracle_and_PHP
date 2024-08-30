<?php
// Include the database connection file
include '../connection.php';

// Query to fetch payroll records with necessary details
$query = 'SELECT Payroll.PayrollID, Payroll.EmployeeID, Employee.FirstName, Employee.LastName, Employee.Position, Employee.Department, Payroll.GrossSalary, Payroll.TaxAmount, Payroll.NetSalary, Payroll.PayDate
          FROM Payroll
          INNER JOIN Employee ON Payroll.EmployeeID = Employee.EmployeeID';

try {
    // Prepare the SQL statement
    $stmt = $connection->prepare($query);

    // Execute the SQL statement
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
    <title>View Payroll</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Payroll Records</h2>
        <a href="process.php" class="btn btn-primary mb-3">Enter Payroll Information</a>
        <a href="../index.php" class="btn btn-primary btn-sm">Go Home</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Payroll ID</th>
                    <th scope="col">Employee ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Department</th>
                    <th scope="col">Gross Salary</th>
                    <th scope="col">Tax Amount</th>
                    <th scope="col">Net Salary</th>
                    <th scope="col">Pay Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . htmlentities($row['PAYROLLID']) . '</td>';
                    echo '<td>' . htmlentities($row['EMPLOYEEID']) . '</td>';
                    echo '<td>' . htmlentities($row['FIRSTNAME']) . '</td>';
                    echo '<td>' . htmlentities($row['LASTNAME']) . '</td>';
                    echo '<td>' . htmlentities($row['POSITION']) . '</td>';
                    echo '<td>' . htmlentities($row['DEPARTMENT']) . '</td>';
                    echo '<td>' . htmlentities($row['GROSSSALARY']) . '</td>';
                    echo '<td>' . htmlentities($row['TAXAMOUNT']) . '</td>';
                    echo '<td>' . htmlentities($row['NETSALARY']) . '</td>';
                    echo '<td>' . htmlentities($row['PAYDATE']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
