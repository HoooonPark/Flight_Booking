<?php
$DBconnectString = "mysql:host=127.0.0.1:3308;dbname=booking";
$DBusername = "root";
$DBpassword = "";
try {
    $conn = new PDO($DBconnectString, $DBusername, $DBpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>