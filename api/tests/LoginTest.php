<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        include '../config.php';
        $this->conn = $conn;
    }

    public function testUserLogin() {
        $this->conn->query("INSERT INTO users (email, password, name) VALUES ('testlogin@example.com', 'password', 'Test User')");

        $_POST['email'] = 'testlogin@example.com';
        $_POST['password'] = 'password';

        ob_start();
        include '../login.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Login successful', $output);
    }

    protected function tearDown(): void {
        $this->conn->query("DELETE FROM users WHERE email='testlogin@example.com'");
        $this->conn->close();
    }
}
