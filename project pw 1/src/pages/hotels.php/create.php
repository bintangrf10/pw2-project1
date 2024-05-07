<?php
require_once '../config/database.php';
require_once '../app/hotels.php';

$database = new Database();
$db = $database->dbConnection();

$hotels = new hotels($db);

if(isset($_POST['tambah'])){
    $hotels->name = $_POST['name'];
    $hotels->address = $_POST['address'];
    $hotels->city = $_POST['city'];
    $hotels->country = $_POST['country'];

    $hotels->store(); 
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data</h1>
    <form method="POST" action="">
        <label for="name">name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="address">address:</label>
        <input type="text" name="address" required>
        <br>
        <label for="city">city:</label>
        <input type="text" name="city" required>
        <br>
        <label for="country">country:</label>
        <input type="text" name="country" required>
        <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
</body>
</html>