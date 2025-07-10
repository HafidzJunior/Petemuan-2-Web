<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

include '../koneksi/config.php';

$total     = $koneksi->query("SELECT COUNT(*) AS total FROM calon_siswa")->
fetch_assoc()['total'];
$laki      = $koneksi->query("SELECT COUNT(*) AS total FROM calon_siswa 
WHERE jenis_kelamin='Laki-laki'")->fetch_assoc()['total'];
$perempuan = $koneksi->query("SELECT COUNT(*) AS total FROM calon_siswa 
WHERE jenis_kelamin='Perempuan'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>
    <header>
        <h3>Dashboard Admin</h3>
        <h2>SMK PUTERA BATAM</h2>
    </header>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="form_daftar.php">Daftar Baru</a></li>
            <li><a href="list-calon-siswa.php">Pendaftar</a></li>
            <br><br>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Konten utama -->
<div class="main-content">
    <header>
        <div class="stats-container">
            <div class="stat-card bg-blue">
                <div class="stat-icon">
                    <img src="../img/statistik.png" alt="Chart Icon" width="40" 
					height="40">
                </div>
                <div class="stat-content">
                    <h3>Total Pendaftar</h3>
                    <p><?= $total ?></p>
                </div>
            </div>
            <div class="stat-card bg-green">
                <div class="stat-icon">
                    <img src="../img/pria.png" alt="Male Icon" width="40" height="40">
                </div>
                <div class="stat-content">
                    <h3>Pendaftar Laki-laki</h3>
                    <p><?= $laki ?></p>
                </div>
            </div>
            <div class="stat-card bg-pink">
                <div class="stat-icon">
                    <img src="../img/wanita.png" alt="Female Icon" width="40" 
					height="40">
                </div>
                <div class="stat-content">
                    <h3>Pendaftar Perempuan</h3>
                    <p><?= $perempuan ?></p>
                </div>
            </div>
        </div>
    </header>

    <?php if (isset($_GET['status'])): ?>
        <p class="<?= $_GET['status'] == 'sukses' ? 'success' : 'error' ?>">
            <?= $_GET['status'] == 'sukses' ? 'Pendaftaran siswa baru berhasil!' : 'Pendaftaran gagal!' ?>
        </p>
    <?php endif; ?>
</div>
</body>
</html>