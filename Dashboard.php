<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


include('db.php');


$user_id = $_SESSION['user_id'];


$stmt = $pdo->prepare("SELECT * FROM user_stories WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$stories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Journal</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <header>
        <h1>Your Journal</h1>
        <nav>
            <ul>
                <li><a href="create_story.php">Post a Story</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Your Daily Dose</h2>
        
        <?php if (count($stories) > 0): ?>
            <?php foreach ($stories as $story): ?>
                <div class="story-box" onclick="openOverlay('<?php echo addslashes($story['story']); ?>')">
                    <p><?php echo htmlspecialchars(substr($story['story'], 0, 150)) . (strlen($story['story']) > 150 ? '...' : ''); ?></p>
                    <small>Posted on <?php echo $story['created_at']; ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You haven't posted any stories yet. <a href="create_story.php">Post a Story</a></p>
        <?php endif; ?>
    </section>

   
    <div id="overlay" class="overlay">
        <div class="overlay-content">
            <span class="close-btn" onclick="closeOverlay()">&times;</span>
            <p id="story-content"></p>
        </div>
    </div>

    <script>
      
        function openOverlay(storyContent) {
            document.getElementById("story-content").innerText = storyContent;
            document.getElementById("overlay").style.display = "block";
        }

       
        function closeOverlay() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</body>
</html>
