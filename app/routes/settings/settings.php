<?php

$app->get('/settings', function() use($app) {

	$company = $app->company->lists('value', 'key');

	$app->render('settings/settings.twig', [
		'title'	=> 'Ajustes',
		'company'	=> $company
	]);


})->name('settings');

$app->post('/settings', function() use($app) {

	$request = $app->request();

	//hacer validation

	$v = $app->validation;

	$v->validate([
		'regimenfiscal'		=> [$request->post('regimenfiscal'), 'required'],
	]);

	if ($v->passes()) {


	$fields = [

		'name'			=> $request->post('nombre_fiscal'),
		'address'		=> $request->post('direccion'),
		'colonia'		=> $request->post('colonia'),
		'noExterior'	=> $request->post('noExterior'),
		'noInterior'	=> $request->post('noInterior'),
		'city'			=> $request->post('ciudad'),
		'state'			=> $request->post('estado'),
		'zip'			=> $request->post('zip'),
		'country'		=> $request->post('pais'),
		'phone_number'	=> $request->post('telefono'),
		'fax_number'	=> $request->post('fax'),
		'mobile_number'	=> $request->post('celular'),
		'email_address'	=> $request->post('correo'),
		'web_address'	=> $request->post('web'),
		'company_name'	=> $request->post('company_name'),
		//'tax_id'		=> $request->post('rfc'),
		'curp'			=> $request->post('curp'),
		'cedprof'		=> $request->post('cedprof'),
		'regimen_fiscal'=> $request->post('regimenfiscal'),
		'CIForestal'	=> $request->post('CIForestal')

	];

	foreach ($fields as $key => $field) {
		
		$company = $app->company->where('key', $key);

		$company->update([

			'value' => $field

		]);

	}

	$app->flash('success', 'Cambios Guardados!');
	$app->response->redirect($app->urlFor('settings'));

	} else {

		$company = $app->company->lists('value', 'key');

		$app->render('settings/settings.twig', [
		'title'		=> 'Ajustes',
		'request'	=> $request,
		'errores'	=> 'Error, por favor verifica la informacion',
		'errors' 	=> $v->errors(),
		'company'	=> $company
		]);
	}

})->name('settings-post');