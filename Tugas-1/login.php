<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "<h3 style=color:red>Username atau Password anda tidak sesuai !<h3>";
    }
}
?>

<body>
    <form action="cek_login.php" method="post"">
        <label>Username:</label>
        <input type=" text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login" class="tombol">
    </form>
</body>

</html>