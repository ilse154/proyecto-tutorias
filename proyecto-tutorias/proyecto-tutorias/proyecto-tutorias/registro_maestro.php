<?php
$conn = new mysqli("localhost", "root", "", "D_tutoria");
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id_maestro"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
    $materia = $_POST["materia"];

    $sql = "INSERT INTO Maestro VALUES ('$id', '$nombre', '$correo', '$contrasena', '$materia')";
    echo $conn->query($sql) ? "✅ Maestro registrado" : "❌ Error: " . $conn->error;
}
?>
<form method="POST">
    <h2>Registro de Maestro</h2>
    ID Maestro: <input name="id_maestro" required><br>
    Nombre: <input name="nombre" required><br>
    Correo: <input name="correo" type="email" required><br>
    Contraseña: <input name="contrasena" type="password" required><br>
    Materia: <input name="materia" required><br>
    <button type="submit">Registrar</button>
</form>
