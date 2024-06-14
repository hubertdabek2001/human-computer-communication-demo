<?php
include 'config.php';

$query = $_GET['query'];

$sql = "SELECT * FROM songs WHERE title LIKE '%$query%' OR artist LIKE '%$query%'";
$result = $conn->query($sql);

$songs = [];
while ($row = $result->fetch_assoc()) {
    $songs[] = $row;
}

echo json_encode($songs);

$conn->close();
?>