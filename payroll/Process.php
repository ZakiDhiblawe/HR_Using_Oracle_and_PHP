<?php
include '../connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $employee_id = $_POST['employee_id'];
    $gross_salary = $_POST['gross_salary'];
    $tax_amount = $_POST['tax_amount'];
    $net_salary = $gross_salary - $tax_amount; // Calculate net salary
    $pay_date = $_POST['pay_date'];

    // Prepare the SQL statement
    $sql = "INSERT INTO Payroll (PAYROLLID, EmployeeID, GrossSalary, TaxAmount, NetSalary, PayDate) VALUES (payroll_seq.nextval, :employee_id, :gross_salary, :tax_amount, :net_salary, TO_DATE(:pay_date, 'YYYY-MM-DD'))";

    try {
        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':gross_salary', $gross_salary);
        $stmt->bindParam(':tax_amount', $tax_amount);
        $stmt->bindParam(':net_salary', $net_salary);
        $stmt->bindParam(':pay_date', $pay_date);

        // Execute the statement
        $stmt->execute();

        // Redirect to view page
        header("Location: view.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Payroll</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1 class="mt-4">Enter Payroll Information</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="employee_id">Employee ID:</label>
            <input type="number" name="employee_id" id="employee_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="gross_salary">Gross Salary:</label>
            <input type="number" name="gross_salary" id="gross_salary" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tax_amount">Tax Amount:</label>
            <input type="number" name="tax_amount" id="tax_amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="pay_date">Pay Date:</label>
            <input type="date" name="pay_date" id="pay_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <a href="view.php" class="btn btn-secondary">View Payroll Records</a>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
