<?php
require_once '../config/database.php';
require_once '../app/hotels.php';

$database = new Database();
$db = $database->dbConnection();

$hotels = new hotels($db);

if(isset($_POST['update'])) {
    $hotels->id = $_POST['id'];
    $hotels->name = $_POST['name'];
    $hotels->address = $_POST['address'];
    $hotels->city = $_POST['city'];
    $hotels->country = $_POST['country'];

    $hotels->update();
    header("Location: index.php");
    exit;
} elseif(isset($_GET['id'])) {
    $hotels->id = $_GET['id'];
    $stmt = $hotels->edit();
    $num = $stmt->rowCount();

    if($num > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="kode">Kode:</label>
        <input type="text" name="kode" value="<?php echo $kode; ?>" required>
        <br>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $nama; ?>" required>
        <br>
        <label for="address">address:</label>
        <input type="number" name="address" value="<?php echo $address; ?>" required>
        <br>
        <label for="city">city:</label>
        <input type="number" name="city" value="<?php echo $city; ?>" required>
        <br>
        <label for="country">country:</label>
        <input type="number" name="country" value="<?php echo $country; ?>" required>
        <br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>