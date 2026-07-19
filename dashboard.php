<?php
// Mock check for role/auth
$role = isset($_POST['role']) ? $_POST['role'] : 'Medical';

// For this mock, if patient logs in, redirect to patient portal
if ($role === 'Patient') {
    header("Location: patient_portal.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epigenia CDSS - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f7f6;
        }
        .sidebar {
            height: 100vh;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .content {
            padding: 20px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .alert-clinical {
            border-left: 5px solid #e74c3c;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <h4 class="text-center mb-4">Epigenia CDSS</h4>
            <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="#"><i class="bi bi-people"></i> Patients</a>
            <a href="#"><i class="bi bi-heart-pulse"></i> Clinical Alerts</a>
            <a href="#"><i class="bi bi-file-earmark-medical"></i> Prescriptions</a>
            <a href="#"><i class="bi bi-wallet2"></i> Finances</a>
            <a href="admin_users.php"><i class="bi bi-person-gear"></i> Manage Users</a>
            <a href="index.php" class="mt-5"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Welcome, Dr. John Doe (<?php echo htmlspecialchars($role); ?>)</h2>
                <button class="btn btn-primary"><i class="bi bi-plus"></i> New Patient</button>
            </div>

            <div class="row">
                <!-- Summary Cards -->
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <h4>Total Patients</h4>
                        <h2 class="text-primary">124</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <h4>Pending Exams</h4>
                        <h2 class="text-warning">12</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <h4>Critical Alerts</h4>
                        <h2 class="text-danger">3</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3">
                        <h4>Monthly Revenue</h4>
                        <h2 class="text-success">$5,400</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Clinical Alerts -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5 class="mb-3">Clinical Alerts</h5>
                        <div class="alert alert-warning alert-clinical" role="alert">
                            <strong>Jane Smith:</strong> High LDL Cholesterol detected in recent blood work.
                        </div>
                        <div class="alert alert-warning alert-clinical" role="alert">
                            <strong>Mark Taylor:</strong> Elevated Homocysteine levels.
                        </div>
                    </div>
                </div>

                <!-- Recent Patients -->
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5 class="mb-3">Recent Patients</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Last Visit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>Oct 24, 2023</td>
                                    <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                                </tr>
                                <tr>
                                    <td>Mark Taylor</td>
                                    <td>Oct 23, 2023</td>
                                    <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
