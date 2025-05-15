<?php

namespace MOdel;

use Model\ActiveRecord;

class Usuarios extends ActiveRecord{
    public $tabla = 'usuarios';

    public $columnasDB = [
        'usuario_nombre',
        'usuario_apellido',
        'usuario_nit',
        'usuario_telefono',
        'usuario_correo',
        'usuario_estado',
        'usuario_situacion',
    ];

    public $idTabla = 'usuario_id';

    public $usuario_id;
    public $usuario_nombre;
    public $usuario_apellido;
    public $usuario_nit;
    public $usuario_telefono;
    public $usuario_correo;
    public $usuario_estado;
    public $usuario_situacion;

    public function __construct($args = []){
        $this->usuario_id = $args['usuario_id'] ?? null;
        $this->usuario_nombre = $args['usuario_nombre'] ?? '';
        $this->usuario_apellido = $args['usuario_apellido'] ?? '';
        $this->usuario_nit = $args['usuario_nit'] ?? 0;
        $this->usuario_telefono = $args['usuario_telefono'] ?? 0;
        $this->usuario_correo = $args['usuario_correo'] ?? 0;
        $this->usuario_estado = $args['usuario_estado'] ?? 0;
        $this->usuario_situacion = $args['usuario_situacion'] ?? 1;
    }

}