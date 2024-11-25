<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $entry_id = $_GET['id'];
    $query = "SELECT * FROM entries WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $entry_id]);
    $entry = $stmt->fetch();

    if (!$entry) {
        die("Entry not found.");
    }
} else {
    die("No entry selected.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary Entry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>My Diary</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="entry-container">
        <h2><?php echo htmlspecialchars($entry['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($entry['content'])); ?></p>
    </section>

    <footer>
        <p>&copy; 2024 J.i.K Diary</p>
    </footer>
</body>
</html>
