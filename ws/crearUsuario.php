<?php

declare(strict_types=1);

use Ws\Models\User;

require_once __DIR__ . '/models/User.php';

const ARCHIVO_USUARIOS = __DIR__ . '/usuarios.txt';

header('Content-Type: application/json; charset=utf-8'); //Con la cabecera avisamos al navegador de que lo enviado es un JSON y de la codificación de los caracteres

// Método post únicamente
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido. Usa el formulario.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Recogemos todos los datos
$nombre = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$sexo = $_POST['sexo'] ?? '';
$correo = trim($_POST['correo'] ?? '');
$novedades = isset($_POST['novedades']);
$condiciones = isset($_POST['condiciones']);

// Instancia de la clase user
$usuario = new User($nombre, $apellidos, $sexo, $correo, $novedades, $condiciones);

// Almacenamos los datos en un txt sin sobreescribir (file_append), 
// lock_ex bloquea el archivo mientras escribimos en él para evitar que dos envíos escriban al mismo tiempo 
// El php_eol es salto al "end of the line" para que cada usuario quede en una línea diferente en vez de escribir todos los usuarios seguidos
$guardado = file_put_contents(ARCHIVO_USUARIOS, $usuario->toJson() . PHP_EOL, FILE_APPEND | LOCK_EX);

if ($guardado === false) {
    http_response_code(500);
    echo json_encode(['error' => 'No se ha podido guardar el usuario.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Mostramos por pantalla el usuario en JSON
echo $usuario->toJson();