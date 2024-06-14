<?php
use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        include '../config.php';
        $this->conn = $conn;
    }

    public function testUserRegistration() {
        $_POST['email'] = 'test@example.com';
        $_POST['password'] = 'password';
        $_POST['name'] = 'Test User';

        ob_start();
        include '../register.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('User registered successfully', $output);
    }

    protected function tearDown(): void {
        $this->conn->query("DELETE FROM users WHERE email='test@example.com'");
        $this->conn->close();
    }
}