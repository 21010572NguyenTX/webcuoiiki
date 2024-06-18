<?php
$conn = new mysqli("localhost", "root", "", "myweb");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$description = $_POST['description'];
$active = isset($_POST['active']) ? $_POST['active'] : 0;  // Sử dụng giá trị từ form hoặc mặc định là 0 nếu không được đặt

// Xử lý file ảnh
$image = $_FILES['image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($image);

// Di chuyển file đã tải lên vào thư mục "uploads"
if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
    echo "File " . htmlspecialchars(basename($image)) . " đã được tải lên.";
} else {
    echo "Đã xảy ra lỗi khi tải file ảnh.";
}

$sql = "INSERT INTO products (name, image, price, quantity, description, active) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdiss", $name, $target_file, $price, $quantity, $description, $active);
if ($stmt->execute()) {
    echo "<script>alert('Thêm sản phẩm thành công'); window.location.href='products.php';</script>";
} else {
    echo "Lỗi: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
