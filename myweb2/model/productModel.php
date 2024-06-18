
<?php
namespace MYWEB2\ProductModels;

use PDO;
use PDOException;

class ProductModel {
    private $pdo; // PDO connection

    public function __construct() {
        require_once("config.php"); // Include configuration directly

        try {
            $this->pdo = new PDO("mysql:host=$dbserver;dbname=$dbname", $dbuser, $dbpass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public function getAll($limit = 10, $start = 0) {
        $stmt = $this->pdo->prepare("SELECT * FROM products ORDER BY id DESC LIMIT :start, :limit");
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $fields = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?')); // Dynamic placeholders
        $values = array_values($data);

        $stmt = $this->pdo->prepare("INSERT INTO products ($fields) VALUES ($placeholders)");
        return $stmt->execute($values);
    }

    public function update($data) {
        $id = $data['id'];
        unset($data['id']); // Remove ID from data to be updated

        $setClause = implode('=?, ', array_keys($data)) . '=?'; // Dynamic SET clause
        $values = array_values($data);
        $values[] = $id; // Add ID for the WHERE clause

        $stmt = $this->pdo->prepare("UPDATE products SET $setClause WHERE id = ?");
        return $stmt->execute($values);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function exeQuery($sql) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
