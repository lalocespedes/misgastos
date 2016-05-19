<?php

$validation = function($request) use($app) {

	$name = $request->post('nombre');

	$v = $app->validation;

	return $v->validate([
		'name'		=> [$name, 'required']
	]);

};


$app->post('/category/form/', $authenticated(), function() use($app, $validation) {

	$request = $app->request();

	$name = $request->post('nombre');

	$v = $validation($request);

	if ($v->passes()) {
		
		$app->category->create([

			'name' 			=> $name

		]);

		$app->flash('success', 'Guardado!');
		$app->response->redirect($app->urlFor('category'));

	} else {

		$app->render('category/form.twig', [
		'request'		=> $request,
		'errors' 		=> $v->errors()
		]);

	}

});


$app->post('/category/form/:id', $authenticated(), function($id) use($app, $validation) {

	$category = $app->category->where('id', $id)->first();

	$request = $app->request();

	$name = $request->post('nombre');

	$v = $validation($request);

	if ($v->passes()) {
		
		$category->update([
			'name' 			=> $name
		]);

		$app->flash('warning', 'Actualizado!');
		$app->response->redirect($app->urlFor('category'));

	} else {

		$app->render('category/form.twig', [
		'request'		=> $request,
		'errors' 		=> $v->errors()
		]);

	}

});
