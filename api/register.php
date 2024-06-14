<?php
include 'config.php';

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$name = $_POST['name'];

$sql = "INSERT INTO users (email, password, name) VALUES ('$email', '$password', '$name')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "User registered successfully"]);
} else {
    echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>