<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "INSERT INTO Clientes (Nombre, Direccion, Telefono, Email) VALUES ('$nombre', '$direccion', '$telefono', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente agregado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
    exit;
}
?>