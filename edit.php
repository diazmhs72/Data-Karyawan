<?php
require_once "Employee.php";

$employee = new Employee();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak valid.");
}

$id = $_GET['id'];
$data = $employee->readById($id);

if (!$data) {
    die("Karyawan tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    if ($employee->update($id, $name, $position, $salary)) {
        header("Location: index.php?message=updated");
        exit();
    } else {
        echo "<p style='color:red;'>Gagal mengupdate karyawan.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Karyawan</h2>
    <form action="edit.php?id=<?= $id ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= $data['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Posisi:</label>
            <input type="text" name="position" id="position" class="form-control" value="<?= $data['position'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">Gaji:</label>
            <input type="number" name="salary" id="salary" class="form-control" value="<?= $data['salary'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>