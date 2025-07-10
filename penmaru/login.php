<?php
session_start();
include 'koneksi/config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Cegah SQL injection
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // arahkan berdasarkan role
        if ($user['role'] == 'admin') {
            header("Location: admin/index.php");
        } else if ($user['role'] == 'siswa') {
            header("Location: siswa/index.php");
        }
        exit;
    } else {
        $error = "Login gagal! Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style-login.css">
</head>
<body>
    <div class="login-box">
        <div class="logo-container">
            <img src="img/login.jpg" alt="Logo" class="logo">
        </div>
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="submit" value="Login">
        </form>
    </div>
    </div>
</body>
</html>