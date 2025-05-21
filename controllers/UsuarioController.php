<?php

namespace Controllers;

use Model\ActiveRecord;
use MOdel\Usuarios;
use MVC\Router;

class UsuarioController extends ActiveRecord
{

    public function renderizarPagina(Router $router)
    {
        $router->render('usuario/index', []);
    }

    public static function guardarAPI()
{
    getHeadersApi();

    // Sanitizar y validar apellido
    $_POST['usuario_apellidos'] = htmlspecialchars($_POST['usuario_apellidos']);
    $cantidad_apellido = strlen($_POST['usuario_apellidos']);
    if ($cantidad_apellido < 2) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'El apellido debe contener al menos 2 caracteres.'
        ]);
        return;
    }

    // Sanitizar y validar nombre
    $_POST['usuario_nombres'] = htmlspecialchars($_POST['usuario_nombres']);
    $cantidad_nombre = strlen($_POST['usuario_nombres']);
    if ($cantidad_nombre < 2) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'El nombre debe contener al menos 2 caracteres.'
        ]);
        return;
    }

    // Validar teléfono
    if (!isset($_POST['usuario_telefono']) || !ctype_digit($_POST['usuario_telefono']) || strlen($_POST['usuario_telefono']) != 8) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'El teléfono debe contener exactamente 8 dígitos numéricos.'
        ]);
        return;
    }

    // Sanitizar NIT
    $_POST['usuario_nit'] = filter_var($_POST['usuario_nit'], FILTER_SANITIZE_NUMBER_INT);

    // Sanitizar y validar correo
    $_POST['usuario_correo'] = filter_var($_POST['usuario_correo'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($_POST['usuario_correo'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'El correo electrónico no es válido.'
        ]);
        return;
    }

    // Validación con try-catch aplicada solamente en usuario_estado
    try {
        $_POST['usuario_estado'] = strtoupper(trim($_POST['usuario_estado']));
        $estado = $_POST['usuario_estado'];
        if (!in_array($estado, ['P', 'F', 'C'])) {
            throw new \Exception('El estado solo puede ser "P", "F" o "C".');
        }
    } catch (\Exception $e) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => $e->getMessage()
        ]);
        return;
    }

    // Si todo está bien, muestra datos (o aquí se podría guardar en BD)
    echo json_encode($_POST);
    return;
}
}
