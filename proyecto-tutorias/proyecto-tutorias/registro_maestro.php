<?php
// ======================================
// Conexión a la base de datos (MySQL)
// ======================================
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "D_tutoria"; // 👈 Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// ======================================
// Insertar datos si se envía el formulario
// ======================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_maestro = $_POST["id_maestro"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT); // 🔒 Encriptar contraseña
    $materia = $_POST["materia"];

    $sql = "INSERT INTO Maestro (Id_Maestro, Nombre, Correo, Contrasena, Materia)
            VALUES ('$id_maestro', '$nombre', '$correo', '$contrasena', '$materia')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>✅ Maestro registrado correctamente.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Maestros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f6fa;
            margin: 40px;
        }
        h1 { color: #2a4d69; }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        input[type=text], input[type=email], input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type=submit] {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        table {
            margin-top: 40px;
            border-collapse: collapse;
            width: 100%;
            background-color: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4a90e2;
            color: white;
        }
    </style>
</head>
<body>

<h1>Registro de Maestros</h1>

<form method="POST" action="">
    <label>ID Maestro:</label>
    <input type="text" name="id_maestro" required>

    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Correo:</label>
    <input type="email" name="correo" required>

    <label>Contraseña:</label>
    <input type="password" name="contrasena" required>

    <label>Materia:</label>
    <input type="text" name="materia" required>

    <input type="submit" value="Registrar Maestro">
</form>

<?php
// ======================================
// Mostrar tabla de maestros registrados
// ======================================
$result = $conn->query("SELECT Id_Maestro, Nombre, Correo, Materia FROM Maestro");

if ($result->num_rows > 0) {
    echo "<h2>📋 Maestros Registrados</h2>";
    echo "<table>";
    echo "<tr><th>ID Maestro</th><th>Nombre</th><th>Correo</th><th>Materia</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Id_Maestro']}</td>
                <td>{$row['Nombre']}</td>
                <td>{$row['Correo']}</td>
                <td>{$row['Materia']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hay maestros registrados aún.</p>";
}

$conn->close();
?>

</body>
</html>
