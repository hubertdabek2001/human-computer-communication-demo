<?php
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        include '../config.php';
        $this->conn = $conn;
    }

    public function testSearchMusic() {
        $_GET['query'] = 'test song';

        ob_start();
        include '../search.php';
        $output = ob_get_clean();
        $results = json_decode($output, true);

        $this->assertIsArray($results);
        $this->assertNotEmpty($results);
    }

    protected function tearDown(): void {
        $this->conn->close();
    }
}
