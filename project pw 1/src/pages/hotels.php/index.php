<?php
require_once '../config/database.php';
require_once '../app/hotels.php';

$database = new Database();
$db = $database->dbConnection();

$hotels = new hotels($db);

// Cek jika parameter id ada pada URL
if(isset($_GET['id'])){
    $hotels->id = $_GET['id'];

    if($hotels->delete()){
        header("Location: index.php");
    }else{
        echo "Gagal menghapus hotels.";
    }
}

// Tampilkan data dari method index
$data = $hotels->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hotels</title>
</head>
<body>
    <h1>hotels</h1>
    <a href="create.php">Tambah</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($data as $row) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        |
                        <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus hotels ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>