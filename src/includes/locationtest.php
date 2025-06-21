<!DOCTYPE html>
<html>
<head>
<title>Nearest Centers</title>
<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD']=== 'POST') {

$userLocation = $_POST['location']; 


$bloodType = $_POST['bloodtype']; 

if (empty($userLocation) || empty($bloodType)) {
echo "Please enter both location and blood type.";
exit; 
}


$sql = "SELECT CENTER.CenterID, CENTER.CenterName, CENTER.Latitude, CENTER.Longitude
FROM CENTER 
INNER JOIN INVENTORY ON CENTER.CenterID = INVENTORY.CenterID 
WHERE INVENTORY.BloodType = :bloodType";


try {
$stmt = $conn->prepare($sql);
} catch (PDOException $e) {
echo "Error preparing statement: " . $e->getMessage();
exit;
}


$stmt->bindParam(':bloodType', $bloodType, PDO::PARAM_STR);


try {
$stmt->execute();
} catch (PDOException $e) {
echo "Error getting centers: " . $e->getMessage();
exit;
}

$nearestCenter = null;
$nearestDistance = PHP_INT_MAX;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$centerLocation = array('lat' => $row['Latitude'], 'lng' => $row['Longitude']);
$distance = getDistance($userLocation, $centerLocation, 'AIzaSyCe5ZVazAnHUseeOhuUsXGFjVt2CKwaqYY'); 

if ($distance < $nearestDistance) {
$nearestDistance = $distance;
$nearestCenter = $row;
}
}


if ($nearestCenter) {
echo "<h2>Nearest Center:</h2>";
echo "<p>Name: " . htmlspecialchars($nearestCenter['CenterName']) . "</p>";
echo "<p>Distance: " . $nearestDistance . " km</p>";
} else {
echo "No centers found for the selected blood type.";
}
}


function getDistance($location1, $location2, $apiKey) {
$location2String = $location2['lat'] . ',' . $location2['lng'];
$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=" . urlencode($location1) . "&destinations=" . urlencode($location2String) . "&key=" . $apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$json = curl_exec($ch);
curl_close($ch);

$data = json_decode($json, true);

if ($data['status'] === 'OK' && !empty($data['rows'][0]['elements'][0]['distance'])) {
return $data['rows'][0]['elements'][0]['distance']['value'] / 1000;
} else {

error_log("Error getting distance: " . print_r($data, true)); 
return PHP_INT_MAX; 
}
}
?>
</body>
</html>
