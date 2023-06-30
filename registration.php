<?php
include 'db_conn.php';

$username = $_POST['Username'];
$password = $_POST['Password'];
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$email = $_POST['Email'];
$address = $_POST['BillingAddress'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO user (Username, Password, FirstName, LastName, Email, BillingAddress) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(1, $username, PDO::PARAM_STR);
$stmt->bindParam(2, $hashed_password, PDO::PARAM_STR);
$stmt->bindParam(3, $firstName, PDO::PARAM_STR);
$stmt->bindParam(4, $lastName, PDO::PARAM_STR);
$stmt->bindParam(5, $email, PDO::PARAM_STR);
$stmt->bindParam(6, $address, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo "<script>alert('Registration successful!');</script>";
    header("Location: login.html");
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

$stmt = null;
$conn = null;
?>