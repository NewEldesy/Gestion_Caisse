<?php
require_once('model.php');

function createUserTable() {
    $db = dbConnect();
    if (!$db) {
        echo "Failed to connect to the database for table creation." . PHP_EOL;
        return;
    }
    try {
        $db->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT UNIQUE NOT NULL,
                password_hash TEXT NOT NULL
            )
        ");
        echo "Table 'users' checked/created successfully." . PHP_EOL;
    } catch (PDOException $e) {
        echo "Error creating 'users' table: " . $e->getMessage() . PHP_EOL;
    }
}

function addDefaultUser($username, $password) {
    $db = dbConnect();
    if (!$db) {
        echo "Failed to connect to the database for user creation." . PHP_EOL;
        return;
    }

    try {
        // Check if any user already exists
        $stmt = $db->query("SELECT COUNT(*) as count FROM users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && $result['count'] > 0) {
            echo "Users already exist in the 'users' table. Default user not added." . PHP_EOL;
            return;
        }

        // Check if the specific default user already exists (belt and suspenders)
        $stmt = $db->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->fetch()) {
            echo "Default user '$username' already exists. Not adding again." . PHP_EOL;
            return;
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $insertStmt = $db->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
        $insertStmt->bindParam(':username', $username);
        $insertStmt->bindParam(':password_hash', $password_hash);
        
        if ($insertStmt->execute()) {
            echo "Default user '$username' created successfully." . PHP_EOL;
        } else {
            echo "Failed to create default user '$username'." . PHP_EOL;
        }
    } catch (PDOException $e) {
        // Check if error is due to UNIQUE constraint violation (user already exists)
        if ($e->getCode() == 23000 || strpos(strtolower($e->getMessage()), 'unique constraint failed') !== false) {
             echo "Default user '$username' already exists (caught by DB constraint)." . PHP_EOL;
        } else {
            echo "Error adding default user: " . $e->getMessage() . PHP_EOL;
        }
    }
}

// --- Main script execution ---
createUserTable();

// Define default admin credentials
$adminUser = 'admin';
$adminPass = 'password123'; // Change this in a real application!

addDefaultUser($adminUser, $adminPass);

?>
