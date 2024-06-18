<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM student WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
    
    // Handle recently viewed students
    if (isset($_COOKIE['recently_viewed'])) {
        $recently_viewed = json_decode($_COOKIE['recently_viewed'], true);
    } else {
        $recently_viewed = [];
    }
    
    // Add the current student to the beginning of the list
    if (!in_array($id, $recently_viewed)) {
        array_unshift($recently_viewed, $id);
    }
    
    // Keep only the 5 most recent
    $recently_viewed = array_slice($recently_viewed, 0, 5);
    
    // Store the updated list in a cookie
    setcookie('recently_viewed', json_encode($recently_viewed), time() + (86400 * 30), "/"); // 30 days
} else {
    echo "No student found";
    exit;
}
?>

<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
</head>
<body>
<?php include 'header.php'; ?>

    <h1>Student Details</h1>
    <?php if ($student): ?>
        <p>ID: <?php echo $student['id']; ?></p>
        <p>Name: <?php echo $student['name']; ?></p>
        <p>Email: <?php echo $student['email']; ?></p>
        <p>Image: <img src="<?php echo $student['image']; ?>" width="100" alt="Student Image"></p>
    <?php else: ?>
        <p>Student not found.</p>
    <?php endif; ?>
    <a href="index.php">Back to list</a>
</body>
</html>
