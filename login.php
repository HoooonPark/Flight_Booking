<?php
session_start();
include 'db_conn.php';

$username = $_POST['Username'];
$password = $_POST['Password'];

$sql = "SELECT UserID, Password FROM user WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $username, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $hashed_password = $result['Password'];
    $userID = $result['UserID'];
    
    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $userID;
        $_SESSION['username'] = $username;
        header("Location: account.php");
    } else {
        header("Location: login.html?error=incorrect_password");
    }
} else {
    header("Location: login.html?error=username_not_found");
}

$stmt = null;
$conn = null;
?>
