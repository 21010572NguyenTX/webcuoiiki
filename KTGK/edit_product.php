<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "myweb");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra ID sản phẩm
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn thông tin sản phẩm
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        // Điền thông tin sản phẩm vào form
        ?>
        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <title>Chỉnh sửa sản phẩm</title>
            <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #0000FF; /* Màu xanh */
            color: white;
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
        }
        .navbar a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            margin: 0 10px;
        }
        /* Thêm các styles khác tại đây nếu cần */
    </style>
        </head>
        <body>
            <div class="navbar">
        <a href="#">Quản lý danh mục</a>
        <a href="products.php">Quản lý sản phẩm</a>
        <a href="#">Quản lý người dùng</a>
        <a href="#">Quản lý đơn hàng</a>
    </div>
            <h1>Chỉnh sửa sản phẩm</h1>
            <form action="update_product.php" method="POST" enctype="multipart/form-data">
                Tên sản phẩm: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br>
                Ảnh sản phẩm: <input type="file" name="image"><br>
                Giá: <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>"><br>
                Số lượng: <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>"><br>
                Mô tả: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
                Trạng thái:
                <select name="active">
                    <option value="1" <?php echo $row['active'] == 1 ? 'selected' : ''; ?>>Hiện</option>
                    <option value="0" <?php echo $row['active'] == 0 ? 'selected' : ''; ?>>Ẩn</option>
                </select><br>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" value="Cập nhật sản phẩm">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
    $stmt->close();
} else {
    echo "ID sản phẩm không hợp lệ.";
}
$conn->close();
?>
