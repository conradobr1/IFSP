
<?php
// config.php
session_start();

$DB_HOST = 'localhost';
$DB_NAME = 'reclama';
$DB_USER = 'root';
$DB_PASS = ''; // Conrado

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch (PDOException $e) {
    exit('DB connection failed: ' . $e->getMessage());
}

// Helpers
function is_logged() {
    return isset($_SESSION['user']);
}
function is_admin() {
    return is_logged() && $_SESSION['user']['tipo'] === 'admin';
}
function require_login() {
    if(!is_logged()){
        header('Location: login.php');
        exit;
    }
}
function require_admin() {
    if(!is_admin()){
        header('Location: login.php');
        exit;
    }
}
?>
