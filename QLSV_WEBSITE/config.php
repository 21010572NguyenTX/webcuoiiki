<?php
$host = 'localhost'; // Hoặc địa chỉ IP của server cơ sở dữ liệu
$dbname = 'minato'; // Tên cơ sở dữ liệu
$user = 'root'; // Tên đăng nhập vào cơ sở dữ liệu
$password = ''; // Mật khẩu đăng nhập vào cơ sở dữ liệu

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
