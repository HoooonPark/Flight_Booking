<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include 'db_conn.php';

$departureCity = $_POST['departureCity'];
$destination = $_POST['destination'];
$departureDate = $_POST['departureDate'];
$flightTime = $_POST['flightTime'];
$userId = $_SESSION['user_id'];

$datetime = $departureDate . " " . $flightTime . ":00";

try {
    $query = "INSERT INTO bookings (UserID, departureCity, destination, departureDate) VALUES (:UserID, :departureCity, :destination, :departureDate)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':UserID', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':departureCity', $departureCity, PDO::PARAM_STR);
    $stmt->bindParam(':destination', $destination, PDO::PARAM_STR);
    $stmt->bindParam(':departureDate', $datetime, PDO::PARAM_STR);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['success_message'] = "Flight booked successfully!";
        header("Location: account.php");
    } else {
        $_SESSION['error_message'] = "There was an error booking your flight. Please try again.";
        header("Location: account.php");
    }

} catch (PDOException $e) {
    $_SESSION['error_message'] = "There was an error booking your flight. Please try again. Error: " . $e->getMessage();
    header("Location: account.php");
}
?>
