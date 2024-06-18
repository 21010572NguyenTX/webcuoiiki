<?php
include 'config.php';
?>

<script>
    function checksignup() {
        var username = document.forms["signup"]["username"].value;
        var password = document.forms["signup"]["password"].value;
        var confirm_password = document.forms["signup"]["confirm_password"].value;


        var regex = /^[a-zA-Z]+$/;
        if (!regex.test(username)) {
            alert("Tên đăng nhập chỉ được chứa các ký tự từ a-z và A-Z.");
            return false;
        }

        if (password !== confirm_password) {
            alert("Mật khẩu và xác nhận mật khẩu không khớp.");
            return false;
        }

        return true;
    }
</script>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $username = preg_replace('/[^a-zA-Z]/', '', $username);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if ($password != $confirm_password) {
        $error = "Mật khẩu và xác nhận mật khẩu không khớp.";
    } else {
        // Mã hóa mật khẩu bằng MD5
        $hashed_password = md5($password);

        // Thêm thông tin người dùng vào cơ sở dữ liệu
        $sql = "INSERT INTO login (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$username, $hashed_password);

        if ($stmt->execute()) {
            $success = "Đăng ký thành công! Bạn có thể đăng nhập.";
            header('Location: login.php');
        } else {
            $error = "Tên đăng nhập đã tồn tại hoặc không hợp lệ";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>

<div class="container">
    <h2>Sign Up</h2>
    <form name ="signup" action="signup.php" method="post" onsubmit="return checksignup()">
        <div>
            <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div>
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
        <?php
        if (isset($error)) {
            echo '<div style="color:red;">' . $error . '</div>';
        }
        if (isset($success)) {
            echo '<div style="color:green;">' . $success . '</div>';
        }
        ?>
    </form>
    <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
</div>

</body>
</html>
