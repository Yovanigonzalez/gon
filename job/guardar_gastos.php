<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $monto = $conn->real_escape_string($_POST['monto']);
    $fecha = $conn->real_escape_string($_POST['fecha']);
    $archivo = $_FILES['documento'];

    // Inicializa la variable para la ruta del archivo
    $ruta_archivo = null;

    // Verifica si se subió un archivo
    if ($archivo['name']) {
        // Configura la ruta de destino del archivo
        $directorio_subida = '../gastos/';
        $ruta_archivo = $directorio_subida . basename($archivo['name']);
        $tipo_archivo = strtolower(pathinfo($ruta_archivo, PATHINFO_EXTENSION));

        // Verifica si el archivo es un PDF
        if ($tipo_archivo != "pdf") {
            header("Location: gastos?mensaje_error=Solo se permiten archivos PDF.");
            exit();
        }

        // Intenta subir el archivo
        if (!move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
            header("Location: gastos?mensaje_error=Error al subir el archivo.");
            exit();
        }
    }

    // Inserta los datos en la base de datos
    $sql = "INSERT INTO gastos (descripcion, monto, fecha, ruta_archivo) VALUES ('$descripcion', '$monto', '$fecha', '$ruta_archivo')";

    if ($conn->query($sql) === TRUE) {
        header("Location: gastos?mensaje_exito=Gasto guardado exitosamente.");
    } else {
        header("Location: gastos?mensaje_error=Error al guardar la factura: " . $conn->error);
    }
}

$conn->close();
?>
