<?php
require_once "Employee.php";

$employee = new Employee();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    if ($employee->create($name, $position, $salary)) {
        header("Location: index.php?message=added");
        exit();
    } else {
        echo "<p style='color:red;'>Gagal menambahkan karyawan.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Karyawan</h2>
    <form action="add.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Posisi:</label>
            <input type="text" name="position" id="position" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">Gaji:</label>
            <input type="number" name="salary" id="salary" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>