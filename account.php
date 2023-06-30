<?php
session_start();
include 'db_conn.php';

if (!isset($_SESSION['user_id'])) {
	header("Location: index.php");
	exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM bookings WHERE UserID = :user_id");
$stmt->execute([':user_id' => $user_id]);
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
$today = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/account.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<title>Account</title>

</head>

<body>
	<div id="header-bar">
		<header id="account-header">
			<nav>
				<div class="logo">Flight Booker</div>
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</nav>
		</header>
		<br>
		<div id="account-container">
			<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
		</div>
		<section class="search-container">
			<h1>Book Your Flight</h1>
			<form action="available_flights.php" method="post">
				<div class="form-group">
					<label for="departureCity">Departure City</label>
					<input type="text" name="departureCity" id="departureCity" required>
				</div>
				<div class="form-group">
					<label for="destination">Destination</label>
					<input type="text" name="destination" id="destination" required>
				</div>
				<div class="form-group">
					<label for="departureDate">Departure Date</label>
					<input type="date" name="departureDate" id="departureDate" required>
				</div>
				<button type="submit">Search Flights</button>
			</form>
		</section>

	</div>
	<main>
		<div class="account-view">
			<h2>Your Booked Trips</h2>
		</div>
		
		<section class="trips" id="booked-trips">
		<?php
		if (!empty($trips)) {
			foreach ($trips as $trip) {
				echo "<a href='ticket.php?BookingID={$trip['BookingID']}' class='trip-box'>";
				echo "<article class='trip-item'>";
				echo "<p>From: {$trip['DepartureCity']}<br>To: {$trip['Destination']} <br>Departure: {$trip['DepartureDate']}</p>";
				echo "</article>";
				echo "</a>";
			}
			echo "</section>";
		} else {
			echo "<p>No trips booked yet.</p>";
		}
		?>
		</section>

	</main>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const today = new Date().toISOString().slice(0, 10);
			document.getElementById('departureDate').min = today;
		});
		const loggedInUser = "<?php echo $_SESSION['user_id']; ?>";

		$(document).ready(function() {
			$('#user_id').text(loggedInUser);

			$.getJSON('airports.json', function(airports) {
				const airportList = airports.map(airport => airport.city + ', ' + airport.code);

				$('#departureCity').autocomplete({
					source: airportList
				});
				$('#destination').autocomplete({
					source: airportList
				});
			});
		});
	</script>
</body>

</html>