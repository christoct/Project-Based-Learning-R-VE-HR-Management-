<?php
include("config.php");
session_start();

$usernameError = "";
$pass_error = "";
$username_input = "";
$pass_input = "";
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_input = trim($_POST["username_input"]);
    $pass_input = trim($_POST["password"]);

    if (empty($username_input) || empty($pass_input)) {
        $login_error = "Username dan password harus diisi!";
    } else {
        $sql = "SELECT password_pengguna, id_karyawan FROM akun_pengguna WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username_input);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($password_pengguna, $id_karyawan);
            $stmt->fetch();

            if ($pass_input == $password_pengguna) {

                $_SESSION['username'] = $username_input;
                $_SESSION['id_karyawan'] = $id_karyawan;
                header("Location: pbl_dashboard.php");
                exit();
            } else {
                $login_error = "Password salah!";
            }
        } else {
            $login_error = "Username tidak ditemukan!";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<link rel="stylesheet" href="login.css">
<script src="jquery.js"></script>
<script>
    $(document).ready(function () {
        $("input").on("input", function () {
            $(".error, .login_gagal").hide();
        });
    });
</script>

<body>
    <img src="login.jpg" alt="login" class="gambarlogin">
    <div class="form">
        <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
            <div class="header">R-VE HR Management</div>
            <center><img src="logo R-VE.png" class="logo"></center><br>
            <div class="main">
                <input type="text" name="username_input" id="username_input" placeholder="Username" class="input"
                    value="<?php echo htmlspecialchars($username_input); ?>"><br>
                <input type="password" name="password" id="password" placeholder="Password" class="input"
                    value="<?php echo htmlspecialchars($pass_input); ?>"><br>
                <?php if (!empty($login_error)): ?>
                    <span id="login_gagal" class="login_gagal"><?php echo $login_error; ?></span>
                <?php endif; ?><br>
                <a href="pbl_lupapass.php" class="transparent-link-lupa">Lupa Password?</a>
                <center><input type="submit" value="Masuk" class="button"> </center><br>
                <center><a href="pbl_buatakun.php" class="transparent-link">Belum Punya Akun? Buat Akun</a>
                    <br><br><br>
        </form>
    </div>
    </div>

</body>

</html>