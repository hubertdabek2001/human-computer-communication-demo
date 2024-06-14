<?php
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        include '../config.php';
        $this->conn = $conn;
    }

    public function testFullWorkflow() {
        // Rejestracja użytkownika
        $_POST['email'] = 'test@example.com';
        $_POST['password'] = 'password';
        $_POST['name'] = 'Test User';

        ob_start();
        include '../register.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('User registered successfully', $output);

        // Logowanie użytkownika
        $_POST['email'] = 'test@example.com';
        $_POST['password'] = 'password';

        ob_start();
        include '../login.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('Login successful', $output);

        // Wyszukiwanie muzyki
        $_GET['query'] = 'test song';
        ob_start();
        include '../search.php';
        $output = ob_get_clean();
        $this->assertNotEmpty(json_decode($output));

        // Tworzenie playlisty
        $_POST['name'] = 'Test Playlist';
        $_POST['user_id'] = 1; // Załóżmy, że user_id jest 1
        $_POST['songs'] = [1, 2, 3];

        ob_start();
        include '../create_playlist.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('Playlist created successfully', $output);
    }

    protected function tearDown(): void {
        $this->conn->query("DELETE FROM users WHERE email='test@example.com'");
        $this->conn->close();
    }
}
