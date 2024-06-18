<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mã hóa mật khẩu bằng MD5 trước khi kiểm tra
    $hashed_password = md5($password);

    // Truy vấn cơ sở dữ liệu để kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
    if ($stmt->execute()) {
        echo "<script>alert('Thêm sản phẩm thành công'); window.location.href='index.php';</script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var passwordFieldType = passwordField.getAttribute("type");
            if (passwordFieldType === "password") {
                passwordField.setAttribute("type", "text");
            } else {
                passwordField.setAttribute("type", "password");
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Login Form</h2>
    <form action="login.php" method="post">
        <div>
            <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div>
            <input type="checkbox" onclick="togglePasswordVisibility()"> Hiển thị mật khẩu
        </div>
        <div>
            <input type="submit" id="submit" value="Submit">
        </div>
        <?php
        if (isset($error)) {
            echo '<div style="color:red;">' . $error . '</div>';
        }
        ?>
    </form>
    <p>Chưa có tài khoản? <a href="signup.php">Đăng ký ngay</a></p>
</div>
    </form>
</div>

</body>
</html>
