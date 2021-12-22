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

$email = htmlspecialchars($_POST["email"]);
$referrer = htmlspecialchars($_POST["referrer"]);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Subscribes (email, ip, referrer)
VALUES ('$email', '$ip', '$referrer')";

$myObj = new stdClass();
if ($conn->query($sql) === TRUE) {
  $myObj->ip = $ip;
  $myObj->status = 'success';
  $myJSON = json_encode($myObj);
  echo $myJSON;
  // $to = 'flopsi69@gmail.com';
  // $subject = 'Subscribe from gwei.fi'; 
  // $message = '
  // <html>
  //     <head>
  //         <title>' . $subject . '</title>
  //     </head>
  //     <body>
  //         <p>Данные:</p>
  //         <p>Почта: ' . $referrer . '</p>
  //         <p>IP: ' . $ip . '</p>
  //         <p>Переход на сайт с: ' . $referrer . '</p>
  //     </body>
  // </html>'; 
  // $headers  = "Content-type: text/html; charset=utf-8 \r\n";
  // $headers .= "From: GweiBot <from@example.com>\r\n"; 
  // mail($to, $subject, $message, $headers);
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
