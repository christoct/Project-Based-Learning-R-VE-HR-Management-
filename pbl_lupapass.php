<?php
include("config.php");

$usernameError = "";
$username_input = "";
$pass_input = "";
$pass_error = "";
$confirm_input = "";
$confirm_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_input = trim($_POST["username_input"]);
    $pass_input = trim($_POST["password"]);
    $confirm_input = trim($_POST["confirmPassword"]);

    if (empty($username_input)) {
        $usernameError = "Masukkan username atau email!";
    } else {
        $sql = "SELECT username FROM akun_pengguna 
                WHERE username = ? OR email_pengguna = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username_input, $username_input);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $usernameError = "Username atau email tidak ditemukan!";
        }
        $stmt->close();
    }

    if (empty($pass_input)) {
        $pass_error = "Password baru harus diisi!";
    }

    if (empty($confirm_input)) {
        $confirm_error = "Konfirmasi password harus diisi!";
    } elseif ($pass_input !== $confirm_input) {
        $confirm_error = "Password dan konfirmasi tidak cocok!";
    }

    if (empty($usernameError) && empty($pass_error) && empty($confirm_error)) {
        $sql = "UPDATE akun_pengguna 
                SET password_pengguna = ? 
                WHERE username = ? OR email_pengguna = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $pass_input, $username_input, $username_input);

        if ($stmt->execute()) {
            echo "<script>window.location='pbl_login.php';</script>";
            exit();
        } else {
            echo "Gagal mengubah password.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<script src="jquery.js"></script>
<script src="akun.js"></script>
<link rel="stylesheet" href="akun.css">

<body>
    <div class="form">
        <center>
            <div class="header">R-VE HR Management</div>
            <center>
                <img src="logo R-VE.png" class="logo"><br>
                <form id="registerForm" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <table class="tabel_lupa">
                        <tr>
                            <td class="text">
                                <div class="main">Masukkan Email/Username:</div>
                            </td>
                        </tr>
                        <tr>
                            <td> <input type="text" name="username_input" id="username_input" placeholder="Username"
                                    class="input" value="<?php echo htmlspecialchars($username_input); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php if (!empty($usernameError)): ?>
                                    <div id="username_terdaftar" class="error"><?php echo $usernameError; ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text">
                                <div class="main">Masukkan Password Baru:</div>
                            </td>
                        </tr>
                        <tr>
                            <td> <input type="password" name="password" id="password" placeholder="Password"
                                    class="input" value="<?php echo htmlspecialchars($pass_input); ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <?php if (!empty($pass_error)): ?>
                                    <div id="pass_error" class="error"><?php echo $pass_error; ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td> <input type="password" name="confirmPassword" id="confirmPassword"
                                    placeholder="Konfirmasi Password" class="input"
                                    value="<?php echo htmlspecialchars($confirm_input); ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <?php if (!empty($confirm_error)): ?>
                                    <div id="pass_error" class="error"><?php echo $confirm_error; ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><button>Ubah Password</button></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="button_batal" id="batal_buat_akun">Batal</div>
                            </td>
                        </tr>
                    </table>
                </form>
    </div>
</body>

</html>