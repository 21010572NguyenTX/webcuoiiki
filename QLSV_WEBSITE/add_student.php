<?php
require 'config.php';
require 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $image = ''; // sẽ cập nhật sau khi xử lý file

    // Xử lý file ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        }
    }
    /*$student["name"]=$name;
    $student["email"] = $email;
    $student["id"] = $id;
    $student["image"] = $image;
    $conn= connectDatabase();
    if($conn){
        insertData($conn,"student", $student);
    }
    */

    $sql = "INSERT INTO student (name, email,image) VALUES (?, ?,  ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $image);
    $stmt->execute();
    if ($stmt->execute()) {
        echo "<script>alert('Thêm sinh viên thành công'); window.location.href='index.php';</script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
}
?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
</head>
<body>

    <h1>Add New Student</h1>
    <form method="post" enctype="multipart/form-data">
        Name: <input type="text" name="name" required><br>
        Email: <input type="text" name="email" required><br>
        Photo: <input type="file" name="image" ><br>
        <input type="submit" id = "submit" value="Add Student">
    </form>
    <a href="index.php">Back to list</a>
</body>
</html>
