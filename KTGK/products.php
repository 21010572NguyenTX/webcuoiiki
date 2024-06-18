<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "myweb");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý tìm kiếm
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        .search {
            text-align: center;
            margin-bottom: 20px;
        }

        .search input[type="text"] {
            width: 300px;
            padding: 5px;
        }

        .search input[type="submit"] {
            padding: 5px 10px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        img {
            max-width: 100px;
        }

        .actions a {
            margin: 0 5px;
            text-decoration: none;
            color: white;
            background-color: blue;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .actions a.delete {
            background-color: red;
        }

        .navbar {
            background-color: #0000FF;
            /* Màu xanh */
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

        .add-product-btn {
            float: right;
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 50px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>Quản lý sản phẩm</h1>
    <div class="navbar">
        <a href="#">Quản lý danh mục</a>
        <a href="products.php">Quản lý sản phẩm</a>
        <a href="#">Quản lý người dùng</a>
        <a href="#">Quản lý đơn hàng</a>
        <button class="add-product-btn" onclick="location.href='add_product.php';">Thêm sản phẩm mới</button>
    </div>
    <div class="search">
        <form method="GET" action="products.php">
            <input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm">
            <input type="submit" value="Tìm kiếm">
        </form>
    </div>

    <table>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='edit_product.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></td>";
                echo "<td><img src='" . $row['image'] . "' alt='" . $row['name'] . "' width='100'></td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . ($row['active'] ? 'Hiện' : 'Ẩn') . "</td>";
                echo "<td class='actions'><a href='edit_product.php?id=" . $row['id'] . "'>Sửa</a> <a href='delete_product.php?id=" . $row['id'] . "' class='delete' onclick='return confirmDelete()'>Xóa</a>                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Không có sản phẩm nào</td></tr>";
        }
        ?>
    </table>
</body>

</html>
<script>
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?");
    }
</script>