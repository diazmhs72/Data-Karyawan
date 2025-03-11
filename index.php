<?php
require_once "Employee.php";
$employee = new Employee();

// Proses tambah data jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    if ($employee->create($name, $position, $salary)) {
        header("Location: index.php?message=success");
        exit();
    } else {
        echo "<p style='color:red;'>Gagal menambahkan karyawan.</p>";
    }
}

$employees = $employee->read()->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center">Data Karyawan</h2>

    <!-- Tabel Data Karyawan -->
    <table id="employeeTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp): ?>
            <tr>
                <td><?= $emp['id'] ?></td>
                <td><?= $emp['name'] ?></td>
                <td><?= $emp['position'] ?></td>
                <td><?= $emp['salary'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $emp['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $emp['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
                
            </tr>
            <?php endforeach; ?>
            <a href="add.php" class="btn btn-success mb-3">Tambah Karyawan</a>
        </tbody>
    </table>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#employeeTable').DataTable();
    });
</script>
</body>
</html>