<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['url'])) {
        $url = $_POST['url'];
        $stmt = $pdo->prepare("INSERT INTO links (original_url) VALUES (:url)");
        $stmt->execute(['url' => $url]);
        $link_id = $pdo->lastInsertId();
        header("Location: stats.php?id=$link_id");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Tracking Link</title>
</head>
<body>
    <h1>Create a New Tracking Link</h1>
    <form method="post">
        <input type="url" name="url" placeholder="Enter your URL" required>
        <button type="submit">Create Link</button>
    </form>
</body>
</html>
