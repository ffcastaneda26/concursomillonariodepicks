<?php

return [

	/*
		    |--------------------------------------------------------------------------
		    | Validation Language Lines
		    |--------------------------------------------------------------------------
		    |
		    | The following language lines contain the default error messages used by
		    | the validator class. Some of these rules have multiple versions such
		    | as the size rules. Feel free to tweak each of these messages here.
		    |
	*/
	'accepted' => ':attribute debe ser aceptado.',
	'active_url' => ':attribute no es una URL válida.',
	'after' => ':attribute debe ser posterior a :date.',
	'after_or_equal' => ':attribute debe ser una fecha posterior o igual a :date.',
	'alpha' => ':attribute solo puede contener letras.',
	'alpha_dash' => ':attribute solo puede contener letras, números, guiones y guiones bajos.',
	'alpha_num' => ':attribute solo puede contener letras y números.',
	'array' => ':attribute debe ser un array.',
	'before' => ':attribute debe ser anterior a :date.',
	'before_or_equal' => ':attribute debe ser una fecha anterior o igual a :date.',
	'between' => [
		'numeric' => ':attribute debe ser un valor entre :min y :max.',
		'file' => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
		'string' => ':attribute debe contener entre :min y :max caracteres.',
		'array' => ':attribute debe contener entre :min y :max elementos.',
	],
	'boolean' => ':attribute debe ser verdadero o falso.',
	'confirmed' => 'El campo confirmación de :attribute no coincide.',
	'date' => ':attribute no corresponde con una fecha válida.',
	'date_equals' => ':attribute debe ser una fecha igual a :date.',
	'date_format' => ':attribute no corresponde con el formato de fecha :format.',
	'different' => 'Los campos :attribute y :other deben ser diferentes.',
	'digits' => ':attribute debe ser un número de :digits dígitos.',
	'digits_between' => ':attribute debe contener entre :min y :max dígitos.',
	'dimensions' => ':attribute tiene dimensiones de imagen inválidas.',
	'distinct' => ':attribute tiene un valor duplicado.',
	'email' => ':attribute debe ser una dirección de correo válida.',
	'ends_with' => ':attribute debe finalizar con alguno de los siguientes valores: :values',
	'exists' => ':attribute seleccionado no existe.',
	'file' => ':attribute debe ser un archivo.',
	'filled' => ':attribute debe tener un valor.',
	'gt' => [
		'numeric' => ':attribute debe ser mayor a :value.',
		'file' => 'El archivo :attribute debe pesar más de :value kilobytes.',
		'string' => ':attribute debe contener más de :value caracteres.',
		'array' => ':attribute debe contener más de :value elementos.',
	],
	'gte' => [
		'numeric' => ':attribute debe ser mayor o igual a :value.',
		'file' => 'El archivo :attribute debe pesar :value o más kilobytes.',
		'string' => ':attribute debe contener :value o más caracteres.',
		'array' => ':attribute debe contener :value o más elementos.',
	],
	'image' => ':attribute debe ser una imagen.',
	'in' => ':attribute es inválido.',
	'in_array' => ':attribute no existe en :other.',
	'int||eger' => ':attribute debe ser un número entero.',
	'ip' => ':attribute debe ser una dirección IP válida.',
	'ipv4' => ':attribute debe ser una dirección IPv4 válida.',
	'ipv6' => ':attribute debe ser una dirección IPv6 válida.',
	'json' => ':attribute debe ser una cadena de texto JSON válida.',
	'lt' => [
		'numeric' => ':attribute debe ser menor a :value.',
		'file' => 'El archivo :attribute debe pesar menos de :value kilobytes.',
		'string' => ':attribute debe contener menos de :value caracteres.',
		'array' => ':attribute debe contener menos de :value elementos.',
	],
	'lte' => [
		'numeric' => ':attribute debe ser menor o igual a :value.',
		'file' => 'El archivo :attribute debe pesar :value o menos kilobytes.',
		'string' => ':attribute debe contener :value o menos caracteres.',
		'array' => ':attribute debe contener :value o menos elementos.',
	],
	'max' => [
		'numeric' => ':attribute no debe ser mayor a :max.',
		'file' => 'El archivo :attribute no debe pesar más de :max kilobytes.',
		'string' => ':attribute no debe contener más de :max caracteres.',
		'array' => ':attribute no debe contener más de :max elementos.',
	],
	'mimes' => ':attribute debe ser un archivo de tipo: :values.',
	'mimetypes' => ':attribute debe ser un archivo de tipo: :values.',
	'min' => [
		'numeric' => ':attribute debe ser al menos :min.',
		'file' => 'El archivo :attribute debe pesar al menos :min kilobytes.',
		'string' => ':attribute debe contener al menos :min caracteres.',
		'array' => ':attribute debe contener al menos :min elementos.',
	],
	'not_in' => ':attribute seleccionado es inválido.',
	'not_regex' => 'El formato de :attribute es inválido.',
	'numeric' => ':attribute debe ser un número.',
	'password' => 'La contraseña es incorrecta.',
	'present' => ':attribute debe estar presente.',
	'regex' => 'El formato de :attribute es inválido.',
	'required' => ':attribute es obligatorio.',
	'required_if' => ':attribute es obligatorio cuando :other es :value.',
	'required_unless' => ':attribute es requerido a menos que :other se encuentre en :values.',
	'required_with' => ':attribute es obligatorio cuando :values está presente.',
	'required_with_all' => ':attribute es obligatorio cuando :values están presentes.',
	'required_without' => ':attribute es obligatorio cuando :values no está presente.',
	'required_without_all' => ':attribute es obligatorio cuando ninguno de los campos :values están presentes.',
	'same' => 'Los campos :attribute y :other deben coincidir.',
	'size' => [
		'numeric' => ':attribute debe ser :size.',
		'file' => 'El archivo :attribute debe pesar :size kilobytes.',
		'string' => ':attribute debe contener :size caracteres.',
		'array' => ':attribute debe contener :size elementos.',
	],
	'starts_with' => ':attribute debe comenzar con uno de los siguientes valores: :values',
	'string' => ':attribute debe ser una cadena de caracteres.',
	'timezone' => ':attribute debe ser una zona horaria válida.',
	'unique' => ':attribute ya está en uso.',
	'uploaded' => ':attribute no se pudo subir.',
	'url' => 'El formato de :attribute es inválido.',
	'uuid' => ':attribute debe ser un UUID válido.',
    'decimal' => ':attribute debe ser tener slo un decimal.',

	/*
		    |--------------------------------------------------------------------------
		    | Custom Validation Language Lines
		    |--------------------------------------------------------------------------
		    |
		    | Here you may specify custom validation messages for attributes using the
		    | convention "attribute.rule" to name the lines. This makes it quick to
		    | specify a specific custom language line for a given attribute rule.
		    |
	*/



	/*
		    |--------------------------------------------------------------------------
		    | Custom Validation Attributes
		    |--------------------------------------------------------------------------
		    |
		    | The following language lines are used to swap attribute place-holders
		    | with something more reader friendly such as E-Mail Address instead
		    | of "email". This simply helps us make messages a little cleaner.
		    |
	*/

	'attributes' => [
        'website_name' => 'Nombre del Sitio',
        'website_url'    => 'Url del Sitio',
        'score_picks' => 'Pronosticos a Seleccionar',
        'minuts_before_picks' => 'Minutos antes para pronosticar',
        'allow_tie' => '¿Permite Empates?',
        'type_substract_points' => 'Como se van a descontar',
        'user_rounds_participation' => 'Cuantas Jornadas',
        'subtract_from_round' => 'A partir de que jornada',
        'rounds_to_substract_points' => 'Jornadas a descontar',
        'active'=>'Activo',
        'created_at'=>'Creado el ',
        'date'=>'Fecha',
        'email'=>'Correo Electrónico',
        'email_verified_at'=>'Verificado el',
        'full_access'=>'Acceso Toal',
        'general'=>'General',
        'id'=>'Id',
        'ip_address'=>'Dirección Ip',
        'predeterminado'=>'Predeteraminado',
        'last_activity'=>'Última Actividad',
        'last_used_at'=>'Última Vez Usado',
        'latitude'=>'Latitud',
        'name'=>'Nombre',
        'permission_id'=>'Permiso',
        'phone'=>'Teléfono',
        'remember_token'=>'Token ',
        'renew_automatically'=>'Renovar Automáticamente',
        'role_id'=>'Role',
        'short' => 'Corto',
        'slug'=>'Slug',
        'spanish'=>'Español',
        'state'=>'Estado',
        'status_id'=>'Estado',
        'timezone'=>'Zona Horaria',
        'token'=>'Token ',
        'tokenable_id'=>'Token ',
        'tokenable_type'=>'Token ',
        'town'=>'Ciudad',
        'two_factor_confirmed_at'=>'Doble Factor Confirmación',
        'two_factor_recovery_codes'=>'Doble Factor Recuperación',
        'two_factor_secret'=>'Doble Factor Secreta',
        'zipcode'=>'Zona Postal',
        "first_name" => 'Nombre',
        "last_name"  => 'Apellido',
        "agree_be_legal_age" => 'Aceptar mayoría de edad',
        "image_path" => 'Debe ser imagen',
        "entidad" => "Entidad",
        "abreviado" => "Abreviado",
        "entidad_id" => "Entidad",
        "municipio" => "Municipio",
        "municipio_id" => "Municipio",
        "nombre" => "Nombre",
        "tipo" => "Tipo",
        "password" => 'Contraseña',
        "password_confirmation" => 'Confirmar',
        "rfc"                       => 'RFC',
        "curp"                      => 'CURP',
        'alias' => 'Alias',
        '' => 'Corto',
        'start_date' => 'Fecha de Inicio',
        'end_date' => 'Fecha Final',
        'type'  => 'Tipo',
        'round_id' => 'Jornada',
        'local_team_id' => 'Equipo Local',
        'visit_team_id' => 'Equipo Visita',
        'local_points' => 'Puntos Local',
        'visit_points' => 'Puntos Local',
        'ine_anverso'   => 'Frontal',
        'ine_reverso'   =>  'Reverso',
        'codpos'        => 'Código Postal',
        'confirmar'     => 'Este campo ',
        'birthday'      => 'Fecha de Nacimiento',
        'terms'         => 'Debe Aceptar los Términos y Condiciones',
        'adult'         => 'Mayor de edad',
        'handicap'      => 'Linea'
   	]

];
