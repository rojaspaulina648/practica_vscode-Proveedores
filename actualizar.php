<?php
include("conexion.php");

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
if (!$id) {
    die("ID de proveedor no válido.");
}

$nombre_cliente = trim($_POST["nombre_c"] ?? "");
$apellido_cliente = trim($_POST["apellido_c"] ?? "");
$nombre_proveedor = trim($_POST["nombre_p"] ?? "");
$producto = trim($_POST["producto"] ?? "");
$cantidad = trim($_POST["cantidad"] ?? "");
$telefono_cliente = trim($_POST["telefono_c"] ?? "");
$telefono_proveedor = trim($_POST["telefono_p"] ?? "");

$sql = "UPDATE proveedores SET nombre_c = ?, apellido_c = ?, nombre_p = ?, producto = ?, cantidad = ?, telefono_c = ?, telefono_p = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssssi", $nombre_cliente, $apellido_cliente, $nombre_proveedor, $producto, $cantidad, $telefono_cliente, $telefono_proveedor, $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit();
} else {
    echo "Error al actualizar: " . $stmt->error;
}
?>
