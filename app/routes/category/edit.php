<?php

$app->get('/category/edit/:id', $authenticated(), function($id) use($app) {

	$category = $app->category->where('id', $id)->first();

	if(!$category) {
		$app->response->redirect($app->urlFor('category'));
	}

	$app->render('/category/form.twig', [
		'title'		=> 'Editar Categoria',
		'id'		=> $id,
		'category'	=> $category
	]);

})->name('category-edit');