<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Dashboard</h2>
    <p>Selamat datang, <?= session()->get('username') ?>!</p>
    <a href="<?= base_url('logout') ?>">Logout</a>
</body>
</html>
