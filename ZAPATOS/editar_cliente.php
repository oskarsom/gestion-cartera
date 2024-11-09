<?php
include 'conexion.php';

// Consulta para obtener todos los clientes
$sql_clientes = "SELECT * FROM Clientes";
$result_clientes = $conn->query($sql_clientes);

$clientes = [];
if ($result_clientes->num_rows > 0) {
    while ($row = $result_clientes->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Consulta para obtener todas las compras, asociadas a cada cliente y con detalles de productos
$sql_compras = "
    SELECT Compras.CompraID, Compras.ClienteID, Compras.FechaCompra, Compras.Total, 
           DetallesCompra.Cantidad, DetallesCompra.PrecioUnitario, Productos.NombreProducto
    FROM Compras
    JOIN DetallesCompra ON Compras.CompraID = DetallesCompra.CompraID
    JOIN Productos ON DetallesCompra.ProductoID = Productos.ProductoID
    ORDER BY Compras.ClienteID, Compras.FechaCompra";
$result_compras = $conn->query($sql_compras);

$historial_compras = [];
if ($result_compras->num_rows > 0) {
    while ($row = $result_compras->fetch_assoc()) {
        $cliente_id = $row['ClienteID'];
        $historial_compras[$cliente_id][] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #4CAF50;
            padding: 10px;
            border-bottom: 2px solid #4CAF50;
            margin-bottom: 10px;
        }

        .client-container {
            margin: 20px auto;
            width: 80%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        p {
            font-size: 16px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>

<br><a href="tienda.php"><button>Regresar</button></a>

<h1>Historial de Compras de Clientes</h1>

<?php if (count($clientes) > 0): ?>
    <?php foreach ($clientes as $cliente): ?>
        <div class="client-container">
            <h2>Cliente: <?php echo htmlspecialchars($cliente['Nombre']); ?></h2>
            <p>Dirección: <?php echo htmlspecialchars($cliente['Direccion']); ?></p>
            <p>Teléfono: <?php echo htmlspecialchars($cliente['Telefono']); ?></p>
            <p>Email: <?php echo htmlspecialchars($cliente['Email']); ?></p>

            <!-- Tabla de Historial de Compras -->
            <?php if (isset($historial_compras[$cliente['ClienteID']])): ?>
                <table>
                    <tr>
                        <th>Fecha de Compra</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                    <?php foreach ($historial_compras[$cliente['ClienteID']] as $compra): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($compra['FechaCompra']); ?></td>
                            <td><?php echo htmlspecialchars($compra['NombreProducto']); ?></td>
                            <td><?php echo htmlspecialchars($compra['Cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($compra['PrecioUnitario']); ?></td>
                            <td><?php echo htmlspecialchars($compra['Cantidad'] * $compra['PrecioUnitario']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Este cliente no tiene compras registradas.</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No se encontraron clientes.</p>
<?php endif; ?>

</body>
</html>