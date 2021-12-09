<?php
$servername = "localhost";
$username = "gwei_usr";
$password = "EhN9hVDHX0AG3lR";
$dbname = "gwei";

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $ip = $_SERVER['REMOTE_ADDR'];
}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$email = htmlspecialchars($_POST["email"]);
$wallet = htmlspecialchars($_POST["wallet"]);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Wallets (email, wallet)
VALUES ('$email', '$wallet')";

$myObj = new stdClass();
if ($conn->query($sql) === TRUE) {
  $myObj->ip = $ip;
  $myObj->status = 'success';
  $myJSON = json_encode($myObj);
  echo $myJSON;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
