<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dbms_project");

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];

    $sql = "INSERT INTO students (name, email, phone, department)
            VALUES ('$name', '$email', '$phone', '$department')";
    mysqli_query($conn, $sql);

    header("Location: show.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="assets/js/theme.js"></script>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="show.php">StudentMS</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="show.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add.php">Add Student</a>
        </li>
      </ul>
      <span class="navbar-text text-white me-3">
        Welcome, <?php echo $_SESSION['user']; ?>
      </span>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </div>
<button onclick="toggleDark()" class="btn btn-secondary btn-sm me-2">
    🌙
</button>
</nav>
<link rel="stylesheet" href="assets/css/dark.css">
<div class="container mt-5">
<div class="card shadow">
<div class="card-header bg-success text-white">
    <h4>Add New Student</h4>
</div>


<div class="card-body">
<form method="POST">

<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Phone</label>
<input type="text" name="phone" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Department</label>
<input type="text" name="department" class="form-control" required>
</div>

<button type="submit" name="submit" class="btn btn-success">Add Student</button>
<a href="show.php" class="btn btn-secondary">Back</a>

</form>
</div>
</div>
</div>

</body>
</html>