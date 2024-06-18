<?php
require 'config.php';
require 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $old_image = $_POST['current_image'];
    $new_image_path = $old_image; // mặc định là không thay đổi

    // Xử lý file ảnh mới nếu có
    if ($_FILES['image']['error'] == 0) {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $max_size = 5 * 1024 * 1024; // 5MB
        $file_info = pathinfo($_FILES["image"]["name"]);
        $file_extension = strtolower($file_info['extension']);

        if (in_array($file_extension, $allowed_types) && $_FILES['image']['size'] <= $max_size) {
            $target_dir = "uploads/";
            $new_image_path = $target_dir . time() . '-' . basename($_FILES["image"]["name"]);

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $new_image_path)) {
                // Xóa file ảnh cũ nếu ảnh mới được upload thành công
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Invalid file type or size. Only JPG, JPEG, PNG, & GIF files are allowed and must be less than 5MB.";
        }
    }

    $student["name"]=$name;
    $student["email"] = $email;
    $student["id"] = $id;
    $student["image"] = $new_image_path;
    $conn = connectDatabase();
    if ($conn){
        updateData($conn, "student", $student, $student["id"]);
    }
    header("Location: index.php"); // Redirect back to the main page
}

// Get student details for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM student WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
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
    <title>Edit Student</title>
</head>
<body>
<?php include 'header.php'; ?>

    <h1>Edit Student</h1>
    <?php if (isset($student)): ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br>
        Email: <input type="text" name="email" value="<?php echo $student['email']; ?>" required><br>
        Current Photo: <img src="<?php echo $student['image']; ?>" width="100"><br>
        New Photo: <input type="file" name="image"><br>
        <input type="hidden" name="current_image" value="<?php echo $student['image']; ?>">
        <input type="submit" name="update" value="Update Student">
    </form>
    <?php else: ?>
    <p>Student not found.</p>
    <?php endif; ?>
    <a href="index.php">Back to list</a>
</body>
</html>
