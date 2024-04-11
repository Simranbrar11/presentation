<?php
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "presentation";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Prepare and bind parameters
  $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $message);

  // Set parameters
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Execute the query
  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close statement
  $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Feedback Form</title>
</head>
<body>
  <h2>Feedback Form</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="message">Message:</label><br>
    <textarea id="message" name="message" required></textarea><br><br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
