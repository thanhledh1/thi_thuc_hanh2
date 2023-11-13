<?php
define('ROOT_DIR', dirname(__FILE__) );
$username   = 'root';
$password   = '';
$database   = 'quanly_benhnhan';
try {
    $conn = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
} catch (Exception $e) {
    // echo $e->getMessage();
    echo '<h1>Khong the ket noi CSDL</h1>';
}