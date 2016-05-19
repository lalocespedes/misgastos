<?php

$app->get('/expenses/add', $authenticated(), function() use($app) {

	$categories = $app->category->get();

	$app->render('expenses/form.twig', [
		'title'			=> 'Agregar Gasto',
		'categories'	=> $categories
	]);

})->name('expenses-add');