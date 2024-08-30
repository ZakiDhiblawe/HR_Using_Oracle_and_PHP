<?php
// Include the database connection file
include '../connection.php';

// Get the performance ID from the URL
$performance_id = $_GET['id'];

if (!$performance_id) {
    echo "Error: Performance ID not provided.";
    exit;
}

// Delete the performance review from the database
$query = 'DELETE FROM Performance WHERE PerformanceID = :performance_id';

try {
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':performance_id', $performance_id);
    $stmt->execute();
    header('Location: view.php'); // Redirect to the view page after deleting
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit; // Terminate script execution if query fails
}
?>
