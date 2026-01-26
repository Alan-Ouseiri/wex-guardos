<?php
return [

    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser un correo válido.',
    'date' => 'El campo :attribute debe ser una fecha válida.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'unique' => 'El campo :attribute ya existe.',

    'attributes' => [
        'teacher.name' => 'nombre',
        'teacher.surname' => 'apellido',
        'teacher.role' => 'rol',
        'teacher.email' => 'correo electrónico',

        'device.type' => 'tipo de dispositivo',
        'device.brand' => 'marca',
        'device.model' => 'modelo',
        'device.serial_number' => 'número de serie',

        'assigned_date' => 'fecha de entrega',
        'condition' => 'condición',
        'location' => 'ubicación',
        'delivered_by' => 'entregado por',
    ],

];
