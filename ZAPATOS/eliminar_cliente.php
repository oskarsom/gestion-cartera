<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Clientes WHERE ClienteID = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente eliminado con éxito";
    } else {
        echo "Error al eliminar cliente: " . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
    exit;
}
?>