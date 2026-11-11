<?php
include("conexion.php");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    die("ID de proveedor no válido.");
}

$stmt = $conexion->prepare("DELETE FROM proveedores WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Error al eliminar: " . $stmt->error;
}
?>
