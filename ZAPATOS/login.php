<!DOCTYPE html>
<html>
<head>
    <title>Registro e Inicio de Sesión</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos para centrar el contenido */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
        }

        /* Contenedor de los formularios */
        .form-container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        /* Estilos para ocultar y mostrar formularios */
        #registerForm {
            display: none;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        form input[type="text"],
        form input[type="password"],
        form input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        // Función para mostrar el formulario de registro y ocultar el de login
        function mostrarRegistro() {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registerForm').style.display = 'block';
        }

        // Función para mostrar el formulario de login y ocultar el de registro
        function mostrarLogin() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('registerForm').style.display = 'none';
        }

        // Función para validar el login
        function validarLogin(event) {
            event.preventDefault(); // Evita el envío del formulario por defecto
            const nombre = document.querySelector('#loginForm input[name="nombre"]').value;
            const password = document.querySelector('#loginForm input[name="password"]').value;

            // Verificación de usuario y contraseña
            if (nombre === "oscar" && password === "1010237299") {
                // Redirige a index.php si las credenciales son correctas
                window.location.href = "index.php";
            } else {
                // Muestra un mensaje de error si las credenciales son incorrectas
                alert("Usuario o contraseña incorrectos");
            }
        }
    </script>
</head>
<body>

<div class="form-container">
    <h2>Iniciar sesión</h2>
    <!-- Formulario de Login -->
    <form id="loginForm" method="POST" onsubmit="validarLogin(event)">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Iniciar sesión</button>
        <a href="javascript:void(0);" onclick="mostrarRegistro()">Crear cuenta</a>
    </form>

    <!-- Formulario de Registro -->
    <form id="registerForm" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Dirección:</label>
        <input type="text" name="direccion" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Crear cuenta</button>
        <a href="javascript:void(0);" onclick="mostrarLogin()">Ya tengo una cuenta</a>
    </form>
</div>

</body>
</html>