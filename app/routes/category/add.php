<?php

$app->get('/category/add', $authenticated(), function() use($app) {

	$app->render('category/form.twig', [
		'title'	=> 'Agregar Categoria'
	]);

})->name('category-add');