<?php
include 'config.php';

// Xử lý tìm kiếm
$search_query = isset($_POST['search_query']) ? $_POST['search_query'] : '';

// Thiết lập số sinh viên trên mỗi trang
$students_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $students_per_page;

$sql = "SELECT id, name, email, image FROM student WHERE 1=1";

if (!empty($search_query)) {
    $search_query = $conn->real_escape_string($search_query);
    $sql .= " AND (name LIKE '%$search_query%' OR email LIKE '%$search_query%')";
}

// Lấy tổng số sinh viên để tính số trang
$total_sql = str_replace("SELECT id, name, email, image", "SELECT COUNT(*) as total", $sql);
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_students = $total_row['total'];
$total_pages = ceil($total_students / $students_per_page);

// Thêm giới hạn phân trang vào truy vấn chính
$sql .= " LIMIT $students_per_page OFFSET $offset";
$result = $conn->query($sql);

// danh sách sinh viên đã xem gần đây
$recently_viewed_students = [];
if (isset($_COOKIE['recently_viewed'])) {
    $recently_viewed = json_decode($_COOKIE['recently_viewed'], true);
    if (!empty($recently_viewed)) {
        $placeholders = implode(',', array_fill(0, count($recently_viewed), '?'));
        $stmt = $conn->prepare("SELECT id, name, email, image FROM student WHERE id IN ($placeholders)");
        $stmt->bind_param(str_repeat('i', count($recently_viewed)), ...$recently_viewed);
        $stmt->execute();
        $recently_viewed_result = $stmt->get_result();
        while ($row = $recently_viewed_result->fetch_assoc()) {
            $recently_viewed_students[] = $row;
        }
        $stmt->close();
    }
}
?>

<?php
session_start();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
</head>
<body>
<?php if (isset($_SESSION['username'])): ?>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! <a id="Logout" href="logout.php">Logout</a></p>
<?php endif; ?>

<h1>Student List</h1>
<a id ="login" href="login.php">Login</a>

<form action="" method="post">
    <label for="search_query">Tìm kiếm:</label>
    <input type="text" id="search_query" name="search_query" value="<?php echo htmlspecialchars($search_query); ?>">
    <input type="submit" value="Tìm kiếm">
</form>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Image</th>
        <?php if (isset($_SESSION['username']) && $_SESSION['username'] == true): ?>
            <th>Actions</th>
        <?php endif; ?>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="view_student.php?id=<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></a> </td>
        <td><?php echo $row['email']; ?></td>
        <td><img src="<?php echo $row['image']; ?>" width="100" alt="No Image"></td>
        <?php if (isset($_SESSION['username']) && $_SESSION['username'] == true): ?>
        <td>
            <a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a href="delete_student.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
        <?php endif; ?>
    </tr>
    <?php endwhile; ?>
</table>

<div>
    <form method="get" action="">
        <input type="hidden" name="search_query" value="<?php echo htmlspecialchars($search_query); ?>">
        <label for="page">Trang:</label>
        <select id="page" name="page" onchange="this.form.submit()">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<option value='$i'" . ($i == $page ? " selected" : "") . ">$i</option>";
            }
            ?>
        </select>
    </form>
</div>

<h2>Những sinh viên đã xem</h2>
<?php if (!empty($recently_viewed_students)): ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == true): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($recently_viewed_students as $student): ?>
        <tr>
            <td><?php echo $student['id']; ?></td>
            <td><a href="view_student.php?id=<?php echo $student['name']; ?>"> <?php echo $student['name']; ?> </a></td>
            <td><?php echo $student['email']; ?></td>
            <td><img src="<?php echo $student['image']; ?>" width="100" alt="No Image"></td>
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == true): ?>
            <td>
                <a href="edit_student.php?id=<?php echo $student['id']; ?>">Edit</a>
                <a href="delete_student.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Chưa xem sinh viên nào</p>
<?php endif; ?>

<a id ="add" href="add_student.php">Add New Student</a>
</body>

</html>
<?php
include "footer.php";
?>
<?php

$conn->close();
?>
