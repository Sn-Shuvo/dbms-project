<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dbms_project");

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM students WHERE name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM students";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="assets/js/theme.js"></script>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="show.php">StudentMS</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="show.php">Home</a>
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

<div class="container mt-4">

<h2 class="mb-3">Student Management System</h2>

<!-- SEARCH -->
<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="search" class="form-control"
        placeholder="Search by name"
        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

<!-- TABLE CARD -->
<div class="card shadow">
<div class="card-body">

<table class="table table-bordered table-striped table-hover">
<thead class="table-dark">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Department</th>
<th>Action</th>
</tr>
</thead>


<tbody>

<?php
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['department']."</td>";
    echo "<td>
    <a href='edit.php?id=".$row['id']."' class='btn btn-sm btn-warning'>Edit</a>
    <a href='delete.php?id=".$row['id']."' 
    onclick=\"return confirm('Are you sure?')\" 
    class='btn btn-sm btn-danger'>Delete</a>
    </td>";
    echo "</tr>";
}
?>

</tbody>
</table>

</div>
</div>

</div>

</body>
</html>