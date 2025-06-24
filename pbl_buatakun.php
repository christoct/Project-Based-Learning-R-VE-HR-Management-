<?php
include("config.php");

$usernameError = "";
$username_input = "";
$emailError = "";
$email_input = "";
$pass_input = "";
$pass_error = "";
$confirm_input = "";
$confirm_error = "";
$id_karyawan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_input = trim($_POST["username_input"]);
    $email_input = trim($_POST["email"]);
    $pass_input = trim($_POST["password"]);
    $confirm_input = trim($_POST["confirmPassword"]);

    if (empty($username_input)) {
        $usernameError = "Username harus diisi!";
    } else {
        $sql = "SELECT username FROM akun_pengguna WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username_input);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $usernameError = "Username sudah terdaftar!";
        }
        $stmt->close();
    }

    if (empty($email_input)) {
        $emailError = "Email harus diisi!";
    } elseif (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Format email tidak valid!";
    } else {
        $sql = "SELECT email_pengguna FROM akun_pengguna WHERE email_pengguna = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_input);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $emailError = "Email sudah terdaftar!";
        }
        $stmt->close();
    }

    if (empty($pass_input)) {
        $pass_error = "Password harus diisi!";
    }

    if (empty($confirm_input)) {
        $confirm_error = "Konfirmasi password harus diisi!";
    } elseif ($pass_input !== $confirm_input) {
        $confirm_error = "Konfirmasi password dan password tidak sama!";
    }

    if (empty($usernameError) && empty($emailError) && empty($pass_error) && empty($confirm_error)) {
        $sql = "SELECT id_karyawan FROM profil_karyawan WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_input);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $emailError = "Email tidak ditemukan di data karyawan!";
        } else {
            $stmt->bind_result($id_karyawan);
            $stmt->fetch();
        }
        $stmt->close();
    }

    if (
        empty($usernameError) && empty($emailError) &&
        empty($pass_error) && empty($confirm_error) &&
        !empty($id_karyawan)
    ) {
        $sql = "INSERT INTO akun_pengguna (id_karyawan, username, password_pengguna, email_pengguna)
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $id_karyawan, $username_input, $pass_input, $email_input);

        if ($stmt->execute()) {
            header("Location: pbl_login.php");
            exit();
        } else {
            echo "Gagal menyimpan data.";
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
    <title>New Account</title>
</head>
<script src="jquery.js"></script>
<script src="modul_function.js"></script>
<script src="rekrutmen.js"></script>
<script src="akun.js"></script>
<link rel="stylesheet" href="modul_style.css">
<link rel="stylesheet" href="popup_style.css">
<link rel="stylesheet" href="rekrutmen.css">
<link rel="stylesheet" href="akun.css">

<body>
    <div class="form">
        <center>
            <div class="header">R-VE HR Management</div>
            <center>
                <img src="logo R-VE.png" class="logo"><br>
                <form id="registerForm" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <table class="table_daftar">
                        <tr>
                            <td class="text_keterangan">
                                <div class="main">Masukkan Username:</div>
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
                            <td class="text_keterangan">
                                <div class="main">Masukkan Password:</div>
                            </td>
                        </tr>
                        <tr>
                            <td> <input type="password" name="password" id="password" placeholder="Password"
                                    class="input" value="<?php echo htmlspecialchars($pass_input); ?>">
                            </td>
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
                            <td class="text_keterangan">
                                <div class="main">Masukkan Email:</div>
                            </td>
                        </tr>
                        <tr>
                            <td> <input type="email" name="email" id="email" placeholder="Email" class="input"
                                    value="<?php echo htmlspecialchars($email_input); ?>"></td>
                        </tr>
                        <tr>
                            <td>
                                <?php if (!empty($emailError)): ?>
                                    <div id="email_terdaftar" class="error"><?php echo $emailError; ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><button class>Buat Akun</button>
                        </tr>
                        <tr>
                </form>
                <td>
                    <div class="button_batal" id="batal_buat_akun">Batal</div>
                </td>
                </tr>
                </table>
    </div>
</body>

</html>