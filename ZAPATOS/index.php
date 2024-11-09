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
        <h1>Gestión de Clientes</h1>
        <form action="agregar_cliente.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <button type="submit">Agregar Cliente</button>
        </form>

<br><a href="consultas.php"><button>Consultas</button></a>
        
        <h2>Lista de Clientes</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexion.php';
                $sql = "SELECT * FROM Clientes";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["Nombre"] . "</td>
                                <td>" . $row["Direccion"] . "</td>
                                <td>" . $row["Telefono"] . "</td>
                                <td>" . $row["Email"] . "</td>
                                <td>
                                    <a href='editar_cliente.php?id=" . $row["ClienteID"] . "'>Editar</a>
                                    <a href='eliminar_cliente.php?id=" . $row["ClienteID"] . "'>Eliminar</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay clientes registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var nombre = document.getElementById('nombre').value;
        var email = document.getElementById('email').value;
        var telefono = document.getElementById('telefono').value;
        
        if (nombre === "" || email === "" || telefono === "") {
            alert("Por favor, completa todos los campos");
            event.preventDefault();
        }
    });
</script>

</html>