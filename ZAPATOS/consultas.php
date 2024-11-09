<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP Básico</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<br><a href="tienda.php"><button>Tienda</button></a>


<div class="container">
    <h1>Consultas de Gestión Empresarial</h1>

    <!-- Productos más vendidos -->
    <h2>Productos más vendidos</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'conexion.php';
            $sql = "SELECT p.NombreProducto, SUM(dc.Cantidad) AS TotalVendido 
                    FROM Productos p
                    JOIN DetallesCompra dc ON p.ProductoID = dc.ProductoID
                    GROUP BY p.NombreProducto
                    ORDER BY TotalVendido DESC
                    LIMIT 5"; // Puedes ajustar el límite según tus necesidades
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["NombreProducto"] . "</td>
                            <td>" . $row["TotalVendido"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No hay datos disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Clientes que han comprado en el último mes -->
    <h2>Clientes que compraron en el último mes</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre del Cliente</th>
                <th>Fecha de Compra</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT c.Nombre, com.FechaCompra 
                    FROM Clientes c
                    JOIN Compras com ON c.ClienteID = com.ClienteID
                    WHERE com.FechaCompra >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                    ORDER BY com.FechaCompra DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["Nombre"] . "</td>
                            <td>" . $row["FechaCompra"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No hay compras en el último mes</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Clientes que solicitaron crédito -->
    <h2>Clientes que solicitaron crédito</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre del Cliente</th>
                <th>Monto del Crédito</th>
                <th>Fecha de Inicio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT c.Nombre, cr.Monto, cr.FechaInicio 
                    FROM Clientes c
                    JOIN Creditos cr ON c.ClienteID = cr.ClienteID
                    ORDER BY cr.FechaInicio DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["Nombre"] . "</td>
                            <td>" . $row["Monto"] . "</td>
                            <td>" . $row["FechaInicio"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay clientes con crédito</td></tr>";
            }
            ?>
        </tbody>
    </table>

</div>

</body>
</html>