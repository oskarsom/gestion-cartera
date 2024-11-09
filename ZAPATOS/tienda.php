<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Zapatos</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .product {
            border: 1px solid #ccc;
            padding: 16px;
            margin: 16px;
            text-align: center;
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product h2 {
            font-size: 24px;
            margin: 16px 0;
        }
        .product p {
            font-size: 18px;
            color: #555;
        }
        .product button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .product button:hover {
            background-color: #218838;
        }
        
        /* Estilos para la ventana emergente */
        #modalCompra {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        #modalContent {
            background-color: white;
            padding: 20px;
            width: 300px;
            border-radius: 8px;
            text-align: center;
        }
        #modalContent input {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #modalContent button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
    <script>
        function abrirModalCompra(producto) {
            document.getElementById('producto').value = producto;
            document.getElementById('modalCompra').style.display = 'flex';
        }

        function cerrarModalCompra() {
            document.getElementById('modalCompra').style.display = 'none';
        }

        function realizarCompra() {
            // Datos de la compra
            const usuario = document.getElementById('usuario').value;
            const producto = document.getElementById('producto').value;
            const cantidad = document.getElementById('cantidad').value;
            const fecha = document.getElementById('fecha').value;
            const valor = document.getElementById('valor').value;

            // Validación (puedes agregar más validaciones si lo necesitas)
            if (usuario && producto && cantidad && fecha && valor) {
                // Enviar los datos al servidor usando AJAX
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "procesar_compra.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert("Compra realizada con éxito");
                        cerrarModalCompra();
                    }
                };
                xhr.send(`usuario=${usuario}&producto=${producto}&cantidad=${cantidad}&fecha=${fecha}&valor=${valor}`);
            } else {
                alert("Por favor, completa todos los campos");
            }
        }
    </script>
</head>
<body>
    <h1>Tienda de Zapatos</h1>

    <br><a href="login.php"><button>Iniciar sesión</button></a>
    <br><br><a href="editar_cliente.php"><button>Compras</button></a>

    <div class="product">
        <img src="zapato1.jpg" alt="Zapato Casual">
        <h2>Zapato Casual</h2>
        <p>Precio: $50.00</p>
        <button onclick="abrirModalCompra('Zapato Casual')">Comprar</button>
    </div>
    <div class="product">
        <img src="zapato2.jpg" alt="Zapato Deportivo">
        <h2>Zapato Deportivo</h2>
        <p>Precio: $70.00</p>
        <button onclick="abrirModalCompra('Zapato Deportivo')">Comprar</button>
    </div>
    <div class="product">
        <img src="zapato3.jpg" alt="Zapato Formal">
        <h2>Zapato Formal</h2>
        <p>Precio: $90.00</p>
        <button onclick="abrirModalCompra('Zapato Formal')">Comprar</button>
    </div>

    <!-- Ventana emergente -->
    <div id="modalCompra">
        <div id="modalContent">
            <h3>Detalles de la Compra</h3>
            <input type="text" id="usuario" placeholder="Usuario">
            <input type="hidden" id="producto">
            <input type="number" id="cantidad" placeholder="Cantidad">
            <input type="date" id="fecha">
            <input type="number" id="valor" placeholder="Valor">
            <button onclick="realizarCompra()">Ordenar</button>
            <br><br>
            <button onclick="cerrarModalCompra()">Cancelar</button>
        </div>
    </div>
</body>
</html>