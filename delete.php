<?php
$conn = mysqli_connect("localhost", "root", "", "dbms_project");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id=$id";
    mysqli_query($conn, $sql);
}

header("Location: show.php");
exit();
?>