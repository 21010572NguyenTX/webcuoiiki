<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include 'header.php'; ?>

<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin ảnh để xóa file
    $sql = "SELECT image FROM student WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $image = $row['image'];
    }
    $stmt->close();

    // Xóa sinh viên
    $sql = "DELETE FROM student WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Xóa file ảnh nếu tồn tại
        if (file_exists($image)) {
            unlink($image);
        }
        echo "Student deleted successfully.";
    } else {
        echo "Error deleting student.";
    }
    $stmt->close();
}

header("Location: index.php"); // Redirect back to the main page
?>
