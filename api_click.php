<?php
require_once 'config.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'No link specified']);
    exit;
}

$link_id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT clicks FROM links WHERE id = :id");
$stmt->execute(['id' => $link_id]);
$link = $stmt->fetch();

if ($link) {
    echo json_encode(['clicks' => $link['clicks']]);
} else {
    echo json_encode(['error' => 'Link not found']);
}
?>
