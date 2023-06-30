<?php
header("Content-Type: application/json");
session_start();
include 'db_conn.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT DepartureCity, Destination, DepartureDate FROM bookings WHERE UserID = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->execute();

$booked_trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($booked_trips);

$stmt = null;
$conn = null;
?>
