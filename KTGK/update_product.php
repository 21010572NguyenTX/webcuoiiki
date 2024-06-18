<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "myweb");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $active = $_POST['active'];

    // Kiểm tra ảnh mới và xử lý ảnh cũ
    if (!empty($_FILES['image']['name'])) {
        // Lấy thông tin ảnh cũ
        $old_image_query = $conn->prepare("SELECT image FROM products WHERE id = ?");
        $old_image_query->bind_param("i", $id);
        $old_image_query->execute();
        $old_image_result = $old_image_query->get_result();
        if ($old_image_row = $old_image_result->fetch_assoc()) {
            $old_image_path = $old_image_row['image'];

            // Kiểm tra và xóa ảnh cũ nếu tồn tại
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }

        // Xử lý và lưu ảnh mới
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    } else {
        // Nếu không có ảnh mới, cần lấy lại ảnh cũ từ cơ sở dữ liệu để không mất thông tin
        if (!isset($old_image_path)) {
            $old_image_query = $conn->prepare("SELECT image FROM products WHERE id = ?");
            $old_image_query->bind_param("i", $id);
            $old_image_query->execute();
            $old_image_result = $old_image_query->get_result();
            $old_image_row = $old_image_result->fetch_assoc();
            $target_file = $old_image_row['image'];
        }
    }

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $sql = "UPDATE products SET name=?, image=?, price=?, quantity=?, description=?, active=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisii", $name, $target_file, $price, $quantity, $description, $active, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Cập nhật sản phẩm thành công'); window.location.href='products.php';</script>";
    } else {
        echo "Không có sự thay đổi nào được thực hiện";
    }
    $stmt->close();
}
$conn->close();
?>
