<?php
include 'config.php';

$name = $_POST['name'];
$user_id = $_POST['user_id'];
$songs = $_POST['songs']; // array of song ids

$sql = "INSERT INTO playlists (name, user_id) VALUES ('$name', '$user_id')";

if ($conn->query($sql) === TRUE) {
    $playlist_id = $conn->insert_id;
    foreach ($songs as $song_id) {
        $conn->query("INSERT INTO playlist_songs (playlist_id, song_id) VALUES ('$playlist_id', '$song_id')");
    }
    echo json_encode(["message" => "Playlist created successfully"]);
} else {
    echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>