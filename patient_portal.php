<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epigenia CDSS - Patient Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .patient-header {
            background-color: #4CAF50;
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #eee;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .genetic-risk-high {
            color: #d32f2f;
            font-weight: bold;
        }
        .genetic-risk-low {
            color: #388e3c;
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">Epigenia <span class="text-success">Portal</span></a>
        <div class="d-flex">
            <a href="index.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="patient-header text-center">
    <h2>Welcome back, Jane Smith</h2>
    <p>Your personalized health overview based on your genetic profile.</p>
</div>

<div class="container">
    <div class="row">
        <!-- Diet Plan -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="bi bi-egg-fried me-2 text-warning fs-4"></i> Nutrition Plan
                </div>
                <div class="card-body">
                    <h6 class="text-muted">Phase: Adaptation</h6>
                    <p><strong>Goal:</strong> 2000 kcal / day</p>
                    <hr>
                    <h6>Breakfast (8:00 AM)</h6>
                    <p class="small">Oatmeal with berries and whey protein (400 kcal).</p>
                    <h6>Lunch (1:00 PM)</h6>
                    <p class="small">Grilled chicken breast, quinoa, and steamed broccoli (600 kcal).</p>
                    <button class="btn btn-sm btn-success w-100 mt-2">View Full Plan</button>
                </div>
            </div>
        </div>

        <!-- Workout Plan -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="bi bi-bicycle me-2 text-primary fs-4"></i> Workout Plan
                </div>
                <div class="card-body">
                    <h6 class="text-muted">Focus: Hypertrophy & Cardio</h6>
                    <hr>
                    <h6>Today: Push Day</h6>
                    <ul class="small">
                        <li>Bench Press: 4 sets x 8-10 reps</li>
                        <li>Overhead Press: 3 sets x 10 reps</li>
                        <li>Tricep Extensions: 3 sets x 12 reps</li>
                    </ul>
                    <div class="mt-3">
                        <strong>Cardio:</strong> 20 mins moderate intensity on stationary bike.
                    </div>
                    <button class="btn btn-sm btn-primary w-100 mt-3">Log Workout</button>
                </div>
            </div>
        </div>

        <!-- Genetic Risks -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center">
                    <i class="bi bi-dna me-2 text-info fs-4"></i> Genetic Profile
                </div>
                <div class="card-body">
                    <p class="text-muted small">Key markers influencing your diet and training.</p>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Lactose Tolerance (MCM6)
                            <span class="genetic-risk-low">Tolerant</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Caffeine Metabolism (CYP1A2)
                            <span class="genetic-risk-high">Slow</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Muscle Power (ACTN3)
                            <span class="text-primary fw-bold">Power/Strength</span>
                        </li>
                    </ul>
                    <div class="alert alert-info mt-3 py-2 small" role="alert">
                        <i class="bi bi-info-circle"></i> Avoid caffeine after 2 PM due to slow metabolism marker.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
