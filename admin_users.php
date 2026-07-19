<?php
require_once 'db.php';

// Handle Delete User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $delete_id = $_POST['delete_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$delete_id]);
        $success_msg = "User deleted successfully.";
    } catch (\PDOException $e) {
        $error_msg = "Error deleting user: " . $e->getMessage();
    }
}

// Handle Update User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $update_id = $_POST['update_id'];
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET full_name = ?, role = ? WHERE id = ?");
        $stmt->execute([$full_name, $role, $update_id]);
        $success_msg = "User updated successfully.";
    } catch (\PDOException $e) {
        $error_msg = "Error updating user: " . $e->getMessage();
    }
}

// Handle Create User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $full_name = $_POST['full_name'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role, full_name) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password_hash, $role, $full_name]);
        $success_msg = "User created successfully.";
    } catch (\PDOException $e) {
        $error_msg = "Error creating user: " . $e->getMessage();
    }
}

// Fetch Users
try {
    $stmt = $pdo->query("SELECT id, username, role, full_name, created_at FROM users ORDER BY created_at DESC");
    $users = $stmt->fetchAll();
} catch (\PDOException $e) {
    $error_msg = "Error fetching users: " . $e->getMessage();
    $users = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epigenia CDSS - User Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .sidebar { height: 100vh; background-color: #2c3e50; color: white; padding-top: 20px; }
        .sidebar a { color: #ecf0f1; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover { background-color: #34495e; }
        .content { padding: 20px; }
        .card { border: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <h4 class="text-center mb-4">Epigenia Admin</h4>
            <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="admin_users.php"><i class="bi bi-people"></i> Manage Users</a>
            <a href="index.php" class="mt-5"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>User Administration</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal"><i class="bi bi-plus"></i> New User</button>
            </div>

            <?php if (isset($success_msg)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success_msg); ?></div>
            <?php endif; ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_msg); ?></div>
            <?php endif; ?>

            <div class="card p-3">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                <td><span class="badge bg-secondary"><?php echo htmlspecialchars($user['role']); ?></span></td>
                                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateUserModal<?php echo $user['id']; ?>"><i class="bi bi-pencil"></i> Edit</button>
                                    <form action="admin_users.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</button>
                                    </form>

                                    <!-- Update User Modal -->
                                    <div class="modal fade" id="updateUserModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="updateUserModalLabel<?php echo $user['id']; ?>" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <form action="admin_users.php" method="POST">
                                              <input type="hidden" name="action" value="update">
                                              <input type="hidden" name="update_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="updateUserModalLabel<?php echo $user['id']; ?>">Update User: <?php echo htmlspecialchars($user['username']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="full_name<?php echo $user['id']; ?>" class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name<?php echo $user['id']; ?>" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role<?php echo $user['id']; ?>" class="form-label">Role</label>
                                                    <select class="form-select" id="role<?php echo $user['id']; ?>" name="role" required>
                                                        <option value="Admin" <?php echo $user['role'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                                                        <option value="Medical" <?php echo $user['role'] === 'Medical' ? 'selected' : ''; ?>>Medical Professional</option>
                                                        <option value="Nutrition" <?php echo $user['role'] === 'Nutrition' ? 'selected' : ''; ?>>Nutritionist</option>
                                                        <option value="Exercise" <?php echo $user['role'] === 'Exercise' ? 'selected' : ''; ?>>Exercise Specialist</option>
                                                        <option value="Patient" <?php echo $user['role'] === 'Patient' ? 'selected' : ''; ?>>Patient</option>
                                                    </select>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update User</button>
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(empty($users)): ?>
                            <tr><td colspan="6" class="text-center">No users found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="admin_users.php" method="POST">
          <input type="hidden" name="action" value="create">
          <div class="modal-header">
            <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="Admin">Admin</option>
                    <option value="Medical">Medical Professional</option>
                    <option value="Nutrition">Nutritionist</option>
                    <option value="Exercise">Exercise Specialist</option>
                    <option value="Patient">Patient</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Create User</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
