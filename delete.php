<?php
require_once "Employee.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak valid.");
}

$id = $_GET['id'];
$employee = new Employee();

if ($employee->delete($id)) {
    header("Location: index.php?message=deleted");
    exit();
} else {
    echo "<p style='color:red;'>Gagal menghapus karyawan.</p>";
}
?>