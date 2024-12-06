<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Registro</title>
    <!-- Vincular el archivo CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();

// Validar los datos recibidos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre']);
    $edad = $_POST['edad'];
    $correo = trim($_POST['correo']);
    $curso = $_POST['curso'];
    $genero = isset($_POST['genero']) ? $_POST['genero'] : null;
    $intereses = isset($_POST['intereses']) ? $_POST['intereses'] : [];

    // Validaciones en el servidor
    if (empty($nombre) || empty($edad) || empty($correo) || empty($curso) || !$genero || empty($intereses)) {
        $_SESSION['mensaje'] = "Por favor, complete todos los campos requeridos.";
        header('Location: index.php');
        exit();
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensaje'] = "Por favor, ingrese un correo electrónico válido.";
        header('Location: index.php');
        exit();
    }

    if ($edad < 10 || $edad > 100) {
        $_SESSION['mensaje'] = "Por favor, ingrese una edad válida entre 18 y 100 años.";
        header('Location: index.php');
        exit();
    }

    // Si todas las validaciones pasaron
    $_SESSION['mensaje'] = "¡Registro exitoso!";

    // Mostrar los datos registrados
    echo "<h1>Datos Registrados</h1>";
    echo "<p><strong>Nombre:</strong> $nombre</p>";
    echo "<p><strong>Edad:</strong> $edad</p>";
    echo "<p><strong>Correo Electrónico:</strong> $correo</p>";
    echo "<p><strong>Curso de Interés:</strong> $curso</p>";
    echo "<p><strong>Género:</strong> $genero</p>";
    echo "<p><strong>Áreas de Interés:</strong> " . implode(", ", $intereses) . "</p>";

    // Opción para registrar nuevamente
    echo "<p><a href='index.php'>Realizar otro registro</a></p>";
} else {
    $_SESSION['mensaje'] = "Método de solicitud no válido.";
    header('Location: index.php');
    exit();
}
?>

</body>
</html>
