<?php

$app->get('/category/delete/:id', function($id) use($app) {

	$category = $app->category->where('id', $id)->first();

	if(!$category)  {

		$app->flash('Danger', 'Registro no encontrado!');
		$app->response->redirect($app->urlFor('category'));
	
	} else {

		$category->delete();

		$app->flash('Danger', 'Registro borrado!');
		$app->response->redirect($app->urlFor('category'));
	}

})->name('category-delete');