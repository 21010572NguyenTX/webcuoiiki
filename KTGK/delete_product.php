<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "myweb");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra ID sản phẩm
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin ảnh cũ trước khi xóa
    $image_query = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $image_query->bind_param("i", $id);
    $image_query->execute();
    $image_result = $image_query->get_result();
    $image_row = $image_result->fetch_assoc();
    $image_path = $image_row['image'];

    // Thực hiện truy vấn xóa sản phẩm
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Xóa file ảnh nếu sản phẩm đã được xóa thành công
        if (!empty($image_path) && file_exists($image_path)) {
            unlink($image_path);
        }
        echo "<script>alert('Sản phẩm đã được xóa.'); window.location.href='products.php';</script>";
    } else {
        echo "<script>alert('Không tìm thấy sản phẩm hoặc không thể xóa sản phẩm.'); window.location.href='products.php';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID sản phẩm không hợp lệ.'); window.location.href='products.php';</script>";
}
$conn->close();
?>
