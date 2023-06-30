<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$departureCity = $_POST['departureCity'];
$destination = $_POST['destination'];
$departureDate = $_POST['departureDate'];

$availableFlightTimes = ['09:00', '12:00', '15:00', '18:00', '21:00'];
// shuffle($availableFlightTimes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Flights</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Available Flights</h1>
    <h2>From <?php echo $departureCity; ?> to <?php echo $destination; ?></h2>
    <h3>Departure Date: <?php echo $departureDate; ?></h3>

    <form action="book_selected_flight.php" method="post">
        <input type="hidden" name="departureCity" value="<?php echo $departureCity; ?>">
        <input type="hidden" name="destination" value="<?php echo $destination; ?>">
        <input type="hidden" name="departureDate" value="<?php echo $departureDate; ?>">

        <ul>
        <?php foreach ($availableFlightTimes as $time): ?>
            <li>
                <input type="radio" name="flightTime" value="<?php echo $time; ?>" id="time-<?php echo $time; ?>" required>
                <label for="time-<?php echo $time; ?>"><?php echo $time; ?></label>
            </li>
        <?php endforeach; ?>
        </ul>

        <button type="submit">Book Selected Flight</button>
    </form>
</body>
</html>