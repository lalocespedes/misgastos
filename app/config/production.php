<?php

return [
	'app' 	=> [
		'url'	=> 'http://misgastos.local',
		'hash'	=> [
			'algo'	=> PASSWORD_BCRYPT,
			'cost'	=> 10
		],
		'debug'	=> false	
	],
	'db' 	=> [
		'driver' 	=> 'mysql',
		'host'		=> 'localhost',
		'name'		=> 'misgastos',
		'username'	=> 'root',
		'password'	=> 'root',
		'charset'	=> 'utf8',
		'collation'	=> 'utf8_unicode_ci',
		'prefix'	=>	''
	],
	'auth'	=> [
		'session'	=> 'user_id',
		'remember'	=> 'user_r'
	],
	'mail'	=> [
		'smtp_auth'		=> true,
		'smtp_secure'	=> 'tls',
		'host' 			=> 'smtp.gmail.com',
		'username'		=> 'lalocespedes@gmail.com',
		'password'		=> '',
		'port'			=> 587,
		'html'			=> true
	],
	'twig'	=> [
		'debug'	=> false 
	],
	'csrf'	=> [
		'key'	=> 'csrf_token'
	]
];
