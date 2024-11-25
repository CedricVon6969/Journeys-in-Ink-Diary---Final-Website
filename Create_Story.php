<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $story = $_POST['story'];
    $user_id = $_SESSION['user_id']; 

   
    $stmt = $pdo->prepare("INSERT INTO user_stories (user_id, story) VALUES (?, ?)");
    $stmt->execute([$user_id, $story]);

    // Redirect to dashboard after posting
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Your Story</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Story of the Day</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Your Journal</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <form action="create_story.php" method="POST">
           
            <textarea name="story" class="story-textarea" oninput="autoResize(this)" placeholder="Write your story here..." required></textarea>
            <button type="submit" class="submit-button">Post</button>
        </form>
    </section>

    <script>
        
        function autoResize(element) {
            element.style.height = "auto";
            element.style.height = (element.scrollHeight) + "px";
        }
    </script>
</body>
</html>
