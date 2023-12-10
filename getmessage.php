<?php

require '../db/env.php';

$conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT message FROM apis;";
$result = $conn->query($query);

$json_resp = null;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $json_resp = ['response' => $row['message']];  
  }
} else {
	$json_resp = ['error' => 'No rows fetched'];
}
$conn->close();
//useless comment
header('Content-Type: application/json');

echo json_encode($json_resp);
