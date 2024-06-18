    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Thêm sản phẩm mới</title>
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
        <h1>Thêm sản phẩm mới</h1>
        <form action="phpinsert_product.php" method="POST" enctype="multipart/form-data">
            Tên sản phẩm: <input type="text" name="name"><br>
            Ảnh sản phẩm: <input type="file" name="image" required><br>
            Giá: <input type="number" step="0.01" name="price"><br>
            Số lượng: <input type="number" name="quantity"><br>
            Mô tả: <textarea name="description"></textarea><br>
            Trạng thái: 
        <select name="active">
            <option value="1">Hiện</option>
            <option value="0">Ẩn</option>
        </select><br>
            <input type="submit" value="Thêm sản phẩm">
        </form>
    </body>
    </html>
