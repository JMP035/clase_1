<?php

namespace Controllers;

use Model\ActiveRecord;
use MVC\Router;

class UsuarioController extends ActiveRecord{

    public function renderizarPagina(Router $router){
        $router->render('usuario/index', []);
    }

    public static function guardarAPI() {
        getHeadersApi();
        echo json_encode('Llegue hasta gaurdar');
        return;
    }
}


