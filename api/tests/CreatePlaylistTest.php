<?php
use PHPUnit\Framework\TestCase;

class CreatePlaylistTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        include '../config.php';
        $this->conn = $conn;

        // Rejestracja użytkownika przed testem tworzenia playlisty
        $this->conn->query("INSERT INTO users (id, email, password, name) VALUES (1, 'testplaylist@example.com', 'password', 'Test User')");
    }

    public function testCreatePlaylist() {
        $_POST['name'] = 'Test Playlist';
        $_POST['user_id'] = 1; // Załóżmy, że user_id jest 1
        $_POST['songs'] = json_encode([1, 2, 3]);

        ob_start();
        include '../create_playlist.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Playlist created successfully', $output);
    }

    protected function tearDown(): void {
        $this->conn->query("DELETE FROM users WHERE email='testplaylist@example.com'");
        $this->conn->query("DELETE FROM playlists WHERE user_id=1");
        $this->conn->close();
    }
}
