<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    die("No link specified.");
}

$link_id = (int)$_GET['id'];

// Get link data
$stmt = $pdo->prepare("SELECT * FROM links WHERE id = :id");
$stmt->execute(['id' => $link_id]);
$link = $stmt->fetch();

if (!$link) {
    die("Link not found.");
}

// Build the tracking link (adjust the path if necessary)
$tracking_link = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/track.php?id=' . $link_id;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Link Stats</title>
</head>
<body>
    <h1>Tracking Link Details</h1>
    <p>Original URL: <a href="<?php echo htmlspecialchars($link['original_url']); ?>"><?php echo htmlspecialchars($link['original_url']); ?></a></p>
    <p>Tracking Link: <a href="<?php echo $tracking_link; ?>"><?php echo $tracking_link; ?></a></p>
    <h2>Clicks: <span id="click-count"><?php echo $link['clicks']; ?></span></h2>

    <script>
        function fetchClicks() {
            fetch('api_clicks.php?id=<?php echo $link_id; ?>')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('click-count').innerText = data.clicks;
                });
        }
        // Update every 3 seconds
        setInterval(fetchClicks, 3000);
    </script>
</body>
</html>
