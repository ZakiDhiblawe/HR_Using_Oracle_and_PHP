<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS - Home</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .jumbotron {
            background: url('images/mus.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 6rem 2rem;
            position: relative;
        }
        .jumbotron::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        .jumbotron .container {
            position: relative;
            z-index: 1;
        }
        .jumbotron h1 {
            font-size: 3rem;
        }
        .jumbotron p {
            font-size: 1.25rem;
        }
        .jumbotron .btn {
            background-color: #007bff;
            border: none;
        }
        .content {
            padding: 4rem 0;
        }
        .about-hrms, .student-info {
            margin-bottom: 3rem;
        }
        .student-info img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        .student-info h5 {
            margin-top: 1rem;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">HRMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="employee/view.php">Employee Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="payroll/view.php">Payroll Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="attendance/view.php">Attendance Tracking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="performance/view.php">Performance Evaluation</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Welcome to HRMS</h1>
            <p class="lead">Your Comprehensive HR Management Solution</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Explore HRMS</a>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="col-md-6 about-hrms">
                <h2>About HRMS</h2>
                <p>The HR Management System (HRMS) is a powerful platform designed to streamline various HR functions such as employee management, payroll processing, attendance tracking, performance evaluation, and recruitment.</p>
                <p>With HRMS, organizations can efficiently manage their human resources, automate repetitive tasks, and improve overall productivity.</p>
            </div>
            <div class="col-md-6 text-center student-info">
            
                <h5> Course : Orcale </h5>
                <p>IMustaf Hussein Alim </p>
                <p>Information Technolofgy </p>
                <p>Simad university </p>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 HRMS. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
